<?php
class TeamModel extends Model
{
	public function getTeam($bezirkId = 1373)
	{
		$out = array();
		if($orgas =  $this->q('
				SELECT 
					fs.id, 
					CONCAT(mb.name,"@'.DEFAULT_HOST.'") AS email, 
					fs.name,
					fs.nachname,
					fs.photo,
					fs.about_me_public AS `desc`,
					fs.rolle,
					fs.geschlecht,
					fs.homepage,
					fs.github,
					fs.tox,
					fs.twitter,
					fs.position,
					fs.contact_public
				
				FROM 
					'.PREFIX.'foodsaver_has_bezirk hb

				LEFT JOIN
					'.PREFIX.'foodsaver fs
				ON
					hb.foodsaver_id = fs.id
				
				LEFT JOIN
					'.PREFIX.'mailbox mb 
				ON 
					fs.mailbox_id = mb.id

				WHERE 
					hb.bezirk_id = '.$bezirkId.'
				ORDER BY fs.name
		'))
		{
			foreach ($orgas as $o)
			{
				$out[(int)$o['id']] = $o;
			}
			
			
		}
		
		return $out;
	}
	
	public function getUser($id)
	{
		if($user = $this->qRow('
                    SELECT
                        fs.id,
				CONCAT(fs.name," ",fs.nachname) AS name,
                        fs.about_me_public AS `desc`,
                        fs.rolle,
                        fs.geschlecht,
                        fs.photo,
                        fs.twitter,
                        fs.tox,
                        fs.homepage,
                        fs.github,
                        fs.position,
                        fs.email,
                        fs.contact_public
                    FROM
                        '.PREFIX.'foodsaver_has_bezirk fb
                    INNER JOIN '.PREFIX.'foodsaver fs ON
                        fb.foodsaver_id = fs.id
                    WHERE
                        fb.foodsaver_id = '.(int)$id.' AND(
                            fb.bezirk_id = 1564 OR fb.bezirk_id = 1565 OR fb.bezirk_id = 1373
                        )
                    LIMIT 1
		'))
		{
			$user['groups'] = $this->q('
				SELECT 
					b.id,
					b.name,
					b.type
						
				FROM 
					'.PREFIX.'botschafter bot,
					'.PREFIX.'bezirk b
						
				WHERE 
					bot.bezirk_id = b.id
						
				AND 
					bot.foodsaver_id = '.(int)$id.'
					
				AND 
					b.type = 7');
			return $user;
		}
	}
}
