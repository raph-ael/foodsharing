<?php
class SettingsControl extends Control
{	
	private $foodsaver;
	
	public function __construct()
	{
		if(!S::may())
		{
			goLogin();
		}
		
		$this->model = new SettingsModel();
		$this->view = new SettingsView();
		
		parent::__construct();
		
		if(isset($_GET['newmail']))
		{
			$this->handle_newmail();
		}
		
		$this->foodsaver = $this->model->getValues(array('rolle','email','name','nachname','geschlecht','verified'), 'foodsaver', fsId());
		
		if(isset($_GET['deleteaccount']))
		{	
			libmail(array(
				'email' => $this->foodsaver['email'],
				'email_name' => $this->foodsaver['name'].' '.$this->foodsaver['nachname']
			), 'loeschen@lebensmittelretten.de', $this->foodsaver['name'].' hat Account gelöscht',$this->foodsaver['name'].' '.$this->foodsaver['nachname'].' hat Account gelöscht'."\n\nGrund für das Löschen:\n".strip_tags($_GET['reason']));
			$this->model->del_foodsaver(fsId());
			go('/?page=logout');
		}
		
		if(!isset($_GET['sub']))
		{
			go('/?page=settings&sub=general');
		}
		
		addTitle(s('settings'));
	}
	
	public function index()
	{
		addBread('Einstellungen','/?page=settings');
		
		$menu = array(
			array('name' => s('settings_general'), 'href' => '/?page=settings&sub=general'),
			array('name' => s('settings_info'), 'href' => '/?page=settings&sub=info')
			
		);

		$menu[] = array('name' => s('bcard'), 'href' => '/?page=bcard');
		//$menu[] = array('name' => s('calendar'), 'href' => '/?page=settings&sub=calendar');
				
		addContent($this->view->menu($menu,array('title'=>s('settings'),'active'=>$this->getSub())),CNT_LEFT);
		
		$menu = array();
		$menu[] = array('name' => s('sleeping_user'), 'href' => '/?page=settings&sub=sleeping');
		$menu[] = array('name' => 'E-Mail-Adresse ändern', 'click' => 'ajreq(\'changemail\');return false;');
		
		if($this->foodsaver['rolle'] == 0)
		{
			$menu[] = array('name'=>'Werde '.s('rolle_1_' . $this->foodsaver['geschlecht']),'href'=> '/?page=settings&sub=upgrade/up_fs');
		}
		else if($this->foodsaver['rolle'] == 1)
		{
			$menu[] = array('name'=>'Werde '.s('rolle_2_' . $this->foodsaver['geschlecht']),'href'=> '/?page=settings&sub=upgrade/up_bip');
		}
		$menu[] = array('name' => s('delete_account'), 'href' => '/?page=settings&sub=deleteaccount');
		addContent($this->view->menu($menu,array('title'=>s('account_option'),'active'=>$this->getSub())),CNT_LEFT);
	}
	
	public function sleeping()
	{
		if($sleep = $this->model->getSleepData())
		{
			addContent($this->view->sleepMode($sleep));
		}
	}

	public function up_bip()
	{
		if(S::may() && $this->foodsaver['rolle'] > 0)
		{
			if(!$this->foodsaver['verified'])
			{
				addContent($this->view->simpleContent($this->model->getContent(45)));
			}
			else
			{
				$model = loadModel('quiz');

				if(($status = $model->getQuizStatus(2)) && ($quiz = $model->getQuiz(2)))
				{
					if((int)$this->model->qOne('SELECT COUNT(id) FROM fs_quiz_session WHERE quiz_id = 1 AND status = 1 AND foodsaver_id = '.(int)fsId()) == 0)
					{
						fs_info('Du darfst zunächst das Foodsaver Quiz machen');
						go('/?page=settings&sub=upgrade/up_fs');
					}
					$desc = $this->model->getContent(12);

					// Quiz wurde noch gar nicht probiert
					if($status['times'] == 0)
					{
						addContent($this->view->quizIndex($quiz,$desc));
					}

					// quiz ist bereits bestanden
					else if($status['cleared'] > 0)
					{
						return $this->confirm_bip();
					}

					// es läuft ein quiz weitermachen
					else if($status['running'] > 0)
					{
						addContent($this->view->quizContinue($quiz,$desc));
					}

					// Quiz wurde shcon probiert aber noche keine 3x nicht bestanden
					else if($status['failed'] < 3)
					{
						addContent($this->view->quizRetry($quiz,$desc,$status['failed'],3));
					}

					// 3x nicht bestanden 30 Tage Lernpause
					else if($status['failed'] == 3 && (time() - $status['last_try']) < (86400*30))
					{
						$days_to_wait = ((time() - $status['last_try']) - (86400*30) / 30);
						return $this->view->pause($days_to_wait,$desc);
					}

					// Lernpause vorbei noch keine weiteren 2 Fehlversuche
					else if($status['failed'] >= 3 && $status['failed'] < 5 && (time() - $status['last_try']) >= (86400*14))
					{
						addContent($this->view->quizIndex($quiz,$desc));
					}

					// hat alles nichts genützt
					else
					{
						addContent($this->view->quizFailed($this->model->getContent(13)));
					}
				}
			}
		}
		
	}
	
