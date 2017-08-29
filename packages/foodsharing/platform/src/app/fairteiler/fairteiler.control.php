<?php
class FairteilerControl extends Control
{	
	
	private $bezirk_id;
	private $bezirk;
	private $fairteiler;
	private $follower;
	private $bezirke;
	
	public function __construct()
	{
		if(isset($_GET['uri']) && ($ftid = $this->uriInt(2)))
		{
			go('/?page=fairteiler&sub=ft&id=' . $ftid);
		}
		
		$this->model = new FairteilerModel();
		$this->view = new FairteilerView();
		
		parent::__construct();
		
		/*
		 * allowed only for logged in users
		 */
		if(!S::may() && isset($_GET['sub']) && $_GET['sub'] != 'ft')
		{
			goLogin();
		}
		
		if(isset($_GET['bid']) && (int)$_GET['bid'] > 0)
		{
			if($bezirk = $this->model->getBezirk($_GET['bid']))
			{
				$this->bezirk_id = (int)$_GET['bid'];
				$this->bezirk = $bezirk;
				if((int)$bezirk['mailbox_id'] > 0)
				{
					$this->bezirk['urlname'] = $this->model->getVal('name', 'mailbox', $bezirk['mailbox_id']);
				}
				else
				{
					$this->bezirk['urlname'] = id($this->bezirk['name']);
				}
			}
		}
		else
		{
			$this->bezirk_id = 0;
			$this->bezirk = false;
		}
		$this->bezirke = $this->model->getRealBezirke();
		$this->view->setBezirke($this->bezirke);
		
		$this->view->setBezirk($this->bezirk);
		
		$this->fairteiler = false;
		$this->follower = false;
		if(isset($_GET['id']))
		{
			$this->fairteiler = $this->model->getFairteiler($_GET['id']);
			
			if(!$this->fairteiler)
			{
				go('/?page=fairteiler');
			}
			if(isset($_GET['follow']))
			{
				if($_GET['follow'] == 1)
				{
					$info = 2;
					if(isset($_GET['infotype']) && $_GET['infotype'] == 1)
					{
						$info = 1;
					}
					$this->model->follow($_GET['id'],$info);
				}
				else
				{
					$this->model->unfollow($_GET['id']);
				}
				$url = explode('&follow=', getSelf());
				go($url[0]);
			}
			
			
			$this->follower = $this->model->getFollower($_GET['id']);
			$this->view->setFairteiler($this->fairteiler,$this->follower);

			
			$this->fairteiler['urlname'] = str_replace(' ', '_', $this->fairteiler['name']);
			$this->fairteiler['urlname'] = id($this->fairteiler['urlname']);
			$this->fairteiler['urlname'] = str_replace('_', '-', $this->fairteiler['urlname']);
				
			addHidden('
				<a href="#ft-fbshare" id="ft-public-link" target="_blank">&nbsp;</a>
				<input type="hidden" name="ft-name" id="ft-name" value="'.$this->fairteiler['name'].'" />
				<input type="hidden" name="ft-id" id="ft-id" value="'.$this->fairteiler['id'].'" />
				<input type="hidden" name="ft-urlname" id="ft-urlname" value="'.$this->fairteiler['urlname'].'" />
				<input type="hidden" name="ft-bezirk" id="ft-bezirk" value="'.$this->bezirk['urlname'].'" />
				<input type="hidden" name="ft-publicurl" id="ft-publicurl" value="http://www.'.DEFAULT_HOST.'/'.$this->bezirk['urlname'].'/fairteiler/'.$this->fairteiler['id'].'_'.$this->fairteiler['urlname'].'" />
				');
			
			if(isset($_GET['delete']) && (isOrgaTeam() || isBotFor($this->bezirk_id)))
			{
				if($this->model->deleteFairteiler($this->fairteiler['id']))
				{
					fs_info(s('delete_success'));
					go('/?page=fairteiler&bid='.$this->bezirk_id);
				}
			}
		}
	}
	
	public function index()
	{
		addBread(s('your_fairteiler'),'/?page=fairteiler');
		if($this->bezirk_id > 0)
		{
			addBread($this->bezirk['name'],'/?page=fairteiler&bid='.$this->bezirk_id);
		}
		if(!isset($_GET['sub']))
		{
			$items = array();
			if($bezirke = $this->model->getBezirke())
			{
				foreach ($bezirke as $b)
				{
					$items[] = array('name'=>$b['name'],'href'=>'/?page=fairteiler&bid='.$b['id']);
				}
			}
			
			if($fairteiler = $this->model->listFairteiler($this->bezirk_id))
			{
				addContent($this->view->listFairteiler($fairteiler));
			}
			else
			{
				addContent(v_info(s('no_fairteiler_available')));
			}
			addContent($this->view->ftOptions($this->bezirk_id),CNT_RIGHT);
		}
		
		
	}
	
	public function edit()
	{
		addBread($this->fairteiler['name'],'/?page=fairteiler&sub=ft&bid='.$this->bezirk_id.'&id='.$this->fairteiler['id']);
		addBread(s('edit'));
		if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'fairteiler')
		{
			if($this->handleEditFt())
			{
				fs_info(s('fairteiler_edit_success'));
				go(getSelf());
			}
			else
			{
				error(s('fairteiler_edit_fail'));
			}
		}
		
		$data = $this->fairteiler;
		$items = array(
			array('name' => s('back'),'href'=>'/?page=fairteiler&sub=ft&bid='.$this->bezirk_id.'&id='.$this->fairteiler['id'])
		);
		
		if(isOrgaTeam() || isBotFor($this->bezirk_id))
		{
			$items[] = array('name' => s('delete'),'click'=>'if(confirm(\''.sv('delete_sure',$this->fairteiler['name']).'\')){goTo(\'/?page=fairteiler&sub=ft&bid='.$this->bezirk_id.'&id='.$this->fairteiler['id'].'&delete=1\');}return false;');
		}

		$data['bfoodsaver'] = $this->follower['verantwortlich'];

		if(!empty($data['bfoodsaver']))
        {
            foreach ($data['bfoodsaver'] as $key => $fs)
            {
                $data['bfoodsaver'][$key]['name'] = $fs['name'].' '.$fs['nachname'];
            }
        }
		
		$data['bfoodsaver_values'] = $this->model->getFsAutocomplete($this->model->getBezirke());
		
		addContent($this->view->options($items),CNT_RIGHT);
		
		addContent($this->view->fairteilerForm($data));
	}
	
