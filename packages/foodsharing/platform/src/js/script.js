HTTP_GET_VARS=new Array();
strGET=document.location.search.substr(1,document.location.search.length);
var user = {
	token: ''
};

var dialogs = {
	dialogs:[],
	add: function(dialog){
		this.dialogs[this.dialogs.length] = dialog
	},
	closeAll: function(){
		for(i=0;i<dialogs.dialogs.length;i++)
		{
			//alert(typeof(dialogs.dialogs[i]));
			$dia = $('#' + dialogs.dialogs[i]);
			if($dia.length > 0)
			{
				if($dia.dialog('isOpen') === true)
				{
					$dia.dialog('close');
				}
			}
		}
		dialogs.dialogs = [];
	}
};
if(strGET!='')
{
    gArr=strGET.split('&');
    for(i=0;i<gArr.length;++i)
    {
        v='';vArr=gArr[i].split('=');
        if(vArr.length>1){v=vArr[1];}
        HTTP_GET_VARS[unescape(vArr[0])]=unescape(v);
    }
}

function GET(v)
{
	if(!HTTP_GET_VARS[v]){return 'undefined';}
	return HTTP_GET_VARS[v];
}

function collapse_wrapper(id)
{
	var $content = $('#' + id + '-wrapper .element-wrapper');
	var $label = $('#' + id + '-wrapper .wrapper-label i');
	if($content.is(':visible'))
	{
		$content.hide();
		$label.removeClass('fa-caret-down').addClass('fa-caret-right');
	}
	else
	{
		$content.show();
		$label.removeClass('fa-caret-right').addClass('fa-caret-down');
	}
}

function closeAllDialogs()
{
    var $activeDialogs = $(".ui-dialog").find('.ui-dialog-content');
    
    $activeDialogs.each(function(){
    	$dia = $(this);
    	$dia.dialog();
    	if($dia.dialog( "isOpen" ))
    	{
    		$dia.dialog().dialog( "close" );
    	}
    	
    });
    
}

