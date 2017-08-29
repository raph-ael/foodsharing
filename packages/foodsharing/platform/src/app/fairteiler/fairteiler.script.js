$(function(){
	$("#wall-submit").bind('mousedown',function(){
		$("#ft-public-link").trigger('click');
	});
});

function u_wallpostReady(postid)
{
	ajreq('infofollower',{fid:$("#ft-id").val(),pid:postid});	
}
