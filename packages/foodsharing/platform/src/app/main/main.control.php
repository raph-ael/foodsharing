<?php
class MainControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new MainModel();
		$this->view = new MainView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}