var sleepmode = {
	init: function()
	{
		$(".sleepmode-1, .sleepmode-2").mouseover(function(){
			var $this = $(this);
			$this.append('<span class="corner-all bubble bubble-right ui-shadow">'+$this.text()+' nimmt sich gerade eine Auszeit und ist im Schlafmützen-Modus</span>');
		});
		$(".sleepmode-1, .sleepmode-2").mouseout(function(){
			var $this = $(this);
			$this.children('.bubble').remove();
		});
	}
};
var g_moreswapheight = 100;
$(document).ready(function(){
	
	//$(".sleepmode-1, .sleepmode-2").append('<span class="corner-all bubble bubble-right ui-shadow"> nimmt sich gerade eine Auszeit und ist im Schlafmützen-Modus</span>');
	sleepmode.init();
	
	$('textarea.comment').autosize();
	 $('#nojs').css('display','none');
	 $('#main').css('display','block');
	 
	 $('.moreswap').each(function(){
		 
		 var height = 100;
		 
		 $this = $(this);
		 $this.after('<a class="moreswaplink" href="#" data-show="0">Mehr anzeigen</a>');		 
		 
		 cheight = $this.attr('class').split('moreswap-height-');
		 
		 if(cheight.length > 1)
		 {
			 height = parseInt(cheight[1])
		 }
		 
		 g_moreswapheight = height;
		 
		 if($this.height() > 100)
		 {
			 $this.css({
				 'height':height+'px',
				 'overflow':'hidden'
			 });
		 }

	 });
	 
	 $('.moreswaplink').each(function(){
		 $this = $(this);
		 $this.prev().css({
			 'height':g_moreswapheight+'px',
			 'overflow':'hidden'
		 });
		 $this.click(function(ev){
			 ev.preventDefault();
			 if($this.attr('data-show') == 0)
			 {
				 $this.prev().css({
					 'height':'auto',
					 'overflow':'visible'
				 });
				 $this.text('einklappen');
				 $this.attr('data-show',1);
			 }
			 else
		     {
				 $this.prev().css({
					 'height':g_moreswapheight+'px',
					 'overflow':'hidden'
				 });
				 $this.text('Mehr anzeigen');
				 $this.attr('data-show',0);
		     }
		 });
	 });
	 
	 if(isMob())
	 {
		 $("#mobilemenu, .v-mob").show();
		 $("#mainMenu, .v-desktop").hide();
	 }
	 else
	 {
		 $("#mainMenu, .v-desktop").show();
		 $("#mobilemenu, .v-mob").hide();
	 }
	 $(window).resize(function(){
		 if(isMob())
		 {
			 $("#mobilemenu, .v-mob").show();
			 $("#mainMenu, .v-desktop").hide();
		 }
		 else
		 {
			 $("#mainMenu, .v-desktop").show();
			 $("#mobilemenu, .v-mob").hide();
		 }
	 });
	 
	 $('textarea.inlabel, input.inlabel').each(function() {
	        var $this = $(this);
	        if($this.val() === '') {
	           $this.val($this.attr('title'));
	        }
	        $this.focus(function() {
	          if($this.val() === $this.attr('title')) {
	            $this.val('');
	          }
	        });
	        $this.blur(function() {
	        if($this.val() === '') {
	           $this.val($this.attr('title'));
	        }
	    });
	 });

	 infoMenu();	 
	 if(!isMob())
     {
		 $('#main a').tooltip({
				show:false,
				hide:false,
				content: function() {
					var el = $( this );
					if(el.attr('title').substring(0,4) == '#tt-')
					{
						id = el.attr('title').substring(4);
						return $('.' + id).html();
					}
					else
					{
						return el.attr('title');
					}
				},
				position: {
					my: "center bottom-20",
					at: "center top",
					using: function( position, feedback ) {
					$( this ).css( position );
					$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
					}
				}
		});
     }
	
	 
	 //$('.select').customSelect();
	 
	 $(function() {
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				autoOpen:false,
				buttons: {
					"unwideruflich löschen": function() {
						goTo($('#dialog-confirm-url').val());
						$( this ).dialog( "close" );
					},
					'Abbrechen': function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});
	//$('.button').button();
	$('.dialog').dialog();
	$('.v-switch').buttonset();
	
	$('#topmenu').buttonset();
	$('#topmenu').first().click();
	
	$( "ul.toolbar li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
	);
	
	$( ".text, .textarea, select" ).focus(
			function() {
				$( this ).addClass( "focus" );
			}
	);
	$( ".text, .textarea, select" ).blur(
			function() {
				$( this ).removeClass( "focus" );
			}
	);
	
	$(".value").blur(function(){
		el = $(this);
		if(el.val() != '')
		{
			el.removeClass('input-error');
		}
	});
	
	$("#uploadPhoto").dialog({
		autoOpen:false,
		modal:true,
		buttons:
		{
			"Upload":function()
			{
				uploadPhoto();
			}
		}
	});
	
	$("#comment").dialog({
		autoOpen:false,
		modal:true,
		buttons:
		{
			"Speichern":function()
			{
				$.ajax({
					dataType:"json",
					url:"/xhr/?f=addComment&name="+$('#comment-name').val()+"&id="+$('#comment-id').val()+"&comment=" + encodeURIComponent($("#comment textarea").val()),
					success : function(data){
						if(data.status == 1)
						{
							$("#comment").dialog('close');
							$("#comment textarea").val('');
							info(data.msg);
						}
						else
						{
							alert(data);
						}
					}
				});
			}
		}
	});
	
	$('.toolbar-comment').click(function(){
		l = $(this).attr('attr').split(':');
		$('#comment-id').val(l[1]);
		$('#comment-name').val(l[0]);
		
		$('#comment').dialog('open');
	});
	
	$("#fancylink").fancybox({
		minWidth : 470,
		maxWidth : 470,
		minHeight: 450,
		scrolling :"auto",
		beforeClose:function(){
			g_firstChatUpdate = true;
		},
		helpers : { 
		  overlay : {closeClick: false}
		}
	});	
});
 
function chat(fsid)
{
	conv.userChat(fsid);
	/*
	closeDialogs();
	showLoader();
	fancy_xhr("getMsg&id=" + fsid, false);
	*/
}
function closeDialogs()
{
	$('.dialogbox').each(function(){
        if($(this).dialog("isOpen"))
        {
        	$(this).dialog("close");
        }
     });
}
function addbanana(fsid)
{
	$('.vouch-banana').tooltip('close');
	
	$('#fsprofileratemsg-wrapper label').html($('.vouch-banana-title').html());
	$('#fsprofileratemsg-wrapper div.desc').html($('.vouch-banana-desc').html());
	$('#fsprofileratemsg').css({
		'height':'137px',
		'width':'558px'
	});
	$('#fs-profile-rate-comment').dialog('option',{
		width:600,
		height:450
	});
	$('#fs-profile-rate-comment').dialog('open');
}
function login()
{
	ajreq('login',{app:'login'});
}

function profile(id)
{
	showLoader();
	goTo('/profile/' + id);
}

function quickprofile(id)
{
	//alert(id);
	//fancy_xhr('profile&id='+id);
	
	showLoader();
	
	$.ajax({
		dataType:"json",
		url:"/xhrapp/?app=profile&m=quickprofile&id=" + id,
		success : function(data){
			hideLoader();
			if(data.status == 1)
			{
				$('#tabs-profile').tabs("destroy");
				$('#dialog-profile-info').dialog("destroy");
				$("#u-profile").html(data.html);
				$('#tabs-profile').tabs();

				$('#dialog-profile-info').dialog({
				        closeOnEscape: false,
				        draggable: false,
				        resizable: false,
				        autoOpen: true,
				        modal: true,
				        width:470,
				        open: function() {
				            $(this).find('.ui-dialog-titlebar-close').blur();
				        }
				}).parent().find('.ui-dialog-titlebar-close').prependTo('#tabs-profile').closest('.ui-dialog').children('.ui-dialog-titlebar').remove();
				   
				$('#dialog-profile-info').css('padding','0');
				$('.ui-dialog-titlebar-close').css({
				     'position': 'absolute',
					 'right': '8px',
					 'top': '17px'
				});
				$("#tabs-profile").css({
				    "border": "none",
				    "padding": "0"
				});
				$('.vouch-banana').tooltip({
					position: {
						my: "center bottom-20",
						at: "center top",
						using: function( position, feedback ) {
						$( this ).css( position );
						$( "<div>" )
							.addClass( "arrow" )
							.addClass( feedback.vertical )
							.addClass( feedback.horizontal )
							.appendTo( this );
						}
					}
				});
				$('#fsprofileratemsg').val('');

				$('#tabs-profile').tabs('option',{
					heightStyle: 'fill'
				});
				$('#tabs-profile .ui-tabs-panel:first').css('overflow','hidden');
				$('.xvmoreinfo').slimScroll();
				
				$('#dialog-profile-info').dialog( 'option', 'position', 'center' );
				/*
				$('.fsrating').jRating({
					step:true,
					length : 10, 
					decimalLength:0,
					bigStarsPath: '/css/icons/zitrone.png',
					sendRequest: false,
					rateMax: 10,
					rateInfosY: 10,
					onClick: function(el,rate){
						showLoader();
						$.ajax({
							url: "xhrapp/?app=profile&m=rate",
							data:{
								id: id,
								rate: rate
							},
							dataType: "json",
							success: function(data){
								if(data.status == 1)
								{
									$("#ratecountlabel").html(parseInt($("#ratecountlabel").text())+1);
									
									$("#fs-profile-rate-comment").dialog("open");
								}
							},
							complete: function(){
								hideLoader();
							}
						});
					}
				});
				*/
				if(data.script != undefined)
				{
					$.globalEval(data.script);
				}
			}
			else
			{
				error(data.msg);
			}
		},
		complete:function(){
			hideLoader();
		}
	});
	
	/*
	 * helpers:  {
        overlay : {
            css : {
                'background-color' : '#fff'
            }
        }
	 */
}
var ajax = {
	data:{},
	msg: function(msg){
		for(i=0;i<msg.length;i++)
		{
			switch(msg[i].type)
			{
				case 'error':
					pulseError(msg[i].text);
					break;
					
				case 'success':
					pulseSuccess(msg[i].text);
					break;
					
				default:
					pulseInfo(msg[i].text);
					break;
					
			}
		}
	},
	req: function(app,method,option){
		
		var opt = {};
		if(option != undefined)
		{
			opt = option;
		}
		
		if(opt.method == undefined)
		{
			opt.method = 'get';
		}
		
		if(opt.loader == undefined || opt.loader == true)
		{
			opt.loader = true;
			showLoader();
		}
		
		if(opt.data == undefined)
		{
			opt.data = {};
		}
		
		return $.ajax({
			url:"/xhrapp/?app="+app+"&m=" + method,
			data: opt.data,
			dataType:'json',
			method:opt.method,
			success:function(ret){
				if(ret.status == 1)
				{
					if(ret.msg != undefined)
					{
						ajax.msg(ret.msg);
					}

					if(ret.append != undefined)
					{
						$(ret.append).html(ret.html);
					}
					
					if(ret.script != undefined)
					{
						if(ret.data != undefined)
						{
							ajax.data = ret.data;
						}
						$.globalEval( ret.script );
					}	
					
					if(opt.success != undefined)
					{
						opt.success(ret.data);
					}
				}
			},
			fail: function(request) {
				if (request.status === 403) {
					pulseError('Du hast leider nicht die notwendigen Berechtigungen für diesen Vorgang.');
				}
			},
			complete:function(){
				if(opt.loader === true)
				{
					hideLoader();
				}
				if(opt.complete != undefined)
				{
					opt.complete();
				}
			}
		});
		
	}
};
function ajreq(name,options,method,app)
{
	var options = typeof options !== 'undefined' ? options : {};
	return ajax.req(options.app || app || GET('page'), name, {
		method: method,
		data: options,
		loader: options.loader
	} );
}
var u_pulse_error_to = null;
var u_pulse_info_to = null;
function pulseError(msg,opt)
{
	if(opt == undefined)
	{
		opt = {
			sticky: false
		};
	}
	time = 6000;
	if(opt.sticky)
	{
		time = 900000;
	}
	
	$("#pulse-error").html(msg);
	$("#pulse-error").stop().fadeIn();
	u_pulse_error_to = setTimeout(function(){
		$("#pulse-error").fadeOut();
		$(document).unbind('click');
	},time);
	setTimeout(function(){
		$(document).bind('click',function() {
			$("#pulse-error").stop().fadeOut();
			$(document).unbind('click');
			clearTimeout(u_pulse_error_to);
		});
	},500);
}

function pulseSuccess(msg,opt)
{
	if(opt == undefined)
	{
		opt = {
			sticky: false
		};
	}
	time = 5000;
	if(opt.sticky)
	{
		time = 900000;
	}
	
	$("#pulse-success").html(msg);
	$("#pulse-success").stop().fadeIn();
	u_pulse_error_to = setTimeout(function(){
		$("#pulse-success").fadeOut();
		$(document).unbind('click');
	},time);
	setTimeout(function(){
		$(document).bind('click',function() {
			$("#pulse-success").stop().fadeOut();
			$(document).unbind('click');
			clearTimeout(u_pulse_error_to);
		});
	},500);
}

function pulseInfo(msg,opt)
{
	if(opt == undefined)
	{
		opt = {
			sticky: false
		};
	}
	time = 4000;
	if(opt.sticky)
	{
		time = 900000;
	}
	
	$("#pulse-info").html(msg);
	$("#pulse-info").fadeIn();
	
	u_pulse_info_to = setTimeout(function(){
		$("#pulse-info").fadeOut();
		$(document).unbind('click');
	},time);
	setTimeout(function(){
		$(document).bind('click',function() {
			$("#pulse-info").fadeOut();
			$(document).unbind('click');
			clearTimeout(u_pulse_info_to);
		});
	},500);
}
 
function addHover(sel){$(sel).hover(function() {$( this ).addClass( "hover" );},function() {$( this ).removeClass( "hover" );});}

function infoMenu()
{
	addHover("div#msgBar .bar-item");
	
	$("div#msgBar .bar-msg").click(function(event){
		event.stopPropagation();
		$("#msgbar-messages").toggle();
		$("#msgbar-infos").hide();
		$("#msgbar-basket").hide();
	});
	
	$("#msgbar-messages").click(function(event){
		event.stopPropagation();
	});
	
	$(document).click(function() {
		$("#msgbar-messages").hide();
		$("#msgbar-infos").hide();
	});
	/*msg bar infos*/
	$("div#msgBar .bar-info").click(function(event){
		event.stopPropagation();
		$("#msgbar-infos").toggle();
		$("#msgbar-messages").hide();
		$("#msgbar-basket").hide();
	});
	
	/*msg bar basket*/
	$("div#msgBar .bar-basket").click(function(event){
		event.stopPropagation();
		
		$("#msgbar-infos").hide();
		$("#msgbar-messages").hide();
		if($('#msgbar-basket').is(":visible"))
		{
			$("#msgbar-basket").hide();
			g_interval_newBasket = setInterval(function(){
				ajreq("update",{app:"basket",loader:false});
			},10000);
		}
		else
		{
			clearInterval(g_interval_newBasket);
			if($("#msgbar-basket ul li.msg").length == 0)
			{
				$("#msgbar-basket ul").prepend('<li class="loading">&nbsp;</li>');
			}
			ajreq("loadupdates",{app:"basket",loader:false});
			$("#msgbar-basket").show();
			
		}
		
		event.stopPropagation();
	});
	
	
	$("#msgBar-badge span.bar-info").mouseover(function(){
		$("#msgBar .bar-info").trigger('mouseover');
	});
	$("#msgBar-badge span.bar-info").mouseout(function(){
		$("#msgBar .bar-info").trigger('mouseout');
	});
	
	$("#msgBar-badge span.bar-msg").mouseover(function(){
		$("#msgBar .bar-msg").trigger('mouseover');
	});
	$("#msgBar-badge span.bar-msg").mouseout(function(){
		$("#msgBar .bar-msg").trigger('mouseout');
	});
	
	$("#msgBar-badge span.bar-basket").mouseover(function(){
		$("#msgBar .bar-item.bar-basket").trigger('mouseover');
	});
	$("#msgBar-badge span.bar-basket").mouseout(function(){
		$("#msgBar .bar-item.bar-basket").trigger('mouseout');
	});
	$("#msgBar-badge span.bar-basket").click(function(){
		$("#msgBar .bar-item.bar-basket").trigger('click');
	});
	
	$("#msgBar-badge span.bar-info").click(function(event){
		event.stopPropagation();
		$("div#msgBar .bar-info").trigger('click');
	});
	$("#msgBar-badge span.bar-msg").click(function(event){
		event.stopPropagation();
		$("div#msgBar .bar-msg").trigger('click');
	});
	
	$('#msgBar .bar-item').on("touchstart", function(ev) {
		$(this).addClass('hover');
	});
	$('#msgBar .bar-item').on("touchend", function(ev) {
		$(this).removeClass('hover');
	});

	$('.msgbar-dropdown-menu.extended').slimScroll();
}
var g_interval_newBasket = null;
function aNotify()
{
	//$('#xhr-chat-notify')[0].play();
}

function checkEmail(email) {

    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email)) 
    {
    	return false;
    }
    else
    {
    	return true;
    }
}
function img(photo,size)
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
}

