<?php
class BezirkControl extends Control
{
	private $bezirk_id;
	private $bezirk;
	private $bot_theme;
	private $mode;
	private $themes_per_page;
	protected $model;
    protected $view;
	
	public function __construct()
	{
		$this->themes_per_page = 15;
		$this->mode = 'normal';
		$this->model = new BezirkModel($this->themes_per_page);
		$this->view = new BezirkView($this->themes_per_page);
		$this->view->setMode($this->mode);
		parent::__construct();
		
		if(!S::may())
		{
			goLogin();
		}
		
		$this->bezirk_id = false;
		if(($this->bezirk_id = getGetId('bid')) === false)
		{
			$this->bezirk_id = getBezirkId();
		}
		
		if(!mayBezirk($this->bezirk_id))
		{
			go('/dashboard');
		}
		
		$this->bezirk = false;
		if($bezirk = $this->model->getBezirk($this->bezirk_id))
		{
			$big = array(8=>1,5=>1,6=>1);
			if(isset($big[$bezirk['type']]))
			{
				$this->mode = 'big';
				
			}
			elseif ($bezirk['type'] == 7)
			{
				$this->mode = 'orgateam';
			}
			$this->view->setMode($this->mode);
			$this->bezirk = $bezirk;
		}
		
		$this->view->setBezirk($this->bezirk);
		
		$this->bot_theme = 0;
		if($this->getSub() == 'botforum')
		{
			$this->bot_theme = 1;
		}

		
		if($this->bot_theme == 1)
		{
			if(isBotFor($this->bezirk_id) || isOrgaTeam())
			{
				
			}
			else
			{
				go('/?page=bezirk&bid='.$this->bezirk_id.'&sub=forum');
			}
		}
		
		$this->model->setBezirk($this->bezirk);
		
	}
	
	public function index()
	{		
		if($this->model->mayBezirk($this->bezirk_id) && $this->bezirk !== false)
		{
			if($this->mode == 'orgateam')
			{
				return $this->orgateam();
			}
			else
			{
				return $this->normal();
			}
		}
	}
	
