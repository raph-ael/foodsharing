<?php
class PassgenView extends View
{
	public function passTable($bezirk)
	{
		$data = array();
		
		foreach ($bezirk['foodsaver'] as $fs)
		{
			$last = '<span style="display:none">a0</span> <a href="#" class="dateclick linkrow ui-corner-all"> - '.s('never_generated').' - </a>';
			if($fs['last_pass'] != '0000-00-00 00:00:00')
			{
				$last = '<span style="display:none">a'.date('YmdHis',$fs['last_pass_ts']).'</span> <a href="#" class="dateclick linkrow ui-corner-all">'.niceDate($fs['last_pass_ts']).'</a>';
			}
			
			$verified = '<span style="display:none">b</span><a title="'.sv('click_to_verify',$fs['name']).'" href="#" class="verify verify-n"><span></span></a>';
			if($fs['verified'])
			{
				$verified = '<span style="display:none">a</span><a href="#" title="'.s('click_to_unverify').'" class="verify verify-y"><span></span></a>';
			}
			
			if(!empty($fs['photo']))
			{
				$img = 'images/thumb_crop_'.$fs['photo'];
			}
			else
			{
				$img = img($fs['photo']);
			}
			
			$data[] = array(
					array('cnt' => '<input class="checkbox bezirk'.$bezirk['id'].' date'.date('Y-m-d-H-i-s',$fs['last_pass_ts']).'" type="checkbox" name="foods[]" value="'.$fs['id'].'" />'),
					array('cnt' => '<span style="display:none">a'.$fs['photo'].'</span><a href="#" class="fsname"><img src="'.$img.'" width="35" /></a>'),
					array('cnt' => '<a href="/?page=foodsaver&a=edit&id='.$fs['id'].'" class="linkrow ui-corner-all">'.$fs['name'].'</a>'),
					array('cnt' => $last),
					array('cnt' => $verified)
			);
		}
		
		return 
		v_field(
			v_tablesorter(array(
				array('name'=> '<input class="checker" type="checkbox" name="checker" value="'.$bezirk['id'].'" />','sort'=>false,'width'=>20),
				array('name'=>s('photo'),'width'=>40),
				array('name'=>s('name')),
				array('name'=>s('last_generated'),'width'=>200),
				array('name'=>s('verified'),'width'=>70)
			), $data)
			, $bezirk['bezirk']);
		
		
	}
	
	public function menubar()
	{
		return v_menu(array(
			array('name'=>'Alle markieren','click'=>'checkAllCb(true);return false;'),
			array('name'=>'Keine markieren','click'=>'checkAllCb(false);return false;')
		),s('options'));
	}
	
	public function start()
	{
		return v_menu(array(
				array('name'=>'markierte Ausweise generieren','href'=>'#start')
		),s('start'));
	}
	
	public function tips()
	{
		return v_info(s('tips_content'),s('tips'));
	}
}
