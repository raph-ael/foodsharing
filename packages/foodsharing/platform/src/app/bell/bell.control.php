<?php
class BellControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new BellModel();
		$this->view = new BellView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}