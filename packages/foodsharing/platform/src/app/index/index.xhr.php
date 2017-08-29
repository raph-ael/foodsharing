<?php 
class IndexXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new IndexModel();
		$this->view = new IndexView();

		parent::__construct();
	}
}