<?php
class StatisticsView extends View
{
	public function getStatCities($cities)
	{
		$out = '
		<table class="stat_cities">
		';
	
		if(is_array($cities))
		{
			$i = 0;
			foreach($cities as $c)
			{
				$i++;
				$out .= '
				<tr>
					<td style="width:5px;text-align:right;padding-right:5px;" valign="top">
						<h4>'.$i.'.</h4>
					</td>
					<td class="city">
						<h4>'.$c['name'].'</h4>
						<p>'.str_replace(',00', '', number_format($c['fetchweight'], 2, ',', '.')).'<span style="white-space:nowrap">&thinsp;</span>kg ('.$c['percent'].'%)</p>
						<div class="percentbar">
							<div class="inner" style="width:'.$c['percent'].'%;"></div>
						</div>
					</td>
				</tr>';
			}
		}
		$out .= '
		</table>';
	
		return v_field($out,s('active_cities'),array('class'=> 'ui-padding'));
	}
	
	public function getStatGesamt($stat)
	{
		/*
		 *  fetchweight,
		fetchcount,
		postcount,
		betriebcount,
		korpcount,
		botcount,
		fscount,
		fairteilercount
		*/
		return v_field('
		<div id="stat_whole">
			<div class="stat_item">
					<div class="stat_badge">
						<div class="stat_icon fetchweight"></div>
					</div>
					<div class="stat_text">
						<h4>'.str_replace(',00', '', number_format($stat['fetchweight'], 2, ',', '.')).'<span style="white-space:nowrap">&thinsp;</span>kg</h4>
						<p>Lebensmittel erfolgreich vor der Tonne gerettet.</p>
					</div>
			</div>
			<div class="stat_item">
					<div class="stat_badge">
						<div class="stat_icon fetchcount"></div>
					</div>
					<div class="stat_text">
						<h4>'.number_format($stat['fetchcount'], 0, ',', '.').'</h4>
						<p>Rettungs-Einsätze haben unsere Foodsaver gemeistert.</p>
					</div>
			</div><br />
			<div class="stat_item">
					<div class="stat_badge">
						<div class="stat_icon korpcount"></div>
					</div>
					<div class="stat_text">
						<h4>'.number_format($stat['korpcount'], 0, ',', '.').'</h4>
						<p>Betriebe kooperieren kontinuierlich und zufrieden mit uns.</p>
					</div>
			</div>
			<div class="stat_item">
					<div class="stat_badge">
						<div class="stat_icon fscount"></div>
					</div>
					<div class="stat_text">
						<h4>'.number_format($stat['fscount'], 0, ',', '.').'</h4>
						<p>Foodsaver engagieren sich ehrenamtlich für eine Welt ohne Verschwendung von Lebensmitteln</p>
					</div>
			</div><br />
		</div>',s('stat_whole'));
	}
	
	public function getStatFoodsaver($foodsaver)
	{
		$out = '
		<table class="stat_cities">
		';
	
		if(is_array($foodsaver))
		{
			$i = 0;
			foreach($foodsaver as $fs)
			{
				$i++;
				$out .= '
				<tr>
					<td style="width:5px;text-align:right;padding-right:5px;" valign="top">
						<h4>'.$i.'.</h4>
					</td>
					<td class="city">
						<h4>'.$fs['name'].'</h4>
						<p>'.str_replace(',00', '', number_format($fs['fetchweight'], 2, ',', '.')).'<span style="white-space:nowrap">&thinsp;</span>kg</p>
						<p>'.number_format($fs['fetchcount'], 0, ',', '.').'x abgeholt</p>
					</td>
				</tr>';
			}
		}
		$out .= '
		</table>';
	
		return v_field($out,'unsere Foodsaver',array('class'=>'ui-padding'));
	}
}