var g_firstChatUpdate=true;
function updateChat()
{
	$.ajax({
		dataType:"json",
		url:"/xhr/?f=updateChat&fsid=" + $("#xhr_sender_id").val() + '&fu=' + g_firstChatUpdate,
		success : function(data){
			hideLoader();
			if(data.status == 1)
			{
				$("ul#xv_message").html(data.html);

				if(data.script != undefined)
				{
					$.globalEval(data.script);
				}
				
				
				if(g_firstChatUpdate)
				{
					$("#scrollbar1").tinyscrollbar_update('bottom');
					g_firstChatUpdate = false;
					
				}
				
				//$(".tinyscroll").css({"overflow":"hidden","height":"400px"});
				
			}
			else if(data.status == 0)
			{
				
				//$("ul#xv_message").html(data.html);
			}
		}
	});
}

function fancy_xhr(func,loader)
{
	if(loader == undefined)
	{
		loader = true;
	}
	if(loader)
	{
		showLoader();
	}
	
	$.ajax({
		dataType:"json",
		url:"/xhr/?f=" + func,
		success : function(data){
			if(data.status == 1)
			{
				$("#fancy").html(data.html);
				$("#fancylink").trigger("click");
				
				if(data.script != undefined)
				{
					$.globalEval(data.script);
				}
			}
			else
			{
				error(data.msg);
			}
		},
		complete:function(){
			if(loader)
			{
				hideLoader();
			}
		}
	});
}

