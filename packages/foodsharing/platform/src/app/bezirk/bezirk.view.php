<?php
class BezirkView extends View
{
	public $bezirk_id;
	private $bezirk;
	private $mode;
	
	public function setMode($mode)
	{
		$this->mode = $mode;
	}
	
	public function top()
	{
		return '
		<div class="welcome ui-padding margin-bottom ui-corner-all">
			<div class="welcome_profile_name">
				<div class="user_display_name">
					'.$this->bezirk['name'].'
				</div>
				<div class="welcome_quick_link">
					<ul>
						<li>'.$this->bezirk['stat_fscount'].' Foodsaver, '.$this->bezirk['stat_botcount'].' Botschafter, '.$this->bezirk['stat_betriebcount'].' Betriebe, '.$this->bezirk['stat_korpcount'].' laufende Kooperationen</li>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
			<div class="welcome_profile_survived">
				<a href="#" onclick="u_toggleStat();return false;"><img height="50" width="50" class="image_online" alt="" src="img/gerettet_icon.png" /></a>
			</div>
			<div class="user_display_name" style="float:right;margin:5px 10px 0 0;">
				'.number_format($this->bezirk['stat_fetchweight'],2,",",".").'<span style="white-space:nowrap">&thinsp;</span>kg Lebensmittel gerettet<br />
				<span style="font-size:13px;line-height:25px;font-weight:normal;">Bei '.$this->bezirk['stat_fetchcount'].' Rettungs-Einsätzen</span>
			</div>
		
			<div class="clear"></div>
		</div>';
	}
	
	public function reports($reports)
	{
		
	}
	
	public function topOrga()
	{
		//return $this->topbar($this->bezirk['name'],$this->bezirk['stat_fscount'].' Mitglieder','/img/groups.png');

		return $this->topbar('Arbeitsgruppe - '.$this->bezirk['name'], $this->bezirk['stat_fscount'].' Mitglieder','<img src="/img/groups.png" class="image_online" height="50" width="50" />');
	}
	
	public function setBezirk($bezirk)
	{
		$this->bezirk = $bezirk;
		$this->bezirk_id = $bezirk['id'];
	}
	
	public function ftOptions($bezirk_id)
	{
		$items = array();
		if(isBotFor($bezirk_id) || isOrgaTeam())
		{
			$items[] = array('name' => 'Fair-Teiler eintragen','href' => '/?page=fairteiler&bid='.(int)$bezirk_id.'&sub=addFt');
		}
		else
		{
			$items[] = array('name' => 'Fair-Teiler vorschlagen','href' => '/?page=fairteiler&bid='.(int)$bezirk_id.'&sub=addFt');
		}
		return v_menu($items,'Optionen');
	}
	
	public function forum_top()
	{
		return '
		<div class="ui-widget ui-widget-content ui-corner-all margin-bottom ui-padding">
			<a class="button" href="'.getSelf().'/ntheme">'.s('new_theme').'</a>
		</div>';
	}
	
