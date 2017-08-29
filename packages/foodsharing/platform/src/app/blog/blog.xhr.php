<?php 
class BlogXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new BlogModel();
		$this->view = new BlogView();

		parent::__construct();
	}
}