function stopHeartbeats()
{
	clearInterval(g_interval_newBasket);
	//stopChatHeartbeat();
}

function fancy(content,title,subtitle)
{
	t = '';
	s = '';
	if(title != undefined)
	{
		t = '<h3>'+title+'</h3>';
	}
	if(subtitle != undefined)
	{
		s = '<p class="subtitle">'+subtitle+'</p>';
	}
	$("#fancy").html('<div class="popbox">'+t+s+content+'</div>');
	$("#fancylink").trigger("click");
}

function isMob()
{
	if($( window ).width() < 900)
	{
		return true;
	}
	
	return false;
}

function xhrf(func)
{
	showLoader();
	$.ajax({
		dataType:"json",
		url:"/xhr/?f=" + func,
		success : function(data){
			hideLoader();
			if(data.status == 1)
			{
				hideLoader();
			}
		},
		complete:function(){
			hideLoader();
		}
	});
}
 
function reload()
{
	location.reload();
}

function v_field(content,title,id)
{
	return '<div id="'+id+'"><div class="head ui-widget-header ui-corner-top">'+title+'</div><div class="ui-widget ui-widget-content ui-corner-bottom margin-bottom ui-padding">'+content+'</div></div>';
}

function openPhotoDialog(fs_id)
{
	$("#uploadPhoto-fs_id").val(fs_id);
	$("#uploadPhoto").dialog('open');
}

