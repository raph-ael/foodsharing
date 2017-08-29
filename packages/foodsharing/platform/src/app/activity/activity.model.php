<?php
class ActivityModel extends Model
{
	private $items_per_page = 10;
	
	public function loadBasketWallUpdates($page = 0)
	{		
		$updates = array();
		
		if($up = $this->q('
			SELECT
				w.id,
				w.body,
				w.time,
				UNIX_TIMESTAMP(w.time) AS time_ts,
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				b.id AS basket_id
		
		
			FROM
				'.PREFIX.'basket_has_wallpost hw,
				'.PREFIX.'foodsaver fs,
				'.PREFIX.'wallpost w,
				'.PREFIX.'basket b
		
			WHERE
				w.id = hw.wallpost_id
		
			AND
				w.foodsaver_id = fs.id
		
			AND
				hw.basket_id = b.id
				
			AND
				b.foodsaver_id = '.(int)fsId().'
					
			AND 
				w.foodsaver_id != '.(int)fsId().'

			AND
				b.status = 1
			
			ORDER BY w.id DESC
		
			LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'
		
		'))
		{
			
			$updates = $up;
		}
		
		if($up = $this->q('
				SELECT
					w.id,
					w.body,
					w.time,
					UNIX_TIMESTAMP(w.time) AS time_ts,
					fs.id AS fs_id,
					fs.name AS fs_name,
					fs.photo AS fs_photo,
					b.id AS basket_id
		
				FROM
					'.PREFIX.'basket_has_wallpost hw,
					'.PREFIX.'foodsaver fs,
					'.PREFIX.'wallpost w,
					'.PREFIX.'basket b,
					'.PREFIX.'basket_anfrage ba
			
				WHERE
					w.id = hw.wallpost_id
		
				AND
					w.foodsaver_id = fs.id
		
				AND
					hw.basket_id = b.id

				AND
					b.status = 1
			
				AND
					ba.basket_id = b.id
	
				AND
					ba.status < 10
				
				AND 	
					w.foodsaver_id != '.(int)fsId().'
				
				AND 
					ba.foodsaver_id = '.(int)fsId().'
				
				ORDER BY w.id DESC
		
				LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'
			
			'))
		{
			$updates = array_merge($updates,$up);
		}
		
		if(!empty($updates))
		{
			$out = array();
			
			foreach ($updates as $u)
			{
				/*
				 * quick fix later list all comments in a package
				*/
				if(isset($hb[$u['basket_id']]))
				{
					continue;
				}
				$hb[$u['basket_id']] = true;
				
				$smtitle = '';
				$title = 'Essenskorb #'.$u['basket_id'];
			
				$out[] = array(
						'attr' => array(
								'href' => '/profile/' . $u['fs_id']
						),
						'title' => '<a href="/profile/'.$u['fs_id'].'">'.$u['fs_name'].'</a> <i class="fa fa-angle-right"></i> <a href="/essenskoerbe/'.$u['basket_id'].'">'.$title.'</a><small>'.$smtitle.'</small>',
						'desc' => $this->textPrepare(nl2br($u['body'])),
						'time' => $u['time'],
						'icon' => img($u['fs_photo'],50),
						'time_ts' => $u['time_ts'],
						'quickreply' => '/xhrapp/?app=wallpost&m=quickreply&table=basket&id=' . (int)$u['basket_id']
				);
			}
			
			return $out;
		}
		
		return false;
	}
	
	public function loadFriendWallUpdates($page = 0,$hidden_ids)
	{
		$buddy_ids = array();
		
		if($b = S::get('buddy-ids'))
		{
			$buddy_ids = $b;
		}
		
		$buddy_ids[fsId()] = fsId();
		
		$bids = array();
		foreach ($buddy_ids as $id)
		{
			if(!isset($hidden_ids[$id]))
			{
				$bids[] = $id;
			}
		}
		
		if($updates = $this->q('
			SELECT 
				w.id,
				w.body,
				w.time,
				UNIX_TIMESTAMP(w.time) AS time_ts,
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				
				poster.id AS poster_id,
				poster.name AS poster_name
				

			FROM 
				'.PREFIX.'foodsaver_has_wallpost hw,
				'.PREFIX.'foodsaver fs,
				'.PREFIX.'wallpost w
				
			LEFT JOIN
				'.PREFIX.'foodsaver poster
				
			ON w.foodsaver_id = poster.id
				
			WHERE 
				w.id = hw.wallpost_id

			AND 
				hw.foodsaver_id = fs.id

			AND 
				hw.foodsaver_id IN('.implode(',',$bids).')
				
			
				
			ORDER BY w.id DESC
		
			LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'

		'))
		{
			/*
			 * AND 
				poster_id != '.(int)fsId().'
			 */
			$out = array();
			$hb = array();
			foreach ($updates as $u)
			{
				/*
				 * quick fix later list all comments in a package
				*/
				if(isset($hb[$u['fs_id']]))
				{
					continue;
				}
				$hb[$u['fs_id']] = true;
				
				$smtitle = $u['fs_name'].'s Status';
				$title = $u['fs_name'];
				
				if($u['fs_id'] ==fsId())
				{
					$smtitle = 'Deine Pinnwand';
					$title = 'Deine Pinnwand';
				}
				
				$out[] = array(
						'attr' => array(
								'href' => '/profile/' . $u['fs_id']
						),
						'title' => '<a href="/profile/'.$u['poster_id'].'">'.$u['poster_name'].'</a> <small>'.$smtitle.'</small>',
						'desc' => $this->textPrepare(nl2br($u['body'])),
						'time' => $u['time'],
						'icon' => img($u['fs_photo'],50),
						'time_ts' => $u['time_ts']
						//'quickreply' => '/xhrapp/?app=wallpost&m=quickreply&table=foodsaver&id=' . (int)$u['fs_id']
				);
			}
			
			return $out;
		}
		
		return false;
	}
	
	public function loadMailboxUpdates($page = 0, $model= false,$hidden_ids = false)
	{
		if($model === false)
		{
			$model = loadModel('mailbox');
		}
		
		if($boxes = $model->getBoxes())
		{
			$mb_ids = array();
			foreach ($boxes as $b)
			{
				if(!isset($hidden_ids[$b['id']]))
				{
					$mb_ids[] = $b['id'];
				}
			}

			if(count($mb_ids) == 0) {
				return false;
			}
			
			if($updates = $this->q('
				SELECT
					m.id,
					m.sender,
					m.subject,
					m.body,
					m.time,
					UNIX_TIMESTAMP(m.time) AS time_ts,
					b.name AS mb_name
			
				FROM
					'.PREFIX.'mailbox_message m
				LEFT JOIN
					'.PREFIX.'mailbox b
				ON b.id = m.mailbox_id
			
				WHERE
					m.mailbox_id IN('.implode(',',$mb_ids).')
					
				ORDER BY m.id DESC
		
				LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'
			'))
			{
				$out = array();
				foreach ($updates as $u)
				{
					$sender = @json_decode($u['sender'],true);
					
					$from = 'E-Mail';
					
					if($sender != null)
					{
						if(isset($sender['from']) && !empty($sender['from']))
						{
							$from = '<a title="'.$sender['mailbox'].'@'.$sender['host'].'" href="/?page=mailbox&mailto='.urlencode($sender['mailbox'].'@'.$sender['host']).'">'.ttt($sender['personal'],22).'</a>';
						}
						else if(isset($sender['mailbox']))
						{
							$from = '<a title="'.$sender['mailbox'].'@'.$sender['host'].'" href="/?page=mailbox&mailto='.urlencode($sender['mailbox'].'@'.$sender['host']).'">'.ttt($sender['mailbox'].'@'.$sender['host'],22).'</a>';
						}
					}
					
					$out[] = array(
							'attr' => array(
									'href' => '/?page=mailbox&show=' . $u['id']
							),
							'title' => $from . ' <i class="fa fa-angle-right"></i> <a href="/?page=mailbox&show=' . $u['id'].'">'.ttt($u['subject'],30).'</a><small>'.ttt($u['mb_name'].'@'.DEFAULT_HOST,19).'</small>',
							'desc' => $this->textPrepare(nl2br($u['body'])),
							'time' => $u['time'],
							'icon' => '/img/mailbox-50x50.png',
							'time_ts' => $u['time_ts'],
							'quickreply' => '/xhrapp/?app=mailbox&m=quickreply&mid=' . (int)$u['id']
					);
				}
				
				return $out;
			}
			
		}
		
		return false;
	}
	
	private function textPrepare($txt)
	{
		$txt = trim($txt);
		
		if(strlen($txt) > 100)
		{
			return '<span class="txt">'.tt(strip_tags($txt),90) . ' <a href="#" onclick="$(this).parent().hide().next().show();return false;">alles zeigen <i class="fa fa-angle-down"></i></a></span><span class="txt" style="display:none;">'.strip_tags($txt,'<br>').' <a href="#" onclick="$(this).parent().hide().prev().show();return false;">weniger <i class="fa fa-angle-up"></i></a></span>';
		}
		else 
		{
			return '<span class="txt">'.$txt.'</span>';
		}		
	}
	
	public function loadForumUpdates($page = 0, $bids_not_load = false)
	{
		$tmp = $this->getBezirkIds();
		$bids = array();
		if($tmp == false or count($tmp) == 0) {
			return false;
		}
		foreach ($tmp as $t)
		{
			if($t > 0 && !isset($bids_not_load[$t]))
			{
				$bids[] = $t;
			}
		}

		if(count($bids) == 0) {
			return false;
		}
		
		
		if($updates = $this->q('
		
			SELECT 		t.id,
						t.name,
						t.`time`,
						UNIX_TIMESTAMP(t.`time`) AS time_ts,
						fs.id AS foodsaver_id,
						fs.name AS foodsaver_name,
						fs.photo AS foodsaver_photo,
						fs.sleep_status,
						p.body AS post_body,
						p.`time` AS update_time,
						UNIX_TIMESTAMP(p.`time`) AS update_time_ts,
						t.last_post_id,
						bt.bezirk_id,
						b.name AS bezirk_name,
						bt.bot_theme
		
			FROM 		'.PREFIX.'theme t,
						'.PREFIX.'theme_post p,
						'.PREFIX.'bezirk_has_theme bt,
						'.PREFIX.'foodsaver fs,
						'.PREFIX.'bezirk b
		
			WHERE 		t.last_post_id = p.id 		
			AND 		p.foodsaver_id = fs.id
			AND 		bt.theme_id = t.id
			AND 		bt.bezirk_id IN('.implode(',', $bids).')
			AND 		bt.bot_theme = 0
			AND 		bt.bezirk_id = b.id
			AND 		t.active = 1
		
			ORDER BY t.last_post_id DESC
		
			LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'
		
		'))
		{
			$out = array();
			foreach ($updates as $u)
			{
				$check = true;
				$sub = 'forum';
				if($u['bot_theme'] == 1)
				{
					$sub = 'botforum';
					if(!isBotFor($u['bezirk_id']))
					{
						$check = false;
					}
				}

				$url = '/?page=bezirk&bid=' . (int)$u['bezirk_id'] . '&sub='.$sub.'&tid=' . (int)$u['id'] . '&pid='.(int)$u['last_post_id'].'#tpost-'.(int)$u['last_post_id'];
				
				if($check)
				{
					$out[] = array(
							'attr' => array(
								'href' => $url
							),
							'title' => '<a href="/profile/'.(int)$u['foodsaver_id'].'">'.$u['foodsaver_name'].'</a> <i class="fa fa-angle-right"></i> <a href="'.$url.'">'.$u['name'] . '</a> <small>'.$u['bezirk_name'] . '</small>',
							'desc' => $this->textPrepare($u['post_body']),
							'time' => $u['update_time'],
							'icon' => img($u['foodsaver_photo'],50),
							'time_ts' => $u['update_time_ts'],
							'quickreply' => '/xhrapp/?app=bezirk&m=quickreply&bid=' . (int)$u['bezirk_id'] . '&tid=' . (int)$u['id'] . '&pid=' . (int)$u['last_post_id'] . '&sub=' . $sub
					);
				}
				
			}
			
			return $out;
		}
		
		return false;
	}
	
	public function loadBetriebUpdates($page = 0)
	{
		if($bids = $this->getMyBetriebIds())
		{
			if($ret = $this->q('
			
			SELECT 	n.id, n.milestone, n.`text` , n.`zeit` AS update_time, UNIX_TIMESTAMP( n.`zeit` ) AS update_time_ts, fs.name AS foodsaver_name, fs.sleep_status, fs.id AS foodsaver_id, fs.photo AS foodsaver_photo, b.id AS betrieb_id, b.name AS betrieb_name
			FROM 	'.PREFIX.'betrieb_notiz n, '.PREFIX.'foodsaver fs, '.PREFIX.'betrieb b, '.PREFIX.'betrieb_team bt
			
			WHERE 	n.foodsaver_id = fs.id
			AND 	n.betrieb_id = b.id
			AND 	bt.betrieb_id = n.betrieb_id
			AND 	bt.foodsaver_id = '.(int)fsId().'
			AND 	n.milestone = 0
			AND 	n.last = 1
			
			ORDER BY n.id DESC
			LIMIT '.((int)$page*$this->items_per_page).', '.$this->items_per_page.'
			
		'))
			{
				$out = array();
				foreach ($ret as $r)
				{
					$out[] = array(
							'attr' => array(
									'href' => '/?page=fsbetrieb&id=' . $r['betrieb_id']
							),
							'title' => '<a href="/profile/'.$r['foodsaver_id'].'">'.$r['foodsaver_name'].'</a> <i class="fa fa-angle-right"></i> <a href="/?page=fsbetrieb&id=' . $r['betrieb_id'].'">'.$r['betrieb_name'].'</a>',
							'desc' => $this->textPrepare($r['text']),
							'time' => $r['update_time'],
							'icon' => img($r['foodsaver_photo'],50),
							'time_ts' => $r['update_time_ts']
					);
				}
					
				return $out;
			}
		}
		
		return false;
	}
	
	public function getBuddys()
	{
		if($bids = S::get('buddy-ids'))
		{
			return $this->q('SELECT photo,name,id FROM '.PREFIX.'foodsaver WHERE id IN('.implode(',',$bids).')');
		}
		return false;
	}
}
