<?php
function xv_page($content,$title,$subtitle = '')
{
	if(!empty($subtitle))
	{
		$subtitle = '<p class="subtitle">'.$subtitle.'</p>'; 
	}
	
	return '
	<div class="popbox">
		<h3>'.$title.'</h3>
		'.$subtitle.'
		<div class="cnt">
			'.$content.'
		</div>
	</div>';
}

function xv_msgList()
{
	$out = '
		<div id="scrollbar1">
		    <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
		    <div class="viewport">
	        	<div class="overview">
					<ul id="xv_message" class="msgbar-dropdown-menu">
						<li class="xhr-loader">&nbsp;</li>
					</ul>
		        </div>
		    </div>
		</div>
			';
		
	return $out;

}
/*
 * <p>'.$fs['anschrift'].'</p>
   <p>'.$fs['plz'].' '.$fs['stadt'].'</p>
 */
function xv_fsBubble($fs)
{
	return '<div style="height:80px;overflow:hidden;width:200px;">
				<div style="margin-right:10px;float:left;margin-bottom:33px">
					<a href="#" onclick="profile('.(int)$fs['id'].');return false;">
							<img src="'.img($fs['photo']).'">
					</a>
				</div>
				<h1 style="font-size:13px;font-weight:bold;margin-bottom:8px;"><a href="#" onclick="profile('.(int)$fs['id'].');return false;">'.$fs['name'].'</a></h1>
				<div style="clear:both;"></div>
			</div>';
}

function xv_bBubble($b)
{
	//print_r($b);
	global $db;
	
	$button = '';
	if(($b['inTeam']) || isOrgaTeam())
	{
		$button .= '<div class="buttonrow"><a class="lbutton" href="/?page=fsbetrieb&id='.(int)$b['id'].'">'.s('to_team_page').'</a></div>';
	}
	if($b['team_status'] != 0 && (!$b['inTeam'] && (!$b['pendingRequest'])))
	{
		$button .= '<div class="buttonrow"><a class="lbutton" href="#" onclick="betriebRequest('.(int)$b['id'].');return false;">'.s('want_to_fetch').'</a></div>';
	}elseif($b['team_status'] != 0 && (!$b['inTeam'] && ($b['pendingRequest'])))
	{
		$button .= '<div class="buttonrow"><a class="lbutton" href="#" onclick="rejectBetriebRequest('.(int)fsId().','.(int)$b['id'].');return false;">Anfrage zur&uuml;ckziehen </a></div>';
	}
	
	$verantwortlich = '<ul class="linklist">';
	foreach ($b['foodsaver'] as $fs)
	{
		if($fs['verantwortlich'] == 1)
		{
			$verantwortlich .= '
			<li><a style="background-color:transparent !important;" href="#" onclick="profile('.(int)$fs['id'].');return false;">'.avatar($fs,50).'</a></li>';
		}
	}
	$verantwortlich .= '
	</ul>';
	
	$besonderheiten = '';
	
	$count_info = '';
	if(is_array($b['foodsaver']))
	{
		$count = 0;
		foreach ($b['foodsaver'] as $fs)
		{
			$count += (int)$fs['stat_fetchcount'];
		}
		
		if($count > 0)
		{
			$fetch_times = (int)($count/count($b['foodsaver']));
			$fetch_weight = round(floatval(($fetch_times*$db->gerettet_wrapper($b['abholmenge']))),2);
			$count_info = '<div>Bei diesem Betrieb wurde <strong>'.$fetch_times.'x</strong> abgeholt</div>';
			
			// gerettet_wrapper
			$count_info .= '<div">Es wurden <strong>'.$fetch_weight.' Kg</strong> gerettet</div>';
		}
		
	}
	
	$time = strtotime($b['begin']);
	if($time > 0)
	{
		$count_info .= '<div>Kooperation seit '.s('month_'.(int)date('m',$time)).' '.date('Y',$time).'</div>';
	}
	
	if((int)$b['public_time'] != 0)
	{
		$b['public_info'] .= '<div>Es wird in etwa '.s('pubbtime_'.(int)$b['public_time']).' abgeholt</div><div class="ui-padding">'.v_info('Bitte niemals ohne Absprache zum Laden kommen!').'</div>';
	}
	
	if(!empty($b['public_info']))
	{
		$besonderheiten = v_input_wrapper(s('info'), $b['public_info'],'bcntspecial');
	}
	
	
	$status = v_getStatusAmpel($b['betrieb_status_id']);
	
	return '
			'.v_input_wrapper(s('status'), $status.'<span class="bstatus">'.s('betrieb_status_'.$b['betrieb_status_id']).'</span>'.$count_info).'
			'.v_input_wrapper('Verantwortliche Foodsaver', $verantwortlich,'bcntverantwortlich').'
			'.$besonderheiten.'
			<div class="ui-padding">
				'.v_info(''.s('team_status_'.$b['team_status']).'').'		
			</div>
			'.$button;
	
	/*
	$img = '';
	if($b['kette_id'] != 0)
	{
		if($img = $db->getVal('logo', 'kette', $b['kette_id']))
		{
			$img = '<a href="/?page=betrieb&id='.(int)$b['id'].'"><img style="float:right;margin-left:10px;" src="'.idimg($img,100).'" /></a>';
		}
	}
	$button = '';
	if($b['inTeam'])
	{
		$button = '<div style="text-align:center;padding:top:8px;"><span onclick="goTo(\'/?page=fsbetrieb&id='.(int)$b['id'].'\');" class="bigbutton cardbutton ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Zur Teamseite</span></span></div>';
	}
	else
	{
		$button = '<div style="text-align:center;padding:top:8px;"><span onclick="betriebRequest('.(int)$b['id'].');" class="bigbutton cardbutton ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><div style="text-align:center;padding:top:8px;"><span class="ui-button-text">Ich möchte hier Lebensmittel abholen</span></span></div>';
	}
		
	$verantwortlicher = '';
	if($v = $db->getTeamleader($b['id']))
	{
		$verantwortlicher = '<p><a href="#" onclick="profile('.(int)$v['id'].');return false;"><img src="'.img().'" /></a><a href="#" onclick="profile('.(int)$v['id'].');return false;">'.$v['name'].'</a> ist verantwortlich</p>';
	}
		
	return '<div style="height:130px;overflow:hidden;width:270px;"><div style="margin-right:5px;float:right;">'.$img.'</div><h1 style="font-size:13px;font-weight:bold;margin-bottom:8px;"><a onclick="betrieb('.(int)$b['id'].');return false;" href="#">'.jsSafe($b['name']).'</a></h1><p>'.jsSafe($b['str'].' '.$b['hsnr']).'</p><p>'.jsSafe($b['plz']).' '.jsSafe($b['stadt']).'</p>'.$button.'</div><div style="clear:both;"></div>';
	*/
}

