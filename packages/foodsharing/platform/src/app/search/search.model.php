<?php
class SearchModel extends Model
{
	/**
	 * Searches the given term in the database of regions, foodsavers and companies
	 *
	 * @param string $q Query string / search term
	 * @return array Array of regions, foodsavers and comanies containing the search term
	 */
	public function search($q)
	{
		$out = array();
	
		$children = false;
		if(!isBotschafter() && !isOrgaTeam())
		{
			$children = $this->getChildBezirke($this->getCurrentBezirkId());
		}
	
		$teaser = 'stadt';
		if(S::may('orga'))
		{
			$teaser = 'IF(`photo_public` BETWEEN 1 AND 3, CONCAT(`anschrift`,", ",`plz`," ",`stadt`), "")';
		}
		if($res = $this->searchTable('foodsaver', array('name','nachname','plz','stadt'), $q,array(
				'name' => 'CONCAT(`name`," ",`nachname`)',
				'click' => 'CONCAT("profile(",`id`,");")',
				'teaser' => $teaser
		
		),$children))
		{
			$out['foodsaver'] = $res;
		}
		
		if($res = $this->searchTable('bezirk', array('name'), $q,array(
				'name' => '`name`',
				'click' => 'CONCAT("goTo(\'/?page=bezirk&bid=",`id`,"\');")',
				'teaser' => 'CONCAT("")'
		
		)))
		{
			$out['bezirk'] = $res;
		}
	
		if($res = $this->searchTable('betrieb', array('name','stadt','plz','str'), $q,array(
				'name' => '`name`',
				'click' => 'CONCAT("betrieb(",`id`,");")',
				'teaser' => 'CONCAT(`str`,", ",`plz`," ",`stadt`)'
	
		),$children))
		{
			$out['betrieb'] = $res;
		}
	
		return $out;
	}
	
	public function searchTable($table,$fields,$query,$show = array(),$childs = false)
	{
		$q = trim($query);
	
	
		str_replace(array(',',';','+','.'), ' ', $q);
	
		do
		{
			$q = str_replace('  ', ' ', $q);
		}
		while(strpos($q, '  ') !== false);
	
	
	
		$terms = explode(' ', $q);
	
		foreach ($terms as $i => $t)
		{
			$terms[$i] = $this->strval('%'.$t.'%');
		}
	
		$fsql = 'CONCAT('.implode(',', $fields).')';
	
		$fs_sql = '';
		if($childs !== false)
		{
			$fs_sql = ' AND bezirk_id IN('.implode(',', $childs).')';
		}
	
		return $this->q('
			SELECT 	`id`,
					 '.$show['name'].' AS name,
					 '.$show['click'].' AS click,
					 '.$show['teaser'].' AS teaser
	
		
			FROM 	'.PREFIX.$table.'
	
			WHERE '.$fsql.' LIKE '.implode(' AND '.$fsql.' LIKE ', $terms).'
			'.$fs_sql.'
	
			ORDER BY `name`
				
			LIMIT 0,10
			
		');
	}
}