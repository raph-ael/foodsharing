<?php
class BcardModel extends Model
{
	public function getMyData()
	{		
		$fs = $this->qRow('
			SELECT 	fs.id,
					fs.`name`,
					fs.`geschlecht`,
					fs.`nachname`,
					fs.`plz`,
					fs.`stadt`,
					fs.`anschrift`,
					fs.`telefon`,
					fs.`handy`,
					fs.email
				
			FROM 	'.PREFIX.'foodsaver fs

			WHERE 	fs.id = '.(int)fsId().'
		');
		
		if(S::may('bieb'))
		{
			if($mailbox = $this->qOne('SELECT mb.name FROM '.PREFIX.'mailbox mb, '.PREFIX.'foodsaver fs WHERE fs.mailbox_id = mb.id AND fs.id = '.(int)fsId()))
			{
				$fs['email'] = $mailbox.'@'.DEFAULT_HOST;
			}
		}
		
		$fs['bot'] = $this->q('
			SELECT 	b.name,
					b.id,
					CONCAT(mb.`name`,"@","'.DEFAULT_HOST.'") AS email,
					mb.name AS mailbox
					
			FROM 	'.PREFIX.'bezirk b,
					'.PREFIX.'mailbox mb,
					'.PREFIX.'botschafter bot
				
			WHERE 	b.mailbox_id = mb.id
			AND 	bot.bezirk_id = b.id
			AND 	bot.foodsaver_id = '.(int)fsId().'
			AND 	b.type != 7
		');
		
		$fs['fs'] = $this->q('
			SELECT 	b.name,
					b.id
			
			FROM 	'.PREFIX.'bezirk b,
					'.PREFIX.'foodsaver_has_bezirk fhb
		
			WHERE 	fhb.bezirk_id = b.id
			AND 	fhb.foodsaver_id = '.(int)fsId().'
			AND 	b.type != 7
		');
		
		return $fs;
	}
}