function xv_childBezirke($childs,$parent_id)
{
	$out = '
	<select class="select childChanger" id="xv-childbezirk-'.(int)$parent_id.'" onchange="u_printChildBezirke(this);">
		<option value="-1:0" class="xv-childs-0">Bitte auswählen...</option>';
	foreach ($childs as $c)
	{
		$out .= '
		<option value="'.$c['id'].':'.(int)$c['type'].'" class="xv-childs-'.$c['id'].'">'.$c['name'].'</option>';
	}
	$out .= '
	</select>';
	return $out;
}

function xv_set($rows,$title = '')
{
	$out = '
	<div class="xv_set">
		<h3>'.$title.'</h3>';
	foreach ($rows as $r)
	{
		$out .= '
		<div class="xv_row">
			<span class="xv_label">'.$r['name'].'</span><span class="xv_val">'.$r['val'].'</span>
		</div>';
	}
	
	return $out.'
	</div>';
}

function xv_msgLi($messages)
{	
	$out = '';
	if(is_array($messages))
	{		
		$i=0;
		$count = count($messages);
		foreach ($messages as $m)
		{
			$i++;
			
			$class = '';
			if($count == $i)
			{
				$class = ' last';
			}
			$m['msg'] = autolink($m['msg']);
			$m['time'] = msgTime($m['time_ts']);
			$out .= '
					<li class="msg'.$class.'">
						<span class="msg">
							<span class="photo">
								<img alt="avatar" src="'.img($m['photo']).'">
							</span>
							<span class="subject">
								<a class="link from" onclick="profile('.(int)$m['sender_id'].');return false;" href="#">'.$m['name'].'</a>
								<span class="time">'.$m['time'].'</span>
							</span>
							<span class="message">'.nl2br($m['msg']).'</span>
							<span style="display:block;clear:both;"></span>
						</span>
					</li>';
		}
	}
	return $out;
}

function xv_hidden($id,$value)
{
	$id = id($id);
	
	return '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.$value.'" />';
}

function xv_submit($id,$click = false)
{
	$label = s($id);
	$id = id($id);
	$js = '$("#'.$id.'").button()';
	if($click !== false)
	{
		$js .= '.click(function(event){'.$click.'})';
	}

	$js .= ';';

	addXhJs($js);
	return '<input type="submit" id="'.$id.'" name="'.$id.'" value="'.$label.'" />';
}

function xv_msgAppend($msg,$name,$time,$img)
{
	return '<li class="msg"><span href="#57" class="msg"><span class="photo"><img src="'.$img.'" alt="avatar"></span><span class="subject"><span class="from">'.$name.'</span><span class="time">'.$time.'</span></span><span class="message">'.$msg.'</span><span style="display:block;clear:both;"></span></span></li>';
}

function xv_textarea($id)
{
	$id = id($id);
	
	$label = s($id).' ...';
	
	return '<textarea class="xv" onclick="if(this.value==\''.$label.'\'){this.value=\'\';}" onfocus="if(this.value==\''.$label.'\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\''.$label.'\'}" name="'.$id.'" id="'.$id.'">'.$label.'</textarea>';
}
