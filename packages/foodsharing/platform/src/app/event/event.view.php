<?php
class EventView extends View
{
	public function eventForm($bezirke)
	{
		global $g_data;
		
		$g_data = array_merge(array(
			'online_type' => 1,
			'invite' => 1,
			'invitesubs' => 1
		),$g_data);
		
		$start_time = array('hour'=>15,'min'=>0);
		$end_time = array('hour'=>16,'min'=>0);
		
		
		
		if(isset($g_data['start']))
		{
			$start_time = array('hour'=>(int)date('H',$g_data['start_ts']),'min'=>(int)date('i',$g_data['start_ts']));
			$g_data['date'] = $g_data['start'];
		}
		
		if(isset($g_data['end']))
		{
			$end_time = array('hour'=>(int)date('H',$g_data['end_ts']),'min'=>(int)date('i',$g_data['end_ts']));
			$g_data['dateend'] = $g_data['end'];
		}
	
		$title = s('new_event');
		addStyle('
			label.addend{
				display:inline-block;
				margin-left:15px;
				cursor:pointer;
			}
		');
		addJs('
			$("#online_type").change(function(){
				if($(this).val() == 0)
				{
					$("#location_name-wrapper").removeClass("required");
					$("#location_name-wrapper").next().hide();
					$("#location_name-wrapper, #anschrift-wrapper, #plz-wrapper, #ort-wrapper").hide();
				}
				else
				{
					$("#location_name-wrapper").addClass("required");
					$("#location_name-wrapper").next().show();
					$("#location_name-wrapper, #anschrift-wrapper, #plz-wrapper, #ort-wrapper").show();
				}
			});
			$("#dateend-wrapper").hide();
			$("#date").after(\'<label class="addend"><input type="checkbox" name="addend" id="addend" value="1" /> Das Event geht über mehrere Tage</label>\');
	
			$("#addend").change(function(){
				if($("#addend:checked").length > 0)
				{
					$("#dateend-wrapper").show();
				}
				else
				{
					$("#dateend-wrapper").hide();
				}
			});
	
			');
		
		
		
		$bez = '';
		$ag = '';
		$sid = 0;
		if(isset($g_data['bezirk_id']))
		{
			$sid = (int)$g_data['bezirk_id'];
		}
		else if(isset($_GET['bid']))
		{
			$sid = (int)$_GET['bid'];
		}
		if(is_array($bezirke))
		{
			foreach ($bezirke as $b)
			{
				$sel = '';
				
				if($b['id'] == $sid)
				{
					$sel = ' selected="selected"';
				}
				
				if($b['type'] == 7)
				{
					$ag .= '<option value="'.$b['id'].'"'.$sel.'>'.$b['name'].'</option>';
				}
				else
				{
					$bez .= '<option value="'.$b['id'].'"'.$sel.'>'.$b['name'].'</option>';
				}
			}
		}
		
		if(!empty($ag))
		{
			$ag = '<optgroup label="Deine Arbeitsgruppen">'.$ag.'</optgroup>';
		}
		if(!empty($bez))
		{
			$bez = '<optgroup label="Deine Bezirke">'.$bez.'</optgroup>';
		}
		
		addJs('
			$("#public").change(function(){
				if($("#public:checked").length > 0)
				{
					$("#input-wrapper").hide();
				}
				else
				{
					$("#input-wrapper").show();
				}
			});		
		');
		
		$delinvites = '';
		if(isset($_GET['id']))
		{
			$delinvites = '<br /><label><input type="checkbox" name="delinvites" id="delinvites" value="1" /> Vorhandene Einladungen löschen?</label>';
		}
		
		
		$bezirkchoose = v_input_wrapper('Für welchen Bezirk oder welche AG ist das Event?', '
			<select class="input select value" name="bezirk_id" id="bezirk_id">
				'.$ag.'
				'.$bez.'
			</select>
			<p style="padding-top:10px;">
				<label><input type="checkbox" name="invite" id="invite" checked="checked" value="'.$g_data['invite'].'" /> Alle Foodsaver aus der Gruppe/dem Bezirk zum Termin einladen?</label><br />
				<label><input type="checkbox" name="invitesubs" id="invitesubs" checked="checked" value="'.$g_data['invitesubs'].'" /> Alle untergeordneten Gruppen/Bezirke einschließen?</label>
				'.$delinvites.'
			</p>
		');
		
		$public_el = '';
		
		if(isOrgaTeam())
		{
			$chk = '';
			if(isset($g_data['public']) && $g_data['public'] == 1)
			{
				$chk = ' checked="checked"';
				addJs('$("#input-wrapper").hide();');
			}
			$public_el = v_input_wrapper('Ist die Veranstaltung öffentlich?', '<label><input id="public" type="checkbox" name="public" value="1"'.$chk.' /> Ja die Veranstaltung ist Öffentlich</label>');
		}
		
		return v_field(v_form('eventsss', array(
				$public_el,
				$bezirkchoose,
				v_form_text('name',array('required'=>true)),
				v_form_date('date'),
				v_form_date('dateend'),
				v_input_wrapper('Uhrzeit Beginn', v_form_time('time_start',$start_time)),
				v_input_wrapper('Uhrzeit Ende', v_form_time('time_end',$end_time)),
				v_form_textarea('description',array('desc'=>s('desc_desc'),'required'=>true)),
				v_form_select('online_type',array('values' => array(
						array('id'=>1,'name' => s('offline')),
						array('id'=>0,'name'=> s('online'))
				))),
				v_form_text('location_name',array('required'=>true)),
				$this->latLonPicker('latLng')
		),array('submit'=>s('save'))), $title, array('class'=>'ui-padding'));
	}
	
	public function statusMenu($event,$user_status)
	{
		$menu = array();
		
		if($event['fs_id'] == fsid() || isOrgaTeam())
		{
			$menu[] = array(
				'name' => 'Event bearbeiten',
				'href' => '/?page=event&sub=edit&id='.(int)$event['id']
			);
		}
		
		if($user_status != -1)
		{
			if($user_status != 3)
			{
				$menu[] = array(
					'name' => 'Ich kann doch nicht',
					'click' => 'ajreq(\'ustat\',{id:'.(int)$event['id'].',s:3});return false;'
				);
			}
				
			if($user_status == 0)
			{
				$menu[] = array(
						'name' => 'Einladung annehmen',
						'click' => 'ajreq(\'ustat\',{id:'.(int)$event['id'].',s:1});return false;'
				);
			}
				
			if($user_status != 0 && $user_status != 1)
			{
				$menu[] = array(
					'name' => 'Ich kann doch',
					'click' => 'ajreq(\'ustat\',{id:'.(int)$event['id'].',s:1});return false;'
				);
			}
				
			if($user_status != 2)
			{
				$menu[] = array(
					'name' => 'Ich kann vielleicht',
					'click' => 'ajreq(\'ustat\',{id:'.(int)$event['id'].',s:2});return false;'
				);
			}
		}
		else
		{
			$menu[] = array(
				'name' => 'Ich werde teilnehmen',
				'click' => 'ajreq(\'ustatadd\',{id:'.(int)$event['id'].',s:1});return false;'
			);
			$menu[] = array(
				'name' => 'Ich werde vielleicht teilnehmen',
				'click' => 'ajreq(\'ustatadd\',{id:'.(int)$event['id'].',s:2});return false;'
			);
		}
		
		return v_field($this->menu($menu),'<i class="fa fa-gear"></i> '.s('event_options'));
	}
	
	public function eventTop($event)
	{
		$end = '';
	
		if(date('Y-m-d',$event['start_ts']) != date('Y-m-d',$event['end_ts']))
		{
			$end = ' bis '.niceDate($event['end_ts']);
		}
	
		$out = '
		<div class="event welcome ui-padding margin-bottom ui-corner-all">
			<div class="welcome_profile_image">
				<span class="calendar">
					<span class="month">'.s('month_'.(int)date('m',$event['start_ts'])).'</span>
					<span class="day">'.date('d',$event['start_ts']).'</span>
				</span>
				<div class="clear"></div>
			</div>
			<div class="welcome_profile_name">
				<div class="user_display_name">
					'.$event['name'].'
				</div>
				<div class="welcome_quick_link">
					<ul>
						<li>'.niceDate($event['start_ts']).$end.'</li>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>';
	
		return $out;
	}
	
	public function invites($invites)
	{
		$out = '';
		
		if(!empty($invites['accepted']))
		{
			$icons = $this->fsIcons($invites['accepted']);
			
			if(!isMob() && count($invites['accepted']) > 20)
			{
				$icons = v_scroller($icons,200);
			}			
			$out .= v_field($icons, ''.count($invites['accepted']).' sind dabei');
		}
		
		if(!empty($invites['maybe']))
		{
			$icons = $this->fsIcons($invites['maybe']);
				
			if(!isMob() && count($invites['maybe']) > 20)
			{
				$icons = v_scroller($icons,200);
			}
			$out .= v_field($icons, ''.count($invites['maybe']).' kommen vielleicht');
		}
		
		if(!empty($invites['invited']))
		{
			$icons = $this->fsIcons($invites['invited']);
			
			if(!isMob() && count($invites['invited']) > 20)
			{
				$icons = v_scroller($icons,200);
			}
			$out .= v_field($icons, ''.count($invites['invited']).' Einladungen');
		}
		
		return $out;
	}
	
	public function event($event)
	{
		return v_field('<p>'.nl2br(autolink($event['description'])).'</p>', 'Beschreibung',array('class'=>'ui-padding'));
	}
}
