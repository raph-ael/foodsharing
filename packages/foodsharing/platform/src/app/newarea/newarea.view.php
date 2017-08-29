<?php
class NewareaView extends View
{
	public function listWantNews($foodsaver)
	{
		$rows = array();
		foreach ($foodsaver as $d)
		{
			$beziks = '';
			if(is_array($d['bezirke']))
			{
				foreach ($d['bezirke'] as $bz)
				{
					$beziks .= ', '.$bz['name'];
				}
				$beziks = substr($beziks, 2);
			}
			
			$rows[] = array(
				array('cnt' => '<input class="wantnewcheck" type="checkbox" name="ordersaver[]" value="'.$d['id'].'" />'),
				array('cnt' => '<span class="photo"><a href="#" onclick="profile('.(int)$d['id'].');return false;"><img src="'.img($d['photo']).'" /></a></span>'),
				array('cnt' => '<a class="linkrow ui-corner-all" href="#" onclick="profile('.(int)$d['id'].');return false;">'.$d['name'].'</a>'),
				array('cnt' => $d['anschrift'].', '.$d['plz'].' '.$d['stadt']),
				array('cnt' => $beziks),
				array('cnt' => $d['new_bezirk'])
			);
		}
		$out = v_tablesorter(array(
			array('name' => '','sort' => false),
			array('name' => '','sort' => false),
			array('name' => 'Name'),
			array('name' => 'Adresse'),
			array('name' => 'Bezirke'),
			array('name' => 'Gewünschter Bezirk')
		), $rows);
		
		return v_field($out, 'Foodsaver mit neuem Bezirkswünschen');
	}
	
	public function options()
	{
		return v_menu(array(
			array('name' => 'Markierte Anfragen löschen','click'=>'deleteMarked();return false;')
		),'Optionen');
	}
	
	public function orderToBezirk()
	{
		$out = '';
		
		global $g_data;
		$g_data['order_msg'] = "{ANREDE} {NAME},\n\n";
		$g_data['subject'] = 'Dein gewünschter Bezirk wurde angelegt!';
		$out .= v_bezirkChooser('order_bezirk');
		$out .= v_form_textarea('order_msg');
		$out .= v_form_text('subject');
		$out .= '<a class="button" id="orderFs">Speichern & Senden</a>';
		
		return v_field($out, 'Markierte Foodsaver zu Bezirk',array('class'=>'ui-padding'));
	}
}