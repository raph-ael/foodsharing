<?php
class BasketModel extends Model
{
	public function getBasketChoords()
	{
		return $this->q('SELECT id,lat,lon FROM fs_basket WHERE status = 1');
	}
	
	public function addBasket($desc, $pic, $tel, $contact_type, $weight, $location_type, $lat, $lon, $bezirk_id)
	{
		$appost = 1;
		
		if(isset($_REQUEST['appost']) && $_REQUEST['appost'] == 0)
		{ 
			$appost = 0;
		}
		
		return $this->insert('
			INSERT INTO `'.PREFIX.'basket`
			(
				`foodsaver_id`, 
				`status`, 
				`time`, 
				`description`, 
				`picture`,
				`tel`,
				`handy`,
				`contact_type`, 
				`location_type`, 
				`weight`,
				`lat`,
				`lon`,
				`bezirk_id`,
				`appost`,
				`until`
			) 
			VALUES 
			(
				'.(int)fsId().',
				1,
				NOW(),
				'.$this->strval($desc).',
				'.$this->strval($pic).',
				'.$this->strval($tel['tel']).',
				'.$this->strval($tel['handy']).',
				'.$this->strval($contact_type).',
				'.(int)$location_type.',
				'.$this->floatval($weight).',
				'.$this->floatval($lat).',
				'.$this->floatval($lon).',
				'.(int)$bezirk_id.',
				'.(int)$appost.',
				"' . date('Y-m-d',(time()+1209600)) . '"
				
			)		
		');
	}
	
	public function getBasket($id,$status = false)
	{
		$status_sql = '';
		
		if($status !== false)
		{
			$status_sql = 'AND `status` = '.(int)$status;
		}
		
		$basket = $this->qRow('

			SELECT
				b.id,
				b.status,
				b.description,
				b.picture,
				b.contact_type,
				b.tel,
				b.handy,
				b.fs_id AS fsf_id,
				b.lat,
				b.lon,
				b.foodsaver_id,
				UNIX_TIMESTAMP(b.time) AS time_ts,
				UNIX_TIMESTAMP(b.until) AS until_ts,
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				fs.sleep_status
				
			FROM
				'.PREFIX.'basket b,
				'.PREFIX.'foodsaver fs
				
			WHERE 
				b.foodsaver_id = fs.id
			
			AND
				b.id = '.(int)$id.'
			'.$status_sql.'
				
		');
		
		if($basket['fsf_id'] == 0)
		{
			if($fs = $this->qRow('
				SELECT 
					fs.name AS fs_name,
					fs.photo AS fs_photo,
					fs.id AS fs_id
					
				FROM
					'.PREFIX.'foodsaver fs
					
				WHERE
					fs.id = '.(int)$basket['foodsaver_id'].'
					
			'))
			{
				$basket = array_merge($basket,$fs);
			}
		}
		
		return $basket;
	}
	
	public function addTypes($basket_id,$types)
	{
		if(!empty($types))
		{
			$sql = array();
			
			foreach ($types as $t)
			{
				$sql[] = '(' . (int)$basket_id . ','.(int)$t.')';
			}
			
			$this->insert('
				INSERT INTO `fs_basket_has_types`
				(
					`basket_id`, 
					`types_id`
				) 
				VALUES 
				'.implode(',', $sql).'
			');
		}
	}
	
	public function listRequests($basket_id)
	{
		return $this->q('
		
				SELECT
					UNIX_TIMESTAMP(a.time) AS time_ts,
					fs.name AS fs_name,
					fs.photo AS fs_photo,
					fs.id AS fs_id,
					fs.geschlecht AS fs_gender,
					fs.sleep_status,
					b.id
		
		
				FROM
					'.PREFIX.'basket_anfrage a,
					'.PREFIX.'basket b,
					'.PREFIX.'foodsaver fs
		
				WHERE
					a.basket_id = b.id
		
				AND
					a.`status` IN(0,1)
		
				AND
					a.foodsaver_id = fs.id
		
				AND
					b.foodsaver_id = '.(int)fsId().'
		
				AND
					a.basket_id = '.(int)$basket_id.'
		
				');
	}
	
	public function getRequest($basket_id,$fs_id)
	{
		return $this->qRow('
		
				SELECT
					UNIX_TIMESTAMP(a.time) AS time_ts,
					fs.name AS fs_name,
					fs.photo AS fs_photo,
					fs.id AS fs_id,
					fs.geschlecht AS fs_gender,
					b.id
		
		
				FROM
					'.PREFIX.'basket_anfrage a,
					'.PREFIX.'basket b,
					'.PREFIX.'foodsaver fs
		
				WHERE
					a.basket_id = b.id
		
				AND
					a.`status` IN(0,1)
		
				AND
					a.foodsaver_id = fs.id
		
				AND
					b.foodsaver_id = '.(int)fsId().'
				
				AND
					a.foodsaver_id = '.(int)$fs_id.'
				
				AND
					a.basket_id = '.(int)$basket_id.'
		
				');
	}
	
	public function listUpdates()
	{
		return $this->q('

			SELECT 
				UNIX_TIMESTAMP(a.time) AS time_ts,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				fs.id AS fs_id,
				fs.sleep_status,
				b.id,
				b.description
				
				
			FROM 
				'.PREFIX.'basket_anfrage a, 
				'.PREFIX.'basket b,
				'.PREFIX.'foodsaver fs
				
			WHERE 
				a.basket_id = b.id 
				
			AND 
				a.`status` IN(0,1)
				
			AND
				a.foodsaver_id = fs.id
				
			AND
				b.foodsaver_id = '.(int)fsId().'
				
			ORDER BY
				a.`time` DESC
				
		');
	}
	
	public function getUpdateCount()
	{
		$count = $this->qOne('SELECT COUNT(a.basket_id) FROM '.PREFIX.'basket_anfrage a, '.PREFIX.'basket b WHERE a.basket_id = b.id AND a.`status` = 0 AND b.foodsaver_id = '.(int)fsId());
		return (int)$count;
	}
	
	public function addArt($basket_id, $types)
	{
		if(!empty($types))
		{
			$sql = array();
				
			foreach ($types as $t)
			{
				$sql[] = '(' . (int)$basket_id . ','.(int)$t.')';
			}
				
			$this->insert('
			INSERT INTO `'.PREFIX.'basket_has_art`
			(
				`basket_id`,
				`art_id`
			)
			VALUES
				'.implode(',', $sql).'
			');
		}
	}
	
	public function removeBasket($id)
	{
		return $this->update('
			UPDATE 	`'.PREFIX.'basket`
			SET 	`status` = 3
			WHERE 	`id` = '.(int)$id.'
			AND 	`foodsaver_id` = '.(int)fsId().'		
		');
	}
	
	public function listMyBaskets()
	{
		if($baskets = $this->q('

			SELECT 
				`id`,
				`description`,
				`picture`,
				UNIX_TIMESTAMP(`time`) AS time_ts
				
			FROM 
				'.PREFIX.'basket
				
			WHERE
				`foodsaver_id` = '.(int)fsId().'
				
			AND 
				`status` = 1
				
		'))
		{
			foreach ($baskets as $key => $b)
			{
				$baskets[$key]['req_count'] = $this->qOne('SELECT COUNT(foodsaver_id) FROM '.PREFIX.'basket_anfrage WHERE basket_id = '.(int)$b['id'].' AND status < 10');
			}
			
			return $baskets;
		}
		
		return false;
	}
	
	public function follow($basket_id)
	{
		$status = $this->qOne('SELECT 1 FROM `'.PREFIX.'basket_anfrage` WHERE basket_id = '.(int)$basket_id.' AND foodsaver_id = ' . (int)fsId().' AND status <= 9');

		if(!$status)
		{
			$this->insert('
			REPLACE INTO `'.PREFIX.'basket_anfrage`
			(
				`foodsaver_id`, `basket_id`, `status`, `time`,`appost`
			)
			VALUES
			(
				'.(int)fsId().','.(int)$basket_id.',9, NOW(), 0
			)
		');
		}
	}
	
	public function setStatus($basket_id,$status,$fsid = false)
	{
		if(!$fsid)
		{
			$fsid = fsId();
		}
		
		$appost = 1;
		if(isset($_REQUEST['appost']) && $_REQUEST['appost'] == 0)
		{
			$appost = 0;
		}
		
		$this->insert('
			REPLACE INTO `'.PREFIX.'basket_anfrage`
			(
				`foodsaver_id`, `basket_id`, `status`, `time`,`appost`
			) 
			VALUES 
			(
				'.(int)$fsid.','.(int)$basket_id.','.(int)$status.', "'.date('Y-m-d H:i:s').'",'.(int)$appost.'
			)	
		');
	}
}
