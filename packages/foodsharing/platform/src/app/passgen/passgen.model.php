<?php
class PassgenModel extends Model
{
	public function updateLastGen($foodsaver)
	{
		return $this->update('
			UPDATE 	`'.PREFIX.'foodsaver`
			SET 	`last_pass` = NOW()
			WHERE 	`id` IN('.implode(',', $foodsaver).')		
		');
	}
	public function getPassFoodsaver($bezirk_id)
	{
		
		$req = $this->q('
				SELECT 	fs.`id`,
						CONCAT(fs.`name`," ",fs.`nachname`) AS `name`,
						fs.verified,
						fs.last_pass,
						fs.photo,
						UNIX_TIMESTAMP(fs.last_pass) AS last_pass_ts,
						b.name AS bezirk_name,
						b.id AS bezirk_id
				
				FROM 	'.PREFIX.'foodsaver_has_bezirk fb,
						'.PREFIX.'foodsaver fs,
						'.PREFIX.'bezirk b
				
				WHERE 	fb.foodsaver_id = fs.id
				AND 	fb.bezirk_id = b.id
				AND 	fb.`bezirk_id` IN('.implode(',',$this->getChildBezirke($bezirk_id)).')
				AND		fs.deleted_at IS NULL
				
				ORDER BY bezirk_name
		');
		
		$out = array();
		foreach($req as $r)
		{
			if(!isset($out[$r['bezirk_id']]))
			{
				$out[$r['bezirk_id']] = array
				(
					'id' => $r['bezirk_id'],
					'bezirk' => $r['bezirk_name'],
					'foodsaver' => array()
				);
			}
			$out[$r['bezirk_id']]['foodsaver'][] = $r;
		}
		return $out;
	}
}
