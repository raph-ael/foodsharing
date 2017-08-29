<?php
addScript('/js/contextmenu/jquery.contextMenu.js');
addCss('/js/contextmenu/jquery.contextMenu.css');

if(S::may())
{
	$db =loadModel('content');
	$check = false;
	
	$is_bieb = S::may('bieb');
	$is_bot = S::may('bot');
	$is_fs = S::may('fs');
	
	if(isset($_SESSION['client']['betriebe']) && is_array($_SESSION['client']['betriebe']) && count($_SESSION['client']['betriebe']) > 0)
	{
		$is_fs = true;
	}
	
	if(isset($_SESSION['client']['verantwortlich']) && is_array($_SESSION['client']['verantwortlich']) && count($_SESSION['client']['verantwortlich']) > 0)
	{
		$is_bieb = true;
	}
	
	if(isset($_SESSION['client']['botschafter']) && is_array($_SESSION['client']['botschafter']) && count($_SESSION['client']['botschafter']) > 0)
	{
		$is_bieb = true;
	}
	
	if(
			(
					$is_fs
					&&
					(int)$db->qOne('SELECT COUNT(id) FROM fs_quiz_session WHERE quiz_id = 1 AND status = 1 AND foodsaver_id = '.(int)fsId()) == 0
			)
			||
			(
					$is_bieb
					&&
					(int)$db->qOne('SELECT COUNT(id) FROM fs_quiz_session WHERE quiz_id = 2 AND status = 1 AND foodsaver_id = '.(int)fsId()) == 0
			)
			||
			(
					$is_bot
					&&
					(int)$db->qOne('SELECT COUNT(id) FROM fs_quiz_session WHERE quiz_id = 3 AND status = 1 AND foodsaver_id = '.(int)fsId()) == 0
			)
	)
	{
		$check = true;
		
		if($is_bot)
		{
			addJs('ajreq("endpopup",{app:"quiz"});');
		}
		
	}
	
	if($check)
	{
		$cnt = $db->getContent(33);
			
		$cnt['body'] = str_replace(array(
				'{NAME}',
				'{ANREDE}'
		),array(
				S::user('name'),
				s('anrede_'.S::user('gender'))
		),$cnt['body']);
			
		if(S::option('quiz-infobox-seen'))
		{
			$cnt['body'] = '<div>' . substr(strip_tags($cnt['body']),0,120) . ' ...<a href="#" onclick="$(this).parent().hide().next().show();return false;">weiterlesen</a></div><div style="display:none;">'.$cnt['body'].'</div>';
		}
		else
		{
			$cnt['body'] = $cnt['body'].'<p><a href="#" onclick="ajreq(\'quizpopup\',{app:\'quiz\'});return false;">Weiter zum Quiz</a></p><p><a href="#"onclick="$(this).parent().parent().hide();ajax.req(\'quiz\',\'hideinfo\');return false;"><i class="fa fa-check-square-o"></i> Hinweis gelesen und nicht mehr anzeigen</a></p>';
		}
		addContent(v_info($cnt['body'],$cnt['title']));
	}
}

