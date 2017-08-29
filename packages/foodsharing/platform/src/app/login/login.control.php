<?php

use Illuminate\Support\Facades\Storage;

class LoginControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new LoginModel();
		$this->view = new LoginView();
		
		parent::__construct();
		
	}
	
	public function unsubscribe()
	{
		addTitle('Newsletter Abmeldung');
		addBread('Newsletter Abmeldung');
		if(isset($_GET['e']) && validEmail($_GET['e']))
		{
			$this->model->update("UPDATE `".PREFIX."foodsaver` SET newsletter=0 WHERE email='".$this->model->safe($_GET['e'])."'");
			addContent(v_info('Du wirst nun keine weiteren Newsletter von uns erhalten','Erfolg!'));
			file_put_contents('../unsubscribe.txt',$_GET['e']."\n",FILE_APPEND);
		}
	}
	
	public function index()
	{
		if(!S::may())
		{
			if(!isset($_GET['sub']))
			{
				if(isset($_POST['email_adress']))
				{
					$this->handleLogin();
				}
				$ref = false;
				if(isset($_GET['ref']))
				{
					$ref = urldecode($_GET['ref']);
				}
				addContent($this->view->login($ref));
			}
		}
		else
		{
			if(!isset($_GET['sub']) || $_GET['sub'] != 'unsubscribe')
			{
				go('/dashboard');
			}
		}
	}
	
	public function activate()
	{
		if($this->model->activate($_GET['e'],$_GET['t']))
		{
			fs_info(s('activation_success'));
			goPage('login');
		}
		else 
		{
			error(s('activation_failed'));
			goPage('login');
		}
	}
	
	private function handleLogin()
	{
		if($this->model->login($_POST['email_adress'],$_POST['password']))
		{
			$this->genSearchIndex();

			if(isset($_POST['ismob']))
			{
				$_SESSION['mob'] = (int)$_POST['ismob'];
			}
			
			require_once 'lib/Mobile_Detect.php';
			$mobdet = new Mobile_Detect();
			if($mobdet->isMobile())
			{
				$_SESSION['mob'] = 1;
			}
			
			if((isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],URL_INTERN) !== false) || isset($_GET['logout']))
			{
				if(isset($_GET['ref']))
				{
					go(urldecode($_GET['ref']));
				}
				go(str_replace('/login?logout','/dashboard',$_SERVER['HTTP_REFERER']));
			}
			else
			{
				go('/dashboard');
			}
			
			
		}
		else
		{
			error('Falsche Zugangsdaten');
		}
	}
	
	public function passwordReset()
	{
		$k = false;
		
		if(isset($_GET['k']))
		{
			$k = strip_tags($_GET['k']);
		}
		
		addTitle('Password zurücksetzen');
		addBread('Passwort zurücksetzen');
		
		if(isset($_POST['email']) || isset($_GET['m']))
		{
			$mail = '';
			if(isset($_GET['m']))
			{
				$mail = $_GET['m'];
			}
			else
			{
				$mail = $_POST['email'];
			}
			if(!validEmail($mail))
			{
				error('Sorry! Hast Du Dich vielleicht bei Deiner E-Mail-Adresse vertippt?');
			}
			else
			{
				if($this->model->addPassRequest($mail))
				{
					fs_info('Alles klar! Dir wurde ein Link zum Passwortändern per E-Mail zugeschickt.');
				}
				else
				{
					error('Sorry, diese E-Mail-Adresse ist uns nicht bekannt.');
				}
			}
		}
		
		if($k !== false && $this->model->checkResetKey($k))
		{
			if($this->model->checkResetKey($k))
			{
				if(isset($_POST['pass1']) && isset($_POST['pass2']))
				{
					if($_POST['pass1'] == $_POST['pass2'])
					{
						$check = true;
						if($this->model->newPassword($_POST))
						{
							success('Prima, Dein Passwort wurde erfolgreich geändert. Du kannst Dich jetzt Dich einloggen.');
						}
						elseif(strlen($_POST['pass1']) < 5)
						{
							$check = false;
							error('Sorry, Dein gewähltes Passwort ist zu kurz.');
						}
						elseif(!$this->model->checkResetKey($_POST['k']))
						{
							$check = false;
							error('Sorry, Du hast zu lang gewartet. Bitte beantrage noch einmal ein neues Passwort!');
						}
						else
						{
							$check = false;
							error('Sorry, es gibt ein Problem mir Deinen Daten. Ein Administrator wurde informiert.');
							/*
							tplMail(11, 'kontakt@prographix.de',array(
								'data' => '<pre>'.print_r($_POST,true).'</pre>'
							));
							*/
						}
						
						if($check)
						{
							go('/login');
						}
					}
					else
					{
						error('Sorry, die Passwörter stimmen nicht überein.');
					}
				}
				addJs('$("#pass1").val("");');
				addContent($this->view->newPasswordForm($k));
			}
			else
			{
		
				$this->template->addLeft($this->view->error('Sorry, Du hast ein bisschen zu lange gewartet. Bitte beantrage ein neues Passwort!'));
				$this->template->addLeft($this->view->passwordRequest());
			}
		}
		else
		{
			addContent($this->view->passwordRequest());
		}
	}
	
	/**
	 * Method to generate search Index for instant seach
	 */
	private function genSearchIndex()
	{
		/*
		 * The big array we want to fill ;)
		*/
		$index = array();
	
		/*
		 * Buddies Load persons in the index array that connected with the user
		*/
	
		$model = loadModel('buddy');
		if($buddies = $model->listBuddies())
		{
			$result = array();
			foreach ($buddies as $b)
			{
				$img = '/img/avatar-mini.png';
	
				if(!empty($b['photo']))
				{
					$img = img($b['photo']);
				}
	
				$result[] = array(
						'name' => $b['name'].' '.$b['nachname'],
						'teaser' => '',
						'img' => $img,
						'click' => 'chat(\''.$b['id'].'\');',
						'id' => $b['id'],
						'search' => array(
								$b['name'],$b['nachname']
						)
				);
			}
			$index[] = array(
					'title' => 'Menschen die Du kennst',
					'key' => 'buddies',
					'result' => $result
			);
		}
	
		/*
		 * Groups load Groups connected to the user in the array
		*/
		$model = loadModel('groups');
		if($groups = $model->listMyGroups())
		{
			$result = array();
			foreach ($groups as $b)
			{
				$img = '/img/groups.png';
				if(!empty($b['photo']))
				{
					$img = 'images/' . str_replace('photo/','photo/thumb_',$b['photo']);
				}
				$result[] = array(
						'name' => $b['name'],
						'teaser' => tt($b['teaser'],65),
						'img' => $img,
						'href' => '/?page=bezirk&bid='.$b['id'].'&sub=forum',
						'search' => array(
								$b['name']
						)
				);
			}
			$index[] = array(
					'title' => 'Deine Gruppen',
					'result' => $result
			);
		}
	
		/*
		 * Betriebe load food stores connected to the user in the array
		*/
		$model = loadModel('betrieb');
		if($betriebe = $model->listMyBetriebe())
		{
			$result = array();
			foreach ($betriebe as $b)
			{
				$result[] = array(
						'name' => $b['name'],
						'teaser' => $b['str'].' '.$b['hsnr'].', '.$b['plz'].' '.$b['stadt'],
						'href' => '/?page=fsbetrieb&id='.$b['id'],
						'search' => array(
								$b['name'],$b['str']
						)
				);
			}
			$index[] = array(
					'title' => 'Deine Betriebe',
					'result' => $result
			);
		}
	
		/*
		 * Bezirke load Bezirke connected to the user in the array
		*/
		$model = loadModel('bezirk');
		if($bezirke = $model->listMyBezirke())
		{
			$result = array();
			foreach ($bezirke as $b)
			{
				$result[] = array(
						'name' => $b['name'],
						'teaser' => '',
						'img' => false,
						'href' => '/?page=bezirk&bid='.$b['id'].'&sub=forum',
						'search' => array(
								$b['name']
						)
				);
			}
			$index[] = array(
					'title' => 'Deine Bezirke',
					'result' => $result
			);
		}
	
		/*
		 * Get or set an individual token as filename for the public json file
		*/
		if($token = S::user('token'))
		{
            Storage::disk('searchindex')->put($token . '.json', json_encode($index));
			return $token;
		}
	
	
		return false;
	}
}
