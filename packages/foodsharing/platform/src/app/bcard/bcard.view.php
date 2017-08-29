<?php
class BcardView extends View
{
	
	public function top()
	{
		return $this->topbar('Deine foodsharing Visitenkarte','hier easy generieren, ausdrucken und ausschneiden...','<img src="/img/bcard.png" />');
	}
	
	public function optionform($seldata)
	{
		addJs('
			$("#optionen-form .input-wrapper:last").hide();
			
			$("#opt").change(function(){
				$("#optionen-form").submit();
			});
				
			$("#optionen-form").submit(function(ev){
				ev.preventDefault();
				if($("#opt").val() == "")
				{
					pulseError(\''.jsSafe(s('should_choose_option')).'\');
				}
				else
				{
					ajreq("makeCard",{opt:$("#opt").val()});
				}
				
			});		
		');
		return v_quickform(s('options'), array(
			v_form_select('opt',array('desc'=>s('opt_desc'),'values' => $seldata))
		),array('submit'=>'Visitenkarten erstellen')).'
				
		<div class="input-wrapper" id="dlbox" style="display:none;">
			<a href="#" target="_blank" class="button">'.s('download_card').'</a>		
		</div>';
	}
}