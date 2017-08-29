<?php
class ApiControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new ApiModel();
		$this->view = new ApiView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}