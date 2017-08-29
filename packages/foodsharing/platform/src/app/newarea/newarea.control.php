<?php
class NewareaControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new NewareaModel();
		$this->view = new NewareaView();
		
		parent::__construct();

    if(!S::may('orga')) {
      go('/dashboard');
    }
		
	}
	
	public function index()
	{
		addBread('Anfragen für neue Bezirke');
		if($foodsaver = $this->model->getWantNews())
		{
			addContent($this->view->listWantNews($foodsaver));
			
			addContent($this->view->orderToBezirk(),CNT_RIGHT);
			
			addContent($this->view->options(),CNT_RIGHT);
		}
	}
}
