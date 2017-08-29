<?php
class IndexView extends View
{
	public function index($first_content, $gerettet)
	{
		$ps = new vPageslider();

		$ps->addSection($first_content,array(
			'color' => '#4A3520',
			'anchor' => 'home'
		));
		
		$ps->addSection($this->countNumber(),array(
			'color' => '#ffffff',
			'anchor' => 'gerettet',
			'onload' => '$("#stat-count-number").animateNumber({ number: '.(int)$gerettet.',numberStep:$.animateNumber.numberStepFactories.separator(".") });',
			'onleave' => '$("#stat-count-number").animateNumber({ number: 0});'
		));
		
		$ps->addSection($this->howto(),array(
			'anchor' => 'howto'
		));
		
		$ps->addSection($this->map(),array(
			'anchor' => 'map',
			'color' => '#ffffff',
			'onload' => 'indexmap.init();',
			'wrapper' => false
		));
		
		
		
		$ps->addSection($this->machMit(),array(
			'anchor' => 'mach-mit'
		));
		
		return $ps->render();
	}
	
	private function map()
	{
		return '<div id="indexmap_mapview" style="width:100%;height:100%;"></div>';
	}
	
	private function machMit()
	{
		return '
		<div class="pure-g">
		    <div class="pure-u-1 pure-u-md-1-1">
				<div class="inside">
					<div style="text-align:center;">
						<h3>Mach mit!</h3>
						<p><a class="button" href="#" onclick="ajreq(\'join\',{app:\'login\'});return false;">Registrieren</a> <a class="button" href="/login">Login</a></p>
					</div>
				</div>	
			</div>
		</div>
		';
	}
	
	private function howto()
	{
		addJs('$(".vidlink").click(function(ev){
			ev.preventDefault();
			$vid = $(this);
			$vid.parent().html(\'<iframe width="420" height="315" src="\'+$vid.attr(\'href\')+\'" frameborder="0" allowfullscreen></iframe>\');
		});');
		return '
		<div class="howto">
			<div class="pure-g">
			    <div class="pure-u-1 pure-u-md-1-2">
					<div class="inside">
						<h3>Wie funktioniert&#39;s?</h3>
						<p>Was ist Foodsharing und wie funktioniert es?</p>
						<p>Was steckt hinter der Organisation und wie kannst Du Dich dort einbringen?</p>
						<p>Diese und weitere Fragen beantworten wir in diesem Video.</p>
					</div>
				</div>
			    <div class="pure-u-1 pure-u-md-1-2">
					<div class="inside">
						<a class="vidlink" href="https://www.youtube.com/embed/dqsVjuK3rTc?autoplay=1"><img class="corner-all" src="/img/howto.jpg" /></a>
					</div>
				</div>
			</div>
		</div>';
	}
	
	private function countNumber()
	{
		return '
		<div class="countnumber">
			<p>Schon</p>
			<p class="number"><span id="stat-count-number">0</span><span style="white-space:nowrap">&thinsp;</span>kg</p>
			<p>gerettet!</p>
		</div>';
	}
}
