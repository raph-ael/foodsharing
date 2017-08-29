<?php 
class ContentXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new ContentModel();
		$this->view = new ContentView();

		parent::__construct();
	}
}