if(!may())
{
	getContent('login');
}
else if(S::may('fs'))
{
	addBread('Dashboard');
	addTitle('Dashboard');
	$bid = getBezirkId();

	$val = $db->getValues(array('photo_public','anschrift','plz','lat','lon','stadt'), 'foodsaver', fsId());

	if(empty($val['lat']) || empty($val['lon']) ||

	($val['lat']) == '50.05478727164819' && $val['lon'] == '10.3271484375')
	{
		fs_info('Bitte überprüfe Deine Adresse, die Koordinaten konnten nicht ermittelt werden.');
		go('/?page=settings&sub=general&');
	}

	global $g_data;
	$g_data = $val;
	$elements = array();

	if($val['photo_public'] == 0)
	{
		$g_data['photo_public'] = 1;
		$elements[] = v_form_radio('photo_public',array('desc'=>'Du solltest zumindest intern den Menschen in Deiner Umgebung ermöglichen, Dich zu kontaktieren. So kannst Du von anderen Foodsavern eingeladen werden, Lebensmittel zu retten und Ihr könnt Euch einander kennen lernen.','values' => array(
				array('name' => 'Ja, ich bin einverstanden, dass mein Name und mein Foto veröffentlicht werden.','id' => 1),
				array('name' => 'Bitte nur meinen Namen veröffentlichen.','id' => 2),
				array('name' => 'Meine Daten nur intern anzeigen.','id' => 3),
				array('name' => 'Meine Daten niemandem zeigen.','id' => 4)
		)));
	}

	if(empty($val['lat']) || empty($val['lon']))
	{
		addJs('
	$("#plz, #stadt, #anschrift, #hsnr").bind("blur",function(){
		if($("#plz").val() != "" && $("#stadt").val() != "" && $("#anschrift").val() != "")
		{
			u_loadCoords({
				plz: $("#plz").val(),
				stadt: $("#stadt").val(),
				anschrift: $("#anschrift").val(),
				complete: function()
				{
					hideLoader();
				}
			},function(lat,lon){
				$("#lat").val(lat);
				$("#lon").val(lon);
			});
		}
	});

	$("#lat-wrapper").hide();
	$("#lon-wrapper").hide();
');
		$elements[] = v_form_text('anschrift');
		$elements[] = v_form_text('plz');
		$elements[] = v_form_text('stadt');
		$elements[] = v_form_text('lat');
		$elements[] = v_form_text('lon');
	}

	if(!empty($elements))
	{

		$out = v_form('grabInfo', $elements,array('submit'=>'Speichern'));


		addJs('
	$("#grab-info-link").fancybox({
		closeClick:false,
		closeBtn:true,
	});
	$("#grab-info-link").trigger("click");
	
	$("#grabinfo-form").submit(function(e){
		e.preventDefault();
		check = true;

		if($("input[name=\'photo_public\']:checked").val()==4)
		{
			$("input[name=\'photo_public\']")[0].focus();
			check = false;
			if(confirm("Sicher das Du Deine Daten nicht anzeigen lassen möchstest? So kann Dich kein Foodsaver finden"))
			{
				check = true;
			}
		}
		if(check)
		{
			showLoader();
			$.ajax({
				url:"xhr/?f=grabInfo",
				data: $("#grabinfo-form").serialize(),
				dataType: "json",
				complete:function(){hideLoader();},
				success: function(){
					pulseInfo("Danke Dir!");
					$.fancybox.close();
				}
			});
		}
	});
	
	');

		addHidden('
		<div id="grab-info">
			<div class="popbox">
				<h3>Bitte noch ein paar Daten vervollständigen bzw. überprüfen!</h3>
				<p class="subtitle">Damit Dein Profil voll funktionsfähig ist, benötigen wir noch folgende Angaben von Dir. Herzlichen Dank!</p>
				'.$out.'
			</div>
		</div><a id="grab-info-link" href="#grab-info">&nbsp;</a>');
	}

	// quiz popup
	//addJs('ajreq("quizpopup",{app:"quiz",loader:false});');
	
	if(!getBezirkId())
	{
		addJs('becomeBezirk();');
	}
	/*
	 * check is there are Betrieb not ordered to an bezirk
	 */
	else if (isset($_SESSION['client']['verantwortlich']) && is_array($_SESSION['client']['verantwortlich']) )
	{
		$ids = array();
		foreach ($_SESSION['client']['verantwortlich'] as $b)
		{
			$ids[] = (int)$b['betrieb_id'];
		}
		if(!empty($ids))
		{
			if($bids = $db->q('SELECT id,name,bezirk_id,str,hsnr FROM fs_betrieb WHERE id IN('.implode(',',$ids).') AND ( bezirk_id = 0 OR bezirk_id IS NULL)'))
			{
				addJs('ajax.req("betrieb","setbezirkids");');
			}
		}
	}
	
	//print_r($_SESSION);
	
	/*
	addContent(v_field('<p>
		Hallo Ihr Lieben,<br />
		Wir sind letzte Nacht auf unseren Neuen Öko-Webhoster von Manitu umgezogen. Es kann im Laufe des Tages noch zu kleinen Fehlern auf der Seite kommen (z. B., dass keine Bilder zu sehen sind ;)<br />
		Bis heute Abend sollten sich solche Phänomene gelegt haben.<br><br>Alles Liebe, Euer Lebensmittelretten.de Team	</p>
	','Umzug auf neuen Server',array('class'=>'ui-padding')));
	*/
	
	/* Einladungen */
	if($invites = $db->getInvites())
	{
		addContent(u_invites($invites));
	}
	
	/* Events */
	if($events = $db->getNextEvents())
	{
		addContent(u_events($events));
	}
	
	/*UPDATES*/
	/*
	if($updates = $db->updates())
	{
		addContent(u_updates($updates));
	}
	*/
	addStyle('
		#activity ul.linklist li span.time{margin-left:58px;display:block;margin-top:10px;}

		#activity ul.linklist li span.qr
		{
			margin-left:58px;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			opacity:0.5;
		}
			
		#activity ul.linklist li span.qr:hover
		{
			opacity:1;
		}
		
		#activity ul.linklist li span.qr img
		{
			height:32px;
			width:32px;
			margin-right:-35px;
			border-right:1px solid #ffffff;
			-webkit-border-top-left-radius: 3px;
			-webkit-border-bottom-left-radius: 3px;
			-moz-border-radius-topleft: 3px;
			-moz-border-radius-bottomleft: 3px;
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}
		#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
		{
			border: 0 none;
		    height: 16px;
		    margin-left: 36px;
		    padding: 8px;
		    width: 78.6%;
			-webkit-border-top-right-radius: 3px;
			-webkit-border-bottom-right-radius: 3px;
			-moz-border-radius-topright: 3px;
			-moz-border-radius-bottomright: 3px;
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
			margin-right:-30px;
			background-color:#F9F9F9;
		}
			
		#activity ul.linklist li span.qr .loader
		{
			background-color: #ffffff;
		    position: relative;
		    text-align: left;
		    top: -10px;
		}

		#activity ul.linklist li span.t span.txt {
		    overflow: hidden;
		    text-overflow: unset;
    		white-space: normal;
			padding-left:10px;
			border-left:2px solid #4A3520;
			margin-bottom:10px;
			display:block;
		}
		#activity ul.linklist li span
		{
			color:#4A3520;
		}
		#activity ul.linklist li span a
		{
			color:#46891b !important;
		}
		#activity span.n i.fa	
		{
			display:inline-block;
			width:11px;
			text-align:center;
		}
		#activity span.n small
		{
			float:right;
			opacity:0.8;
			font-size:12px;
		}
		#activity ul.linklist li span a:hover
		{
			text-decoration:underline !important;
			color:#46891b !important;
		}
		
		#activity ul.linklist li
		{
			margin-bottom:10px;
			background-color:#ffffff;
			padding:10px;
			-webkit-border-radius: 6px;
			-moz-border-radius: 6px;
			border-radius: 6px;
		}

		ul.linklist li span.n
		{
			font-weight:normal;
			font-size:13px;	
			margin-bottom:10px;
			text-overflow: unset;
    		white-space: inherit;
		}
	
		@media (max-width: 900px) 
		{
			#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
			{
				width:74.6%;
			}
		}
		@media (max-width: 400px) 
		{
			ul.linklist li span.n
			{
				height:55px;
			}
			#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
			{
				width:82%;
			}
			#activity ul.linklist li span.time, #activity ul.linklist li span.qr
			{
				margin-left:0px;
			}
			#activity span.n small
			{
				float:none;
				display:block;
			}
		}
	');
	addScript('/js/jquery.tinysort.min.js');
	addScript('/js/activity.js');
	addJs('activity.init();');
	addContent('
	<div class="head ui-widget-header ui-corner-top">
		Updates-Übersicht<span class="option"><a id="activity-option" href="#activity-listings" class="fa fa-gear"></a></span>
	</div>
	<div id="activity">
		<div class="loader" style="padding:40px;background-image:url(/img/469.gif);background-repeat:no-repeat;background-position:center;"></div>
		<div style="display:none" id="activity-info">'.v_info('Es gibt gerade nichts Neues').'</div>
	</div>');
	
	/*
	 * Top
	*/
	$me = $db->getFoodsaverBasics(fsId());
	if($me['rolle'] < 0 || $me['rolle'] > 4)
	{
		$me['rolle'] = 0;
	}
	if($me['geschlecht'] != 1 && $me['geschlecht'] != 2)
	{
		$me['geschlecht'] = 0;
	}
	
	$gerettet = $me['stat_fetchweight'];
	
	if($gerettet > 0)
	{
		$gerettet = ', Du hast <strong>'.number_format($gerettet,2,",",".").'<span style="white-space:nowrap">&thinsp;</span>kg</strong> gerettet';
	}
	else
	{
		$gerettet='';
	}
	
	addContent(
	'
	<div class="top corner-all">
		<div class="img">'.avatar($me,50).'</div>
			<h3>Hallo '.$me['name'].'</h3>
			<p>'.s('rolle_'.$me['rolle'].'_'.$me['geschlecht']).' für '.$me['bezirk_name'].'</a>'.$gerettet.'</p>
		<div style="clear:both;"></div>		
	</div>'
		,CNT_TOP);
	
	/*
	 * Nächste Termine
	*/
	$profileModel = loadModel('profile');
	if($dates = $profileModel->getNextDates(fsId(),10))
	{
		addContent(u_nextDates($dates),CNT_RIGHT);
	}
	
	/*
	 * Deine Bezirke
	*/
	if(isset($_SESSION['client']['bezirke']))
	{
		$orga = '
	<ul class="linklist">';
		$out = '
	<ul class="linklist">';
		$orgacheck = false;
		foreach ($_SESSION['client']['bezirke'] as $b)
		{
			if($b['type'] != 7)
			{
				$out .= '
		<li><a class="ui-corner-all" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a></li>';
			}
			else
			{
				$orgacheck = true;
				$orga .= '
		<li><a class="ui-corner-all" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a></li>';
			}
		}
		$out .= '
	</ul>';
		$orga .= '
	</ul>';
	
		$out = v_field($out, 'Deine Bezirke',array('class'=>'ui-padding'));
	
		
		
		if($orgacheck)
		{
			$out .= v_field($orga, 'Deine Gruppen',array('class'=>'ui-padding'));
		}
		
		addContent($out,CNT_RIGHT);
	}
	
	/*
	 * Essenskörbe
	 */
	
	if($baskets = $db->closeBaskets())
	{
		$out = '
		<ul class="linklist">';
		foreach ($baskets as $b)
		{
			$img = 'img/basket.png';
			if(!empty($b['picture']))
			{
				$img = 'images/basket/thumb-'.$b['picture'];
			}
			
			$distance = round($b['distance'],1);
			
			if($distance == 1.0)
			{
				$distance = '1 km';
			}
			else if($distance < 1)
			{
				$distance = ($distance*1000).' m';
			}
			else
			{
				$distance = number_format($distance,1,',','.').' km';
			}
			
			$out .= '
				<li>
					<a class="ui-corner-all" onclick="ajreq(\'bubble\',{app:\'basket\',id:'.(int)$b['id'].',modal:1});return false;" href="#">
						<span style="float:left;margin-right:7px;"><img width="35px" alt="Maike" src="'.$img.'" class="ui-corner-all"></span>
						<span style="height:35px;overflow:hidden;font-size:11px;line-height:16px;"><strong style="float:right;margin:0 0 0 3px;">('.$distance.')</strong>'.tt($b['description'],50).'</span>
						
						<span style="clear:both;"></span>
					</a>
				</li>';
		}
		$out .= '
		</ul>
		<div style="text-align:center;">
			<a class="button" href="/essenskoerbe/find/">Alle Essenskörbe</a>
		</div>';
		
		addContent(v_field($out,'Essenskörbe in Deiner Nähe'),CNT_LEFT);
	}
	
	/*
	 * Deine Betriebe
	*/
	if($betriebe = $db->getMyBetriebe(array('sonstige'=>false)))
	{
		addContent(u_myBetriebe($betriebe),CNT_LEFT);
	
	}
	else
	{
		addContent(v_info('Du bist bis jetzt in keinem Filial-Team.'),CNT_LEFT);
	}
}
else
{
	loadApp('dashboard');
}


function u_nextDates($dates)
{
	$out ='
	<div class="ui-padding">
		<ul class="datelist linklist">';
	foreach ($dates as $d)
	{
		$out .= '
			<li>
				<a href="/?page=fsbetrieb&id='.$d['betrieb_id'].'" class="ui-corner-all">
					<span class="title">'.niceDate($d['date_ts']).'</span>
					<span>'.$d['betrieb_name'].'</span>
				</a>
			</li>';
	}
	$out .= '
		</ul>
	</div>';
	return v_field($out, s('next_dates'));
}

function u_myBetriebe($betriebe)
{
	$out = '';
	if(!empty($betriebe['verantwortlich']))
	{
		$list = '
		<ul class="linklist">';
		foreach ($betriebe['verantwortlich'] as $b)
		{
			$list .= '
			<li>
				<a class="ui-corner-all" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a>
			</li>';
		}
		$list .= '
		</ul>';
		$out = v_field($list, 'Du bist verantwortlich für',array('class'=>'ui-padding'));
	}

	if(!empty($betriebe['team']))
	{
		$list = '
		<ul class="linklist">';
		foreach ($betriebe['team'] as $b)
		{
			$list .= '
			<li>
				<a class="ui-corner-all" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a>
			</li>';
		}
		$list .= '
		</ul>';
		$out .= v_field($list, 'Du holst Lebensmittel ab bei',array('class'=>'ui-padding'));
	}

	if(!empty($betriebe['waitspringer']))
	{
		$list = '
		<ul class="linklist">';
		foreach ($betriebe['waitspringer'] as $b)
		{
			$list .= '
			<li>
				<a class="ui-corner-all" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a>
			</li>';
		}
		$list .= '
		</ul>';
		$out .= v_field($list, 'Du bist auf der Springer- / oder Warteliste bei',array('class'=>'ui-padding'));
	}

	if(!empty($betriebe['anfrage']))
	{
		addJsFunc('
			function u_anfrage_action(key,el)
			{
				val = $(el).children("input:first").val().split(":::");
				
				if(key == "deny")
				{
					u_sign_out(val[0],val[1],el);
				}
				else if(key == "map")
				{
					u_gotoMap(val[0],val[1],el);
				}
			}

			function u_sign_out(fsid,bid,el)
				{
					var item = $(el);
					showLoader();
					$.ajax({
						dataType:"json",
						data: "fsid="+fsid+"&bid="+bid,
						url:"xhr/?f=denyRequest",
						success : function(data){
							if(data.status == 1)
							{
								pulseSuccess(data.msg);
								window.setTimeout(function(){reload()},1500);
							}else{
								pulseError(data.msg);
								window.setTimeout(function(){reload()},1500);
							}
						},
						complete:function(){hideLoader();}
					});	
				}	

			function u_gotoMap(fsid,betriebid,el)
				{
					var item = $(el);
					showLoader();
					var baseUrl = "?page=map&bid=";
					window.location.href = baseUrl+betriebid;
					
				}	
		');
		addJs('
			function createSignoutMenu() {
		        return {
		            callback: function(key, options) {
		                u_anfrage_action(key,this);
		            },
		            items: {
		                "deny": {name: "Austragen",icon:"delete"},
						"map":{name: "Auf Karte anschauen",icon:"accept"}
		            }
		        };
		    }
		
			$("#store-request").on("click", function(e){
		        var $this = $(this);
		        $this.data("runCallbackThingie", createSignoutMenu);
		        var _offset = $this.offset(),
		            position = {
		                x: _offset.left - 30, 
		                y: _offset.top - 97
		            }
		        $this.contextMenu(position);
		    });

			$.contextMenu({
		        selector: "#store-request",
		        trigger: "none",
		        build: function($trigger, e) {
		            return $trigger.data("runCallbackThingie")();
		        }
		    });		
			
			
		');
		$list = '
		<ul class="linklist">';
		foreach ($betriebe['anfrage'] as $b)
		{
			//<a id="anfrage-betrieb" class="ui-corner-all" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a>
			$list .= '
			<li>
				<a id="store-request" class="ui-corner-all" href="#" onclick="return false;">'.$b['name'].'<input type="hidden" name="anfrage" value="'.fsId().':::'.$b['id'].'" /></a>
			</li>';
		}
		$list .= '
		</ul>';
		$out .= v_field($list, 'Anfragen gestellt bei',array('class'=>'ui-padding'));
	}

	if(empty($out))
	{
		$out = v_info('Du bist bis jetzt in keinem Filial-Team.');
	}

	if(S::may('bieb'))
	{
		$out .= '
			<div class="ui-widget ui-widget-content ui-corner-all margin-bottom ui-padding">
				<ul class="linklist">
					<li>
						<a href="/?page=betrieb&a=new" class="ui-corner-all">Neuen Betrieb eintragen</a>
					</li>
				</ul>
			</div>';
	}
	return $out;
}

function u_updates($updates)
{
	$out = '';
	$i=0;
	foreach ($updates as $u)
	{
		$fs = array(
			'id' => $u['foodsaver_id'],
			'name' => $u['foodsaver_name'],
			'photo' => $u['foodsaver_photo'],
			'sleep_status' => $u['sleep_status']
		);
		$out .= '
		<div class="updatepost">
				<a class="poster ui-corner-all" href="#" onclick="profile('.(int)$u['foodsaver_id'].');return false;">
					'.avatar($fs,50).'
				</a>
				<div class="post">
					'.u_update_type($u).'
				</div>
				<div style="clear:both;"></div>
		</div>';
	}

	return v_field($out, s('updates'),array('class'=>'ui-padding'));
}


function u_update_type($u)
{

	$out = '';
	if($u['type'] == 'forum')
	{
		$out = '
			<div class="activity_feed_content">
				<div class="activity_feed_content_text">
					<div class="activity_feed_content_info">
						<a href="#" onclick="profile('.(int)$u['foodsaver_id'].');return false;">'.$u['foodsaver_name'].'</a> hat etwas zum Thema "<a href="/?page=bezirk&bid='.$u['bezirk_id'].'&sub=forum&tid='.$u['id'].'&pid='.$u['last_post_id'].'#post'.$u['last_post_id'].'">'.$u['name'].'</a>" ins Forum geschrieben.
					</div>
				</div>

				<div class="activity_feed_content_link">
					'.$u['post_body'].'
				</div>

			</div>
			
			<div class="js_feed_comment_border">
				<div class="comment_mini_link_like">
					<div class="foot">
						<span class="time">'.niceDate($u['update_time_ts']).'</span>
					</div>
				</div>
				<div class="clear"></div>
			</div>';
	}
	else if($u['type'] == 'bforum')
	{
		$out = '
			<div class="activity_feed_content">
				<div class="activity_feed_content_text">
					<div class="activity_feed_content_info">
						<a href="#" onclick="profile('.(int)$u['foodsaver_id'].');">'.$u['foodsaver_name'].'</a> hat etwas zum Thema "<a href="/?page=bezirk&bid='.$u['bezirk_id'].'&sub=botforum&tid='.$u['id'].'&pid='.$u['last_post_id'].'#post'.$u['last_post_id'].'">'.$u['name'].'</a>" ins Botschafterforum geschrieben.
					</div>
				</div>

				<div class="activity_feed_content_link">
					'.$u['post_body'].'
				</div>

			</div>
		
			<div class="js_feed_comment_border">
				<div class="comment_mini_link_like">
					<div class="foot">
						<span class="time">'.niceDate($u['update_time_ts']).'</span>
					</div>
				</div>
				<div class="clear"></div>
			</div>';
	}
	else if($u['type'] == 'bpin')
	{
		$out = '
			<div class="activity_feed_content">
				<div class="activity_feed_content_text">
					<div class="activity_feed_content_info">
						<a href="#" onclick="profile('.(int)$u['foodsaver_id'].');">'.$u['foodsaver_name'].'</a> hat etwas auf die Pinnwand von <a href="/?page=fsbetrieb&id='.$u['betrieb_id'].'">'.$u['betrieb_name'].'</a> geschrieben.
					</div>
				</div>

				<div class="activity_feed_content_link">
					'.$u['text'].'
				</div>

			</div>
		
			<div class="js_feed_comment_border">
				<div class="comment_mini_link_like">
					<div class="foot">
						<span class="time">'.niceDate($u['update_time_ts']).'</span>
					</div>
				</div>
				<div class="clear"></div>
			</div>';
	}
	else
	{
		fs_debug($u);
	}

	return $out;
}

function u_invites($invites)
{
	$out = '';
	foreach ($invites as $i)
	{
		$out .= '
		<div class="post event" style="border-bottom:1px solid #E3DED3; padding-bottom:15px;">
			<a href="/?page=event&id='.(int)$i['id'].'" class="calendar">
				<span class="month">'.s('month_'.(int)date('m',$i['start_ts'])).'</span>
				<span class="day">'.date('d',$i['start_ts']).'</span>
			</a>
					
			
			<div class="activity_feed_content">
				<div class="activity_feed_content_text">
					<div class="activity_feed_content_info">
						<p><a href="/?page=event&id='.(int)$i['id'].'">'.$i['name'].'</a></p>
						<p>'.niceDate($i['start_ts']).'</p>
					</div>
				</div>

				<div>
					<a href="#" onclick="ajreq(\'accept\',{app:\'event\',id:\''.(int)$i['id'].'\'});return false;" class="button">Einladung annehmen</a> <a href="#" onclick="ajreq(\'maybe\',{app:\'event\',id:\''.(int)$i['id'].'\'});return false;" class="button">Vielleicht</a> <a href="#" onclick="ajreq(\'noaccept\',{app:\'event\',id:\''.(int)$i['id'].'\'});return false;" class="button">Nein</a>
				</div>
			</div>
			
			<div class="clear"></div>
		</div>
		';
	}
	
	return v_field($out,'Du wurdest eingeladen',array('class' => 'ui-padding'));
}

function u_events($events)
{
	$out = '';
	foreach ($events as $i)
	{
		$out .= '
		<div class="post event" style="border-bottom:1px solid #E3DED3; padding-bottom:15px;padding-top:15px;">
			<a href="/?page=event&id='.(int)$i['id'].'" class="calendar">
				<span class="month">'.s('month_'.(int)date('m',$i['start_ts'])).'</span>
				<span class="day">'.date('d',$i['start_ts']).'</span>
			</a>
		
			<div class="activity_feed_content">
				<div class="activity_feed_content_text">
					<div class="activity_feed_content_info">
						<p><a href="/?page=event&id='.(int)$i['id'].'">'.$i['name'].'</a></p>
						<p>'.niceDate($i['start_ts']).'</p>
					</div>
				</div>

				<div>
					<a href="/?page=event&id='.(int)$i['id'].'" class="button">Zum Event</a> 
				</div>
			</div>
		
			<div class="clear"></div>
		</div>
		';
	}

	return v_field($out,'Nächste Events',array('class' => 'ui-padding moreswap'));
}
