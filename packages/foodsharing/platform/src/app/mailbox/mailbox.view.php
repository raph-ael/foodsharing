<?php
class MailboxView extends View
{
	public function folder($boxes)
	{
		
		$children = array();
		$lat_js = '';
		foreach ($boxes as $i => $b)
		{
			$expand = '';
			
			if($i == count($boxes)-1)
			{
				$expand = '"expand":true,';
				$lat_js = 'ajreq("loadmails",{mb:'.(int)$b['id'].',folder:"inbox",type:"'.$b['type'].'"});mb_setMailbox('.(int)$b['id'].');
						$("#mbh-folder").val("inbox");$("#mbh-mailbox").val('.(int)$b['id'].');$("#mbh-type").val("'.$b['type'].'");';
			}
			
			$children[] = '{title: "'.$b['name'].'@lebensmittelretten.de", isFolder: true, icon:"mailbox.png",'.$expand.'
                    children: [
                        {title: "'.s('inbox').'",ident:'.$b['id'].',folder:"inbox",icon:"inbox.png",type:"'.$b['type'].'"},
                        {title: "'.s('sent').'",ident:'.$b['id'].',folder:"sent",icon:"sent.png",type:"'.$b['type'].'"},
                        {title: "'.s('trash').'",ident:'.$b['id'].',folder:"trash",icon:"trash.png",type:"'.$b['type'].'"}
                    ]
                }';
		}
		
		addJs('
			$("#mailfolder").dynatree({
            onActivate: function(node) {
                
				if(node.data.ident != undefined)
				{
					ajreq("loadmails",{mb:node.data.ident,folder:node.data.folder,type:node.data.type});
					mb_setMailbox(node.data.ident);
					$("#mbh-mailbox").val(node.data.ident);
					$("#mbh-folder").val(node.data.folder);
					$("#mbh-type").val(node.data.type);
				}
				
                
            },
			imagePath: "/img/icon-mail/",
            persist: false,
            children: [ 
                '.implode(',', $children).'
            ]
        });	
         '.$lat_js.'	
		');
		
		return v_field('<div id="mailfolder"></div><input type="hidden" id="mbh-mailbox" value="" /><input type="hidden" id="mbh-folder" value="" /><input type="hidden" id="mbh-type" value="" />', 'Mailboxen');
	}
	
	public function manageMemberBox($box)
	{
		return v_quickform($box['name'].'@'.DEFAULT_HOST, array(
			v_form_tagselect('foodsaver_'.$box['id'],array('label'=>s('mailbox_member'),'xhr'=>'foodsaver')),
			v_input_wrapper(s('email_name'), '<input type="text" value="'.$box['email_name'].'" name="email_name" class="input text value">'),
			v_form_hidden('mbid', $box['id'])
		),array('submit'=>s('save')));
	}
	
	public function mailboxform()
	{
		return v_quickform(s('new_mailbox'), array(
			v_form_text('name',array('desc'=>s('mailbox_name_desc',['host' => DEFAULT_HOST])))
		),array('submit' => s('save')));
	}
	
	public function manageOpt()
	{
		return v_menu(array(
				array('name' => s('new_mailbox'),'href'=>'/?page=mailbox&a=newbox')
		),s('options'));
	}
	
	public function options()
	{
		return v_menu(array(
			array('name' => s('refresh'),'click'=>'mb_refresh();return false;'),
			array('name' => s('new_message'), 'click'=>'mb_new_message();return false;')
		),s('options'));
	}
	
	public function noMessage()
	{
		return '
			<tr class="message">
				<td colspan="4" align="center"><div class="ui-padding">'.v_info(s('no_message')).'</div></td>	
			</tr>		
		';
	}
	
