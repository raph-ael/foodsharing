<?php
class StatisticsControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new StatisticsModel();
		$this->view = new StatisticsView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		
		$content = $this->model->getContent(11);
		
		addTitle($content['title']);
		
		addBread($content['title']);
		
		$stat_gesamt = $this->model->getStatGesamt();
		
		$stat_cities = $this->model->getStatCities();
		
		foreach ($stat_cities as $i => $c)
		{
			$stat_cities[$i]['percent'] = $this->getPercent($stat_gesamt['fetchweight'],$c['fetchweight']);
		}
		
		$stat_fs = $this->model->getStatFoodsaver();
		
		addContent($this->view->getStatGesamt($stat_gesamt),CNT_TOP);
		
		addContent($this->view->getStatCities($stat_cities),CNT_LEFT);
		addContent($this->view->getStatFoodsaver($stat_fs),CNT_RIGHT);

		$this->setContentWidth(12,12);
	}
	
	private function getPercent($gesamt,$teil)
	{
		if($gesamt)
		{
			return  round(($teil / ($gesamt / 100)),0);
		}
		return 0;
	}
}
