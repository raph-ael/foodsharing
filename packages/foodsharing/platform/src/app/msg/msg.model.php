<?php
class MsgModel extends Model
{
	public function getBetriebname($cid)
	{
		return $this->qOne('
			SELECT name FROM '.PREFIX.'betrieb WHERE team_conversation_id = '.$cid.' or springer_conversation_id = '.$cid.'
		');
	}

	public function getChatMembers($cid)
	{
		return $this->qCol('
			SELECT fs.name FROM '.PREFIX.'foodsaver_has_conversation fc, '.PREFIX.'foodsaver fs WHERE fs.id = fc.foodsaver_id AND fc.conversation_id = '.$cid.' AND fs.deleted_at IS NULL
		');
	}

	public function user2conv($fsid)
	{
		return $this->addConversation(array($fsid=> $fsid),false);
	}

	/**
	 * Adds a new Conversation but first check if is there allready an conversation with exaclty this user_ids
	 * Does not include locked conversations as those may be automatically changed
	 *
	 * @param array $recips
	 * @param string $body
	 */
	public function addConversation($recips,$body = false,$own = true)
	{
		/*
		 * add the current user to the recipients
		 */
		if($own)
		{
			$recips[(int)fsId()] = (int)fsId();
		}

		/*
		 * make sure the order of this array
		 */
		ksort($recips);

		$conversation_id = false;

		if($cids = $this->qCol('SELECT hc.conversation_id FROM `fs_foodsaver_has_conversation` hc LEFT JOIN `fs_conversation` c ON c.id = hc.conversation_id WHERE hc.`foodsaver_id` = '.(int)fsId().' AND c.locked = 0'))
		{
			$sql = '
		SELECT
		  conversation_id,
		  GROUP_CONCAT(foodsaver_id ORDER BY foodsaver_id SEPARATOR ":") AS idstring

		FROM
		  '.PREFIX.'foodsaver_has_conversation

		WHERE
		  conversation_id IN ('. implode(',',$cids).')

		GROUP BY
		  conversation_id

		HAVING
		  idstring = "' . implode(':',$recips).'"';

			if($conv = $this->qRow($sql))
			{
				$conversation_id = $conv['conversation_id'];
			}
		}

		/*
		 * If we dont have an existing conversation create a new one
		*/
		if(!$conversation_id)
		{
			$conversation_id = $this->insertConversation($recips, false, $body !== false);
		}

		if($body !== false)
		{
			$this->sendMessage($conversation_id, $body, fsId());
		}

		return $conversation_id;
	}

	/**
	 * Renames an Conversation
	 */
	public function renameConversation($cid,$name)
	{
		return $this->update('UPDATE '.PREFIX.'conversation SET name = '.$this->strval($name).' WHERE id = '.(int)$cid);
	}

	public function conversationLocked($cid)
	{
		$res = $this->qOne('SELECT locked FROM '.PREFIX.'conversation WHERE id = '.(int)$cid);
		return $res;
	}

	public function updateConversation($cid,$last_fs_id,$body,$last_message_id)
	{
		return $this->update('
				UPDATE
					`'.PREFIX.'conversation`

				SET
					`last` = NOW(),
					`last_foodsaver_id` = '.(int)$last_fs_id.',
					`last_message` = '.$this->strval($body).',
					`last_message_id` = '.(int)$last_message_id.'

				WHERE
					`id` = '.(int)$cid.'
		');
	}

	public function findConnectedPeople($term)
	{
		$out = array();

		// for orga and bot-welcome team, allow to contact everyone who is foodsaver
		if(S::may('orga') || (isset($_SESSION['client']['bezirke']) && is_array($_SESSION['client']['bezirke']) && in_array(813, $_SESSION['client']['bezirke'])))
		{
			$sql = '
				SELECT fs.id AS id,
						CONCAT(fs.name," ",fs.nachname ) as value
				FROM
					'.PREFIX.'foodsaver fs
				WHERE
					fs.rolle >= 1
				AND
					CONCAT(fs.name," ",fs.nachname ) LIKE "%'.$this->safe($term).'%"
				GROUP BY
					fs.id
				';
			if($user = $this->q($sql))
			{
				$out = array_merge($out,$user);
			}

		} elseif(isset($_SESSION['client']['bezirke']) && is_array($_SESSION['client']['bezirke']) && count($_SESSION['client']['bezirke'] > 0))
		{
		// add user in bezirk and groups
			$ids = array();
			foreach ($_SESSION['client']['bezirke'] as $i => $bezirk)
			{
				$ids[] = $bezirk['id'];
			}

			$sql = '
				SELECT
					DISTINCT fs.id AS id,
					CONCAT(fs.name," ",fs.nachname ) AS value

				FROM
					'.PREFIX.'foodsaver fs,
					'.PREFIX.'foodsaver_has_bezirk hb

				WHERE
					hb.foodsaver_id = fs.id

				AND
					hb.bezirk_id IN('.implode(',', $ids).')

				AND
					CONCAT(fs.name," ",fs.nachname ) LIKE "%'.$this->safe($term).'%"
				AND
					fs.deleted_at IS NULL
			';

			if($user = $this->q($sql))
			{
				$out = array_merge($out,$user);
			}
		}

		return $out;
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
				`'.PREFIX.'foodsaver_has_conversation` hc
			INNER JOIN
				`'.PREFIX.'foodsaver` fs ON fs.id = hc.foodsaver_id

			WHERE
				hc.conversation_id = '.(int)$conversation_id.' AND
				fs.deleted_at IS NULL
		');
	}

	public function wantMsgEmailInfo($foodsaver_id)
	{
		/*
		 * only send email if the user is not online
		 */
		if(!$this->isActive($foodsaver_id))
		{
			if(Mem::get('infomail_message_'.$foodsaver_id))
			{
				return true;
			}
		}

		return true;
	}

	/**
	 * Method returns an array of all conversation from the user
	 *
	 * @return Ambigous <boolean, array >
	 */
	public function listConversations($limit = '')
	{
		if($limit != '')
		{
			$limit = ' LIMIT 0,'.(int)$limit;
		}

		if($convs = $this->q('
			SELECT
				c.`id`,
				c.`last`,
				UNIX_TIMESTAMP(c.`last`) AS last_ts,
				c.`member`,
				c.`last_message`,
				c.`last_foodsaver_id`,
				hc.unread,
				c.name

			FROM
				'.PREFIX.'conversation c,
				`'.PREFIX.'foodsaver_has_conversation` hc

			WHERE
				hc.conversation_id = c.id

			AND
				hc.foodsaver_id = '.(int)fsId().'

			ORDER BY 
				hc.unread DESC,
				c.`last` DESC
			'.$limit.'
		'))
		{

			for($i=0;$i<count($convs);$i++)
			{
				$member = @unserialize($convs[$i]['member']);
				// unserialize error handling
				if($member === false){
					$this->updateDenormalizedConversationData($convs[$i]['id']);
				}
				$convs[$i]['member'] = $member;
			}
			return $convs;
		}
		return false;
	}

	/**
	 * check if there are unread messages in conversation give back the conversation ids
	 *
	 * @return Ambigous <boolean, array >
	 */
	public function checkConversationUpdates()
	{
		/*
		 * for more speed check the memcache first
		 */

		/*
		 * Memcache var is settet but no updates
		 */
		$cache = Mem::user(fsId(),'msg-update');

		if($cache === 0)
		{
			return false;
		}
		else if(is_array($cache))
		{
			Mem::userSet(fsId(), 'msg-update', 0);
			return $cache;
		}

		/*
		 * Memcache is not settedso get coonversation ids direct fromdm
		 */
		else
		{
			Mem::userSet(fsId(), 'msg-update', 0);
			return $this->getUpdatedConversationIds();
		}
	}

	private function getUpdatedConversationIds()
	{
		return $this->qCol('SELECT conversation_id FROM '.PREFIX.'foodsaver_has_conversation WHERE foodsaver_id = '.(int)fsId().' AND unread = 1');
	}

	public function chatHistory($conversation_id)
	{
		if($conversation_id > 0)
		{
			return $this->q('
				SELECT
					fs.name AS n,
					m.`body` AS m,
					UNIX_TIMESTAMP(m.`time`) AS t,
					fs.photo AS p

				FROM
					`'.PREFIX.'msg` m,
					`'.PREFIX.'foodsaver` fs

				WHERE
					m.foodsaver_id = fs.id

				AND
					m.conversation_id = '.(int)$conversation_id.'

				ORDER BY
					m.`time` DESC

				LIMIT 0,50
			');
		}

	}

	public function loadMore($conversation_id, $last_message_id)
	{
		return $this->q('
			SELECT
				m.id,
				fs.`id` AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				m.`body`,
				m.`time`

			FROM
				`'.PREFIX.'msg` m,
				`'.PREFIX.'foodsaver` fs

			WHERE
				m.foodsaver_id = fs.id

			AND
				m.conversation_id = '.(int)$conversation_id.'

			AND
				m.id < '.(int)$last_message_id.'

			ORDER BY
				m.`time` DESC

			LIMIT 0,20
		');
	}

	public function getLastMessages($conv_id,$last_msg_id)
	{
		return $this->q('
			SELECT
				m.id,
				fs.`id` AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				m.`body`,
				m.`time`

			FROM
				`fs_msg` m,
				`fs_foodsaver` fs

			WHERE
				m.foodsaver_id = fs.id

			AND
				m.conversation_id = '.(int)$conv_id.'

			AND
				m.id > '.(int)$last_msg_id.'

			ORDER BY
				m.`time` ASC
		');
	}

	/**
	 * set conversatioens as readed
	 * @param array $conv_ids
	 * @return boolean | int
	 */
	public function setAsRead($conv_ids)
	{
		Mem::userDel(fsId(), 'msg-update');

		return $this->update('UPDATE '.PREFIX.'foodsaver_has_conversation SET unread = 0 WHERE foodsaver_id = '.(int)fsId().' AND conversation_id IN('.implode(',', $conv_ids).')');
	}

	public function listConversationUpdates($conv_ids)
	{
		if($return = $this->q('
			SELECT
				`id` AS id,
				`last` AS time,
				`last_message` AS body,
				`member`

			FROM
				`'.PREFIX.'conversation`

			WHERE
				`id` IN(' . implode(',', $conv_ids) . ')
		'))
		{
			for($i=0;$i<count($return);$i++)
			{
				$return[$i]['member'] = unserialize($return[$i]['member']);
			}

			return $return;
		}

		return false;
	}

	public function sendMessage($cid,$body,$sender_id = false)
	{
		if(!$sender_id)
		{
			$sender_id = fsId();
		} else
		{
			$sender_id = (int)$sender_id;
		}
		if($mid = $this->insert('INSERT INTO `'.PREFIX.'msg`(`conversation_id`, `foodsaver_id`, `body`, `time`) VALUES ('.(int)$cid.','.$sender_id.','.$this->strval($body).',NOW())'))
		{
			$this->update('UPDATE `'.PREFIX.'foodsaver_has_conversation` SET unread = 1 WHERE conversation_id = '.(int)$cid.' AND `foodsaver_id` != '.(int)$sender_id);
			$this->updateConversation($cid, $sender_id, $body, $mid);
			return $mid;
		}
		return false;
	}

	public function loadConversationMessages($conversation_id)
	{
		return $this->q('
			SELECT
				m.id,
				fs.`id` AS fs_id,
				fs.name AS fs_name,
				fs.photo AS fs_photo,
				m.`body`,
				m.`time`

			FROM
				`'.PREFIX.'msg` m,
				`'.PREFIX.'foodsaver` fs

			WHERE
				m.foodsaver_id = fs.id

			AND
				m.conversation_id = '.(int)$conversation_id.'

			ORDER BY
				m.`time` DESC

			LIMIT 0,20
		');
	}

	public function mayConversation($conversation_id)
	{
		if($this->q('SELECT foodsaver_id FROM `'.PREFIX.'foodsaver_has_conversation` WHERE `foodsaver_id` = '.(int)fsId().' AND conversation_id = '.(int)$conversation_id))
		{
			return true;
		}
		return false;
	}

	private function updateDenormalizedConversationData($cids = false)
	{
		if($cids === false)
		{
			$cids = $this->qCol('SELECT id FROM fs_conversation');
		} elseif(!is_array($cids))
		{
			$cids = array($cids);
		}
		foreach ($cids as $id)
		{
			$member = $this->listConversationMembers($id);

			/*
			 * UPDATE conversation
			 */
			$this->update('
				UPDATE
					`'.PREFIX.'conversation`

				SET
					`member` = '.$this->strval(serialize($member)).'

				WHERE
					`id` = '.(int)$id.'
			');
		}
	}

	public function setConversationMembers($cid,$fsids,$unread = false)
	{
		if((int)$cid > 0)
		{
			$ur = 0;
			if($unread)
				$ur = 1;

			if(count($fsids) < 1) {
				$this->del('DELETE FROM `'.PREFIX.'foodsaver_has_conversation` WHERE conversation_id = '.(int)$cid);
			} else {
				$ids = implode(',', $fsids);
				$this->del('DELETE FROM `'.PREFIX.'foodsaver_has_conversation` WHERE conversation_id = '.(int)$cid.' AND foodsaver_id NOT IN ('.$ids.')');
				$values = array();
				foreach($fsids as $user)
				{
					$values[] = '('.(int)$cid.', '.(int)$user.', '.$ur.')';
				}
				if(count($values) > 0)
					$this->insert('INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_conversation` (conversation_id, foodsaver_id, unread) VALUES '.implode(",",$values) );
			}

			$this->updateDenormalizedConversationData($cid);
		}
	}

	public function addUserToConversation($cid,$fsid,$unread = False)
	{
		$ur = 0;
		if($unread)
		{
			$ur = 1;
		}

		$this->insert('INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_conversation` (conversation_id, foodsaver_id, unread) VALUES ('.(int)$cid.', '.(int)$fsid.', '.$ur.')');
		$this->updateDenormalizedConversationData($cid);
	}

	public function deleteUserFromConversation($cid,$fsid,$deleteAlways = False)
	{
		/**
		 * delete only users from non 1:1 conversations
		 */
		if($deleteAlways || ((int)$this->qOne('SELECT COUNT(foodsaver_id) FROM `'.PREFIX.'foodsaver_has_conversation` WHERE conversation_id = '.(int)$cid) > 2))
		{
			$this->del('DELETE FROM `'.PREFIX.'foodsaver_has_conversation` WHERE conversation_id = '.(int)$cid.' AND foodsaver_id = '.(int)$fsid);
			$this->updateDenormalizedConversationData($cid);
		}

		return false;
	}

	public function insertConversation($recipients,$locked = false, $unread = true)
	{
		/*
		 * first get one new conversation
		 */
		$lock = 0;
		if($locked)
			$lock = 1;

		$ur = $unread ? 1 : 0;

		$sql = 'INSERT INTO `'.PREFIX.'conversation`
			(
				`start`,
				`last`,
				`last_foodsaver_id`,
				`start_foodsaver_id`,
				`locked`
			)
			VALUES (NOW(),NOW(),'.(int)fsId().','.(int)fsId().','.(int)$lock.')';

		if(($cid = $this->insert($sql)) > 0)
		{
			/*
			 * last add all recipients to this conversation
			 */
			$values = array();
			unset($recipients[(int)fsId()]);
			foreach ($recipients as $r)
			{
				$values[] = '('.(int)$r.','.(int)$cid.','.$ur.')';
			}

			// add current user extra to set unread = 0
			$values[] = '('.(int)fsId().','.(int)$cid.',0)';

			$this->insert('
				INSERT INTO
					`'.PREFIX.'foodsaver_has_conversation` (`foodsaver_id`, `conversation_id`, `unread`)

				VALUES
					'.implode(',', $values).'
			');

			$this->updateDenormalizedConversationData($cid);
			return $cid;
		}
	}
}