function info(txt)
{
	if($('#info-msg').length == 0)
	{
		$('#top').after('<div class="ui-widget ui-msg"><div class="ui-state-highlight ui-corner-all ui-padding"><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span><ul id="info-msg">'+txt+'</ul><div class="clear"></div></div></div>');
	}
	else
	{
		$('#info-msg').append('<li>'+txt+'</li>');
	}

}
function error(txt)
{
	pulseError(txt);
	/*
	if($('#error-msg').length == 0)
	{
		$('#top').after('<div class="ui-widget ui-msg"><div class="ui-state-error ui-corner-all ui-padding"><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span><ul id="error-msg">'+txt+'</ul><div class="clear"></div></div></div>');
	}
	else
	{
		$('#error-msg').append('<li>'+txt+'</li>');
	}*/
}
 
function uploadPhoto()
{
	$('#uploadPhoto form').submit();
}

function uploadPhotoReady(id,file)
{
	fs_id = $('#uploadPhoto-fs_id').val();
	$("#miniq-"+id).attr('src',file);
	//$('#uploadPhoto-preview').html('<img width="200" src="images/'+fs_id+'.'+ext+'" />');
	$("#uploadPhoto").dialog('close');
	info('Foto erfolgreich hochgeladen!');
}

function addSelect(id)
{
	if($("#" + id + "neu").val().length > 0)
	{
		$.ajax({
			dataType:"json",
			url:"/xhr/?f=add" + ucfirst(id) + "&neu=" + encodeURIComponent($("#" + id + "neu").val()),
			success : function(data){
				
				$("#" + id).append('<option value="'+data.id+'">'+data.name+'</option>');
	
				$("#" + id + "neu").val("");
				$("#" + id + "-dialog").dialog( "close" );
				$("#" + id + " option").removeAttr("selected");
				$("#" + id + " option").last().attr("selected",true);
			}
		});
	}
}

