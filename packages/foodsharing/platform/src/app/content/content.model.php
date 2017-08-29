<?php
class ContentModel extends Model
{
	public function listFaq($cat_ids)
	{	
		return $this->q('
			SELECT 
				`id`,
				`name`,
				`answer`

			FROM 
				'.PREFIX.'faq
				
			WHERE 
				`faq_kategorie_id` IN('.implode(',',$cat_ids).')
		');
	}
}