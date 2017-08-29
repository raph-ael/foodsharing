var msg = {
	conversation_id:0,
	last_message_id:0,
	heartbeatTime:500,
	fsid:0,
	heartbeatXhr:false,
	listTimeout:false,
	moreIsLoading:false,
	$conversation:null,
	$answer:null,
	$submit:null,
	$convs:null,
	
	init: function(){
		
		/*
		 * to reduce server last stop all other heartbeat functionality
		 */
		stopHeartbeats();
		
		/*
		 * initiate dom querys for a little bit js performance
		 */
		this.$conversation = $('#msg-conversation');
		this.$answer = $('#msg_answer');
		this.$submit = $('#msg-control input[type=submit]');
		this.$convs = $('#conversation-list ul');
		
		/*
		 * call method to initiate the compose message functionality
		 */
		this.initComposer();
		
		
		if(!msg.isMob())
		{
			var height = ($(window).height()-200)+'px';
			this.$conversation.css('height',height);
			
			this.$conversation.slimScroll({
				height: height
			});
		}
		else
		{
			//var height = ($(window).height()-130)+'px';
			this.$conversation.css({
				height:'auto',
				//width:$(window).width()+'px',
				overflow:'hidden',
				padding:'0',
				margin:'0'
			});
			msg.scrollBottom();
			/*
			this.$conversation.slimScroll({
				height: height
			});
			*/
		}
		
		
		
		/*
		 * make the message windows as big as possible
		 */
		$(window).resize(function(){

			if(!msg.isMob())
			{
				var height = ($(window).height()-200)+'px';
				msg.$conversation.css('height',height);
				msg.$conversation.parent('.slimScrollDiv').css('height',height);
				msg.$conversation.slimScroll({
					height: height,
					scrollTo : $('#msg-conversation').prop('scrollHeight') + 'px' 
				});
			}
			else
			{
				// resize event is triggered also on scrolling in android / ios
				// http://stackoverflow.com/questions/14257541/android-browser-triggers-jquery-window-resize-on-scolling
				clearTimeout(app.resize.timer);
				app.resize.timer = setTimeout(function(){
					// do not check height, because it changes on scrolling due to hide / show address bar
					var window_changed = $(window).width() != app.size.window_width;
					if(window_changed) {

						// window was actually resized
						msg.scrollBottom();

					}
				}, 500);
			}
		});
		
		$('#msg_answer').autosize();
		
		$('#msg_answer').resize(function(){
			
			$('#msg_answer').css('margin-top','-'+($('#msg_answer').height()-40)+'px');
		});
		
		/*
		 * initiate message submit functionality for conversation form
		 */
		$('#msg-control form').submit(function(ev){
			ev.preventDefault();
			
			var val = $('#msg_answer').val();
			if(val != '')
			{
				
				msg.$answer.val('');
				msg.$answer.css('height','40px');
				msg.$answer[0].focus();
				msg.showLoader();
				
				ajax.req('msg','sendmsg',{
					loader:false,
					method:'post',
					data:{
						c:msg.conversation_id,
						b:val	
					},
					success: function(data)
					{
						msg.appendMsg(data.msg);
						msg.hideLoader();
						msg.scrollBottom();
						
					},
					complete: function(){
						msg.hideLoader();
						setTimeout(function(){
							msg.hideLoader();
						},100);
					}
					
				});
			}
			else
			{
				//pulseInfo('Du musst einen Text eingeben <i class="fa fa-angellist"></i>');
			}
		});
		
		/*
		 * if the conversation list is not empty we want to load the first one
		 */
		
		var cid = 0;
		var gcid = GET('cid');
		if(GET('cid') != undefined && parseInt(gcid) > 0)
		{
			cid = gcid;
			this.loadConversation(cid);
		}
		else if(GET('u2c') != undefined)
		{
			conv.userChat(parseInt(GET('u2c')));
		}
		else if($('#conversation-list ul li a').length > 0)
		{
			cid = $('#conversation-list ul li:first').attr('id').split('-')[1];
			this.loadConversation(cid);
		}
		else
		{
			msg.heartbeat();
		}
		/*
		 * start the heartbeat
		 */
		/*
		$(window).load(function(){
			setTimeout(function(){
				msg.heartbeat();
			},4000);
		});	
		*/	
	},
	
	isMob:function()
	{
		if($(window).width() > 600)
		{
			return false;
		}
		return true;
	},
	
	/**
	 * list heartbeat checks everytime updates on all conversations
	 */
	heartbeat: function(){
		
		info.editService('msg','heartbeat',{
			cid:msg.conversation_id,
			mid:msg.last_message_id,
			speed:'fast'
		});
		
		/*
		msg.heartbeatXhr = ajax.req('msg','heartbeat',{
			data:{
				cid:msg.conversation_id,
				mid:msg.last_message_id
			},
			loader:false,
			success: function(ret){
					
				/*
				 * update current chat if there are new messages
				 *
				if(ret.messages != undefined)
				{
					for(var i=0;i<ret.messages.length;i++)
					{
						//alert(ret.messages[i].id);
						msg.appendMsg(ret.messages[i]);
					}
					msg.scrollBottom();
				}
				
				/*
				 * update conversation list move newest on top etc.
				 *
				if(ret.convs)
				{
					for(var i=0;i<ret.convs.length;i++)
					{						
						// if the element exist remove to add it new on the top
						$('#convlist-' + ret.convs[i].id).remove();
						msg.appendConvList(ret.convs[i],true);
					}
				}
					
				console.log(ret);
			},
			complete: function(){
				msg.heartbeat();
			}
		});
		*/

	},
	
	/*
	 * Method for arrived message data from socket.io
	 */
	push: function(message)
	{
		
		if(message.cid == msg.conversation_id)
		{
			msg.appendMsg(message);
			msg.scrollBottom();
		}
		else
		{
			//$('#convlist-' + message.cid).remove();
			msg.updateConvList(message);
		}
	},
	
	updateConvList: function(message)
	{
		$item = $('#convlist-' + message.cid);
		$itemLink = $item.children('a');
		if($item.length > 0)
		{
			$itemLink.children('.msg').html(message.body);
			$itemLink.children('.time').text(timeformat.nice(message.time));
			$item.hide();
			$item.prependTo('#conversation-list ul:first');
			$item.show('highlight',{color:'#F5F5B5'});
			
		}
		else
		{
			msg.loadConversationList();
		}
	},
	
	/**
	 * Method will be called if ther arrived something new from the server
	 */
	pushArrived: function(data)
	{
		var ret = data.msg_heartbeat;
		
		console.log(ret._duration);
		
		/*
		 * update current chat if there are new messages
		 */
		if(ret.messages != undefined)
		{
			for(var i=0;i<ret.messages.length;i++)
			{
				//alert(ret.messages[i].id);
				msg.appendMsg(ret.messages[i]);
			}
			msg.scrollBottom();
		}
		
		/*
		 * update conversation list move newest on top etc.
		 */
		if(ret.convs)
		{
			for(var i=0;i<ret.convs.length;i++)
			{						
				// if the element exist remove to add it new on the top
				$('#convlist-' + ret.convs[i].id).remove();
				msg.appendConvList(ret.convs[i],true);
			}
		}
	},
	
	/**
	 * function will abort the heartbeat ajax call and restart it
	 */
	heartbeatRestart: function(){
		
		info.editService('msg','heartbeat',{
			cid:msg.conversation_id,
			mid:msg.last_message_id,
			speed:'fast'
		});
		/*
		if(this.heartbeatXhr == false)
		{
			msg.heartbeat();
		}
		else
		{
			msg.heartbeatXhr.abort();
		}
		*/
	},
	initComposer: function(){
		$('#compose_body').autosize();
		$('#compose_submit').click(function(ev){
			ev.preventDefault();
			
			var recip = msg.getRecipients();
			if(recip != false)
			{
				var body = $('#compose_body').val();
				if(body != '')
				{
					ajax.req('msg','newconversation',{
						data: {
							recip: recip,
							body: body
						},
						method: 'post',
						success:function(data)
						{
							msg.clearComposeForm();
							msg.loadConversation(data.cid);
						}
					});
				}
				else
				{
					pulseInfo('Du musst eine Nachricht eingeben');
				}
			}
			
		});
	},
	showLoader: function(){
		this.$conversation.children('.loader').show();
		this.scrollBottom();
		//msg.$submit.attr("disabled", "disabled");
	},
	hideLoader: function(){
		this.$conversation.children('.loader').hide();
		//msg.$submit.removeAttr("disabled"); 
	},
	
	prependMsg: function(message){
		
		var $el = msg.msgTpl(message);
		
		if(msg.$conversation == undefined)
		{
			msg.$conversation = $('#msg-conversation');
		}
		
		msg.$conversation.children('ul:first').prepend($el);
		
		//msg.$conversation.children('ul:first').append($el);
		$el.show('highlight',{color:'#F5F5B5'});
	},
	
	appendMsg: function(message){
		
		var $el = msg.msgTpl(message);
			
		if(msg.$conversation == undefined)
		{
			msg.$conversation = $('#msg-conversation');
		}
		
		msg.$conversation.children('ul:first').append($el);
		
		//msg.$conversation.children('ul:first').append($el);
		$el.show('highlight',{color:'#F5F5B5'});
		
		this.last_message_id = message.id;
	},
	
	msgTpl: function(message)
	{
		return $('<li id="msg-'+message.id+'" style="display:none;"><span class="img"><a title="'+message.fs_name+'" href="#" onclick="profile('+message.fs_id+');return false;"><img height="35" src="'+img(message.fs_photo,'mini')+'" /></a></span><span class="body">'+nl2br(message.body.autoLink())+'<span class="time">'+timeformat.nice(message.time)+'</span></span><span class="clear"></span></li>');
	},
	
	getRecipients: function(){
		var out = [];
		$('#compose_recipients li.tagedit-listelement-old input').each(function(){
			id = $(this).attr('name').replace('compose_recipients[','').split('-')[0];
			id = parseInt(id);
			out[out.length] = id;
		});
		
		console.log(out);
		
		if(out.length > 0)
		{
			return out;
		}
		else
		{
			pulseError('Du hast noch keine Empfänger ausgewählt.');
			return false;
		}
		
	},
	compose: function()
	{
		$('#compose').show();
		$('#msg-conversation-wrapper').hide();
		$('#conversation-list .active').removeClass('active');
		msg.conversation_id = 0;
		msg.last_message_id = 0;
	},
	loadConversation: function(id)
	{
		if(id == msg.conversation_id)
		{
			msg.scrollBottom();
			$('#msg_answer').select();
			return false;
		}
		msg.conversation_id = id;
		
		ajax.req('msg','loadconversation',{
			data:{
				id:id
			},
			success: function(data)
			{
				msg.resetConversation();
				
				var data = data;
				$conversation = $('#msg-conversation ul:first');
				$conversation.html('');
				
				/*
				 * add members to conversation title
				 */
				
				var title = '';
				
				var names = [];
				if(data.member != undefined && data.member.length > 0)
				{
					for(var i=0;i<data.member.length;i++)
					{
						if(data.member[i].id != msg.fsid)
						{
							names[names.length] = data.member[i].name;
							title += '<a title="'+data.member[i].name+'" href="#" onclick="profile('+data.member[i].id+');return false;"><img src="'+img(data.member[i].photo,'mini')+'" width="22" alt="'+data.member[i].name+'" /></a>'
						}
					}
				}
				
				str_title = data.conversation.name;
				if(str_title === null)
				{
					str_title = 'Unterhaltung mit ' + names.join(', ');
				}
				
				
				title = '&nbsp;<div class="images">' + title + '</div>' + str_title + '<div style="clear:both;"></div>';
				
				$('#msg-conversation-title a').remove();
				$('#msg-conversation-title').append(title);
				
				/*
				 * append messages to conversation message list
				 */
				if(data.messages != undefined)
				{
					data.messages.reverse();
					for(var i=0;i<data.messages.length;i++)
					{
						// $conversation.append('<li><span class="body">'++'</span><span class="time">'+timeformat.nice()+'</span></li>');
						msg.appendMsg(data.messages[i]);
					}
					
				}
				
				$('#compose').hide();
				$('#msg-conversation-wrapper').show();
				msg.scrollBottom();
				
				msg.$convs.children('li.active').removeClass('active');
				$('#convlist-' + id).addClass('active');
				
				$('#msg_answer').select();
				
				msg.heartbeatRestart();
				
				msg.scrollTrigger();
				
			} // success end
		}); // ajax end
		
		
		
	},
	
	loadMore: function()
	{
		//alert(msg.last_message_id);
		var lmid = parseInt($('#msg-conversation li:first').attr('id').replace('msg-',''));
		
		if(!msg.moreIsLoading)
		{
			msg.moreIsLoading = true;
			ajax.req('msg','loadmore',{
				loader:true,
				data:{
					lmid:lmid,
					cid:msg.conversation_id
				},
				success: function(ret){
					msg.moreIsLoading = false;
					
					for(var i=0; i<ret.messages.length; i++)
					{
						msg.prependMsg(ret.messages[i]);
					}
					
					var position = $('#msg-' + lmid).position();
					
					if(!msg.isMob())
					{
						$('#msg-conversation').slimScroll({scrollTo : position.top + 'px' });
					}
					else
					{
						$(window).scrollTop(position.top);
						//$('body').scrollTop($('body')[0].scrollHeight);
					}
					
				}
			});
		}
	},
	
	scrollTrigger: function()
	{
		msg.moreIsLoading = false;
		
		if(!msg.isMob())
		{
			msg.$conversation.unbind('scroll');
			msg.$conversation.scroll(function(){
				
				var $conv = $(this);
				if($conv.scrollTop() == 0)
				{
					msg.loadMore();
				}
				
			});
		}
		else
		{
			$(window).unbind('scroll');
			$(window).scroll(function(){
				
				var $conv = $(this);

				if($conv.scrollTop() == 0)
				{
					msg.loadMore();
				}
				
			});
		}
		
	},
	
	loadConversationList: function(){
		ajax.req('msg','loadconvlist',{
			loader:false,
			success: function(ret){
				if(ret.convs != undefined && ret.convs.length > 0)
				{
					msg.$convs.html('');
					msg.loadConversation(ret.convs[0].id);
					
					for(var i=0;i<ret.convs.length;i++)
					{
						msg.appendConvList(ret.convs[i]);
					}
				}
			},
			complete: function(){				
				
			}
		});
	},
	resetConversation: function(){
		$('#msg-conversation-title').html('<i class="fa fa-comment"></i>');
		$('#msg-conversation ul').html('');
	},
	appendConvList: function(conversation,prepend)
	{
		pics = '';
		names = '';
		if(conversation.member != undefined && conversation.member.length > 0)
		{
			picwidth = 50;
			size = 'med';
			if(conversation.member.length > 2)
			{
				conversation.member = shuffle(conversation.member);
				picwidth = 25;
				size = 'mini';
			}
			
			for(var y=0;y<conversation.member.length;y++)
			{
				if(msg.fsid != conversation.member[y].id)
				{
					pics += '<img width="'+picwidth+'" src="'+img(conversation.member[y].photo,size)+'" />';
					names += ', '+conversation.member[y].name;
				}
			}	
		}
		
		names = names.substring(2);
		cssclass = '';
		
		if(msg.conversation_id == conversation.id)
		{
			cssclass = ' class="active"';
		}
		
		$el = $('<li style="display:none;" id="convlist-'+conversation.id+'"'+cssclass+'><a href="#" onclick="msg.loadConversation('+conversation.id+');return false;"><span class="pics">'+pics+'</span><span class="names">'+names+'</span><span class="msg">'+conversation.body+'</span><span class="time">'+timeformat.nice(conversation.time)+'</span><span class="clear"></span></a></li>');
		
		if(prepend != undefined)
		{
			msg.$convs.prepend($el);
		}
		else
		{
			msg.$convs.append($el);
		}
		
		$el.show('highlight',{color:'#F5F5B5'});
		
		msg.$convs.children('.noconv').remove();
	},
	clearComposeForm: function()
	{
		$('#compose_recipients-wrapper .tagedit-listelement-old').remove();
		$('#compose_body').val('');
	},
	scrollBottom: function()
	{
		//$('#msg-conversation').slimScroll({scrollTo : $('#msg-conversation').prop('scrollHeight') + 'px' });
		
		if(!msg.isMob())
		{
			$('#msg-conversation').slimScroll({scrollTo : $('#msg-conversation').prop('scrollHeight') + 'px' });
		}
		else
		{
			$(window).scrollTop($(document).height());
			//$('body').scrollTop($('body')[0].scrollHeight);
		}
	}
};

$(function(){
	msg.init();
});