function betrieb(id)
{
	goTo('/?page=betrieb&id='+id);
}

function goTo(url)
{
	if(url != '#')
	{
		document.location.href = url;
	}
}

function ucfirst (str) {

	  str += '';
	  var f = str.charAt(0).toUpperCase();
	  return f + str.substr(1);
}

function showComment(id)
{
	$("#dialog-comment").html($("#comment-" + id).val());
	
	$("#dialog-comment").dialog('option', 'title', $("#comment-title-" + id).val());
	$("#dialog-comment").dialog('open');
	
}

function ifconfirm(url,question,title)
{
	if(question != undefined)
	{
		$('#dialog-confirm-msg').html(question);
	}
	if(title != undefined)
	{
		$('#dialog-confirm').dialog('option','title',title);
	}
	
	$('#dialog-confirm-url').val(url);
	$('#dialog-confirm').dialog('open');
	/*
	if(confirm(question))
	{
		goTo(url);
	}
	*/
}

function picFinish(img,id)
{
	$('#'+id+'-action').val('upload');
	//$("#fotoupload").dialog('close');
	$.fancybox.close();
	d = new Date();
	imgp = img+'?'+d.getTime();
	$('#'+id+'-open').html('<img src="images/'+imgp+'" /><input type="hidden" name="photo" value="'+img+'" />');
	hideLoader();
	reload();
	//$('#fotouploadopen').children('span').html('Foto bearbeiten');
}
function pic_error(msg,id)
{
	msg = '<div class="ui-widget"><div style="padding: 15px;" class="ui-state-error ui-corner-all"><p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span><strong>Fehler:</strong> ' + msg + '</p></div></div>';
	$('#'+id+'-placeholder').html(msg);
	hideLoader();
}
function fotoupload(file,id)
{
	$('#' + id + '-file').val(file);
	d = new Date();
	img = file+'?'+d.getTime();
	
	$('#'+id+'-placeholder').html('<img src="./tmp/'+img+'" />');
	jcrop = $('#'+id+'-placeholder img').Jcrop({
         setSelect:   [ 100, 0, 400, 400 ],
         aspectRatio: 35 / 45,
         onSelect: function(c){
        		$('#'+id+'-x').val(c.x);
        		$('#'+id+'-y').val(c.y);
        		$('#'+id+'-w').val(c.w);
        		$('#'+id+'-h').val(c.h);
         }
     });
	 $('#'+id+'-save').show();
	 $('#'+id+'-save').button().click(function(){
		 showLoader();
		 $('#'+id+'-action').val('crop');
		 $('#'+id+'-form')[0].submit();
		 return false;
	 });
	 
	 $('#'+id+'-placeholder').css('height','auto');
	 hideLoader();
	 setTimeout(function(){
		 $.fancybox.update();
		 $.fancybox.reposition();
		 $.fancybox.toggle();
	 },200);
	 
}

