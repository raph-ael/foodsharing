<?php
class ProfileView extends View
{
	private $foodsaver;
	
	public function profile($wallposts,$userCompanies = null, $userCompaniesCount = null, $fetchDates = null)
	{
		$page = new vPage($this->foodsaver['name'], $this->infos());
		$page->addSection($wallposts,'Status-Updates von ' . $this->foodsaver['name']);

		if(fsId() != $this->foodsaver['id'])
		{
			addStyle('#wallposts .tools{display:none;}');
		}
		
		if($fetchDates)
		{
			$page->addSection($this->fetchDates($fetchDates),'Nächste Abholtermine');
		}
		
		$page->addSectionLeft($this->photo());
		
		$page->addSectionLeft($this->sideInfos(),'Infos');

		$fsModel = loadModel('foodsaver');
 		$bids = $fsModel->getFsBezirkIds($this->foodsaver['id']);

		if((isOrgaTeam() || isBotForA($bids,false,true)) && $userCompanies)
		{
			$page->addSectionLeft($this->sideInfosCompanies($userCompanies),'Betriebe ('.$userCompaniesCount.')');
		}
		$page->render();
	}
	
	private function fetchDates($fetchDates)
	{
			
			$out ='
				<div class="ui-padding" id="double">
				<a class="button button-big" href="#"onclick="ajreq(\'deleteFromSlot\',{app:\'profile\',fsid:'.$this->foodsaver['id'].',bid:0,date:0});return false;">Aus allen austragen</a>
					<ul class="datelist linklist" id="double">';
				foreach ($fetchDates as $d)
				{
 					$out .= '
						<li>
							<a href="/?page=fsbetrieb&id='.$d['betrieb_id'].'" class="ui-corner-all">
								<span class="title">'.niceDate($d['date_ts']).'</span>
							</a>
						</li>
						<li>
							<a href="/?page=fsbetrieb&id='.$d['betrieb_id'].'" class="ui-corner-all">
								<span class="title">'.$d['betrieb_name'].'</span>
							</a>
						</li>';

						if(isOrgateam() || isBotFor($d['bezirk_id']))
						{
							$out .= '<li>
							<a class="button button-big" href="#"onclick="ajreq(\'deleteFromSlot\',{app:\'profile\',fsid:'.$this->foodsaver['id'].',deleteAll:false,bid:'.$d['betrieb_id'].',date:'.$d['date_ts'].'});return false;">austragen</a>
							</li>';
						}
						else
						{
							$out .= '<li>
							<a class="button button-big disabled" disabled=disabled href="#">austragen</a>
							</li>';
						}
						
					
				}
				$out .= '
					</ul>
				</div>';

			return $out;
	}

	private function sideInfosCompanies($userCompanies)
	{
		$out = '';
		foreach ($userCompanies as $b)
		{
			
			$out .= '<p><a class="light" href="/?page=fsbetrieb&id='.$b['id'].'">'.$b['name'].'</a></p>';
		}

		return '
		<div class="pure-g">
		    <div class="infos"> '.$out.' </div>
		</div>';
	}

	public function usernotes($notes,$userCompanies, $userCompaniesCount)
	{
		$page = new vPage($this->foodsaver['name'].' Notizen', v_info(s('user_notes_info')) . $notes);
		$page->setBread('Notizen');

		$page->addSectionLeft($this->photo());
		$page->addSectionLeft($this->sideInfos(),'Infos');

		if(S::may('orga'))
		{
			$page->addSectionLeft($this->sideInfosCompanies($userCompanies),'Betriebe ('.$userCompaniesCount.')');
		}
	
		$page->render();
	}
	
