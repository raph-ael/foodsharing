<?php
class FoodsaverControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new FoodsaverModel();
		$this->view = new FoodsaverView();
		
		parent::__construct();
		
		if(isset($_GET['deleteaccount']))
		{
			$this->deleteAccount($_GET['id']);
		}
		
	}
	
	/*
	 * Default Method for ?page=foodsaver
	 */
	public function index()
	{
		// check bezirk_id and permissions
		if(isset($_GET['bid']) && ($bezirk = $this->model->getBezirk($_GET['bid'])) && (S::may('orga') || isBotForA(array($_GET['bid']), false, true)))
		{
			// permission granted so we can load the foodsavers
			if($foodsaver = $this->model->listFoodsaver($_GET['bid']))
			{
				// add breadcrumps
				addBread('Foodsaver','/?page=foodsaver&bid='.$bezirk['id']);
				addBread($bezirk['name'],'/?page=foodsaver&bid='.$bezirk['id']);
				
				// list fooodsaver
				addContent(
					$this->view->foodsaverList($foodsaver,$bezirk),
					CNT_LEFT
				);
				
				addContent($this->view->foodsaverForm());
				
				addContent(
					$this->view->addFoodsaver($bezirk),
					CNT_RIGHT
				);
			}
		}
		else if(($id = getActionId('edit')) && (isBotschafter() || isOrgaTeam()))
		{
			$data = $this->model->getOne_foodsaver($id);
			$bids = $this->model->getFsBezirkIds($id);
			if($data && (isOrgaTeam() || isBotForA($bids, false, true)))
			{
				handle_edit();
				$data = $this->model->getOne_foodsaver($id);

				addBread(s('bread_foodsaver'),'/?page=foodsaver');
				addBread(s('bread_edit_foodsaver'));
				setEditData($data);
					
				addContent(foodsaver_form($data['name'].' '.$data['nachname'].' bearbeiten'));
					
				addContent(picture_box(),CNT_RIGHT);
				
				addContent(v_field(v_menu(array(
				pageLink('foodsaver','back_to_overview')
				)),s('actions')),CNT_RIGHT);
				
				if(isOrgaTeam())
				{
					addContent(u_delete_account(),CNT_RIGHT);
				}
			}
		}
		else
		{
			addContent(v_info('Du hast leider keine Berechtigung für diesen Bezirk'));
		}
	}
	
	private function deleteAccount($id)
	{
		if((S::may('orga')))
		{
			$foodsaver = $this->model->getValues(array('email','name','nachname','bezirk_id'),'foodsaver',$id);
		
			$this->model->del_foodsaver($id);
			fs_info('Foodsaver '.$foodsaver['name'].' '.$foodsaver['nachname'].' wurde gelöscht, für die Wiederherstellung wende Dich an it@lebensmittelretten.de');
			go('/dashboard');
		}
	}
}

function handle_edit()
{
	global $db;
	global $g_data;
	
	if(submitted())
	{
		
		if(isOrgateam())
		{
			if(isset($g_data['orgateam']) && is_array($g_data['orgateam']) && $g_data['orgateam'][0] == 1)
			{
				$g_data['orgateam'] = 1;
			}
		}
		else
		{
			$g_data['orgateam'] = 0;
			unset($g_data['email']);
			unset($g_data['rolle']);
		}

		$settings_model = loadModel('settings');
		if($oldFs = $settings_model->getOne_foodsaver($_GET['id']))
		{
			$logChangedFields = array('name', 'nachname', 'stadt', 'plz', 'anschrift', 'telefon', 'handy', 'geschlecht', 'geb_datum', 'rolle', 'orgateam');
			$settings_model->logChangedSetting($_GET['id'], $oldFs, $g_data, $logChangedFields);
		}
		if($db->update_foodsaver($_GET['id'], $g_data))
		{
			fs_info(s('foodsaver_edit_success'));
		}
		else
		{
			error(s('error'));
		}
	}
}


