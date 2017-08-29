<?php 
class FoodsaverXhr extends Control
{
	
	public function __construct()
	{
		// permission check
		if(!S::may('orga') && !isBotFor($_GET['bid']))
		{
			return false;
		}
		
		$this->model = new FoodsaverModel();
		$this->view = new FoodsaverView();

		parent::__construct();
	}
	
	public function loadFoodsaver()
	{
		if($foodsaver = $this->model->loadFoodsaver($_GET['id']))
		{
			$html = $this->view->foodsaverForm($foodsaver);
			return array(
				'status' => 1,
				'script' => '$("#fsform").html(\''.jsSafe($html).'\');$(".button").button();$(".avatarlink img").load(function(){$(".avatarlink img").fadeIn();});'
			);
		}
	}
	
	/**
	 * xrh reload foodsaver list
	 */
	public function foodsaverrefresh()
	{
		$foodsaver = $this->model->listFoodsaver($_GET['bid']);
		$bezirk = $this->model->getBezirk($_GET['bid']);
		$html = jsSafe($this->view->foodsaverList($foodsaver,$bezirk),"'");

		return array(
			'status' => 1,
			'script' => '$("#foodsaverlist").replaceWith(\''.$html.'\');fsapp.init();'
		);
	}

	/**
	 * Method to delete an foodsaver from an bezirk
	 */
	public function delfrombezirk()
	{
		$this->model->delfrombezirk($_GET['bid'],$_GET['id']);
		
		return array(
			'status' => 1,
			'script' => 'pulseInfo("Foodsaver wurde entfernt");$("#fsform").html("");fsapp.refreshfoodsaver();'
		);
	}
	
	/**
	 * xhr req to add a list of foodsavers to an bezirk
	 * 
	 * @return multitype:number string
	 */
	public function addfoodsaver()
	{	
		$ids = explode(',', $_GET['ids']);
		
		// clear id array
		$outid = array();
		foreach ($ids as $id)
		{
			if((int)$id > 0)
			{
				$outid[] = (int)$id;
			}
		}
		
		if(!empty($outid))
		{
			$this->model->addFoodsaverToBezirk($outid,$_GET['bid']);
			
			return array(
				'status' => 1,
				'script' => 'fsapp.refreshfoodsaver();pulseInfo("Foodsaver wurden einsortiert");'
			);
		}
	}
}
