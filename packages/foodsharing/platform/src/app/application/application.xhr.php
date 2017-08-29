<?php 
class ApplicationXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new ApplicationModel();
		$this->view = new ApplicationView();

		parent::__construct();
	}
	
	public function apply()
	{
		if(isBotFor($_GET['bid']) || isOrgaTeam())
		{
			if($this->model->apply($_GET['bid'],$_GET['fid']))
			{
				fs_info("Bewerbung angenommen");
				return array(
					'status' => 1,
					'script' => 'goTo("/?page=bezirk&bid='.(int)$_GET['bid'].'");'
				);
			}
		}
	}
	
	public function maybe()
	{
		if(isBotFor($_GET['bid']) || isOrgaTeam())
		{
			if($this->model->maybe($_GET['bid'],$_GET['fid']))
			{
				fs_info("Bewerbungs Status geändert");
				return array(
						'status' => 1,
						'script' => 'goTo("/?page=bezirk&bid='.(int)$_GET['bid'].'");'
				);
			}
		}
	}
	
	public function noapply()
	{
		if(isBotFor($_GET['bid']) || isOrgaTeam())
		{
			$this->model->noapply($_GET['bid'],$_GET['fid']);

			fs_info("Bewerbung abgelehnt");
			return array(
						'status' => 1,
						'script' => 'goTo("/?page=bezirk&bid='.(int)$_GET['bid'].'");'
			);
		}
	}
}