	private function sideInfos()
	{
		$infos = array();
		
		if(S::may('orga'))
		{
			$last_login = new fDate($this->foodsaver['last_login']);
			$registration_date = new fDate($this->foodsaver['anmeldedatum']);
			
			$infos[] = array(
					'name' => s('last_login'),
					'val' => $last_login->format('d.m.Y')
			);
			$infos[] = array(
					'name' => s('registration_date'),
					'val' => $registration_date->format('d.m.Y')
			);
			$infos[] = array(
					'name' => s('private_mail'),
					'val' => '<a href="/?page=mailbox&mailto='.urlencode($this->foodsaver['email']).'">'.$this->foodsaver['email'].'</a>'
			);
			if(isset($this->foodsaver['mailbox']))
			{
				$infos[] = array(
						'name' => s('mailbox'),
						'val' => '<a href="/?page=mailbox&mailto='.urlencode($this->foodsaver['mailbox']).'">'.$this->foodsaver['mailbox'].'</a>'
				);
			}
		}
		
		if($this->foodsaver['stat_buddycount'] > 0)
		{
			$infos[] = array(
					'name' => 'Bekannte',
					'val' => $this->foodsaver['name'].' kennen '.$this->foodsaver['stat_buddycount'].' Foodsaver'
			);
		}
		
		$out = '';
		foreach ($infos as $key => $info)
		{
			$out .= '<p><strong>'.$info['name'].'</strong><br />'.$info['val'].'</p>';
		
		}
			
		return '
		<div class="pure-g">
		    <div class="infos"> '.$out.' </div>
		</div>';
	}


	
	public function infos()
	{
		$infos = array();		
		
		if($this->foodsaver['botschafter'])
		{
				
			foreach ($this->foodsaver['botschafter'] as $b)
			{
				$bot[$b['id']] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
			}
			$infos[] = array(
				'name' => $this->foodsaver['name'].' ist Botschafter für',
				'val' => implode(', ', $bot)
			);
		}
		
		
		if($this->foodsaver['foodsaver'])
		{
			$fsa = array();
			foreach ($this->foodsaver['foodsaver'] as $b)
			{
				if(!isset($bot[$b['id']]))
				{
					$fsa[] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
				}
			}
			if(!empty($fsa))
			{
				$infos[] = array(
						'name' => $this->foodsaver['name'].' ist Foodsaver für',
						'val' => implode(', ', $fsa)
				);
			}
		}
		
		if($this->foodsaver['orga'])
		{
			$bot = array();
			foreach ($this->foodsaver['orga'] as $b)
			{
				if(isOrgateam())
				{
					$bot[$b['id']] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
				}
				else
				{
					$bot[$b['id']] = $b['name'];
				}
			}
			$infos[] = array(
					'name' => genderWord($this->foodsaver['geschlecht'], 'Er','Sie', 'Er/Sie').' ist aktiv in den Orgagruppen',
					'val' => implode(', ', $bot)
			);
		}

		$out = '';
		foreach ($infos as $key => $info)
		{
			$out .= '<p><strong>'.$info['name'].'</strong><br />'.$info['val'].'</p>';
		}
		
		/*
		 * Statistics
		 */
		$fetchweight = '';
		if($this->foodsaver['stat_fetchweight'] > 0)
		{
			$fetchweight = '
				<span class="item stat_fetchweight">
					<span class="val">'.number_format($this->foodsaver['stat_fetchweight'], 0, ",", ".").'kg</span>
					<span class="name">gerettet</span>
				</span>';
		}
		
		$fetchcount = '';
		if($this->foodsaver['stat_fetchcount'] > 0)
		{
			$fetchcount = '
				<span class="item stat_fetchcount">
					<span class="val">'.number_format($this->foodsaver['stat_fetchcount'], 0, ",", ".").'x</span>
					<span class="name">abgeholt</span>
				</span>';
		}
		
		$postcount = '';
		if($this->foodsaver['stat_postcount'] > 0)
		{
			$postcount = '
				<span class="item stat_postcount">
					<span class="val">'.number_format($this->foodsaver['stat_postcount'], 0, ",", ".").'</span>
					<span class="name">Beiträge</span>
				</span>';
		}
		
		$bananacount = '';
		
		/*
		 * Banana
		*/
		if(S::may('fs'))
		{
			$count_banana = count($this->foodsaver['bananen']);
			if($count_banana == 0)
			{
				$count_banana = '&nbsp;';
			}
			
			$banana_button_class = ' bouched';
			$givebanana = '';
			
			if(!$this->foodsaver['bouched'] && ($this->foodsaver['id'] != fsId()))
			{
				$banana_button_class = '';
				$givebanana = '
				<a onclick="$(this).hide().next().show().children(\'textarea\').autosize();return false;" href="#">Schenke '.$this->foodsaver['name'].' eine Banane</a>
				<div class="vouch-banana-wrapper" style="display:none;">
					<div class="vouch-banana-desc">		
						Hier kannst Du etwas dazu schreiben, warum Du '.$this->foodsaver['name'].' gerne eine Banane schenken möchtest. Du kannst jedem Foodsaver nur eine Banane schenken!<br />
						Bitte gib die Vertrauensbanane nur an Foodsaver, die Du persönlich kennst und bei denen Du weißt, dass sie zuverlässig und engagiert sind und Du sicher bist, dass sie die Verhaltensregeln und die Rechtsvereinbarung einhalten.
						<p><strong>Vertrauensbananen können nicht zurückgenommen werden. Sei bitte deswegen besonders achtsam, wem Du eine schenkst.</strong></p>
						<a href="#" style="float:right;" onclick="ajreq(\'rate\',{app:\'profile\',type:2,id:'.(int)$this->foodsaver['id'].',message:$(\'#bouch-ta\').val()});return false;"><img src="/img/banana.png" /></a>
					</div>
					<textarea id="bouch-ta" class="textarea" placeholder="min. 100 Zeichen..." style="height:50px;"></textarea>
				</div>';
			}
			
			addJs('
			$(".stat_bananacount").magnificPopup({
				type:"inline"
			});');
			$bananacount = '
			<a href="#bananas" onclick="return false;" class="item stat_bananacount'.$banana_button_class.'">
				<span class="val">'.$count_banana.'</span>
				<span class="name">&nbsp;</span>
			</a>
			';
		
			$bananacount .= '
			<div id="bananas" class="white-popup mfp-hide corner-all">
				<h3>' . str_replace('&nbsp;','',$count_banana) . ' Vertrauensbananen</h3>
				'.$givebanana.'
				<table class="pintable">
					<tbody>';
			$odd = 'even';
			foreach ($this->foodsaver['bananen'] AS $b)
			{
				if($odd == 'even')
				{
					$odd = 'odd';
				}
				else
				{
					$odd = 'even';
				}
				$bananacount .= '
				<tr class="'.$odd.' bpost">
					<td class="img"><a class="tooltip" title="'.$b['name'].'" href="#"><img onclick="profile('.$b['id'].');return false;" src="'.img($b['photo']).'"></a></td>
					<td><span class="msg">'.nl2br($b['msg']).'</span>
					<div class="foot">
						<span class="time">'.niceDate($b['time_ts']).' von '.$b['name'].'</span>
					</div></td>
				</tr>';
			}
			$bananacount .= '
					</tbody>
				</table>
			</div>';
		}
		
			
		return '
			<div class="pure-g">
				<div class="profile statdisplay">
					'.$fetchweight.'
					'.$fetchcount.'
					'.$postcount.'
					'.$bananacount.'
				</div>
			    <div class="infos"> '.$out.' </div>
			</div>';
		
	}

	public function getHistory($history,$changetype)
	{
		$out = '
			<ul class="linklist history">';
		
		$curdate = 0;
		foreach ($history as $h)
		{
			if($curdate != $h['date'])
			{
				if($changetype == 0)
				{
					$typeofchange = '';
					if($h['change_status'] == 0)
					{
						$class = 'unverify';
						$typeofchange = 'Entverifiziert';
					}
					if($h['change_status'] == 1)
					{
						$class = 'verify';
						$typeofchange = 'Verifiziert';
					}
					$out .= '<li class="title"><span class="'.$class.'">'.$typeofchange.'</span> am '.niceDate($h['date_ts']).' durch:</li>';
				}
				if($changetype == 1)
				{
					if(!is_null($h['bot_id']))
					{
						$out .= '<li class="title">'.niceDate($h['date_ts']).' durch:</li>';
					}else
					{
						$out .= '<li class="title">'.niceDate($h['date_ts']).'</li>';
					}
					
				}
					
				$curdate = $h['date'];
			}
			if(!is_null($h['bot_id']))
			{
			$out .= '
				<li>
					<a class="corner-all" href="#" onclick="profile('.(int)$h['bot_id'].');return false;">
						<span class="n">'.$h['name'].' '.$h['nachname'].'</span>
						<span class="t"></span>
						<span class="c"></span>
					</a>
				</li>';
			}else{
				$out .= '
				<li>
					Es liegt keine Information &uuml;ber den Ersteller vor
				</li>';
			}
		}
		$out .= '
		</ul>';
		if($curdate == 0)
		{
			$out = 'Es liegen keine Daten vor'; 
		}
	return $out;
	}
	
	public function photo()
	{
		
		$menu = $this->profileMenu();
		
		$sleep_info = '';

		$online = '';
		
		if($this->foodsaver['online'])
		{
			$online = '<div style="margin-top:10px;">'.v_info($this->foodsaver['name'].' ist online!',false,'<i class="fa fa-circle" style="color:#5ab946;"></i>').'</div>';
		}
		
		return '<div style="text-align:center;">
					'.avatar($this->foodsaver,130).$sleep_info.'
				</div>
				'.$online.'
				'.$menu;
	}
	
	private function profileMenu()
	{
		$opt = '';
		$fsModel = loadModel('foodsaver');

		$bids = $fsModel->getFsBezirkIds($this->foodsaver['id']);
		if($this->foodsaver['buddy'] === -1 && $this->foodsaver['id'] != fsId())
		{
			$name = explode(' ', $this->foodsaver['name']);
			$name = $name[0];
			$opt .= '<li class="buddyRequest"><a onclick="ajreq(\'request\',{app:\'buddy\',id:'.(int)$this->foodsaver['id'].'});return false;" href="#"><i class="fa fa-user"></i>Ich kenne '.$name.'</a></li>';
		}

		if(isOrgaTeam() || isBotForA($bids,false,true))
		{
			$opt .= '<li><a href="/?page=foodsaver&a=edit&id='.$this->foodsaver['id'].'"><i class="fa fa-pencil"></i>bearbeiten</a></li>';
		}
		if(isOrgaTeam() || isBotForA($bids,false,true))
		{
			$opt .= '<li><a href="#" onclick="ajreq(\'history\',{app:\'profile\',fsid:'.(int)$this->foodsaver['id'].',type:0});"><i class="fa fa-file-text"></i>Verifizierungshistorie</a></li>';
		}
		if(isOrgaTeam() || isBotForA($bids,false,true))
		{
			$opt .= '<li><a href="#" onclick="ajreq(\'history\',{app:\'profile\',fsid:'.(int)$this->foodsaver['id'].',type:1});"><i class="fa fa-file-text"></i>Passhistorie</a></li>';
		}
		
		if(mayHandleReports())
		{
			if(isset($this->foodsaver['violation_count']) && $this->foodsaver['violation_count'] > 0)
			{
				$opt .= '<li><a href="/?page=report&sub=foodsaver&id='.(int)$this->foodsaver['id'].'"><i class="fa fa-meh-o"></i>'.sv('violation_count',array('count' => $this->foodsaver['violation_count'])).'</a></li>';
			}
				
			if(isset($this->foodsaver['note_count']))
			{
				$opt .= '<li><a href="/profile/'.(int)$this->foodsaver['id'].'/notes/"><i class="fa fa-file-text-o"></i>'.sv('notes_count',array('count' => $this->foodsaver['note_count'])).'</a></li>';
			}
		}
		
		return '
		<ul class="linklist">
			<li><a href="#" onclick="chat('.$this->foodsaver['id'].');return false;"><i class="fa fa-comment"></i>Nachricht schreiben</a></li>
			'.$opt.'
			<li><a href="#" onclick="ajreq(\'reportDialog\',{app:\'report\',fsid:'.(int)$this->foodsaver['id'].'});return false;"><i class="fa fa-life-ring"></i>Verstoß melden</a></li>
		</ul>';
	}
	
	public function setData($data)
	{
		$this->foodsaver = $data;
	}
	
	public function quickprofile($subtitle)
	{
		$tabs = '';
		$tabs_head = '';
		$verify = '';
		if($this->foodsaver['verified'] == 1)
		{
			$verify = '<span class="tooltip verified" title="'.$this->foodsaver['name'].' ist verifiziert">&nbsp;</span>';
		}
		$ginfo = false;
		$infos = array();
		$bot = array();
		
		if($this->foodsaver['sleep_status'] > 0)
		{
			$value = $this->foodsaver['name'].' zur Zeit im Schlafmützenmodus und somit nicht aktiv';
			if($this->foodsaver['sleep_until_ts'])
			{
				$value = $this->foodsaver['name'].' ist bis zum '.niceDateShort($this->foodsaver['sleep_until_ts']).' unterwegs';
			}
			
			if($this->foodsaver['sleep_msg'] != '')
			{
				$value .= '<br />'.v_info($this->foodsaver['sleep_msg']);
			}
			
			$infos[] = array(
				'name' => 'Schlafmütze',
				'val' => $value
			);
		}
		
		if(S::may('orga'))
		{
			$infos[] = array(
					'name' => s('private_mail'),
					'val' => '<a href="/?page=mailbox&mailto='.urlencode($this->foodsaver['email']).'">'.$this->foodsaver['email'].'</a>'
			);
			if($this->foodsaver['mailbox'])
			{
				$infos[] = array(
						'name' => s('mailbox'),
						'val' => '<a href="/?page=mailbox&mailto='.urlencode($this->foodsaver['mailbox']).'">'.$this->foodsaver['mailbox'].'</a>'
				);
			}
		}
		
		if($this->foodsaver['botschafter'])
		{
			
			foreach ($this->foodsaver['botschafter'] as $b)
			{
				$bot[$b['id']] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
			}
			$infos[] = array(
				'name' => $this->foodsaver['name'].' ist Botschafter für',
				'val' => implode(', ', $bot)
			);
		}
		if($this->foodsaver['foodsaver'])
		{
			$fsa = array();
			foreach ($this->foodsaver['foodsaver'] as $b)
			{
				if(!isset($bot[$b['id']]))
				{
					$fsa[] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
				}
			}
			if(!empty($fsa))
			{
				$infos[] = array(
						'name' => $this->foodsaver['name'].' ist Foodsaver für',
						'val' => implode(', ', $fsa)
				);
			}
		}
		if($this->foodsaver['orga'])
		{
			$bot = array();
			foreach ($this->foodsaver['orga'] as $b)
			{
				if(isOrgateam())
				{
					$bot[$b['id']] = '<a class="light" href="/?page=bezirk&bid='.$b['id'].'&sub=forum">'.$b['name'].'</a>';
				}
				else
				{
					$bot[$b['id']] = $b['name'];
				}
			}
			$infos[] = array(
					'name' => genderWord($this->foodsaver['geschlecht'], 'Er','Sie', 'Er/Sie').' ist aktiv in den Orgagruppen',
					'val' => implode(', ', $bot)
			);
		}
		
		if(strlen($this->foodsaver['about_me_public']) > 3)
		{
			$infos[] = array(
				'name'=>'Über '.$this->foodsaver['name'],
				'val' => $this->foodsaver['about_me_public']
			);
		
		}
		
		$infos[] = array('name' => '','val' => '<a href="#" onclick="ajreq(\'reportDialog\',{app:\'report\',fsid:'.(int)$this->foodsaver['id'].'});return false;">Verstoß melden</a>');
		
		$fetchweight = '';
		if($this->foodsaver['stat_fetchweight'] > 0)
		{
			$ginfo = true;
			$fetchweight = '
				<span class="item stat_fetchweight">
					<span class="val">'.number_format($this->foodsaver['stat_fetchweight'], 0, ",", ".").'kg</span>
					<span class="name">gerettet</span>
				</span>';
		}
		
		$fetchcount = '';
		if($this->foodsaver['stat_fetchcount'] > 0)
		{
			$ginfo = true;
			$fetchcount = '
				<span class="item stat_fetchcount">
					<span class="val">'.number_format($this->foodsaver['stat_fetchcount'], 0, ",", ".").'x</span>
					<span class="name">abgeholt</span>
				</span>';
		}
		
		$postcount = '';
		if($this->foodsaver['stat_postcount'] > 0)
		{
			$ginfo = true;
			$postcount = '
				<span class="item stat_postcount">
					<span class="val">'.number_format($this->foodsaver['stat_postcount'], 0, ",", ".").'</span>
					<span class="name">Beiträge</span>
				</span>';
		}
		
		$topinfos = array();
		
		
		
		$opt = '';
		if(isOrgaTeam() || isBotschafter())
		{
			$opt .= '<li><a href="/?page=foodsaver&a=edit&id='.$this->foodsaver['id'].'">bearbeiten</a></li>';
		}
		
		if($this->foodsaver['buddy'] === -1 && $this->foodsaver['id'] != fsId())
		{
			$name = explode(' ', $this->foodsaver['name']);
			$name = $name[0];
			$opt .= '<li class="buddyRequest"><a onclick="ajreq(\'request\',{app:\'buddy\',id:'.(int)$this->foodsaver['id'].'});return false;" href="#">Ich kenne '.$name.'</a></li>';
		}
		
		if($this->foodsaver['sleep_status'] == 0)
		{
			$date = new fDate($this->foodsaver['anmeldedatum']);
			$topinfos[] = array(
					'name' => 'Dabei seit',
					'val' => $date->format('d.m.Y')
			);
		}
		else if($this->foodsaver['sleep_until_ts'])
		{
			$date = new fDate($this->foodsaver['sleep_until']);
			$topinfos[] = array(
					'name' => 'schläft bis',
					'val' => $date->format('d.m.Y')
			);
		}
		else
		{
			$date = new fDate($this->foodsaver['last_login']);
			$topinfos[] = array(
					'name' => 'letzter Login',
					'val' => $date->format('d.m.Y')
			);
		}
		
		$b_style = '';
		if(!$ginfo)
		{
			$b_style = ' style="top:86px;"';
		}
		$bval = '- noch keine -';
		
		if((int)$this->foodsaver['stat_bananacount'] == 1)
		{
			$bval = '1 Banane';
		}
		elseif((int)$this->foodsaver['stat_bananacount'] > 1)
		{
			$bval = $this->foodsaver['stat_bananacount'].' Bananen';
		}
		
		if((int)$this->foodsaver['bananen'] > 0)
		{
			$tabs_head .= '<li><a href="#ptab-'.(int)$this->foodsaver['id'].'-2">Vertrauensbananen</a></li>';
			
			
			
			$tabs .= '
				<div id="ptab-'.(int)$this->foodsaver['id'].'-2">
					<div class="ui-padding">
						<table class="pintable">
							<tbody>';
			$odd = 'even';
			foreach ($this->foodsaver['bananen'] AS $b)
			{
				if($odd == 'even')
				{
					$odd = 'odd';
				}
				else
				{
					$odd = 'even';
				}
				$tabs .= '
				<tr class="'.$odd.' bpost">
					<td class="img"><a class="tooltip" title="'.$b['name'].'" href="#"><img onclick="profile('.$b['id'].');return false;" src="'.img($b['photo']).'"></a></td>
					<td><span class="msg">'.nl2br($b['msg']).'</span>
					<div class="foot">
						<span class="time">'.niceDate($b['time_ts']).' von '.$b['name'].'</span>
					</div></td>
				</tr>';
			}
			$tabs .= '
						</tbody>
					</table>
				</div>';
		}
		
		if($this->foodsaver['id'] == fsId())
		{
			$topinfos[] = array(
					'name' => 'Vertrauensbananen',
					'val' => $bval.'<span'.$b_style.' class="vouch-banana" title="Das sind Deine Bananen"><span>&nbsp;</span></span>'
			);
		}
		elseif(!$this->foodsaver['bouched'])
		{
			$topinfos[] = array(
				'name' => 'Vertrauensbananen',
				'val' => $bval.'<a'.$b_style.' onclick="addbanana('.$this->foodsaver['id'].');return false;" href="#" title="'.$this->foodsaver['name'].' eine Vertrauensbanane schenken" class="vouch-banana"><span>&nbsp;</span></a>'
			);
		}
		else
		{
			$topinfos[] = array(
					'name' => 'Vertrauensbananen',
					'val' => $bval.'<span'.$b_style.' class="vouch-banana" title="Du hast '.$this->foodsaver['name'].' schon eine Banane geschenkt"><span>&nbsp;</span></span>'
			);
		}
		
		if($this->foodsaver['stat_buddycount'] > 0)
		{
			$topinfos[] = array(
					'name' => 'Bekannte',
					'val' => $this->foodsaver['name'].' kennen '.$this->foodsaver['stat_buddycount'].' Foodsaver'
			);
		}
		
		$photo = avatar($this->foodsaver,'130');
		if(isOrgaTeam())
		{
			$data = array();
			if(!empty($this->foodsaver['data']))
			{
				$data = json_decode($this->foodsaver['data'],true);
			}
			$tabs_head .= '<li><a href="#ptab-'.(int)$this->foodsaver['id'].'-3">Kontaktinfos</a></li>';
			$tabs .= '
				<div id="ptab-'.(int)$this->foodsaver['id'].'-3">
					<div class="ui-padding">
						'.$this->xv_set(array(
							array('name' => 'Anschrift','val'=>$this->foodsaver['anschrift']),
							array('name' => 'PLZ / Ort','val'=>$this->foodsaver['plz'].' '.$this->foodsaver['stadt']),
							array('name' => 'Telefon','val' => $this->foodsaver['telefon'].'<br />'.$this->foodsaver['handy']),
							array('name' => 'E-Mail-Adresse', 'val' => '<a href="mailto:'.$this->foodsaver['email'].'">'.$this->foodsaver['email'].'</a>')
						)).'
					</div>
				</div>';
			$tabs_head .= '<li><a href="#ptab-'.(int)$this->foodsaver['id'].'-4">Anmeldedaten</a></li>';
			$tabs .= '
				<div id="ptab-'.(int)$this->foodsaver['id'].'-4">
					<div class="ui-padding">
						<pre style="font-size:12px;">
						<br />'.print_r($data,true).'
						</pre>
					</div>
				</div>';
		}
		
