<?php
class MapView extends View
{
	public function lMap()
	{
		addHidden('
			<div id="b_content" class="loading">
				<div class="inner">
					'.v_input_wrapper(s('status'), 'Betrieb spendet','bcntstatus').'
					'.v_input_wrapper('Verantwortliche Foodsaver', '...','bcntverantwortlich').'
					'.v_input_wrapper(s('specials'), '...','bcntspecial').'
				</div>
				<input type="hidden" class="fetchbtn" name="fetchbtn" value="'.s('want_to_fetch').'" />
			</div>
		');
		
		return '<div id="map"></div>';
	}
	
	public function mapControl()
	{
		
		$foodsaver = '';
		$betriebe = '';
		$botschafter = '';
		$additional = '';
		
		if(S::may('fs'))
		{
			$foodsaver = '<li><a name="foodsaver" class="ui-corner-all foodsaver"><span class="icon orange"><i class="img img-smile"></i></span><span>Foodsaver</span></a></li>';
			$betriebe = '<li><a name="betriebe" class="ui-corner-all betriebe"><span class="icon brown"><i class="img img-store"></i></span><span>Betriebe</span></a>
				<div id="map-options">
					<label><input type="checkbox" name="viewopt[]" value="allebetriebe" /> Alle Betriebe</label>
					<label><input checked="checked" type="checkbox" name="viewopt[]" value="needhelp" /> HelferInnen gesucht</label>
					<label><input checked="checked" type="checkbox" name="viewopt[]" value="needhelpinstant" /> HelferInnen dringend gesucht</label>
					<label><input type="checkbox" name="viewopt" value="nkoorp" /> in Verhandlung</label>
				</div>
			</li>';
			$botschafter = '<li><a name="botschafter" class="ui-corner-all botschafter"><span class="icon red"><i class="img img-smile"></i></span><span>Botschafter</span></a></li>';
		}
		
		return '
			<div id="map-control-wrapper">
				<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front" tabindex="-1">
					<div class="ui-dialog-content ui-widget-content">
						<div id="map-control">
							<ul class="linklist">
								<li><a name="baskets" class="ui-corner-all baskets"><span class="icon green"><i class="img img-basket"></i></span><span>Essenskörbe</span></a></li>
								'.$foodsaver.'
								'.$botschafter.'
								'.$betriebe.'
								
								<li><a name="fairteiler" class="ui-corner-all fairteiler"><span class="icon yellow"><i class="img img-recycle"></i></span><span>Fair-Teiler</span></a></li>
							</ul>	
						</div>	
					</div>
				</div>

			</div>';
	}
}
