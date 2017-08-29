<?php
class ApiModel extends Model
{
	public function getOrgaGroups()
	{
		return $this->q('SELECT id, name, parent_id FROM '.PREFIX.'bezirk WHERE type = 7 ORDER BY parent_id');
	}

	public function allBaskets()
	{
		return $this->q('
			SELECT
				b.id AS i,
				b.lat AS a,
				b.lon AS o
			FROM
				fs_basket b
		
			WHERE
				b.status = 1
		
			AND
				b.fs_id = 0

		');
	}
	
	public function nearBaskets($lat,$lon,$distance = 50)
	{
		return $this->q('
			SELECT 	
				b.id AS i,
				b.lat AS a, 
				b.lon AS o, 
				(6371 * acos( cos( radians( '.$this->floatval($lat).' ) ) * cos( radians( b.lat ) ) * cos( radians( b.lon ) - radians( '.$this->floatval($lon).' ) ) + sin( radians( '.$this->floatval($lat).' ) ) * sin( radians( b.lat ) ) ))
				AS d
			FROM 	
				fs_basket b
				
			WHERE
				b.status = 1
				
			AND
				b.fs_id = 0
				
			HAVING 
				d <='.(int)$distance.'
		');
	}
	
	public function getBasket($id)
	{
		$basket = $this->qRow('
				SELECT
					b.id,
					b.description,
					b.picture,
					b.contact_type,
					b.tel,
					b.handy,
					b.fs_id AS fsf_id,
					b.foodsaver_id,
					b.lat,
					b.lon
	
				FROM
					'.PREFIX.'basket b
	
				WHERE
					b.id = '.(int)$id.'
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
}
