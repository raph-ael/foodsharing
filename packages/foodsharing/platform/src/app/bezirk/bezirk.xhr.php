<?php

class BezirkXhr extends Control
{
	
	public function __construct()
	{
		$this->responses = new XhrResponses;
		$this->model = new BezirkModel(15);
		$this->view = new BezirkView();
		

		parent::__construct();
	}
	
	private function hasThemeAccess($BotThemestatus)
	{
		return ($BotThemestatus['bot_theme']==0 && mayBezirk($BotThemestatus['bezirk_id']))
			|| ($BotThemestatus['bot_theme']==1 && isBotFor($BotThemestatus['bezirk_id']))
	    || isOrgaTeam();
	}

	public function followTheme()
	{
		$bot_theme = $this->model->getBotThemestatus($_GET['tid']);
		if(!S::may() || !$this->hasThemeAccess($bot_theme))
		{
			return $this->responses->fail_permissions();
		}

		$this->model->followTheme($_GET['tid']);
		return $this->responses->success();
	}

	public function unfollowTheme()
	{
		$bot_theme = $this->model->getBotThemestatus($_GET['tid']);
		if(!S::may() || !$this->hasThemeAccess($bot_theme))
		{
			return $this->responses->fail_permissions();
		}

		$this->model->unfollowTheme($_GET['tid']);
		return $this->responses->success();
	}

	public function stickTheme()
	{
		$bot_theme = $this->model->getBotThemestatus($_GET['tid']);
		if(!S::may() || !$this->hasThemeAccess($bot_theme))
		{
			return $this->responses->fail_permissions();
		}

		$this->model->stickTheme($_GET['tid']);
		return $this->responses->success();
	}

	public function unstickTheme()
	{
		$bot_theme = $this->model->getBotThemestatus($_GET['tid']);
		if(!S::may() || !$this->hasThemeAccess($bot_theme))
		{
			return $this->responses->fail_permissions();
		}

		$this->model->unstickTheme($_GET['tid']);
		return $this->responses->success();
	}

	public function morethemes()
	{
		$bezirk_id = (int)$_GET['bid'];
		if(isset($_GET['page']) && mayBezirk($bezirk_id))
		{
			$sub = 'forum';
			
			if((int)$_GET['bot'] == 1)
			{
				if(!isBotFor($bezirk_id))
				{
					return $this->responses->fail_permissions();
				}
				$sub = 'botforum';
			}
			
			$this->view->bezirk_id = $bezirk_id;
			$themes = $this->model->getThemes($bezirk_id,(int)$_GET['bot'],(int)$_GET['page'],(int)$_GET['last']);
			return array(
				'status' => 1,
				'data' => array(
					'html' => $this->view->forum_index($themes,true,$sub)
				)
			);
		}
	}
	
	public function quickreply()
	{
		if(isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['pid']) && S::may() && isset($_POST['msg']) && $_POST['msg'] != '')
		{
			$sub = 'forum';
			if($_GET['sub'] != 'forum')
			{
				$sub = 'botforum';
			}
			
			$body = strip_tags($_POST['msg']);
			$body = nl2br($body);
			$body = autolink($body);
			
			if( $bezirk = $this->model->getValues( array('id','name'),'bezirk',$_GET['bid'] ) )
			{
				if($post_id = $this->model->addThemePost($_GET['tid'], $body,$_GET['pid'],$bezirk))
				{
					if($follower = $this->model->getThreadFollower($_GET['tid']))
					{
						$theme = $this->model->getVal('name','theme',$_GET['tid']);

						foreach ($follower as $f)
						{
							
							tplMail(19, $f['email'],array(
								'anrede' => genderWord($f['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r'),
								'name' => $f['name'],
								'link' => 'http://www.'.DEFAULT_HOST.'/?page=bezirk&bid='.$bezirk['id'].'&sub='.$sub.'&tid='.(int)$_GET['tid'].'&pid='.$post_id.'#post'.$post_id,
								'theme' => $theme,
								'post' => $body,
								'poster' => S::user('name')
							));
							
						}
					}
				
					echo json_encode(array(
							'status' => 1,
							'message' => 'Prima! Deine Antwort wurde gespeichert.'
					));
					exit();
					
				}
			}
			
			/*
			 * end add post
			 */
			
			
		}
		
		echo json_encode(array(
				'status' => 0,
				'message' => s('post_could_not_saved')
		));
		exit();
	}
	
	public function signout() {
		$data = $_GET;
		if($this->model->mayBezirk($data['bid']))
		{
			$this->model->del('DELETE FROM `'.PREFIX.'foodsaver_has_bezirk` WHERE `bezirk_id` = '.(int)$data['bid'].' AND `foodsaver_id` = '.(int)fsId().' ');
			$this->model->del('DELETE FROM `'.PREFIX.'botschafter` WHERE `bezirk_id` = '.(int)$data['bid'].' AND `foodsaver_id` = '.(int)fsId().' ');
			return array('status' => 1);
		}

		return array('status' => 0);
	}
}
