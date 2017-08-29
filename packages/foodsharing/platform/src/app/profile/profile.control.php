<?php
class ProfileControl extends Control
{	
	private $foodsaver;
	private $stats;
	
	public function __construct()
	{
		
		if(!S::may())
		{
			go('/');
		}
		
		$this->model = new ProfileModel();
		$this->view = new ProfileView();

		parent::__construct();
		
		if($id = $this->uriInt(2))
		{
			$this->model->setFsId((int)$id);
			$this->fs_id = (int)$id;
			if($data = $this->model->getData())
			{
				if(is_null($data['deleted_at']) || S::may('orga'))
				{
					$this->foodsaver = $data;
					$this->foodsaver['buddy'] = $this->model->buddyStatus($this->foodsaver['id']);

					$this->view->setData($this->foodsaver);

					if($this->uriStr(3) == 'notes')
					{
						$this->organotes();
					}
					else
					{
						$this->profile();
					}
				}
				else
				{
					goPage('dashboard');
				}
				
			}
			else
			{
				goPage('dashboard');
			}
		}
		else
		{
			goPage('dashboard');
		}
		
	}
	
	public function index()
	{
		
	}

	private function organotes()
	{
		addBread($this->foodsaver['name'],'/profile/' . $this->foodsaver['id']);
		if(S::may('orga'))
		{
			$this->view->usernotes($this->wallposts('usernotes',$this->foodsaver['id']), $this->model->getCompanies($this->foodsaver['id']), $this->model->getCompaniesCount($this->foodsaver['id']), $this->model->getNextDates($this->foodsaver['id'], 50));
		}
		else
		{
			go('/profile/' . $this->foodsaver['id']);
		}
	}
	
	public function profile()
	{
 		$bids = $this->model->getFsBezirkIds($this->foodsaver['id']);

		if(isOrgaTeam() || isBotForA($bids,false,true))
		{
			$this->view->profile($this->wallposts('foodsaver',$this->foodsaver['id']), $this->model->getCompanies($this->foodsaver['id']), $this->model->getCompaniesCount($this->foodsaver['id']), $this->model->getNextDates($this->foodsaver['id'], 50));		
		}
		else
		{
			$this->view->profile($this->wallposts('foodsaver',$this->foodsaver['id']), null,null);	
		}
		
	}
}
