<?php
class ApplicationView extends View
{
	private $bezirk;
	private $bezirk_id;
	
	public function setBezirk($bezirk)
	{
		$this->bezirk = $bezirk;
		$this->bezirk_id = $bezirk['id'];
	}
	
	public function applicationMenu($application)
	{
		return v_menu(array(
			array('click' => 'ajreq(\'apply\',{bid:'.(int)$this->bezirk_id.',fid:'.(int)$application['id'].'});return false;', 'name' => 'Ja'),
			array('click' => 'ajreq(\'noapply\',{bid:'.(int)$this->bezirk_id.',fid:'.(int)$application['id'].'});return false;', 'name' => 'Nein'),
			array('click' => 'ajreq(\'maybeapply\',{bid:'.(int)$this->bezirk_id.',fid:'.(int)$application['id'].'});return false;', 'name' => 'Vielleicht')
		),'Bewerbung Annehmen');
	}
	
	public function application($application)
	{
		
		$out = $this->headline('Bewerbung für '.$this->bezirk['name'].' von '.$application['name'],img($application['photo']),'profile('.$application['id'].');');
		
		$cnt = nl2br($application['application']);
			
		$cnt = v_input_wrapper($application['name'], $cnt);
		$cnt .= '<div class="clear"></div>';
			
		$out .= v_field($cnt, 'Motivations-Text',array('class' => 'ui-padding'));
		
		return $out;
	}
}
