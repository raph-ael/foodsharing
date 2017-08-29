<?php
class FoodsaverView extends View
{
	public function addFoodsaver($bezirk)
	{
		$cnt = v_form_tagselect('search_name',array('required'=>true,'xhr' => 'recip'));
		
		$cnt .= v_input_wrapper('', '<span class="button" onclick="fsapp.addFoodsaver();">'.s('add').'</span>');
		
		$cnt .= '
			<div id="appdata" style="display:none">
				<input type="hidden" name="bid" class="bid" value="'.$bezirk['id'].'" />
			</div>';
		
		return v_field($cnt, 'Foodsaver hinzufügen',
						array('class' => 'ui-padding'));
	}
	
	public function foodsaverForm($foodsaver = false)
	{
		if($foodsaver === false)
		{
			return '<div id="fsform"></div>';
		}
		else
		{
			$cnt = v_input_wrapper('Foto', '<a class="avatarlink corner-all" href="#" onclick="profile('.(int)$foodsaver['id'].');return false;"><img style="display:none;" class="corner-all" src="'.img($foodsaver['photo'],'med').'" /></a>');
			$cnt .= v_input_wrapper('Name', $foodsaver['name'].' '.$foodsaver['nachname']);
			$cnt .= v_input_wrapper('Rolle', s('rolle_'.$foodsaver['rolle'].'_'.$foodsaver['geschlecht']));
			
			$cnt .= v_input_wrapper('Letzter Login',$foodsaver['last_login']);
			
			$cnt .= v_input_wrapper('Optionen', '
				<span class="button" onclick="fsapp.delfromBezirk('.$foodsaver['id'].');">Aus Bezirk löschen</span>		
			');
			
			return v_field($cnt, $foodsaver['name'],array('class' => 'ui-padding'));
		}
	}
	
	public function foodsaverList($foodsaver,$bezirk)
	{
		return 
		'<div id="foodsaverlist">'.
			v_field(
				$this->fsAvatarList($foodsaver,array('id' => 'fslist','shuffle' => false)),
				'Foodsaver in '.$bezirk['name']
			).'
		</div>';
	}
}