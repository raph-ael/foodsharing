<?php 
class GroupsXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new GroupsModel();
		$this->view = new GroupsView();

		parent::__construct();
	}
	
	public function apply()
	{
		if($group = $this->model->getGroup($_GET['id']))
		{
			$dialog = new XhrDialog();
			
			$dialog->addContent($this->view->applyForm($group));
			
			$dialog->setTitle('Bewerbung '.$group['name']);
			$dialog->addButton('Bewerbung absenden', 'ajreq(\'applysend\',{d:\''.$dialog->getId().'\',id:'.(int)$group['id'].', f:$(\'#apply-form\').serialize()})');
			
			$dialog->setResizeable(false);
			$dialog->addOpt('width', 450);
			
			return $dialog->xhrout();
		}
	}
	
	public function addtogroup()
	{
		if($group = $this->model->getGroup($_GET['id']))
		{
			if($group['apply_type'] == 3)
			{
				$this->model->addMeToGroup($_GET['id']);
				return array(
					'status' => 1,
					'script' => 'goTo("/?page=bezirk&bid='.(int)$_GET['id'].'&sub=wall");'		
				);
			}
		}
	}
	
	public function applysend()
	{
		if(isset($_GET['f']))
		{
			$output = array();
			parse_str($_GET['f'], $output);
			if(!empty($output))
			{				
				$motivation = strip_tags($output['motivation']);
				$fahig = strip_tags($output['faehigkeit']);
				$erfahrung = strip_tags($output['erfahrung']);
				$zeit = strip_tags($output['zeit']);
				$zeit = substr($zeit, 0, 300);
				
				if($groupmail = $this->model->getGroupMail($_GET['id']))
				{
					if($group = $this->model->getGroup($_GET['id']))
					{
						if($fs = $this->model->getValues(array('id','name','email'),'foodsaver',fsId()))
						{
							if($email = $this->model->getFsMail($fs['id']))
							{
								$fs['email'] = $email;
							}
							
							$content = array(
								'Motivation:'."\n===========\n".trim($motivation),
								'Fähigkeiten:'."\n============\n".trim($fahig),
								'Erfahrung:'."\n==========\n".trim($erfahrung),
								'Zeit:'."\n=====\n".trim($zeit)
							);
							
							$this->model->groupApply($group['id'],implode("\n\n", $content));
							
							libmail(array(
								'email' => $fs['email'],
								'email_name' => $fs['name']
							), $groupmail, 'Bewerbung für '.$group['name'], nl2br($fs['name'].' möchte gerne in der Arbeitsgruppe '.$group['name'].' mitmachen.'."\n\n".implode("\n\n", $content)));
								
							return array(
								'status' => 1,
								'script' => 'pulseInfo("Bewerbung wurde abgeschickt!");$("#'.preg_replace('/[^a-z0-9\-]/','',$_GET['d']).'").dialog("close");'
							);
							
						}
					}
				}
			}
		}
	}
	
	/*
	 * CONTACT GROUP BY E-MAIL
	 */
	public function sendtogroup()
	{
		if($group = $this->model->getGroup($_GET['id']))
		{
			$message = strip_tags($_GET['msg']);
			
			if(!empty($message))
			{
				tplMail(24, $group['email'],array(
					'gruppenname' => $group['name'],
					'message' => $message
				),S::user('email'));
				return array(
					'status' => 1,
					'script' => 'pulseInfo("Nachricht wurde versendet!");'		
				);
			}
		}
	}
	
	public function contactgroup()
	{
		if($group = $this->model->getGroup($_GET['id']))
		{
			$dialog = new XhrDialog();
			$dialog->setTitle($group['name'].' kontaktieren');
			
			$dialog->addContent($this->view->contactgroup($group));
			
			$dialog->addAbortButton();
			$dialog->addButton('Nachricht senden', 'if($(\'#message\').val()!=\'\'){ajreq(\'sendtogroup\',{id:'.(int)$_GET['id'].',msg:$(\'#message\').val()});$(\'#'.$dialog->getId().'\').dialog(\'close\');}else{pulseInfo(\'Schreib erst mal was ;)\');}');
			$dialog->addOpt('width', 500);
			$ret = $dialog->xhrout();
			$ret['script'] .= '$("#message").css("width","95%");$("#message").autosize();';
			return $ret;
		}
	}
	
}
