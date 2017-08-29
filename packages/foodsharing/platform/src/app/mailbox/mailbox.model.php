<?php
class MailboxModel extends Model
{
	public function getMailboxId($mb_name)
	{
		return $this->qOne('
			SELECT id FROM '.PREFIX.'mailbox WHERE `name` = '.$this->strval($mb_name).'	
		');
	}
	
	public function mailboxActivity($mid)
	{
		return $this->update('UPDATE '.PREFIX.'mailbox SET last_access = NOW() WHERE id = '.(int)$mid);
	}
	
	public function addContact($email)
	{
		$id = $this->qOne('
			SELECT 	`id` FROM  '.PREFIX.'contact WHERE `email` = '.$this->strval($email).'
		');
		
		if(!$id)
		{
			$id = $this->insert('
				INSERT INTO '.PREFIX.'contact
				(`email`)
				VALUES
				('.$this->strval($email).')	
			');
		}
		if((int)$id > 0)
		{
			$this->insert('
				INSERT IGNORE INTO  `'.PREFIX.'foodsaver_has_contact`
				(`foodsaver_id`,`contact_id`)
				VALUES
				('.(int)fsId().','.(int)$id.')
			');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getMailAdresses()
	{
		$mails = $this->qCol('
			SELECT 	CONCAT(mb.name,"@'.DEFAULT_HOST.'")
			FROM 	'.PREFIX.'mailbox mb,
					'.PREFIX.'bezirk bz
			WHERE 	bz.mailbox_id = mb.id
		');
		
		if($contacts = $this->qCol('
			SELECT 	c.`email`
			FROM 	'.PREFIX.'contact c,
					'.PREFIX.'foodsaver_has_contact fc
			WHERE 	fc.contact_id = c.id
			AND 	fc.foodsaver_id = '.(int)fsId().'
		'))
		{
			$mails = array_merge($mails,$contacts);
		}
		
		return $mails ? $mails : array();
	}
	
	public function addMailbox($name,$member = 0)
	{
		return $this->insert('
			INSERT INTO `'.PREFIX.'mailbox`
			(`name`,`member`)
			VALUES
			('.$this->strval($name).','.(int)$member.')		
		');
	}
	
	public function getNewCount($boxes)
	{
		$barr = array();
		foreach($boxes as $b)
		{
			$barr[] = $b['id'];
		}
		
		return $this->q('
			SELECT 	COUNT(`mm`.id) AS count,
					mb.name,
					mb.id
				
			FROM 	`'.PREFIX.'mailbox` mb,
					`'.PREFIX.'mailbox_message` mm

			WHERE 	mm.mailbox_id = mb.id
			AND 	mb.id IN('.implode(',', $barr).')
			AND 	mm.read = 0
				
			GROUP BY mm.mailbox_id
		');
		
	}
	
	public function setAnswered($message_id)
	{
		$message_id_id = (int)$message_id;
		if($mb_id = $this->getVal('mailbox_id', 'mailbox_message', $message_id))
		{
			if($this->mayMailbox($mb_id))
			{
				return $this->update('
					UPDATE 	`'.PREFIX.'mailbox_message`
					SET `answer` = 1
					WHERE `id` = '.(int)$message_id.'
				');
			}
		}
		
		return false;
	}
	
	public function mayMessage($mid)
	{
		if($mailbox_id = $this->getVal('mailbox_id', 'mailbox_message', $mid))
		{
			return $this->mayMailbox($mailbox_id);
		}
		return false;
	}
	
	public function deleteMessage($mid)
	{
		$attach = $this->getVal('attach', 'mailbox_message', $mid);
		if(!empty($attach))
		{
			$attach = json_decode($attach,true);
			if(is_array($attach))
			{
				foreach ($attach as $a)
				{
					if(isset($a['filename']))
					{
						@unlink('data/mailattach/'.$a['filename']);
					}
				}
			}
		}
		
		return $this->del('DELETE FROM '.PREFIX.'mailbox_message WHERE id = '.(int)$mid);
		
	}
	
	public function move($mail_id,$folder)
	{
		return $this->update('UPDATE '.PREFIX.'mailbox_message SET folder = '.(int)$folder.' WHERE id = '.(int)$mail_id);
	}
	
	public function mayMailbox($mb_id,$type = false)
	{
		if($boxes = $this->getBoxes())
		{
			foreach ($boxes as $b)
			{
				if($b['id'] == $mb_id)
				{
					return true;
				}
			}
		}
		return false;
	}
	
	public function getlastMessages()
	{
		if($boxes = $this->getBoxes())
		{
			$boxids = array();
			foreach ($boxes as $b)
			{
				$boxids[] = $b['id'];
			}
				
			return $this->q('
				SELECT 	`id`,
						`subject`,
						`time`,
						UNIX_TIMESTAMP(`time`) AS time_ts,
						`sender`,
						`to`
				FROM 	'.PREFIX.'mailbox_message
				WHERE 	`mailbox_id` IN('.implode(',', $boxids).')
				AND 	`folder` = 1
					
				ORDER BY time_ts DESC
				LIMIT 	3
			
			');
		}
		
		return false;
	}
	
	public function getNewMessages()
	{
		if($boxes = $this->getBoxes())
		{
			$boxids = array();
			foreach ($boxes as $b)
			{
				$boxids[] = $b['id'];
			}
			
			return $this->q('
				SELECT 	`id`,
						`subject`,
						`time`,
						UNIX_TIMESTAMP(`time`) AS time_ts,
						`sender`,
						`to`
				FROM 	'.PREFIX.'mailbox_message
				WHERE 	`read` = 0
				AND 	`mailbox_id` IN('.implode(',', $boxids).')
			');
		}
		
		return false;
	}
	
	public function getMessage($message_id)
	{
		$mail = $this->qRow('
			SELECT 	m.`id`,
					m.`folder`,
					m.`sender`,
					m.`to`,
					m.`subject`,
					m.`time`,
					UNIX_TIMESTAMP(m.`time`) AS time_ts,
					m.`attach`,
					m.`read`,
					m.`answer`,
					m.`body`,
					m.`mailbox_id`,
					b.name AS mailbox
				
			FROM 	'.PREFIX.'mailbox_message m
				
			LEFT JOIN '.PREFIX.'mailbox b
				
			ON m.mailbox_id = b.id
				
			WHERE	m.id = '.(int)$message_id.'

		');

		if($this->mayMailbox($mail['mailbox_id']))
		{
			return $mail;
		}
		
		return false;
	}
	
	public function setRead($mail_id,$read)
	{
		return $this->update('UPDATE '.PREFIX.'mailbox_message SET `read` = '.(int)$read.' WHERE id = '.(int)$mail_id);
	}
	
	public function listMessages($mailbox_id,$folder = 'inbox')
	{
		$farray = array(
				'inbox' => 1,
				'sent' => 2,
				'trash' => 3
		);
		
		if(!isset($farray[$folder]))
		{
			return false;
		}
		
		return $this->q('
			SELECT 	`id`,
					`folder`,
					`sender`,
					`to`,
					`subject`,
					`time`,
					UNIX_TIMESTAMP(`time`) AS time_ts,
					`attach`,
					`read`,
					`answer`
			FROM 	'.PREFIX.'mailbox_message
			WHERE	mailbox_id = '.(int)$mailbox_id.'
			AND 	folder = '.(int)$farray[$folder].'
				
			ORDER BY `time` DESC
		');
	}
	
	public function saveMessage(
						$mailbox_id, // mailbox id
						$folder, // folder
						$from, // sender
						$to, // to
						$subject, // subject
						$body,
						$html,
						$time, // time,
						$attach = '', // attachements
						$read = 0,
						$answer = 0
	)
	{
		return $this->insert('
			INSERT INTO `'.PREFIX.'mailbox_message`
			(
				`mailbox_id`,
				`folder`,
				`sender`,
				`to`,
				`subject`,
				`body`,
				`body_html`,
				`time`,
				`attach`,
				`read`,
				`answer`
			)
			VALUES
			(
				'.$this->intval($mailbox_id).',
				'.$this->intval($folder).',
				'.$this->strval($from).',
				'.$this->strval($to).',
				'.$this->strval($subject).',
				'.$this->strval($body).',
				'.$this->strval($html,true).',
				'.$this->strval($time).',
				'.$this->strval($attach).',
				'.$this->intval($read).',
				'.$this->intval($answer).'
			)
		');		
	}
	
	public function getMailbox($mb_id)
	{
		if($mb = $this->getValues(array('name'), 'mailbox', $mb_id))
		{
			if($email_name = $this->qOne('SELECT CONCAT(name," ", nachname) FROM '.PREFIX.'foodsaver WHERE mailbox_id = '.(int)$mb_id))
			{
				$mb['email_name'] = $email_name;
			}
			elseif($email_name = $this->qOne('SELECT email_name FROM '.PREFIX.'bezirk WHERE mailbox_id = '.(int)$mb_id))
			{
				$mb['email_name'] = $email_name;
			}
			elseif($email_name = $this->qOne('SELECT email_name FROM '.PREFIX.'mailbox_member WHERE mailbox_id = '.(int)$mb_id.' AND email_name != "" LIMIT 1'))
			{
				$mb['email_name'] = $email_name;
			}
			else
			{
				$mb['email_name'] = '';
			}
			
			return $mb;
		}
		
		return false;
	}
	
	public function getMemberBoxes()
	{
		if($boxes = $this->q('
			SELECT 	name,
					id
					
			FROM 	`'.PREFIX.'mailbox` 

			WHERE 	member = 1
		'))
		{
			foreach ($boxes as $key => $b)
			{
				$boxes[$key]['email_name'] = '';
				if($boxes[$key]['member'] = $this->q('
					SELECT 	fs.id AS id,
							CONCAT(fs.name," ",fs.nachname) AS name,
							mm.email_name
				
					FROM 	`'.PREFIX.'mailbox_member` mm,
							`'.PREFIX.'foodsaver` fs
				
					WHERE 	mm.foodsaver_id = fs.id
					AND 	mm.mailbox_id = '.(int)$b['id'].'
				'))
				{
					foreach ($boxes[$key]['member'] as $mm)
					{
						if(!empty($mm['email_name']))
						{
							$boxes[$key]['email_name'] = $mm['email_name'];
						}
					}
					
				}
			}
			return $boxes;
		}
		
		return false;
	}
	
	public function updateMember($mbid,$foodsaver)
	{
		global $g_data;
		if((int)$mbid > 0)
		{
			$this->del('
				DELETE FROM `'.PREFIX.'mailbox_member`
				WHERE mailbox_id = '.(int)$mbid.'		
			');
			
			$insert = array();
			
			foreach ($foodsaver as $fs)
			{
				$insert[] = '('.(int)$mbid.','.(int)$fs.','.$this->strval($g_data['email_name']).')';
			}
			
			$this->insert('
				INSERT INTO `'.PREFIX.'mailbox_member`
				(`mailbox_id`,`foodsaver_id`,`email_name`)
				VALUES
				'.implode(',', $insert).'		
			');
			
			return true;
		}
		
		return false;
	}
	
	public function filterName($mb_name)
	{
		$mb_name = strtolower($mb_name);
		$mb_name = trim($mb_name);
		$mb_name = str_replace(array('ä','ö','ü','è','à','ß',' ','-','/','\\'), array('ae','oe','ue','e','a','ss','.','.','.','.'), $mb_name);
		$mb_name = preg_replace('/[^0-9a-z\.]/', '', $mb_name);
		
		if(!empty($mb_name))
		{
			return $mb_name;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Get Bezirk ids from all Member-Groups and Beziks where the user is admin
	 */
	private function getMailboxBezirkIds()
	{
		// get bezirk ids where the user is botschafter
		$bids = $this->qCol('
			SELECT
				bot.bezirk_id

			FROM
				'.PREFIX.'botschafter bot
				
			WHERE
				bot.foodsaver_id = '.(int)fsId().'
				
		');
		
		return $bids;
	}
	
	public function getBoxes()
	{
		if(isBotschafter())
		{
			$bezirke = $this->getMailboxBezirkIds();
			$bids = array();
			$mboxes = array();
			foreach ($bezirke as $b)
			{
				$bids[] = (int)$b;
			}
			
			if($bezirke = $this->q('
				SELECT 	`id`,`mailbox_id`,`name`
				FROM 	`'.PREFIX.'bezirk`
				WHERE 	`id` IN('.implode(',', $bids).')
				AND 	`mailbox_id` = 0
			'))
			{
				foreach ($bezirke as $b)
				{
					if($b['mailbox_id'] == 0)
					{
						$mb_name = strtolower($b['name']);
						$mb_name = trim($mb_name);
						$mb_name = str_replace(array('ä','ö','ü','è','à','ß',' ','-','/','\\'), array('ae','oe','ue','e','a','ss','.','.','.','.'), $mb_name);
						$mb_name = preg_replace('/[^0-9a-z\.]/', '', $mb_name);
						
						if(substr($mb_name, 0,1) != '.' && strlen($mb_name) <= 3)
						{
							continue;
						}
						
						$tmp_name = $mb_name;
						$i=0;
						$mb_id = 0;
						
						while(($mb_id = $this->insert('INSERT INTO `'.PREFIX.'mailbox`(`name`)VALUES('.$this->strval($tmp_name).')')) === false)
						{
							$i++;
							$tmp_name = $mb_name.$i;
						}
						
						if($this->update('UPDATE `'.PREFIX.'bezirk` SET mailbox_id = '.(int)$mb_id.' WHERE id = '.(int)$b['id']))
						{
							$b['mailbox_id'] = $mb_id;
						}
						
					}
				}
			}
			if($bezirke = $this->q('
				SELECT 	m.`id`,
						m.`name`,
						b.email_name,
						b.id AS bezirk_id
					
				FROM 	`'.PREFIX.'bezirk` b,
						`'.PREFIX.'mailbox` m
					
				WHERE 	b.mailbox_id = m.id
				AND 	b.`id` IN('.implode(',', $bids).')
				
			'))
			{
				foreach ($bezirke as $b)
				{
					if(empty($b['email_name']))
					{
						$b['email_name'] = 'Foodsharing '.$b['name'];
						$this->update('
								UPDATE `'.PREFIX.'bezirk` 
								SET `email_name` = '.$this->strval($b['email_name']).' 
								WHERE id = '.(int)$b['bezirk_id']
						);
					}
					$mboxes[] = array(
						'id' => $b['id'],
						'name' => $b['name'],
						'email_name' => $b['email_name'],
						'type' => 'bot'
					);
				}
			}
		}
		
		if($me = $this->getValues(array('mailbox_id','name','nachname'), 'foodsaver', fsId()))
		{
			if($me['mailbox_id'] == 0 && S::may('bieb'))
			{
				$me['name'] = explode(' ', $me['name']);
				$me['name'] = $me['name'][0];
			
				$me['nachname'] = explode(' ', $me['nachname']);
				$me['nachname'] = $me['nachname'][0];
			
				$mb_name = strtolower(substr($me['name'],0,1).'.'.$me['nachname']);
				$mb_name = trim($mb_name);
				$mb_name = str_replace(array('ä','ö','ü','è','ß',' '), array('ae','oe','ue','e','ss','.'), $mb_name);
				$mb_name = preg_replace('/[^0-9a-z\.]/', '', $mb_name);
			
				$mb_name = substr($mb_name, 0,25);
			
				$tmp_name = $mb_name;
				$i=0;
				$mb_id = 0;
			
				if(substr($tmp_name, 0,1) != '.' && strlen($tmp_name) > 3)
				{
					while(($mb_id = $this->insert('INSERT INTO `'.PREFIX.'mailbox`(`name`)VALUES('.$this->strval($tmp_name).')')) === false)
					{
						$i++;
						$tmp_name = $mb_name.$i;
					}
					
					if($this->update('UPDATE `'.PREFIX.'foodsaver` SET mailbox_id = '.(int)$mb_id.' WHERE id = '.(int)fsId()))
					{
						$me['mailbox_id'] = $mb_id;
					}
				}
			}
		}
		if($memberb = $this->q('
			SELECT 	mb.`name`,
					mb.`id`,
					mm.email_name
		
			FROM	`'.PREFIX.'mailbox` mb,
					`'.PREFIX.'mailbox_member` mm
		
			WHERE 	mm.mailbox_id = mb.id
			AND 	mm.foodsaver_id = '.(int)fsid().'
		'))
		{
			foreach ($memberb as $m)
			{
				if(empty($m['email_name']))
				{
					$m['email_name'] = $m['name'].'@'.DEFAULT_HOST;
					$this->update('UPDATE '.PREFIX.'mailbox_member SET email_name = '.$this->strval($m['name'].'@'.DEFAULT_HOST).' WHERE mailbox_id = '.(int)$m['id'].' AND foodsaver_id = '.(int)fsId());
				}
				$mboxes[] = array(
						'id' => $m['id'],
						'name' => $m['name'],
						'email_name' => $m['email_name'],
						'type' => 'member'
				);
			}
		}
			
		if($mebox = $this->qRow('
				SELECT 		m.`id`,
							m.name,
							CONCAT(fs.`name`," ",fs.`nachname`) AS email_name
				
				FROM 		`'.PREFIX.'mailbox` m,
							`'.PREFIX.'foodsaver` fs
				
				WHERE 		fs.mailbox_id = m.id
				AND 		fs.id = '.(int)fsId().'
			'))
		{
			
			$mboxes[] = array(
					'id' => $mebox['id'],
					'name' => $mebox['name'],
					'email_name' => $mebox['email_name'],
					'type' => 'fs'
			);
		}
		
		if(empty($mboxes))
		{
			return false;
		}

		return $mboxes;
	}
}
