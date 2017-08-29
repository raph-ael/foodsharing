<?php
class MigrateModel extends ConsoleModel
{
	function __construct() {
		parent::__construct();
		global $g_dbclean;
		$g_dbclean['mysqli']->set_charset('utf8');
	}

	public function getOldConvDates($recip1,$recip2)
	{
		return $this->qRow('
			SELECT 
				MIN( time ) AS min, 
				MAX( time ) AS max
				
			FROM 
				fs_message
				
			WHERE (
				recip_id = '.$recip1.'
				AND sender_id = '.$recip2.'
			)
			OR (
				recip_id = '.$recip2.'
				AND sender_id = '.$recip1.'
			)		
		');
	}
	
	public function addMsg($conversation_id,$user_id,$body,$time)
	{
		return $this->insert('INSERT INTO `fs_msg`(`conversation_id`, `foodsaver_id`, `body`, `time`) VALUES ('.(int)$conversation_id.','.(int)$user_id.','.$this->strval($body).','.$this->dateval($time).')');
	}
	
	public function connectUser($conversation_id,$recip1,$recip2,$unread)
	{
		return $this->insert('
				REPLACE INTO `fs_foodsaver_has_conversation`(`foodsaver_id`, `conversation_id`, `unread`) 
				VALUES 
				('.(int)$recip1.','.(int)$conversation_id.','.(int)$unread.'),
				('.(int)$recip2.','.(int)$conversation_id.','.(int)$unread.')');
	}
	
	public function listOldMessages($recip1,$recip2)
	{
		return $this->q('
			SELECT 
				id, 
				msg, 
				sender_id,
				`time`,
				unread
				
			FROM 
				`fs_message`
			WHERE (
				recip_id = '.$recip1.'
				AND sender_id = '.$recip2.'
			)
			OR (
				recip_id = '.$recip2.'
				AND sender_id = '.$recip1.'
			)
				
			ORDER BY id		
		');
	}
	
	public function listOldConversations()
	{
		if($convs = $this->q('
			SELECT 
				DISTINCT CONCAT( `sender_id` ,":", `recip_id` ), 
				sender_id, 
				recip_id
				
			FROM 
				fs_message
				
			WHERE 
				sender_id != 0 
				
			AND 
				recip_id != 0
				
			AND 
				recip_id != sender_id
				
			ORDER BY 
				sender_id, recip_id		
		'))
		{
			$out = array();
			foreach ($convs as $c)
			{
				$recip = array(
					$c['sender_id'] => $c['sender_id'],
					$c['recip_id'] => $c['recip_id']
				);
				
				ksort($recip);
				$out[implode(':',$recip)] = $recip;
			}
			
			return $out;
		}
	}
	
	public function getConversationId($recip1,$recip2)
	{
		$recips = array(
			$recip1 => $recip1,
			$recip2 => $recip2
		);
	
		/*
		 * make sure the order of this array
		*/
		ksort($recips);
	
		$conversation_id = false;
	
		/*
		 * First we want to check is there allready an conversation with exacly those user_ids stored in $recips array
		*/
		if($conv = $this->qRow('
			SELECT
				conversation_id,
				GROUP_CONCAT(foodsaver_id ORDER BY foodsaver_id SEPARATOR ":") AS idstring
	
			FROM
				fs_foodsaver_has_conversation
	
			GROUP BY
				conversation_id
	
			HAVING
	
				idstring = "' . implode(':',$recips).'"'))
		{
			$conversation_id = $conv['conversation_id'];
		}
	
		/*
		 * If we dont have an existing conversation create a new one
		*/
		if(!$conversation_id)
		{
			$conversation_id = $this->insertConversation($recips);
		}
	
		$mid = 0;
	
		$member = $this->listConversationMembers($conversation_id);
	
		/*
		 * UPDATE conversation
		*/
		$this->update('
			UPDATE
				`'.PREFIX.'conversation`
		
			SET
				`member` = '.$this->strval(serialize($member)).'
		
			WHERE
				`id` = '.(int)$conversation_id.'
		');
	
		return $conversation_id;
	}
	
	public function updateConversation($conversation_id,$start,$last,$last_foodsaver_id,$last_message,$last_message_id)
	{
		$this->update('
			UPDATE
				`'.PREFIX.'conversation`
		
			SET
				`start` = '.$this->dateval($start).',
				`last`= '.$this->dateval($last).',
				`last_message` = '.$this->strval($last_message).',
				`last_message_id` = '.(int)$last_message_id.'
		
			WHERE
				`id` = '.(int)$conversation_id.'
		');
	}
	
	public function listConversationMembers($conversation_id)
	{
		return $this->q('
			SELECT
				fs.id,
				fs.name,
				fs.photo,
				fs.email,
				fs.geschlecht
	
			FROM
				`'.PREFIX.'foodsaver_has_conversation` hc,
				`'.PREFIX.'foodsaver` fs
	
			WHERE
				hc.foodsaver_id = fs.id
	
			AND
				hc.conversation_id = '.(int)$conversation_id.'
		');
	}
	
	public function insertConversation($recipients)
	{
		/*
		 * first get one new conversation
		*/
	
		$sql = 'INSERT INTO `'.PREFIX.'conversation`
			(
				`start`,
				`last`,
				`last_foodsaver_id`,
				`start_foodsaver_id`
			)
			VALUES (NOW(),NOW(),0,0)';
	
		if(($cid = $this->insert($sql)) > 0)
		{
			/*
			 * last add all recipients to this conversation
			*/
			$values = array();
			foreach ($recipients as $r)
			{
				$values[] = '('.(int)$r.','.(int)$cid.',1)';
			}
				
			$this->insert('
				INSERT INTO
					`'.PREFIX.'foodsaver_has_conversation` (`foodsaver_id`, `conversation_id`, `unread`)
			
				VALUES
					'.implode(',', $values).'
			');
				
			return $cid;
		}
	}
}
