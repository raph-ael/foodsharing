<?php 
class BasketXhr extends Control
{
	
	private $status;
	
	public function __construct()
	{
		$this->model = new BasketModel();
		$this->view = new BasketView();
		
		$this->status = array(
			'ungelesen'	=> 0,
			'gelesen' => 1,
			'abgeholt' => 2,
			'abgelehnt' => 3,
			'nicht_gekommen' => 4,
			'wall_follow' => 9,
			'angeklickt' => 10	
		);

		parent::__construct();
		
		/*
		 * allowed method for not logged in users
		 */
		$allowed = array(
			'bubble' => true,
			'login' => true,
			'basketchoords' => true,
			'closebaskets'=> true
		);

		if(!S::may() && !isset($allowed[$_GET['m']]))
		{
			echo json_encode(array(
				'status' => 1,
				'script' => 'pulseError("Du bist nicht eingeloggt, vielleicht ist Deine Session abgelaufen, bitte logge Dich ein und sende Deine Anfrage erneut ab.");'
			));
			exit();
		}
	}
	
	public function basketchoords()
	{
		$xhr = new Xhr();
		if($baskets = $this->model->getBasketChoords())
		{
			$xhr->addData('baskets', $baskets);
		}
		
		$xhr->send();
	}
	
	public function newbasket()
	{
		$dia = new XhrDialog();
		$dia->setTitle('Essenskorb anbieten');
		
		$dia->addPictureField('picture');
		
		$foodsaver = $this->model->getValues(array('telefon','handy'), 'foodsaver', fsid());
		
		$dia->addContent($this->view->basketForm($foodsaver));
				
		$dia->addJs('
				
		$("#tel-wrapper").hide();
		$("#handy-wrapper").hide();
		
		$("input.input.cb-contact_type[value=\'2\']").change(function(){
			if(this.checked)
			{
				$("#tel-wrapper").show();
				$("#handy-wrapper").show();	
			}
			else
			{
				$("#tel-wrapper").hide();
				$("#handy-wrapper").hide();
			}
		});
				
		$(".cb-food_art[value=3]").click(function(){
			if(this.checked)
			{
				$(".cb-food_art[value=2]")[0].checked = true;
			}
		});
		');
		
		$dia->noOverflow();
		
		$dia->addOpt('width', 550);
		
		$dia->addButton('Essenskorb veröffentlichen', 'ajreq(\'publish\',{appost:0,app:\'basket\',data:$(\'#'.$dia->getId().' .input\').serialize(),description:$(\'#description\').val(),picture:$(\'#'.$dia->getId().'-picture-filename\').val(),weight:$(\'#weight\').val()});');
		
		return $dia->xhrout();
	}
	
	public function publish()
	{
		$data = false;
		
		parse_str($_GET['data'], $data);
		
		$desc = strip_tags($data['description']);
		
		$desc = trim($desc);
		
		if(empty($desc))
		{
			return array(
				'status' => 1,
				'script' => 'pulseInfo("Bitte gib eine Beschreibung ein!");'
			);
		}
		
		$pic = '';
		$weight = floatval($data['weight']);
		
		if(isset($data['filename']))
		{
			$pic = preg_replace('/[^a-z0-9\.]/', '', $data['filename']);
			if(!empty($pic) && file_exists(PUBLIC_TMP_DIR . '/' . $pic))
			{
				$this->resizePic($pic);
			}
		}
		
		$lat = 0;
		$lon = 0;
		
		$location_type = 0;
		
		if($location_type == 0)
		{
			$fs = $this->model->getValues(array('lat','lon'), 'foodsaver', fsid());
			$lat = $fs['lat'];
			$lon = $fs['lon'];
		}


		if($lat == 0 && $lon == 0)
		{
			return array(
				'status' => 1,
				'script' => 'pulseInfo("Bitte gib in Deinem Profil eine Adresse ein!");'
			);
		}
		
		$contact_type = 1;
		$tel = array(
			'tel' => '',
			'handy' => ''		
		);
		
		if(isset($data['contact_type']) && is_array($data['contact_type']))
		{
			$contact_type = implode(':', $data['contact_type']);
			if(in_array(2, $data['contact_type']))
			{
				$tel = array(
					'tel' => preg_replace('/[^0-9\-\/]/', '', $data['tel']),
					'handy' => preg_replace('/[^0-9\-\/]/', '', $data['handy'])
				);
			}
		}
		
		if(!empty($desc) && ($id = $this->model->addBasket($desc,$pic,$tel,$contact_type,$weight,$location_type,$lat,$lon,S::user('bezirk_id'))))
		{
			if(isset($data['food_type']) && is_array($data['food_type']))
			{
				$types = array();
				foreach ($data['food_type'] as $ft)
				{
					if((int)$ft > 0)
					{
						$types[] = (int)$ft;
					}
				}
				
				$this->model->addTypes($id,$types);
			}
			
			if(isset($data['food_art']) && is_array($data['food_art']))
			{
				$arts = array();
				foreach ($data['food_art'] as $ft)
				{
					if((int)$ft > 0)
					{
						$arts[] = (int)$ft;
					}
				}
				
				$this->model->addArt($id,$arts);
			}
			
			return array(
				'status' => 1,
				'script' => '
					$("#msgbar-basket").hide();
					pulseInfo("Danke Dir! Der Essenskorb wurde veröffentlicht!");
					$(".xhrDialog").dialog("close");
					$(".xhrDialog").dialog("destroy");
					$(".xhrDialog").remove();'
			);
		}
		
		return array(
				'status' => 1,
				'script' => 'pulseError("Es gab einen Fehler, der Essenskorb konnte nicht veröffentlicht werden.");'
		);
		
	}
	
	public function resizePic($pic)
	{
		copy(PUBLIC_TMP_DIR . '/' . $pic, PUBLIC_IMAGES_DIR . '/basket/' . $pic);
		
		$img = new fImage(PUBLIC_IMAGES_DIR . '/basket/' . $pic);
		$img->resize(800, 800);
		$img->saveChanges();
		
		
		copy(PUBLIC_IMAGES_DIR . '/basket/' . $pic, PUBLIC_IMAGES_DIR . '/basket/medium-' . $pic);
		
		$img = new fImage(PUBLIC_IMAGES_DIR . '/basket/medium-' . $pic);
		$img->resize(450, 450);
		$img->saveChanges();
		
		
		copy(PUBLIC_IMAGES_DIR . '/basket/medium-' . $pic, PUBLIC_IMAGES_DIR . '/basket/thumb-' . $pic);
		
		$img = new fImage(PUBLIC_IMAGES_DIR . '/basket/thumb-' . $pic);
		$img->cropToRatio(1, 1);
		$img->resize(200, 200);
		$img->saveChanges();
		
		
		copy(PUBLIC_IMAGES_DIR . '/basket/thumb-' . $pic, PUBLIC_IMAGES_DIR . '/basket/75x75-' . $pic);
		
		$img = new fImage(PUBLIC_IMAGES_DIR . '/basket/75x75-' . $pic);
		$img->cropToRatio(1, 1);
		$img->resize(75, 75);
		$img->saveChanges();
		
		
		copy(PUBLIC_IMAGES_DIR . '/basket/75x75-' . $pic, PUBLIC_IMAGES_DIR . '/basket/50x50-' . $pic);
		
		$img = new fImage(PUBLIC_IMAGES_DIR . '/basket/50x50-' . $pic);
		$img->cropToRatio(1, 1);
		$img->resize(50, 50);
		$img->saveChanges();
	}
	
	public function closebaskets()
	{
		$xhr = new Xhr();
		
		if(isset($_GET['choords']))
		{
			if($basket = $this->model->closeBaskets(50,array(
				'lat' => $_GET['choords'][0],
				'lon'=> $_GET['choords'][1]
			)))
			{
				$xhr->addData('baskets', $basket);
			}
		}
		
		$xhr->send();
	}
	
	public function bubble()
	{
		if(($basket = $this->model->getBasket($_GET['id'])))
		{
			if($basket['fsf_id'] == 0)
			{
				$dia = new XhrDialog();
				
				/*
				 * What see the user if not logged in?
				 */
				if(!S::may())
				{
					$dia->setTitle('Essenskorb');
					$dia->addContent($this->view->bubbleNoUser($basket));
					
				}
				else
				{
					$dia->setTitle('Essenskorb von '.$basket['fs_name']);
					$dia->addContent($this->view->bubble($basket));
				}
				
				$dia->addButton('zum Essenskorb', 'goTo(\'/essenskoerbe/'.(int)$basket['id'].'\');');
				
				$modal = false;
				if(isset($_GET['modal']))
				{
					$modal = true;
				}
				$dia->addOpt('modal', 'false',$modal);
				$dia->addOpt('resizeable', 'false',false);
				
				
				$dia->addOpt('width', 400);
				$dia->noOverflow();
				
				$return = $dia->xhrout();
				
				return $return;
			}
			else
			{
				return $this->fsBubble($basket);
			}
		}
		else
		{
			return array(
				'status' => 1,
				'script' => 'pulseError("Essenskorb konnte nicht geladen werden");'		
			);
		}
	}
	
	public function fsBubble($basket)
	{
		$dia = new XhrDialog();
		
		$dia->setTitle('Essenskorb von foodsharing.de');
		
		$dia->addContent($this->view->fsBubble($basket));
		$modal = false;
		if(isset($_GET['modal']))
		{
			$modal = true;
		}
		$dia->addOpt('modal', 'false',$modal);
		$dia->addOpt('resizeable', 'false',false);

		$dia->addOpt('width', 400);
		$dia->noOverflow();
		
		$dia->addJs('$(".fsbutton").button();');
		
		$return = $dia->xhrout();
		
		return $return;
	}
	
	public function request()
	{
		if($basket = $this->model->getBasket($_GET['id']))
		{
			$this->model->setStatus($_GET['id'], 10);
			$dia = new XhrDialog();
			$dia->setTitle('Essenskorb von '.$basket['fs_name'].'');
			$dia->addOpt('width', 300);
			$dia->noOverflow();
			$dia->addContent($this->view->contactTitle($basket));
			
			$contact_type = array(1);
			
			if(!empty($basket['contact_type']))
			{
				$contact_type = explode(':', $basket['contact_type']);
			}
			
			if(in_array(2, $contact_type))
			{
				$dia->addContent($this->view->contactNumber($basket));
			}
			if(in_array(1, $contact_type))
			{
				$dia->addContent($this->view->contactMsg($basket));
				$dia->addButton('Anfrage absenden', 'ajreq(\'sendreqmessage\',{appost:0,app:\'basket\',id:'.(int)$_GET['id'].',msg:$(\'#contactmessage\').val()});');
			}
			
			return $dia->xhrout();
		}
	}
	
	public function sendreqmessage()
	{
		if($fs_id = $this->model->getVal('foodsaver_id', 'basket', $_GET['id']))
		{
			$msg = strip_tags($_GET['msg']);
			$msg = trim($msg);
			if(!empty($msg))
			{
				$this->model->message($fs_id, fsId(), $msg,0);
				$this->mailMessage(fsId(), $fs_id, $msg,22);
				$this->model->setStatus($_GET['id'], 0);
				
				return array(
					'status' => 1,
					'script' => 'if($(".xhrDialog").length > 0){$(".xhrDialog").dialog("close");}pulseInfo("Anfrage wurde versendet.");'		
				);
			}
			else
			{
				return array(
					'status' => 1,
					'script' => 'pulseError("Du hast keine Nachricht eingegeben");'
				);
			}
		}
		
		return array(
			'status' => 1,
			'script' => 'pulseError("Es ist ein Fehler aufgetreten");'
		);
	}
	
	public function infobar()
	{
		S::noWrite();
		
		$xhr = new Xhr();
	
		$out = '';
		if($updates = $this->model->listUpdates())
		{
			$out = $this->view->listUpdates($updates);
		}
		
		if($baskets = $this->model->listMyBaskets())
		{
			$out .= $this->view->listMyBaskets($baskets);
		}
		
		$xhr->addData('html', $out);
		
		$xhr->send();
	}
	
	public function update()
	{
		$count = $this->model->getUpdateCount();
		if((int)$count > 0)
		{
			return array(
				'status' => 1,
				'script' => '
					$("#msgBar-badge .bar-basket").text("'.$count.'").css({ opacity: 1 });
					$("#msgbar-basket ul li.loading").remove();
					$("#msgbar-basket ul").prepend(\'<li class="loading">&nbsp;</li>\');
				'		
			);
		}
		else
		{
			return array(
				'status' => 1,
				'script' => '$("#msgBar-badge .bar-basket").text("0").css({ opacity: 0 });'		
			);
		}
	}
	
	public function answer()
	{
		if($id = $this->model->getVal('foodsaver_id','basket',$_GET['id']))
		{
			if($id == fsid())
			{
				$this->model->setStatus($_GET['id'], 1, $_GET['fid']);
				return array(
					'status' => 1,
					'script'=> 'chat('.$_GET['fid'].');$("#msgbar-basket").hide();ajreq("update",{app:"basket"});'		
				);
			}
		}
	}
	
	public function removeRequest()
	{
		if($request = $this->model->getRequest($_GET['id'],$_GET['fid']))
		{
			global $g_data;
			$g_data['fetchstate'] = 3;
			/*
			 * Array
				(
				    [time_ts] => 1402149037
				    [fs_name] => Luisa
				    [fs_photo] => 530c93a86a9f8.jpg
				    [fs_id] => 3542
				    [id] => 20
				)
			 */
			
			$dia = new XhrDialog();
			$dia->addOpt('width', '400');
			$dia->noOverflow();
			$dia->setTitle('Essenskorbanfrage von '.$request['fs_name'].' abschließen');
			$dia->addContent( 
				'<div>
					<img src="'.img($request['fs_photo']).'" style="float:left;margin-right:10px;">
					<p>Anfragezeitpunkt: '.niceDate($request['time_ts']).'</p>
					<div style="clear:both;"></div>
				</div>'	
				. v_form_radio('fetchstate',array(
				'values' => array(
					array('id' => 3, 'name' => 'Ja, '.genderWord($request['fs_gender'], 'er', 'sie', 'er/sie').' hat den Korb abgeholt.'),
					array('id' => 5, 'name' => 'Nein, '.genderWord($request['fs_gender'], 'er', 'sie', 'er/sie').' ist leider nicht wie verabredet erschienen.'),
					array('id' => 5, 'name' => 'Die Lebensmittel wurden von jemand anderem abgeholt.'),
				)		
			)));
			$dia->addAbortButton();
			$dia->addButton('Weiter', 'ajreq(\'finishRequest\',{app:\'basket\',id:'.(int)$_GET['id'].',fid:'.(int)$_GET['fid'].',sk:$(\'#fetchstate-wrapper input:checked\').val()});');
			
			return $dia->xhrout();
		}
	}
	
	public function removeBasket()
	{
		$this->model->removeBasket($_GET['id']);
		
		return array(
			'status' => 1,
			'script' => '$(".basket-'.(int)$_GET['id'].'").remove();pulseInfo("Essenskorb ist jetzt nicht mehr aktiv!");'		
		);
	}

	public function follow()
	{
		if(isset($_GET['bid']) && (int)$_GET['bid'] > 0)
		{
			$this->model->follow($_GET['bid']);
		}
	}
	
	public function finishRequest()
	{
		if($request = $this->model->getRequest($_GET['id'],$_GET['fid']))
		{
			if(isset($_GET['sk']) && (int)$_GET['sk'] > 0)
			{
				$this->model->setStatus($_GET['id'], $_GET['sk'],$_GET['fid']);
				return array(
					'status' => 1,
					'script' => '
						$(".msg-'.(int)$_GET['id'].'-'.(int)$_GET['fid'].'").remove();
						pulseInfo("Danke Dir! Der Vorgang ist abgeschlossen.");
						$(".xhrDialog").dialog("close");
						$(".xhrDialog").dialog("destroy");
						$(".xhrDialog").remove();
						'
				);
			}
		}
		
		return array(
				'status' => 1,
				'script' => 'pulseError("Es ist ein Fehler aufgetreten");'
		);
	}
}
