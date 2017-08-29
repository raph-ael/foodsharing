$(function(){
	var $form = $('#contactform-form');
	if($form.length > 0)
	{
		var $email = $('#email');
		
		$email.keyup(function(){
			var $el = $(this);
			if(checkEmail($el.val()))
			{
				$email.removeClass('input-error');
			}
		});
		
		$email.blur(function(){
			var $el = $(this);
			if( !checkEmail($el.val()) )
			{
				$email.addClass('input-error');
				pulseError('Mit Deiner E-Mail Adressse stimmt etwas nicht.');
			}
		});
		
		$form.submit(function(ev){
			ev.preventDefault();
			if(!checkEmail($email.val()))
			{
				$email.select();
				$email.addClass('input-error');
				pulseError('Bitte gib eine gültige E-Mail-Adresse ein damit wir Dir antworten können ;)');
			}
			else
			{
				ajax.req('team','contact',{
					data: $form.serialize(),
					method: 'post'
				});
			}
		});
	}
	
	$('#teamlist .foot i').mouseover(function(){
		
		var $this = $(this);
		
		var val = $this.children('span').text();
		if(val != '')
		{
			$this.parent().parent().attr('href',val).attr('target','_blank');
		}
	});
	
	$('#teamlist .foot i').click(function(ev){
		
		var $this = $(this);
		if($this.hasClass('fa-lock'))
		{
			ev.preventDefault();
			u_tox($this.children('span').text());
			
		}
		
		if($this.hasClass('fa-envelope'))
		{
			ev.preventDefault();
			goTo($this.parent().parent().attr('href'));
		}
	});
	
	
	$('#teamlist .foot i').mouseout(function(){
		var $this = $(this).parent().parent();
		
		$this.attr('href','/team/' + $this.attr('id').substring(2)).attr('target','_self');
		
	});
	
	
});


function u_tox(id)
{
	var $pop = $('#tox-pop-'+id+'-opener');
	
	$pop.magnificPopup({
		type:'inline'
	});
	
	var $qr = $('#tox-pop-'+id+' .tox-qr');
	
	if($qr.children().length == 0)
	{
		var $input = $('#tox-pop-'+id+' .tox-id');
		$('#tox-pop-'+id+' .tox-qr').qrcode($input.val());
		
		$input.bind('focus click',function(){
			$(this).select();
		});
	}
	
	$pop.trigger('click');
}