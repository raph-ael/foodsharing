<?php 
class MapXhr extends Control
{
	public function __construct()
	{
		$this->model = new MapModel();
		$this->view = new MapView();

		parent::__construct();
	}
	
	public function savebpos()
	{
		
		$lat = floatval($_GET['lat']);
		$lon = floatval($_GET['lon']);
		
		S::set('blocation', array(
			'lat' => $lat,
			'lon' => $lon
		));
		
		return array(
			'status' => 1
		);
		
	}
}
