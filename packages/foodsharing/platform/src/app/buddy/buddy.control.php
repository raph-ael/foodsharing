<?php
class BuddyControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new BuddyModel();
		$this->view = new BuddyView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}