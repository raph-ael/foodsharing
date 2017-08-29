<?php
class WallpostControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new WallpostModel();
		$this->view = new WallpostView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}