		return '
			<div id="dialog-profile-info">
				<div id="tabs-profile">
			    	<ul>
			      		<li><a href="#ptab-'.(int)$this->foodsaver['id'].'-1">'.$this->foodsaver['name'].'</a></li>
						'.$tabs_head.'
			    	</ul>
			    	<div id="ptab-'.(int)$this->foodsaver['id'].'-1">
						<div class="xv_left">
							<div style="height:130px;">'.$photo.'</div>
							'.$verify.'
							<ul>
								<li><a onclick="chat('.(int)$this->foodsaver['id'].');closeAllDialogs();return false;" href="#">Nachricht schreiben</a></li>
								'.$opt.'
							</ul>
						</div>
						
						<table>
							<tr>
								<td>
									<div class="statdisplay">
										'.$fetchweight.'
										'.$fetchcount.'
										'.$postcount.'
									</div>
								</td>
							</tr>
							<tr>
								<td>
									'.$this->xv_set($topinfos).'
								</td>
							</tr>
						</table>
						<div style="clear:both;"></div>
						<div class="xvmoreinfo" style="height:220px;">
							'.$this->xv_set($infos).'
						</div>
						<div style="display:none">
							<input type="hidden" name="profile-rate-id" id="profile-rate-id" value="'.$this->foodsaver['id'].'" />
							<div class="vouch-banana-title">
								'.$this->foodsaver['name'].' eine Vertrauensbanane schenken
							</div>
							<div class="vouch-banana-desc">
								
