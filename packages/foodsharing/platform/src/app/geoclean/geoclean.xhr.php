<?php 

class GeocleanXhr extends Control
{
	public function __construct()
	{
		$this->model = new GeocleanModel();
		$this->view = new GeocleanView();

		parent::__construct();
		
		if(!S::may('orga'))
		{
			return false;
		}
	}

	public function masterupdate()
	{
		if($bezirke = $this->model->getChildBezirke($_GET['id'],true))
		{
			$this->model->update('UPDATE '.PREFIX.'bezirk SET `master` = '.$_GET['id'].' WHERE id IN('.implode(',', $bezirke).')');
		}
	}
	
	public function updateGeo()
	{
		$lat = $_GET['lat'];
		$lon = $_GET['lon'];
		$fsid = $_GET['id'];
		
		if($this->model->updateGeo($fsid,$lat,$lon))
		{
			return array(
				'status' => 1,
				'script' => '$("#fs-'.$fsid.'").parent().parent().remove();pulseInfo("Koordinaten gespeichert!");'
			);
		}
		
	}
	
}