	public function quizsession()
	{
		if($session = $this->model->getQuizSession($_GET['sid']))
		{
			addContent($this->view->quizSession($session,$session['try_count'],$this->model));
		}
	}
	
	public function up_fs()
	{
		if(S::may())
		{
			$model = loadModel('quiz');
				
			if(($status = $model->getQuizStatus(1)) && ($quiz = $model->getQuiz(1)))
			{
	
				$desc = $this->model->getContent(12);
	
				// Quiz wurde noch gar nicht probiert
				if($status['times'] == 0)
				{
					addContent($this->view->quizIndex($quiz,$desc));
				}
				
				// quiz ist bereits bestanden
				else if($status['cleared'] > 0)
				{
					return $this->confirm_fs();
				}
				
				// es läuft ein quiz weitermachen
				else if($status['running'] > 0)
				{
					addContent($this->view->quizContinue($quiz,$desc));
				}
				
				// Quiz wurde shcon probiert aber noche keine 3x nicht bestanden
				else if($status['failed'] < 3)
				{
					addContent($this->view->quizRetry($quiz,$desc,$status['failed'],3));
				}
	
				// 3x nicht bestanden 30 Tage Lernpause
				else if($status['failed'] == 3 && (time() - $status['last_try']) < (86400*30))
				{
					$this->model->updateRole(0,$this->foodsaver['rolle']);
					$days_to_wait = ((time() - $status['last_try']) - (86400*30) / 30);
					return $this->view->pause($days_to_wait,$desc);
				}
	
				// Lernpause vorbei noch keine weiteren 2 Fehlversuche
				else if($status['failed'] >= 3 && $status['failed'] < 5 && (time() - $status['last_try']) >= (86400*14))
				{
					addContent($this->view->quizIndex($quiz,$desc));
				}
	
				// hat alles nichts genützt
				else
				{
					addContent($this->view->quizFailed($this->model->getContent(13)));
				}
			}
		}
	}
	
	public function up_bot()
	{
		if(S::may() && $this->foodsaver['rolle'] >= 2)
		{
			$model = loadModel('quiz');
			
			if(($status = $model->getQuizStatus(3)) && ($quiz = $model->getQuiz(3)))
			{
				
				$desc = $this->model->getContent(12);
				
				// Quiz wurde noch gar nicht probiert
				if($status['times'] == 0)
				{
					addContent($this->view->quizIndex($quiz,$desc));
				}
				
				// es läuft ein quiz weitermachen
				else if($status['running'] > 0)
				{
					addContent($this->view->quizContinue($quiz,$desc));
				}
				
				// quiz ist bereits bestanden
				else if($status['cleared'] > 0)
				{
					return $this->confirm_bot();
				}
				
				// Quiz wurde shcon probiert aber noche keine 3x nicht bestanden
				else if($status['failed'] < 3)
				{
					addContent($this->view->quizRetry($quiz,$desc,$status['failed'],3));
				}
				
				// 3x nicht bestanden 30 Tage Lernpause
				else if($status['failed'] == 3 && (time() - $status['last_try']) < (86400*30))
				{
					$days_to_wait = ((time() - $status['last_try']) - (86400*30) / 30);
					return $this->view->pause($days_to_wait,$desc);
				}
				
				// Lernpause vorbei noch keine weiteren 2 Fehlversuche
				else if($status['failed'] >= 3 && $status['failed'] < 5 && (time() - $status['last_try']) >= (86400*14))
				{
					addContent($this->view->quizIndex($quiz,$desc));
				}
				
				// hat alles nichts genützt
				else
				{
					return $this->view->quizFailed($this->model->getContent(13));
				}
			}
			else
			{
				addContent(v_info('Fehler! Quizdaten Für Deine Rolle konnten nicht geladen werden. Bitte wende Dich an den IT-Support:<a href=mailto:it@'.DEFAULT_HOST.'"">it@'.DEFAULT_HOST.'</a>'));
			}
		}
		else
		{
			switch ($this->foodsaver['rolle'])
			{
				case 0:
					fs_info('Du musst erst Foodsaver werden');
					go('/?page=settings&sub=upgrade/up_fs');
					break;
					
				case 1:
					fs_info('Du musst erst BetriebsverantwortlicheR werden');
					go('/?page=settings&sub=upgrade/up_bip');
					break;
					
				default:
					go('/?page=settings');
					break;
			}
		}
	}
	
