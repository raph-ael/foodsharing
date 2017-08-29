<?php
addScript('/js/contextmenu/jquery.contextMenu.js');
addCss('/js/contextmenu/jquery.contextMenu.css');

if(!S::may())
{
	goLogin();
}

if(getAction('new') && ( S::may('orga') || isBotFor($g_data['bezirk_id'])))
{
	handle_add();
	
	addBread(s('bread_betrieb'),'/?page=fsbetrieb');
	addBread(s('bread_new_betrieb'));
			
	addBetrieb(betrieb_form());

	addContent(v_field(v_menu(array(
		pageLink('betrieb','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
elseif($id = getActionId('delete') && ( S::may('orga') || isBotFor($g_data['bezirk_id'])))
{
	if($db->del_betrieb($id))
	{
		fs_info(s('betrieb_deleted'));
		goPage();
	}
}
elseif($id = getActionId('edit'))
{
	if($db->isVerantwortlich($_GET['id']) || isOrgaTeam()){
		go('/?page=betrieb&a=edit&id='.(int)$_GET['id']);
	}
	else{
		goPage();
	}
}
else if(isset($_GET['id']))
{
	
	addBread(s('betrieb_bread'),'/?page=fsbetrieb');
	addTitle(s('betrieb_bread'));
	addStyle('.button{margin-right:8px;}#right .tagedit-list{width:256px;}#foodsaver-wrapper{padding-top:0px;}');
	global $g_data;

	$betrieb = $db->getMyBetrieb($_GET['id']);
	
	if(!$betrieb)
	{
		goLogin();
	}
	
	if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'team' && ($db->isVerantwortlich($_GET['id']) || isOrgaTeam() || isBotFor($betrieb['bezirk_id'])))
	{
		if($_POST['form_submit'] == 'zeiten')
		{
			$range = range(0,6);
			global $g_data;
			$db->clearAbholer($_GET['id']);
			foreach ($range as $r)
			{
				if(isset($_POST['dow'.$r]))
				{
					handleTagselect('dow'.$r);
					foreach ($g_data['dow'.$r] as $fs_id)
					{
						$db->addAbholer($_GET['id'],$fs_id,$r);
					}
						
				}
			}
		}
		else
		{
			handleTagselect('foodsaver');
				
			if(!empty($g_data['foodsaver']))
			{
				$db->addBetriebTeam($_GET['id'],$g_data['foodsaver'],$g_data['verantwortlicher']);
			}
			else
			{
				fs_info(s('team_not_empty'));
			}
		}
		fs_info(s('changes_saved'));
		clearPost();
	}
	else if(isset($_POST['form_submit']) && $_POST['form_submit'] == 'changestatusform' && ($db->isVerantwortlich($_GET['id']) || isOrgaTeam() || isBotFor($betrieb['bezirk_id'])))
	{
		$db->changeBetriebStatus($_GET['id'],$_POST['betrieb_status_id']);
		go(getSelf());
	}
	
	addTitle($betrieb['name']);
	
	if($db->isInTeam($_GET['id']) || S::may('orga') || isBotFor($betrieb['bezirk_id']))
	{
		if((!$betrieb['verantwortlich'] && isBotFor($betrieb['bezirk_id'])))
		{
			$betrieb['verantwortlich'] = true;
			fs_info('<strong>'.s('reference').':</strong> '.s('not_responsible_but_bot'));
		}
		elseif(!$betrieb['verantwortlich'] && isOrgaTeam())
		{
			$betrieb['verantwortlich'] = true;
			fs_info('<strong>'.s('reference').':</strong> '.s('not_responsible_but_orga'));
		}
		if($betrieb['verantwortlich'])
		{
			if(!empty($betrieb['requests']))
			{
				handleRequests($betrieb);
			}
		}
		
		setEditData($betrieb);
		
		
		
		addBread($betrieb['name']);

		$edit_team = '';
		
		$verantwortlich_select = '';
		
		$bibsaver = array();
		foreach ($betrieb['foodsaver'] as $fs)
		{
			if($fs['rolle'] >= 2)
			{
				$bibsaver[] = $fs;
			}
		}
		
		if($betrieb['verantwortlich'])
		{
			$checked = array();
			foreach ($betrieb['foodsaver'] as $fs)
			{
				if($fs['verantwortlich'] == 1)
				{
					$checked[] = $fs['id'];
				}
			}
			$verantwortlich_select = v_form_checkbox('verantwortlicher',array('values'=>$bibsaver,'checked'=>$checked));
			
			$edit_team = v_form('team',array(
					v_form_tagselect('foodsaver',array('data'=>$db->xhrGetTagFsAll())),
					$verantwortlich_select),
					array('submit'=>s('save'))
			);
			
			addHidden('<div id="teamEditor">'.$edit_team.'</div>');
			
			
			addJs('
			
			$(".cb-verantwortlicher").click(function(){
				if($(".cb-verantwortlicher:checked").length >= 4)
				{
					pulseError(\''.jsSafe(s('max_3_leader')).'\');
					return false;
				}
				
			});		
			$("#team-form").submit(function(ev){
				if($(".cb-verantwortlicher:checked").length == 0)
				{
					pulseError(\''.jsSafe(s('verantwortlicher_must_be')).'\');
					ev.preventDefault();
					return false;
				}
			});	
			');
			
			addJsFunc('
				function u_fetchconfirm(fsid,date,el)
				{
					var item = $(el);
					showLoader();
					$.ajax({
						url:"xhr/?f=fetchConfirm",
						data: {
							fsid:parseInt(fsid),
							bid:'.(int)$betrieb['id'].',
							date: date
						},
						success: function(ret){
							if(ret == 1)
							{
								item.parent().removeClass("unconfirmed");
							}
						},
						complete: function(){
							hideLoader();
						}
					});		
				}	
				function u_fetchdeny(fsid,date,el)
				{
					var item = $(el);
					showLoader();	
					$.ajax({
						url:"xhr/?f=fetchDeny",
						data: {
							fsid:parseInt(fsid),
							bid:'.(int)$betrieb['id'].',
							date: date
						},
						success: function(ret){
							if(ret == 1)
							{
								item.parent().parent().append(\'<li class="filled empty timedialog-add-me"><a onclick="return false;" href="#"><img alt="nobody" src="img/nobody.gif"></a></li>\');
								item.parent().remove();
							}
						},
						complete: function(){
							hideLoader();
						}
					});			
				}
			');
		}
		
		/*pinnwand*/
		addJsFunc('
		function u_clearDialogs()
		{
			$(".datefetch").val("");		
			$(".shure_date").show();
			$(".shure_range_date").hide();
			$(".rangeFetch").hide();
			$("button").show();
			
		}
		function u_updatePosts(){
			$.ajax({
				dataType:"json",
				data: $("div#pinnwand form").serialize(),
				url:"xhr/?f=getPinPost",
				success : function(data){
					if(data.status == 1)
					{
						$("#pinnwand .posts").html(data.html);
					}
				}
			});
		}
		
		function u_undate(date,date_format)
		{
			$("#u_undate").dialog("option","title","'.s('del_date_for').' " + date_format);
				
			$("#team_msg-wrapper").hide();
			$("#have_backup").show();
			$("#msg_to_team").show();
			$("#send_msg_to_team").hide();
				
			$("#undate-date").val(date);
			$("#u_undate").dialog("open");
			msg = "'.jsSafe(str_replace(array('{BETRIEB}'), array($betrieb['name']), s('tpl_msg_to_team')),'"').'";
			msg = msg.replace("{DATE}",date_format);
			$("#team_msg").val(msg);
		}
		');
		addStyle('#team_msg{width:358px;}');
		addHidden('
			<div id="u_undate">
				'.v_info(s('shure_of_backup'), s('attention')).'
				<input type="hidden" name="undate-date" id="undate-date" value="" />
				
				'.v_form_textarea('team_msg').'
			</div>
		');
		
		addJs('
		$("#team_msg-wrapper").hide();
		$("#u_undate").dialog({
			autoOpen: false,
			modal: true,
			width:400,
			buttons: [
				{
					text:"'.s('have_backup').'",
					click:function(){
						showLoader();
						$.ajax({
							url:"xhr/?f=delDate",
							data:{"date":$("#undate-date").val(),"bid":'.(int)$betrieb['id'].'},
							dataType:"json",
							success: function(ret){
								if(ret.status == 1)
								{
									$(".fetch-" + $("#undate-date").val().replace(/[^0-9]/g,"") + "-'.fsId().'" ).hide();
								}
								else
								{
									hideLoader();	
								}
							},
							complete: function(){
								$("#u_undate").dialog("close");
								hideLoader();
							}
						});
					},
					id: "have_backup"
				},
				{
					text:"'.s('msg_to_team').'",
					click:function(){
						$("#team_msg-wrapper").show();
						//$("#u_undate").dialog("option","height",400);
						$("#have_backup").hide();
						$("#msg_to_team").hide();
						$("#send_msg_to_team").show();
					},
					id: "msg_to_team"
				},
				{
					text:"'.s('del_and_send').'",
					click:function(){
						showLoader();
						$.ajax({
							url:"xhr/?f=delDate",
							data:{"date":$("#undate-date").val(),"msg":$("#team_msg").val(),"bid":'.(int)$betrieb['id'].'},
							dataType:"json",
							success: function(ret){
								if(ret.status == 1)
								{
									$(".fetch-" + $("#undate-date").val().replace(/[^0-9]/g,"") + "-'.fsId().'" ).hide();
								}
								else
								{
									hideLoader();	
								}
							},
							complete: function(){
								$("#u_undate").dialog("close");
								hideLoader();
							}
						});
					},
					id: "send_msg_to_team",
					css:{"display":"none"}
				}
			]
		});
				
		$("#comment-post").hide();
		$("div#pinnwand form textarea").focus(function(){
			$("#comment-post").show();
		});
		$("div#pinnwand form textarea").blur(function(){
			//$("#comment-post").hide();
		});
				
		
		$("div#pinnwand form input.submit").button().bind("keydown", function(event) {
		      $("div#pinnwand form").submit();
	    });
		$("div#pinnwand form").submit(function(e){
			e.preventDefault();
			if($("div#pinnwand form textarea").val() != $("div#pinnwand form textarea").attr("title"))
			{
				$.ajax({
					dataType:"json",
					data: $("div#pinnwand form").serialize(),
					url:"xhr/?f=addPinPost&team='.$betrieb['team_js'].'",
					success : function(data){
						if(data.status == 1)
						{
							$("div#pinnwand form textarea").val($("div#pinnwand form textarea").attr("title"));
							$("#pinnwand .posts").html(data.html);
						}
					}
				});
			}
		});
	');

		/*Infos*/
		$betrieb['menge'] = '';
		if($menge = abhm($betrieb['abholmenge']))
		{
			$betrieb['menge'] = $menge;
		}
		
		$info = '';
		if(!empty($betrieb['besonderheiten']))
		{
			$info .= v_input_wrapper(s('besonderheiten'), nl2br($betrieb['besonderheiten']));
		}
		if($betrieb['menge'] > 0)
		{
			$info .= v_input_wrapper(s('menge'), $betrieb['menge']);
		}
		if($betrieb['presse'] == 1)
		{
			$info .= v_input_wrapper('Namensnennung', 'Dieser Betrieb darf &ouml;ffentlich genannt werden.');
		}elseif($betrieb['presse'] == 0)
		{
			$info .= v_input_wrapper('Namensnennung', 'Bitte diesen Betrieb niemals &ouml;ffentlich (z.<span style="white-space:nowrap">&thinsp;</span>B. bei Essensk&ouml;rben, Facebook oder Presseanfragen) nennen!');
		}
		
		addContent(v_field(
			v_input_wrapper(s('address'), $betrieb['str'].' '.$betrieb['hsnr'].'<br />'.$betrieb['plz'].' '.$betrieb['stadt']).
			$info, 
			
			$betrieb['name'],array('class'=>'ui-padding')),CNT_RIGHT);
		
		/*Optionsn*/
		
		$menu = array();
		
		
		if(!$betrieb['jumper'] || S::may('orga'))
		{
      if(!is_null($betrieb['team_conversation_id'])) {
			  $menu[] = array('name'=>'Nachricht ans Team','click' => "conv.chat(".$betrieb['team_conversation_id'].");");
      }
      if($betrieb['verantwortlich'] && !is_null($betrieb['springer_conversation_id'])) {
			  $menu[] = array('name'=>'Nachricht an Springer','click' => "conv.chat(".$betrieb['springer_conversation_id'].");");
      }
		}
		if($betrieb['verantwortlich'] || S::may('orga'))
		{
			$menu[] = array('name'=>s('fetch_history'),'click' => "ajreq('fetchhistory',{app:'betrieb',bid:".(int)$betrieb['id']."});");
			$menu[] = array('name'=>s('edit_betrieb'),'href'=>'/?page=betrieb&a=edit&id='.$betrieb['id']);
			$menu[] = array('name'=>s('edit_team'),'click'=>'$(\'#teamEditor\').dialog({modal:true,width:425,title:\''.s('edit_team').'\'});');
			$menu[] = array('name'=>s('edit_fetchtime'),'click'=>'$(\'#bid\').val('.(int)$betrieb['id'].');$(\'#dialog_abholen\').dialog(\'open\');return false;');
		}
		if(!$betrieb['verantwortlich'] || isOrgaTeam() || isBotschafter())
		{
			$menu[] = array('name'=>s('betrieb_sign_out'),'click'=>'u_betrieb_sign_out('.(int)$betrieb['id'].');return false;');
		}
		
		if(!empty($menu))
		{
			addContent(v_menu($menu,s('options')),CNT_LEFT);
		}
		
		addContent(v_field(
			u_team($betrieb).'', $betrieb['name'].'-Team'),
			CNT_LEFT
		);
		
		if(!$betrieb['jumper'] || S::may('orga'))
		{
			addJs('
				u_updatePosts();
				//setInterval(u_updatePosts,5000);		
			');
		
			$opt = array();
			if(isMob())
			{
				$opt = array('class'=> 'moreswap moreswap-height-200');
			}
			addContent(v_field('
				<div id="pinnwand">
					
					<div class="tools ui-padding">
						<form method="get" action="'.getSelf().'">
							<textarea class="comment textarea inlabel" title="Nachricht schreiben..." name="text"></textarea>
							<div align="right">
								<input id="comment-post" type="submit" class="submit" name="msg" value="'.s('send').'" />
							</div>
							<input type="hidden" name="bid" value="'.(int)$betrieb['id'].'" />
						</form>
					</div>
				
					<div class="posts"></div>
				</div>', 'Pinnwand',$opt));
			/*pinnwand ende*/
		}
		else 
		{
			addContent(v_info('Du bist momentan auf der Warteliste, sobald Hilfe benötigt wird wirst Du kontaktiert.'));
		}
		$zeit_cnt = '';
		if($betrieb['verantwortlich'])
		{
			$zeit_cnt .= '<p style="text-align:center;"><a class="button" href="#" onclick="ajreq(\'adddate\',{app:\'betrieb\',id:'.(int)$_GET['id'].'});return false;">einzelnen Termin eintragen</a></p>';
			//$zeit_cnt .= v_form_info(s('click_to_confirm'));
			
		}
		
		
		if($verantwortlicher = u_getVerantwortlicher($betrieb))
		{
			$cnt = '';
			
			foreach ($verantwortlicher as $v)
			{
				$tmp = u_innerRow('telefon',$v);
				$tmp .= u_innerRow('handy',$v);
				
				$cnt .= v_input_wrapper($v['name'],$tmp);
			}
			
			addContent(v_field($cnt , s('responsible_foodsaver'),array('class'=>'ui-padding')),CNT_LEFT);
			
		}
		
		/*
		 * Abholzeiten
		 */
		
		$click = '';
		$click = 'profile('.(int)fsId().');return false;';
		$confclass = 'unconfirmed';
		$pulseconf = 'pulseInfo("'.jsSafe(s('wait_for_confirm')).'");';
		if($betrieb['verantwortlich'])
		{
			//$click = 'u_fetchconfirm('.(int)fsId().',this);return false;';
			//$click = 'u_undate(\\\''.$date.'\\\',\\\''.format_db_date($date).'\\\');return false;';
			$confclass = 'confirmed';
			$pulseconf = '';
		}
		
		addHidden('
		<div id="timedialog">
			
			<input type="hidden" name="timedialog-id" id="timedialog-id" value="" />
			<input type="hidden" name="timedialog-date" id="timedialog-date" value="" />
				
			<span class="shure_date" id="shure_date">'.v_info(sv('shure_date',array('label'=>'<span id="date-label"></span>'))).'</span>
			<span class="shure_range_date" id="shure_range_date" style="display:none;">'.v_info(sv('shure_range_date',array('label' => '<span id="range-day-label"></span>'))).'</span>
			<div class="rangeFetch" id="rangeFetch" style="display:none;">
			
					'.v_input_wrapper(s('zeitraum'), '<input type="text" value="" id="timedialog-from" name="timedialog-from" class="datefetch input text value"> bis <input type="text" value="" id="timedialog-to" name="timedialog-to" class="datefetch input text value">').'
			
			</div>
		</div>
		<div id="delete_shure" title="'.s('delete_sure_title').'">
			'.v_info(s('delete_post_sure')).'
			<span class="sure" style="display:none">'.s('sure').'</span>
			<span class="abort" style="display:none">'.s('abort').'</span>
		</div>
		<div id="signout_shure" title="'.s('signout_sure_title').'">
			'.v_info(s('signout_sure')).'
			<span class="sure" style="display:none">'.s('sure').'</span>
			<span class="abort" style="display:none">'.s('abort').'</span>
		</div>');
		
		addJsFunc('
			var clicked_pid = null;
			function u_delPost(id)
			{
				clicked_pid = id;
				$("#delete_shure").dialog("open");
			}
			var signout_bid;
			function u_betrieb_sign_out(bid)
			{
				signout_bid = bid;	
				$("#signout_shure").dialog("open");
			}
		');
		
		$verified = 0;
		if(isVerified())
		{
			$verified = 1;
		}


		//Fix for Issue #171
		$seconds = $betrieb['prefetchtime'];
		if($seconds>=86400)
		{
			$days = $seconds/86400;
			
		} else
		{
			//If Bieb did not set the option "how many weeks in advance can a foodsaver apply" an alternative value
			$days = 7;
		}

		addJs('
		
		$("#signout_shure").dialog({
			autoOpen:false,
			modal:true,
			buttons :[
			    {
			    	text: $("#signout_shure .sure").text(),
			    	click:function(){
			    		showLoader();
						
						ajax.req("betrieb","signout",{
							data:{id:'.(int)$_GET['id'].'},
							success: function(){
								
							}
						});
			    	}
			    },
			    {
			    	text: $("#signout_shure .abort").text(),
			    	click: function(){
			    		$("#signout_shure").dialog("close");
			    	}
			    }
			]
		});
				
		$("#delete_shure").dialog({
			autoOpen:false,
			modal:true,
			buttons :[
			    {
			    	text: $("#delete_shure .sure").text(),
			    	click:function(){
			    		showLoader();
			    		$.ajax({
			    			url:"xhr/?f=delBPost",
			    			data:{"pid":clicked_pid},
			    			success:function(ret){
			    				if(ret == 1)
			    				{
			    					$(".bpost-" + clicked_pid).remove();
									$("#delete_shure").dialog("close");

			    				}
			    			},
			    			complete:function(){
			    				hideLoader();
			    			}
			    		});
			    	}
			    },
			    {
			    	text: $("#delete_shure .abort").text(),
			    	click: function(){
			    		$("#delete_shure").dialog("close");
			    	}
			    }
			]
		});
				
			$(".timedialog-add-me").click(function(){
				u_clearDialogs();
				
				if(1 == '.$verified.')
				{
					date = $(this).children("input")[0].value.split("::")[0];
					day = $(this).children("input")[0].value.split("::")[2];
					label = $(this).children("input")[0].value.split("::")[1];
					id = $(this).children("input")[1].value;
					
					$("#timedialog-date").val(date);
					$("#date-label").html(day + ", " + label);
					$("#range-day-label").html(day.toLowerCase());
					$("#timedialog-id").val(id);
					$("#timedialog").dialog("open");
				}
				else
				{
					pulseInfo(\''.jsSafe(s('not_verified')).'\');
				}
			});
			
			$("#timedialog").dialog({
					title:"Sicher?",
					resizable: false,
					modal: true,
					autoOpen:false,
					width:500,
					buttons: {
						"Eintragen": function() {
			
			
							$.ajax({
								url : "xhr/?f=addFetcher",
								data : {
									date:$("#timedialog-date").val(),
									bid:'.(int)$betrieb['id'].',
									from: $("#timedialog-from").val(),
									to: $("#timedialog-to").val()
								},
								success : function(ret){
									u_clearDialogs();
									$("#timedialog").dialog( "close" );
									if(ret == "2")
									{
										reload();
									}
									else if(ret != 0)
									{
						
										$("#"+ $("#timedialog-id").val() +"-button").last().remove();
						
										$("#"+ $("#timedialog-id").val() +"-imglist").prepend(\'<li class="'.$confclass.'"><a onclick="'.$click.'" href="#"><img src="\'+ret+\'" title="Du" /><span>&nbsp;</span></a></li>\');
										'.$pulseconf.'

										if($("#"+ $("#timedialog-id").val() +"-imglist li:last").hasClass("empty"))
										{
											$("#"+ $("#timedialog-id").val() +"-imglist li:last").remove();	
										}

										$("#"+ $("#timedialog-id").val() +"-imglist li.empty a").attr("title","");
										$("#"+ $("#timedialog-id").val() +"-imglist li.empty").unbind("click");
										$("#"+ $("#timedialog-id").val() +"-imglist li.empty").addClass("nohover");
										$("#"+ $("#timedialog-id").val() +"-imglist li.empty").removeClass("filled");
										$("#"+ $("#timedialog-id").val() +"-imglist li.empty a").tooltip("option", {disabled: true}).tooltip("close");
									}
			
								}
							});
							
			
						},
						"Regelmäßig abholen": function() {
							$("#shure_date").hide();
							$("#rangeFetch").show();
							$("#shure_range_date").show();
			
							 $( "#timedialog-from" ).datepicker({
								defaultDate: "+1w",
							 	minDate: "0",
							 	maxDate: "+'.(int)$days.'",
								numberOfMonths: 1,
								onClose: function( selectedDate ) {
									if(selectedDate!="")
									{
										$( "#timedialog-to" ).datepicker( "option", "minDate", selectedDate );
									}
									$( "#timedialog-to" ).datepicker( "option", "maxDate", "+'.(int)$days.'");
								}
							});

							$( "#timedialog-to" ).datepicker({
								defaultDate: "+1w",
								minDate: "+2",
								maxDate: "+'.(int)$days.'",
								numberOfMonths: 1,
								onClose: function( selectedDate ) {
									$( "#timedialog-from" ).datepicker( "option", "maxDate", selectedDate );
								}
							});
							$("#timedialog").next().children().children(":nth-child(2)").hide();
						},
						"Abbrechen": function() {
							u_clearDialogs();
							$( this ).dialog( "close" );
						}
					}
				});
		');
		
		if(is_array($betrieb['abholer']))
		{
			foreach ($betrieb['abholer'] as $dow => $a)
			{
				$g_data['dow'.$dow] = $a;
			}
		}
		$zeiten = false;
		$zeiten = $db->getAbholzeiten($betrieb['id']);
				
			$next_dates = u_getNextDates($zeiten,$betrieb);
			
			$abholer = $db->getAbholdates($betrieb['id'],$next_dates);
			
			$days = getDow();
			
			$scroller = '';
			
			foreach ($next_dates as $date => $time)
			{
				$part = explode(' ', $date);
				$date = $part[0];
				$scroller .= u_form_checkboxTagAlt(
					$date.' '.$time['time'],
					array(
						'data'=>$betrieb['team'],
						'url'=>'jsonTeam&bid='.(int)$betrieb['id'],
						'label'=> $days[date('w',strtotime($date))].' '.format_db_date($date).', '.format_time($time['time']),
						'betrieb_id' => $betrieb['id'],
						'verantwortlich' => $betrieb['verantwortlich'],
						'fetcher_count' => $time['fetcher'],
						'bezirk_id' => $betrieb['bezirk_id'],
						'field' => $time
					)
				);
				
			}
			
			$zeit_cnt .= v_scroller($scroller,200);
			
		if($betrieb['verantwortlich'] && empty($next_dates))
		{
		
			$zeit_cnt = v_info(sv('no_fetchtime',array('name' => $betrieb['name'])),s('attention').'!') . 
				'<p style="margin-top:10px;text-align:center;"><a class="button" href="#" onclick="ajreq(\'adddate\',{app:\'betrieb\',id:'.(int)$_GET['id'].'});return false;">einzelnen Termin eintragen</a></p>';
		}
		
		/*
		 * Abholzeiten ändern
		 */
		if($betrieb['verantwortlich'] || S::may('orga'))
		{
			hiddenDialog('abholen', array(u_form_abhol_table($zeiten),v_form_hidden('bid', 0),'<input type="hidden" name="team" value="'.$betrieb['team_js'].'" />'),s('add_fetchtime'),array('reload'=>true,'width'=>500));
		}

		if(!$betrieb['jumper'])
		{
			if(($betrieb['betrieb_status_id'] == 3 || $betrieb['betrieb_status_id'] == 5))
			{
				addContent(v_field($zeit_cnt, s('next_fetch_dates'),array('class'=>'ui-padding')),CNT_RIGHT);
			}
			else
			{
				$bt = '';
				$betriebsStatusName = '';
				$betriebStatusList = $db->q('SELECT id, name FROM fs_betrieb_status');
				foreach ($betriebStatusList as $betriebStatus) {
					if ($betriebStatus['id'] == $betrieb['betrieb_status_id']) {
						$betriebsStatusName = $betriebStatus['name'];
					}
				}
				if($betrieb['verantwortlich'])
				{
					addHidden('<div id="changeStatus-hidden">'.v_form('changeStatusForm', array(
					v_form_select('betrieb_status_id',array('value'=>$betrieb['betrieb_status_id'],'values'=>$betriebStatusList))
					)).'</div>');
				
				
				
					addJs('$("#changeStatus").button().click(function(){
					$("#changeStatus-hidden").dialog({
						title: "'.s('change_status').'",
						modal:true
					});
				});');
					$bt = '<p><span id="changeStatus">'.s('change_status').'</a></p>';
				}
				addContent(v_field('<p>'.v_getStatusAmpel($betrieb['betrieb_status_id']).$betriebsStatusName.'</p>'.$bt,s('status'),array('class'=>'ui-padding')),CNT_RIGHT);
			}
		}
	}
	else
	{
		if($betrieb = $db->getBetrieb($_GET['id']))
		{
			addBread($betrieb['name']);
			fs_info(s('not_in_team'));
			go('/?page=map&bid='.$_GET['id']);
		}
		else
		{
			go('/karte');
		}
	}
}
else
{
	addBread('Deine Betriebe');
	addContent(v_menu(array(
			array('href' => '/?page=betrieb&a=new','name' => s('add_new'))
	),'Aktionen'),CNT_RIGHT);
	
	$bezirk = getBezirk();
	$betriebe = $db->getMyBetriebe();
	addContent(u_betriebList($betriebe['verantwortlich'],s('you_responsible'),true));
	addContent(u_betriebList($betriebe['team'],s('you_fetcher'),false));
	addContent(u_betriebList($betriebe['sonstige'],sv('more_stores',array('name' => $bezirk['name'])),false));
}

function u_getVerantwortlicher($betrieb)
{
	$out = array();
	foreach ($betrieb['foodsaver'] as $fs)
	{
		if($fs['verantwortlich'] == 1)
		{
			$out[] = $fs;
		}
	}
	return $out;
}

function handleRequests($betrieb)
{
	$out = '<table class="pintable">';
	$odd = 'odd';
	addJs('$("table.pintable tr td ul li").tooltip();');
	
	addJsFunc('
	function acceptRequest(fsid,bid){
		showLoader();
		$.ajax({
			dataType:"json",
			data: "fsid="+fsid+"&bid="+bid,
			url:"xhr/?f=acceptRequest",
			success : function(data){
				if(data.status == 1)
				{
					reload();
					//$("tr.request-"+fsid).fadeOut();
				}
			},
			complete:function(){hideLoader();}
		});
	}
	function warteRequest(fsid,bid){
		showLoader();
		$.ajax({
			dataType:"json",
			data: "fsid="+fsid+"&bid="+bid,
			url:"xhr/?f=warteRequest",
			success : function(data){
				if(data.status == 1)
				{
					reload();
					//$("tr.request-"+fsid).fadeOut();
				}
			},
			complete:function(){hideLoader();}
		});
	}
	function denyRequest(fsid,bid){
		showLoader();
		$.ajax({
			dataType:"json",
			data: "fsid="+fsid+"&bid="+bid,
			url:"xhr/?f=denyRequest",
			success : function(data){
				if(data.status == 1)
				{
					reload();
				}
			},
			complete:function(){hideLoader();}
		});
	}');
	
	foreach ($betrieb['requests'] as $r)
	{
		if($odd == 'even')
		{
			$odd = 'odd';
		}
		else
		{
			$odd = 'even';
		}
		$out .= '
		<tr class="'.$odd.' request-'.$r['id'].'">
			<td class="img" width="35px"><a href="#" onclick="profile('.(int)$r['id'].');return false;"><img src="'.img($r['photo']).'" /></a></td>
			<td style="padding-top:17px;"><span class="msg"><a href="#" onclick="profile('.(int)$r['id'].');return false;">'.$r['name'].'</a></span></td>
			<td style="width:92px;padding-top:17px;"><span class="msg"><ul class="toolbar"><li class="ui-state-default ui-corner-left" title="Ablehnen" onclick="denyRequest('.(int)$r['id'].','.(int)$betrieb['id'].');"><span class="ui-icon ui-icon-closethick"></span></li><li class="ui-state-default" title="auf die Springer- / Warteliste setzen" onclick="warteRequest('.(int)$r['id'].','.(int)$betrieb['id'].');"><span class="ui-icon ui-icon-star"></span></li><li class="ui-state-default ui-corner-right" title="Akzeptieren" onclick="acceptRequest('.(int)$r['id'].','.(int)$betrieb['id'].');"><span class="ui-icon ui-icon-heart"></span></li></ul></span></td>
		</tr>';
	}
	
	$out .= '</table>';
	
	hiddenDialog('requests', array($out));
	addJs('$("#dialog_requests").dialog("option","title","Anfragen für '.jsonSafe($betrieb['name'],'"').'");');
	addJs('$("#dialog_requests").dialog("option","buttons",{});');
	addJs('$("#dialog_requests").dialog("open");');
}

function u_innerRow($id,$betrieb)
{
	$out = '';
	if($betrieb[$id] != '')
	{
		$betrieb[$id] = trim($betrieb[$id]);
		nl2br($betrieb[$id]);
		$out = '<div class="innerRow"><span class="label">'.s($id).'</span><span class="cnt">'.$betrieb[$id].'</span></div><div style="clear:both"></div>';
	}
	return $out;
}

function u_team($betrieb)
{
	$id = id('team');
	$out = '<ul id="'.$id.'" class="team">';
	$jssaver = array();
	$sleeper = '';
	
	foreach ($betrieb['foodsaver'] as $fs)
	{
		$jssaver[] = (int)$fs['id'];
		
		$class = '';
		$click = 'profile('.(int)$fs['id'].');';
		if($fs['verantwortlich'] == 1)
		{
			$class .= ' verantwortlich';
		}
		elseif ($betrieb['verantwortlich'] || isBotFor($betrieb['bezirk_id']) || isOrgaTeam())
		{
			$class .= ' context-team';
			$click = '';
		}

		if ($fs['verified']!=1)
		{
			$class .= ' notVerified';
		}

		$tel = '';
		$number = false;
		if(!empty($fs['handy']))
		{
			$number = $fs['handy'];
			$tel .= '<span class="item phone">'.((isMob()) ? '<a href="tel:'.$fs['handy'].'"><span>'.$fs['handy'].'</span></a>' : $fs['handy']).'</span>';
		}
		if(!empty($fs['telefon']))
		{
			$tel .= '<span class="item phone">'.((isMob()) ? '<a href="tel:'.$fs['telefon'].'"><span>'.$fs['telefon'].'</span></a>' : $fs['telefon']).'</span>';
		}
		
		if((int)$fs['last_fetch'] > 0)
		{
			$last = sv('stat_fetchcount', array(
				'date' =>  date('d.m.Y', $fs['last_fetch'])
			));
		} 
		else 
		{
			$last = sv('stat_fetchcount_none', array());
		}
		
		$onclick = ' onclick="'.$click.'return false;"';
		$href = '#';
		if($number !== false && isMob())
		{
			$onclick = '';
			$href = 'tel:'.preg_replace('/[^0-9\+]/','',$number);
		}
		
		$tmp = '
				<li class="team fs-'.$fs['id'].'">
					<a class="ui-corner-all'.$class.'" title="#tt-tt-'.$fs['id'].'" href="'.$href.'"'.$onclick.'>
						'.avatar($fs).'
						<span class="infos">
							<span class="item"><strong>'.$fs['name'].'</strong> <span style="float:right">('.$fs['stat_fetchcount'].')</span></span>
							'.$tel.'
						</span>
					</a>
					<span style="display:none" class="tt-'.$fs['id'].'">
						'.$last.'
					</span>
				</li>';
		
		if($fs['sleep_status'] == 0)
		{
			$out .= $tmp;
		}
		else
		{
			$sleeper .= $tmp;
		}
		
	}
	
	if($betrieb['springer'])
	{
		foreach ($betrieb['springer'] as $fs)
		{
			$jssaver[] = (int)$fs['id'];

			$class = '';
			$click = 'profile('.(int)$fs['id'].');';
			if ($betrieb['verantwortlich'] || isBotFor($betrieb['bezirk_id']) || isOrgaTeam())
			{
				$class .= ' context-jumper';
				$click = '';
			}
			
			$tel = '';
			$number = false;
			if(!empty($fs['handy']))
			{
				$tel .= '<span class="item phone"><span>'.$fs['handy'].'</span></span>';
			}
			if(!empty($fs['telefon']))
			{
				$tel .= '<span class="item phone"><span>'.$fs['telefon'].'</span></span>';
			}
			
			$onclick = ' onclick="'.$click.'return false;"';
			$href = '#';
			if(isMob() && $number !== false)
			{
				$onclick = '';
				$href = 'tel:'.preg_replace('/[^0-9\+]/','',$number);
			}
			
				$tmp = '
					<li class="jumper fs-'.$fs['id'].'">
						<a class="ui-corner-all'.$class.'" title="#tt-tt-'.$fs['id'].'" href="'.$href.'"'.$onclick.'>
							'.avatar($fs).'
							<span class="infos">
								<span class="item"><strong>'.$fs['name'].'</strong></span>
								'.$tel.'
							</span>
						</a>
						<span style="display:none" class="tt-'.$fs['id'].'">
							'.$fs['vorname'].' ist Springer seit '.date('m/y',$fs['add_date']).'
						</span>
					</li>';
				
				if($fs['sleep_status'] == 0)
				{
					$out .= $tmp;
				}
				else
				{
					$sleeper .= $tmp;
				}
		}
	}
	
	$out .= $sleeper . '</ul><div style="clear:both"></div>';
	
	addJsFunc('
		function u_contextAction(action,fsid)
		{
			if(action == "message")
			{
				chat(fsid);
			}
			else if(action == "report")
			{
				ajreq("reportDialog",{app:"report",fsid:fsid,bid:'.(int)$betrieb['id'].'});
			}
			else
			{
				showLoader();
				$.ajax({
					url: "xhr/?f=bcontext",
					data: {"action":action,"fsid":fsid,"bid":'.(int)$betrieb['id'].',"bzid":'.(int)$betrieb['bezirk_id'].'},
					dataType: "json",
					success: function(data){
						if(data.status == 1)
						{
							if(action == "toteam")
							{
								$(".fs-"+fsid).removeClass("jumper");
								$(".fs-"+fsid).addClass("team");
							}
							else if(action == "tojumper")
							{
								$(".fs-"+fsid).removeClass("team");
								$(".fs-"+fsid).addClass("jumper");
							}
							else if(action == "delete")
							{
								$(".fs-"+fsid).remove();
							}
						}
					},
					complete: function(){
						hideLoader();
					}
				});
			}
		}
	');
	
	addJs('
		function createJumperMenu() {
	        return {
	            callback: function(key, options) {
	                var m = "clicked: " + key;
					var li = $(this).parent();
				
					fsid = li.attr("class").split("fs-")[1];
				
	                u_contextAction(key,fsid);
	            },
	            items: {
					"report": {name: "Melden",icon:"report"},
	                "toteam": {name: "Ins Team aufnehmen",icon:"accept"},
	                "delete": {name: "Aus Team löschen",icon:"delete"},
					"message":{name: "Nachricht schreiben",icon:"message"}
	            }
	        };
	    }
				
		function createMenu() {
	        return {
	            callback: function(key, options) {
	                var m = "clicked: " + key;
					var li = $(this).parent();
				
					fsid = li.attr("class").split("fs-")[1];
				
	                u_contextAction(key,fsid);
	            },
	            items: {
					"report": {name: "Melden",icon:"report"},
	                "tojumper": {name: "Auf die Warteliste",icon:"wait"},
	                "delete": {name: "Aus Team löschen",icon:"delete"},
					"message":{name: "Nachricht schreiben",icon:"message"}
	            }
	        };
	    }
				
		$(".context-team").on("click", function(e){
	        var $this = $(this);
	        // store a callback on the trigger
	        $this.data("runCallbackThingie", createMenu);
	        var _offset = $this.offset(),
	            position = {
	                x: _offset.left - 42, 
	                y: _offset.top - 160
	            }
	        // open the contextMenu asynchronously
	        $this.contextMenu(position);
	    });
				
		$(".context-jumper").on("click", function(e){
	        var $this = $(this);
	        // store a callback on the trigger
	        $this.data("runCallbackThingie", createJumperMenu);
	        var _offset = $this.offset(),
	            position = {
	                x: _offset.left - 42, 
	                y: _offset.top - 95
	            }
	        // open the contextMenu asynchronously
	        $this.contextMenu(position);
	    });
			
				
		$.contextMenu({
	        selector: ".context-team, .context-jumper",
	        trigger: "none",
	        build: function($trigger, e) {
	            // pull a callback from the trigger
	            return $trigger.data("runCallbackThingie")();
	        }
	    });
	');

	if($betrieb['verantwortlich'])
	{
		addJs('
			$("#team_status").change(function(){
				var val = $(this).val();
				showLoader();
				$.ajax({
					url: "xhr/?f=bteamstatus&bid='.(int)$betrieb['id'].'&s=" + val,
					success: function(){
						hideLoader();
					}
				});
			});		
		');
		global $g_data;
		$g_data['team_status'] = $betrieb['team_status'];
		
		$out .= '
			<div class="ui-padding">'.
			v_form_select('team_status',array(
			'values' => array(
				array('id' => 0,'name' => 'Team ist voll'),
				array('id' => 1,'name' => 'HelferInnen gesucht'),
				array('id' => 2,'name' => 'Es werden dringend HelferInnen gesucht!')
			)
		)).'</div>';
	}
	return $out;
}

function u_betriebList($betriebe,$title,$verantwortlich)
{
	if(empty($betriebe))
	{
		return '';
	}
	else
	{
		$bezirk = false;
		$betriebrows = array();
		foreach ($betriebe as $i => $b)
		{
			$status = v_getStatusAmpel($b['betrieb_status_id']);
		
			$betriebrows[$i] = array(
					array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a>'),
					array('cnt' => $b['str'].' '.$b['hsnr']),
					array('cnt' => $b['plz']),
					array('cnt' => $status)
			);
			
			if(isset($b['bezirk_name']))
			{
				$betriebrows[$i][] = array('cnt'=>$b['bezirk_name']);
				$bezirk = true;
			}
			
			if($verantwortlich)
			{
				$betriebrows[$i][] = array('cnt' => v_toolbar(array('id'=>$b['id'],'types' => array('edit'),'confirmMsg'=>'Soll '.$b['name'].' wirklich unwideruflich gel&ouml;scht werden?')));
			}
		}
		
		$head = array(
				array('name' => 'Name','width'=>180),
				array('name' => 'Anschrift'),
				array('name' => 'Postleitzahl','width'=>90),
				array('name' => 'Status','width'=>50));
		if($bezirk)
		{
			$head[] = array('name'=>'Region');
		}
		if($verantwortlich)
		{
			$head[] = array('name' => 'Aktionen','sort' => false,'width' => 30);
		}
		
		$table = v_tablesorter($head,$betriebrows);
		
		return v_field($table,$title);
	}
}

function betrieb_form()
{
	global $db;
	
	$foodsaver_values = $db->getBasics_foodsaver();

	return v_quickform('betrieb',array(
			v_form_text('name'),
			v_form_text('plz'),
			v_form_text('str'),
			v_form_text('hsnr'),
			
			
			v_form_select('kette_id',array('add'=>true)),
			v_form_select('betrieb_kategorie_id',array('add'=>true)),
			
			v_form_select('betrieb_status_id'),
			
			v_form_text('ansprechpartner'),
			v_form_text('telefon'),
			v_form_text('fax'),
			v_form_text('email'),
			v_form_select('foodsaver',array('values' => $foodsaver_values))
	));
}

function u_getNextDates($fetch_dow,$betrieb)
{
	$out = array();
	
	if($fetch_dow)
	{
		$start_days = array();
		foreach ($fetch_dow as $dow => $fd)
		{
			$part = explode('-', $dow);
			$dow = (int)$part[0];
	
			if($dow == date('w'))
			{
				$start_days[] = array
				(
					// Zeige auch schon vergangene Termine an q'n'dirty
					'ts' => time(),
					'time' => $fd['time'],
					'fetcher' => $fd['fetcher'],
					'dow' => $dow
				);
			}
			else
			{
				$start_days[] = array
				(
					'ts' => strtotime('next '.u_day($dow)),
					'time' => $fd['time'],
					'fetcher' => $fd['fetcher'],
					'dow' => $dow
				);
			}
		}
		
		$month_change = 0;
		$y = 0;
		$cur_month = date('m',$start_days[0]['ts']);
		$i=0;
		
		while($i<=35)
		{
			foreach ($start_days as $sd)
			{
				$i++;
				$ts = $sd['ts']+($y*604800);	
				$date = new DateTime(date('Y-m-d',$sd['ts']).' '.$sd['time'], new DateTimeZone('Europe/Berlin'));
				//Ein Tag addieren
				if($y > 0)
				{
					$date->add(new DateInterval('P'.($y*7).'D'));
				}
				//DateTime Formatierte 2010-03-05 Ausgabe
				
				$out[$date->format('Y-m-d H-i')] = array(
					'time' => $date->format('H:i:s'),
					'fetcher' => $sd['fetcher']	
				);
			}
			if(date('m',$ts) != $cur_month)
			{
				$month_change++;
			}
			
			$y++;
		}
		
	
	}
	$db = loadModel('betrieb');
	if($adddates = $db->listUpcommingFetchDates($_GET['id']))
	{
		$out = array_merge($out,$adddates);
	}
	
	ksort($out);
	
	if(!empty($out))
	{
		$out2 = array();
		foreach ($out as $key => $o)
		{
			$k = explode(' ', $key);
			$k = explode('-', $k[0]);
			$time = mktime(0,0,0,$k[1],$k[2],$k[0]);
			$out2[$key] = $o;
			
			$max = 1209600;
			if((int)$betrieb['prefetchtime'] > 0)
			{
				$max = $betrieb['prefetchtime'];
			}
			
			if($time - time() >= $max)
			{
				return $out2;
			}
		}
	}
	
	return $out;
}

function u_day($dow)
{
	$days = array(
		0 => 'Sunday',
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday'
	);
	return $days[$dow];
}

function handle_edit()
{
	global $db;
	global $g_data;
	if(submitted())
	{
		$g_data['foodsaver'] = array($g_data['foodsaver']);
		if($db->update_betrieb($_GET['id'],$g_data))
		{
			fs_info(s('betrieb_edit_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}
function handle_add()
{
	global $db;
	global $g_data;
	if(submitted())
	{
		$g_data['foodsaver'] = array($g_data['foodsaver']);
		if($db->add_betrieb($g_data))
		{
			fs_info(s('betrieb_add_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}

function u_form_checkboxTagAlt($date,$option=array())
{
	
	$ago = false;
	if(strtotime($date) < time())
	{
		$ago = true;
	}
	
	if(!$ago && ($option['verantwortlich'] || S::may('orga') || isBotFor($option['bezirk_id'])))
	{
		addJsFunc('
			function u_timetableAction(key,el)
			{
				val = $(el).children("input:first").val().split(":::");
				
				if(key == "confirm")
				{
					u_fetchconfirm(val[0],val[1],el);
				}
				else if(key == "deny")
				{
					u_fetchdeny(val[0],val[1],el);
				}
				else if(key == "message")
				{
					chat(val[0]);
				}
			}
		');
		addJs('
			function createConfirmedMenu() {
		        return {
		            callback: function(key, options) {
		                u_timetableAction(key,this);
		            },
		            items: {
		                "deny": {name: "Austragen",icon:"delete"},
						"message":{name: "Nachricht schreiben",icon:"message"}
		            }
		        };
		    }
					
			function createUnconfirmedMenu() {
		        return {
		            callback: function(key, options) {				
		                u_timetableAction(key,this);
		            },
		            items: {
		                "confirm": {name: "Bestätigen",icon:"accept"},
		                "deny": {name: "Austragen",icon:"delete"},
						"message":{name: "Nachricht schreiben",icon:"message"}
		            }
		        };
		    }
					
			$(".context-confirmed").on("click", function(e){
		        var $this = $(this);
		        $this.data("runCallbackThingie", createConfirmedMenu);
		        var _offset = $this.offset(),
		            position = {
		                x: _offset.left - 42, 
		                y: _offset.top - 57
		            }
		        $this.contextMenu(position);
		    });
					
			$(".context-unconfirmed").on("click", function(e){
		        var $this = $(this);
		        $this.data("runCallbackThingie", createUnconfirmedMenu);
		        var _offset = $this.offset(),
		            position = {
		                x: _offset.left - 42, 
		                y: _offset.top - 95
		            }
		        $this.contextMenu(position);
		    });
				
					
			$.contextMenu({
		        selector: ".context-confirmed, .context-unconfirmed",
		        trigger: "none",
		        build: function($trigger, e) {
		            return $trigger.data("runCallbackThingie")();
		        }
		    });		
		');
	}
	$id = 'fetch-'.id($date);
	$out = '<input type="hidden" id="'.$id.'-date" name="'.$id.'-date" value="'.$date.'" />';

	$bindabei = false;

	$out .= '
		<ul class="imglist" id="'.$id.'-imglist">';
	
	$i = 0;
	
	if($values = getValue($id))
	{
		foreach ($values as $fs)
		{
			if($fs['id'] == fsId())
			{
				$bindabei = true;
			}
			
			$aclass = '';
			$class = $id.'-'.$fs['id'];
			$click = 'profile('.(int)$fs['id'].');';
			
			
			
			if(!$ago && $option['verantwortlich'] && $fs['confirmed'] == 0)
			{
				$aclass = 'context-unconfirmed';
				$click = '';
			}
			else if(!$ago && ($option['verantwortlich'] || isBotFor($option['bezirk_id']) || isOrgaTeam()))
			{
				$aclass .= 'context-confirmed';
				$click = '';
			}
			
			if($fs['id'] == fsid() && !$ago)
			{
				$click = 'u_undate(\''.$date.'\',\''.format_db_date($date).'\');return false;';
				$aclass = '';
			}
			
			if($fs['confirmed'] == 0)
			{
				$class .= ' unconfirmed';
				$fs['name'] = sv('not_confirmed',array('name' => $fs['name']));
			}
			$out .= '
			<li class="filled '.$class.'">
				<a class="'.$aclass.'" href="#" onclick="'.$click.'return false;" title="'.$fs['name'].'"><input type="hidden" name="date" value="'.$fs['id'].':::'.$date.'" /><img src="'.img($fs['photo']).'" alt="'.$fs['name'].'" /><span>&nbsp;</span></a>
			</li>';
			$i++;
		}
		
	}
	

	if(isset($option['fetcher_count']) && $i < $option['fetcher_count'])
	{
		for($y=0;$y<($option['fetcher_count']-$i);$y++)
		{
			if(!$bindabei)
			{
				$out .= '
				<li class="filled empty timedialog-add-me">
					<a href="#" onclick="return false;" title="'.s('add_me_here').'"><img src="img/nobody.gif" alt="nobody" /></a>
					<input type="hidden" name="'.$id.'-date" class="daydate" value="'.$date.'::'.format_db_date($date).'::'.s('dow'.date('w',strtotime($date))).'" />
					<input type="hidden" name="'.$id.'-dateid" class="dayid" value="'.$id.'" />
				</li>';
			}
			else
			{
				$out .= '
				<li class="empty nohover">
					<a href="#" onclick="return false;" title=""><img src="img/nobody.gif" alt="nobody" /></a>
				</li>';
			}
		}
	}
	
	$out .= '
		</ul><div style="clear:both;"></div>';

	$part = explode(' ', $date);

	if($part[0] == date('Y-m-d'))
	{
		$option['class'] = 'today';
	}
	
	$dellink = '';
	
	if(!$ago && isset($option['field']['additional']) && ($option['verantwortlich'] || isOrgaTeam() || isBotFor($option['bezirk_id'])))
	{
		$dellink = '<br /><a class="button" href="#" onclick="if(confirm(\'Termin wirklich löschen?\')){ajreq(\'deldate\',{app:\'betrieb\',id:\''.(int)$_GET['id'].'\',time:\''.$option['field']['datetime'].'\'});}return false;">Termin löschen</a>';
	}
	
	return v_input_wrapper(s($id),$out.$dellink ,$id, $option);

}
function u_form_abhol_table($zeiten = false,$option = array())
{
	addJs('
	$(".nft-remove").button({
		text: false,
		icons: {
		 	primary: "ui-icon-minus"
		 }
	}).click(function(){
		$this = $(this);
		$this.parent().parent().remove();
	});
			
	$(".timetable").on("keyup", ".fetchercount", function(){
		if(this.value != "")
		{
			val = parseInt("0"+this.value,10);
			if(val == 0 )
			{
				val = 1;
			}
			else if(val > 2)
			{
				pulseError("Du hast mehr als zwei Personen zum Abholen angegeben.<br />In der Regel sollten <strong>nicht mehr als zwei Leute</strong> zu einem Betrieb gehen. Zu viele Abholer führten schon oft zum Ende einer Kooperation. <br />Zur Not geht einer von Euch mit Auto oder Anhänger vor und Ihr trefft Euch außer Reichweite vom Betrieb.",{
					sticky:true
				});
			}
			this.value = val;
		}
	});
	$("#nft-add").button({
		text: false
	}).click(function(){
		$("table.timetable tbody").append($("table#nft-hidden-row tbody").html());
		clname = "odd";
		$("table.timetable tbody tr").each(function(){
			if(clname == "odd")
			{
				clname = "even";
			}
			else
			{
				clname = "odd";
			}
			
			$this = $(this);
			$this.removeClass("odd even");
			$this.addClass(clname);
			
		});
		$(".nft-remove").button({
			text: false,
			icons: {
				primary: "ui-icon-minus"
			}
		}).click(function(){
			$this = $(this);
			$this.parent().parent().remove();
		});
	});
	');
	$out = '
		<table class="timetable">
			
			<thead>
				<tr>
					<th class="ui-padding">'.s('day').'</th>
					<th class="ui-padding">'.s('time').'</th>
					<th class="ui-padding">'.s('fetcher_count').'</th>
				</tr>
			</thead>
			<tfoot>
			    <tr>
					<td colspan="3"><span id="nft-add">'.s('add').'</span></td>
				</tr>
			</tfoot>
			<tbody>';
	$dows = range(1,6);
	$dows[] = 0;
	$odd = 'even';
	if(is_array($zeiten))
	{
		foreach ($zeiten as $z)
		{
			if($odd == 'even')
			{
				$odd = 'odd';
			}
			else
			{
				$odd = 'even';
			}
			
			$day = '';
			foreach ($dows as $d)
			{
				$sel = '';
				if($d == $z['dow'])
				{
					$sel = ' selected="selected"';
				}
				$day .= '<option'.$sel.' value="'.$d.'">'.s('dow'.$d).'</option>';
			}
			
			$time = explode(':', $z['time']);
			
			$out .= '
			<tr class="'.$odd.'">
			    <td class="ui-padding">
					<select class="nft-row" style="width:100px;" name="newfetchtime[]" id="nft-dow">
						'.$day.'	
					</select>
				  </td>
			      <td class="ui-padding"><select class="nfttime-hour" name="nfttime[hour][]"><option selected="selected" value="'.(int)$time[0].'">'.$time[0].'</option><option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select><select class="nfttime-min" name="nfttime[min][]"><option selected="selected" value="'.(int)$time[1].'">'.$time[1].'</option><option value="0">00</option><option value="5">05</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option><option value="45">45</option><option value="50">50</option><option value="55">55</option></select> Uhr</td>
				  <td class="ui-padding"><input class="fetchercount" style="width:25px;" type="text" name="nft-count[]" value="'.$z['fetcher'].'"/><button style="float: right; height: 27px" class="nft-remove"></button></td>
			    </tr>';
		}
	}
	$out .= '</tbody></table>';
	
	$out .= '<table id="nft-hidden-row" style="display:none;">
			<tbody>
			<tr>
			    <td class="ui-padding">
					<select class="nft-row" style="width:100px;" name="newfetchtime[]" id="nft-dow">
						<option value="0">'.s('dow0').'</option>	
						<option value="1">'.s('dow1').'</option>	
						<option value="2">'.s('dow2').'</option>	
						<option value="3">'.s('dow3').'</option>	
						<option value="4">'.s('dow4').'</option>	
						<option value="5">'.s('dow5').'</option>	
						<option value="6">'.s('dow6').'</option>		
					</select>
				  </td>
			      <td class="ui-padding"><select class="nfttime-hour" name="nfttime[hour][]"><option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20" selected="selected">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select><select class="nfttime-min" name="nfttime[min][]"><option value="0" selected="selected">00</option><option value="5">05</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option><option value="45">45</option><option value="50">50</option><option value="55">55</option></select> Uhr</td>
				  <td class="ui-padding"><input class="fetchercount" type="text" name="nft-count[]" style="width:25px" value="2"/><button style="float: right; height: 27px"class="nft-remove"></button></td>
			    </tr>
				</tbody>
			</table>';
	return $out;
}
