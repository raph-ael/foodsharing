<?php
class BetriebModel extends Model
{
	public function addFetchDate($bid,$time,$fetchercount)
	{
		return $this->insert('
			INSERT INTO `'.PREFIX.'fetchdate`
			(
				`betrieb_id`, 
				`time`, 
				`fetchercount`
			) 
			VALUES 
			(
				'.(int)$bid.',
				'.$this->dateval($time).',
				'.(int)$fetchercount.'
			)
		');
	}
	
	public function updateBetriebBezirk($betrieb_id,$bezirk_id)
	{
		return $this->update('UPDATE '.PREFIX.'betrieb SET bezirk_id = '.(int)$bezirk_id.' WHERE id = '.(int)$betrieb_id);
	}
	
	public function getFetchHistory($betrieb_id,$from,$to)
	{
		return $this->q('
			SELECT
				fs.id,
				fs.name,
				fs.nachname,
				fs.photo,
				a.date,
				UNIX_TIMESTAMP(a.date) AS date_ts
	
			FROM
				'.PREFIX.'foodsaver fs,
				'.PREFIX.'abholer a
	
			WHERE
				a.foodsaver_id = fs.id
	
			AND
				a.betrieb_id = '.(int)$betrieb_id.'
	
			AND
				a.date >= '.$this->dateVal($from).'
	
			AND
				a.date <= '.$this->dateVal($to).'
	
			ORDER BY
				a.date
	
		');
	}
	
	public function deldate($bid,$date)
	{
		$this->del('DELETE FROM `'.PREFIX.'abholer` WHERE `betrieb_id` = '.(int)$bid.' AND `date` = '.$this->dateval($date));
		return $this->del('DELETE FROM `'.PREFIX.'fetchdate` WHERE `betrieb_id` = '.(int)$bid.' AND `time` = '.$this->dateval($date));
	}
	
	public function listMyBetriebe()
	{
		return $this->q('
			SELECT 	b.id,
					b.name,
					b.plz,
					b.stadt,
					b.str,
					b.hsnr

			FROM
				'.PREFIX.'betrieb b,
				'.PREFIX.'betrieb_team t
				
			WHERE
				b.id = t.betrieb_id
				
			AND
				t.foodsaver_id = '.fsId().'
				
			AND
				t.active = 1
		');
	}
	
	public function listUpcommingFetchDates($bid)
	{
		if($dates = $this->q('
			SELECT 	`time`,
					UNIX_TIMESTAMP(`time`) AS `time_ts`,
					`fetchercount`
			FROM 	'.PREFIX.'fetchdate
			WHERE 	`betrieb_id` = '.(int)$bid.'
			AND 	`time` > NOW()
		'))
		{
			$out = array();
			foreach($dates as $d)
			{
				$out[date('Y-m-d H-i',$d['time_ts'])] = array(
					'time' => date('H:i:s',$d['time_ts']),
					'fetcher' => $d['fetchercount'],
					'additional' => true,
					'datetime' => $d['time']
				);
			}
			
			return $out;
		}
		
		return false;
	}

	/* delete fetch dates a user signed up for.
	 * Either a specific fetch date (fsid, bid and date set)
	 * or all fetch dates for a store (only fsid, bid set)
	 * or all fetch dates for a user (only fsid set)
	 */
	public function deleteFetchDate($fsid,$bid = null,$date = null)
	{
		if($date !== null && $bid !== null)
		{
			return $this->del('DELETE FROM `'.PREFIX.'abholer` WHERE `betrieb_id` = '.(int)$bid.' AND `foodsaver_id` = '.(int)$fsid.' AND `date` = '.$this->dateval($date));
		}
		elseif($bid !== null)
		{
			return $this->del('DELETE FROM `' . PREFIX . 'abholer` WHERE `betrieb_id` = ' . (int)$bid . ' AND `foodsaver_id` = ' . (int)$fsid . ' AND `date` = > now()');
		} else
		{
			return $this->del('DELETE FROM `'.PREFIX.'abholer` WHERE `foodsaver_id` = '.(int)$fsid.' AND `date` > now()');
		}
	}

	public function signout($bid, $fsid)
	{
		$bid = $this->intval($bid);
		$fsid = $this->intval($fsid);
		$this->del('DELETE FROM `'.PREFIX.'betrieb_team` WHERE `betrieb_id` = '.$bid.' AND `foodsaver_id` = '.$fsid.' ');
		$this->del('DELETE FROM `'.PREFIX.'abholer` WHERE `betrieb_id` = '.$bid.' AND `foodsaver_id` = '.$fsid.' AND `date` > NOW()');

		$msg = loadModel('msg');

		if($tcid = $msg->getBetriebConversation($bid))
		{
			$msg->deleteUserFromConversation($tcid, $fsid, true);
		}
		if($scid = $msg->getBetriebConversation($bid, true))
		{
			$msg->deleteUserFromConversation($scid, $fsid, true);
		}
	}

	public function getBetriebBezirkID($id)
	{
		$out = $this->qRow('
			SELECT
			`bezirk_id`

			FROM 		`'.PREFIX.'betrieb`

			WHERE 		`id` = ' . $this->intval($id));

		return $out;
	}

}
