<?php
class GeocleanModel extends Model
{
	public function getFsWithoutGeo()
	{
		return $this->q('
			SELECT 	`name`,`nachname`,`photo`,`id`,`anschrift`,`plz`,`stadt`
			FROM 	`'.PREFIX.'foodsaver`
			WHERE 	rolle > 0
			AND (
				CHAR_LENGTH(`lat`) < 3 OR CHAR_LENGTH(`lon`) < 3
				OR
				(
					`lat` = "50.05478727164819"
					AND
					`lon` = "10.3271484375"
				)
			)
		');
	}
	
	public function updateGeo($id,$lat,$lon)
	{
		return $this->update('
				
				UPDATE `'.PREFIX.'foodsaver`
				
				SET 	`lat` = '.$this->strval($lat).',
						`lon` = '.$this->strval($lon).'
				
				WHERE `id` = '.(int)$id);
	}
}