	private function confirm_fs()
	{
		if($this->model->hasQuizCleared(1))
		{
			if($this->isSubmitted())
			{
				if(empty($_POST['accepted']))
				{
					$check = false;
					error(s('not_rv_accepted'));
				}
				else
				{
					S::set('hastodoquiz',false);
					Mem::delPageCache('/dashboard');
					if(!S::may('fs'))
					{
						$this->model->updateRole(1,$this->foodsaver['rolle']);
					}
					fs_info('Danke! Du bist jetzt Foodsaver');
					go('/?page=relogin&url=' . urlencode('/dashboard'));
				}
			}
			$cnt = $this->model->getContent(14);
			$rv = $this->model->getContent(30);
			addContent($this->view->confirmFs($cnt,$rv));
		}
	}
	
	private function confirm_bip()
	{
		if($this->model->hasQuizCleared(2))
		{
			if($this->isSubmitted())
			{
				if(empty($_POST['accepted']))
				{
					$check = false;
					error(s('not_rv_accepted'));
				}
				else
				{
					$this->model->updateRole(2,$this->foodsaver['rolle']);
					fs_info('Danke! Du bist jetzt Betriebsverantwortlicher');
					go('/?page=relogin&url=' . urlencode('/dashboard'));
				}
			}
			$cnt = $this->model->getContent(15);
			$rv = $this->model->getContent(31);
			addContent($this->view->confirmBip($cnt,$rv));
		}
	}
	
