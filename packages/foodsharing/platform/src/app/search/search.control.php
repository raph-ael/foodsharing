<?php
class SearchControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new SearchModel();
		$this->view = new SearchView();
		
		parent::__construct();
		
		if(!S::may('fs'))
		{
			go('/dashboard');
		}
	}
	
	public function index()
	{
		addBread(s('search'));
		$value = '';
		$out ='';
		
		if(isset($_GET['q']) && strlen($_GET['q']) > 0)
		{
			$value = strip_tags($_GET['q']);
			if($res = $this->model->search($value))
			{
				foreach ($res as $key => $r)
				{
					$cnt = '';
					foreach ($r as $erg)
					{
						$cnt .= v_input_wrapper($erg['name'], $erg['teaser'],'search',array('click'=>$erg['click']));
					}
					$out .= v_field($cnt, count($r).' '.s($key).' gefunden',array('class'=>'ui-padding'));
				}
			}
			else
			{
				$out .= v_field(v_info('Die Suche gab leider keine Treffer'), 'Ergebnis',array('class'=>'ui-padding'));
			}
		}
		
		addContent($this->view->searchBox($value));
		addContent($out);
	}
}