function foodsaver_form($title = 'Foodsaver')
{
	global $db;
	global $g_data;

	$orga = '';
	
	$position= '';
	
	if(S::may('orga'))
	{
		$position = v_form_text('position');
		$options = array(
			'values' => array(
					array('id'=>1,'name'=>'ist im Bundesweiten Orgateam dabei')
			)
	);

	if($g_data['orgateam'] == 1)
	{
		$options['checkall'] = true;
	}

	$orga = v_form_checkbox('orgateam',$options);
	$orga .= v_form_select('rolle',array(
			'values' => array(
					array('id' => 0, 'name' => 'Foodsharer/in'),
					array('id' => 1, 'name' => 'Foodsaver/in (FS)'),
					array('id' => 2, 'name' => 'Betriebsverantwortliche/r (BIEB)'),
					array('id' => 3, 'name' => 'Botschafter/in (BOT)'),
					array('id' => 4, 'name' => 'Orgamensch/in (ORG)')
			)
	));
	}

	addJs('
			$("#rolle").change(function(){
				if(this.value == 4)
				{
					$("#orgateam-wrapper input")[0].checked = true;
				}
				else
				{
					$("#orgateam-wrapper input")[0].checked = false;
				}
			});
			$("#plz, #stadt, #anschrift").bind("blur",function(){


					if($("#plz").val() != "" && $("#stadt").val() != "" && $("#anschrift").val() != "")
					{
					u_loadCoords({
							plz: $("#plz").val(),
							stadt: $("#stadt").val(),
							anschrift: $("#anschrift").val(),
							},function(lat,lon){
							$("#lat").val(lat);
							$("#lon").val(lon);
							});
					}
					});

			$("#lat-wrapper").hide();
			$("#lon-wrapper").hide();
			');

	$bezirk = false;
	
	if((int)$g_data['bezirk_id'] > 0)
	{
		$bezirk = $db->getBezirk($g_data['bezirk_id']);
	}

	$bezirkchoose = v_bezirkChooser('bezirk_id',$bezirk);

	

	return v_quickform($title,array(
			$bezirkchoose,
			$orga,
			v_form_text('name',array('required' => true)),
			v_form_text('nachname',array('required' => true)),
			
			$position,
			
			v_form_text('stadt',array('required' => true)),
			v_form_text('plz',array('required' => true)),
			v_form_text('anschrift',array('required' => true)),
			v_form_text('lat'),
			v_form_text('lon'),
			v_form_text('email',array('required'=>true, 'disabled'=>true)),
			v_form_text('telefon'),
			v_form_text('handy'),
			v_form_select('geschlecht',array('values'=> array(
					array('name' => 'Frau','id' => 2),
					array('name' => 'Mann','id' => 1),
					array('name' => 'beides oder Sonstiges','id' => 3)
						
			),
					array('required' => true)
			)),

			v_form_date('geb_datum',array('required' => true, 'yearRangeFrom' => (date('Y')-111), 'yearRangeTo' => date('Y')))
		));
}

function picture_box()
{
	global $db;

	$photo = $db->getPhoto($_GET['id']);

	if(!(file_exists('images/thumb_crop_'.$photo)))
	{
		$p_cnt = v_photo_edit('img/portrait.png',(int)$_GET['id']);
	}
	else
	{
		$p_cnt = v_photo_edit('images/thumb_crop_'.$photo,(int)$_GET['id']);
		//$p_cnt = v_photo_edit('img/portrait.png');
	}

	return v_field($p_cnt, 'Dein Foto');
}

function u_delete_account()
{
	addJs('
		$("#delete-account-confirm").dialog({
			autoOpen: false,
			modal: true,
			title: "'.s('delete_account_confirm_title').'",
			buttons: {
				"'.s('abort').'" : function(){
					$("#delete-account-confirm").dialog("close");
				},
				"'.s('delete_account_confirm_bt').'" : function(){
					goTo("/?page=foodsaver&a=edit&id='.(int)$_GET['id'].'&deleteaccount=1");
				}
			}
		});

		$("#delete-account").button().click(function(){
			$("#delete-account-confirm").dialog("open");
		});
	');
	$content = '
	<div style="text-align:center;margin-bottom:10px;">
		<span id="delete-account">'.s('delete_now').'</span>
	</div>
	'.v_info(s('posible_restore_account'),s('reference'));

	addHidden('
		<div id="delete-account-confirm">
			'.v_info(s('delete_account_confirm_msg')).'
		</div>
	');

	return v_field($content, s('delete_account'),array('class'=>'ui-padding'));
}
