<?php
class DashboardView extends View
{
	public function newBaskets($baskets)
	{
		$out = '<ul class="linklist baskets">';
		foreach ($baskets as $b)
		{
			$out .= '
			<li>
				<a onclick="ajreq(\'bubble\',{app:\'basket\',id:'.(int)$b['id'].'});return false;" href="#" class="corner-all">
					<span class="i">'.$this->img($b).'</span>
					<span class="n">Essenskorb von '.$b['fs_name'].'</span>
					<span class="t">veröffentlicht am '.niceDate($b['time_ts']).'</span>
					<span class="d">'.$b['description'].'</span>
					<span class="c"></span>
				</a>
	
			</li>';
		}
	
	
		$out .= '
				</ul>';
	
		return v_field($out,s('new_foodbaskets'));
	}
	
	public function updates()
	{
		addStyle('
		#activity ul.linklist li span.time{margin-left:58px;display:block;margin-top:10px;}
		
		#activity ul.linklist li span.qr
		{
			margin-left:58px;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			opacity:0.5;
		}
		
		#activity ul.linklist li span.qr:hover
		{
			opacity:1;
		}
		
		#activity ul.linklist li span.qr img
		{
			height:32px;
			width:32px;
			margin-right:-35px;
			border-right:1px solid #ffffff;
			-webkit-border-top-left-radius: 3px;
			-webkit-border-bottom-left-radius: 3px;
			-moz-border-radius-topleft: 3px;
			-moz-border-radius-bottomleft: 3px;
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}
		#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
		{
			border: 0 none;
		    height: 16px;
		    margin-left: 36px;
		    padding: 8px;
		    width: 78.6%;
			-webkit-border-top-right-radius: 3px;
			-webkit-border-bottom-right-radius: 3px;
			-moz-border-radius-topright: 3px;
			-moz-border-radius-bottomright: 3px;
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
			margin-right:-30px;
			background-color:#F9F9F9;
		}
		
		#activity ul.linklist li span.qr .loader
		{
			background-color: #ffffff;
		    position: relative;
		    text-align: left;
		    top: -10px;
		}
		
		#activity ul.linklist li span.t span.txt {
		    overflow: hidden;
		    text-overflow: unset;
    		white-space: normal;
			padding-left:10px;
			border-left:2px solid #4A3520;
			margin-bottom:10px;
			display:block;
		}
		#activity ul.linklist li span
		{
			color:#4A3520;
		}
		#activity ul.linklist li span a
		{
			color:#46891b !important;
		}
		#activity span.n i.fa
		{
			display:inline-block;
			width:11px;
			text-align:center;
		}
		#activity span.n small
		{
			float:right;
			opacity:0.8;
			font-size:12px;
		}
		#activity ul.linklist li span a:hover
		{
			text-decoration:underline !important;
			color:#46891b !important;
		}
		
		#activity ul.linklist li
		{
			margin-bottom:10px;
			background-color:#ffffff;
			padding:10px;
			-webkit-border-radius: 6px;
			-moz-border-radius: 6px;
			border-radius: 6px;
		}
		
		ul.linklist li span.n
		{
			font-weight:normal;
			font-size:13px;
			margin-bottom:10px;
			text-overflow: unset;
    		white-space: inherit;
		}
		
		@media (max-width: 900px)
		{
			#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
			{
				width:74.6%;
			}
		}
		@media (max-width: 400px)
		{
			ul.linklist li span.n
			{
				height:55px;
			}
			#activity ul.linklist li span.qr textarea, #activity ul.linklist li span.qr .loader
			{
				width:82%;
			}
			#activity ul.linklist li span.time, #activity ul.linklist li span.qr
			{
				margin-left:0px;
			}
			#activity span.n small
			{
				float:none;
				display:block;
			}
		}
	');
		addScript('/js/jquery.tinysort.min.js');
		addScript('/js/activity.js');
		addJs('activity.init();');
		addContent('
	<div class="head ui-widget-header ui-corner-top">
		Updates-Übersicht<span class="option"><a id="activity-option" href="#activity-listings" class="fa fa-gear"></a></span>
	</div>
	<div id="activity">
		<div class="loader" style="padding:40px;background-image:url(/img/469.gif);background-repeat:no-repeat;background-position:center;"></div>
		<div style="display:none" id="activity-info">'.v_info('Es gibt gerade nichts Neues').'</div>
	</div>');
		
	}
	
	public function foodsharerMenu()
	{
		return $this->menu(array(
			array('name'=> s('new_basket'),'click' => "ajreq('newbasket',{app:'basket'});return false;"),
			array('name' => s('all_baskets'),'href'=> '/karte?load=baskets')
		));
	}
	
	public function closeBaskets($baskets)
	{
		$out = '<ul class="linklist baskets">';
		foreach ($baskets as $b)
		{
			$out .= '
			<li>
				<a onclick="ajreq(\'bubble\',{app:\'basket\',id:'.(int)$b['id'].'});return false;" href="#" class="corner-all">
					<span class="i">'.$this->img($b).'</span>
					<span class="n">Essenskorb von '.$b['fs_name'].' ('.$this->distance($b['distance']).')</span>
					<span class="t">'.niceDate($b['time_ts']).'</span>
					<span class="d">'.$b['description'].'</span>
					<span class="c"></span>
				</a>
	
			</li>';
		}
	
	
		$out .= '
				</ul>';
	
		return v_field($out,s('close_foodbaskets'));
	}
	
	private function img($basket)
	{
		if($basket['picture'] != '' && file_exists(ROOT_DIR . 'images/basket/50x50-'.$basket['picture']))
		{
			return '<img src="/images/basket/thumb-'.$basket['picture'].'" height="50" />';
		}
		return '<img src="/img/basket50x50.png" height="50" />';
	}

	function becomeFoodsaver()
	{
		return '
	   <div class="msg-inside info">
			   <i class="fa fa-info-circle"></i> <strong><a href="/?page=settings&sub=upgrade/up_fs">Möchtest Du auch Lebensmittel bei Betrieben retten und fair-teilen?<br />Werde Foodsaver!</a></strong>
	   </div>';
	}
}