	public function listMessages($messages)
	{
		$out = '';
		
		foreach($messages as $m)
		{
			/*
			 * (
			 		[mailbox_id] => 5
			 		[folder] => 1
			 		[sender] => {"personal":"Raphael Wintrich","mailbox":"raphi","host":"waldorfweb.net"}
			 		[to] => [{"mailbox":"r.wintrich","host":"lebensmittelretten.de"}]
			 		[subject] => Fwd: Newsletter ProVegan: Ausgabe 50/2013
			 		[time] => 2013-12-14 00:01:45
			 		[time_fs] => 1386975705
			 		[attach] =>
			 		[read] => 0
			 		[answer] => 0
			 )
			
			*/
			
			$von = json_decode($m['sender'],true);
			
			$von_str = $von['mailbox'];
			if(isset($von['host']))
			{
				$von_str = $von['mailbox'].'@'.$von['host'];
			}
			$to = json_decode($m['to']);
			
			if(isset($von['personal']))
			{
				$von_str = $von['personal'];
			}
			
			$attach_class = 'none';
			if(!empty($m['attach']))
			{
				$attach_class = 'check';
			}
			
			$status = 'read-0';
			if($m['answer'] == 1)
			{
				$status = 'answer-1';
			}
			elseif ($m['read'] == 1)
			{
				$status = 'read-1';
			}
			
			$out .= '
				<tr id="message-'.$m['id'].'" class="message '.$status.'">
					<td class="subject"><span class="status '.$status.'">&nbsp;</span> '.$m['subject'].'</td>
					<td class="from"><a href="#" onclick="return false;" title="'.$von_str.'">'.$von_str.'</a></td>
					
					<td class="date">'.niceDateShort($m['time_ts']).'</td>
					<td class="attachment"><span class="status a-'.$attach_class.'">&nbsp;</span></td>	
				</tr>		
			';
		}
		
		return $out;
	}
	
	public function message($mail)
	{
		$mail['body'] = trim($mail['body']);
		/*
		 * 		/*
		 * Array
		(
		    [id] => 1
		    [folder] => 1
		    [sender] => {"personal":"Raphael Wintrich","mailbox":"raphael","host":"waldorfweb.net"}
		    [to] => [{"mailbox":"r.wintrich","host":"lebensmittelretten.de"}]
		    [subject] => Test
		    [time] => 2013-12-13 23:42:20
		    [time_ts] => 1386974540
		    [attach] => 
		    [read] => 0
		    [answer] => 0
		    [body] => sldjkfhl ksdflkj sldfs df
		    [mailbox_id] => 5
		)
		 */
		
		$von = json_decode($mail['sender'],true);
			
		$von_str = $von['mailbox'].'@'.$von['host'];
		if(isset($von['personal']))
		{
			$von_str = $von['personal'];
		}
		
		$an = json_decode($mail['to'],true);
		$an_str = array();
		if(is_array($an))
		{
			foreach ($an as $a)
			{
				$an_str[] = $a['mailbox'].'@'.$a['host'];
			}
		}
		
		
		$attach = '';
		if(is_array($mail['attach']) && count($mail['attach']) > 0)
		{
			$attach = '
				<div id="mailattch">
					<ul class="attach">';
			foreach ($mail['attach'] as $i => $a)
			{
				$attach .= '<li><a class="ui-corner-all" href="/?page=mailbox&a=dlattach&mid='.(int)$mail['id'].'&i='.(int)$i.'">'.$a['origname'].'</a></li>';
			}
			$attach .= '</ul></div>';
		}
		
		if($mail['time_ts'] > 1391338283)
		{
			$body = '<iframe style="width:100%;height:100%;border:0;margin:0;padding:0;" frameborder="0" src="'.BASE_URL.'/xhrapp/?app=mailbox&m=fmail&id='.$mail['id'].'"></iframe>';
			
		}
		else
		{
			$body = nl2br($mail['body']);
		}
		
		return '
			<div class="popbox">
				<div class="message-top">
					<div class="buttonbar">
						<a href="#" onclick="mb_moveto(3);return false;" class="button">'.s('move_to_trash').'</a> <a href="#" onclick="mb_answer();return false;" class="button">'.s('answer').'</a><!-- <a href="#" class="button">'.s('forward').'</a>--> 
					</div>
					<table class="header">
						<tr>
							<td class="label">'.s('von').'</td>
							<td class="data"><a onclick="mb_mailto(\''.$von['mailbox'].'@'.$von['host'].'\');return false;" href="#" title="'.$von['mailbox'].'@'.$von['host'].'">'.$von_str.'</a></td>
						</tr>
						<tr>
							<td class="label">'.s('an').'</td>
							<td class="data">'.implode(', ', $an_str).'</td>
						</tr>
						<tr>
							<td class="label">'.s('date').'</td>
							<td class="data">'.niceDate($mail['time_ts']).'</td>
						</tr>
					</table>
				</div>
				<div class="mailbox-body">
					'.$body.'
					
				</div>
				<div class="mailbox-body-loader" style="display:none;"></div>
				'.$attach.'
				<input type="hidden" name="mb-hidden-id" id="mb-hidden-id" value="'.$mail['id'].'" />
				<input type="hidden" name="mb-hidden-subject" id="mb-hidden-subject" value="'.$mail['subject'].'" />
				<input type="hidden" name="mb-hidden-email" id="mb-hidden-email" value="'.$von['mailbox'].'@'.$von['host'].'" />
						
				<textarea id="mailbox-body-plain" style="display:none;">'.$this->mailAnswer($mail['body'],$mail['time_ts']).'</textarea>
			</div>';
	}	
	