	private function confirm_bot()
	{

		addBread('Botschafter werden');
		
		if($this->model->hasQuizCleared(3))
		{
		
			$showform = true;

			$rolle = 3;
		
			if(submitted())
			{
				global $g_data;
				$g_data = $_POST;
		
				$check = true;
				if(!isset($_POST['photo_public']))
				{
					$check = false;
					error('Du musst dem zustimmen das wir Dein Foto veröffentlichen dürfen');
				}
		
				if(empty($_POST['about_me_public']))
				{
					$check = false;
					error('Deine Kurzbeschreibung ist leer');
				}
		
				if(!isset($_POST['tel_public']))
				{
					$check = false;
					error('Du musst dem zustimmen das wir Deine Telefonnummer veröffentlichen');
				}
		
				if(!isset($_POST['rv_botschafter']))
				{
					$check = false;
					error(s('not_rv_accepted'));
				}
		
				if((int)$_POST['bezirk'] == 0)
				{
					$check = false;
					error('Du hast keinen Bezirk gewählt in dem Du Botschafter werden möchtest');
				}
		
				if($check)
				{
					$data = unsetAll($_POST, array('photo_public','new_bezirk'));
					$this->model->updateFields($data, 'foodsaver', fsId());
		
					addContent(v_field(
						v_info(s('upgrade_bot_success')),
						s('upgrade_request_send'),
						array(
							'class' => 'ui-padding'
						)
					));
					

					$g_data = array();
					$showform = false;
				}
			}
		
			if($showform)
			{
				addJs('$("#upBotsch").submit(function(ev){
					check = true;
					if($("#bezirk").val() == 0)
					{
						check = false;
						error("Du musst einen bezirk ausw&auml;hlen");
					}
				
					if(!check)
					{
						ev.preventDefault();
					}
				
				});');
				
				// Rechtsvereinbarung
				
				$rv = $this->model->getContent(32);
				
				addContent(
						
				$this->view->confirmBot($this->model->getContent(16)) .
				
				v_form('upBotsch', array( v_field(
				v_bezirkChooser('bezirk',getBezirk(),array('label'=>'In welcher Region möchtest Du Botschafter werden?')).
				'<div style="display:none" id="bezirk-notAvail">'.v_form_text('new_bezirk').'</div>'.
				v_form_select('time',array('values'=>array(
				array('id'=>1,'name' => '3-5 Stunden'),
				array('id'=>2,'name' => '5-8 Stunden'),
				array('id'=>3,'name' => '9-12 Stunden'),
				array('id'=>4,'name' => '13-15 Stunden'),
				array('id'=>5,'name' => '15-20 Stunden')
				))).
				v_form_radio('photo_public',array('required'=>true,'values' => array(
				array('id'=>1,'name'=>'Ich bin einverstanden das Mein Name und Mein Foto veröffentlicht werden'),
				array('id'=>2,'name'=>'Bitte NUR meinen Namen veröffentlichen')
				))).
				v_form_checkbox('tel_public',array('desc'=>'Neben Deinem vollem Namen (und eventuell Foto) ist es für
										Händler, Foodsharing-Freiwillge, Interessierte und die Presse
										einfacher und direkter, Dich neben der für Deine
										Region/Stadt/Bezirk zugewiesenen Botschafter-E-Mail-Adresse (z. B. mainz@lebensmittelretten.de)
										über Deine Festnetz- bzw. Handynummer zu erreichen. Bitte gib
										hier alle Nummern an, die wir veröffentlichen dürfen und am
										besten noch gewünschte Anrufzeiten.','required'=>true,'values' => array(
												array('id'=>1,'name'=>'Ich bin einverstanden, dass meine Telefonnummer veröffentlicht wird.')
				))).
				v_form_textarea('about_me_public',array('desc'=>'Um möglichst transparent, aber auch offen, freundlich, seriös
										und einladend gegenüber den Lebensmittelbetrieben, den
										Foodsavern sowie allen, die bei foodsharing mitmachen wollen,
										aufzutreten, wollen wir neben Deinem Foto, Namen und
										Telefonnummer auch eine Beschreibung Deiner Person als Teil von
										foodsharing mit aufnehmen. Bitte fass Dich also relativ kurz,
										hier unsere Vorlage: <a target="_blank"	href="http://www.lebensmittelretten.de/?p=botschafter">http://www.lebensmittelretten.de/botschafter</a>
										Gerne kannst Du auch Deine Website, Projekt oder sonstiges
										erwähnen, was Du öffentlich an Informationen teilen möchtest,
										die vorteilhaft sind.'))
												,'Botschafter werden',array('class'=>'ui-padding')),
													
													
										v_field($rv['body'].v_form_checkbox('rv_botschafter',array('required'=>true,'values' => array(
										array('id' => 1,'name' => s('rv_accept'))
										))), $rv['title'],array('class'=>'ui-padding'))													
												
				),array('submit'=>'Antrag auf Botschafterrolle verbindlich absenden'))
				);
			}
		}
	}
	
	public function deleteaccount()
	{
		addBread(s('delete_account'));
		addContent($this->view->delete_account());
	}
	
	public function general()
	{
		
		$this->handle_edit();
		
		$data = $this->model->getOne_foodsaver(fsId());
		
		setEditData($data);
			
		addContent($this->view->foodsaver_form());
		
		addContent($this->picture_box(),CNT_RIGHT);

	}
	
	public function calendar()
	{
		addBread(s('calendar'));
		$token = generate_api_token(fsId());
		addContent($this->view->settingsCalendar($token));
	}

