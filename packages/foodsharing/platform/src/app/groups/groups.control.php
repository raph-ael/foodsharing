<?php
class GroupsControl extends Control
{	
	private $ag_id;
	private $my_applications;
	private $my_stats;
	
	public function __construct()
	{
		
		$this->model = new GroupsModel();
		$this->view = new GroupsView();

		parent::__construct();
		
		if(!S::may())
		{
			goLogin();
		}
		
		$this->setAgId(392);
		
		addBread('Arbeitsgruppen','/groups');
		
		if(isset($_GET['p']) && (int)$_GET['p'] > 0)
		{
			$this->setAgId((int)$_GET['p']);
		}
		
		$this->my_applications = $this->model->getMyApplications();
		$this->my_stats = $this->model->getMyStats();
	}
	
	public function index()
	{
		$countrys = $this->model->getCountryGroups();
		$bezirke = $this->model->getBezirke();
			
		addContent($this->view->leftNavi($countrys,$bezirke),CNT_LEFT);
		
		if(!isset($_GET['sub']))
		{
			addTitle(s('groups'));
			addContent($this->view->topbar(s('working_groups_title'),'hier findest Du Hilfe und viel zu tun...','<img src="/img/groups.png" />'),CNT_TOP);
			if($groups = $this->model->listGroups())
			{
				addContent($this->view->listGroups($groups,$this->my_applications,$this->my_stats));
			}
			else
			{
				addContent( v_info('Hier gibt es noch keine Arbeitsgruppen'));
			}
		}
		
	}
	
	public function edit()
	{
		$fsModel = loadModel('foodsaver');
 
 		$bids = $fsModel->getFsBezirkIds(fsId());

 		if(!isOrgaTeam() && !isBotForA($bids,true,true))
 		{
 			go('/dashboard');
 		}

		if($group = $this->model->getGroup($_GET['id']))
		{
			
			if($group['type'] != 7)
 			{
 				go('/dashboard');
 			}
			if($this->isSubmitted())
			{
				$data = array();
				if($name = ($this->getPostString('name')))
				{
					$data['name'] = $name;
				}
					
				if($teaser = ($this->getPostString('teaser')))
				{
					$data['teaser'] = $teaser;
				}
					
				if($desc = ($this->getPostHtml('desc')))
				{
					$data['desc'] = $desc;
				}
					
				if($img = ($this->getPostString('photo')))
				{
					$data['photo'] = $img;
				}
				
				$data['apply_type'] = 1;
				$data['banana_count'] = 0;
				$data['fetch_count'] = 0;
				$data['week_num']  = 0;
				$data['report_num'] = 0;
				
				if($_POST['apply_type'] == 1)
				{
					$data['banana_count'] = (int)$_POST['banana_count'];
					$data['fetch_count'] = (int)$_POST['fetch_count'];
					$data['week_num']  = (int)$_POST['week_num'];
					
					if(isset($_POST['report_num']) && is_array($_POST['report_num']) && count($_POST['report_num']) > 0)
					{
						$data['report_num'] = 1;
					}
				}
				else
				{
					$data['apply_type'] = (int)$_POST['apply_type'];
				}

				if(!empty($data))
				{
			
				}

				/*
				 * Handle Member and Group-Admin Fields
				 */
				handleTagselect('member');
				handleTagselect('leader');
				
				$data = array_merge($group,$data);
				
				if($this->model->updateGroup($group['id'],$data))
				{
					$this->model->updateTeam($group['id']);
					fs_info('Änderungen gespeichert!');
					go('/groups?sub=edit&id='.(int)$group['id']);
				}
					
			}
			
			addBread($group['name'].' bearbeiten','/groups?sub=edit&id='.(int)$group['id']);
			addContent($this->view->editGroup($group));
		}
	}
	
	private function setAgId($id)
	{
		$this->ag_id = $id;
		$this->model->setAgId($id);
		$this->view->setAgId($id);
	}
}
