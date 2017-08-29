<?php 
class SearchXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new SearchModel();
		$this->view = new SearchView();

		parent::__construct();
	}
	
	public function search()
	{
		if(S::may('fs'))
		{
			if($res = $this->model->search($_GET['s']))
			{
				
				$out = array();
				foreach ($res as $key => $value)
				{
					if(count($value) > 0)
					{
						$out[] = array(
								'title' => s($key),
								'result' => $value
						);
					}
					
				}

				return array(
					'data' => $out,
					'status' => 1
				);
			}
		}
		
		return array(
			'status' => 0
		);
	}
}
