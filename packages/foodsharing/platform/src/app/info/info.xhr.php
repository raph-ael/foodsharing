<?php 
class InfoXhr extends Control
{
	private $info;
	private $check;
	
	/*
	 * important array 
	 */
	private $allowed;
	
	public function __construct()
	{
		$this->model = new InfoModel();
		$this->view = new InfoView();

		$this->info = array();
		$this->check = false;
		
		/*
		 * here we define all apps and methods which can be used by polling service syntax is => app:method
		 */
		$this->allowed = array(
			'msg:chat' => true,
			'msg:setSessionInfo' => true,
			'msg:heartbeat' => true
		);
		
		parent::__construct();
	}
	
	public function initbadge()
	{
		$xhr = new Xhr();
		
		$bell = (int)$this->model->qOne('SELECT COUNT(bell_id) FROM '.PREFIX.'foodsaver_has_bell WHERE foodsaver_id = '.(int)fsId().' AND seen = 0');
		
		// extra bells for betrieb
		if(isset($_SESSION['client']['verantwortlich']) && is_array($_SESSION['client']['verantwortlich']))
		{
			$ids = array();
			foreach ($_SESSION['client']['verantwortlich']as $v)
			{
				$ids[] = (int)$v['betrieb_id'];
			}
			if(!empty($ids))
			{
				$bell += (int)$this->model->qOne('SELECT COUNT( betrieb_id ) FROM fs_abholer a WHERE betrieb_id IN('.implode(',',$ids).') AND confirmed = 0 AND `date` > NOW() ');
			}
		}
		// get new Fair-Teiler badgecount only for region admin
		if(S::may('bot'))
		{
			if($count = $this->model->getFairteilerBadgdeCount())
			{
				$bell += $count;
			}
			
		}
		
		$xhr->addData('bell', $bell);
		$xhr->addData('msg', (int)$this->model->qOne('SELECT COUNT(conversation_id) FROM '.PREFIX.'foodsaver_has_conversation WHERE foodsaver_id = '.(int)fsId().' AND unread = 1'));
		$xhr->addData('basket',0);
		
		$xhr->send();
	}
	
	public function heartbeat()
	{
		$duration = array('start'=>microtime());
		
		/*
		 * check for additional polling services
		 */
		$services = array(
			'fast' => array(),
			'slow' => array()
		);
		
		// init ajax instance
		$xhr = new Xhr();
		
		$apps = array();
		
		if(isset($_GET['s']) && is_array($_GET['s']))
		{
			foreach ($_GET['s'] as $s)
			{
				// check is the service allowed?
				if(isset($this->allowed[$s['a'].':'.$s['m']]))
				{
					
					if(!isset($services[$s['a']]))
					{
						$services[$s['a']] = array();
					}
					
					$speed = 'slow';
					
					if(isset($s['o']['speed']) && isset($services[$speed]))
					{
						$speed = $s['o']['speed'];
					}
					
					$services[$speed][$s['a']][$s['m']] = $s['o'];
					
					if(!isset($apps[$s['a']]))
					{
						$apps[$s['a']] = loadXhr($s['a']);
					}
					// check is the a method defined to execute before polling?
					if(isset($s['o']['premethod']) && isset($this->allowed[$s['a'].':'.$s['o']['premethod']]))
					{
						/*
						 * PHP is crazy :o)
						 */
						$apps[$s['a']]->$s['o']['premethod']($s['o']);
					}
				}
			}
		}
		else
		{
			S::set('activechats', array());
		}
		
		if(isset($_GET['c']) && $_GET['c'] == 0)
		{
			$this->updateChecker();
			/*
			 * if there are any updates $check will be true and we can send the request
			*/
			if($this->check)
			{
				$xhr->addData('info', $this->info);
				$xhr->send();
			}
		}
		/*
		 * 200 OK
Array
(
    [app] => info
    [m] => heartbeat
    [c] => 0
    [s] => Array
        (
            [0] => Array
                (
                    [a] => msg
                    [m] => chat
                    [o] => Array
                        (
                            [speed] => fast
                            [premethod] => setSessionInfo
                            [ids] => Array
                                (
                                    [0] => 1
                                )

                            [infos] => Array
                                (
                                    [0] => Array
                                        (
                                            [id] => 1
                                        )

                                )

                        )

                )

        )
		 */
		// no session writing for no socket blocking
		S::noWrite();
		
		// kepp connection fpr 120 seconds
		$xhr->keepAlive(300);
		
		/*
		 * check if its the first heartbeat give me direct an output
		 */
		
		if(isset($_GET['c']) && (int)$_GET['c'] == 0)
		{
			$this->updateChecker();
			if($this->check)
			{
				$xhr->addData('info', $this->info);
				$xhr->addData('user', array(
					'id' => fsId()
				));
				$xhr->send();
			}
		}
		
		
		$duration['start'] = microtime() - $duration['start'];
		
		for ($i=0;$i<6;$i++)
		{
			/*
			 * fast polling calls
			 */
			if(!empty($services['fast']))
			{
				for ($y=0;$y<20;$y++)
				{
					foreach ($services['fast'] as $app => $methods)
					{
						$duration['call'] = microtime();
						foreach ($methods as $method => $options)
						{
							if($ret = $apps[$app]->$method($options))
							{
								$duration['call'] = microtime() - $duration['call'];
								
								$ret['data']['_duration'] = $duration;
								
								$xhr->addData($app.'_'.$method, $ret['data']);
								$xhr->addScript($ret['script']);
								$xhr->send();
							}
						}
					}
					sleep(1);
					//usleep(500000);
				}
			}
			else
			{
				sleep(10);
			}
			/*
			 * slow polling services
			 */
			foreach ($services['slow'] as $app => $methods)
			{
				foreach ($methods as $method => $options)
				{
					if($ret = $apps[$app]->$method($options))
					{
						$xhr->addData($app.'_'.$method, $ret['data']);
						$xhr->addScript($ret['script']);
						$xhr->send();
					}
				}
			}
			
			$this->updateChecker();
				
			/*
			 * if there are any updates $check will be true and we can send the request
			*/
			if($this->check)
			{
				$xhr->addData('info', $this->info);
				$xhr->send();
			}
		}
		
		// nothing arrived just exit
		$xhr->setStatus(0);
		$xhr->send();
	}
	
	private function updateChecker()
	{
		/*
		 * check for conversation updates only ifnot on big message page
		*/
		
		if((!isset($_GET['p']) || $_GET['p'] !='msg') && ($conv_ids = $this->model->checkConversationUpdates()))
		{
			$this->check = true;
			
			$this->info[] = array(
					'type' => 'msg',
					'data' => array('ids' => $conv_ids),
					'badge' => count($conv_ids)
			);
		}
		
		if($bell_ids = $this->model->checkBellUpdates())
		{
			$this->check = true;
		
			$this->info[] = array(
				'type' => 'bell',
				'data' => array('ids' => $bell_ids),
				'badge' => count($bell_ids)
			);
		}
	}
}