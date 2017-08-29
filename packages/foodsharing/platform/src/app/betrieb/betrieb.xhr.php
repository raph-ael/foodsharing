<?php 
class BetriebXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new BetriebModel();
		$this->view = new BetriebView();

		parent::__construct();
		
		if(!S::may('fs'))
		{
			exit();
		}
		
	}
	
	public function savedate()
	{
		if(strtotime($_GET['time']) > 0 && $_GET['fetchercount'] > 0)
		{
			$fetchercount = (int)$_GET['fetchercount'];
			$time = $_GET['time'];
			if($fetchercount > 8)
			{
				$fetchercount = 8;
			}
			
			if($this->model->addFetchDate($_GET['bid'],$time,$fetchercount))
			{
				fs_info('Abholtermin wurde eingetragen!');
				return array(
					'status' => 1,
					'script' => 'reload();'		
				);
			}
			
		}
	}
	
	public function deldate()
	{
		if(isset($_GET['id']) && isset($_GET['time']) && strtotime($_GET['time']) > 0)
		{
			$this->model->deldate($_GET['id'],$_GET['time']);
			
			fs_info('Abholtermin wurde gelöscht.');
			
			return array(
				'status' => 1,
				'script' => 'reload();'		
			);
		}
	}
	
	public function getfetchhistory()
	{
		if(S::may() && ($this->model->isVerantwortlich($_GET['bid']) || S::may('orga')))
		{
			if($history = $this->model->getFetchHistory($_GET['bid'],$_GET['from'],$_GET['to']))
			{
				return array(
					'status' => 1,
					'script' => '
					$("daterange_from").datepicker("close");
					$("daterange_to").datepicker("close");
						
					$("#daterange_content").html(\''.jsSafe($this->view->fetchlist($history)).'\');
						'
				);
			}
		}
	}
	
	public function fetchhistory()
	{
		if(S::may() && ($this->model->isVerantwortlich($_GET['bid']) || S::may('orga')))
		{
			$dia = new XhrDialog();
			$dia->setTitle('Abholungshistorie');
			
			$id = 'daterange';
			
			$dia->addContent($this->view->fetchHistory());
			
			$dia->addJsAfter('

					$( "#'.$id.'_from" ).datepicker({
						changeMonth: true,
						maxDate: "0",
						
						onClose: function( selectedDate ) {
							$( "#'.$id.'_to" ).datepicker( "option", "minDate", selectedDate );
						}
					});
					$( "#'.$id.'_to" ).datepicker({
						changeMonth: true,
						maxDate: "0",
						autoOpen: true,
						onClose: function( selectedDate ) {
							$( "#'.$id.'_from" ).datepicker( "option", "maxDate", selectedDate );
						}
					});
					
					$( "#'.$id.'_from" ).datepicker("show");
					
					
					$(window).resize(function(){
						$("#'.$dia->getId().'").dialog("option",{
							height:($(window).height()-40)
						});
					});
					
					$("#daterange_submit").click(function(ev){
						ev.preventDefault();
					
						var date = $( "#'.$id.'_from" ).datepicker("getDate");
						
						var from = "";
						var to = "";
						
						if(date !== null)
						{
							from = date.getFullYear() + "-" + preZero((date.getMonth()+1)) + "-" + preZero(date.getDate());
							date = $( "#'.$id.'_to" ).datepicker("getDate");
						
							if(date === null)
							{
								to = from;
							}
							else
							{
								to = date.getFullYear() + "-" + preZero((date.getMonth()+1)) + "-" + preZero(date.getDate());
							}
					
							ajreq("getfetchhistory",{app:"betrieb",from:from,to:to,bid:'.(int)$_GET['bid'].'});
						}
						else
						{
							alert("Du musst erst ein Datum ausw&auml;hlen ;)");
						}
					});
					
			');
			
			$dia->addOpt('width','500px');
			$dia->addOpt('height','($(window).height()-40)',false);
			
			
			return $dia->xhrout();
		}
	}
	
	public function adddate()
	{
		$dia = new XhrDialog();
		$dia->setTitle('Abholtermin eintragen');
		$dia->addContent($this->view->dateForm());
		$dia->addOpt('width', 280);
		$dia->setResizeable(false);
		$dia->addAbortButton();
		$dia->addButton('Speichern', 'saveDate();');
		
		$dia->addJs('
				
			function saveDate()
			{
				var date = $("#datepicker").datepicker( "getDate" );
				
				date = date.getFullYear() + "-" +
				    ("00" + (date.getMonth()+1)).slice(-2) + "-" +
				    ("00" + date.getDate()).slice(-2) + " " + 
				    ("00" + $("select[name=\'time[hour]\']").val()).slice(-2) + ":" + 
				    ("00" + $("select[name=\'time[min]\']").val()).slice(-2) + ":00";
				
				if($("#fetchercount").val() > 0)
				{
					ajreq("savedate",{
						app:"betrieb",
						time:date,
						fetchercount:$("#fetchercount").val(),
						bid:'.(int)$_GET['id'].'
					});
				}
				else
				{
					pulseError("Du musst noch die Anzahl der Abholer/innen auswählen");
				}
			}
				
			$("#datepicker").datepicker({
				minDate: new Date()
			});	
		');
		
		return $dia->xhrout();
	}
	
	public function savebezirkids()
	{
		if(isset($_GET['ids']) && is_array($_GET['ids']) && count($_GET['ids']) > 0)
		{
			foreach ($_GET['ids'] as $b)
			{
				if($this->model->isVerantwortlich($b['id']) && (int)$b['v'] > 0)
				{
					$this->model->updateBetriebBezirk($b['id'],$b['v']);
				}
			}
			
		}
		return array('status'=>1);
	}
	
	public function setbezirkids()
	{
		if(isset($_SESSION['client']['verantwortlich']) && is_array($_SESSION['client']['verantwortlich']) )
		{
			$ids = array();
			foreach ($_SESSION['client']['verantwortlich'] as $b)
			{
				$ids[] = (int)$b['betrieb_id'];
			}
			if(!empty($ids))
			{
				if($betriebe = $this->model->q('SELECT id,name,bezirk_id,str,hsnr FROM fs_betrieb WHERE id IN('.implode(',',$ids).') AND ( bezirk_id = 0 OR bezirk_id IS NULL)'))
				{
					$dia = new XhrDialog();
				
					$dia->setTitle('Fehlende Zuordnung');
					$dia->addContent(v_info('Für folgende Betriebe wurde noch kein Bezirk zugeordnet. Bitte gib einen Bezirk an!'));
					$dia->addOpt('width', '650px');
					$dia->noOverflow();
					
					$bezirks = $this->model->getBezirke();
					
					foreach ($bezirks as $key => $b)
					{
						if( !in_array($b['type'],array(1,2,3,9)) )
						{
							unset($bezirks[$key]);
						}
					}
					
					$cnt= '
					<div id="betriebetoselect">';
					foreach ($betriebe as $b)
					{
						$cnt .= v_form_select('b_'.$b['id'],array(
							'label'=> $b['name'].', '.$b['str'].' '.$b['hsnr'],
							'values'=> $bezirks
						));
					}
					$cnt .= '
					</div>';
					$dia->addJs('
						$("#savebetriebetoselect").click(function(ev){
							ev.preventDefault();
							
							var saveArr = new Array();
							
							$("#betriebetoselect select.input.select").each(function(){
								var $this = $(this);
								var value = parseInt($this.val());
								var id = parseInt($this.attr("id").split("b_")[1]);
							
								if(id > 0 && value > 0)
								{
									saveArr.push({
										id:id,
										v:value
									});
								}
							});
							
							if(saveArr.length > 0)
							{
								ajax.req("betrieb","savebezirkids",{
									data: {ids: saveArr},
									success: function(){
										pulseInfo("Erfolgreich gespeichert!");
										$("#'.$dia->getId().'").dialog("close");
									}
								});
							}
						});		
					');
					$dia->addContent($cnt);
					$dia->addContent(v_input_wrapper(false, '<a class="button" id="savebetriebetoselect" href="#">'.s('save').'</a>'));
					
					return $dia->xhrout();
				}
			}
		}
	}
	
	public function signout()
	{
		$xhr = new Xhr();
		if($this->model->isVerantwortlich($_GET['id']))
		{
			$xhr->addMessage(s('signout_error_admin'),'error');
		}
		else if($this->model->isInTeam($_GET['id']))
		{
			$this->model->signout($_GET['id'], fsId());
			$xhr->addScript('goTo("/?page=relogin&url=" + encodeURIComponent("/dashboard") );');
		}
		else
		{
			$xhr->addMessage(s('no_member'),'error');
		}
		$xhr->send();
	}
}
