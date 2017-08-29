<?php
class ApplicationControl extends Control
{	
	
	private $bezirk;
	private $bezirk_id;
	private $mode;
	
	public function __construct()
	{
		
		$this->model = new ApplicationModel();
		$this->view = new ApplicationView();
		
		parent::__construct();
		
		$this->bezirk_id = false;
		if(($this->bezirk_id = getGetId('bid')) === false)
		{
			$this->bezirk_id = getBezirkId();
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
			$this->bezirk = $bezirk;
		}
		
		$this->view->setBezirk($this->bezirk);
		
		
		if(!(isBotFor($this->bezirk_id) || S::may('orga')))
		{
			go('/');
		}
		
	}
	
	public function index()
	{
		if($application = $this->model->getApplication($this->bezirk_id,$_GET['fid']))
		{
			addBread($this->bezirk['name'],'/?page=bezirk&bid='.$this->bezirk_id);
			addBread('Bewerbung von '.$application['name'],'');
			addContent($this->view->application($application));
			
			addContent(v_field(
				$this->wallposts('application', $application['id']),
				'Status-Notizen'
			));
			
			addContent($this->view->applicationMenu($application),CNT_LEFT);
		}
	}
}