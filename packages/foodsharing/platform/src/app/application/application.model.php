<?php
class ApplicationModel extends Model
{
	public function getApplication($bid,$fid)
	{
		return $this->qRow('
			SELECT 	fs.`id`,
					fs.`name`,
					fs.`nachname`,
					fs.`photo`,
					fb.application,
					fb.active

			FROM 	`'.PREFIX.'foodsaver_has_bezirk` fb,
					`'.PREFIX.'foodsaver` fs
				
			WHERE 	fb.foodsaver_id = fs.id
			AND 	fb.bezirk_id = '.(int)$bid.'

			AND 	fb.foodsaver_id = '.(int)$fid.'
		');
	}
	
	public function apply($bid,$fsid)
	{
		return $this->update('
			UPDATE `'.PREFIX.'foodsaver_has_bezirk`	
			SET 	`active` = 1
			WHERE 	`bezirk_id` = '.(int)$bid.'
			AND 	`foodsaver_id` = '.(int)$fsid.'
		');
	}
	
	public function maybe($bid,$fsid)
	{
		return $this->update('
			UPDATE `'.PREFIX.'foodsaver_has_bezirk`
			SET 	`active` = 10
			WHERE 	`bezirk_id` = '.(int)$bid.'
			AND 	`foodsaver_id` = '.(int)$fsid.'
		');
	}
	
	public function noapply($bid,$fsid)
	{
		return $this->update('
			UPDATE `'.PREFIX.'foodsaver_has_bezirk`
			SET 	`active` = 20
			WHERE 	`bezirk_id` = '.(int)$bid.'
			AND 	`foodsaver_id` = '.(int)$fsid.'
		');
	}
	
	public function getBezirk($id = false)
	{
		$bezirk = $this->qRow('
			SELECT
				`id`,
				`name`,
				`email`,
				`email_name`,
				`type`,
				`stat_fetchweight`,
				`stat_fetchcount`,
				`stat_fscount`,
				`stat_botcount`,
				`stat_postcount`,
				`stat_betriebcount`,
				`stat_korpcount`
	
			FROM 	`'.PREFIX.'bezirk`
	
			WHERE 	`id` = '.(int)$id.'
			LIMIT 1
		');
	
		$bezirk['foodsaver'] = $this->q('
			SELECT 	fs.`id`,
					fs.`photo`,
					fs.`name`,
					fs.`nachname`
	
			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'foodsaver_has_bezirk` c
	
			WHERE 	c.`foodsaver_id` = fs.id
			AND 	c.bezirk_id = '.(int)$id.'
			AND 	c.active = 1
		');
	
	
		$bezirk['fs_count'] = count($bezirk['foodsaver']);
	
		$bezirk['botschafter'] = $this->q('
			SELECT 	fs.`id`,
					fs.`photo`,
					fs.`name`,
					fs.`nachname`
	
			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'botschafter` c
	
			WHERE 	c.`foodsaver_id` = fs.id
			AND 	c.bezirk_id = '.(int)$id.'
		');
	
		return $bezirk;
	}
}