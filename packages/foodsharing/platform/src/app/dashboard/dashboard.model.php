<?php
class DashboardModel extends Model
{
	public function getUser()
	{
		return $this->qRow('
			SELECT 
				`id`,
				`name`,
				rolle,
				TIMESTAMP(last_login) AS last_login_ts,
				sleep_status,
				photo,
				stat_fetchweight,
				lat,
				lon
				
			FROM
				'.PREFIX.'foodsaver 
				
			WHERE 
				id = '.(int)fsId().'
		');
	}
	
	public function getNewestFoodbaskets($limit = 10)
	{
		return $this->q('
	
			SELECT
				b.id,
				b.`time`,
				UNIX_TIMESTAMP(b.`time`) AS time_ts,
				b.description,
				b.picture,
				b.contact_type,
				b.tel,
				b.handy,
				b.fs_id AS fsf_id,
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo
	
			FROM
				'.PREFIX.'basket b,
				'.PREFIX.'foodsaver fs
	
			WHERE
				b.foodsaver_id = fs.id
			AND
				b.status = 1
	
			ORDER BY
				id DESC
	
			LIMIT
				0,'.$limit.'
	
		');
	}
	
	public function listCloseBaskets($distance = 50)
	{
		$loc = S::getLocation();
		return $this->q('
			SELECT
				b.id,
				b.time,
				UNIX_TIMESTAMP(b.`time`) AS time_ts,
				b.picture,
				b.description,
				b.lat,
				b.lon,
				(6371 * acos( cos( radians( '.$this->floatval($loc['lat']).' ) ) * cos( radians( b.lat ) ) * cos( radians( b.lon ) - radians( '.$this->floatval($loc['lon']).' ) ) + sin( radians( '.$this->floatval($loc['lat']).' ) ) * sin( radians( b.lat ) ) ))
				AS distance,
				fs.name AS fs_name
			FROM
				fs_basket b,
				'.PREFIX.'foodsaver fs
	
			WHERE
				b.foodsaver_id = fs.id
				
			AND
				b.status = 1
	
			AND
				foodsaver_id != '.(int)fsId().'
		
			HAVING
				distance <='.(int)$distance.'
	
			ORDER BY
				distance ASC
	
			LIMIT 6
		');
	}
}