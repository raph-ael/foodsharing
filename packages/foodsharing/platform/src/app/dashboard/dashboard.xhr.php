<?php 
class DashboardXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new DashboardModel();
		$this->view = new DashboardView();

		parent::__construct();
	}
}