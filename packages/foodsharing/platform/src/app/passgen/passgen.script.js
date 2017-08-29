$(document).ready(function(){
	
	var verify_fid = 0;
	var verify_el = null;
	$('#verifyconfirm-dialog').dialog({
		autoOpen : false,
		modal:true,
		buttons : [
		    {
		    	text : $('#verifyconfirm-dialog .button_confirm').text(),
		    	click :function(){
		    		showLoader();
		    		$.ajax({
		    			url: 'xhr/?f=verify&fid=' + verify_fid +'&v=1',
		    			dataType : 'json',
		    			success: function(data){
		    				verify_el.removeClass('verify-n');
		    				verify_el.addClass('verify-y');
		    			},
		    			complete:function(){
		    				hideLoader();
		    				$('#verifyconfirm-dialog').dialog('close');
		    			}
		    		});
		    	}
		    },
		    {
		    	text : $('#verifyconfirm-dialog .button_abort').text(),
		    	click : function(){
		    		$('#verifyconfirm-dialog').dialog('close');
		    	}
		    }
		]
	});
	$('#unverifyconfirm-dialog').dialog({
		autoOpen : false,
		modal:true,
		buttons : [
		    {
		    	text : $('#unverifyconfirm-dialog .button_confirm').text(),
		    	click :function(){
		    		showLoader();
		    		window.location.href = '/profile/'+ verify_fid;
		    	}
		    },
		    {
		    	text : $('#unverifyconfirm-dialog .button_abort').text(),
		    	click : function(){
		    		$('#unverifyconfirm-dialog').dialog('close');
		    	}
		    }
		]
	});
	
	$(".checker").click(function(el){
		var $this = $(this);
		if( $this[0].checked )
		{
			$("input.checkbox.bezirk" + $this.attr('value')).prop("checked", true);
		}
		else
		{
			$("input.checkbox.bezirk" + $this.attr('value')).prop("checked", false);
		}	
	});
	
	
	$('.verify').click(function(){
		var $this = $(this);
		
		verify_el = $this;
		verify_fid = $this.parent().parent().children('td:first').children('input').val();
		
		if($this.hasClass('verify-n'))
		{
			$('#verifyconfirm-dialog').dialog('open');
		}
		else
		{
			showLoader();
			$.ajax({
				url: 'xhr/?f=verify&fid=' + $this.parent().parent().children('td:first').children('input').val()+'&v=0',
				dataType : 'json',
				success: function(data){
				if(data.status == "0"){
                	if($this.hasClass('verify-y'))
					{
						$('#unverifyconfirm-dialog').dialog('open');
					}      
               	}
                else
                {
                    $this.removeClass('verify-y');
					$this.addClass('verify-n');
                }

					
				},
				complete:function(){
					hideLoader();
				}
			});
		}
		
		return false;
	});
	$('a.fsname').click(function(){
		$this = $(this);
		if($("input[value='"+$this.next().val()+"']")[0].checked)
		{
			$("input[value='"+$this.next().val()+"']").prop('checked',false);
		}
		else
		{
			$("input[value='"+$this.next().val()+"']").prop('checked',true);
		}
		return false;
	});
	$("a[href='#start']").click(function(){
		$('form#generate').submit();
		return false;
	});
	$('a.dateclick').click(function(){
		var $this = $(this);
		dstr = $this.next().val();
		if($("input.date" + dstr)[0].checked)
		{
			$("input.date" + dstr).prop("checked", false);
		}
		else
		{
			$("input.date" + dstr).prop("checked", true);
		}
		return false;
	});
});