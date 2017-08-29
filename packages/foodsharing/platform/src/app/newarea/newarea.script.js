function deleteMarked()
{
	
	ajreq('deleteMarked',{
		del:u_getChecked()
	});
	$('.wantnewcheck:checked').parent().parent().remove();
}

function u_getChecked()
{
	del = '';
	$('.wantnewcheck:checked').each(function(){
		del += '-'+$(this).val();
	});
	return del.substring(1);
}

$(function(){
	$('#orderFs').click(function(ev){
		ev.preventDefault();
		bid = parseInt($('#order_bezirk').val());
		ajreq('orderFs',{
			fs: u_getChecked(),
			bid: bid,
			msg: $('#order_msg').val(),
			subject: $('#subject').val()
		});
	});
});