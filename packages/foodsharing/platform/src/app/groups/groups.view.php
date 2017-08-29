<?php
class GroupsView extends View
{
	private $ag_id;
	
	public function setAgId($id)
	{
		$this->ag_id = $id;
	}
	
	public function leftNavi($countrys,$bezirke)
	{		
		$out = '';
		
		// Überregionale
		$items = array();
		$items[] = array('name' => 'Alle anzeigen','href' => '/groups');
		$out .= v_field(v_menu($items), 'Überregionale Gruppen');
		
		
		// Lokale Gruppen
		$items = array();
		if(is_array($bezirke))
		{
			foreach ($bezirke as $b)
			{
				if($b['type'] != 7 && $b['type'] != 6)
				{
					$items[] = array('name' => 'Gruppen für '.$b['name'],'href' => '/groups?p='.$b['id']);
				}
			}
		}
		
		$out .= v_field(v_menu($items), 'Lokalgruppen');
		
		
		// Ländegruppen
		$items = array();
		foreach ($countrys as $c)
		{
			$items[] = array('name' => 'Gruppen für '.$c['name'],'href' => '/groups?p='.$c['id']);
		}
		$out .= v_field(v_menu($items), 'Länderspezifische Gruppen');

		
		/*
		 * Deine Bezirke
		*/
		$orgacheck = false;
		$orga = '';
		if(isset($_SESSION['client']['bezirke']))
		{
			$orga = '
		<ul class="linklist">';
			foreach ($_SESSION['client']['bezirke'] as $b)
			{
				if($b['type'] == 7)
				{
					$orgacheck = true;
					$orga .= '
			<li><a class="ui-corner-all" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a></li>';
				}
			}
			$orga .= '
		</ul>';
		
		}
		
		if($orgacheck)
		{
			$out .= v_field($orga, 'Deine Gruppen',array('class'=>'ui-padding'));
		}	
		
	
		return $out;
	}
	
