<?php
class InfoControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new InfoModel();
		$this->view = new InfoView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}