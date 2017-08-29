<?php
class WallpostModel extends Model
{
	private $table;
	private $id;
	
	public function setTable($table,$id)
	{
		$this->table = $table;
		$this->id = $id;
	}
	
	public function delpost($post_id)
	{
		$this->del('
				DELETE FROM `'.PREFIX.$this->table.'_has_wallpost`
				WHERE 	wallpost_id = '.(int)$post_id.'
		');
		return $this->del('
				DELETE FROM `'.PREFIX.'wallpost`
				WHERE 	id = '.(int)$post_id.'
		');
	}
	
	public function getLastPosts()
	{
		$wp = false;
		if($wp = $this->q('
			SELECT 	p.id,
					p.`body`, 
					p.`time`, 
					UNIX_TIMESTAMP(p.`time`) AS time_ts,
					p.`attach`,		
					fs.id AS foodsaver_id,
					fs.`name`,
					fs.`nachname`,
					fs.`photo`
				
			FROM 	`'.PREFIX.'wallpost` p,
					`'.PREFIX.$this->table.'_has_wallpost` hp,
					`'.PREFIX.'foodsaver` fs
				
			WHERE 	p.foodsaver_id = fs.id
			AND 	hp.wallpost_id = p.id
			AND 	hp.`'.$this->table.'_id` = '.(int)$this->id.'
				
			ORDER BY p.time DESC
				
			LIMIT 30
		'))
		{
			foreach($wp as $key => $w)
			{
				if(!empty($w['attach']))
				{
					$data = json_decode($w['attach'],true);
					if(isset($data['image']))
					{
						$gallery = array();
						foreach ($data['image'] as $img)
						{
							$gallery[] = array(
									'image' => 'images/wallpost/'.$img['file'],
									'medium' => 'images/wallpost/medium_'.$img['file'],
									'thumb' => 'images/wallpost/thumb_'.$img['file']
							);
						}
						$wp[$key]['gallery'] = $gallery;
					}
				}
			}
		}
		
		
		return $wp;
	}
	
	public function getLastPostId()
	{
		return $this->qOne('
			SELECT 	MAX(id) 
			FROM 	`'.PREFIX.'wallpost` wp,
					`'.PREFIX.$this->table.'_has_wallpost` hp
			WHERE 	hp.wallpost_id = wp.id
			AND 	hp.`'.$this->table.'_id` = '.(int)$this->id.'
		');
	}
	
	public function post($message,$attach = '')
	{
		$post_id = $this->insert('
			INSERT INTO 	`'.PREFIX.'wallpost`
			(
				`foodsaver_id`, 
				`body`, 
				`time`, 
				`attach`
			) 
			VALUES 
			(
				'.(int)fsId().',
				'.$this->strval($message).',
				NOW(),
				'.$this->strval($attach).'
			)');
		$this->insert('
			INSERT INTO `'.PREFIX.$this->table.'_has_wallpost`
			(
				`'.$this->table.'_id`, 
				`wallpost_id`
			) 
			VALUES 
			(
				'.(int)$this->id.',
				'.(int)$post_id.'
			)	
		');
		return $post_id;
	}

	public function getFsByPost($post_id) {
		return $this->getVal('foodsaver_id', 'wallpost', $post_id);
	}
}