	public function check()
	{
		
		if($ft = $this->model->getFairteiler($_GET['id']))
		{
			if(isOrgaTeam() || isBotFor($ft['bezirk_id']))
			{
				if(isset($_GET['agree']))
				{
					if($_GET['agree'] == 1)
					{
						$this->model->acceptFairteiler($_GET['id']);
						fs_info('Fair-Teiler ist jetzt aktiv');
						go('/?page=fairteiler&sub=ft&id='.(int)$_GET['id']);
					}
					else if($_GET['agree'] == 0)
					{
						$this->model->deleteFairteiler($_GET['id']);
						fs_info('Fair-Teiler wurde gelöscht');
						go('/?page=fairteiler');
					}
				}
					
				addContent($this->view->checkFairteiler($ft));
				addContent($this->view->menu(array(
				array('href' => '/?page=fairteiler&sub=check&id='.(int)$ft['id'].'&agree=1','name' => 'Fair-Teiler freischalten'),
				array('click' => 'if(confirm(\'Achtung! Wenn Du den Fair-Teiler löschst kannst Du dies nicht mehr rückgängig machen. Fortfahren?\')){goTo(this.href);}else{return false;}','href'=>'/?page=fairteiler&sub=check&id='.(int)$ft['id'].'&agree=0','name' => 'Fair-Teiler ablehnen')
				),array('title' => 'Optionen')),CNT_RIGHT);
			}
			else
			{
				goPage('fairteiler');
			}
			
		}
		else
		{
			goPage('fairteiler');
		}
	}
	
