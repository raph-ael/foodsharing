<?php
class BetriebView extends View
{
	public function dateForm()
	{
		return 
		'<div id="datepicker" style="height:195px;"></div>' . 
		v_input_wrapper('Uhrzeit', v_form_time('time')) .
		v_form_select('fetchercount',array('values' => array(
			array('id' => 1, 'name' => '1 Abholer/in'),
			array('id' => 2, 'name' => '2 Abholer/innen'),
			array('id' => 3, 'name' => '3 Abholer/innen'),
			array('id' => 4, 'name' => '4 Abholer/innen'),
			array('id' => 5, 'name' => '5 Abholer/innen'),
			array('id' => 6, 'name' => '6 Abholer/innen'),
			array('id' => 7, 'name' => '7 Abholer/innen'),
			array('id' => 8, 'name' => '8 Abholer/innen')
		)));
	}
	
	public function fetchHistory()
	{
		return v_form_daterange('daterange',array(
			'content_after' => ' <a href="#" id="daterange_submit" class="button"><i class="fa fa-search"></i></a>'
		)).'<div id="daterange_content"></div>';
	}
	
	public function fetchlist($history)
	{
		$out = '
			<ul class="linklist history">';
		$curdate = 0;
		foreach ($history as $h)
		{
			if($curdate != $h['date'])
			{
				$out .= '<li class="title">'.niceDate($h['date_ts']).'</li>';
				$curdate = $h['date'];
			}
			$out .= '
				<li>
					<a class="corner-all" href="#" onclick="profile('.(int)$h['id'].');return false;">
						<span class="i"><img src="'.img($h['photo']).'" /></span>
						<span class="n">'.$h['name'].' '.$h['nachname'].'</span>
						<span class="t"></span>
						<span class="c"></span>
					</a>
				</li>';
		}
		
		$out .= '
			</ul>';
		
		return $out;
	}
}