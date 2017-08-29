<?php
class MailboxControl extends Control
{	
	public function __construct()
	{
		$this->model = new MailboxModel();
		$this->view = new MailboxView();
		
		parent::__construct();
		
	}
	
	public function dlattach()
	{
		if(isset($_GET['mid']) && isset($_GET['i']))
		{
			if($m = $this->model->getValues(array('mailbox_id','attach'), 'mailbox_message', $_GET['mid']))
			{
				if($this->model->mayMailbox($m['mailbox_id']))
				{
					if($attach = json_decode($m['attach'],true))
					{
						if(isset($attach[(int)$_GET['i']]))
						{
							$file = 'data/mailattach/'.$attach[(int)$_GET['i']]['filename'];
							
							$Dateiname = $attach[(int)$_GET['i']]['origname'];
							$size = filesize($file);
							
							header('Content-Type: '.$attach[(int)$_GET['i']]['mime']);
							header("Content-Disposition: attachment; filename=".$Dateiname."");
							header("Content-Length: $size");
							readfile($file);
							exit();
						}
					}
				}
			}
		}
		
		goPage('mailbox');
		
	}
	
	public function index()
	{
		addScript('/js/dynatree/jquery.dynatree.js');
		addScript('/js/jquery.cookie.js');
		addCss('/js/dynatree/skin/ui.dynatree.css');
		
		addBread('Mailboxen');
		
		if($boxes = $this->model->getBoxes())
		{
			if(isset($_GET['show']) && (int)$_GET['show'])
			{
				if($this->model->mayMessage($_GET['show']))
				{
					addJs('ajreq("loadMail",{id:'.(int)$_GET['show'].'});');
				}
			}
			
			$mailadresses = $this->model->getMailAdresses();
			
			addContent($this->view->folder($boxes),CNT_LEFT);
			addContent($this->view->folderlist($boxes,$mailadresses));
			addContent($this->view->options(),CNT_LEFT);
			
		}
		
		if(isset($_GET['mailto']) && validEmail($_GET['mailto']))
		{
			addJs('mb_mailto("'.$_GET['mailto'].'");');
		}
	}
	
	public function newbox()
	{
		addBread('Mailbox Manager','/?page=mailbox&a=manage');
		addBread('Neue Mailbox');
		
		if(isOrgaTeam())
		{
			if(isset($_POST['name']))
			{
				if($mailbox = $this->model->filterName($_POST['name']))
				{
					if($this->model->addMailbox($mailbox,1))
					{
						fs_info(s('mailbox_add_success'));
						go('/?page=mailbox&a=manage');
					}
					else
					{
						error(s('mailbox_already_exists'));
					}
				}
					
			}
			addContent($this->view->manageOpt(),CNT_LEFT);
			addContent($this->view->mailboxform());
		}
	}
	
	public function manage()
	{
		addBread('Mailbox Manager');
		if(isOrgaTeam())
		{
			
			if(isset($_POST['mbid']))
			{
				global $g_data;
				
				$index = 'foodsaver_'.(int)$_POST['mbid'];
				
				handleTagselect($index);
				
				if($this->model->updateMember($_POST['mbid'],$g_data[$index]))
				{
					fs_info(s('edit_success'));
					go('/?page=mailbox&a=manage');
				}
			}
			
			if($boxes = $this->model->getMemberBoxes())
			{
				addJs('
							
				');
				foreach ($boxes as $b)
				{
					global $g_data;
					$g_data['foodsaver_'.$b['id']] = $b['member'];
					addContent($this->view->manageMemberBox($b));
				}
			}
			
			addContent($this->view->manageOpt(),CNT_LEFT);
		}
	}
}
