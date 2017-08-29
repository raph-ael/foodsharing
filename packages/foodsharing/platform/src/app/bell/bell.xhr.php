<?php 
class BellXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new BellModel();
		$this->view = new BellView();

		parent::__construct();
	}
	
	/**
	 * ajax call to refresh infobar messages
	 */
	public function infobar()
	{
		S::set('badge-info',0);
		S::noWrite();
		
		$xhr = new Xhr();
		$bells = $this->model->listBells(20);
		
		if(!empty($rbells))
		{
			if($bells)
			{
				$bells = array_merge($rbells,$bells);
			}
			else
			{
				$bells = $rbells;
			}
		}
		
		// additionall add bell for BIEB
		if(isset($_SESSION['client']['verantwortlich']))
		{
			$ids = array();
			foreach ($_SESSION['client']['verantwortlich']as $v)
			{
				$ids[] = (int)$v['betrieb_id'];
			}
			if(!empty($ids))
			{
				if($betrieb_bells = $this->model->getBetriebBells($ids))
				{
					$bbells = array();
					
					foreach ($betrieb_bells as $b)
					{
						$bbells[]= array(
							'id'=> 'b-'.$b['id'],
							'name' => 'betrieb_fetch_title',
							'body' => 'betrieb_fetch',
							'vars' => array(
								'betrieb' => $b['name'],
								'count' => $b['count']
							),
							'attr' => array(
								'href' => '/?page=fsbetrieb&id='.$b['id']
							),
							'icon' => 'img img-store brown',
							'time' => $b['date'],
							'time_ts' => $b['date_ts'],
							'seen' => 0,
							'closeable' => 0
						);
					}
					if($bells)
					{
						$bells = array_merge($bbells,$bells);
					}
					else
					{
						$bells = $bbells;
					}
				}
			}
		}
		
		/*
		 * additional bells for new fairteiler
		 */
		if(S::may('bot'))
		{
			if($fbells = $this->model->getFairteilerBells())
			{
				$bbells = array();
					
				foreach ($fbells as $b)
				{
					$bbells[]= array(
							'id'=> 'f-'.$b['id'],
							'name' => 'sharepoint_activate_title',
							'body' => 'sharepoint_activate',
							'vars' => array(
									'bezirk' => $b['bezirk_name'],
									'name' => $b['name']
							),
							'attr' => array(
									'href' => '/?page=fairteiler&sub=check&id='.$b['id']
							),
							'icon' => 'img img-recycle yellow',
							'time' => $b['add_date'],
							'time_ts' => $b['time_ts'],
							'seen' => 0,
							'closeable' => 0
					);
				}
				if($bells)
				{
					$bells = array_merge($bbells,$bells);
				}
				else
				{
					$bells = $bbells;
				}
			}
		}
		
		$xhr->addData('html', $this->view->bellList($bells));
		
		$xhr->send();
	}
	
	/**
	 * ajax call to delete an bell
	 */
	public function delbell()
	{
		$this->model->delbell($_GET['id']);
	}
}
