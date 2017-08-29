<?php
class BlogModel extends Model
{
	public function canEdit($article_id)
	{
		if($val = $this->getValues(array('bezirk_id','foodsaver_id'), 'blog_entry', $article_id))
		{
			if(fsId() == $val['foodsaver_id'] || isBotFor($val['bezirk_id']))
			{
				return true;
			}
		}
		return false;
	}

	public function canAdd($fsId, $bezirkId)
	{
		if(isOrgaTeam())
		{
			return true;
		}

		if(isBotFor($bezirkId))
		{
			return true;
		}

		return false;
	}

	public function getPost($id)
	{
		return $this->qRow('
			SELECT
				b.`id`,
				b.`name`,
				b.`time`,
				UNIX_TIMESTAMP(b.`time`) AS time_ts,
				b.`body`,
				b.`time`,
				b.`picture`,
				CONCAT(fs.name," ",fs.nachname) AS fs_name
	
			FROM
				`'.PREFIX.'blog_entry` b,
				`'.PREFIX.'foodsaver` fs
	
			WHERE
				b.foodsaver_id = fs.id
	
			AND
				b.`active` = 1
	
			AND
				b.id = '.(int)$id);
	}
	
	public function listNews($page)
	{
		$page = ((int)$page-1)*10;
		
		return $this->q('
			SELECT 	 	
				b.`id`,
				b.`name`,
				b.`time`,
				UNIX_TIMESTAMP(b.`time`) AS time_ts,
				b.`active`,
				b.`teaser`,
				b.`time`,
				b.`picture`,
				CONCAT(fs.name," ",fs.nachname) AS fs_name
		
			FROM 
				`'.PREFIX.'blog_entry` b,
				`'.PREFIX.'foodsaver` fs
		
			WHERE 
				b.foodsaver_id = fs.id
				
			AND
				b.`active` = 1
		
			ORDER BY 
				b.`id` DESC
				
			LIMIT '.$page.',10');
	}
	
	public function listArticle()
	{
		$not = '';
		if(!isOrgaTeam())
		{
			$not = 'WHERE 		`bezirk_id` IN ('.implode(',', $this->getBezirkIds()).')';
		}
		return $this->q('
			SELECT 	 	`id`,
						`name`,
						`time`,
						UNIX_TIMESTAMP(`time`) AS time_ts,
						`active`,
						`bezirk_id`
		
			FROM 		`'.PREFIX.'blog_entry`
	
			'.$not.'
	
			ORDER BY `id` DESC');
	}
	
	public function del_blog_entry($id)
	{
		return $this->del('
			DELETE FROM 	`'.PREFIX.'blog_entry`
			WHERE 			`id` = '.$this->intval($id).'
		');
	}
	
	public function getOne_blog_entry($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`bezirk_id`,
			`foodsaver_id`,
			`active`,
			`name`,
			`teaser`,
			`body`,
			`time`,
			UNIX_TIMESTAMP(`time`) AS time_ts,
			`picture`
			
			FROM 		`'.PREFIX.'blog_entry`
			
			WHERE 		`id` = ' . $this->intval($id));

		return $out;
	}
	
	public function add_blog_entry($data)
	{
		$active = 0;
		if(isOrgateam())
		{
			$active = 1;
		}
		elseif (isBotFor($data['bezirk_id']))
		{
			$active = 1;
		}
		
		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'blog_entry`
			(
			`bezirk_id`,
			`foodsaver_id`,
			`name`,
			`teaser`,
			`body`,
			`time`,
			`picture`,
			`active`
			)
			VALUES
			(
			'.$this->intval($data['bezirk_id']).',
			'.$this->intval($data['foodsaver_id']).',
			'.$this->strval($data['name']).',
			'.$this->strval($data['teaser']).',
			'.$this->strval($data['body'],true).',
			'.$this->dateval($data['time']).',
			'.$this->strval($data['picture']).',
			'.$active.'
			)');
	
		
		$foodsaver = array();
		$orgateam = $this->getOrgateam();
		$botschafter = $this->getBotschafter($data['bezirk_id']);
		
		foreach ($orgateam as $o)
		{
			$foodsaver[$o['id']] = $o;
		}
		foreach ($botschafter as $b)
		{
			$foodsaver[$b['id']] = $b;
		}
		
		$this->addBell(
			$foodsaver,
			'blog_new_check_title',
			'blog_new_check',
			'fa fa-bullhorn',
			array( 'href'=>'/?page=blog&sub=edit&id='.$id),
			array( 
				'user' => S::user('name'), 
				'teaser'=> tt($data['teaser'],100), 
				'title' => $data['name']
			),
			'blog-check-'.$id
		);

		return $id;
	}
}
