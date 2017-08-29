var conv = {
	
	initiated:false,
	
	chatboxes:null,
	
	/*
	 * here we want catch all the chat dom elements
	 */
	$chat:null,
	
	/*
	 * current count of active chat message
	 */
	chatCount:0,
		
	/*
	 * mark an active chatbox while writing
	 */
	activeBox:0,
	
	user2Conv:null,
	
	isBigPageMode:false,
	
	/*
	 * init function have to be called one time on domready
	 */
	init: function()
	{
		if(conv.initiated === false)
		{
			if(GET('page') == 'msg')
			{
				this.isBigPageMode = true;
			}
			this.initiated = true;
			this.chatboxes = new Array();
			this.$chat = new Array();
			this.user2Conv = new Array();
			
			console.log('openchats...');
			chats = storage.get('msg-chats');
			
			if(chats != undefined)
			{
				for(var i=0;i<chats.length;i++)
				{
					if(chats[i].id != undefined)
					{
						conv.appendChatbox(chats[i].id,chats[i].min);
					}
				}
			}
		}
	},
	userChat: function(fsid)
	{
		if(!this.initiated)
		{
			this.init();
		}
		ajax.req('msg','user2conv',{
			data:{fsid:fsid},
			success: function(ret)
			{
				conv.chat(ret.cid);
			}
		});
	},
	
	getConvByFs: function(fsid)
	{
		for(var i=0;i<conv.user2Conv.length;i++)
		{
			if(conv.user2Conv[i].fsid == fsid)
			{
				return conv.user2Conv[i].cid;
			}
		}
		return false;
	},
	
	chat: function(cid)
	{
		$('#convlist-4768').removeClass('unread-1').addClass('unread-0');
		if(isMob())
		{
			if(GET('page') == 'msg')
			{
				msg.loadConversation(cid);
			}
			else
			{
				goTo('/?page=msg&cid=' + cid);
			}
		}
		else
		{
			if(!this.initiated)
			{
				this.init();
			}
			
			this.appendChatbox(cid);
		}
	},
	
	/**
	 * method to send the right data to the polling service
	 * 
	 */
	registerPollingService: function()
	{
		var ids = conv.getCids();
		
		if(ids.length > 0)
		{
			var infos = conv.getChatInfos();	
			storage.set('msg-chats',infos);
			
			/*
			info.editService('msg','chat',{
				speed:'fast',
				premethod:'setSessionInfo',
				ids:ids,
				infos:infos
			});
			*/
			
		}
		else
		{
			storage.del('msg-chats');
			//info.removeService('msg-chats','chat')
		}
	},
	
	/**
	 * push retrieve function on recieved data by polling will execute this here 
	 */
	push: function(data)
	{
		key = conv.getKey(data.cid);
		if(key >= 0)
		{
			conv.maxbox(data.cid);
			conv.append(key,data);
			conv.scrollBottom(data.cid);
		}
		else
		{
			info.badgeInc('msg');
		}
		//alert(key);
		
		/*
		if(data.msg_chat.chats != undefined && data.msg_chat.chats.length > 0)
		{
			var chats = data.msg_chat.chats;
			var key = 0;
			
			for(var i=0;i<chats.length;i++)
			{
				key = conv.getKey(chats[i].cid);
				
				if(chats[i].msg != undefined && chats[i].msg.length > 0)
				{
					for(var x=0;x<chats[i].msg.length;x++)
					{
						conv.append(key,chats[i].msg[x]);
					}
					conv.maxbox(chats[i].cid);
					conv.scrollBottom(chats[i].cid);
				}
			}
		}
		*/
	},
	
	// minimize or maximize the chatbox
	togglebox: function(cid)
	{
		key = conv.getKey(cid);
		
		conv.chatboxes[key].el.children('.slimScrollDiv, .chatboxinput').toggle();
		//$('#chat-'+cid+' .slimScrollDiv, #chat-'+cid+' ').toggle();
		if($('#chat-'+cid+' .chatboxinput').is(':visible'))
		{
			conv.chatboxes[key].minimized = false;
		}
		else
		{
			conv.chatboxes[key].minimized = true;
		}
		
		conv.registerPollingService();
	},
	
	// maximoze mini box
	maxbox: function(cid)
	{
		key = conv.getKey(cid);
		conv.chatboxes[key].el.children('.slimScrollDiv, .chatboxinput').show();
		conv.chatboxes[key].minimized = false;
	},
	
	// minimize a box
	minbox: function(cid)
	{
		key = conv.getKey(cid);
		conv.chatboxes[key].el.children('.slimScrollDiv, .chatboxinput').hide();
		conv.chatboxes[key].minimized = true;
	},
	
	checkInputKey: function(event,chatboxtextarea,cid) 
	{
		var $ta = $(chatboxtextarea);
		var val = $ta.val().trim();
		var key = this.getKey(cid);
		
		
		
		if(event.keyCode == 13 && event.shiftKey == 0  && val != '')  
		{
			conv.showLoader(cid);
			
			setTimeout(function(){
				$ta.val('');
				$ta.css('height','40px');
				$ta[0].focus();
			},100);

			// replace to many line breaks
			val = val.replace(new RegExp('(\n){3,}', 'gim') , '\n\n');
			
			ajax.req('msg','sendmsg',{
				loader:false,
				method:'post',
				data:{
					c:cid,
					b:val	
				},
				success: function(data)
				{
					conv.append(key,data.msg);
					
					conv.scrollBottom(cid);	
				},
				complete: function(){
					conv.hideLoader(cid);
				}
			});
		}
	},
	
	/**
	 * scroll to bottom after appending messages
	 */
	scrollBottom: function(cid)
	{
		$('#chat-' + cid + ' .chatboxcontent').slimScroll({scrollTo : $('#chat-' + cid + ' .chatboxcontent').prop('scrollHeight') + 'px' });
		//var el = conv.chatboxes[conv.getKey(cid)].el.children('.chatboxcontent');
		//el.slimScroll({scrollTo : el.prop('scrollHeight') + 'px' });
	},
	
	img: function(photo,size)
	{
		if(size == undefined)
		{
			size = 'med';
		}
		if(photo.length > 3)
		{
			return '/images/'+size+'_q_'+photo;
		}
		else
		{
			return '/img/'+size+'_q_avatar.png';
		}
	},
	
	/**
	 * close the chatbox to thr given cid
	 */
	close: function(cid)
	{		
		var tmp = new Array();
		var x = 0;
		for(var i=0;i<conv.chatboxes.length;i++)
		{
			if(conv.chatboxes[i].id == cid)
			{
				conv.chatboxes[i].el.remove();
			}
			else
			{
				conv.chatboxes[i].el.css('right',(20 + (x * 285)) + 'px');
				tmp.push(conv.chatboxes[i]);
				x++;
			}
		}
		
		this.chatboxes = tmp;
		
		this.chatCount--;
		//this.rearrange();
		
		// re register polling service
		this.registerPollingService();
	},
	
	showLoader: function(cid)
	{
		key = this.getKey(cid);
		this.chatboxes[key].el.children('.chatboxhead').children('.chatboxtitle').children('i').removeClass('fa-comment fa-flip-horizontal').addClass('fa-spinner fa-spin');
	},
	
	hideLoader: function(cid)
	{
		key = this.getKey(cid);
		this.chatboxes[key].el.children('.chatboxhead').children('.chatboxtitle').children('i').removeClass('fa-spinner fa-spin').addClass('fa-comment fa-flip-horizontal');
	},
	
	/**
	 * get the array key for given conversation_id
	 */
	getKey: function(cid)
	{
		for(var i=0;i<conv.chatboxes.length;i++)
		{
			if(conv.chatboxes[i].id == cid)
			{
				return i;
			}
		}
		
		return -1;
	},
	
	/**
	 * get actic chatbox infos
	 */
	getChatInfos: function()
	{
		var tmp = new Array();
		
		for(var i=0;i<conv.chatboxes.length;i++)
		{			
			tmp.push({
				id: parseInt(conv.chatboxes[i].id),
				min: conv.chatboxes[i].minimized,
				lmid: conv.chatboxes[i].last_mid
			});
		}
		
		return tmp;
	},
	
	/**
	 * get all conversation ids from active windows
	 */
	getCids: function()
	{
		var tmp = new Array();
		
		for(var i=0;i<conv.chatboxes.length;i++)
		{
			tmp.push(parseInt(conv.chatboxes[i].id));
		}
		
		return tmp;
	},
	
	/**
	 * open settingsmenu to the given chatbox
	 */
	settings: function(cid)
	{
		key = this.getKey(cid);
		this.chatboxes[key].el.children('.chatboxhead').children('.settings').toggle();
	},
	
	/**
	 * append an chat message to chat window with given array index attention not conversation id ;)
	 */
	append: function(key,message)
	{
		conv.chatboxes[key].last_mid = parseInt(message.id);
		conv.chatboxes[key].el.children('.slimScrollDiv').children('.chatboxcontent').append('<div title="'+message.time+'" class="chatboxmessage"><span class="chatboxmessagefrom"><a href="#" class="photo" onclick="profile('+message.fs_id+');return false;"><img src="'+conv.img(message.fs_photo+'','mini')+'"></a></span><span class="chatboxmessagecontent">'+nl2br(message.body.autoLink())+'<span class="time">'+timeformat.nice(message.time)+'</span></span><div style="clear:both;"></div></div>');
	},
	
	/**
	 * load the first content for one chatbox
	 */
	initChat: function(cid)
	{
		conv.showLoader(cid);
		
		var key = this.getKey(cid);
		var cid = cid;
		
		ajax.req('msg','loadconversation',{
			loader:false,
			data:{
				id:cid
			},
			success: function(ret){
				/*
				 * add link to leave the chat only if its no 1:1 conversation
				 */
				if(ret.member.length > 2)
				{
					//conv.addChatOption(cid,'<a href="#" onclick="ajax.req(\'msg\',\'invite\',{data:{cid:'+cid+'}});return false;">Jemand zum Chat hinzufügen</a>');
					conv.addChatOption(cid,'<a href="#" onclick="if(confirm(\'Bist Du Dir Sicher das Du den Chat verlassen möchtest?\')){ajax.req(\'msg\',\'leave\',{data:{cid:'+cid+'}});}return false;">Chat verlassen</a>');
					conv.addChatOption(cid,'<span class="optinput"><input placeholder="Chat umbenennen..." type="text" name="chatname" value="" maxlength="30" /><i onclick="var val=$(this).prev().val();ajax.req(\'msg\',\'rename\',{data:{cid:'+cid+',name:val}});return false;" class="fa fa-arrow-circle-right"></i></span>');
				}
				
				/*
				 * first make a title with all the usernames
				 */
				
				title = ret.conversation.name;
				if(ret.conversation.name === null)
				{
					title = new Array();
					for(var i=0;i<ret.member.length;i++)
					{
						if(ret.member[i] != undefined && ret.member[i].id != user.id)
						{
							title.push(ret.member[i].name);
						}
						
					}
					title = title.join(', ');
				}
				
				
				
				conv.chatboxes[key].el.children('.chatboxhead').children('.chatboxtitle').html('<i class="fa fa-comment fa-flip-horizontal"></i> ' + title);
				
				/*
				 * now append all arrived messages
				 */
				if(ret.messages != undefined && ret.messages.length > 0)
				{
					/*
					 * list messages the reverse way
					 */
					for(var y=(ret.messages.length-1);y>=0;y--)
					{
						conv.append(key,ret.messages[y]);
					}
					
					conv.scrollBottom(cid);
				}
			},
			complete: function(){
				conv.hideLoader(cid);
				conv.registerPollingService();
			}
		});
	},
	
	appendChatbox: function(cid,min)
	{		
		
		if(this.isBigPageMode)
		{
			msg.loadConversation(cid);
			return false;
		}
		
		if(min == undefined)
		{
			min = false;
		}
		if(conv.getKey(cid) === -1)
		{
			right = 20 + (this.chatCount*285);
			
			options = '<li><a href="/?page=msg&cid='+cid+'">Alle Nachrichten</a></li>';
			
			var $el = $('<div id="chat-'+cid+'" class="chatbox ui-corner-top" style="bottom: 0px; right: '+right+'px; display: block;"></div>').appendTo('body');
			$el.html('<div class="chatboxhead ui-corner-top"><a class="chatboxtitle" href="#" onclick="conv.togglebox(' + cid + ');return false;"><i class="fa fa-spinner fa-spin"></i> ' + name + '</a><ul style="display:none;" class="settings linklist linkbubble ui-shadow corner-all">'+options+'</ul><div class="chatboxoptions"><a href="#" class="fa fa-gear" title="Einstellungen" onclick="conv.settings('+cid+');return false;"></a><a title="schließen" class="fa fa-close" href="#" onclick="conv.close('+cid+');return false;"></a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea placeholder="schreibe etwas..." class="chatboxtextarea" onkeydown="conv.checkInputKey(event,this,\''+cid+'\');"></textarea></div>');
			
			$el.children('.chatboxcontent').slimScroll();
			$el.children('.chatboxinput').children('textarea').autosize();
			
			$el.children('.chatboxinput').children('textarea').focus(function(){
				conv.activeBox = cid;
			});
			
			this.chatboxes.push({
				el: $el,
				id: cid,
				minimized: false,
				last_mid:0
			});
			
			this.chatCount++;
			
			/*
			 * do the init ajax call
			 */
			this.initChat(cid);
			
			/*
			 * focus textarea
			 */
			$el.children('.chatboxinput').children('textarea').select();
			
			/*
			 * register service new
			 */
			if(min)
			{
				conv.minbox(cid);
			}			
		}
		else
		{
			this.maxbox(cid);
		}
	},
	addChatOption: function(cid,el)
	{
		$('#chat-'+cid+' .settings').append('<li>'+el+'</li>');
	}
};
$(function(){
	if($('body.loggedin').length > 0)
	{
		conv.init();
	}
});