	public function normal()
	{
		if(!isset($_GET['sub']))
		{
			go('/?page=bezirk&bid='.$this->bezirk_id.'&sub=forum');
		}
		
		addTitle($this->bezirk['name']);
		
		$bezirk = $this->bezirk;
		if(isBotFor($this->bezirk_id) || isOrgaTeam())
		{
			$this->bezirkRequests();
		}
		addBread($bezirk['name'],'/?page=bezirk&bid='.(int)$this->bezirk_id);
		addContent($this->view->top(),CNT_TOP);
		
		$menu = array();
		
		$menu[] = array('name'=>'Forum', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=forum');
		$menu[] = array('name'=>'Termine', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=events');
		
		if(isBotFor($this->bezirk_id) || isOrgaTeam())
		{
			$menu[] = array('name'=>'Botschafter Forum', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=botforum');
		}
			
		$menu[] =  array('name'=>'Fair-Teiler', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=fairteiler');

		$menu[] = array('name' => 'Arbeitsgruppen', 'href' => '/groups?p='.(int)$this->bezirk_id);
			
		addContent($this->view->menu($menu,array('active'=>$this->getSub())),CNT_LEFT);
		
			
		addContent(
			v_field($this->view->fsAvatarList($bezirk['botschafter'],array(
			'scroller' => false
			)), 'Botschafter für '.$bezirk['name']),
			CNT_LEFT
		);
			
		addContent(
			v_field($this->view->fsAvatarList($bezirk['foodsaver']), count($bezirk['foodsaver']).' aktive Foodsaver in '.$bezirk['name']),
			CNT_LEFT
		);
		
		if($this->bezirk['sleeper'])
		{
			addContent(
			v_field($this->view->fsAvatarList($bezirk['sleeper']), count($bezirk['sleeper']).' Schlafmützen in '.$bezirk['name']),
			CNT_LEFT
			);
		}
			
			
		addContent(
			$this->view->signout($this->bezirk),
			CNT_LEFT
		);
	}
	
	public function orgateam()
	{
		if(!isset($_GET['sub']))
		{
			go('/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=wall');
		}
		
		$bezirk = $this->bezirk;
		$menu = array();
		
		addTitle($this->bezirk['name']);
		
		if(isBotFor($this->bezirk_id) || isOrgaTeam())
		{
			if($requests = $this->model->getBezirkRequests($this->bezirk_id))
			{
				$menu[] = array('name'=>'Bewerbungen <strong>('.count($requests).')</strong>', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=applications');
			}
		}
		addBread($bezirk['name'],'/?page=bezirk&bid='.(int)$this->bezirk_id);
		addContent($this->view->topOrga(),CNT_TOP);
		
		
		$menu[] = array('name'=>'Pinnwand', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=wall');
		$menu[] = array('name'=>'Forum', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=forum');
		$menu[] = array('name'=>'Termine', 'href'=>'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=events');

		if(S::may('orga') || isBotFor($this->bezirk_id))
		{
			$menu[] = array('name'=>'Gruppe verwalten', 'href' => '/groups?sub=edit&id='.(int)$this->bezirk_id);
		}
		
		addContent($this->view->menu($menu,array('active'=>$this->getSub())),CNT_LEFT);
			
		addContent(
			v_field($this->view->fsAvatarList($bezirk['foodsaver'],array('shuffle' => false)), count($bezirk['foodsaver']).' aktive Mitglieder'),
			CNT_LEFT
		);
			
		if($this->bezirk['sleeper'])
		{
			addContent(
			v_field($this->view->fsAvatarList($bezirk['sleeper']), count($bezirk['sleeper']).' Schlafmützen in '.$bezirk['name']),
			CNT_LEFT
			);
		}
			
		addContent(
			$this->view->signout($this->bezirk),
			CNT_LEFT
		);
	}
	
	public function wall()
	{
		addContent(v_field($this->wallposts('bezirk', $this->bezirk_id), 'Pinnwand'));
	}
	
	public function fairteiler()
	{
		addBread(s('fairteiler'),'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=fairteiler');
		addContent($this->view->ftOptions($this->bezirk_id),CNT_RIGHT);
		addTitle(s('fairteiler'));
		if($fairteiler = $this->model->listFairteiler($this->bezirk_id))
		{
			addContent($this->view->listFairteiler($fairteiler));
		}
		else
		{
			addContent(v_info(s('no_fairteiler_available')));
		}
	}
	
	public function addFt()
	{
		addBread(s('fairteiler'),'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=fairteiler');
		addBread(s('add_fairteiler'));
		
		if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'fairteiler')
		{
			if($this->handleAddFt())
			{
				fs_info(s('fairteiler_add_success'));
				go('/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=fairteiler');
			}
			else
			{
				error(s('fairteiler_add_fail'));
			}
		}
		
		addContent($this->view->fairteilerForm());
		addContent(v_menu(array(
			array('name'=>s('back'),'href' => '/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=fairteiler')
		),s('options')),CNT_RIGHT);
	}
	
	public function handleAddFt()
	{
		$name = strip_tags($_POST['name']);
		$desc = strip_tags($_POST['desc']);
		$anschrift = strip_tags($_POST['anschrift']);
		$plz = preg_replace('[^0-9]', '', $_POST['plz']);
		$ort = strip_tags($_POST['ort']);
		$picture = strip_tags($_POST['picture']);
		if(!empty($_POST['lat']) && !empty($_POST['lon']))
		{
			$lat = $_POST['lat'];
			$lon = $_POST['lon'];
			
			
			$status = 0;
			if(isBotFor($this->bezirk_id) || isOrgaTeam())
			{
				$status = 1;
			}
			
			return $this->model->addFairteiler($this->bezirk_id, $name, $desc, $anschrift, $plz, $ort, $lat, $lon, $picture,$status);
		}
		else
		{
			return false;
		}
	}
	
	private function bezirkRequests()
	{
		if($requests = $this->model->getBezirkRequests($this->bezirk_id))
		{
			$out = '<table class="pintable">';
			$odd = 'odd';
			addJs('$("table.pintable tr td ul li").tooltip();');
			
			addJsFunc('
				function acceptRequest(fsid,bid){
					showLoader();
					$.ajax({
						dataType:"json",
						data: "fsid="+fsid+"&bid="+bid,
						url:"xhr/?f=acceptBezirkRequest",
						success : function(data){
							if(data.status == 1)
							{
								reload();
								//$("tr.request-"+fsid).fadeOut();
							}
						},
						complete:function(){hideLoader();}
					});
				}
				function denyRequest(fsid,bid){
					showLoader();
					$.ajax({
						dataType:"json",
						data: "fsid="+fsid+"&bid="+bid,
						url:"xhr/?f=denyBezirkRequest",
						success : function(data){
							if(data.status == 1)
							{
								reload();
							}
						},
						complete:function(){hideLoader();}
					});
				}');
			
			foreach ($requests as $r)
			{
				if($odd == 'even')
				{
					$odd = 'odd';
				}
				else
				{
					$odd = 'even';
				}
				$out .= '
		<tr class="'.$odd.' request-'.$r['id'].'">
			<td class="img" width="35px"><a href="#" onclick="profile('.(int)$r['id'].');return false;"><img src="'.img($r['photo']).'" /></a></td>
			<td style="padding-top:17px;"><span class="msg"><a href="#" onclick="profile('.(int)$r['id'].');return false;">'.$r['name'].'</a></span></td>
			<td style="width:66px;padding-top:17px;"><span class="msg"><ul class="toolbar"><li class="ui-state-default ui-corner-left" title="Ablehnen" onclick="denyRequest('.(int)$r['id'].','.(int)$this->bezirk_id.');"><span class="ui-icon ui-icon-closethick"></span></li><li class="ui-state-default ui-corner-right" title="Akzeptieren" onclick="acceptRequest('.(int)$r['id'].','.(int)$this->bezirk_id.');"><span class="ui-icon ui-icon-heart"></span></li></ul></span></td>
		</tr>';
			}
			
			$out .= '</table>';
			
			hiddenDialog('requests', array($out));
			addJs('$("#dialog_requests").dialog("option","title","Anfragen für '.$this->bezirk['name'].'");');
			addJs('$("#dialog_requests").dialog("option","buttons",{});');
			addJs('$("#dialog_requests").dialog("open");');
		}
	}

	public function forum()
	{
		return $this->_forum(false);
	}

	public function botforum()
	{
		return $this->_forum(true);
	}

	private function _forum($botForum)
	{
		$botForum = $botForum && ($this->bot_theme == 1);
		addBread(s('forum'),'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=' . $botForum ? 'botforum' : 'forum');

		addTitle(s($botForum ? 'bot_forum' : 'forum'));

		if(isset($_POST['submitted']))
		{
			$body = strip_tags($_POST['body']);
			$body = nl2br($body);
			$body = autolink($body);

			if($post_id = $this->model->addThemePost($_POST['thread'], $body,$_POST['post'],$this->bezirk))
			{
				// Dunno why this is only done for non-bot-posts
				if(!$botForum)
				{
					if($_POST['follow'] == 1)
					{
						$this->model->followTheme($_POST['thread']);
					}
					elseif($_POST['follow'] == 0)
					{
						$this->model->unfollowTheme($_POST['thread']);
					}

					if($follower = $this->model->getThreadFollower($_POST['thread']))
					{

						$theme = $this->model->getVal('name','theme',$_POST['thread']);
						$poster = $this->model->getVal('name','foodsaver',fsId());
						foreach ($follower as $f)
						{
							tplMail(19, $f['email'],array(
								'anrede' => genderWord($f['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r'),
								'name' => $f['name'],
								'link' => 'http://www.'.DEFAULT_HOST.'/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$this->getSub().'&tid='.(int)$_POST['thread'].'&pid='.$post_id.'#post'.$post_id,
								'theme' => $theme,
								'post' => $body,
								'poster' => $poster
							));
						}
					}
				}

				go('/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$this->getSub().'&tid='.(int)$_POST['thread'].'&pid='.$post_id.'#post'.$post_id);
			}
			else
			{
				error(s('post_could_not_saved'));
				go('/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$this->getSub().'&tid='.(int)$_POST['thread'].'&pid='.(int)$_POST['post'].'#post'.(int)$_POST['post']);
			}
		}

		if(isset($_GET['tid']))
		{
			return $this->forum_thread($_GET['tid']);
		}

		addContent($this->view->forum_top());

		if($themes = $this->model->getThemes($this->bezirk_id, $botForum ? 1 : 0))
		{
			addContent(
				$this->view->forum_index($themes, false, $botForum ? 'botforum' : 'forum')
			);
		}
		else
		{
			addContent(
				$this->view->forum_empty()
			);
		}

		addContent($this->view->forum_bottom($botForum ? 1 : 0));
	}

	private function forum_thread($thread_id)
	{
		if($thread = $this->model->getThread($this->bezirk_id,$thread_id,$this->bot_theme))
		{
			addBread($thread['name']);
			if($thread['active'] == 0 && (isBotFor($this->bezirk_id) || isOrgaTeam()))
			{
				if(isset($_GET['activate']))
				{
					$this->model->activateTheme($thread_id);
					$this->themeInfoMail($thread_id);
					fs_info('Thema wurde aktiviert!');
					go('/?page=bezirk&bid='.$this->bezirk_id.'&sub=forum&tid='.(int)$thread_id);
				}
				else if (isset($_GET['delete']))
				{
					fs_info('Thema wurde gelöscht!');
					$this->model->deleteTheme($thread_id);
					go('/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=forum');
				}
				addContent($this->view->activateTheme($thread),CNT_TOP);
			}
			
			if($thread['active'] == 1 || S::may('orga') || isBotFor($this->bezirk_id))
			{
				$posts = $this->model->getPosts($thread_id);
				$followCounter = $this->model->getFollowingCounter($thread_id);
				$bezirkType = $this->model->getBezirkType($this->bezirk_id);
				$stickStatus = $this->model->getStickStatus($thread_id);
				addContent($this->view->thread($thread,$posts,$followCounter,$bezirkType,$stickStatus));
			}
			else 
			{
				go('/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=forum');
			}
			
		}
		else
		{
			go('/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$this->getSub());
		}
	}
	
	public function ntheme()
	{
		addBread(s('forum'),'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub='.$this->getSub());
		addBread(s('new_theme'));
		
		if($this->handleNtheme())
		{
			go('/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub='.$this->getSub());
		}
		
		addContent($this->view->newThemeForm());
	}
	
	private function themeInfoBotschafter($theme_id)
	{
		$theme = $this->model->getValues(array('foodsaver_id','name'), 'theme', $theme_id);
		$poster = $this->model->getVal('name', 'foodsaver', $theme['foodsaver_id']);
		
		if($foodsaver = $this->model->getBotschafter($this->bezirk_id))
		{
			foreach ($foodsaver as $i => $fs)
			{
				$foodsaver[$i]['var'] = array(
						'name' => $fs['vorname'],
						'anrede' => genderWord($fs['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r'),
						'bezirk' => $this->bezirk['name'],
						'poster' => $poster,
						'thread' => $theme['name'],
						'link' => 'http://www.'.DEFAULT_HOST.'/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=forum&tid='.(int)$theme_id
				);
			}
			
			tplMailList(20, $foodsaver,array(
				'email'=>EMAIL_PUBLIC,
				'email_name'=>EMAIL_PUBLIC_NAME
			));
		}
		
		
	}
	
	private function themeInfoMail($theme_id)
	{
		$theme = $this->model->getValues(array('foodsaver_id','name','last_post_id'), 'theme', $theme_id);
		$body = $this->model->getVal('body', 'theme_post', $theme['last_post_id']);
		
		$poster = $this->model->getVal('name', 'foodsaver', $theme['foodsaver_id']);
		$link = URL_INTERN.'/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$this->getSub().'&tid='.$theme_id;
		
		if($this->bot_theme == 1)
		{
			$foodsaver = $this->model->getBotschafter($this->bezirk_id);
		}
		else if($this->mode == 'orgateam')
		{
			$foodsaver = $this->model->getActiveFoodsaver($this->bezirk_id);
		}
		else
		{
			$foodsaver = $this->model->getFoodsaver($this->bezirk_id);
		}
		
		if($foodsaver)
		{
			$tmp = array();
			foreach ($foodsaver as $fs)
			{
				$tmp[$fs['email']] = $fs;
			}
				
			$foodsaver = array();
			$i=0;
			foreach ($tmp as $fs)
			{
				$foodsaver[$i] = $fs;
				$foodsaver[$i]['var'] = array(
						'name' => $fs['vorname'],
						'anrede' => genderWord($fs['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r'),
						'bezirk' => $this->bezirk['name'],
						'poster' => $poster,
						'thread' => $theme['name'],
						'link' => $link,
						'post' => $body
				);
				$i++;
			}
				
			if($this->bot_theme == 1)
			{
				tplMailList(13, $foodsaver,array(
				'email'=>'noreply@'.DEFAULT_HOST,
				'email_name'=>EMAIL_PUBLIC_NAME
				));
			}
			else
			{
				tplMailList(12, $foodsaver,array(
				'email'=>'noreply@'.DEFAULT_HOST,
				'email_name'=>EMAIL_PUBLIC_NAME
				));
			}
		}
	}
	
	private function handleNtheme()
	{
		if(isset($_POST['form_submit']))
		{
			$active = 1;
			if(
				!isVerified()
				||
				(
					$this->mode == 'big' 
					&& 
					!(isBotFor($this->bezirk_id) || $this->getSub() == 'botforum')
				)
				||
				$this->bezirk['moderated']
			)
			{
				fs_info('Das Thema wurde gespeichert und wird veröffentlicht sobald ein Botschafter aus '.$this->bezirk['name'].' es bestätigt.');
				$active = 0;
			}
			
			$body = strip_tags($_POST['body']);
			$body = nl2br($body);
			$body = autolink($body);
			
			if($theme_id = $this->model->addTheme($this->bezirk_id, $_POST['title'], $body,$this->bot_theme,$active))
			{
				if($active)
				{
					$this->themeInfoMail($theme_id);
				}
				else 
				{
					$this->themeInfoBotschafter($theme_id);
				}
				
				return true;
			}
		}
		return false;
	}
	
	public function events()
	{
		addBread('Termine','/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=events');
		
		addTitle(s('dates'));
		
		if($events = $this->model->listEvents())
		{
			addContent($this->view->listEvents($events));
		}
		else
		{
			addContent(v_info(s('no_events_posted')));
		}
		
		addContent($this->view->addEvent(),CNT_RIGHT);
	}
	
	public function applications()
	{
		if(!(isBotFor($this->bezirk_id) || isOrgaTeam()))
		{
			return;
		}
		if($requests = $this->model->getBezirkRequests($this->bezirk_id))
		{
			addContent($this->view->applications($requests));
		}
	}
	
	public function show()
	{
		if($event = $this->model->getEvent($_GET['id']))
		{
			addBread('Termine','/?page=bezirk&bid='.(int)$this->bezirk_id.'&sub=events');
			addBread($event['name']);
			addContent($this->view->eventTop($event),CNT_TOP);
			addContent($this->view->event($event));
			if($event['location'] != false)
			{
				addContent($this->view->location($event['location']),CNT_RIGHT);
			}
			
			addContent(v_field($this->wallposts('event', $event['id']),'Pinnwand'));
			
			
		}
		else
		{
			go('/?page=bezirk&bid='.$this->bezirk_id.'&sub=events');
		}
	}
}
