<?php

class XhrDialogConsole extends XhrDialog
{
	private $app;
	
	public function __construct($app, $title = false)
	{
		parent::__construct($title);
		
		$this->app = $app;
		
		$this->addOpt('width', 440,false);
		$this->setResizeable(false);
		
		$this->addContent('<div style="width:400px;height:180px;background-color:#000000;color:#6AFF38;overflow:auto;padding:6px 6px 16px 6px;font-family:monospace, prestige;" class="console"></div>');
		
		$this->onOpen('$("#'.$this->getId().' .console").html("");');
		$this->onClose('u_item_i = u_items.length+1;');
		$this->addAbortButton();
		$this->addJs('
				
			$("#'.$this->getId().' .console").attr("unselectable","on")
		     .css({"cursor":"default",
				   "-moz-user-select":"-moz-none",
		           "-moz-user-select":"none",
		           "-o-user-select":"none",
		           "-khtml-user-select":"none", 
		           "-webkit-user-select":"none",
		           "-ms-user-select":"none",
		           "user-select":"none"
		     }).bind("selectstart", function(){ return false; });
				
			function u_logConsole(msg,stat)
				{
					var $box = $("#'.$this->getId().' .console");
					$box.append(\'<div class="line"># \'+msg+\' <span class="stat"></span> <span style="float:right" class="status"></status></div>\');	
					if(stat != undefined)
					{
						u_updateStat(stat);
					}
					var height = $box.get(0).scrollHeight;
					$box.scrollTop(height);
				}
					
				function u_updateStat(stat,color)
				{
					if(stat == 1)
					{
						color = "#6AFF38";
						stat = "OK";
					}
					else if(stat == 0)
					{
						color = "#FFD738";
						stat = "wait...";
					}
					else if(stat == -1)
					{
						color = "red";
						stat = "ERROR";
					}
					if(color != undefined)
					{
						$("#'.$this->getId().' .console .line:last .status").css("color",color);	
					}
					
					stat = "["+stat+"]";
					$("#'.$this->getId().' .console .line:last .status").html(stat);	
				}		
		');
	}
	
	public function xhrLoop($items,$options = array())
	{
		$default = array(
			'action' => 'calc',
			'app' => $this->app,
			'timeout' => '10',
			'tries' => '3'
		);
		$options = array_merge($default,$options);
		
		if(!isset($options['url']))
		{
			$options['url'] = '/xhrapp/?app='.$options['app'].'&m='.$options['action'];
		}
		
		$params = array();
		if(isset($options['params']))
		{
			foreach ($options['params'] as $p)
			{
				$params[] = $p.':u_items[u_item_i].'.$p;
			}
		}
		
		$logmsg = '"';
		$lorparams = array();
		if(isset($options['logPrefix']))
		{
			$logmsg .= $options['logPrefix'].' ';
		}
		if(isset($options['logParams']))
		{
			
			foreach ($options['logParams'] as $lp)
			{
				$lorparams[] = 'item.'.$lp;
			}
		}
		$logmsg .= '"';
		if(!empty($lorparams))
		{
			$logmsg .= ' + '.implode('+" "+', $lorparams);
		}

		$this->addJs('
		
				var u_items = '.json_encode($items).';
				var u_item_i = 0;
				var u_item_xhr = false;
				var u_timeout = false;
				var u_error = [];
			
				u_calcItem();
				
				function u_calcItem()
				{
					if(u_error[u_item_i] == undefined)
					{
						u_error[u_item_i] = 1;
					}
					else if(u_error[u_item_i] < '.(int)$options['tries'].')
					{
						u_error[u_item_i]++;
					}
					else
					{
						u_logConsole("3 Fehler, ich mach weiter im Text...");
						u_item_i++;
					}
					if(u_items[u_item_i] != undefined)
					{
						var item = u_items[u_item_i];
		
						u_logConsole('.$logmsg.' ,0);
		
						u_item_xhr = u_startRequest();
						u_timeout = setTimeout(function(){
							u_item_xhr.abort();
							u_updateStat(-1);
							u_logConsole("lets retry");
							u_calcItem();
						},'.((int)$options['timeout']*1000).');
					}
					else
					{
						u_logConsole("ready ;)",1);
					}
				}
				
				function u_startRequest()
				{
					return $.ajax({
						url: "'.$options['url'].'",
						data: {'.implode(',', $params).'},
						dataType: "json",
						success: function(data){
							if(u_timeout != false)
							{
								clearTimeout(u_timeout);
								u_timeout = false;
							}
							u_item_i++;
							u_updateStat(1);
							u_calcItem();
						}
					});
				}
			
			');
	}
	
}