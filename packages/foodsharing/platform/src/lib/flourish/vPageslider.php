<?php
class vPageslider
{
	private $sections;
	private $id;
	private $defaultBgColor;
	
	static $pageslider_count = 0;
	
	public function __construct()
	{
		$this->sections = array();
		$this->defaultBgColor ='#F1E7C9';
		
		$this->id = 'fullpage-' . vPageslider::$pageslider_count;
		vPageslider::$pageslider_count++;
		
		addScript('/js/jquery.fullPage.min.js');
		addCss('/css/jquery.fullPage.css');
	}
	
	public function addSection($html,$option = array())
	{
		$this->sections[] = array(
			'html' => $html,
			'option' => $option
		);
	}
	
	public function render()
	{
		
		
		
		$out = '';
		
		$colors = array();
		$anchors = array();
		$tooltips = array();
		$afterloadjs = '';
		$onleafejs = '';
		
		foreach ($this->sections as $i => $s)
		{
			if(isset($s['option']['onload']))
			{
				$afterloadjs .= '
				if(index == '.($i+1).')
				{
					'.$s['option']['onload'].'		
				}';
			}
			if(isset($s['option']['onleave']))
			{
				$onleafejs .= '
				if(index == '.($i+1).')
				{
					'.$s['option']['onleave'].'
				}';
			}
			if(isset($s['option']['color']))
			{
				$colors[] = '"'.$s['option']['color'].'"';
			}
			else
			{
				$colors[] = '"'.$this->defaultBgColor.'"';
			}
			
			if(isset($s['option']['tooltip']))
			{
				$tooltips[] = '"'.$s['option']['tooltip'].'"';
			}
			else
			{
				$tooltips[] = '""';
			}
			
			if(isset($s['option']['anchor']))
			{
				$anchors[] = '"'.$s['option']['anchor'].'"';
			}
			else
			{
				$anchors[] = '"anchor-'.$i.'"';
			}
			
			if(!isset($s['option']['wrapper']) || $s['option']['wrapper'] === true)
			{
				$s['html'] = '<div class="inner">' . $s['html'] . '</div>';
			}
				
			$out .= '
			<div style="visibility:hidden;" class="section " id="section'.$i.'">
				'.$s['html'].'
			</div>';
		}
		
		addJs('
		$("footer").hide();
		$("#'.$this->id.'").fullpage({
			anchors: ['.implode(',',$anchors).'],
			sectionsColor: ['.implode(',',$colors).'],
			navigation: true,
			navigationPosition: "right",
			navigationTooltips: ['.implode(',',$tooltips).'],
			responsive: 900,
			onLeave: function(index){
				'.$onleafejs.'
			},
			afterLoad: function(anchorLink, index){
					
				'.$afterloadjs.'
					
				if(index == '.(int)count($this->sections).')
				{
					$("#'.$this->id.' footer").show();
				}
				else
				{
					$("#'.$this->id.' footer").hide();	
				}
			}
		});
		$("#'.$this->id.' .section").css("visibility","visible");
		$footer = $("footer");
		if($footer.length > 0)
		{
			$("#'.$this->id.' .section:last .fp-tableCell:last").append(\'<footer style="display:none;bottom:0px;width:100%;position:absolute;" class="footer">\'+$footer.html()+\'</footer>\');
			$footer.remove();
		}
		');
		
		return '
		<div id="'.$this->id.'">
			'.$out.'
		</div>';
	}
}