	public function ft()
	{
		addBread($this->fairteiler['name']);
		addTitle($this->fairteiler['name']);
		addContent(
			$this->view->fairteilerHead().'
			<div>
				'.v_info('Beachte, dass Deine Beiträge auf der Fair-Teiler Pinnwand öffentlich einsehbar sind.','Hinweis!').'
			</div>
			<div class="ui-widget ui-widget-content ui-corner-all margin-bottom">
				'.$this->wallposts('fairteiler',$this->fairteiler['id']).'
			</div>'
		);
		
		if(S::may())
		{
			$items = array();
			
			if($this->mayEdit())
			{
				$items[] = array('name' =>s('edit'),'href'=>'/?page=fairteiler&bid='.$this->bezirk_id.'&sub=edit&id='.$this->fairteiler['id']);
			}
			
			if($this->isFollower())
			{
				$items[] = array('name' => s('no_more_follow'),'href' => getSelf().'&follow=0');
			}
			else
			{
				$items[] = array('name' => s('follow'),'click' => 'u_follow();return false;');
				addHidden($this->view->followHidden());
			}
			
			addContent($this->view->options($items),CNT_LEFT);
			addContent($this->view->follower(),CNT_LEFT);
		}
		else
		{
			addContent($this->view->loginToFollow(),CNT_LEFT);
		}
		
		addContent($this->view->desc(),CNT_RIGHT);
		addContent($this->view->address(),CNT_RIGHT);
		
	}
	
	public function addFt()
	{
		addBread(s('add_fairteiler'));
	
		if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'fairteiler')
		{
			if($this->handleAddFt())
			{
				if(isBotFor($this->bezirk_id) || isOrgaTeam())
				{
					fs_info(s('fairteiler_add_success'));
				}
				else
				{
					fs_info(s('fairteiler_prepare_success'));
				}
				go('/?page=fairteiler&bid='.(int)$this->bezirk_id);
			}
			else
			{
				error(s('fairteiler_add_fail'));
			}
		}
		
		addContent($this->view->fairteilerForm());
		addContent(v_menu(array(
		array('name'=>s('back'),'href' => '/?page=fairteiler&bid='.(int)$this->bezirk_id.'')
		),s('options')),CNT_RIGHT);
	}
	
	private function handleEditFt()
	{
		if($this->mayEdit())
		{			
			$name = strip_tags($_POST['name']);
			$desc = strip_tags($_POST['desc']);
			$anschrift = strip_tags($_POST['anschrift']);
			$plz = preg_replace('[^0-9]', '', $_POST['plz']);
			$ort = strip_tags($_POST['ort']);
			$picture = strip_tags($_POST['picture']);
			$bezirk_id = (int)$_POST['bezirk_id'];
			if(!empty($_POST['lat']) && !empty($_POST['lon']) && $bezirk_id > 0)
			{
				$lat = $_POST['lat'];
				$lon = $_POST['lon'];
				
				handleTagselect('bfoodsaver');
				
				$this->model->updateVerantwortliche($this->fairteiler['id']);
				return $this->model->updateFairteiler($this->fairteiler['id'],$bezirk_id, $name, $desc, $anschrift, $plz, $ort, $lat, $lon, $picture);
			}
			else
			{
				return false;
			}
		}
	}
	
	public function handleAddFt()
	{
		$name = strip_tags($_POST['name']);
		$desc = strip_tags($_POST['desc']);
		$anschrift = strip_tags($_POST['anschrift']);
		$plz = preg_replace('[^0-9]', '', $_POST['plz']);
		$ort = strip_tags($_POST['ort']);
		$picture = strip_tags($_POST['picture']);
		$bezirk_id = (int)$_POST['bezirk_id'];
		if(!empty($_POST['lat']) && !empty($_POST['lon']) && $bezirk_id > 0)
		{
			$lat = $_POST['lat'];
			$lon = $_POST['lon'];
				
				
			$status = 0;
			if(isBotFor($this->bezirk_id) || isOrgaTeam())
			{
				$status = 1;
			}
				
			return $this->model->addFairteiler($bezirk_id, $name, $desc, $anschrift, $plz, $ort, $lat, $lon, $picture,$status);
		}
		else
		{
			return false;
		}
	}
	
	private function isFollower()
	{
		if(isset($this->follower['all'][fsId()]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function mayEdit()
	{
		if(
				isBotFor($this->bezirk_id) || 
				isOrgaTeam() || 
				(
					isset($this->follower['all'][fsId()]) && 
					$this->follower['all'][fsId()] == 'verantwortlich')
				)
		{
			return true;
		}
		return false;
	}
}
