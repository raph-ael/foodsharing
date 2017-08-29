<?php
class MaintenanceModel extends ConsoleModel
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function updateBezirkIds()
	{
		$foodsaver = $this->q('SELECT `bezirk_id`, `id` FROM `'.PREFIX.'foodsaver` WHERE `bezirk_id` != 0');
	
		$query = array();
	
		foreach ($foodsaver as $fs)
		{
			$query[] = '('.(int)$fs['id'].','.(int)$fs['bezirk_id'].',1)';
		}
	
		$this->sql('
			REPLACE INTO `'.PREFIX.'foodsaver_has_bezirk`
			(
				`foodsaver_id`,
				`bezirk_id`,
				`active`
			)
			VALUES
			'.implode(',', $query).'
		');
	}
	
	public function deleteUnconformedFetchDates()
	{
		return $this->del('DELETE FROM '.PREFIX.'abholer WHERE confirmed = 0 AND `date` < NOW()');
	}
	
	public function listAvatars()
	{
		return $this->q('SELECT id, photo FROM '.PREFIX.'foodsaver WHERE photo != ""');
	}
	
	public function noAvatars($foodsaver_ids)
	{
		return $this->update('UPDATE '.PREFIX.'foodsaver SET photo = "" WHERE id IN('.implode(',',$foodsaver_ids).')');
	}
	
	public function getUserInfo()
	{
		return $this->q('SELECT id, infomail_message FROM '.PREFIX.'foodsaver');
	}
	
	public function listOldBellIds($days = 7)
	{
		return $this->qCol('
			SELECT id
			FROM `'.PREFIX.'bell`
			WHERE `time` <= NOW( ) - INTERVAL '.(int)$days.' DAY
		');
	}
	
	public function deactivateOldBaskets()
	{
		return $this->update('
			UPDATE '.PREFIX.'basket
			SET `status` = 6 WHERE
			until < NOW()
			AND `status` = 1
		');
	}
	
	public function deleteBells($bell_ids)
	{
		$this->del('
			DELETE FROM '.PREFIX.'foodsaver_has_bell 
			WHERE 	bell_id IN('.implode(',', $bell_ids).')
		');
		
		$this->del('
			DELETE FROM `'.PREFIX.'bell` 
			WHERE 	id IN('.implode(',', $bell_ids).')
		');
		
		$this->sql('LOCK TABLES `'.PREFIX.'bell` WRITE');
		$this->sql('ALTER TABLE `'.PREFIX.'bell` AUTO_INCREMENT = (SELECT MAX(id) FROM `'.PREFIX.'bell`)');
		$this->sql('UNLOCK TABLES');
	}
	
	/*
	public function getBotschafterIds()
	{
		return $this->qCol('
				SELECT DISTINCT bot.foodsaver_id AS id
	
				FROM
				    `'.PREFIX.'botschafter` bot,
				    `'.PREFIX.'bezirk` b
	
				WHERE
				    bot.bezirk_id = b.id
	
				AND
				    b.`type` != 7
			');
	}
	
	public function updateRolle($fsids,$rolle_id)
	{
		return $this->update('
			UPDATE `'.PREFIX.'foodsaver`
	
			SET
				`rolle` = '.(int)$rolle_id.'
	
			WHERE
				`rolle` != '.(int)$rolle_id.'
	
			AND
				`id` IN('.implode(',', $botsch).')
		');
	}
	*/
	
	public function updateRolle()
	{
	
		if($botschafter = $this->q('SELECT DISTINCT foodsaver_id FROM `'.PREFIX.'botschafter` '))
		{
			$foodsaver = $this->q('
				SELECT DISTINCT bot.foodsaver_id
	
				FROM
				    `'.PREFIX.'botschafter` bot,
				    `'.PREFIX.'bezirk` b
	
				WHERE
				    bot.bezirk_id = b.id
	
				AND
				    b.`type` != 7
			
			');
			$botsch = array();
	
			foreach ($botschafter as $b)
			{
				$botsch[$b['foodsaver_id']] = $b['foodsaver_id'];
			}
	
			if(!empty($botsch))
			{
				$count = $this->update('
					UPDATE `'.PREFIX.'foodsaver`
	
					SET
						`rolle` = '.rolleWrap('bot').'
	
					WHERE
						`rolle` < '.rolleWrap('bot').'
	
					AND
						`id` IN('.implode(',', $botsch).')
				');
				fs_info($count.' botsch');
			}
	
			$nomore = array();
			foreach ($foodsaver as $fs)
			{
				if(!isset($botsch[$fs['foodsaver_id']]))
				{
					$nomore[] = $fs['foodsaver_id'];
				}
			}
			if(!empty($nomore))
			{
				$count = $this->update('
					UPDATE `'.PREFIX.'foodsaver` SET `rolle` = '.rolleWrap('fs').' WHERE `id` IN('.implode(',', $nomore).')
				');
				fs_info($count.' nomore');
			}
		}
	}
	
	public function setFoodsaverInactive($fsids)
	{
		return $this->update('UPDATE '.PREFIX.'foodsaver SET sleep_status = 2 WHERE id IN('.implode(',',$fsids).')');
	}
	
	public function getUserBotschafter($fsid)
	{
		return $this->q('
			SELECT 
				fs.id,
				fs.name,
				fs.email
				
			FROM 
				'.PREFIX.'foodsaver_has_bezirk hb,
				'.PREFIX.'botschafter b,
				'.PREFIX.'foodsaver fs
				
			WHERE 
				b.foodsaver_id = fs.id
				
			AND 
				b.bezirk_id = hb.bezirk_id
				
			AND
				hb.foodsaver_id = '.(int)$fsid.'
		');
	}
	
	public function listFoodsaverInactiveSince($days)
	{
		return $this->q('
			SELECT 
				`id`,
				`name`,
				`nachname`,
				`email`,
				`geschlecht`

			FROM 
				'.PREFIX.'foodsaver
				
			WHERE 
				sleep_status = 0
			AND
				`last_login` < "'.date('Y-m-d H:i:s',( time()-(84400*$days)) ).'"
		');
	}
	
	public function getAlertBetriebeAdmins()
	{
		$dow = (int)date('w');
		
		$dow2 = $dow+1;
		if($dow2 == 7)
		{
			$dow2 = 0;
		}
		
		$sql = '
			SELECT 
				DISTINCT z.betrieb_id

			FROM 
				fs_abholzeiten z
				
			LEFT JOIN
				fs_betrieb b
				
			ON
				z.betrieb_id = b.id
				
			WHERE
				b.betrieb_status_id IN(3,5)
				
			AND
			(
				(
					z.dow = '.(int)$dow.'
					AND
					z.time >= "15:00:00"
				)
				OR
				(
					z.dow = '.(int)$dow2.'
					AND
					z.time < "15:00:00"
				)
			)
		';
		
		if($betriebe = $this->q($sql))
		{
			$bids = array();
			
			foreach ($betriebe as $b)
			{
				$bids[(int)$b['betrieb_id']] = (int)$b['betrieb_id']; 
			}
			
			$date1 = date('Y-m-d') . ' 15:00:00';
			$date1_end = date('Y-m-d') . ' 23:59:59';
			
			$date2 = date('Y-m-d', time()+86400) . ' 00:00:00';
			$date2_end = date('Y-m-d', time()+86400) . ' 15:00:00';
			
			$sql2 = '
				SELECT
					DISTINCT b.id
				
				FROM
					'.PREFIX.'betrieb b,
					'.PREFIX.'abholer a
				
				WHERE
					a.betrieb_id = b.id
						
				AND 
					a.confirmed = 1
						
				AND 
					b.id IN('.implode(',',$bids).')
							
				AND 
				(
					(
						a.date >= "'.$date1.'"
						AND
						a.date <= "'.$date1_end.'"
					)
					OR
					(
						a.date >= "'.$date2.'"
						AND
						a.date <= "'.$date2_end.'"
					)
				)
			';
			
			if($betrieb_has_fetcher = $this->q($sql2))
			{
				foreach ($betrieb_has_fetcher as $bb)
				{
					unset($bids[$bb['id']]);
				}
			}
			
			if(!empty($bids))
			{
				return $this->q('
					SELECT
						fs.id AS fs_id,
						fs.email AS fs_email,
						fs.geschlecht,
						fs.name AS fs_name,
						b.id AS betrieb_id,
						b.name AS betrieb_name
						
					FROM
						'.PREFIX.'betrieb b,
						'.PREFIX.'betrieb_team bt,
						'.PREFIX.'foodsaver fs
						
					WHERE
						b.id = bt.betrieb_id
						
					AND
						bt.foodsaver_id = fs.id
						
					AND
						bt.active = 1
						
					AND
						bt.verantwortlich = 1
					
					AND
						b.id IN('.implode(',',$bids).')');
			}
		}
		
		return false;
	}
	
	public function deleteOldIpBlocks()
	{
		return $this->del('DELETE FROM `fs_ipblock` WHERE UNIX_TIMESTAMP(NOW()) > UNIX_TIMESTAMP(start)+duration ');
	}
}