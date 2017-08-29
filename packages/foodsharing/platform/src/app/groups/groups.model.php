<?php
class GroupsModel extends Model
{
	private $ag_id;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function setAgId($id)
	{
		$this->ag_id = $id;
	}
	
	/*
	 * Eigene Vorhandene Bewerbungen
	 */
	public function getMyApplications()
	{
		if($ret = $this->qCol('
			SELECT 	`bezirk_id`
			FROM 	`'.PREFIX.'foodsaver_has_bezirk`	
			WHERE 	`active` != 1	
			AND 	foodsaver_id = '.(int)fsId().'
		'))
		{
			$out = array();
			foreach ($ret as $gid)
			{
				$out[$gid] = $gid;
			}
			return $out;
		}
		
		return array();
	}
	
	/**
	 * Updates Group Members and Group-Admins
	 */
	public function updateTeam($group_id)
	{
		// get the lazy global g_data variable. there we find all submitted form data
		global $g_data;
		
		// check is there some team data? otherwise empty team
		if(isset($g_data['member']) && is_array($g_data['member']) && count($g_data['member']) > 0)
		{
			// delete all members they're not in the submitted array
			$this->del('
				DELETE FROM 
					`'.PREFIX.'foodsaver_has_bezirk`
				
				WHERE 
					bezirk_id = '.(int)$group_id.'
					
				AND
					foodsaver_id NOT IN('.implode(',', $g_data['member']).')
				AND
					`active` = 1
			');
			
			$values = array();
			foreach ($g_data['member'] as $m)
			{
				$values[] = '('.(int)$m.','.$group_id.',1,NOW())';
			}
			
			// insert new members
			$this->insert('
				INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_bezirk`
				(
					`foodsaver_id`,
					`bezirk_id`,
					`active`,
					`added`
				)
				VALUES
				'.implode(',',$values).'
				
			');
			
		}
		else 
		{
			$this->emptyMember($group_id);
		}
		
		// the same for the group admins
		if(isset($g_data['leader']) && is_array($g_data['leader']) && count($g_data['leader']) > 0)
		{
			// delete all group-admins (botschafter) they're not in the submitted array
			$this->del('
				DELETE FROM
					`'.PREFIX.'botschafter`
			
				WHERE
					bezirk_id = '.(int)$group_id.'
			
				AND
					foodsaver_id NOT IN('.implode(',', $g_data['leader']).')
			');
				
			$values = array();
			foreach ($g_data['leader'] as $m)
			{
				$values[] = '('.(int)$m.','.$group_id.')';
			}
				
			// insert new group-admins
			$this->insert('
				INSERT IGNORE INTO `'.PREFIX.'botschafter`
				(
					`foodsaver_id`,
					`bezirk_id`
				)
				VALUES
				'.implode(',',$values).'
			
			');
		}
		else
		{
			$this->emptyLeader($group_id);
		}
	}
	
	/**
	 * Delete all Leaders from a group
	 *
	 * @param Integer $group_id
	 */
	private function emptyLeader($group_id)
	{
		return $this->del('
			DELETE FROM `'.PREFIX.'botschafter`
			WHERE bezirk_id = '.(int)$group_id.'
		');
	}
	
	/**
	 * Delete all Leaders from a group
	 *
	 * @param Integer $group_id
	 */
	private function emptyMember($group_id)
	{
		return $this->del('
			DELETE FROM `'.PREFIX.'foodsaver_has_bezirk`
			WHERE bezirk_id = '.(int)$group_id.'
			AND
			`active` = 1
		');
	}
	
	public function getGroup($id)
	{
		if($group = $this->qRow('
			SELECT 	
				b.`id`,
				b.`name`,
				b.`parent_id`,
				b.`desc`,
				b.`teaser`,
				b.`photo`,
				b.`email_name`,
				b.`apply_type`,
				b.`banana_count`,
				b.`week_num`,
				b.`fetch_count`,
				b.`report_num`,
				b.`type`,
				CONCAT(m.name,"@'.DEFAULT_HOST.'") AS email
				
			FROM 	
				'.PREFIX.'bezirk b,
				'.PREFIX.'mailbox m
				
			WHERE 	
				b.mailbox_id = m.id
				
			AND
				b.`id` = '.(int)$id.'
		'))
		{
			$group['member'] = $this->q('
					SELECT 
						`id`, 
						`name`, 
						`photo`
						 
					FROM
						`'.PREFIX.'foodsaver` fs,
						`'.PREFIX.'foodsaver_has_bezirk` hb

					WHERE 
						hb.foodsaver_id = fs.id
						
					AND 
						hb.bezirk_id = '.(int)$id.'
					AND
						hb.`active` = 1
				');
				$group['leader'] = $this->q('
						SELECT
						`id`,
						`name`,
						`photo`
							
						FROM
						`'.PREFIX.'foodsaver` fs,
						`'.PREFIX.'botschafter` hb
				
						WHERE
						hb.foodsaver_id = fs.id
				
						AND
						hb.bezirk_id = '.(int)$id.'
						');
		}
		
		return $group;
	}
	
	public function addMeToGroup($group_id)
	{
		return $this->insert('
			REPLACE INTO `'.PREFIX.'foodsaver_has_bezirk`(`foodsaver_id`, `bezirk_id`, `active`, `added`) 
			VALUES (
				'.(int)fsid().',
				'.(int)$group_id.',
				1,
				NOW()
			)		
		');
	}
	
	public function listMyGroups()
	{
		return $this->q('
			SELECT
				b.`id`,
				b.`name`,
				b.`teaser`,
				b.`photo`
		
			FROM
				'.PREFIX.'bezirk b,
				'.PREFIX.'foodsaver_has_bezirk hb
		
			WHERE
				hb.bezirk_id = b.id
		
			AND
				hb.`foodsaver_id` = '.(int)fsId().'
		
			AND
				b.`type` = 7
		
			ORDER BY
				b.`name`
		');
	}
	
	public function listGroups()
	{
		if($groups = $this->q('
			SELECT 	
				b.`id`,
				b.`name`,
				b.`parent_id`,
				b.`desc`,
				b.`teaser`,
				b.`photo`,
				b.`apply_type`,
				b.`banana_count`,
				b.`week_num`,
				b.`fetch_count`,
				b.`report_num`,
				CONCAT(m.name,"@'.DEFAULT_HOST.'") AS email
				
			FROM 	
				'.PREFIX.'bezirk b,
				'.PREFIX.'mailbox m
				
			WHERE 	
				b.mailbox_id = m.id
				
			AND
				b.`parent_id` = '.(int)$this->ag_id.'
				
			AND
				`type` = 7
				
			ORDER BY
				`name`
		'))
		{
			
			foreach ($groups as $i => $g)
			{
				$groups[$i]['member'] = $this->q('
					SELECT 
						`id`, 
						`name`, 
						`photo`
						 
					FROM
						`'.PREFIX.'foodsaver` fs,
						`'.PREFIX.'foodsaver_has_bezirk` hb

					WHERE 
						hb.foodsaver_id = fs.id
						
					AND 
						hb.bezirk_id = '.$g['id'].'
					AND
						hb.`active` = 1
				');
				$groups[$i]['leader'] = $this->q('
						SELECT
						`id`,
						`name`,
						`photo`
							
						FROM
						`'.PREFIX.'foodsaver` fs,
						`'.PREFIX.'botschafter` hb
				
						WHERE
						hb.foodsaver_id = fs.id
				
						AND
						hb.bezirk_id = '.$g['id'].'
						');
			}
			
			return $groups;
		}
		
		return false;
	}
	
	public function groupApply($id,$application)
	{
		return $this->insert('
			REPLACE INTO  `fs_foodsaver_has_bezirk`
				
			(`foodsaver_id`, `bezirk_id`, `active`, `added`,`application`) 
			VALUES 
			('.(int)fsId().','.(int)$id.',0,NOW(),'.$this->strval($application).')		
		');
	}
	
	public function getFsMail($fsid)
	{
		return $this->qOne('
		
			SELECT
				CONCAT(mb.name,"@'.DEFAULT_HOST.'")
		
			FROM
				'.PREFIX.'mailbox mb,
				'.PREFIX.'foodsaver fs
		
			WHERE
				fs.mailbox_id = mb.id
		
			AND
				fs.id = '.(int)$fsid.'
		
		');
	}
	
	public function getGroupMail($id)
	{
		return $this->qOne('

			SELECT 
				CONCAT(mb.name,"@'.DEFAULT_HOST.'")
				
			FROM 	
				'.PREFIX.'mailbox mb,
				'.PREFIX.'bezirk bz
				
			WHERE 
				bz.mailbox_id = mb.id
				
			AND
				bz.id = '.(int)$id.'
				
		');
	}
	
	public function updateGroup($id, $data)
	{		
		return $this->update('
				
			UPDATE 
				`'.PREFIX.'bezirk`
				
			SET 	
				`name` = '.$this->strval($data['name']).',
				`teaser` = '.$this->strval($data['teaser']).',
				`photo` = '.$this->strval($data['photo']).',
				`desc` = '.$this->strval($data['desc']).',
				`apply_type` = '.(int)$data['apply_type'].',
				`banana_count` = '.(int)$data['banana_count'].',
				`fetch_count` = '.(int)$data['fetch_count'].',
				`week_num` = '.(int)$data['week_num'].',
				`report_num` = '.(int)$data['report_num'].'
				
			WHERE
				`id` = '.(int)$id.'
				
		');
	}
	
	public function getMyStats()
	{
		if($ret = $this->getValues(array('anmeldedatum','stat_fetchcount','stat_bananacount'), 'foodsaver', fsid()))
		{
			$time = strtotime($ret['anmeldedatum']);
			// 604800 = sekunden pro woche
			$weeks = (int)round( (time() - $time) / 604800 );
			
			$reports = $this->qOne('SELECT COUNT(foodsaver_id) FROM '.PREFIX.'report WHERE foodsaver_id = '.(int)fsid());
			
			return array(
				'weeks' => (int)$weeks,
				'fetchcount' => (int)$ret['stat_fetchcount'],
				'bananacount' => (int)$ret['stat_bananacount'],
				'reports' => (int)$reports
			);
		}
	}
	
	public function getCountryGroups()
	{
		return $this->q('

			SELECT 	
				`id`,
				`name`,
				`parent_id`
				
			FROM 	
				'.PREFIX.'bezirk
				
			WHERE
				`type` = 6
				
		');
	}
}
