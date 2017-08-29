<?php 

class MailboxXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new MailboxModel();
		$this->view = new MailboxView();

		parent::__construct();
		
		if(!S::may('bieb'))
		{
			return false;
		}
	}
	
	public function testmail()
	{
		if(!S::may('orga'))
		{
			return false;
		}
		
		if(!validEmail($_POST['email']))
		{
			return array(
				'status' => 1,
				'script' => 'pulseError("Mit der E-Mail-Adresse stimmt etwas nicht!");'
			);
		}
		else
		{
			libmail(false, $_POST['email'], $_POST['subject'], $_POST['message']);
			return array(
				'status' => 1,
				'script' => 'pulseInfo("E-Mail wurde versendet!");'
			);
		}
	}
	
	public function attach()
	{
		// is filesize (10MB) and filetype allowed?
		if(isset($_FILES['etattach']['size']) && $_FILES['etattach']['size'] < 1310720 && $this->attach_allow($_FILES['etattach']['name'], $_FILES['etattach']['type']))
		{
			$new_filename = uniqid();
			
			$ext = strtolower($_FILES['etattach']['name']);
			$ext = explode('.', $ext);
			if(count($ext) > 1)
			{
				$ext = end($ext);
				$ext = trim($ext);
				$ext = '.'.preg_replace('/[^a-z0-9]/', '', $ext);
			}
			else
			{
				$ext = '';
			}
			
			$new_filename = $new_filename.$ext;
			
			move_uploaded_file($_FILES['etattach']['tmp_name'], PUBLIC_DATA_DIR . '/mailattach/tmp/'.$new_filename);
			
			$init = 'window.parent.mb_finishFile("'.$new_filename.'");';
		}
		elseif(!$this->attach_allow($_FILES['etattach']['name']))
		{
			$init = 'window.parent.pulseInfo(\''.jsSafe(s('wrong_file')).'\');window.parent.mb_removeLast();';
		}
		else 
		{
			$init = 'window.parent.pulseInfo(\''.jsSafe(s('file_to_big')).'\');window.parent.mb_removeLast();';
		}
		
		echo '<html><head>

		<script type="text/javascript">
			function init()
			{
				'.$init.'
			}
		</script>
				
		</head><body onload="init();"></body></html>';
		
		exit();
	}
	
	public function loadmails()
	{
		
		$last_refresh = (int)Mem::get('mailbox_refresh');
		
		$cur_time = (int)time();

		if(
			$last_refresh == 0
			||
			($cur_time - $last_refresh) > 30
		)
		{
			Mem::set('mailbox_refresh', $cur_time);
			$ref = $this->refresh();
		}

		$mb_id = (int)$_GET['mb'];
		if($this->model->mayMailbox($mb_id,$_GET['type']))
		{
			$this->model->mailboxActivity($mb_id);
			if($messages = $this->model->listMessages($mb_id,$_GET['folder']))
			{
				$nc_js = '';
				if($boxes = $this->model->getBoxes())
				{					
					if($newcount = $this->model->getNewCount($boxes))
					{
						foreach ($newcount as $nc)
						{
							$nc_js .= '
								$( "ul.dynatree-container a.dynatree-title:contains(\''.$nc['name'].'@'.DEFAULT_HOST.'\')" ).removeClass("nonew").addClass("newmail").text("'.$nc['name'].'@'.DEFAULT_HOST.' ('.(int)$nc['count'].')");';
						}
					}
				}
				$vontext = 'Von';
				if($_GET['folder'] == 'sent')
				{
					$vontext = 'An';
				}
				return array(
					'status' => 1,
					'html' => $this->view->listMessages($messages),
					'append' => '#messagelist tbody',
					'script' => '
						$("#messagelist .from a:first").text("'.$vontext.'");
						$("#messagelist tbody tr").mouseover(function(){
							$("#messagelist tbody tr").removeClass("selected focused");
							$(this).addClass("selected focused");
							
						});
						$("#messagelist tbody tr").mouseout(function(){
							$("#messagelist tbody tr").removeClass("selected focused");							
						});
						$("#messagelist tbody tr").click(function(){
							ajreq("loadMail",{id:($(this).attr("id").split("-")[1])});
						});
						$("#messagelist tbody td").disableSelection();
						'.$nc_js.'
					'
				);
			}
			else
			{
				return array(
						'status' => 1,
						'html' => $this->view->noMessage(),
						'append' => '#messagelist tbody'
				);
			}
		}
	}
	
	public function move()
	{
		if($this->model->mayMessage($_GET['mid']))
		{
			$folder = $this->model->getVal('folder', 'mailbox_message', $_GET['mid']);
			
			if($folder == 3)
			{
				$this->model->deleteMessage($_GET['mid']);
			}
			else
			{
				$this->model->move($_GET['mid'],$_GET['f']);
			}

			return array(
				'status' => 1,
				'script' => '$("tr#message-'.(int)$_GET['mid'].'").remove();$("#message-body").dialog("close");'
			);
		}
	}
	
	public function quickreply()
	{
		if(isset($_GET['mid']) && $this->model->mayMessage($_GET['mid']))
		{
			if($message = $this->model->getMessage($_GET['mid']))
			{		
				$sender = @json_decode($message['sender'],true);		
				if($sender != null && isset($sender['mailbox']) && isset($sender['host']))
				{
					$subject = 'Re: '.trim(str_replace(array('Re:','RE:', 're:','aw:','Aw:','AW:'),'',$message['subject']));
					
					$body = strip_tags($_POST['msg']) . "\n\n\n\n--------- Nachricht von ".niceDate($message['time_ts'])." ---------\n\n>\t".str_replace("\n","\n>\t",$message['body']);
					
					$mail = new AsyncMail();
					$mail->setFrom($message['mailbox'].'@'.DEFAULT_HOST,S::user('name'));
					if($sender['personal'])
					{
						$mail->addRecipient($sender['mailbox'].'@'.$sender['host'], $sender['personal']);
					}
					else
					{
						$mail->addRecipient($sender['mailbox'].'@'.$sender['host']);	
					}
					$mail->setSubject($subject);
					$mail->setHTMLBody(nl2br($body));	
					$mail->setBody($body);
					$mail->send();
					
					echo json_encode(array(
							'status' => 1,
							'message' => 'Spitze! Die E-Mail wurde versendet.'
					));
					exit();
				}
			}
		}
		
		echo json_encode(array(
				'status' => 0,
				'message' => 'Die E-Mail konnte nicht gesendet werden.'
		));
		exit();
	}
	
	public function send_message()
	{
		/*
		 *  an		an
			body	body
			mb		1
			sub		betr
		 */

		if($last = (int)Mem::user(fsId(), 'mailbox-last'))
		{
			if((time() - $last) < 15)
			{
				return array(
					'status' => 1,
					'script' => 'pulseError("Du kannst nur eine E-Mail pro 15 Sekunden versenden, bitte warte einen Augenblick...");'
				);
			}
		}
		
		Mem::userSet(fsId(),'mailbox-last', time());
		
		if($this->model->mayMailbox($_POST['mb']))
		{
			if($mailbox = $this->model->getMailbox($_POST['mb']))
			{
				$an = explode(';', $_POST['an']);
				$tmp = array();
				foreach ($an as $a)
				{
					$tmp[$a] = $a;
				}
				$an = $tmp;
				if(count($an) > 100)
				{
					return array(
						'status' => 1,
						'script' => 'pulseError("Zu viele Empfänger");'
					);
				}
					$attach = false;

					if(isset($_POST['attach']) && is_array($_POST['attach']))
					{
						$attach = array();
						foreach ($_POST['attach'] as $a)
						{
							
							if(isset($a['name']) && isset($a['tmp']))
							{
								$tmp = str_replace(array('/','\\'), '', $a['tmp']);
								$name = strtolower($a['name']);
								str_replace(array('ä','ö','ü','ß',' '), array('ae','oe','ue','ss','_'), $name);
								$name = preg_replace('/[^a-z0-9\-\.]/', '', $name);
								
								if(file_exists('data/mailattach/tmp/'.$tmp))
								{
									$attach[] = array(
										'path' => 'data/mailattach/tmp/'.$tmp,
										'name' => $name
									);
									
								}
							}
						}
					}

					$this->libPlainMail(
						$an,
						array(
							'email' => $mailbox['name'].'@'.DEFAULT_HOST,
							'name' => $mailbox['email_name']
						),
						$_POST['sub'],
						$_POST['body'],
						$attach
					);
					
					$to = array();
					foreach ($an as $a)
					{
						if(validEmail($a))
						{
							$t = explode('@', $a);
								
							$to[] = array(
								'personal' => $a,
								'mailbox' => $t[0],
								'host' =>$t[1]
							);
						}
					}
					
					if($this->model->saveMessage(
							$_POST['mb'], 
							2, 
							json_encode(array(
								'host' => DEFAULT_HOST,
								'mailbox' => $mailbox['name'],
								'personal' => $mailbox['email_name']
							)), 
							json_encode($to), 
							$_POST['sub'], 
							$_POST['body'], 
							nl2br($_POST['body']),
							date('Y-m-d H:i:s'),
							'',
							1
					))
					{
						$this->model->setAnswered($_POST['reply']);
						return array(
								'status' => 1,
								'script' => '
									pulseInfo("'.s('send_success').'");
									mb_clearEditor();
									mb_closeEditor();'
						);
					}
			}
		}
	}
	
	public function fmail()
	{
		if($this->model->mayMessage((int)$_GET['id']))
		{
			$html = $this->model->getVal('body_html', 'mailbox_message', $_GET['id']);
			
			if(strpos(strtolower($html), '<body') === false)
			{
				$html = '<html><head><style type="text/css">body,div,h1,h2,h3,h4,h5,h6,td,th,p{font-family:Arial,Helvetica,Verdana;}body,div,td,th,p{font-size:13px;}body{margin:0;padding:0;}</style></head><body onload="parent.u_readyBody();">'.$html.'</body></html>';
			}
			else
			{
				$html = str_replace(array('<body','<BODY','<Body'), '<body onload="parent.u_readyBody();"', $html);
				$html = str_replace(array('<head>','<HEAD>','<Head>'), '<head><style type="text/css">body,div,h1,h2,h3,h4,h5,h6,td,th,p{font-family:Arial,Helvetica,Verdana;}body,div,td,th,p{font-size:13px;}body{margin:0;padding:0;}</style>', $html);
			}
			
			$html = str_replace('href="mailto:', 'onclick="parent.mb_new_message(this.href.replace(\'mailto:\',\'\'));return false;" href="mailto:', $html);
			
			echo $html;
			exit();
		}
	}
	
	public function loadMail()
	{
		if($mail = $this->model->getMessage($_GET['id']))
		{
			if($this->model->mayMessage($mail['id']))
			{
				$this->model->setRead($_GET['id'],1);
				$mail['attach'] = trim($mail['attach']);
				if(!empty($mail['attach']))
				{
					$mail['attach'] = json_decode($mail['attach'],true);
				}
					
				return array(
						'status' => 1,
						'html' => $this->view->message($mail),
						'append' => '#message-body',
						'script' => '
			
					bodymin = 80;
					if($("#mailattch").length > 0)
					{
						bodymin += 40;
					}
			
					$("#message-body").dialog("option",{
						title: \''.jsSafe($mail['subject']).'\',
						height: ($( window ).height()-40)
					});
					$(".mailbox-body").css({
						"height" : ($("#message-body").height()-bodymin)+"px",
						"overflow":"auto"
					});
					$(".mailbox-body-loader").css({
						"height" : ($("#message-body").height()-bodymin)+"px",
						"overflow":"auto"
					});
					$("#message-body").dialog("open");
					$("tr#message-'.(int)$_GET['id'].' .read-0,tr#message-'.(int)$_GET['id'].'").addClass("read-1").removeClass("read-0");
					u_loadBody();'
				);
			}
		}
	}
	
	public function refresh()
	{
		return array(
				'status' => 1,
				'script' => 'mb_refresh();'
		);
	}
	
	private function libPlainMail($to,$from,$subject,$message,$attach = false)
	{
		if(is_array($to) && !isset($to['name']))
		{
			$email = $to;
		}
		else if(is_array($to) && isset($to['email']))
		{
			$email = $to['email'];
			$name = $to['name'];
		}
		else
		{
			$email = $to;
			$name = $to;
		}
		
		$from_email = $from;
		$from_name = $from;
		if(is_array($from))
		{
			$from_email = $from['email'];
			$from_name = $from['name'];
		}
	
		$mail = new AsyncMail();
		
		$mail->setFrom($from_email,$from_name);

	
		if(is_array($email))
		{
			foreach ($email as $e)
			{
				if(validEmail($e))
				{
					$this->model->addContact($e);
					$mail->addRecipient($e);
				}
			}
		}
		else
		{
			$mail->addRecipient($email);
		}
	
		$mail->setSubject($subject);

		$message = str_replace(array('<br>','<br/>','<br />','<p>','</p>','</p>'),"\r\n",$message);
		$message = strip_tags($message);
		
		$mail->setHTMLBody(nl2br($message));
		
		$mail->setBody($message);
		
	
		if($attach !== false)
		{
			foreach ($attach as $a)
			{
				$mail->addAttachment($a['path'],$a['name']);
			}
		}
		$mail->send();
	}
	
	public function attach_allow($filename,$mime)
	{
		if(strlen($filename) < 300)
		{
			$ext = explode('.', $filename);
			$ext = end($ext);
			$ext = strtolower($ext);
			$notallowed = array(
				'php' => true,
				'html' => true,
				'htm' => true,
				'php5' => true,
				'php4' => true,
				'php3' => true,
				'php2' => true,
				'php1' => true
			);
			$notallowed_mime = array();
			
			if(!isset($notallowed[$ext]) && !isset($notallowed_mime[$mime]))
			{
				return true;
			}
		}
		
		return false;
	}
}