								Hier kannst Du etwas dazu schreiben, warum Du '.$this->foodsaver['name'].' gerne eine Banane schenken möchtest. Du kannst jedem Foodsaver nur eine Banane schenken!<br />
								Bitte gib die Vertrauensbanane nur an Foodsaver, die Du persönlich kennst und bei denen Du weißt, dass sie zuverlässig und engagiert sind und Du sicher bist, dass sie die Verhaltensregeln und die Rechtsvereinbarung einhalten.
								<p><strong>Vertrauensbananen können nicht zurückgenommen werden. Sei bitte deswegen besonders achtsam, wem Du eine schenkst.</strong></p>
								<img src="/img/banana.png" style="float:right;" />
							</div>
						</div>
					</div>
					'.$tabs.'
				</div>';
	}
	
	public function xv_set($rows,$title = false)
	{
		if(!$title)
		{
			$title = '';
		}
		else
		{
			$title = '<h3>'.$title.'</h3>';
		}
		$out = '
	<div id="'.id($title).'" class="xv_set">
		'.$title;
		foreach ($rows as $r)
		{
			$out .= '
		<div class="xv_row">
			<span class="xv_label">'.$r['name'].'</span><span class="xv_val">'.$r['val'].'</span>
		</div>';
		}
	
		return $out.'
	</div>';
	}
}
