var activity = {
		
		/*
		 * Elements
		 */
		$container: null,
		$loader:null,
		$page:null,
		$info:null,
		
		isLoading:null,
		page:null,
		user:null,
		listOptions:null,
		initiated:false,
		
		init: function()
		{
			this.isLoading = false;
			this.page = 0;
			$('#activity').append('<ul class="linklist"></ul>');
			this.$container = $('#activity > ul.linklist');
			this.$loader = $('#activity > .loader');
			this.$info = $('#activity-info');

			this.initLoad();
			
			$(window).scroll(function () {
				if(!activity.isLoading)
				{
					if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
					      activity.isLoading = true;
					      activity.page++;
					      ajax.req('activity','loadmore',{
					    	  data:{
					    		  page:activity.page
					    	  },
					    	  success: function(ret)
					    	  {
					    		  if(ret.updates != undefined && ret.updates.length > 0)
									{
										for(var i = 0;i<ret.updates.length;i++)
										{
											activity.append(ret.updates[i]);
										}
									}
									activity.sortUpdates();
					    		  activity.isLoading = false;
					    	  }
					      });
					   }
				}
			});
		},
		
		initLoad: function(option)
		{
			this.page = 0;
			this.$container.html('');
			
			opt = {listings:1};
			if(option != undefined)
			{
				opt = option;
			}
			
			activity.$loader.show();
			ajax.req('activity','load',{
				loader:false,
				data:opt,
				success: function(ret){
					activity.$loader.hide();
					
					if(ret.listings != undefined && !activity.initiated)
					{
						activity.initiated = true;
						activity.initOption(ret.listings);
					}
					
					if(ret.updates != undefined && ret.updates.length > 0)
					{
						activity.$info.hide();
						activity.user = ret.user;
						
						for(var i = 0;i<ret.updates.length;i++)
						{
							activity.append(ret.updates[i]);
						}
						activity.sortUpdates();
					}
					else 
					{
						activity.$info.show();
					}
					
				}
			});
		},
		
		append: function(up)
		{
			
			/*
			 '<div class="updatepost">'
				+ '<img src="'+up.icon+'" />'
			+ '<div class="post">'		
			+ '<div class="activity_feed_content">'
				+ '<div class="activity_feed_content_text">'
					+ '<div class="activity_feed_content_info">'
						+ '<a onclick="profile(926);" href="#">Jessy</a> hat etwas auf die Pinnwand von <a href="/?page=fsbetrieb&amp;id=11">Alnatura Bayenthal</a> geschrieben.'
					+ '</div>'
				+ '</div>'
				+ '<div class="activity_feed_content_link">'
					+ 'Tragt euch fließig ein, die nächsten Tage gibt es noch viele freie Kästchen hier ;-)'
				+ '</div>'
			+ '</div>'
			+ '<div class="js_feed_comment_border">'
			+ '<div class="comment_mini_link_like">'
				+ '<div class="foot">'
					+ '<span class="time">Sonntag, 14. Dez, 12:59 Uhr</span>'
				+ '</div>'
			+ '</div>'
			+ '<div class="clear"></div>'
			+ '</div>'
			+ '</div>'
			+ '<div style="clear:both;"></div>'
		+ '</div>'
		
		<a class="corner-all" href="'+href+'"'+click+'>
		*/
			
			var quickreply = '';
			
			if(up.quickreply != undefined)
			{
				quickreply = '<span class="qr"><img src="'+activity.user.avatar+'" /><textarea data-load="0" data-url="'+up.quickreply+'" name="quickreply" class="quickreply noninit" placeholder="Schreibe eine Antwort..."></textarea><span class="loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></span>';
			}
			
			activity.$container.append('<li data-ts="'+up.time+'"><span class="i"><img width="50" src="'+up.icon+'" /></span><span class="n">'+up.title+'</span><span class="t">'+up.desc+'</span>'+quickreply+'<span class="time"><i class="fa fa-clock-o"></i> '+$.timeago(up.time)+' <i class="fa fa-angle-right"></i> '+timeformat.nice(up.time)+'</span><span class="c"></span></li>');
		},
		
		initQuickreply: function()
		{
			var $act = $('#activity');
			
			
			// noninit
			$('.quickreply.noninit').each(function(){
				var $el = $(this);
				var $loader = $el.next();
				
				$el.autosize();
				$el.focus(function(){
					$el.parent().css({opacity:1});
				});
				
				$el.keydown(function(event){
					if(event.which == 13 && !event.shiftKey && $el.val() != '' && $el.data('load') == '0')  
					{
						event.preventDefault();
						
						$el.attr('data-load','1');
						$el.hide();
						$loader.show();
						
						$.ajax({
							url: $el.data('url'),
							data:{msg:$el.val()},
							dataType:'json',
							type:'post',
							complete: function(){
								$loader.hide();
								$el.attr('data-load','0');
							},
							error:function()
							{
								$el.show();
							},
							success: function(ret){
								
								if(ret.status != undefined)
								{
									if(ret.status == 1)
									{
										$el.val('');
										$el.parent().fadeOut('fast',function(){
											pulseInfo(ret.message);
										});
									}
									else
									{
										$el.show();
										pulseError(ret.message);
									}
								}
								else
								{
									pulseError('Es ist ein Fehler aufgetreten');
								}
							}
						});
					}
				});
				$el.removeClass('noninit');
			});
		},
		
		sortUpdates: function()
		{
			$('#activity li').tsort('',{order:'desc',attr:'data-ts'});
			
			this.initQuickreply();
			/*
			$("#activity li").sort(function (a, b) {
			    return parseInt(a.id) > parseInt(b.id);
			}).each(function(){
			    var elem = $(this);
			    
			    elem.remove();
			    $(elem).prependTo("#activity > ul");
			});
			*/
		},
		
		initOption: function(listings)
		{
			var html = '<form id="activity-option-form" class="pure-form pure-form-stacked"><fieldset><legend>Updates-Anzeige Optionen</legend>'
				+ '<div class="msg-inside info">'
				+ '<i class="fa fa-info-circle"></i> Hier kannst Du einstellen welche Updates auf Deiner Startseite angezeigt werden.'
				+ '</div>';
				
			for(var i=0;i<listings.length;i++)
			{
				html += this.initOptionListing(listings[i]);
			}
			
			html += '<legend><a href="#" id="activity-save-option" class="button" style="float:right;">Einstellungen Speichern</a></legend></fieldset></form>'
			
			$('body').append('<div id="activity-listings" class="corner-all white-popup mfp-hide">'+html+'</div>');
			
			$('#activity-option').magnificPopup({
				  type:'inline'
			});
			
			$('#activity-save-option').click(function(ev){
				ev.preventDefault();
				
				activity.listOptions = null;
				activity.listOptions = new Array();
				
				$('#activity-option-form input[type=\'checkbox\']').each(function(){
					
					if(!this.checked)
					{
						$el = $(this);
						activity.listOptions.push({index:$el.attr('name'),id:$el.val()});
					}
				});
				
				console.log(activity.listOptions);
				
				activity.initLoad({
					options: activity.listOptions
				});
				$.magnificPopup.close();
			});
		},
		
		initOptionListing: function(list)
		{
			if(list.items.length > 0)
			{
				out = '<h4>'+list.name+'</h4><p>';
				for(var i=0;i<list.items.length;i++)
				{
					check = '';
					if(list.items[i].checked)
					{
						check = ' checked="checked"';
					}
					out += '<label class="pure-checkbox"><input'+check+' type="checkbox" name="'+list.index+'" value="'+list.items[i].id+'" /> '+list.items[i].name+'</label>'
				}
				out += '</p>';
				
				return out;
			}
			else
			{
				return '';
			}
		}
		
};