function closeBox()
{
	$.fancybox.close();
}

function pictureReady(id,img)
{
	$('#' + id + '-preview').html('<img src="images/'+id+'/thumb_'+img+'" />');
	$('#' + id).val(id + '/' + img);
	
	$.fancybox.close();
	hideLoader();
}

function pictureCrop(id,img)
{

	ratio = $.parseJSON($('#' + id + '-ratio').val());
	ratio_val = $.parseJSON($('#' + id + '-ratio-val').val());
	
	ratio_i = parseInt($('#' + id + '-ratio-i').val());
	
	if(ratio[ratio_i] != undefined)
	{
		$('#' + id + '-ratio-i').val((ratio_i+1));
		if($('#' + id + '-ratio'))
		{
			//ratio = parseInt($('#' + id + '-ratio').val());
		}
		//alert(id+';'+path);
		$('#' + id + '-crop').html('<img src="images/' + id + '/' + img + '" /><br /><span id="'+id+'-crop-save">Speichern</span>');
		$('#' + id + '-crop img').Jcrop({
	        setSelect:   [ 100, 0, 400, 400 ],
	        aspectRatio: ratio[ratio_i],
	        onSelect: function(c){
	       		$('#'+id+'-x').val(c.x);
	       		$('#'+id+'-y').val(c.y);
	       		$('#'+id+'-w').val(c.w);
	       		$('#'+id+'-h').val(c.h);
	        }
	    });
		hideLoader();
		setTimeout(function(){
			 $.fancybox.update();
			 $.fancybox.reposition();
			 $.fancybox.toggle();
		 },200);
		
		$('#'+id+'-crop-save').button().click(function(){
			ratio_val[ratio_val.length] = {
				x:Math.round($('#'+id+'-x').val()),
				y:Math.round($('#'+id+'-y').val()),
				w:Math.round($('#'+id+'-w').val()),
				h:Math.round($('#'+id+'-h').val())
			}
			$('#' + id + '-ratio-val').val(JSON.stringify(ratio_val));
			
			pictureCrop(id,img);
		});
	}
	else
	{
		showLoader();
		$('#'+id+'-form').attr('action','xhr/?f=pictureCrop&id='+id+'&img='+img);
		$('#'+id+'-form').submit();
	}
}
function nl2br (str, is_xhtml) {
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function u_loadCoords(addressdata,func)
{
	anschrift = "";
	if(addressdata.str != undefined)
	{
		anschrift = addressdata.str + ' ' + addressdata.hsnr;
	}
	else
	{
		tmp = addressdata.anschrift.split("/");
		anschrift = tmp[0];
		
	}
	address = encodeURIComponent(anschrift +', '+ addressdata.plz+', '+addressdata.stadt+', Germany');
	
	url = "https://search.mapzen.com/v1/search?text=" + address;
	
	showLoader();
	$(document).ready(function(){
		$.getJSON(url,
			function(data){

				if(data.features)
				{

					for(i=0;i<data.features.length;i++)
					{
						if(data.features[i].properties.postalcode == addressdata.plz)
						{
							$("#pulse-error").hide();
							hideLoader();
							func(data.features[i].geometry.coordinates[0],data.features[i].geometry.coordinates[1]);
							return true;
						}
					}
				}

				hideLoader();

				pulseError("<strong>Die Koordinaten konnten nicht berechnet werden</strong><br />sind alle Eingaben Richtig? Ohne Koordinaten wird die Adresse nicht auf der Karte zu sehen sein");
			});
		});
}

function showLoader()
{
	$.fancybox.showLoading();
}
function hideLoader()
{
	$.fancybox.hideLoading();
}

function betriebRequest(id)
{
	showLoader();
	$.ajax({
		url: "/xhr/?f=betriebRequest",
		data: { "id": id },
		dataType: "json",
		success: function(data) {
			if(data.status == 1)
			{
				pulseInfo(data.msg);
			}
		},
		complete: function(){
			hideLoader();
		}
	});
	
}

function rejectBetriebRequest(fsid,bid)
{
	showLoader();
	$.ajax({
		dataType:"json",
		data: "fsid="+fsid+"&bid="+bid,
		url:"/xhr/?f=denyRequest",
		success : function(data){
			if(data.status == 1)
			{
				pulseSuccess(data.msg);
			}else{
				pulseError(data.msg);
			}
		},
		complete:function(){hideLoader();}
	});	
	
}

function checkAllCb(sel)
{
	$("input[type=\'checkbox\']").prop("checked", sel);
}

function becomeBezirk()
{
	$("#becomeBezirk-link").fancybox({	
			minWidth : 390,
			maxWidth : 400
		});
	$("#becomeBezirk-link").trigger('click');
}
function preZero(number, length) {
	if(length == undefined)
	{
		length = 2;
	}
    var num = '' + number;
    while (num.length < length) num = '0' + num;
    return num;
}

function shuffle(o)
{ 
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
}

/**
 * Merges two object-like arrays based on a key property and also merges its array-like attributes specified in objectPropertiesToMerge.
 * It also removes falsy values after merging object properties.
 *
 * @param firstArray The original object-like array.
 * @param secondArray An object-like array to add to the firstArray.
 * @param keyProperty The object property that will be used to check if objects from different arrays are the same or not.
 * @param objectPropertiesToMerge The list of object properties that you want to merge. It all must be arrays.
 * @returns The updated original array.
 */
function merge(firstArray, secondArray, keyProperty, objectPropertiesToMerge) {

    function mergeObjectProperties(object, otherObject, objectPropertiesToMerge) {
        _.each(objectPropertiesToMerge, function (eachProperty) {
            object[eachProperty] = _.chain(object[eachProperty]).union(otherObject[eachProperty]).compact().value();
        });
    }

    if (firstArray.length === 0) {
        _.each(secondArray, function (each) {
            firstArray.push(each);
        });
    } else {
        _.each(secondArray, function (itemFromSecond) {
            var itemFromFirst = _.find(firstArray, function (item) {
                return item[keyProperty] === itemFromSecond[keyProperty];
            });

            if (itemFromFirst) {
                mergeObjectProperties(itemFromFirst, itemFromSecond, objectPropertiesToMerge);
            } else {
                firstArray.push(itemFromSecond);
            }
    });
    }

    return firstArray;
}

function session_id() {
    return /SESS\w*ID=([^;]+)/i.test(document.cookie) ? RegExp.$1 : false;
}

jQuery.fn.extend({ 
    disableSelection : function() { 
            return this.each(function() { 
                    this.onselectstart = function() { return false; }; 
                    this.unselectable = "on"; 
                    jQuery(this).css('user-select', 'none'); 
                    jQuery(this).css('-o-user-select', 'none'); 
                    jQuery(this).css('-moz-user-select', 'none'); 
                    jQuery(this).css('-khtml-user-select', 'none'); 
                    jQuery(this).css('-webkit-user-select', 'none'); 
            });
return this; 
    } 
});
