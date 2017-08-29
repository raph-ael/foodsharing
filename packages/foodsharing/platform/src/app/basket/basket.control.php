<?php
class BasketControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new BasketModel();
		$this->view = new BasketView();
		
		parent::__construct();
		
		addBread('Essenskörbe');
		
	}
	
	public function index()
	{
		if($id = $this->uriInt(2))
		{
			if($basket = $this->model->getBasket($id))
			{
				$this->basket($basket);
			}
		}
		else 
		{
			if($m = $this->uriStr(2))
			{
				if(method_exists($this,$m))
				{
					$this->$m();
				}
				else
				{
					go('/essenskoerbe/find');
				}
			}
			else
			{
				go('/essenskoerbe/find');
			}
		}
	}
	
	public function find()
	{
		$baskets = $this->model->closeBaskets(50);
		$this->view->find($baskets);
		
		
	}
	
	private function basket($basket)
	{
		$wallposts = false;
		$requests = false;
		
		if(S::may())
		{
			
			if($basket['fs_id'] != fsId())
			{
				addJsFunc('
				function u_wallpostReady(postid)
				{
					ajax.req("basket","follow",{
						data:{bid:'.(int)$basket['id'].'}
					});
				}');
			}
			$wallposts = $this->wallposts('basket', $basket['id']);
			if($basket['fs_id'] == fsId())
			{
				$requests = $this->model->listRequests($basket['id']);
			}
		}
		if($basket['until_ts'] >= time() && $basket['status'] == 1)
		{
			$this->view->basket($basket,$wallposts,$requests);
		}elseif($basket['until_ts'] <= time() || $basket['status'] == 3)
		{
			$this->view->basketTaken($basket);
		}
		
		
	}
}