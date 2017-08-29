<?php
class Model extends ManualDb
{
	public function mayBezirk($bid)
	{
		if(isset($_SESSION['client']['bezirke'][$bid]) || isBotschafter() || isOrgaTeam())
		{
			return true;
		}
		return false;
	}
	
	public function getContent($id)
	{
		if($cnt = $this->qRow('
			SELECT 	`title`,`body` FROM '.PREFIX.'content WHERE `id` = '.(int)$id.'		
		'))
		{
			return $cnt;
		}
		return false;
	}
	
	public function getBezirke()
	{
		if(isset($_SESSION['client']['bezirke']) && is_array($_SESSION['client']['bezirke']))
		{
			return $_SESSION['client']['bezirke'];
		}
	}
	
	public function buddyStatus($fsid)
	{
		if(($status = $this->qOne('SELECT `confirmed` FROM '.PREFIX.'buddy WHERE `foodsaver_id` = '.(int)fsId().' AND `buddy_id` = '.(int)$fsid.'')) !== false)
		{
			return $status;
		}
		
		return -1;
	}
	
	public function buddyRequest($fsid)
	{
		$this->insert('
			REPLACE INTO `'.PREFIX.'buddy`(`foodsaver_id`, `buddy_id`, `confirmed`)
			VALUES ('.(int)fsId().','.(int)$fsid.',0)
		');
		return true;
	}
	
	public function confirmBuddy($fsid)
	{
		$this->insert('
			REPLACE INTO `'.PREFIX.'buddy`(`foodsaver_id`, `buddy_id`, `confirmed`)
			VALUES ('.(int)fsId().','.(int)$fsid.',1)
		');
		$this->insert('
			REPLACE INTO `'.PREFIX.'buddy`(`foodsaver_id`, `buddy_id`, `confirmed`)
			VALUES ('.(int)$fsid.','.(int)fsid().',1)
		');
	}
	
	public function getLocation($id)
	{
		return $this->qRow('
			SELECT id, name, lat, lon, zip, city, street
			FROM  '.PREFIX.'location
			WHERE 	id = '.$this->intval($id).'
		');
	}
	
	public function addLocation($location_name, $lat, $lon, $anschrift, $plz, $ort)
 	{
 		$lat = round($lat,8);
 		$lon = round($lon,8);
 		return $this->insert('	
 			INSERT INTO '.PREFIX.'location (name, lat, lon, zip, city, street) 
 			VALUES
 			(		
 				'.$this->strval($location_name).',
 				'.$this->floatval($lat).',
 				'.$this->floatval($lon).',
 				'.$this->strval($plz).',
 				'.$this->strval($ort).',
 				'.$this->strval($anschrift).'
 			)
 		');
 	}
 	
 	public function delBells($identifier)
 	{
 		if($bells = $this->q('SELECT id FROM '.PREFIX.'bell WHERE identifier = '.$this->strval($identifier)))
 		{
 			$ids = array();
 			foreach ($bells as $b)
 			{
 				$ids[(int)$b['id']] = (int)$b['id'];
 			}
 			
 			$ids = implode(',',$ids);
 			
 			$this->del('DELETE FROM '.PREFIX.'foodsaver_has_bell WHERE bell_id IN('.$ids.')');
 			$this->del('DELETE FROM '.PREFIX.'bell WHERE id IN('.$ids.')');
 		}
 	}
 	
 	public function addBell($foodsaver_ids, $title, $body, $icon, $link_attributes, $vars, $identifier = '',$closeable = 1)
 	{
 		
 		if(!is_array($foodsaver_ids))
 		{
 			$foodsaver_ids = array($foodsaver_ids);
 		}
 		
 		if($link_attributes !== false)
 		{
 			$link_attributes = serialize($link_attributes);
 		}
 		
 		if($vars !== false)
 		{
 			$vars = serialize($vars);
 		}
 		
 		if($bid = $this->insert('INSERT INTO `'.PREFIX.'bell`(`name`, `body`, `vars`, `attr`, `icon`, `identifier`,`time`,`closeable`) VALUES ('.$this->strval($title).','.$this->strval($body).','.$this->strval($vars).','.$this->strval($link_attributes).','.$this->strval($icon).','.$this->strval($identifier).',NOW(),'.(int)$closeable.')'))
 		{
 			$values = array();
 			foreach ($foodsaver_ids as $id)
 			{
 				if(is_array($id))
 				{
 					$id = $id['id'];
 				}
 				
 				$values[] = '('.(int)$id.','.(int)$bid.',0)';
 			}
 			
 			return $this->insert('INSERT INTO `'.PREFIX.'foodsaver_has_bell`(`foodsaver_id`, `bell_id`, `seen`) VALUES '.implode(',', $values));
 		}
 		
 		return false;
 	}
 	
 	public function updateSleepMode($status,$from,$to,$msg)
 	{
 		return $this->update('
 			UPDATE 
 				'.PREFIX.'foodsaver 
 				
 			SET	
 				`sleep_status` = '.(int)$status.',
 				`sleep_from` = '.$this->dateval($from).',
 				`sleep_until` = '.$this->dateval($to).',
 				`sleep_msg` = '.$this->strval($msg).'

 			WHERE 
 				id = '.(int)fsId().'
 		');
 	}
 	
 	public function message($recip_id, $foodsaver_id, $message, $unread = 1)
 	{
 		$model = loadModel('msg');
 		
 		$recd = 0;
 		if($unread == 0)
 		{
 			$recd = 1;
 		}
 		else
 		{
 			$unread = 1;
 		}
 		
 		if($conversation_id = $model->user2conv($recip_id))
		{
			return $model->sendMessage($conversation_id,$message);
		}
		return false;
 	}
 	
 	public function getRealBezirke()
 	{
 		if($bezirks = $this->getBezirke())
 		{
 			$out = array();
 			foreach ($bezirks as $b)
 			{
 				if( in_array($b['type'],array(1,2,3,9)) )
 				{
 					$out[] = $b;
 				}
 			}
 			
 			return $out;
 		}

 		return false;
 	}
}
