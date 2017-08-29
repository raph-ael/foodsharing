<?php
class ManualDb extends Db
{
	public function __construct($host = 'localhost', $user = 'root', $pass = '', $db = 'foodsaver')
	{
		parent::__construct($host, $user, $pass, $db);
	}

	public function getBasics_content()
	{
		return $this->q('
			SELECT 	 	`id`,
						`name`

			FROM 		`'.PREFIX.'content`
			ORDER BY `name`');
	}

	public function getOne_content($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`name`,
			`title`,
			`body`,
			`last_mod`

			FROM 		`'.PREFIX.'content`

			WHERE 		`id` = ' . $this->intval($id));



		return $out;
	}

	public function updates()
	{
		$updates = array();
		if($bids = $this->getBezirkIds())
		{
			$updates['forum'] = $this->forumUpdates($bids);
		}
		if($botbids = $this->getBotBezirkIds())
		{
			$updates['bforum'] = $this->botForumUpdates($botbids);
		}
		if($betrieb_ids = $this->getMyBetriebIds())
		{
			$updates['bpin'] = $this->betriebPinUpdates($botbids);
		}

		$out = array();

		foreach ($updates as $type => $u)
		{
			if(is_array($u))
			{
				foreach ($u as $update)
				{
					$update['type'] = $type;
					$out[$update['update_time'].$type] = $update;
				}
			}
		}

		if(!empty($out))
		{
			krsort($out);

			return $out;
		}
		else
		{
			return false;
		}
	}

	private function betriebPinUpdates($bids)
	{
		if($ret = $this->q('

			SELECT 	n.id, n.milestone, n.`text` , n.`zeit` AS update_time, UNIX_TIMESTAMP( n.`zeit` ) AS update_time_ts, fs.name AS foodsaver_name, fs.sleep_status, fs.id AS foodsaver_id, fs.photo AS foodsaver_photo, b.id AS betrieb_id, b.name AS betrieb_name
			FROM 	'.PREFIX.'betrieb_notiz n, '.PREFIX.'foodsaver fs, '.PREFIX.'betrieb b, '.PREFIX.'betrieb_team bt

			WHERE 	n.foodsaver_id = fs.id
			AND 	n.betrieb_id = b.id
			AND 	bt.betrieb_id = n.betrieb_id
			AND 	bt.foodsaver_id = '.(int)fsId().'
			AND 	n.milestone = 0
			AND 	n.last = 1

			ORDER BY n.id DESC
			LIMIT 0 , 4

		'))
		{
			return $ret;
		}
		return false;
	}

	public function closeBaskets($distance = 50,$loc = false)
	{
		if($loc === false)
		{
			$loc = S::getLocation();
		}

		return $this->q('
			SELECT
				b.id,
				b.picture,
				b.description,
				b.lat,
				b.lon,
				(6371 * acos( cos( radians( '.$this->floatval($loc['lat']).' ) ) * cos( radians( b.lat ) ) * cos( radians( b.lon ) - radians( '.$this->floatval($loc['lon']).' ) ) + sin( radians( '.$this->floatval($loc['lat']).' ) ) * sin( radians( b.lat ) ) ))
				AS distance
			FROM
				fs_basket b

			WHERE
				b.status = 1

			AND
				foodsaver_id != '.(int)fsId().'

			HAVING
				distance <='.(int)$distance.'

			ORDER BY
				distance ASC

			LIMIT 6
		');
	}

	private function forumUpdates($bids)
	{
		return $this->q('

			SELECT 		t.id,
						t.name,
						t.`time`,
						UNIX_TIMESTAMP(t.`time`) AS time_ts,
						fs.id AS foodsaver_id,
						fs.name AS foodsaver_name,
						fs.photo AS foodsaver_photo,
						fs.sleep_status,
						p.body AS post_body,
						p.`time` AS update_time,
						UNIX_TIMESTAMP(p.`time`) AS update_time_ts,
						t.last_post_id,
						bt.bezirk_id

			FROM 		'.PREFIX.'theme t,
						'.PREFIX.'theme_post p,
						'.PREFIX.'bezirk_has_theme bt,
						'.PREFIX.'foodsaver fs

			WHERE 		t.last_post_id = p.id
			AND 		p.foodsaver_id = fs.id
			AND 		bt.theme_id = t.id
			AND 		bt.bezirk_id IN('.implode(',', $bids).')
			AND 		bt.bot_theme = 0
			AND 		t.active = 1
			AND			fs.deleted_at IS NULL

			ORDER BY t.last_post_id DESC

			LIMIT 0, 4

		');
	}

	private function botForumUpdates($bids)
	{
		return $this->q('

			SELECT 		t.id,
						t.name,
						t.`time`,
						UNIX_TIMESTAMP(t.`time`) AS time_ts,
						fs.id AS foodsaver_id,
						fs.name AS foodsaver_name,
						fs.photo AS foodsaver_photo,
						fs.sleep_status,
						p.body AS post_body,
						p.`time` AS update_time,
						UNIX_TIMESTAMP(p.`time`) AS update_time_ts,
						t.last_post_id,
						bt.bezirk_id

			FROM 		'.PREFIX.'theme t,
						'.PREFIX.'theme_post p,
						'.PREFIX.'bezirk_has_theme bt,
						'.PREFIX.'foodsaver fs

			WHERE 		t.last_post_id = p.id
			AND 		p.foodsaver_id = fs.id
			AND 		bt.theme_id = t.id
			AND 		bt.bezirk_id IN('.implode(',', $bids).')
			AND 		bt.bot_theme = 1
			AND			fs.deleted_at IS NULL

			ORDER BY t.last_post_id DESC

			LIMIT 0, 4

		');
	}

	public function getBotBezirkIds()
	{
		$out = array();
		if(isset($_SESSION['client']['botschafter']) && is_array($_SESSION['client']['botschafter']))
		{
			foreach ($_SESSION['client']['botschafter'] as $b)
			{
				$out[] = $b['bezirk_id'];
			}
		}

		if(!empty($out))
		{
			return $out;
		}

		return false;
	}

	public function getMyBetriebIds()
	{
		$out = array();
		if(isset($_SESSION['client']['betriebe']) && is_array($_SESSION['client']['betriebe']))
		{
			foreach ($_SESSION['client']['betriebe'] as $b)
			{
				$out[] = $b['id'];
			}
		}

		if(!empty($out))
		{
			return $out;
		}

		return false;
	}

	public function getFsBezirkIds($foodsaver_id)
	{
		return $this->qCol('
			SELECT 	`bezirk_id`
			FROM 	`'.PREFIX.'foodsaver_has_bezirk`
			WHERE 	`foodsaver_id` = '.(int)$foodsaver_id.'
		');
	}

	public function getBezirkIds()
	{
		$out = array();
		if(isset($_SESSION['client']['bezirke']) && is_array($_SESSION['client']['bezirke']))
		{
			foreach ($_SESSION['client']['bezirke'] as $b)
			{
				$out[] = $b['id'];
			}
		}

		if(!empty($out))
		{
			return $out;
		}

		return false;
	}

	public function add_message_tpl($data)
	{
		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'message_tpl`
			(
			`language_id`,
			`name`,
			`subject`,
			`body`
			)
			VALUES
			(
			'.$this->intval($data['language_id']).',
			'.$this->strval($data['name']).',
			'.$this->strval($data['subject']).',
			'.$this->strval($data['body'],true).'
			)');

		return $id;
	}

	public function getAbholzeiten($betrieb_id)
	{

		if($res = $this->q('SELECT `time`,`dow`,`fetcher` FROM `'.PREFIX.'abholzeiten` WHERE `betrieb_id` = '.(int)$betrieb_id))
		{
			$out = array();
			foreach ($res as $r)
			{
				$out[$r['dow'].'-'.$r['time']] = array(
						'dow' => $r['dow'],
						'time' => $r['time'],
						'fetcher' => $r['fetcher']

				);
			}

			ksort($out);

			return $out;
		}

		return false;
	}

	public function getFaqIntern()
	{
		return $this->q('SELECT `id`, `answer`, `name` FROM `'.PREFIX.'faq`');
	}

	public function getFsMap($bezirk_id)
	{
		$bezirk_id = (int)$bezirk_id;
		if($bezirk_id > 0)
		{
			return $this->q('SELECT `id`,`lat`,`lon`,CONCAT(`name`," ",`nachname`) AS `name`,`plz`,`stadt`,`anschrift`,`photo` FROM `'.PREFIX.'foodsaver` WHERE `active` = 1 AND `bezirk_id` = '.$this->intval($bezirk_id).' AND `lat` != "" ');
		}
	}

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
		//$bezirk_id = (int)$this->getCurrentBezirkId();
		if(!S::may('bot') && $bezirk_id > 0)
		{
			$children = $this->getBezirkIds();
		}

		if(S::may('fs'))
		{
			if($res = $this->searchTable('bezirk', array('name'), $q,array(
					'name' => '`name`',
					'click' => 'CONCAT("goTo(\'/?page=bezirk&bid=",`id`,"\');")',
					'teaser' => 'CONCAT("")'

			)))
			{
				$out['bezirk'] = $res;
			}
		}

		if(S::may('fs'))
		{
			if($res = $this->searchTable('foodsaver', array('name','nachname','plz','stadt'), $q,array(
					'name' => 'CONCAT(`name`," ",`nachname`)',
					'click' => 'CONCAT("profile(",`id`,");")',
					'teaser' => 'stadt'

			),$children))
			{
				$out['foodsaver'] = $res;
			}
		}
		if(S::may('fs'))
		{
			if($res = $this->searchTable('betrieb', array('name','stadt','plz'), $q,array(
					'name' => '`name`',
					'click' => 'CONCAT("betrieb(",`id`,");")',
					'teaser' => 'CONCAT(`str`,", ",`plz`," ",`stadt`)'

			),$children))
			{
				$out['betrieb'] = $res;
			}
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
		');
	}

	public function passGen($fsid)
	{
		return $this->sql('INSERT INTO `'.PREFIX.'pass_gen`(`foodsaver_id`,`date`,`bot_id`)VALUES('.$this->intval($fsid).',NOW(),'.fsId().')');
	}

	public function getFsAutocomplete($bezirk_id)
	{
		$and = 'AND 		fb.`bezirk_id` = '.$this->intval($bezirk_id).'';
		if(is_array($bezirk_id))
		{
		if(is_array(end($bezirk_id)))
		{
		$tmp = $bezirk_id;
		$bezirk_id = array();
		foreach ($tmp as $b)
		{
		$bezirk_id[$b['id']] = $b['id'];
		}
		}

		$and = 'AND 		fb.`bezirk_id` IN('.implode(',', $bezirk_id).')';

		}
		return $this->q('
			SELECT 		fs.id,
						CONCAT(fs.`name`, " ", fs.`nachname`) AS `value`

			FROM 		'.PREFIX.'foodsaver_has_bezirk fb,
						`'.PREFIX.'foodsaver` fs

			WHERE 		fb.foodsaver_id = fs.id
			AND			fs.deleted_at IS NULL
			'.$and.'
		');
	}

	public function getFoodsaver($bezirk_id)
	{
		$and = 'AND 		fb.`bezirk_id` = '.$this->intval($bezirk_id).'';
		if(is_array($bezirk_id))
		{
			if(is_array(end($bezirk_id)))
			{
				$tmp = $bezirk_id;
				$bezirk_id = array();
				foreach ($tmp as $b)
				{
					$bezirk_id[$b['id']] = $b['id'];
				}
			}

			$and = 'AND 		fb.`bezirk_id` IN('.implode(',', $bezirk_id).')';

		}

		return $this->q('
			SELECT 		fs.id,
						CONCAT(fs.`name`, " ", fs.`nachname`) AS `name`,
						fs.`name` AS vorname,
						fs.`anschrift`,
						fs.`email`,
						fs.`telefon`,
						fs.`handy`,
						fs.`plz`,
						fs.`geschlecht`

			FROM 		'.PREFIX.'foodsaver_has_bezirk fb,
						`'.PREFIX.'foodsaver` fs

			WHERE 		fb.foodsaver_id = fs.id
			AND			fs.deleted_at IS NULL
			'.$and.'
		');
	}

	public function getBiebsForStore($bid)
	{
		return $this->q('
			SELECT 		bt.foodsaver_id as id

			FROM 		'.PREFIX.'betrieb_team bt

			WHERE 	bt.verantwortlich = 1 AND
			active = 1 AND
			bt.betrieb_id = '.$this->intval($bid).'
		');
	}

	public function getBezirkByParent($parent_id)
	{
		$sql = 'AND 		`type` != 7';
		if(isOrgaTeam())
		{
			$sql = '';
		}
		return $this->q('
			SELECT
				`id`,
				`name`,
				`has_children`,
				`parent_id`,
				`type`,
				`master`

			FROM 		`'.PREFIX.'bezirk`

			WHERE 		`parent_id` = '.$this->intval($parent_id).'
			AND id != 0
			'.$sql.'

			ORDER BY 	`name`');
	}

	public function getAllFilialverantwortlich()
	{
		if($verant = $this->q('
			SELECT 	fs.`id`,
					fs.`email`

			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'betrieb_team` bt

			WHERE 	bt.foodsaver_id = fs.id

			AND 	bt.verantwortlich = 1
			AND		fs.deleted_at IS NULL
		'))
		{
			$out = array();
			foreach ($verant as $v)
			{
				$out[$v['id']] = $v;
			}
			return $out;
		}
	}

	public function getAllEmailFoodsaver($newsletter = false, $only_foodsaver = true)
	{
		if($only_foodsaver)
		{
			$min_rolle = 1;
		} else
		{
			$min_rolle = 0;
		}
		$where = "WHERE rolle >= $min_rolle";
		if($newsletter !== false)
		{
			$where = "WHERE newsletter = 1 AND rolle >= $min_rolle";
		}
		return $this->q('
				SELECT 	`id`,`email`
				FROM `'.PREFIX.'foodsaver`
				'.$where.' AND active = 1
				AND	deleted_at IS NULL
		');
	}

	public function addTeamMessage($bid,$message)
	{
		if($betrieb = $this->getMyBetrieb($bid))
		{

			if(!is_null($betrieb['team_conversation_id']))
			{
				$msg = loadModel('msg');
				$msg->sendMessage($betrieb['team_conversation_id'],$message);

			}elseif(is_null($betrieb['team_conversation_id']))
			{
				$tcid = $this->createTeamConversation($bid);
				$msg = loadModel('msg');
				$msg->sendMessage($tcid,$message);
			}
		}
	}

	public function addMessage($sender_id,$recip_id,$name,$message,$attach)
	{
		$model = loadModel('msg');
		if($cid = $model->addConversation(array($sender_id=> $sender_id,$recip_id=>$recip_id),false,false))
		{
			$model->sendMessage($cid,$message,$sender_id);
			mailMessage($sender_id,$recip_id,$message);
		}

		return $id;
	}

	public function add_message($data)
	{
		$model = loadModel('msg');
		if($cid = $model->addConversation(array($data['sender_id']=> $data['sender_id'],$data['recip_id']=>$data['recip_id']),false,false))
		{
			$model->sendMessage($cid,$data['msg'],$data['sender_id']);
		}

		return $id;
	}

	public function add_content($data)
	{
		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'content`
			(
			`name`,
			`title`,
			`body`,
			`last_mod`
			)
			VALUES
			(
			'.$this->strval($data['name']).',
			'.$this->strval($data['title']).',
			'.$this->strval($data['body'],true).',
			'.$this->dateval($data['last_mod']).'
			)');



		return $id;
	}

	public function update_message_tpl($id,$data)
	{


		return $this->update('
		UPDATE 	`'.PREFIX.'message_tpl`

		SET 	`language_id` =  '.$this->intval($data['language_id']).',
				`name` =  '.$this->strval($data['name']).',
				`subject` =  '.$this->strval($data['subject']).',
				`body` =  '.$this->strval($data['body'],true).'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function update_content($id,$data)
	{


		return $this->update('
		UPDATE 	`'.PREFIX.'content`

		SET 	`name` =  '.$this->strval($data['name']).',
				`title` =  '.$this->strval($data['title']).',
				`body` =  '.$this->strval($data['body'],true).',
				`last_mod` =  '.$this->dateval($data['last_mod']).'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function xhrGetTagFs($bezirk_id)
	{
		$parent = (int)$this->getVal('parent_id', 'bezirk', $bezirk_id);
		return $this->q('
				SELECT	`id`,CONCAT(`name`," ",`nachname` ) AS value
				FROM 	'.PREFIX.'foodsaver
				WHERE 	`bezirk_id` IN('.implode(',', $this->getChildBezirke($bezirk_id)).') AND deleted_at IS NULL');
	}

	public function xhrGetTagFsAll()
	{
		return $this->q('
				SELECT	DISTINCT fs.`id`,
						CONCAT(fs.`name`," ",fs.`nachname` ) AS value

				FROM 	'.PREFIX.'foodsaver fs,
						'.PREFIX.'foodsaver_has_bezirk hb
				WHERE 	hb.foodsaver_id = fs.id
				AND 	hb.bezirk_id IN('.implode(',', $this->getBezirkIds()).')
				AND		fs.deleted_at IS NULL
		');
	}

	public function isInTeam($bid)
	{
		if($this->q('SELECT `foodsaver_id` FROM `'.PREFIX.'betrieb_team` WHERE foodsaver_id = '.$this->intval(fsId()).' AND betrieb_id = '.(int)$bid.' AND active IN(1,2)'))
		{
			return true;
		}

		return false;

	}

	public function xhrGetFoodsaver($data)
	{
		$term = $data['term'];
		$term = trim($term);
		$term = preg_replace('/[^a-zA-ZäöüÖÜß]/', '', $term);

		$bezirk = '';
		if(isset($data['bid']))
		{
			if(is_array($data['bid']))
			{
				$bezirk = 'AND bezirk_id IN('.implode(',', $data['bid']).')';
			}
			else
			{
				$bezirk = 'AND bezirk_id = '.$this->intval($data['bid']);
			}

		}

		if(strlen($term) > 2)
		{
			$out = $this->q('
				SELECT		`id`,
							CONCAT_WS(" ", `name`, `nachname` ) AS value

				FROM 		'.PREFIX.'foodsaver

				WHERE 		((`name` LIKE "'.$term.'%"
				OR 			`nachname` LIKE "'.$term.'%"))
				AND			deleted_at IS NULL
				'.$bezirk.'
			');

			return $out;

		}
		else
		{
			return array();
		}
	}

	private function updatePassword($fs_id, $new_pass)
	{

		if($fs = $this->qRow('SELECT `id`, `email` FROM `'.PREFIX.'foodsaver` WHERE `id` = '.$this->intval($fs_id)))
		{
			$enc = $this->encryptMd5($fs['email'], $new_pass);

			$this->update('
				UPDATE 	`'.PREFIX.'foodsaver`
				SET 	`passwd` = '.$this->strval($enc).'
				WHERE 	`id` = '.$this->intval($fs_id).'
			');
			return true;
		}
		return false;
	}

	public function getReg($id)
	{
		return $this->qRow('
				SELECT 	fs.`id` ,
						fs.name,
						fs.nachname,
						fs.anschrift,
						fs.`geschlecht`,
						fs.`photo`,
						fs.`bezirk_id`,
						UNIX_TIMESTAMP(fs.`anmeldedatum`) AS anmeldedatum,
						fs.`data`,
						plz,
						rolle

				FROM 	`'.PREFIX.'foodsaver` fs

				WHERE 	fs.`id` = '.$this->intval($id).';
		');
	}

	public function getEmailAdressen($bezirk_id = false)
	{
		if(!$bezirk_id)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}

		return $this->q('
				SELECT 	`id`,
						`name`,
						`nachname`,
						`email`,
						`geschlecht`

				FROM 	`'.PREFIX.'foodsaver`

				WHERE 	`bezirk_id` IN('.implode(',',$this->getChildBezirke($bezirk_id)).')
				AND		deleted_at IS NULL
		');
	}

	private function updateHasChildren($bezirk_id)
	{
		$count = $this->qOne('SELECT COUNT(`id`) FROM '.PREFIX.'bezirk WHERE `parent_id` = '.$this->intval($bezirk_id).' ');

		if($count == 0)
		{
			$this->update('UPDATE '.PREFIX.'bezirk SET `has_children` = 0 WHERE `id` = '.$this->intval($bezirk_id).' ');
		}

	}

	public function deleteBezirk($id)
	{
		if(isOrgaTeam())
		{
			$parent_id = $this->getVal('parent_id', 'bezirk', $id);

			$this->update('UPDATE `'.PREFIX.'foodsaver` SET `bezirk_id` = NULL WHERE `bezirk_id` = '.(int)$id);
			$this->update('UPDATE `'.PREFIX.'bezirk` SET `parent_id` = 0 WHERE `parent_id` = '.(int)$id);

			$this->del('DELETE FROM `'.PREFIX.'bezirk` WHERE `id` = '.(int)$id);

			$this->updateHasChildren($parent_id);
		}
	}

	public function addPhoto($fs_id,$file)
	{
		$file = str_replace('/', '', $file);
		$file = strip_tags($file);
		$_SESSION['client']['photo'] = $file;
		$this->update('

		UPDATE `'.PREFIX.'foodsaver`
		SET 	`photo` = '.$this->strval($file).' WHERE `id` = '.$this->intval($fs_id));
	}

	public function getPhoto($fs_id)
	{
		$photo = $this->qOne('SELECT `photo` FROM `'.PREFIX.'foodsaver` WHERE `id` = '.$this->intval($fs_id));
		if(!empty($photo))
		{
			return $photo;
		}

		return false;
	}

	public function getOne_foodsaver($id)
	{
		$out = $this->qRow('
			SELECT
				`id`,
				`bezirk_id`,
				`plz`,
				`stadt`,
				`lat`,
				`lon`,
				`email`,
				`name`,
				`nachname`,
				`anschrift`,
				`telefon`,
				`handy`,
				`geschlecht`,
				`geb_datum`,
				`anmeldedatum`,
				`photo`,
				`photo_public`,
				`about_me_public`,
				`orgateam`,
				`data`,
				`rolle`,
				`position`,
				`tox`,
				`github`,
				`twitter`,
				`homepage`


			FROM 		`'.PREFIX.'foodsaver`

			WHERE 		`id` = ' . $this->intval($id));

		if($bot = $this->q('SELECT `'.PREFIX.'bezirk`.`name`,`'.PREFIX.'bezirk`.`id` FROM `'.PREFIX.'bezirk`,'.PREFIX.'botschafter WHERE `'.PREFIX.'botschafter`.`bezirk_id` = `'.PREFIX.'bezirk`.`id` AND `'.PREFIX.'botschafter`.foodsaver_id = '.$this->intval($id)))
		{
			$out['botschafter'] = $bot;
		}
		return $out;
	}

	public function emailExists($email)
	{
		$email = $this->q('SELECT `id` FROM `'.PREFIX.'foodsaver` WHERE `email` = '.$this->strval($email));

		if(!empty($email))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	private function getBetriebNotiz($id)
	{
		$out = $this->q('
			SELECT
			`id`,
			`foodsaver_id`,
			`betrieb_id`,
			`text`,
			`zeit`,
			UNIX_TIMESTAMP(`zeit`) AS zeit_ts

			FROM 		`'.PREFIX.'betrieb_notiz`

			WHERE `betrieb_id` = '.$this->intval($id));

		return $out;
	}

	public function deleteBPost($id)
	{
		return $this->del('
			DELETE FROM 	`'.PREFIX.'betrieb_notiz`
			WHERE `id` = '.(int)$id.'
		');
	}

	public function getFoodsaverBasics($fsid)
	{
		if($fs = $this->qRow('
			SELECT 	fs.`name`,
					fs.nachname,
					fs.bezirk_id,
					fs.rolle,
					fs.photo,
					fs.geschlecht,
					fs.stat_fetchweight,
					fs.sleep_status

			FROM 	`'.PREFIX.'foodsaver` fs

			WHERE fs.id = '.(int)$fsid.'
		'))
		{
			$fs['bezirk_name'] = '';
			if($fs['bezirk_id'] > 0 )
			{
				$fs['bezirk_name'] =$this->getVal('name', 'bezirk', $fs['bezirk_id']);
			}

			return $fs;
		}
		return false;
	}

	public function getMyBetriebe($options = array())
	{
		$betriebe = $this->q('
			SELECT 	'.PREFIX.'betrieb.id,
						`'.PREFIX.'betrieb`.betrieb_status_id,
						'.PREFIX.'betrieb.plz,
						'.PREFIX.'betrieb.kette_id,

						'.PREFIX.'betrieb.ansprechpartner,
						'.PREFIX.'betrieb.fax,
						'.PREFIX.'betrieb.telefon,
						'.PREFIX.'betrieb.email,

						'.PREFIX.'betrieb.betrieb_kategorie_id,
						'.PREFIX.'betrieb.name,
						CONCAT('.PREFIX.'betrieb.str," ",'.PREFIX.'betrieb.hsnr) AS anschrift,
						'.PREFIX.'betrieb.str,
						'.PREFIX.'betrieb.hsnr,
						'.PREFIX.'betrieb.`betrieb_status_id`,
						'.PREFIX.'betrieb_team.verantwortlich,
						'.PREFIX.'betrieb_team.active

				FROM 	'.PREFIX.'betrieb,
						'.PREFIX.'betrieb_team

				WHERE 	'.PREFIX.'betrieb.id = '.PREFIX.'betrieb_team.betrieb_id

				AND 	'.PREFIX.'betrieb_team.foodsaver_id = '.$this->intval(fsId()).'

				ORDER BY '.PREFIX.'betrieb_team.verantwortlich DESC, '.PREFIX.'betrieb.name ASC
		');
		$out = array();
		$out['verantwortlich'] = array();
		$out['team'] = array();
		$out['waitspringer'] = array();
		$out['anfrage'] = array();

		$already_in = array();

		if(is_array($betriebe))
		{
			foreach ($betriebe as $b)
			{
				$already_in[$b['id']] = true;
				if($b['verantwortlich'] == 0)
				{
					if($b['active'] == 0)
					{
						$out['anfrage'][] = $b;
					}
					elseif($b['active'] == 1)
					{
						$out['team'][] = $b;
					}
					elseif($b['active'] == 2)
					{
						$out['waitspringer'][] = $b;
					}
				}
				else
				{
					$out['verantwortlich'][] = $b;
				}
			}
		}
		unset($betriebe);

		if(!isset($options['sonstige']))
		{
			$options['sonstige'] = true;
		}

		if($options['sonstige'])
		{
			$out['sonstige'] = array();
			$sql = '
				SELECT 		b.id,
							b.betrieb_status_id,
							b.plz,
							b.kette_id,

							b.ansprechpartner,
							b.fax,
							b.telefon,
							b.email,

							b.betrieb_kategorie_id,
							b.name,
							CONCAT(b.str," ",b.hsnr) AS anschrift,
							b.str,
							b.hsnr,
							b.`betrieb_status_id`,
							bz.name AS bezirk_name

					FROM 	'.PREFIX.'betrieb b,
							'.PREFIX.'bezirk bz

					WHERE 	b.bezirk_id = bz.id
					AND 	bezirk_id IN('.implode(',', $this->getChildBezirke(getBezirkId())).')


					ORDER BY bz.name DESC
			';

			if($betriebe = $this->q($sql))
			{
				foreach ($betriebe as $b)
				{
					if(!isset($already_in[$b['id']]))
					{
						$out['sonstige'][] = $b;
					}
				}
			}

		}
		return $out;
	}

	public function isVerantwortlich($betrieb_id)
	{
		if(isOrgaTeam())
		{
			return true;
		}
		return $this->qOne('

				SELECT 	betrieb_id

				FROM 	'.PREFIX.'betrieb_team

				WHERE 	betrieb_id = '.$this->intval($betrieb_id).'
				AND 	foodsaver_id = '.$this->intval(fsId()).'
				AND 	verantwortlich = 1
				AND 	active = 1
		');
	}

	public function hasAnfrageAtStore($betrieb_id)
	{
		return $this->qOne('

				SELECT 	betrieb_id

				FROM 	'.PREFIX.'betrieb_team

				WHERE 	betrieb_id = '.$this->intval($betrieb_id).'
				AND 	foodsaver_id = '.$this->intval(fsId()).'
				AND 	verantwortlich = 0
				AND 	active = 0
		');
	}

	public function getParentBezirke($bid)
	{
		if(is_array($bid))
		{
			$where = "WHERE bezirk_id IN (".implode(',', array_map("intval", $bid)).")";
		} else
		{
			$where = "WHERE bezirk_id = ".intval($bid);
		}

		return $this->qCol('SELECT DISTINCT ancestor_id FROM `'.PREFIX.'bezirk_closure` '.$where);
	}

	public function getChildBezirke($bid,$nocache = false)
	{
		if((int)$bid == 0)
		{
			return false;
		}

		$ou = array();
		$ou[$bid] = $bid;

	    if($out = $this->qCol('SELECT bezirk_id FROM `'.PREFIX.'bezirk_closure` WHERE ancestor_id = '.(int)$bid))
	    {

	    	foreach ($out as $o)
	    	{
	    		$ou[(int)$o] = (int)$o;
	    	}
	    }

	    return $ou;
	}

	public function listBetriebReq($bezirk_id)
	{
	    if($child_bezirke = $this->getChildBezirke($bezirk_id))
        {
            return $this->q('
				SELECT 	'.PREFIX.'betrieb.id,
						`'.PREFIX.'betrieb`.betrieb_status_id,
						'.PREFIX.'betrieb.plz,
						'.PREFIX.'betrieb.added,
						`stadt`,
						'.PREFIX.'betrieb.kette_id,
						'.PREFIX.'betrieb.betrieb_kategorie_id,
						'.PREFIX.'betrieb.name,
						CONCAT('.PREFIX.'betrieb.str," ",'.PREFIX.'betrieb.hsnr) AS anschrift,
						'.PREFIX.'betrieb.str,
						'.PREFIX.'betrieb.hsnr,
						'.PREFIX.'betrieb.`betrieb_status_id`,
						'.PREFIX.'bezirk.name AS bezirk_name

				FROM 	'.PREFIX.'betrieb,
						'.PREFIX.'bezirk

				WHERE 	'.PREFIX.'betrieb.bezirk_id = '.PREFIX.'bezirk.id
				AND 	'.PREFIX.'betrieb.bezirk_id IN('.implode(',', $child_bezirke).')


		    ');
        }

		return false;
	}

	public function getBetrieb($id)
	{
		$sql = '
		SELECT		`id`,
					plz,
					`'.PREFIX.'betrieb`.bezirk_id,
					`'.PREFIX.'betrieb`.kette_id,
					`'.PREFIX.'betrieb`.betrieb_kategorie_id,
					`'.PREFIX.'betrieb`.name,
					`'.PREFIX.'betrieb`.str,
					`'.PREFIX.'betrieb`.hsnr,
					`'.PREFIX.'betrieb`.stadt,
					`'.PREFIX.'betrieb`.lat,
					`'.PREFIX.'betrieb`.lon,
					CONCAT(`'.PREFIX.'betrieb`.str, " ",`'.PREFIX.'betrieb`.hsnr) AS anschrift,
					`'.PREFIX.'betrieb`.`betrieb_status_id`,
					`'.PREFIX.'betrieb`.status_date,
					`'.PREFIX.'betrieb`.ansprechpartner,
					`'.PREFIX.'betrieb`.telefon,
					`'.PREFIX.'betrieb`.email,
					`'.PREFIX.'betrieb`.fax,
					`kette_id`

		FROM 		`'.PREFIX.'betrieb`

		WHERE 		`'.PREFIX.'betrieb`.`id` = '.$this->intval($id).'';

		$out = false;
		if($out =  $this->qRow($sql))
		{
			$out['verantwortlicher'] = '';
			if($bezirk = $this->getBezirkName($out['bezirk_id']))
			{
				$out['bezirk'] = $bezirk;
			}
			if($verantwortlich = $this->getVerantwortlicher($id))
			{
				$out['verantwortlicher'] = $verantwortlich;
			}
			if($kette = $this->getOne_kette($out['kette_id']))
			{
				$out['kette'] = $kette;
			}
		}

		$out['notizen'] = $this->getBetriebNotiz($id);

		return $out;
	}

	public function getMapsBetriebe($bezirk_id = false)
	{
		if(!$bezirk_id)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}
		return $this->q('
				SELECT 	'.PREFIX.'betrieb.id,
						`'.PREFIX.'betrieb`.betrieb_status_id,
						'.PREFIX.'betrieb.plz,
						`lat`,
						`lon`,
						`stadt`,
						'.PREFIX.'betrieb.kette_id,
						'.PREFIX.'betrieb.betrieb_kategorie_id,
						'.PREFIX.'betrieb.name,
						CONCAT('.PREFIX.'betrieb.str," ",'.PREFIX.'betrieb.hsnr) AS anschrift,
						'.PREFIX.'betrieb.str,
						'.PREFIX.'betrieb.hsnr,
						'.PREFIX.'betrieb.`betrieb_status_id`

				FROM 	'.PREFIX.'betrieb

				WHERE 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval($bezirk_id).'

				AND `lat` != ""


				');// -- AND 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval(1).'
	}

	public function getBetriebe($bezirk_id = false)
	{
		if(!$bezirk_id)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}
		return $this->q('
				SELECT 	'.PREFIX.'betrieb.id,
						`'.PREFIX.'betrieb`.betrieb_status_id,
						'.PREFIX.'betrieb.plz,
						`stadt`,
						'.PREFIX.'betrieb.kette_id,
						'.PREFIX.'betrieb.betrieb_kategorie_id,
						'.PREFIX.'betrieb.name,
						CONCAT('.PREFIX.'betrieb.str," ",'.PREFIX.'betrieb.hsnr) AS anschrift,
						'.PREFIX.'betrieb.str,
						'.PREFIX.'betrieb.hsnr,
						'.PREFIX.'betrieb.`betrieb_status_id`

				FROM 	'.PREFIX.'betrieb

				WHERE 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval($bezirk_id).'


				');// -- AND 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval(1).'
	}

	public function update_foodsaver($id, $data)
	{
		$data['anmeldedatum'] = date('Y-m-d H:i:s');

		if(!isset($data['bezirk_id']))
		{
			$data['bezirk_id'] = getBezirkId();
		}

		$orga = '';
		if(isset($data['orgateam']))
		{
			$orga = '`orgateam` = '.$this->intval($data['orgateam']).',';
		}

		$rolle = '';
		$quiz_rolle = '';
		$verified = '';
		if(isset($data['rolle']))
		{
			$rolle = '`rolle` =  ' . $this->intval($data['rolle']) . ',';
			if($data['rolle']==0 && isOrgaTeam())
			{
				$data['bezirk_id'] = 0;
				$quiz_rolle = '`quiz_rolle` = 0,';
				$verified = '`verified` = 0,';

				$bids = $this->q('
					SELECT 	bt.betrieb_id as id
					FROM 	'.PREFIX.'betrieb_team bt
					WHERE 	bt.foodsaver_id = '.$this->intval($id).'
				');
				$betrieb = loadModel('betrieb');
				//Delete from Companies
				foreach($bids as $b)
				{
					$betrieb->signout($b, $id);
				}

				//Delete Bells for Foodsaver
				$this->del('
					DELETE FROM  `'.PREFIX.'foodsaver_has_bell`
					WHERE 		`foodsaver_id` = '.$this->intval($id).'
				');
				// Delete from Bezirke and Working Groups
				$this->del('
					DELETE FROM  `'.PREFIX.'foodsaver_has_bezirk`
					WHERE 		`foodsaver_id` = '.$this->intval($id).'
				');
				//Delete from Bezirke and Working Groups (when Admin)
				$this->del('
					DELETE FROM  `'.PREFIX.'botschafter`
					WHERE 		`foodsaver_id` = '.$this->intval($id).'
				');

				//Block Person for Quiz
				for ($i = 1; $i <= 7; $i++) {
				    $this->insert('
					INSERT INTO '.PREFIX.'quiz_session (
						foodsaver_id,
						quiz_id,
						`status`,
						time_start
					)
					VALUES
					(
						'.$this->intval($id).',
						1,
						2,
						now()
					)
				');
				}
			}
		}

		$position = '';
		if(isset($data['position']))
		{
			$position = '`position` =  ' . $this->strval($data['position']) . ',';
		}

		$email = '';
		if(isset($data['email']))
		{
			$email = '`email` = '.$this->strval($data['email']).',';
		}

		return $this->update('

		UPDATE 	`'.PREFIX.'foodsaver`

		SET
				`bezirk_id` =  ' . $this->intval($data['bezirk_id']) . ',
				`plz` =  ' . $this->strval(trim($data['plz'])) . ',
				`stadt` =  ' . $this->strval(trim($data['stadt'])) . ',
				`lat` =  ' . $this->strval(trim($data['lat'])) . ',
				`lon` =  ' . $this->strval(trim($data['lon'])) . ',
				`name` =  ' . $this->strval($data['name']) . ',
				`nachname` =  ' . $this->strval($data['nachname']) . ',
				`anschrift` =  ' . $this->strval($data['anschrift']) . ',
				`telefon` =  ' . $this->strval($data['telefon']) . ',
				`handy` =  ' . $this->strval($data['handy']) . ',
				`geschlecht` =  ' . $this->intval($data['geschlecht']) . ',
				'.$position.'
				'.$rolle.'
				' . $orga . '
				' . $email . '
				' .$quiz_rolle. '
				' .$verified. '
				`geb_datum` =  ' . $this->dateval($data['geb_datum']) . '

		WHERE 	`id` = '.$this->intval($id));
	}

	public function add_foodsaver($data)
	{
		$data['anmeldedatum'] = date('Y-m-d H:i:s');

		if(!isset($data['bezirk_id']))
		{
			$data['bezirk_id'] = getBezirkId();
		}

		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'foodsaver`
			(
				`bezirk_id`,
				`plz`,
				`email`,
				`name`,
				`nachname`,
				`anschrift`,
				`telefon`,
				`handy`,
				`geschlecht`,
				`geb_datum`,
				`anmeldedatum`
			)
			VALUES
			(
			'.$this->intval($data['bezirk_id']).',
			'.$this->strval($data['plz']).',
			'.$this->strval($data['email']).',
			'.$this->strval($data['name']).',
			'.$this->strval($data['nachname']).',
			'.$this->strval($data['anschrift']).',
			'.$this->strval($data['telefon']).',
			'.$this->strval($data['handy']).',
			'.$this->intval($data['geschlecht']).',
			'.$this->dateval($data['geb_datum']).',
			'.$this->dateval($data['anmeldedatum']).'
			)');

		return $id;
	}

	public function getSendMails()
	{
		return $this->q('
			SELECT 	`name`,
					`message`,
					`zeit`
			FROM 	`'.PREFIX.'send_email`
			WHERE 	`foodsaver_id` = '.(int)fsId().'
		');
	}

	private function getBezirkMail($bezirk_id = false)
	{
		if($bezirk_id == false)
		{
			return array(
				'name' => 'Foodsharing e.<span style="white-space:nowrap">&thinsp;</span>V.',
				'email' => DEFAULT_EMAIL,
				'email_name' => DEFAULT_EMAIL_NAME
			);
		}
		else
		{
			return $this->getBezirk($bezirk_id);
		}
	}

	public function getCurrentBezirkId()
	{
		return $_SESSION['client']['bezirk_id'];
	}

	public function del_foodsaver($id)
	{
		$this->insert('
			INSERT INTO '.PREFIX.'foodsaver_archive
			(
				SELECT * FROM '.PREFIX.'foodsaver WHERE id = '.(int)$id.'
			)
		');

		$this->del('
            DELETE FROM '.PREFIX.'apitoken
            WHERE foodsaver_id = '.(int)$id.'
        ');
		$this->del('
            DELETE FROM '.PREFIX.'application_has_wallpost
            WHERE application_id = '.(int)$id.'
        ');
		$this->del('
            DELETE FROM '.PREFIX.'basket_anfrage
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'botschafter
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'buddy
            WHERE foodsaver_id = '.(int)$id.' OR buddy_id = '.(int)$id.'
        ');
		$this->del('
            DELETE FROM '.PREFIX.'email_status
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'fairteiler_follower
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'foodsaver_has_bell
            WHERE foodsaver_id = '.(int)$id.'
        ');
		$this->del('
            DELETE FROM '.PREFIX.'foodsaver_has_bezirk
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'foodsaver_has_contact
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'foodsaver_has_event
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'foodsaver_has_wallpost
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'mailbox_member
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'mailchange
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'pass_gen
            WHERE foodsaver_id = '.(int)$id.' OR bot_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'pass_request
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'quiz_session
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'rating
            WHERE foodsaver_id = '.(int)$id.'
        ');
        $this->del('
            DELETE FROM '.PREFIX.'theme_follower
            WHERE foodsaver_id = '.(int)$id.'
        ');

		$this->update('UPDATE '.PREFIX.'foodsaver SET verified = 0,
			rolle = 0,
			plz = NULL,
			stadt = NULL,
			lat = NULL,
			lon = NULL,
			photo = NULL,
			email = NULL,
			passwd = NULL,
			name = NULL,
			nachname = NULL,
			anschrift = NULL,
			telefon = NULL,
			tox = NULL,
			github = NULL,
			twitter = NULL,
			handy = NULL,
			geb_datum = NULL,
			deleted_at = NOW()
			WHERE id = '.(int)$id);
	}

	public function getBezirk($id = false)
	{
		if($id === false && isset($_SESSION['client']['bezirk_id']) && (int)$_SESSION['client']['bezirk_id'] > 0)
		{
			$id = $_SESSION['client']['bezirk_id'];
		}

		if($id == 0)
		{
			return false;
		}

		return $this->qRow('
			SELECT 	`name`,
					`id`,
					`email`,
					`email_name`,
					`has_children`,
					`parent_id`,
					`mailbox_id`

			FROM 	`'.PREFIX.'bezirk`
			WHERE 	`id` = '.$this->intval($id));

	}

	public function getEmailsToSend()
	{
		$row = $this->qRow('

				SELECT 	`fs_send_email`.`id`,
						`fs_send_email`.`name`,
						`fs_send_email`.`message`,
						`fs_send_email`.`zeit`,
						COUNT( `'.PREFIX.'email_status`.`foodsaver_id` ) AS `anz`

				FROM 	 `'.PREFIX.'send_email`,
						 `'.PREFIX.'email_status`

				WHERE 	`'.PREFIX.'email_status`.`email_id` =  `'.PREFIX.'send_email`.`id`

				AND 	`'.PREFIX.'send_email`.`foodsaver_id` = '.$this->intval(fsId()).'

				AND 	`'.PREFIX.'email_status`.`status` = 0

			');

		if($row['anz'] == 0)
		{
			return false;
		}
		else
		{
			return $row;
		}
	}

	public function setEmailStatus($mail_id,$foodsaver,$status)
	{
		$query = '';
		if(is_array($foodsaver))
		{
			$query = array();
			foreach ($foodsaver as $fs)
			{
				$query[] = '`foodsaver_id` = '.$this->intval($fs['id']);
			}

			$query = implode(' OR ', $query);
		}
		else
		{
			$query = '`foodsaver_id` = '.$this->intval($foodsaver);
		}

		return $this->update('
			UPDATE 	`'.PREFIX.'email_status`
			SET 	`status` = '.$this->intval($status).'
			WHERE 	`email_id` = '.$this->intval($mail_id).'
			AND 	('.$query.')
		');
	}

	public function getMailsLeft($mail_id)
	{
		return $this->qOne('SELECT COUNT(`email_id`) FROM `'.PREFIX.'email_status` WHERE `email_id` = '.$this->intval($mail_id).' AND `status` = 0');
	}

	public function getMailNext($mail_id)
	{
		return $this->q('
			SELECT
			s.`email_id`,
			fs.`id`,
			s.`status`,
			fs.`name`,
			fs.`geschlecht`,
			fs.`email`,
			fs.`token`

			FROM 		`'.PREFIX.'email_status` s,
						`'.PREFIX.'foodsaver` fs

			WHERE 		fs.`id` = s.`foodsaver_id`
			AND 		s.email_id = '.(int)$mail_id.'

			AND 		s.`status` = 0

			LIMIT 10
		');
	}

	public function getEmailBotFromBezirkList($bezirklist)
	{
		$list = array();
		foreach ($bezirklist as $i => $b)
		{
			if($b > 0)
			{
				$list[$b] =$b;
			}
		}
		ksort($list);

		$query = array();
		foreach ($list as $b)
		{
			$query[] = $this->intval($b);
		}

		$foodsaver = $this->q('
			SELECT 			fs.`id`,
							fs.`name`,
							fs.`nachname`,
							fs.`geschlecht`,
							fs.`email`

			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'botschafter` b

			WHERE 	b.foodsaver_id = fs.id
			AND		b.`bezirk_id`  IN('.implode(',', $query).')
			AND		fs.deleted_at IS NULL;
		');

		$out = array();
		foreach ($foodsaver as $fs)
		{
			$out[$fs['id']] = $fs;
		}

		return $out;
	}

	public function getEmailBiepBez($bezirklist)
	{
		$list = array();
		foreach ($bezirklist as $i => $b)
		{
			if($b > 0)
			{
				$list[$b] =$b;
			}
		}
		ksort($list);

		$query = array();
		foreach ($list as $b)
		{
			$query[] = $this->intval($b);
		}

		if($verant = $this->q('
			SELECT 	fs.`id`,
					fs.`email`

			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'betrieb_team` bt,
					`'.PREFIX.'foodsaver_has_bezirk` b

			WHERE 	bt.foodsaver_id = fs.id
			AND 	bt.foodsaver_id = b.foodsaver_id
			AND 	bt.verantwortlich = 1
			AND		b.`bezirk_id` IN('.implode(',', $query).')
			AND		fs.deleted_at IS NULL
		'))
		{
			$out = array();
			foreach ($verant as $v)
			{
				$out[$v['id']] = $v;
			}

			return $out;
		}
	}

	public function getEmailFoodSaverFromBezirkList($bezirklist)
	{
		$list = array();
		foreach ($bezirklist as $i => $b)
		{
			if($b > 0)
			{
				$list[$b] =$b;
			}
		}
		ksort($list);

		$query = array();
		foreach ($list as $b)
		{
			$query[] = $this->intval($b);
		}

		$foodsaver = $this->q('
			SELECT 			fs.`id`,
							fs.`name`,
							fs.`nachname`,
							fs.`geschlecht`,
							fs.`email`

			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'foodsaver_has_bezirk` b

			WHERE 	b.foodsaver_id = fs.id
			AND		b.`bezirk_id` IN('.implode(',', $query).')
			AND		fs.deleted_at IS NULL;
		');

		$out = array();
		foreach ($foodsaver as $fs)
		{
			$out[$fs['id']] = $fs;
		}

		return $out;
	}

	public function initEmail($mailbox_id,$foodsaver,$message,$subject,$attach,$mode)
	{
		if((int)$mailbox_id == 0)
		{
			return false;
		}

		$attach_db = '';
		if($attach !== false)
		{
			$attach_db = json_encode(array($attach));
		}

		if(!isOrgateam())
		{
			$mode = 1;
		}

		$data = array
		(
			'mailbox_id' => $mailbox_id,
			'subject' => $subject,
			'message' => $message,
			'attach' => $attach_db,
			'mode' => $mode
		);

		$email_id = $this->add_sendMail($data);

		$query = array();
		foreach ($foodsaver as $fs)
		{
			$query[] = '('.$this->intval($email_id).','.$this->intval($fs['id']).',0)';
		}

		if(isAdmin())
		{

		}
		/*
		 * Array
		(
		    [0] => (33,56,0)
		    [1] => (33,146,0)
		)
		 */
		$this->sql('
			INSERT INTO `'.PREFIX.'email_status` (`email_id`,`foodsaver_id`,`status`)
			VALUES
			'.implode(',', $query).';
		');
	}

	public function getOne_send_email($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`foodsaver_id`,
			`mailbox_id`,
			`mode`,
			`complete`,
			`name`,
			`message`,
			`zeit`,
			`recip`,
			`attach`

			FROM 		`'.PREFIX.'send_email`

			WHERE 		`id` = ' . $this->intval($id));



		return $out;
	}

	private function add_sendMail($data)
	{
		if(!isset($data['mode']))
		{
			$data['mode'] = 1;
		}

		return $this->insert('
				INSERT INTO 	'.PREFIX.'send_email (foodsaver_id, mailbox_id, name,`mode`, message, zeit, `attach`)

				VALUES(
					'.$this->intval(fsId()).',
					'.$this->intval($data['mailbox_id']).',
					'.$this->strval($data['subject']).',
					'.(int)$data['mode'].',
					'.$this->strval($data['message'],true).',
					'.$this->dateval(date('Y-m-d H:i:s')).',
					'.$this->strval($data['attach']).'
				)

		');
	}

	public function xhr_add_betrieb_kategorie($data)
	{
		$name = urldecode($data['neu']);
		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'betrieb_kategorie`
			(
			`name`
			)
			VALUES
			(
			'.$this->strval($name).'
			)');


		return json_encode(array('id'=>$id,'name'=>strip_tags($name)));
	}

	public function getMailBezirk($id)
	{
		return $this->qRow('
			SELECT
			`id`,
			`name`,
			`email`,
			`email_name`,
			`email_pass`

			FROM 		`'.PREFIX.'bezirk`

			WHERE 		`id` = ' . $this->intval($id));
	}

	public function getMailboxname($mailbox_id)
	{
		return $this->qOne('SELECT `name` FROM '.PREFIX.'mailbox WHERE id = '.(int)$mailbox_id);
	}

	public function getOne_bezirk($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`parent_id`,
			`has_children`,
			`name`,
			`email`,
			`email_pass`,
			`email_name`,
			`type`,
			`master`,
			`mailbox_id`

			FROM 		`'.PREFIX.'bezirk`

			WHERE 		`id` = ' . $this->intval($id));
		$out['botschafter'] = $this->q('
				SELECT 		`'.PREFIX.'foodsaver`.`id`,
							CONCAT(`'.PREFIX.'foodsaver`.`name`," ",`'.PREFIX.'foodsaver`.`nachname`) AS name

				FROM 		`'.PREFIX.'botschafter`,
							`'.PREFIX.'foodsaver`

				WHERE 		`'.PREFIX.'foodsaver`.`id` = `'.PREFIX.'botschafter`.`foodsaver_id`
				AND 		`'.PREFIX.'botschafter`.`bezirk_id` = '.$this->intval($id).'
			');

		$out['foodsaver'] = $this->qCol('
				SELECT 		`foodsaver_id`

				FROM 		`'.PREFIX.'botschafter`
				WHERE 		`bezirk_id` = '.$this->intval($id).'
			');

		return $out;
	}

	public function getBasics_foodsaver($bezirk_id = false)
	{
		if(!$bezirk_id)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}
		return $this->q('
			SELECT 	 	`id`,
						CONCAT(`name`," ",`nachname`) AS `name`,
						`anschrift`

			FROM 		`'.PREFIX.'foodsaver`

			WHERE 		`bezirk_id` = '.$this->intval($bezirk_id).'
			AND			deleted_at IS NULL

			ORDER BY `name`');
	}

	public function update_bezirkNew($id,$data)
	{

    $bezirk_id = $this->intval($id);
		if(isset($data['botschafter']) && is_array($data['botschafter']))
		{

			$this->del('
					DELETE FROM 	`'.PREFIX.'botschafter`
					WHERE 			`bezirk_id` = '.$this->intval($id).'
				');
			$master = 0;
			if(isset($data['master']))
			{
				$master = (int)$data['master'];
			}
			foreach($data['botschafter'] as $foodsaver_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'botschafter`
						(
							`bezirk_id`,
							`foodsaver_id`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($foodsaver_id).'
						)
					');
				//$this->update('UPDATE '.PREFIX.'foodsaver SET `bezirk_id` = '.(int)$id.' WHERE `id` = '.(int)$foodsaver_id);
			}
		}

	  $this->begin_transaction();

		if((int)$data['parent_id'] > 0)
		{
			$this->update('UPDATE `'.PREFIX.'bezirk` SET `has_children` = 1 WHERE `id` = '.(int)$data['parent_id']);
		}

		$has_children = 0;
		if($this->q('
			SELECT	id FROM '.PREFIX.'bezirk WHERE parent_id = '.(int)$id.'
		'))
		{
			$has_children = 1;
		}

		Mem::del('cb-'.$id);

		$this->update('
		UPDATE 	`'.PREFIX.'bezirk`

		SET 	`name` =  '.$this->strval($data['name']).',
				`email_name` =  '.$this->strval($data['email_name']).',
				`parent_id` = '.$this->intval($data['parent_id']).',
				`type` = '.(int)$data['type'].',
				`master` = '.(int)$master.',
				`has_children` = '.(int)$has_children.'

		WHERE 	`id` = '.$this->intval($id));

    $this->sql('DELETE a FROM `'.PREFIX.'bezirk_closure` AS a JOIN `'.PREFIX.'bezirk_closure` AS d ON a.bezirk_id = d.bezirk_id LEFT JOIN `'.PREFIX.'bezirk_closure` AS x ON x.ancestor_id = d.ancestor_id AND x.bezirk_id = a.ancestor_id WHERE d.ancestor_id = '.(int)$bezirk_id.' AND x.ancestor_id IS NULL');
    $this->sql('INSERT INTO `'.PREFIX.'bezirk_closure` (ancestor_id, bezirk_id, depth) SELECT supertree.ancestor_id, subtree.bezirk_id, supertree.depth+subtree.depth+1 FROM `'.PREFIX.'bezirk_closure` AS supertree JOIN `'.PREFIX.'bezirk_closure` AS subtree WHERE subtree.ancestor_id = '.(int)$bezirk_id.' AND supertree.bezirk_id = '.(int)$this->intval($data['parent_id']));
    $this->commit();

	}

	public function update_blog_entry($id,$data)
	{
		$pic = '';
		if(!empty($data['picture']))
		{
			$pic = ',`picture` =  '.$this->strval($data['picture']);
		}
		return $this->update('
		UPDATE 	`'.PREFIX.'blog_entry`

		SET 	`bezirk_id` =  '.$this->intval($data['bezirk_id']).',
				`foodsaver_id` =  '.$this->intval($data['foodsaver_id']).',
				`name` =  '.$this->strval($data['name']).',
				`teaser` =  '.$this->strval($data['teaser']).',
				`body` =  '.$this->strval($data['body'],true).',
				`time` =  '.$this->dateval($data['time']).'
				'.$pic.'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function update_bezirk($id,$data)
	{

		if(isset($data['foodsaver']) && is_array($data['foodsaver']))
		{

			$this->del('
					DELETE FROM 	`fs_botschafter`
					WHERE 			`bezirk_id` = '.$this->intval($id).'
				');

			foreach($data['foodsaver'] as $foodsaver_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'botschafter`
						(
							`bezirk_id`,
							`foodsaver_id`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($foodsaver_id).'
						)
					');
			}
		}

		Mem::del('cb-'.$id);

		return $this->update('
		UPDATE 	`'.PREFIX.'bezirk`

		SET 	`name` =  '.$this->strval($data['name']).'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function addFoodsaver($data)
	{
		$data['new_bezirk'] = trim($data['stadtteil']);

		$data['want_new'] = 0;

		if(!empty($data['new_bezirk']))
		{
			$data['want_new'] = 1;
		}

		if($fs_id = $this->regUser($data))
		{
			if($data['geschlecht'] == 'Mann')
			{
				$data['geschlecht'] = 1;
			}
			elseif($data['geschlecht'] == 'Frau')
			{
				$data['geschlecht'] = 2;
			}
			else
			{
				$data['geschlecht'] = 3;
			}

			if($data['geschlecht'] == 1)
			{
				$anrede = 'Lieber';
			}
			elseif($data['geschlecht'] == 2)
			{
				$anrede = 'Liebe';
			}
			else
			{
				$anrede = 'Liebe/r';
			}

			$bezirk = $this->getBezirk($data['bezirk_id']);

			$mail_vars = array(
				'anrede' => $anrede,
				'name' => $data['name'],
				'bezirk' => $bezirk['name']
			);

			$botschafter = false;
			if($botschafter = $this->getBotschafter($data['bezirk_id']))
			{
				$botschafter = $botschafter[0];

				$mail_vars['botschafter'] = $botschafter['name'];

				// Foodsaver
				if($data['rolle'] == 2)
				{
					tplMail(3, $data['email'],$mail_vars);
				}
				else if($data['rolle'] == 3)
				{
					// Botschafter
					tplMail(2, $data['email'],$mail_vars);
				}
				else
				{
					// Freiwillige
					tplMail(1, $data['email'],$mail_vars);
				}

			}
			else
			{
				// leerer bezirk
				if($data['rolle'] == 3)
				{
					// Botschafter in leerem Bezirk
					tplMail(23, $data['email'],$mail_vars);
				}
				else
				{
					// Foodsaver in leerem bezirk
					tplMail(2, $data['email'],$mail_vars);
				}
			}

			if($data['want_new'] == 1)
			{
				tplMail(5, $data['email'],$mail_vars);
			}

			return true;
		}
		else
		{
			return false;
		}
	}

	public function getBotschafter($bezirk_id)
	{
		return $this->q('

				SELECT 	fs.`id`,
						fs.`email`,
						fs.`name`,
						fs.`name` AS `vorname`,
						fs.`nachname`,
						fs.`photo`,
						fs.`geschlecht`

				FROM `'.PREFIX.'foodsaver` fs,
				`'.PREFIX.'botschafter`

				WHERE fs.id = `'.PREFIX.'botschafter`.`foodsaver_id`

				AND `'.PREFIX.'botschafter`.`bezirk_id` = '.$this->intval($bezirk_id).'
				AND		fs.deleted_at IS NULL
		');
	}

	public function getAllBotschafter()
	{
		return $this->q('

				SELECT 		fs.`id`,
							fs.`name`,
							fs.`nachname`,
							fs.`geschlecht`,
							fs.`email`

				FROM 		`'.PREFIX.'foodsaver` fs
				WHERE		fs.id
				IN			(SELECT foodsaver_id
							FROM `'.PREFIX.'fs_botschafter` b
							LEFT JOIN `'.PREFIX.'bezirk` bz
							ON b.bezirk_id = bz.id
							WHERE bz.type != 7
							)
				AND		fs.deleted_at IS NULL
				');
	}

	public function getAllFoodsaverNoBotschafter()
	{
		$foodsaver = $this->getAllFoodsaver();
		$out = array();

		$botschafter = $this->getAllBotschafter();
		$bot = array();
		foreach ($botschafter as $b)
		{
			$bot[$b['id']] = true;
		}

		foreach ($foodsaver as $fs)
		{
			if(!isset($bot[$fs['id']]))
			{
				$out[] = $fs;
			}
		}

		return $out;
	}

	public function getOrgateam()
	{
		return $this->q('

				SELECT 		`id`,
							`name`,
							`nachname`,
							`geschlecht`,
							`email`

				FROM 		`'.PREFIX.'foodsaver`

				WHERE 		`orgateam` = 1

		');
	}

	public function updatePhoto($fs_id,$photo)
	{
		return $this->update('
				UPDATE `'.PREFIX.'foodsaver`
				SET 	`photo` = '.$this->strval($photo).'
				WHERE 	`id` = '.$this->intval($fs_id).'');
	}

	public function updateProfile($fs_id,$data)
	{
		if(!isset($data['bezirk_id']))
		{
			$data['bezirk_id'] = getBezirkId();
		}
		if(!isset($data['photo_public']))
		{
			$data['photo_public'] = 0;
		}
        if(!isset($data['position']))
        {
            $data['position'] = '';
        }

		$sql = '
		UPDATE 	`'.PREFIX.'foodsaver`

		SET
				`bezirk_id` =  '.$this->intval($data['bezirk_id']).',
				`plz` =  '.$this->strval($data['plz']).',
				`lat` =  '.$this->strval($data['lat']).',
				`lon` =  '.$this->strval($data['lon']).',
				`stadt` =  '.$this->strval($data['stadt']).',

				`anschrift` =  '.$this->strval($data['anschrift']).',
				`telefon` =  '.$this->strval($data['telefon']).',
				`handy` =  '.$this->strval($data['handy']).',
				`geb_datum` =  '.$this->dateval($data['geb_datum']).',

				`about_me_public` =  '.$this->strval($data['about_me_public']).',
				`photo_public` = '.$this->intval($data['photo_public']).',
				`homepage` = '.$this->strval($data['homepage']).',
				`twitter` = '.$this->strval($data['twitter']).',
				`tox` = '.$this->strval($data['tox']).',
				`position` = '.$this->strval($data['position']).',
				`github` = '.$this->strval($data['github']).'

		WHERE 	`id` = '.$this->intval($fs_id);

		//debug($sql);

		if($this->update($sql))
		{
			$this->relogin();
			return true;
		}

	}

	private function regUser($data)
	{
		/*
		 * Array
		(
				[geschlecht] =>
				[name] => Raphael
				[nachname] => Wintrich
				[anschrift] => Bauer 9
				[plz] => 50969
				[stadt] => Köln
				[region] => 9
				[nix] => 60
				[bezirk] => 43
				[stadtteil] => Zollstock
				[land_anders_value] =>
				[geb_datum] => 2013-08-22
				[fs_id] => 4565
				[email] =>
				[festnetz] =>
				[handy] =>
				[freiwilliger_foodsaver_oder_botschafter] =>
				[ansprechen_und_abholen] =>
				[wie_weit_reicht_dein_radius] =>
				[kuehlen_beim_abholen] =>
				[kontakte_betriebe] =>
				[werbung_fur_fs_sonstiges] =>
				[raumlichkeit] =>
				[programmierhilfe_sonstiges] =>
				[ausland_sprache_auf_mutterniveau] =>
				[aktiv_im_ausland] =>
				[unterstuetzung_orgateam] =>
				[talente_und_ressourcen] =>
				[fs_hotline] =>
				[anbaumoeglichkeiten] =>
				[wann_hast_du_zeit] =>
				[sharing_netzwerke_sonstiges] =>
				[erfahrung_essenretten] =>
				[containererfahrung] =>
				[wie_gehort_von_fs_sonstiges] =>
				[motivation] =>
				[berufung] =>
				[kommentare] =>
				[submit] => Anmeldung Absenden
				[submitted] => 1
		) */

		if($data['geschlecht'] == 'Frau')
		{
			$data['geschlecht'] = 2;
		}
		elseif($data['geschlecht'] == 'Mann')
		{
			$data['geschlecht'] = 1;
		}
		else
		{
			$data['geschlecht'] = 0;
		}




		$data['passwd'] = '';
		$data['telefon'] = $data['festnetz'];

		$data['anmeldedatum'] = date('Y-m-d H:i:s');

		$data['photo_public'] = 0;

		if(isset($data['bot_veroeff_foto_name']))
		{
			$data['photo_public'] = $data['bot_veroeff_foto_name'];
		}

		if(!isset($data['bot_kurzbeschreibung']))
		{
			$data['bot_kurzbeschreibung'] = '';
		}

		if(!isset($data['stadt']))
		{
			$data['stadt'] = '';
		}

		$lat = '';
		$lon = '';

		if($data['lat'] != 0)
		{
			$lat = $data['lat'];
		}
		if($data['lon'] != 0)
		{
			$lon = $data['lon'];
		}

		$sql = '
			INSERT INTO 	`'.PREFIX.'foodsaver`
			(
				`new_bezirk`,
				`want_new`,
				`rolle`,
				`active`,
				`data`,
				`bezirk_id`,
				`plz`,
				`email`,
				`passwd`,
				`name`,
				`nachname`,
				`anschrift`,
				`telefon`,
				`handy`,
				`geschlecht`,
				`geb_datum`,
				`anmeldedatum`,
				`photo_public`,
				`about_me_public`,
				`stadt`,
				`lat`,
				`lon`,
				`token`
			)
			VALUES
			(
				'.$this->strval($data['new_bezirk']).',
				'.(int)$data['want_new'].',
				1,
				0,
				'.$this->strval(json_encode($data)).',
				'.$this->intval($data['bezirk_id']).',
				'.$this->strval($data['plz']).',
				'.$this->strval($data['email']).',
				'.$this->strval($data['passwd']).',
				'.$this->strval($data['name']).',
				'.$this->strval($data['nachname']).',
				'.$this->strval($data['anschrift']).',
				'.$this->strval($data['telefon']).',
				'.$this->strval($data['handy']).',
				'.$this->intval($data['geschlecht']).',
				'.$this->dateval($data['geb_datum']).',
				'.$this->dateval($data['anmeldedatum']).',
				'.$this->intval($data['photo_public']).',
				'.$this->strval(strip_tags($data['bot_kurzbeschreibung'])).',
				'.$this->strval($data['stadt']).',
				'.$this->strval($lat).',
				'.$this->strval($lon).',
				'.$this->strval(uniqid('',true)).'
			)';

		if($id = $this->insert($sql))
		{
			if(isset($data['photo']) && strlen($data['photo']) > 5)
			{
				$big = str_replace('thumb_', '', $data['photo']);
				$thumb = $data['photo'];
				$original = str_replace('thumb_crop_', '', $data['photo']);
				$ext = explode('.', $big);
				$ext = end($ext);

				copy(ROOT_DIR.'tmp/'.$thumb, ROOT_DIR.'images/'.$thumb);
				copy(ROOT_DIR.'tmp/'.$big, ROOT_DIR.'images/'.$big);
				copy(ROOT_DIR.'tmp/'.$original, ROOT_DIR.'images/'.$original);

				@unlink(ROOT_DIR.'tmp/'.$thumb);
				@unlink(ROOT_DIR.'tmp/'.$big);
				@unlink(ROOT_DIR.'tmp/'.$original);

				$this->updatePhoto($id,$original);
				//makeThumbs($original);

			}
			return $id;
		}

		return false;
	}
	public function getOne_betrieb($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`betrieb_status_id`,
			`bezirk_id`,
			`plz`,
			`stadt`,
			`lat`,
			`lon`,
			`kette_id`,
			`betrieb_kategorie_id`,
			`name`,
			`str`,
			`hsnr`,
			`status_date`,
			`status`,
			`ansprechpartner`,
			`telefon`,
			`fax`,
			`email`,
			`begin`,
			`besonderheiten`,
			`ueberzeugungsarbeit`,
			`presse`,
			`sticker`,
			`abholmenge`,
			`prefetchtime`,
			`public_info`

			FROM 		`'.PREFIX.'betrieb`

			WHERE 		`id` = ' . $this->intval($id));


		$out['lebensmittel'] = $this->qCol('
				SELECT 		`lebensmittel_id`

				FROM 		`'.PREFIX.'betrieb_has_lebensmittel`
				WHERE 		`betrieb_id` = '.$this->intval($id).'
			');
		$out['foodsaver'] = $this->qCol('
				SELECT 		`foodsaver_id`

				FROM 		`'.PREFIX.'betrieb_team`
				WHERE 		`betrieb_id` = '.$this->intval($id).'
				AND 		`active` = 1
			');

		return $out;
	}

	public function changeBetriebStatus($bid,$status)
	{
		$last = $this->qRow('SELECT id, milestone FROM `'.PREFIX.'betrieb_notiz` WHERE `betrieb_id` = '.(int)$bid.' ORDER BY id DESC LIMIT 1');

		if($last['milestone'] == 3)
		{
			$this->del('
				DELETE FROM 	`'.PREFIX.'betrieb_notiz`
				WHERE	id = '.(int)$last['id'].'
			');
		}

		$this->add_betrieb_notiz(array(
				'foodsaver_id' =>fsId(),
				'betrieb_id' => $bid,
				'text' => 'status_msg_'.(int)$status,
				'zeit' => date('Y-m-d H:i:s'),
				'milestone' => 3
		));

		return $this->update('
			UPDATE 	`'.PREFIX.'betrieb`

			SET 	`betrieb_status_id` =  '.$this->intval($status).'

			WHERE 	`id` = '.(int)$bid.' '
		);
	}

	public function add_betrieb_notiz($data)
	{
		$last = 0;
		if(isset($data['last']) && $data['last'] == 1)
		{
			$this->update('
				UPDATE 	`'.PREFIX.'betrieb_notiz`
				SET 	`last` = 0
				WHERE 	`betrieb_id` = '.(int)$data['betrieb_id'].'
				AND 	`last` = 1
			');
			$last = 1;
		}

		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'betrieb_notiz`
			(
			`foodsaver_id`,
			`betrieb_id`,
			`milestone`,
			`text`,
			`zeit`,
			`last`
			)
			VALUES
			(
			'.$this->intval($data['foodsaver_id']).',
			'.$this->intval($data['betrieb_id']).',
			'.$this->intval($data['milestone']).',
			'.$this->strval($data['text']).',
			'.$this->dateval($data['zeit']).',
			'.$this->intval($last).'
			)');



		return $id;
	}

	public function update_betrieb($id,$data)
	{
		if(isset($data['lebensmittel']) && is_array($data['lebensmittel']))
		{

			$this->del('
					DELETE FROM 	`fs_betrieb_has_lebensmittel`
					WHERE 			`betrieb_id` = '.$this->intval($id).'
				');

			foreach($data['lebensmittel'] as $lebensmittel_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'betrieb_has_lebensmittel`
						(
							`betrieb_id`,
							`lebensmittel_id`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($lebensmittel_id).'
						)
					');
			}
		}
		if(isset($data['foodsaver']) && is_array($data['foodsaver']))
		{

			$this->update('
					UPDATE 	 		`fs_betrieb_team`
					SET 			`verantwortlich` = 0
					WHERE 			`betrieb_id` = '.$this->intval($id).'
				');

			foreach($data['foodsaver'] as $foodsaver_id)
			{
				$this->insert('
						REPLACE INTO `'.PREFIX.'betrieb_team`
						(
							`betrieb_id`,
							`foodsaver_id`,
							`verantwortlich`,
							`active`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($foodsaver_id).',
							1,
							1
						)
					');
			}
		}

		if(!isset($data['status_date']))
		{
			$data['status_date'] = date('Y-m-d H:i:s');
		}

		return $this->update('
		UPDATE 	`'.PREFIX.'betrieb`

		SET 	`betrieb_status_id` =  '.$this->intval($data['betrieb_status_id']).',
				`bezirk_id` =  '.$this->intval($data['bezirk_id']).',
				`plz` =  '.$this->strval($data['plz']).',
				`stadt` =  '.$this->strval($data['stadt']).',
				`lat` =  '.$this->strval($data['lat']).',
				`lon` =  '.$this->strval($data['lon']).',
				`kette_id` =  '.$this->intval($data['kette_id']).',
				`betrieb_kategorie_id` =  '.$this->intval($data['betrieb_kategorie_id']).',
				`name` =  '.$this->strval($data['name']).',
				`str` =  '.$this->strval($data['str']).',
				`hsnr` =  '.$this->strval($data['hsnr']).',
				`status_date` =  '.$this->dateval($data['status_date']).',
				`ansprechpartner` =  '.$this->strval($data['ansprechpartner']).',
				`telefon` =  '.$this->strval($data['telefon']).',
				`fax` =  '.$this->strval($data['fax']).',
				`email` =  '.$this->strval($data['email']).',
				`begin` =  '.$this->dateval($data['begin']).',
				`besonderheiten` =  '.$this->strval($data['besonderheiten']).',
				`public_info` =  '.$this->strval($data['public_info']).',
				`public_time` =  '.$this->intval($data['public_time']).',
				`ueberzeugungsarbeit` =  '.$this->intval($data['ueberzeugungsarbeit']).',
				`presse` =  '.$this->intval($data['presse']).',
				`sticker` =  '.$this->intval($data['sticker']).',
				`abholmenge` =  '.$this->intval($data['abholmenge']).',
				`prefetchtime` = '.(int)$data['prefetchtime'].'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function acceptBezirkRequest($fsid,$bid)
	{
		$bezirk = $this->getVal('name', 'bezirk', $bid);
		return $this->update('
					UPDATE 	 	`'.PREFIX.'foodsaver_has_bezirk`
					SET 		`active` = 1,
								`added` = NOW()

					WHERE 		`bezirk_id` = '.$this->intval($bid).'
					AND 		`foodsaver_id` = '.$this->intval($fsid).'
		');
	}

	public function linkBezirk($fsid,$bid,$active = 1)
	{
		return $this->insert('
			REPLACE INTO `'.PREFIX.'foodsaver_has_bezirk`
			(
				`bezirk_id`,
				`foodsaver_id`,
				`added`,
				`active`
			)
			VALUES
			(
				'.$this->intval($bid).',
				'.$this->intval($fsid).',
				NOW(),
				'.(int)$active.'
			)
		');
	}

	public function denyBezirkRequest($fsid,$bid)
	{
		$bezirk = $this->getVal('name', 'bezirk', $bid);

		return $this->update('
					DELETE FROM  `'.PREFIX.'foodsaver_has_bezirk`
					WHERE 		`bezirk_id` = '.$this->intval($bid).'
					AND 		`foodsaver_id` = '.$this->intval($fsid).'
		');
	}

	public function acceptRequest($fsid,$bid)
	{
		$betrieb = $this->getVal('name', 'betrieb', $bid);

		$model = loadModel('betrieb');
		$model->addBell((int)$fsid, 'store_request_accept_title', 'store_request_accept', 'img img-store brown', array(
				'href' => '/?page=fsbetrieb&id='.(int)$bid
			), array(
				'user' => S::user('name'),
				'name' => $betrieb
			), 'store-arequest-'.(int)$fsid);

		$msg = loadModel('msg');

		if($scid = $msg->getBetriebConversation($bid, true))
		{
			$msg->deleteUserFromConversation($scid, $fsid, true);
		}

		if($tcid = $msg->getBetriebConversation($bid, false))
		{
			$msg->addUserToConversation($tcid, $fsid, true);
		}

		return $this->update('
					UPDATE 	 	`'.PREFIX.'betrieb_team`
					SET 		`active` = 1
					WHERE 		`betrieb_id` = '.$this->intval($bid).'
					AND 		`foodsaver_id` = '.$this->intval($fsid).'
		');
	}

	public function warteRequest($fsid,$bid)
	{
		$betrieb = $this->getVal('name', 'betrieb', $bid);

		$model = loadModel('betrieb');
		$model->addBell((int)$fsid, 'store_request_accept_wait_title', 'store_request_accept_wait', 'img img-store brown', array(
				'href' => '/?page=fsbetrieb&id='.(int)$bid
			), array(
				'user' => S::user('name'),
				'name' => $betrieb
			), 'store-wrequest-'.(int)$fsid);

		$msg = loadModel('msg');
	    if($scid = $this->getBetriebConversation($bid, true))
	    {
	    	$msg->addUserToConversation($scid, $fsid, True);
	    }

	    return $this->update('
					UPDATE 	 	`'.PREFIX.'betrieb_team`
					SET 		`active` = 2
					WHERE 		`betrieb_id` = '.$this->intval($bid).'
					AND 		`foodsaver_id` = '.$this->intval($fsid).'
		');
	}

	public function denyRequest($fsid,$bid)
	{
		$betrieb = $this->getVal('name', 'betrieb', $bid);

		$model = loadModel('betrieb');
		$model->addBell((int)$fsid, 'store_request_deny_title', 'store_request_deny', 'img img-store brown', array(
				'href' => '/?page=fsbetrieb&id='.(int)$bid
			), array(
				'user' => S::user('name'),
				'name' => $betrieb
			), 'store-drequest-'.(int)$fsid);

		return $this->update('
					DELETE FROM 	`fs_betrieb_team`
					WHERE 		`betrieb_id` = '.$this->intval($bid).'
					AND 		`foodsaver_id` = '.$this->intval($fsid).'
		');
	}

	public function teamRequest($fsid,$bid)
	{
		return $this->insert('
			REPLACE INTO `'.PREFIX.'betrieb_team`
			(
				`betrieb_id`,
				`foodsaver_id`,
				`verantwortlich`,
				`active`
			)
			VALUES
			(
				'.$this->intval($bid).',
				'.$this->intval($fsid).',
				0,
				0
			)');
	}

	private function createTeamConversation($bid)
	{
		$msg = loadModel('msg');
		$tcid = $msg->insertConversation(array(), true);
		$betrieb = $this->getMyBetrieb($bid);
		$msg->renameConversation($tcid, "Team ".$betrieb['name']);

		$this->update('
				UPDATE	`'.PREFIX.'betrieb` SET team_conversation_id = '.$this->intval($tcid).' WHERE id = '.$this->intval($bid).'
			');

		$teamMembers = $this->getBetriebTeam($bid);
		foreach($teamMembers['id'] as $fs_id)
		{
			$msg->addUserToConversation($tcid, $fs_id);
		}

		return $tcid;

	}

	private function createSpringerConversation($bid)
	{
		$msg = loadModel('msg');
		$scid = $msg->insertConversation(array(), true);
		$betrieb = $this->getMyBetrieb($bid);
		$msg->renameConversation($scid, "Springer ".$betrieb['name']);
		$this->update('
				UPDATE	`'.PREFIX.'betrieb` SET springer_conversation_id = '.$this->intval($scid).' WHERE id = '.$this->intval($bid).'
			');



		$springerMembers = $this->getBetriebSpringer($bid);
		foreach($springerMembers['id'] as $fs_id)
		{
			$msg->addUserToConversation($scid, $fs_id);
		}
		return $scid;
	}

	public function add_betrieb($data)
	{
		$id = $this->insert('
			INSERT INTO 	`'.PREFIX.'betrieb`
			(
			`betrieb_status_id`,
			`bezirk_id`,
			`added`,
			`plz`,
			`stadt`,
			`lat`,
			`lon`,
			`kette_id`,
			`betrieb_kategorie_id`,
			`name`,
			`str`,
			`hsnr`,
			`status_date`,
			`status`,
			`ansprechpartner`,
			`telefon`,
			`fax`,
			`email`,
			`begin`,
			`besonderheiten`,
			`public_info`,
			`public_time`,
			`ueberzeugungsarbeit`,
			`presse`,
			`sticker`,
      `abholmenge`
			)
			VALUES
			(
			'.$this->intval($data['betrieb_status_id']).',
			'.$this->intval($data['bezirk_id']).',
			NOW(),
			'.$this->strval($data['plz']).',
			'.$this->strval($data['stadt']).',
			'.$this->strval($data['lat']).',
			'.$this->strval($data['lon']).',
			'.$this->intval($data['kette_id']).',
			'.$this->intval($data['betrieb_kategorie_id']).',
			'.$this->strval($data['name']).',
			'.$this->strval($data['str']).',
			'.$this->strval($data['hsnr']).',
			'.$this->dateval($data['status_date']).',
			'.$this->intval($data['betrieb_status_id']).',
			'.$this->strval($data['ansprechpartner']).',
			'.$this->strval($data['telefon']).',
			'.$this->strval($data['fax']).',
			'.$this->strval($data['email']).',
			'.$this->dateval($data['begin']).',
			'.$this->strval($data['besonderheiten']).',
			'.$this->strval($data['public_info']).',
			'.$this->intval($data['public_time']).',
			'.$this->intval($data['ueberzeugungsarbeit']).',
			'.$this->intval($data['presse']).',
			'.$this->intval($data['sticker']).',
      '.$this->intval($data['abholmenge']).'
			)');

		$this->createTeamConversation($id);
		$this->createSpringerConversation($id);

		if(isset($data['lebensmittel']) && is_array($data['lebensmittel']))
		{
			foreach($data['lebensmittel'] as $lebensmittel_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'betrieb_has_lebensmittel`
						(
							`betrieb_id`,
							`lebensmittel_id`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($lebensmittel_id).'
						)
					');
			}
		}

		if(isset($data['foodsaver']) && is_array($data['foodsaver']))
		{
			foreach($data['foodsaver'] as $foodsaver_id)
			{
				$this->insert('
						REPLACE INTO `'.PREFIX.'betrieb_team`
						(
							`betrieb_id`,
							`foodsaver_id`,
							`verantwortlich`,
							`active`
						)
						VALUES
						(
							'.$this->intval($id).',
							'.$this->intval($foodsaver_id).',
							1,
							1
						)
					');
			}
		}

		return $id;
	}



	public function getMyBetrieb($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`betrieb_status_id`,
			`bezirk_id`,
			`plz`,
			`stadt`,
			`lat`,
			`lon`,
			`kette_id`,
			`betrieb_kategorie_id`,
			`name`,
			`str`,
			`hsnr`,
			`status_date`,
			`status`,
			`ansprechpartner`,
			`telefon`,
			`fax`,
			`email`,
			`begin`,
			`besonderheiten`,
			`public_info`,
			`public_time`,
			`ueberzeugungsarbeit`,
			`presse`,
			`sticker`,
			`abholmenge`,
			`team_status`,
		      `prefetchtime`,
		      `team_conversation_id`,
		      `springer_conversation_id`

			FROM 		`'.PREFIX.'betrieb`

			WHERE 		`id` = ' . $this->intval($id));

		$out['lebensmittel'] = $this->q('
				SELECT 		l.`id`,
							l.name

				FROM 		`'.PREFIX.'betrieb_has_lebensmittel` hl,
							`'.PREFIX.'lebensmittel` l
				WHERE 		l.id = hl.lebensmittel_id
				AND 		`betrieb_id` = '.$this->intval($id).'
		');

		$out['foodsaver'] = $this->getBetriebTeam($id);

		$out['springer'] = $this->getBetriebSpringer($id);

		$out['requests'] = $this->q('
				SELECT 		fs.`id`,
							fs.photo,
							CONCAT(fs.name," ",fs.nachname) AS name,
							name as vorname,
							fs.sleep_status

				FROM 		`'.PREFIX.'betrieb_team` t,
							`'.PREFIX.'foodsaver` fs

				WHERE 		fs.id = t.foodsaver_id
				AND 		`betrieb_id` = '.$this->intval($id).'
				AND 		t.active = 0
				AND			fs.deleted_at IS NULL
		');

		$out['verantwortlich'] = false;
		$foodsaver = array();
		$out['team_js'] = array();
		$out['team'] = array();
		$out['jumper'] = false;

		if(!empty($out['springer']))
		{
			foreach ($out['springer'] as $v)
			{
				if($v['id'] == fsId())
				{
					$out['jumper'] = true;
				}
			}
		}

		if(!empty($out['foodsaver']))
		{
			$out['team'] = array();
			foreach ($out['foodsaver'] as $v)
			{
				$out['team_js'][] = $v['id'];
				$foodsaver[$v['id']] = $v['name'];
				$out['team'][] = array('id'=>$v['id'],'value'=>$v['name']);
				if($v['verantwortlich'] == 1)
				{
					$out['verantwortlicher'] = $v['id'];
					if($v['id'] == fsId())
					{
						$out['verantwortlich'] = true;
					}

				}
			}
		}
		else
		{
			$out['foodsaver'] = array();
		}
		$out['team_js'] = implode(',', $out['team_js']);

		$out['abholer'] = false;
		if($abholer = $this->q('SELECT `betrieb_id`,`dow` FROM `'.PREFIX.'abholzeiten` WHERE `betrieb_id` = '.(int)$id))
		{
			$out['abholer'] = array();
			foreach ($abholer as $a)
			{
				if(!isset($out['abholer'][$a['dow']]))
				{
					$out['abholer'][$a['dow']] = array();
				}
				// todo...
				//$out['abholer'][$a['dow']][] = array('name' => $foodsaver[$a['foodsaver_id']]);
			}
			//$out['abholer'] = $abholer;
		}

		return $out;
	}

	public function getBetriebLeader($bid)
	{
		return $this->qCol('
				SELECT 		t.`foodsaver_id`,
							t.`verantwortlich`

				FROM 		`'.PREFIX.'betrieb_team` t
				INNER JOIN  `'.PREFIX.'foodsaver` fs ON fs.id = t.foodsaver_id

				WHERE 		t.`betrieb_id` = '.$this->intval($bid).'
				AND 		t.active = 1
				AND 		t.verantwortlich = 1
				AND			fs.deleted_at IS NULL
		');
	}

	public function getBetriebTeam($bid)
	{
		return $this->q('
				SELECT 		fs.`id`,
							fs.`verified`,
							fs.`active`,
							fs.`telefon`,
							fs.`handy`,
							fs.photo,
							fs.quiz_rolle,
							fs.rolle,
							CONCAT(fs.name," ",fs.nachname) AS name,
							name as vorname,
							t.`verantwortlich`,
							t.`stat_last_update`,
							t.`stat_fetchcount`,
							t.`stat_first_fetch`,
							UNIX_TIMESTAMP(t.`stat_last_fetch`) AS last_fetch,
							UNIX_TIMESTAMP(t.`stat_add_date`) AS add_date,
							fs.sleep_status


				FROM 		`'.PREFIX.'betrieb_team` t,
							`'.PREFIX.'foodsaver` fs

				WHERE 		fs.id = t.foodsaver_id
				AND 		`betrieb_id` = '.$this->intval($bid).'
				AND 		t.active  = 1
				AND			fs.deleted_at IS NULL
				ORDER BY 	t.`stat_fetchcount` DESC
		');
	}

	public function getBetriebSpringer($bid)
	{
		return $this->q('
				SELECT 		fs.`id`,
							fs.`active`,
							fs.`telefon`,
							fs.`handy`,
							fs.photo,
							fs.rolle,
							CONCAT(fs.name," ",fs.nachname) AS name,
							name as vorname,
							t.`verantwortlich`,
							t.`stat_last_update`,
							t.`stat_fetchcount`,
							t.`stat_first_fetch`,
							UNIX_TIMESTAMP(t.`stat_add_date`) AS add_date,
							fs.sleep_status

				FROM 		`'.PREFIX.'betrieb_team` t,
							`'.PREFIX.'foodsaver` fs

				WHERE 		fs.id = t.foodsaver_id
				AND 		`betrieb_id` = '.$this->intval($bid).'
				AND 		t.active  = 2
				AND			fs.deleted_at IS NULL
		');
	}

	public function addAbholer($betrieb_id,$foodsaver_id,$dow)
	{
		return $this->sql('INSERT INTO `'.PREFIX.'abholer`(`betrieb_id`,`foodsaver_id`,`dow`)VALUES('.$this->intval($betrieb_id).','.$this->intval($foodsaver_id).','.$this->intval($dow).') ');
	}

	public function clearAbholer($betrieb_id)
	{
		$this->del('DELETE FROM `'.PREFIX.'abholer` WHERE `betrieb_id` = '.(int)$betrieb_id);
	}

	public function getBetriebConversation($bid,$springerConversation = false)
	{
		if($springerConversation)
		{
			$ccol = 'springer_conversation_id';
		}
		else
		{
			$ccol = 'team_conversation_id';
		}

		return $this->qOne('SELECT '.$ccol.' FROM `'.PREFIX.'betrieb` WHERE `id` = '.(int)$bid);
	}


	public function addBetriebTeam($bid,$member,$verantwortlicher = false)
	{
		if(empty($member))
		{
			return false;
		}
		if(!$verantwortlicher)
		{
			$verantwortlicher = array(
				fsId() => true
			);
		}

		$tmp = array();
		foreach ($verantwortlicher as $vv)
		{
			$tmp[$vv] = $vv;
		}
		$verantwortlicher = $tmp;



		$values = array();
		$member_ids = array();

		foreach ($member as $m)
		{
			$v = 0;
			if(isset($verantwortlicher[$m]))
			{
				$v = 1;
			}
			$member_ids[] = (int)$m;
			$values[] = '('.$this->intval($bid).','.$this->intval($m).','.$v.',1)';
		}

		$this->del('DELETE FROM `'.PREFIX.'betrieb_team` WHERE `betrieb_id` = '.$this->intval($bid).' AND active = 1 AND foodsaver_id NOT IN('.implode(',', $member_ids).')');

		$sql = 'INSERT IGNORE INTO `'.PREFIX.'betrieb_team` (`betrieb_id`,`foodsaver_id`,`verantwortlich`,`active`)VALUES'.implode(',', $values);

		$msg = loadModel('msg');

		if($cid = $this->getBetriebConversation($bid))
		{
			$msg->setConversationMembers($cid, $member_ids);
		}

		if($sid = $this->getBetriebConversation($bid, true)) {
			foreach($verantwortlicher as $user) {
				$msg->addUserToConversation($sid, $user);
			}
		}

		if($this->sql($sql))
		{
			$this->update('
				UPDATE	`'.PREFIX.'betrieb_team` SET verantwortlich = 0 WHERE betrieb_id = '.$this->intval($bid).'
			');
			$this->update('
				UPDATE	`'.PREFIX.'betrieb_team` SET verantwortlich = 1 WHERE betrieb_id = '.$this->intval($bid).' AND foodsaver_id IN('.implode(',', $verantwortlicher).')
			');
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getWantNew($bezirk_id)
	{
		$onlybot = '';

		if(!isOrgaTeam())
		{
			$bid = array();
			foreach ($_SESSION['client']['botschafter'] as $bezirk)
			{
				$bid[] = (int)$bezirk['bezirk_id'];
			}
			$onlybot = 'AND (	`bezirk_id` = '.implode(' OR `bezirk_id` = ', $bid).' )	';
		}

		return $this->q('
			SELECT 	`'.PREFIX.'foodsaver`.`id`,
					`'.PREFIX.'foodsaver`.`name`,
					`'.PREFIX.'foodsaver`.`photo`,
					`'.PREFIX.'foodsaver`.`nachname`,
					`'.PREFIX.'foodsaver`.`new_bezirk`,
					`'.PREFIX.'foodsaver`.`bezirk_id`,
					`'.PREFIX.'bezirk`.`name` AS bezirk_name
			FROM 	`'.PREFIX.'foodsaver` fs,
					`'.PREFIX.'bezirk`

			WHERE 	`'.PREFIX.'foodsaver`.`bezirk_id` = `'.PREFIX.'bezirk`.`id`

			AND 	`want_new` = 1
			AND		fs.deleted_at IS NULL

			'.$onlybot.'

			ORDER BY `bezirk_id`,`bezirk_name`
		');
	}

	public function getTeamleader($betrieb_id)
	{
		return $this->qRow('SELECT 	fs.`id`,CONCAT(fs.name," ",nachname) AS name  FROM '.PREFIX.'betrieb_team t, '.PREFIX.'foodsaver fs WHERE t.foodsaver_id = fs.id AND `betrieb_id` = '.$this->intval($betrieb_id).' AND t.verantwortlich = 1 AND fs.`active` = 1 AND	fs.deleted_at IS NULL');
	}


	public function getVerantwortlicher($betrieb_id)
	{
		return $this->qOne('SELECT 	`foodsaver_id`  FROM '.PREFIX.'betrieb_team WHERE `betrieb_id` = '.$this->intval($betrieb_id).' AND verantwortlich = 1 AND `active` = 1');
	}

	public function removeAllVerantwortlicher($betrieb_id)
	{
		return $this->del('
			DELETE FROM '.PREFIX.'betrieb_team

				WHERE 	betrieb_id = '.$this->intval($betrieb_id).'
				AND verantwortlich = 1
				AND 	active = 1
		');
	}

	public function addVerantwortlicher($fs_id,$betrieb_id)
	{
		return $this->insert('
			INSERT INTO '.PREFIX.'betrieb_team (foodsaver_id, betrieb_id, verantwortlich,active)
			VALUES('.$this->intval($fs_id).','.$this->intval($betrieb_id).',1,1)
		');
	}

	public function getAbholdates($bid,$dates)
	{
		if(!empty($dates))
		{
			$dsql = array();
			foreach ($dates as $date => $time)
			{
				$dsql[] = $this->dateval($date);
			}

			if($res = $this->q('
			SELECT 	fs.id,
					fs.name,
					fs.photo,
					a.date,
					a.confirmed

			FROM 	`'.PREFIX.'abholer` a,
					`'.PREFIX.'foodsaver` fs

			WHERE 	a.foodsaver_id = fs.id
			AND 	a.betrieb_id = '.(int)$bid.'
			AND  	a.date IN('.implode(',', $dsql).')
			AND		fs.deleted_at IS NULL
		'))
			{
				//print_r($res);
				global $g_data;
				foreach ($res as $r)
				{
					$key = 'fetch-'.str_replace(array(':',' ','-'), '', $r['date']);
					if(!isset($g_data[$key]))
					{
						$g_data[$key] = array();
					}
					$g_data[$key][] = $r;
				}
				return $res;
			}
		}
		return false;
	}

	public function confirmFetcher($fsid,$bid,$date)
	{
		return $this->update('

				UPDATE 	`' . PREFIX . 'abholer`
				SET 	`confirmed` = 1
				WHERE 	`foodsaver_id` = ' .(int)$fsid . '
				AND 	`betrieb_id` = ' . (int)$bid . '
				AND 	`date` = ' . $this->dateval($date) . '
		');
	}

	public function addFetcher($fsid,$bid,$date)
	{
		$confirm = 0;
		if($this->isVerantwortlich($bid))
		{
			$confirm = 1;
		}
		return $this->sql('
			INSERT IGNORE INTO `'.PREFIX.'abholer`
			(`foodsaver_id`,`betrieb_id`,`date`,`confirmed`)
			VALUES
			('.(int)$fsid.','.(int)$bid.','.$this->dateval($date).','.$confirm.')
		');
	}

	public function getNextEvents()
	{
		$next = $this->q('
			SELECT
				e.id,
				e.name,
				e.`description`,
				e.`start`,
				UNIX_TIMESTAMP(e.`start`) AS start_ts,
				fe.`status`

			FROM
				`'.PREFIX.'event` e
			LEFT JOIN
				`'.PREFIX.'foodsaver_has_event` fe
			ON
				e.id = fe.event_id AND fe.foodsaver_id = '.(int)fsId().'

			WHERE
				e.start >= CURDATE()
			AND
				((e.public = 1 AND (fe.`status` IS NULL OR fe.`status` <> 3))
				OR
					fe.`status` IN(1,2)
				)
			ORDER BY e.`start`
		');


		$out = array();

		if($next)
		{
			foreach ($next as $n)
			{
				$out[date('Y-m-d H:i',$n['start_ts']).'-'.$n['id']] = $n;
			}
		}
		if(!empty($out))
		{
			return $out;
		}
	}

	public function getInvites()
	{
		return $this->q('
			SELECT
				e.id,
				e.name,
				e.`description`,
				e.`start`,
				UNIX_TIMESTAMP(e.`start`) AS start_ts,
				fe.`status`

			FROM
				`'.PREFIX.'event` e,
				`'.PREFIX.'foodsaver_has_event` fe

			WHERE
				fe.event_id = e.id

			AND
				fe.foodsaver_id = '.(int)fsId().'

			AND
				fe.`status` = 0

			AND
				e.`end` > NOW()
		');
	}

	public function add_bezirk($data)
	{
    $this->begin_transaction();

		$id = $this->insert('
		INSERT INTO 	`'.PREFIX.'bezirk`
		(
			`parent_id`,
			`has_children`,
			`name`,
			`email`,
			`email_pass`,
			`email_name`
		)
		VALUES
		(
			'.$this->intval($data['parent_id']).',
			'.$this->intval($data['has_children']).',
			'.$this->strval($data['name']).',
			'.$this->strval($data['email']).',
			'.$this->strval($data['email_pass']).',
			'.$this->strval($data['email_name']).'
		)');
    $this->insert('INSERT INTO `'.PREFIX.'bezirk_closure` (ancestor_id, bezirk_id, depth) SELECT t.ancestor_id, '.$id.', t.depth+1 FROM `'.PREFIX.'bezirk_closure` AS t WHERE t.bezirk_id = '.$this->intval($data['parent_id']).' UNION ALL SELECT '.$id.', '.$id.', 0');
    $this->commit();


		if(isset($data['foodsaver']) && is_array($data['foodsaver']))
		{
			foreach($data['foodsaver'] as $foodsaver_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'botschafter`
						(
						`bezirk_id`,
						`foodsaver_id`
				)
						VALUES
						(
						'.$this->intval($id).',
						'.$this->intval($foodsaver_id).'
				)
						');
			}
		}
		if(isset($data['foodsaver']) && is_array($data['foodsaver']))
		{
			foreach($data['foodsaver'] as $foodsaver_id)
			{
				$this->insert('
						INSERT INTO `'.PREFIX.'foodsaver_has_bezirk`
						(
						`bezirk_id`,
						`foodsaver_id`
				)
						VALUES
						(
						'.$this->intval($id).',
						'.$this->intval($foodsaver_id).'
				)
						');
			}
		}
		return $id;
	}

	public function getOne_message_tpl($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`language_id`,
			`name`,
			`subject`,
			`body`

			FROM 		`'.PREFIX.'message_tpl`

			WHERE 		`id` = ' . $this->intval($id));



		return $out;
	}

	public function getBasics_bezirk()
	{
		return $this->q('
			SELECT 	 	`id`,
						`name`

			FROM 		`'.PREFIX.'bezirk`
			ORDER BY `name`');
	}

	public function getOne_kette($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`name`,
			`logo`

			FROM 		`'.PREFIX.'kette`

			WHERE 		`id` = ' . $this->intval($id));



		return $out;
	}

	public function getBasics_lebensmittel()
	{
		return $this->q('
			SELECT 	 	`id`,
						`name`

			FROM 		`'.PREFIX.'lebensmittel`
			ORDER BY `name`');
	}

	public function get_kette()
	{
		$out = $this->q('
			SELECT
			`id`,
			`name`,
			`logo`

			FROM 		`'.PREFIX.'kette`
			ORDER BY `name`');

		return $out;
	}

	public function getBasics_kette()
	{
		return $this->q('
			SELECT 	 	`id`,
						`name`

			FROM 		`'.PREFIX.'kette`
			ORDER BY `name`');
	}

	public function update_kette($id,$data)
	{


		return $this->update('
		UPDATE 	`'.PREFIX.'kette`

		SET 	`name` =  '.$this->strval($data['name']).',
				`logo` =  '.$this->strval($data['logo']).'

		WHERE 	`id` = '.$this->intval($id));
	}

	public function get_faq()
	{
		$out = $this->q('
			SELECT
			`id`,
			`foodsaver_id`,
			`faq_kategorie_id`,
			`name`,
			`answer`

			FROM 		`'.PREFIX.'faq`
			ORDER BY `name`');

		return $out;
	}

	public function getOne_faq($id)
	{
		$out = $this->qRow('
			SELECT
			`id`,
			`foodsaver_id`,
			`faq_kategorie_id`,
			`name`,
			`answer`

			FROM 		`'.PREFIX.'faq`

			WHERE 		`id` = ' . $this->intval($id));



		return $out;
	}

	public function getBasics_faq_category()
	{
		return $this->q('
			SELECT 	 	`id`,
						`name`

			FROM 		`'.PREFIX.'faq_category`
			ORDER BY `name`');
	}

	public function update_faq($id,$data)
	{


		return $this->update('
		UPDATE 	`'.PREFIX.'faq`

		SET 	`foodsaver_id` =  '.$this->intval($data['foodsaver_id']).',
				`faq_kategorie_id` =  '.$this->intval($data['faq_kategorie_id']).',
				`name` =  '.$this->strval($data['name']).',
				`answer` =  '.$this->strval($data['answer']).'

		WHERE 	`id` = '.$this->intval($id));
	}

	/* retrieves all biebs that are biebs for a given bezirk (by being bieb in a Betrieb that is part of that bezirk, which is semantically not the same we use on platform) */
	public function getBiebIds($bezirk)
	{
		return $this->qCol('SELECT DISTINCT bt.foodsaver_id FROM `'.PREFIX.'bezirk_closure` c
			INNER JOIN `'.PREFIX.'betrieb` b ON c.bezirk_id = b.bezirk_id
			INNER JOIN `'.PREFIX.'betrieb_team` bt ON bt.betrieb_id = b.id
			INNER JOIN `'.PREFIX.'foodsaver` fs ON fs.id = bt.foodsaver_id
			WHERE c.ancestor_id = '.$this->intval($bezirk).' AND bt.verantwortlich = 1 AND fs.deleted_at IS NULL');
	}

	/* retrieves the list of all bots for given bezirk or sub bezirk */
	public function getBotIds($bezirk, $include_bezirk_bot = true, $include_group_bot = false)
	{
		$where_type = '';
		if(!$include_bezirk_bot)
		{
			$where_type = 'bz.type = 7';
		}elseif(!$include_group_bot)
		{
			$where_type = 'bz.type <> 7';
		}
		return $this->qCol('SELECT DISTINCT bot.foodsaver_id FROM `'.PREFIX.'bezirk_closure` c
			LEFT JOIN `'.PREFIX.'bezirk` bz ON bz.id = c.bezirk_id
			INNER JOIN `'.PREFIX.'botschafter` bot ON bot.bezirk_id = c.bezirk_id
			INNER JOIN `'.PREFIX.'foodsaver` fs ON fs.id = bot.foodsaver_id
			WHERE c.ancestor_id = '.$this->intval($bezirk).' AND fs.deleted_at IS NULL AND '.$where_type);
	}

	/* updates the member list to given list of IDs, optionally leaving admins
		that are not in the list in place */
	public function updateGroupMembers($bezirk, $foodsaver_ids, $leave_admins)
	{
		$rows_ins = 0;
		$rows_del = 0;
		if($leave_admins)
		{
			$admins = $this->qCol('SELECT foodsaver_id FROM `'.PREFIX.'botschafter` b WHERE b.bezirk_id = '.$this->intval($bezirk));
			if($admins)
			{
				$foodsaver_ids = array_merge($foodsaver_ids, $admins);
			}
		}
		$ids = implode(',',array_map(array($this, 'intval'), $foodsaver_ids));
		if($ids)
		{
			$rows_del = $this->del('DELETE FROM `'.PREFIX.'foodsaver_has_bezirk` WHERE bezirk_id = '.$this->intval($bezirk).' AND foodsaver_id NOT IN ('.$ids.')');
			$insert_strings = array_map(function($id) use ($bezirk) { return '('.$id.','.$bezirk.',1,NOW())'; }, $foodsaver_ids);
			$insert_values = implode(',',$insert_strings);
			$rows_ins = $this->del('INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_bezirk` (foodsaver_id, bezirk_id, active, added) VALUES '.$insert_values);
		} else
		{
			$rows_del = $this->del('DELETE FROM `'.PREFIX.'foodsaver_has_bezirk` WHERE bezirk_id = '.$this->intval($bezirk));
		}
		return array($rows_ins, $rows_del);
	}

}
