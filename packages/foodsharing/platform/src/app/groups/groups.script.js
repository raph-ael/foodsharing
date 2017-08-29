$(function(){
	var $groups = $('.groups .field');
	if($groups.length > 3)
	{
		$groups.children('.head').css({
			'cursor':'pointer',
			'margin-bottom':'10px'
		}).mouseover(function(){
			$(this).css('text-decoration','underline');
		}).mouseout(function(){
			$(this).css('text-decoration','none');
		}).click(function(){
			var $this = $(this);
			
			if(!$this.next('.ui-widget.ui-widget-content.corner-bottom').is(':visible'))
			{
				$groups.children('.ui-widget.ui-widget-content.corner-bottom').hide();
				
				$groups.children('.head').css({
					'margin-bottom':'10px'
				});
				
				$this.css({
					'margin-bottom':'0px'
				}).next('.ui-widget.ui-widget-content.corner-bottom').show();
			}
			else
			{
				$this.css('margin-bottom','10px');
				$groups.children('.ui-widget.ui-widget-content.corner-bottom').hide();
			}
			
		});
		
		$groups.children('.ui-widget.ui-widget-content.corner-bottom').hide();
	}
});