	public function listGroups($groups,$myapps,$mystats)
	{	
		addJs('
				$(".fancybox").fancybox();
				/*
				$contents = $(".groups .field div.ui-widget.ui-widget-content");
				$contents.css({
					"overflow":"hidden"
				});
				
				$contents.animate({
					height:10,
					padding:0
				});
				*/
				
		');
		$out = '
		<div class="groups">';
		
		foreach ($groups as $g)
		{
			$group = '';
			if($g['leader'])
			{
				shuffle($g['leader']);
				$member = '
			<div class="members">
				';
				
				$max = 16;
				foreach ($g['leader'] as $m)
				{
					$max--;
					$member .= '
				<a class="member" href="#" onclick="profile('.(int)$m['id'].');return false;"><img src="'.img($m['photo']).'" alt="'.$m['name'].'" /></a>';
					if($max == 0)
					{
						break;
					}
				}
				
				$member .= '
				<div><strong>'.count($g['leader']).' Admin/s</strong></div>
				<div>'.count($g['member']).' Mitwirkende</div>
				
			</div>';
				
				$group .= $member;
			}
			
			$photo = '';
			if(!empty($g['photo']))
			{
				$photo .= '
			<div class="photo">
				<a class="fancybox" href="'.$this->img($g['photo'],'').'"><img src="'.$this->img($g['photo']).'" alt="'.$g['name'].' Titelbild" /></a>
			</div>';
			}
			
			$group .= $photo;
			
			$btn = '<a class="button" href="#" onclick="ajreq(\'contactgroup\',{id:'.(int)$g['id'].'});return false;">Gruppe kontaktieren</a>';
			
			$info = '';
			
			if(isOrgaTeam() || isBotFor($g['id']) || isBotFor($g['parent_id']))
			{
				$btn .= '<a class="button" href="/groups?sub=edit&id='.$g['id'].'">Gruppe bearbeiten</a>';
			}
			
			if(mayBezirk($g['id']) || isBotFor($g['parent_id']))
			{
				$btn .= '<a class="button" href="/?page=bezirk&bid='.$g['id'].'">Zur Gruppe</a>';
			}				
			
				
			if(isset($myapps[$g['id']]))
			{
				$info = '<div class="ui-padding">'.v_info('Für diese Gruppe hast Du Dich bereits beworben').'</div>';
			}
			elseif(!hasBezirk($g['id']))
			{
				if($this->canApply($g,$mystats))
				{
					$btn .= '<a class="button" href="#" onclick="ajreq(\'apply\',{id:'.$g['id'].'});">Für diese Arbeitsgruppe bewerben</a>';
				}
				elseif ($g['apply_type'] == 3)
				{
					$btn .= '<a class="button" href="#" onclick="ajreq(\'addtogroup\',{id:'.$g['id'].'});">Dieser Arbeitsgruppe beitreten</a>';
				}
				elseif ($g['apply_type'] == 1 && !S::may('orga'))
				{
					$info .= v_info('
						Für Diese Arbeitsgruppe kannst Du Dich mit ' . $g['banana_count'].' Vertrauensbananen und '.$g['fetch_count'].' Abholungen bewerben sofern Du schon '.$g['week_num'].' Wochen als Foodsaver dabei bist		
					').'<div style="margin-bottom:5px;"></div>';
				}
			}
			
			
			$group .= '
			<div class="teaser">
				'.nl2br($g['teaser']).'
				<p style="margin-top:15px;"><strong>'.$g['email'].'</strong></p>
			</div>
				
			<div class="clear"></div>
			<div class="bottom_bar">
				'.$info.'
				<div class="float_right">
					'.$btn.'
				</div>
				<div class="clear"></div>
			</div>';
			
			$out .= v_field($group, $g['name'],array('class' => 'ui-padding'));
			
		}
		
		$out .= '
		</div>';
		
		return $out;
	}
	
	public function canApply($group,$mystats)
	{
		
		if($group['apply_type'] == 0)
		{
			return false;
		}
		
		// apply_type
		
		if($group['apply_type'] == 1)
		{
			if(
				$mystats['bananacount'] >= $group['banana_count'] &&
				$mystats['fetchcount'] >= $group['fetch_count'] &&
				$mystats['weeks'] >= $group['week_num']
			)
			{
				if((int)$group['report_num'] == 0 && (int)$mystats['reports'] > 0)
				{
					return false;
				}
				return true;
			}
		}
		else if($group['apply_type'] == 2)
		{
			return true;
		}
		
		
		return false;
	}
	
	public function applyForm($group)
	{
		return v_form('apply', array(
			v_form_textarea('motivation',array('label' => 'Was ist Deine Motivation, in der Gruppe '.$group['name'].' mitzuwirken?')),
			v_form_textarea('faehigkeit',array('label' => 'Was sind Deine Fähigkeiten, die Du in diesem Bereich hast?')),
			v_form_textarea('erfahrung',array('label' => 'Kannst Du in der Gruppe auf Erfahrungen, die Du woanders gesammelt hast zurückgreifen? Wenn ja, wo bzw. was?')),
			v_form_select('zeit',array('label' => 'Wie viele Stunden hast Du pro Woche Zeit und Lust dafür aufzuwenden?','values' => array(
				array('id' => '1-2 Stunden','name' => '1-2 Stunden'),
				array('id' => '2-3 Stunden','name' => '2-3 Stunden'),
				array('id' => '3-4 Stunden','name' => '3-4 Stunden'),
				array('id' => '5 oder mehr Stunden','name' => '5 oder mehr Stunden')
			)))
		),array('submit' => false));
	}
	
	public function editGroup($group)
	{
		
		if($group['apply_type'] != 1)
		{
			addJs('$("#addapply").hide();');
		}
		
		addJs('
			$("#apply_type").change(function(){
				if($(this).val() == 1)
				{
					$("#addapply").show();
				}
				else
				{
					$("#addapply").hide();
				}
			});		
		');
		
		$out = '';
		
		setEditData($group);

		$basics = v_form_text('name') .
			v_form_textarea('teaser') .
			v_form_picture('photo',array('resize'=>array(528,60,128),'crop'=>array((528/350),1)));
		
		$apply = v_form_select('apply_type',array(
			'values' => array(
				array('id' => 0, 'name' => 'Niemand (geschlossene Gruppe)'),
				array('id' => 1, 'name' => 'Jeder, der bestimmte Vertrauenspunkte erfüllt'),
				array('id' => 2, 'name' => 'Jeder darf sich bewerben'),
				array('id' => 3, 'name' => 'Jeder kann sich ohne Bewerbung einklinken')
			)		
		)) . 
		'<div id="addapply">' .
			v_form_text('banana_count') . 
			v_form_text('fetch_count') . 
			v_form_text('week_num') . 
			v_form_checkbox('report_num',array('values' => array(
				array('id' => 1, 'name' => 'Ja, auch Foodsaver mit Verstoßmeldungen können sich bewerben.')		
			))) .
		'</div>';
		
		$out .= v_form('editgroup', array(
			v_field($basics, $group['name'].' bearbeiten',array('class' => 'ui-padding')),
			v_field($apply, 'Bewerbungen',array('class' => 'ui-padding')),
			v_field(v_form_tagselect('member',array('xhr' => 'recip')), s('member'),array('class' => 'ui-padding')),
			v_field(v_form_tagselect('leader',array('xhr' => 'recip')), s('leader'),array('class' => 'ui-padding'))
		),array('submit' => 'Änderungen speichern'));

		return $out;
	}
	
	private function img($img, $prefix = 'crop_1_128_')
	{
		return 'images/' . str_replace('/', '/'.$prefix, $img);
	}
	
	public function contactgroup($group)
	{
		$head = '';
		
		if($group['leader'])
		{
			foreach ($group['leader'] as $gl)
			{
				$head .= '<a style="margin:4px 4px 0 0;" onclick="profile('.(int)$gl['id'].');return false;" href="#" class="member"><img alt="'.$gl['name'].'" src="'.img($gl['photo']).'"></a>';
			}
			$head = v_input_wrapper(count($group['leader']).' Ansprechpartner', $head);
			
		}
		
		
		return $head.v_form_textarea('message');
	}
}
