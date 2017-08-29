<?php
class BetriebControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new BetriebModel();
		$this->view = new BetriebView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
	}
}