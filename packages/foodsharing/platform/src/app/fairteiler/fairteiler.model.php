<?php
class FairteilerModel extends Model
{

	public function getEmailFollower($fid)
	{
		return $this->q('
			SELECT 	fs.`id`,
					fs.`name`,
					fs.`nachname`,
					fs.`email`,
					fs.`geschlecht`
				
			FROM 	`'.PREFIX.'fairteiler_follower` ff,
					`'.PREFIX.'foodsaver` fs
				
			WHERE 	ff.foodsaver_id = fs.id
			AND 	ff.fairteiler_id = '.(int)$fid.'
			AND 	ff.infotype = 1
		');
	}
	
	public function getLastFtPost($ftid)
	{
		return $this->qRow('
			SELECT 		wp.id,
						wp.time,
						UNIX_TIMESTAMP(wp.time) AS time_ts,
						wp.body,
						wp.attach,
						fs.name AS fs_name			
					
			FROM 		fs_fairteiler_has_wallpost hw 
			LEFT JOIN 	fs_wallpost wp
			ON 			hw.wallpost_id = wp.id
				
			LEFT JOIN 	fs_foodsaver fs ON wp.foodsaver_id = fs.id

			WHERE 		hw.fairteiler_id = '.(int)$ftid.'
				
			ORDER BY 	wp.id DESC
			LIMIT 1
		');
	}
	
	public function updateVerantwortliche($ft_id)
	{
		global $g_data;		
		$values = array();
		
		foreach ($g_data['bfoodsaver'] as $fs)
		{
			$values[] = '('.(int)$ft_id.','.(int)$fs.',2,1)';
		}
		
		$this->update('
			UPDATE 		`'.PREFIX.'fairteiler_follower`
			SET 		`type` = 1
			WHERE 		`fairteiler_id` = '.(int)$ft_id.'
		');
		
		return $this->insert('
				REPLACE INTO `'.PREFIX.'fairteiler_follower`
				(
					`fairteiler_id`,
					`foodsaver_id`,
					`type`,
					`infotype`
				)
				VALUES
				'.implode(',', $values).'
		');
	}
	
	public function getInfoFollower($fid)
	{
		return $this->q('
			SELECT 	fs.`id`,
					fs.`name`,
					fs.`nachname`,
					fs.`email`,
					fs.sleep_status
	
			FROM 	`'.PREFIX.'fairteiler_follower` ff,
					`'.PREFIX.'foodsaver` fs
	
			WHERE 	ff.foodsaver_id = fs.id
			AND 	ff.fairteiler_id = '.(int)$fid.'
		');
	}
	
	public function listFairteiler($bezirk_id)
	{
		$bezirk_ids = array();
		if($bezirk_id == 0)
		{
			if($bezike = $this->getBezirke())
			{
				foreach ($bezike as $b)
				{
					if($bb = $this->getChildBezirke($b['id']))
					{
						foreach ($bb as $c)
						{
							$bezirk_ids[$c] = $c;
						}
					}
				}
			}
		}
		else
		{
			if($bb = $this->getChildBezirke($bezirk_id))
			{
				foreach ($bb as $c)
				{
					$bezirk_ids[$c] = $c;
				}
			}
			
		}
		
		if(!empty($bezirk_ids) && ($fairteiler = $this->q('
	
			SELECT 	ft.`id`,
					ft.`name`,
					ft.`picture`,
					bz.id AS bezirk_id,
					bz.name AS bezirk_name
			
			FROM 	`'.PREFIX.'fairteiler` ft,
					`'.PREFIX.'bezirk` bz
				
			WHERE 	ft.bezirk_id = bz.id
			AND 	ft.`bezirk_id` IN('.implode(',', $bezirk_ids).')
			AND 	ft.`status` = 1
		')))
		{
			$out = array();
			
			foreach ($fairteiler as $key => $ft)
			{
				if(!isset($out[$ft['bezirk_id']]))
				{
					$out[$ft['bezirk_id']] = array(
						'id'  => $ft['bezirk_id'],
						'name' => $ft['bezirk_name'],
						'fairteiler' => array()
					);
				}
				$pic = false;
				if(!empty($ft['picture']))
				{
					$pic = array(
							'thumb' => 'images/'.str_replace('/', '/crop_1_60_', $ft['picture']),
							'head' => 'images/'.str_replace('/', '/crop_0_528_', $ft['picture']),
							'orig' => 'images/'.($ft['picture'])
					);
				
				}
				$out[$ft['bezirk_id']]['fairteiler'][] = array(
					'id' => $ft['id'],
					'name' => $ft['name'],
					'picture' => $ft['picture'],
					'pic' => $pic
				);
			}
			return $out;
		}
		return false;
	}
	
	public function getFairteilerIds()
	{
		return $this->qColKey('SELECT fairteiler_id FROM '.PREFIX.'fairteiler_follower WHERE foodsaver_id = '.(int)fsId());
	}
	
	public function follow($ft_id,$infotype)
	{
		return $this->insert('
				INSERT IGNORE INTO `'.PREFIX.'fairteiler_follower`
				(
					`fairteiler_id`,
					`foodsaver_id`,
					`type`,
					`infotype`
				)
				VALUES
				(
					'.(int)$ft_id.',
					'.(int)fsId().',
					1,
					'.$infotype.'
				)
		');
	}
	
	public function unfollow($ft_id)
	{
		return $this->del('
				DELETE FROM `'.PREFIX.'fairteiler_follower`
				WHERE 	fairteiler_id = '.(int)$ft_id.'
				AND 	foodsaver_id = '.(int)fsId().'
		');
	}
	
	public function getFollower($fairteiler_id)
	{
		if($follower = $this->q('

			SELECT 	fs.`name`,
					fs.`nachname`,
					fs.`id`,
					fs.`photo`,
					ff.type,
					fs.sleep_status
				
			FROM 	'.PREFIX.'foodsaver fs,
					'.PREFIX.'fairteiler_follower ff
			WHERE 	ff.foodsaver_id = fs.id
			AND 	ff.fairteiler_id = '.(int)$fairteiler_id.'
				
		'))
		{
			$normal = array();
			$verantwortliche = array();
			$all = array();
			foreach ($follower as $f)
			{
				if($f['type'] == 1)
				{
					$normal[] = $f;
					$all[$f['id']] = 'follow';
				}
				elseif ($f['type'] == 2)
				{
					$verantwortliche[] = $f;
					$all[$f['id']] = 'verantwortlich';
				}
				
			}
			
			return array(
					'follow' => $normal,
					'verantwortlich' => $verantwortliche,
					'all' => $all
			);
		}
		return false;
	}
	
	public function acceptFairteiler($id)
	{
		return $this->update('
			UPDATE 	`'.PREFIX.'fairteiler`
		
			SET 	`status` = 1
		
			WHERE 	`id` = '.$this->intval($id).'
		');
	}
	
	public function updateFairteiler($id, $bezirk_id, $name, $desc, $anschrift, $plz, $ort, $lat, $lon, $picture)
	{
		$pic = '';
		if(!empty($picture))
		{
			$pic = ',
					`picture` = '.$this->strval($picture);
		}
		return $this->update('
			UPDATE 	`'.PREFIX.'fairteiler`
			
			SET 	`bezirk_id` = '.$this->strval($bezirk_id).',
					`name` = '.$this->strval($name).',
					`desc` = '.$this->strval($desc).',
					`anschrift` = '.$this->strval($anschrift).',
					`plz` = '.$this->strval($plz).',
					`ort` = '.$this->strval($ort).',
					`lat` = '.$this->strval($lat).',
					`lon` = '.$this->strval($lon).$pic.'
			
			WHERE 	`id` = '.$this->intval($id).'
		');
	}
	
	public function deleteFairteiler($id)
	{
		$this->del('
			DELETE FROM 	`'.PREFIX.'fairteiler_follower`	
			WHERE `fairteiler_id` = '.(int)$id.'
		');
		
		return $this->del('
			DELETE FROM 	`'.PREFIX.'fairteiler`	
			WHERE `id` = '.(int)$id.'	
		');
	}
	
	public function getLastUpdates($id,$count = 3)
	{
		if($update = $this->q('
			SELECT 		wp.id,
						wp.time,
						UNIX_TIMESTAMP(wp.time) AS time_ts,
						wp.body,
						wp.attach,
						fs.name AS fs_name			
					
			FROM 		fs_fairteiler_has_wallpost hw 
			LEFT JOIN 	fs_wallpost wp
			ON 			hw.wallpost_id = wp.id
				
			LEFT JOIN 	fs_foodsaver fs ON wp.foodsaver_id = fs.id

			WHERE 		hw.fairteiler_id = '.(int)$id.'
				
			ORDER BY 	time_ts DESC
			LIMIT '.$count.'
	
		'))
		{
			foreach ($update as $key => $u)
			{
				$update[$key]['images'] = false;
				if(!empty($u['attach']))
				{
					$attach = json_decode($u['attach'],true);
					if(isset($attach['image']) && !empty($attach['image']))
					{
						$update[$key]['images'] = array();
						foreach ($attach['image'] as $img)
						{
							$update[$key]['images'][] = array(
								'image' => 'images/wallpost/'.$img['file'],
								'medium' => 'images/wallpost/medium_'.$img['file'],
								'thumb' => 'images/wallpost/thumb_'.$img['file']
							);
						} 
					}
				}
			}
			return $update;
		}
		return false;
	}
	
	public function getFairteiler($id)
	{
		if($ft = $this->qRow('
			SELECT 	ft.id,
					ft.`bezirk_id`,
					ft.`name`,
					ft.`picture`,
					ft.`status`,
					ft.`desc`,
					ft.`anschrift`,
					ft.`plz`,
					ft.`ort`,
					ft.`lat`,
					ft.`lon`,
					ft.`add_date`,
					UNIX_TIMESTAMP(ft.`add_date`) AS time_ts,
					ft.`add_foodsaver`,
					fs.name AS fs_name,
					fs.nachname AS fs_nachname,
					fs.id AS fs_id	
				
			FROM 	'.PREFIX.'fairteiler ft
			LEFT JOIN
					'.PREFIX.'foodsaver fs
					
				
			ON 	ft.add_foodsaver = fs.id
			WHERE 	ft.id = '.(int)$id.'
		'))
		{
			$ft['pic'] = false;
			if(!empty($ft['picture']))
			{
				$ft['pic'] = array(
						'thumb' => 'images/'.str_replace('/', '/crop_1_60_', $ft['picture']),
						'head' => 'images/'.str_replace('/', '/crop_0_528_', $ft['picture']),
						'orig' => 'images/'.($ft['picture'])
				);
				
			}
			
			return $ft;
		}
		
		return false;
	}
	
	public function addFairteiler(
			$bezirk_id,
			$name,
			$desc,
			$anschrift,
			$plz,
			$ort,
			$lat,
			$lon,
			$picture = '',
			$status = 1
	)
	{
		if($ftid =  $this->insert('
			INSERT INTO 	`'.PREFIX.'fairteiler`
			(
				`bezirk_id`,
				`name`,
				`picture`,
				`status`,
				`desc`,
				`anschrift`,
				`plz`,
				`ort`,
				`lat`,
				`lon`,
				`add_date`,
				`add_foodsaver`
			)
			VALUES
			(
				'.$this->intval($bezirk_id).',
				'.$this->strval($name).',
				'.$this->strval($picture).',
				'.$this->intval($status).',
				'.$this->strval($desc).',
				'.$this->strval($anschrift).',
				'.$this->strval($plz).',
				'.$this->strval($ort).',
				'.$this->strval($lat).',
				'.$this->strval($lon).',
				NOW(),
				'.$this->intval(fsId()).'
			)
		'))
		{
			$this->insert('
				REPLACE INTO `'.PREFIX.'fairteiler_follower`
				(
					`fairteiler_id`,
					`foodsaver_id`,
					`type`
				)
				VALUES
				(
					'.(int)$ftid.',
					'.(int)fsId().',
					2
				)
			');
			return $ftid;
		}
	}
}