	public function info()
	{
		global $g_data;
		if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'settingsinfo')
		{
			$nl = 1;
			if($_POST['newsletter'] != 1)
			{
				$nl = 0;
			}
			$infomail = 1;
			if($_POST['infomail_message'] != 1)
			{
				$infomail = 0;
			}
			$unfollow_fairteiler = array();
			$unfollow_thread = array();
			foreach ($_POST as $key => $p)
			{
				if(substr($key, 0,11) == 'fairteiler_')
				{
					$ft = (int)substr($key, 11);
					if($ft > 0)
					{
						if($p == 0)
						{
							$unfollow_fairteiler[] = $ft;
						}
						elseif($p < 4)
						{
							$this->model->updateFollowFairteiler($ft, $p);
						}
					}
				}
				else if(substr($key, 0,7) == 'thread_')
				{
					$ft = (int)substr($key, 7);
					if($ft > 0)
					{
						if($p == 0)
						{
							$unfollow_thread[] = $ft;
						}
						elseif($p < 4)
						{
							$this->model->updateFollowThread($ft, $p);
						}
					}
				}
			}
			
			if(!empty($unfollow_fairteiler))
			{
				$this->model->unfollowFairteiler($unfollow_fairteiler);
			}
			if(!empty($unfollow_thread))
			{
				$this->model->unfollowThread($unfollow_thread);
			}
			
			if($this->model->saveInfoSettings($nl,$infomail))
			{
				fs_info(s('changes_saved'));
			}
		}
		addBread(s('settings_info'));
		
		$g_data = $this->model->getValues(array('infomail_message','newsletter'), 'foodsaver', fsId());
		
		$fairteiler = $this->model->getFairteiler();
		$threads = $this->model->getForumThreads();
		
		addContent($this->view->settingsInfo($fairteiler,$threads));
	}
	
	public function handle_edit()
	{		
		if(submitted())
		{
			$data = getPostData();
			$data['stadt'] = $data['ort']; 
			$check = true;
			
			if($data['homepage'] != '')
			{
				if(substr($data['homepage'],0,4) != 'http')
				{
					$data['homepage'] ='http://' . $data['homepage'];
				}
					
				if(!validUrl($data['homepage']))
				{
					$check = false;
					error('Mit Deiner Homepage URL stimmt etwas nicht');
				}	
			}
			
			if(isset($data['github']) && $data['github'] != '')
			{
				if(substr($data['github'],0,19) != 'https://github.com/')
				{
					$data['github'] ='https://github.com/' . $data['github'];
				}
					
				if(!validUrl($data['github']))
				{
					$check = false;
					error('Mit Deiner github URL stimmt etwas nicht');
				}	
			}
			else
            {
			    $data['github'] = '';
            }
			
			if(isset($data['twitter']) && $data['twitter'] != '')
			{
				if(substr($data['twitter'],0,20) != 'https://twitter.com/')
				{
					$data['twitter'] ='https://twitter.com/' . $data['twitter'];
				}
					
				if(!validUrl($data['twitter']))
				{
					$check = false;
					error('Mit Deiner twitter URL stimmt etwas nicht');
				}
			}
            else
            {
                $data['twitter'] = '';
            }
			
			if($data['tox'] != '')
			{
				$data['tox'] = preg_replace('/[^0-9A-Z]/','',$data['tox']);
			}
			
			if($check)
			{
				if($oldFs = $this->model->getOne_foodsaver(fsId()))
				{
					$logChangedFields = array('stadt', 'plz', 'anschrift', 'telefon', 'handy', 'geschlecht', 'geb_datum');
					$this->model->logChangedSetting(fsId(), $oldFs, $data, $logChangedFields);
				}

				if($this->model->updateProfile(fsId(),$data))
				{
					fs_info(s('foodsaver_edit_success'));
				}
				else
				{
					error(s('error'));
				}
			}
		}
	}
	
	public function picture_box()
	{
		$photo = $this->model->getPhoto(fsId());
		
		if(!(file_exists(PUBLIC_IMAGES_DIR . '/thumb_crop_'.$photo)))
		{
			$p_cnt = v_photo_edit('img/portrait.png');
		}
		else
		{
			$p_cnt = v_photo_edit('images/thumb_crop_'.$photo);
		}
		
		return v_field($p_cnt, 'Dein Foto');
	}
	
	private function handle_newmail()
	{
		if($email = $this->model->getNewMail($_GET['newmail']))
		{
			addJs("ajreq('changemail3');");
		}
	}

	private function upgrade()
	{
		/* This needs to be here for routing of upgrade/ to work. Do not remove! */
	}
}