	public function forum_bottom($bot = 0)
	{
		addJs('
			var loadedPages = [];
			$(window).scroll(function () {
				if ($(window).scrollTop() < $(document).height() - $(window).height() - 10) {
					return;
				}

				var page = parseInt($("#morebutton").val()) || 1;
				for(i=0;i<loadedPages.length;i++)
				{
					if(loadedPages[i] == page)
					{
						return;
					}
				}
				loadedPages.push(page);
				ajax.req("bezirk", "morethemes", {
					data: {
						bid: '.(int)$this->bezirk_id.',
						bot: '.$bot.',
						page: page,
						last: $(".thread:last").attr("id").split("-")[1]
					},
					success: function(data){
						$("#morebutton").val(page+1);
						$(".forum_threads.linklist").append(data.html);
					}
				});
			});
		');
		return '
		<div class="ui-widget ui-widget-content ui-corner-all margin-bottom ui-padding">
			<a class="button" href="'.getSelf().'/ntheme">'.s('new_theme').'</a> <input type="hidden" id="morebutton" value="0" />
		</div>';
	}
	
	public function forum_empty()
	{
		return v_field(v_info(s('empty_forum')), 'Themen',array('class'=>'ui-padding'));
	}
	
	public function activateTheme($theme)
	{
		return v_field(
			v_info('Dieses Thema ist noch nicht aktiv. Hier hast Du die Möglichkeit das Thema zu akzeptieren und alle Foodsaver darüber zu informieren.').'
				<div class="ui-padding" style="text-align:center;">
					<a class="button" href="/?page=bezirk&bid='.$this->bezirk_id.'&sub=forum&tid='.$theme['id'].'&activate=1">Thema jetzt aktivieren</a>
					<a class="button" href="/?page=bezirk&bid='.$this->bezirk_id.'&sub=forum&tid='.$theme['id'].'&delete=1" onclick="if(!confirm(\'Thema wirklich löschen?\')){return false;}">Thema löschen</a>
				</div>',
				'Thema inaktiv!',
				array('class'=>'ui-padding')
			);
	}
	
	public function thread($thread,$posts,$followCounter,$bezirkType,$stickStatus)
	{
		addHidden('
			<div id="delete_shure" title="'.s('delete_sure_title').'">
				'.v_info(s('delete_sure')).'
				<span class="sure" style="display:none">'.s('sure').'</span>
				<span class="abort" style="display:none">'.s('abort').'</span>
			</div>
		');
		$out = '<div class="head ui-widget-header ui-corner-top">'.$thread['name'].'</div>';

		addJsFunc("
				function unfollowTheme(tid,bid,fsid){
					ajax.req('bezirk', 'unfollowTheme', {
						data: { tid: tid, bid: bid, fsid: fsid },
						success: reload
					});
				}
				function follow(tid,bid,fsid){
					ajax.req('bezirk', 'followTheme', {
						data: { tid: tid, bid: bid, fsid: fsid },
						success: reload
					});
				}
				function unstickTheme(tid,bid,fsid){
					ajax.req('bezirk', 'unstickTheme', {
						data: { tid: tid, bid: bid, fsid: fsid },
						success: reload
					});
				}
				function stickTheme(tid,bid,fsid){
					ajax.req('bezirk', 'stickTheme', {
						data: { tid: tid, bid: bid, fsid: fsid },
						success: reload
					});
				}");

		$follow = '';
		$sticky = '';
		if($followCounter == 1)
		{
			$follow = '<a class="button bt_unfollow" onclick="unfollowTheme('.$thread['id'].', '.$this->bezirk_id.', '.fsId().')" href="#">Thema entfolgen</a>';
		} else
		{
			$follow = '<a class="button bt_follow" onclick="follow('.$thread['id'].', '.$this->bezirk_id.', '.fsId().')" href="#">Thema folgen</a>';
		}
		if($stickStatus == 1 && (isOrgaTeam() || isBotFor($this->bezirk_id)))
		{
			$sticky = '<a class="button bt_unstick" onclick="unstickTheme('.$thread['id'].', '.$this->bezirk_id.', '.fsId().')" href="#">Fixierung aufheben </a>';
		} elseif($stickStatus == 0 && (isOrgaTeam() || isBotFor($this->bezirk_id)))
		{
			$sticky = '<a class="button bt_stick" onclick="stickTheme('.$thread['id'].', '.$this->bezirk_id.', '.fsId().')" href="#">Thema fixieren</a>';
		}

		if($posts)
		{
			
			foreach ($posts as $i => $p)
			{
				$class = 'ui-corner-all ';
				if($i == 0)
				{
					$class = 'ui-corner-bottom ';
				}
				
				$edit = '';
				$delete = '';

				if(isOrgaTeam()|| $p['fs_id'] == fsId() || ($this->mode == 'orgateam' || (isBotFor($this->bezirk_id) && $bezirkType == 7)))
				{
					$delete = '<a class="button bt_delete" href="#p'.$p['id'].'">'.s('delete_post').'</a>';
				}
				$time = niceDate($p['time_ts']);
				
				$foodsaver = array(
					'id' => $p['fs_id'],
					'sleep_status' => $p['fs_sleep_status'],
					'photo' => $p['fs_photo'],
					'name' => $p['fs_name']
				);
				
				$out .= '
				<div id="tpost-'.$p['id'].'" class="'.$class.'ui-widget ui-widget-content margin-bottom ui-padding">
					<div class="post">
						<div class="top_bar">
							<span class="time">'.$time.'</span><a name="post'.$p['id'].'" id="post'.$p['id'].'">'.$p['fs_name'].'</a>
						</div>
						<div class="forum_user_info_holder">
							<div class="xv_left">
								<a href="#" onclick="profile('.(int)$p['fs_id'].');return false;">
									'.avatar($foodsaver,130).'
								</a>
								<ul>
									<li><a href="#" onclick="chat('.$p['fs_id'].');return false;">Nachricht schreiben</a></li>
									
								</ul>
							</div>
						</div>
						<div class="post_body">
							'.$p['body'].'	
						</div>
						<div style="clear:both"></div>
						<div class="bottom_bar">
							<div class="normal normal'.$p['id'].'">
								<div class="float_left bottom_time">'.$time.'</div>
								<div class="float_right">
									'.$follow.'
									'.$delete.'
									'.$edit.'
									'.$sticky.'
									<a class="button bt_answer" href="#p'.$p['id'].'">Antworten</a>
								</div>
								<div style="clear:both;"></div>
							</div>
							<div class="answer answer'.$p['id'].'" style="display:none;">
								<form method="post">
									<input type="hidden" name="thread" value="'.$thread['id'].'" />
									<input type="hidden" name="post" value="'.$p['id'].'" />
									<textarea name="body" title="Antworten..." class="comment textarea inlabel"></textarea>
									<div>
										<p>
											<strong>Möchtest Du über dieses Thema auf dem Laufenden gehalten werden? </strong><br />
											<label class="item_is_active ui-corner-left"><input checked="checked" type="radio" name="follow" id="theme-follow" value="1" /> <span>Ja</span></label><label class="item_is_not_active ui-corner-right"><input type="radio" name="follow" id="theme-follow" value="0" /> <span>Nein</span></label><br />
										</p>
										<p>
											<input type="submit" class="button" name="submitted" value="'.s('send').'" />
										</p>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>';
			}
		}
		return $out;
	}
	
	public function forum_index($themes,$append = false,$sub = 'forum')
	{		
		$out = '';
		if(!$append)
		{
			$out = '
			<ul class="forum_threads linklist">';
		}
		if(is_array($themes) && !empty($themes))
		{
			foreach ($themes as $t)
			{
				$fs = array(
					'id' => $t['foodsaver_id'],
					'name' => $t['foodsaver_name'],
					'sleep_status' => $t['sleep_status'],
					'photo' => $t['foodsaver_photo']
				);
				$link = '/?page=bezirk&bid='.$this->bezirk_id.'&sub='.$sub.'&tid='.$t['id'].'&pid='.$t['last_post_id'].'#post'.$t['last_post_id'];
				if($t['sticky'] == 1)
				{
					$t['name'] = '<b>'.$t['name'].'</b>';
				}

				$out .= '
				<li class="thread" id="thread-'.$t['id'].'">
					<a class="ui-corner-all" href="'.$link.'">
						<span class="user_pic">
							'.avatar($fs).'	
						</span>
						<span class="thread_title">
							'.$t['name'].'
						</span>
						<span class="last_post ui-corner-all">
							<span class="time">'.niceDate($t['post_time_ts']).'</span>
							<span class="info">Von '.$t['foodsaver_name'].'</span>
						</span>
						<span style="clear:both;"></span>
					</a>
				</li>';	
			}
		}
		if(!$append)
		{
				$out .= '
			</ul>';
		}
		
		if(!$append)
		{
			return v_field($out, 'Themen',array('class'=>'ui-padding'));
		}
		else
		{
			return $out;
		}
	}
	
	public function listFairteiler($fairteiler)
	{
		$out = '
			<ul class="linklist fairteilerlist">';
		foreach ($fairteiler as $ft)
		{
			$image = '<span class="image noimage ui-corner-all" style="background-image:url(img/fairteiler_thumb.png);"></span>';
			if($ft['pic'])
			{
				$image = '<span class="image ui-corner-all" style="background-image:url('.$ft['pic']['thumb'].');"></span>';
			}
			$out .= '
				<li>
					<a href="/?page=fairteiler&bid='.$this->bezirk_id.'&sub=ft&id='.$ft['id'].'">
						'.$image.'
						<span class="name">'.$ft['name'].'</span>
						<span class="clear"></span>
					</a>
				</li>';
		}
		$out .= '
			</ul>';
	
		return v_field($out, sv('list_fairteiler',$this->bezirk['name']));
	}
	
	public function fairteilerForm($data = false)
	{
		$title = s('new_fairteiler');
	
		return v_field(v_form('fairteiler', array(
				v_form_text('name',array('required'=>true)),
				v_form_textarea('desc',array('required'=>true)),
				v_form_picture('picture',array('resize'=>array(250,528,60),'crop'=>array((250/135),(528/170),1))),
				$this->latLonPicker('latLng')
		)), $title,array('class'=>'ui-padding'));
	}
	
	public function newThemeForm()
	{
		return v_quickform(s('compose_new_theme'), array(
			v_form_text('title',array('required'=>true)),
			v_form_textarea('body',array('required'=>true))
		));
	}
	
	public function signout($bezirk)
	{
		addHidden('
			<div id="signout_shure" title="'.s('signout_sure_title').'">
				'.v_info(sv('signout_sure',$bezirk['name'])).'
				<span class="sure" style="display:none">'.s('sure').'</span>
				<span class="abort" style="display:none">'.s('abort').'</span>
				<input type="hidden" name="bid" class="bid" value="'.$bezirk['id'].'" />
			</div>
		');
		
		return v_menu(array(
			array('name'=>sv('bezirk_signout',$bezirk['name']),'href'=>'#signout')
		),s('signout'));
	}
	
	public function eventForm()
	{
		global $g_data;
		$g_data['online_type'] = 1;
		
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
		
		return v_field(v_form('eventsss', array(
				v_form_text('name',array('required'=>true)),
				v_form_date('date'),
				v_form_date('dateend'),
				v_input_wrapper('Uhrzeit Beginn', v_form_time('time_start',array('hour'=>15,'min'=>0))),
				v_input_wrapper('Uhrzeit Ende', v_form_time('time_end',array('hour'=>16,'min'=>0))),
				v_form_textarea('description',array('desc'=>s('desc_desc'),'required'=>true)),
				//v_form_picture('picture',array('resize'=>array(528,60),'crop'=>array((528/170),1))),
				v_form_select('online_type',array('values' => array(
						array('id'=>1,'name' => s('offline')),
						array('id'=>0,'name'=> s('online'))
				))),
				v_form_text('location_name',array('required'=>true)),
				$this->latLonPicker('latLng')
		),array('submit'=>s('save'))), $title, array('class'=>'ui-padding'));
	}
	
	public function listEvents($events)
	{
		$out = '<ul class="linklist">';
		
		foreach ($events as $event)
		{
			$end = '';
			
			if(date('Y-m-d',$event['start_ts']) != date('Y-m-d',$event['end_ts']))
			{
				$end = ' bis '.niceDate($event['end_ts']);
			}
			$out .= '
			<li>
				<a href="/?page=event&id='.$event['id'].'">
					<span class="calendar" style="margin-right:10px;">
						<span class="month">'.s('month_'.(int)date('m',$event['start_ts'])).'</span>
						<span class="day">'.date('d',$event['start_ts']).'</span>
					</span>
					<span class="title">'.$event['name'].'</span><br />
					'.niceDate($event['start_ts']).$end.'
				<span class="clear"></span>
				</a>
			</li>';
		}
		$out .= '</ul>';
		
		return v_field($out,'Termine');
	}
	
	public function event($event)
	{
		return v_field('<p>'.nl2br($event['description']).'</p>', 'Beschreibung',array('class' => 'ui-padding'));
	}
	
	public function eventTop($event)
	{
		/*
		Array
		(
		    [fs_id] => 56
		    [fs_name] => Raphael
		    [fs_photo] => 
		    [bezirk_id] => 12
		    [location_id] => 1
		    [name] => Testevent
		    [start] => 2014-04-18 08:00:00
		    [start_ts] => 1397800800
		    [end] => 2014-05-16 16:00:00
		    [end_ts] => 1400248800
		    [description] => Lorem ipsum
		    [bot] => 0
		    [online] => 1
		    [location] => Array
		        (
		            [id] => 1
		            [name] => Allerweltshaus
		            [lat] => 50.95021050
		            [lon] => 6.92368500
		            [zip] => 50823
		            [city] => Köln
		            [street] => Körnerstraße 77
		        )
		
		)
		 */
		
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
	
	public function addEvent()
	{
		return v_field('<p align="center"><a class="button" href="/?page=event&sub=add&bid='.(int)$this->bezirk_id.'">Jetzt neuen Termin eintragen</a></p>', 'Neues Event',array('class' => 'ui-padding'));
	}
	
	public function applications($requests)
	{
		foreach ($requests as $i => $r)
		{
			
		}
		//$cnt =  $this->fsAvatarList($requests);

		$out = '
		<div class="requests">';
		
		
		
		foreach ($requests as $r)
		{
			$url = '/?page=application&bid='.$this->bezirk_id.'&fid='.$r['id'];
			
			$rows[] = array(
				array('cnt' => '<span class="photo"><a href="'.$url.'"><img id="miniq-'.$r['id'].'" src="'.img($r['photo']).'" /></a></span>'),
				array('cnt' => '<a class="linkrow ui-corner-all" href="'.$url.'">'.$r['name'].'</a>'),
				array('cnt' => niceDate($r['time']))
			);
		}
		
		
		
		
		
		$out .= v_tablesorter(array(
				array('name' => s('picture'),'sort'=> false, 'width' => 45),
				array('name' => s('name')),
				array('name' => 'Anmeldedatum','width' => 180)
		),$rows,array('pager'=>true));
		
		
		$out .= '
		</div>';
		
		return v_field($out, 'Bewerbungen für '.$this->bezirk['name']);
	}
}
