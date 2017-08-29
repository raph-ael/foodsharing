function u_toggleStat()
{
	
}

$(document).ready(function(){
	
	$("a[href='#signout']").click(function(){
		
		$('#signout_shure').dialog('open');
		return false;
	});
	
	$(".bt_answer").click(function(el){
		post_id = parseInt($(this).attr("href").replace('#p',''));
		
		$(".normal").show();
		$(".answer").hide();
		
		$(".normal" + post_id).hide();
		$(".answer" + post_id).show();
		
		$(".answer" + post_id + " textarea")[0].focus();
		
		return false;
		
	});
	var clicked_pid = null;
	$('.bt_delete').click(function(el){
		
		clicked_pid = parseInt($(this).attr("href").replace('#p',''));
		$('#delete_shure').dialog('open');
		
	});
	
	$('#signout_shure').dialog({
		autoOpen:false,
		modal:true,
		buttons :[
			{
				text: $('#signout_shure .sure').text(),
				click:function(){
					ajax.req('bezirk', 'signout', {
						data: $('input', this).serialize(),
						success:function(){
							goTo('/?page=relogin&url='+encodeURIComponent('/dashboard'));
						}
					});
				}
			},
			{
				text: $('#signout_shure .abort').text(),
				click: function(){
					$(this).dialog('close');
				}
			}
		]
	});
	
	$('#delete_shure').dialog({
		autoOpen:false,
		modal:true,
		buttons :[
		    {
		    	text: $('#delete_shure .sure').text(),
		    	click:function(){
		    		showLoader();
		    		$.ajax({
		    			url:'xhr/?f=delPost',
		    			data:{'pid':clicked_pid},
		    			success:function(ret){
		    				if(ret == 1)
		    				{
		    					$('#tpost-' + clicked_pid).remove();
		    					if($('.post').length == 0)
		    					{
		    						reload();
		    					}
		    					else
		    					{
		    						$('#delete_shure').dialog('close');
		    					}
		    					
		    				}
		    			},
		    			complete:function(){
		    				hideLoader();
		    			}
		    		});
		    	}
		    },
		    {
		    	text: $('#delete_shure .abort').text(),
		    	click: function(){
		    		$('#delete_shure').dialog('close');
		    	}
		    }
		]
	});
	

});