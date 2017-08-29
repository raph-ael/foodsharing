<?php
class ReportView extends View
{
	private $foodsaver;
	
	public function setFoodsaver($foodsaver)
	{
		$this->foodsaver = $foodsaver;
	}
	
	public function betriebList($betriebe)
	{
		return v_form_select('betrieb_id',array('label'=>sv('betrieb_id',$this->foodsaver['name']),'values'=>$betriebe));
	}
	
	public function reportDialog()
	{
		return v_input_wrapper('Warum möchtest Du '.$this->foodsaver['name'].' melden?', '

			'.v_form_select('reportreason',array('required'=>true,'nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'Ist zu spät zum Abholen gekommen'
				),
				array(
					'id' => 2,
					'name' => 'Ist gar nicht zum Abholen gekommen'
				),
				array(
					'id' => 3,
					'name' => 'Hat sich unhöflich oder respektlos verhalten'
				),
				array(
					'id' => 4,
					'name' => 'Hat den Abholort nicht sauber hinterlassen'
				),
				array(
					'id' => 5,
					'name' => 'Hat sich nicht gemeinschaftlich und sozial beim Abholen verhalten'
				),
				array(
					'id' => 6,
					'name' => 'Hat sich fordernd/übergriffig verhalten'
				),
				array(
					'id' => 7,
					'name' => 'Hat Vorwürfe gemacht'
				),
				array(
					'id' => 8,
					'name' => 'Hat Sachen mitgenommen die nicht für ihn/sie bestimmt waren'
				),
				array(
					'id' => 9,
					'name' => 'Hat Pfandflaschen/-kisten etc. nicht zurückgebracht'
				),
				array(
					'id' => 10,
					'name' => 'Häufiges kurzfristiges Absagen der Abholungen'
				),
				array(
					'id' => 11,
					'name' => 'Ignoriert Kontaktaufnahme'
				),
				array(
					'id' => 12,
					'name' => 'Schmeißt gerettete Lebensmittel weg'
				),
				array(
					'id' => 13,
					'name' => 'Nimmt nicht alle zur Abholung vorgesehenen Lebensmitteln mit'
				),
				array(
					'id' => 14,
					'name' => 'Hat sich außerhalb seiner/ihrer Abholzeit beim Betrieb zu rettende Lebensmittel genommen oder nachgefragt'
				),
				array(
					'id' => 15,
					'name' => 'Verkauft gerettete Lebensmittel'
				),
				array(
					'id' => 16,
					'name' => 'Hat gegen andere Verhaltensregeln verstoßen (alles andere)'
				)
			))).'<br />
			<div id="reportreason_3" class="cb" style="margin:5px 0px;">
			'.v_form_checkbox('reportreason_3',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'gegenüber Foodsavern'
				),
				array(
					'id' => 2,
					'name' => 'gegenüber BetriebsmitarbeiterInnen'
				)
			))).'
			</div>
			'.v_form_select('reportreason_3_sub',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'beleidigende Äußerungen'
				),
				array(
					'id' => 2,
					'name' => 'rassistische Äußerungen'
				),
				array(
					'id' => 3,
					'name' => 'sexistische Äußerungen'
				),
				array(
					'id' => 4,
					'name' => 'homophobe Äußerungen'
				),
				array(
					'id' => 5,
					'name' => 'Gewaltätigkeit und Drohung'
				),
				array(
					'id' => 6,
					'name' => 'Andere unangebrachte Äußerungen und Verhalten'
				)
			))).'
			<div id="reportreason_6" class="cb">
			'.v_form_checkbox('reportreason_6',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'gegenüber BetriebsmitarbeiterInnen'
				),
				array(
					'id' => 2,
					'name' => 'gegenüber Foodsavern'
				),
				array(
					'id' => 3,
					'name' => 'gegenüber Kunden'
				)
			))).'
			</div>
			<div id="reportreason_5" class="cb">
			'.v_form_checkbox('reportreason_5',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'vor BetriebsmitarbeiterInnen'
				),
				array(
					'id' => 2,
					'name' => 'vor Foodsavern'
				),
				array(
					'id' => 3,
					'name' => 'vor Kunden'
				)
			))).'
			</div>
			<div id="reportreason_7" class="cb">
			'.v_form_checkbox('reportreason_7',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'gegenüber BetriebsmitarbeiterInnen'
				),
				array(
					'id' => 2,
					'name' => 'gegenüber Foodsavern'
				),
				array(
					'id' => 3,
					'name' => 'gegenüber Kunden'
				)
			))).'
			</div>
			<div id="reportreason_8" class="cb">
			'.v_form_checkbox('reportreason_8',array('nowrapper' => true,'value' => 1,'values'=>array(
				array(
					'id' => 1,
					'name' => 'von BetriebsmitarbeiterInnen'
				),
				array(
					'id' => 2,
					'name' => 'von Foodsavern'
				),
				array(
					'id' => 3,
					'name' => 'von Kunden'
				)
			))).'
			</div>');
	}
	
	public function statsMenu($stats)
	{
		$menu = array(
			array('name' => 'Neue Meldungen ('.$stats['new'].')','href' => '/?page=report&sub=uncom'),
			array('name' => 'Bestätigte ('.$stats['com'].')','href' => '/?page=report&sub=com')		
		);
		
		$active = 'uncom';
		if($_GET['sub'] == 'com')
		{
			$active = 'com';
		}
		
		return $this->menu($menu,array('active' => $active));
	}
	
	public function listReportsTiny($reports)
	{
		$out = '<ul class="linklist">';
		
		foreach ($reports as $r)
		{
			$name = '';
			if(!empty($r['rp_name']))
			{
				$name = ' von '.$r['rp_name'].' '.$r['rp_nachname'].'';
			}
			$out .= '<li><a href="#" onclick="ajreq(\'loadreport\',{id:'.(int)$r['id'].'})">'.date('d.m.Y',$r['time_ts']).$name.'</a></li>';
		}
		
		$out .= '</ul>';
		
		return v_field($out,'Alle Meldungen');
	}
	
	public function listReports($reports)
	{
		addStyle('#table td{ cursor:pointer; }');
		
		addJs('
			$("#table tr").click(function(){
				rid = parseInt($(this).children("td:first").children("input:first").val());
				ajreq("loadreport",{id:rid});
			});		
		');
		
		$rows = array();
		foreach ($reports as $r)
		{
			$rows[] = array(
				array('cnt' => '<input type="hidden" class="rid" name="rid" value="'.$r['id'].'"><span class="photo"><a title="'.$r['fs_name'].' '.$r['fs_nachname'].'" href="#" onclick="profile('.(int)$r['fs_id'].');return false;"><img id="miniq-'.$r['fs_id'].'" src="'.img($r['fs_photo']).'" /></a></span>'),
				array('cnt' => '<span class="photo"><a title="'.$r['rp_name'].' '.$r['rp_nachname'].'" href="#" onclick="profile('.(int)$r['rp_id'].');return false;"><img id="miniq-'.$r['rp_id'].'" src="'.img($r['rp_photo']).'" /></a></span>'),		
				array('cnt' => tt($r['msg'],50)),
				array('cnt' => '<span style="display:none;">a'.$r['time_ts'].' </span>'.niceDateShort($r['time_ts']).' Uhr'),
				array('cnt' => $r['fs_stadt']),
			);
		}
		
		$table = v_tablesorter(array(
				array('name' => 'An', 'width' => 50),
				array('name' => 'Von', 'width' => 50),
				array('name' => s('message')),
				array('name' => s('datetime'),'width' => 80),
				array('name' => 'FS Wohnort', 'width' => 25)
		),$rows,array('pager'=>true));
		
		return $table;
	}
	
	public function listReportedSavers($foodsaver)
	{
		if(is_array($foodsaver))
		{
			return v_field($this->fsAvatarList($foodsaver,array('noshuffle' => true)),'Alle gemeldeten Foodsaver');
		}
	}
}