	private function mailAnswer($plain,$ts,$sign = '')
	{
		return PHP_EOL.PHP_EOL.PHP_EOL.
				'-- '.
				PHP_EOL.
				'Foodsharing.de - verwenden statt verschwenden'.
				PHP_EOL.
				'www.lebensmittelretten.de - die Freiwilligen Plattform von foodsharing'.
				PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.
				'----------- '.sv('message_from',date('j.m.Y H:i',$ts)).' Uhr -----------'.
				PHP_EOL.PHP_EOL.
				PHP_EOL.'> '.str_replace(array("\r","\n"), array('',PHP_EOL.'> '), $plain);
	}
	
	public function folderlist($mailboxes,$mailadresses)
	{
		addJs('$("#message-body").dialog({
			autoOpen:false,
			width:980,
			modal:true,
			resizable:false,
			draggable:false,
			open: function (event, ui) {
		    	$("#message-body").css("overflow", "hidden"); //this line does the actual hiding
		  	}
		});');
		addHidden('
		<div id="message-body">
			
		</div>
		');
		
		/*
		 * [id] => 1
            [name] => deutschland
            [type] => bot
		 */
		if(count($mailboxes) == 1)
		{
			$von = $mailboxes[0]['email_name'].' ('.$mailboxes[0]['name'].'@'.DEFAULT_HOST.')<input type="hidden" id="h-edit-von" value="'.$mailboxes[0]['id'].'" />';
		}
		else 
		{
			$von = '
			<select class="von-select ui-corner-all" id="edit-von">';
			foreach ($mailboxes as $m)
			{
				$von .= '
				<option class="mb-'.$m['id'].'" value="'.$m['id'].'">'.$m['email_name'].' ('.$m['name'].'@'.DEFAULT_HOST.')</option>';
			}
			$von .= '
			</select>';
		}
		addJs('
		$("#message-editor").dialog({
			autoOpen:false,
			width:980,
			modal:true,
			resizable:false,
			draggable:false,
			open: function (event, ui) {
		    	$("#message-editor").css("overflow", "hidden");
				$("#message-editor").dialog("option",{
					height: ($( window ).height()-40)
				});
				var height = ($("#message-editor").height()-100);
				if(height > 50)
				{
					$(".edit-body").css({
							"height" : height+"px"
					});
				}
				u_addTypeHead();
				
		  	}
		});
		$("#etattach").change(function(){
			if(this.files[0].size < 1310720)
			{
				$("#etattach-button").button( "option", "disabled", true );
				setTimeout(function(){
					$("#et-file-list").append("<li>"+$("#etattach-info").text()+"</li>");
				},10);
				$(".et-filebox form").submit();
			}
			else
			{
				pulseError("'.s('file_to_big').'");
			}
		});
		');
		
		addJsFunc('
		
		var addresses = '.json_encode($mailadresses).';
			
		var substringMatcher = function (strs) {
     		return function findMatches(q, cb) {         
            // regex used to determine if a string contains the substring `q`
            var substringRegex = new RegExp(q, \'i\');

            // an array that will be populated with substring matches
            var matches = [];

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                if (substringRegex.test(str)) {
                    matches.push({value: str});
                }
            });

            cb(matches);
        };        
			};
					
		function u_addTypeHead()
        {
        	$(".edit-an").typeahead("destroy");
            $(".edit-an").typeahead({
				hint: true,
  				highlight: true,
  				minLength: 2
  				}, {
  				name: \'addresses\',
				source: substringMatcher(addresses),
				limit: 15
			});
                            
            $(".edit-an").on("typeahead:selected typeahead:autocompleted", function (e, datum) {
            	u_handleNewEmail(this.value, $(this));
            }).on("blur",function(){
            	$this = this;
                if($this.value != "" && !checkEmail($this.value))
                {
                	pulseError("Diese E-Mail-Adresse ist nicht korrekt");
                    $this.focus();  
                }
                else if($this.value != "")
                {
                	u_handleNewEmail($this.value, $($this));
                }
            });
        }

		var mailcheck = "";
		function u_handleNewEmail(email,el)
		{
			if(u_anHasChanged())
			{
				availmail = [];
				availmail_count = 0;
				$(".edit-an").each(function(){
					$this = $(this);
					if(!checkEmail($this.val()) || (availmail[$this.val()] != undefined))
					{
						//$this.parent().parent().parent().remove();
					}
					else
					{
						availmail[$this.val()] = true;
						availmail_count++;
					}
				});
							
				$("#mail-subject").before(\'<tr><td class="label">&nbsp;</td><td class="data"><input type="text" name="an[]" class="edit-an" value="" /></td></tr>\');	
					
				u_addTypeHead();
				var height = (bodytextheight-(availmail_count*28));
				if(height > 40)
				{
					$("#edit-body").css("height",(bodytextheight-(availmail_count*28))+"px");	
				}
				
				$(".edit-an:last").focus();			
			}		
		}
						
		function u_anHasChanged()
		{
			check = "";
			$(".edit-an").each(function(){
				check += this.value;
			});
			if(mailcheck == "")
			{
				mailcheck = check;
				return true;
			}
			else if(mailcheck != check)
			{
				mailcheck = check;
				return true;
			}
			else
			{
				return false;
			}
		}
		');
		
		addHidden('
		<div id="message-editor">
			<div class="popbox">
				<div class="message-top">
					<div class="buttonbar">
						<a href="#" onclick="mb_send_message();return false;" class="button">'.s('send').'</a> <a onclick="$(\'#message-editor\').dialog(\'close\');return false;" href="#" class="button">'.s('abort').'</a>
					</div>
					<table class="header">
						<tr>
							<td class="label">'.s('von').'</td>
							<td class="data">'.$von.'</td>
						</tr>
						<tr>
							<td class="label">'.s('an').'</td>
							<td class="data"><input type="text" name="an[]" class="edit-an" value="" /></td>
						</tr>
						<tr id="mail-subject">
							<td class="label">'.s('subject').'</td>
							<td class="data"><input class="data ui-corner-all" type="text" name="subject" id="edit-subject" value="" /></td>
						</tr>
					</table>
				</div>
				<table class="edit-table">
					<tr>
						<td class="et-left"><textarea class="edit-body" id="edit-body"></textarea></td>
						<td class="et-right">
								<div class="wrapper">
									<div class="et-filebox">
										<form method="post" target="et-upload" action="/xhrapp/?app=mailbox&m=attach" enctype="multipart/form-data">
											'.v_form_file('et-attach',array('btlabel'=>s('attach_file'))).'
										</form>
									</div>
	
									<iframe width="1" height="1" frameborder="0" name="et-upload" src="empty.html"></iframe>
									<ul id="et-file-list">
													
									</ul>
								</div>
						</td>
					</tr>
				</table>
				<input type="hidden" name="edit-reply" id="edit-reply" value="0" />
			</div>	
		</div>
		');
		
		return v_field('
			<table id="messagelist" class="records-table">
				<thead>
					<tr>
						<td class="subject"><a href="#">Betreff</a></td>
						<td class="from"><a href="#">Von</a></td>
						<td class="date"><a href="#">Datum</a></td>
						<td class="attachment"><span class="attachment">&nbsp;</span></td>
					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		', 'E-Mails');
	}
}
