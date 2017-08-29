<?php
class Mem
{
	public static $cache;
	public static $connected;

	public static function connect()
	{
		if(MEM_ENABLED)
		{
			Mem::$connected = true;
			Mem::$cache = new Redis();
			Mem::$cache->connect(REDIS_HOST, REDIS_PORT);
		}
	}

	// Set a key to a value, ttl in seconds
	public static function set($key,$data,$ttl = 0)
	{
		if(MEM_ENABLED)
		{
			$options = array();
			if($ttl > 0)
				$options['ex'] = $ttl;
			if($options)
				return Mem::$cache->set($key,$data,$options);
			else
				return Mem::$cache->set($key,$data);
		}
		return false;
	}

	/* enqueue work of specified type.
	   counterpart of asynchronous queue runner in mails.control
	 */
	public static function queueWork($type, $data)
	{
		if(MEM_ENABLED)
		{
			$e = serialize(array('type'=>$type, 'data'=>$data));
			return Mem::$cache->lPush('workqueue', $e);
		}
	}

	public static function get($key)
	{
		if(MEM_ENABLED)
		{
			return Mem::$cache->get($key);
		}
		return false;
	}

	public static function del($key)
	{
		if(MEM_ENABLED)
		{
			return Mem::$cache->delete($key);
		}
		return false;
	}

	public static function user($id,$key)
	{
		return Mem::get('user-'.$key.'-'.$id);
	}

	public static function userSet($id,$key,$value)
	{
		return Mem::set('user-'.$key.'-'.$id, $value);
	}

	public static function userAppend($id,$key,$value)
	{
		$out = array();
		if($val = Mem::user($id,$key))
		{
			if(is_array($val))
			{
				$out = $val;
			}
		}
		$out[] = $value;
		return Mem::set('user-'.$key.'-'.$id, $out);
	}

	public static function userDel($id,$key)
	{
		return Mem::del('user-'.$key.'-'.$id);
	}

	public static function getPageCache()
	{
		global $g_page_cache_suffix;
		return Mem::get('pc-'.$_SERVER['REQUEST_URI'] . ':' . fsId());
	}

	public static function setPageCache($page,$ttl)
	{
		return Mem::set('pc-'.$_SERVER['REQUEST_URI'] . ':' . fsId(), $page, $ttl);
	}

	public static function delPageCache($page)
	{
		return Mem::del('pc-'. $page . ':' . fsId());
	}

	/**
	 * Method to check users online status by checking timestamp from memcahce
	 *
	 * @param integer $fs_id
	 * @return boolean
	 */
	public static function userOnline($fs_id)
	{
		if($time = Mem::user($fs_id, 'active'))
		{
			if((time()-$time) < 600)
			{

				return true;
			}
		}
		/*
		 * free memcache from userdata
		 */
		Mem::userDel($fs_id, 'lastMailMessage');
		Mem::userDel($fs_id, 'active');
		return false;
	}
}

Mem::connect();

interface SlaveInterface
{
	public function toArray();
}

$g_dbclean = false;

class Db
{
	private $mysqli;
	private $is_connected;
	private $values;

	public function __construct()
	{
		$this->values = array();

		global $g_dbclean;
		$this->mysqli = new mysqli();
		$this->mysqli->connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$this->sql("SET NAMES 'utf8'");
		$g_dbclean['mysqli'] = $this->mysqli;
	}

	public function addPassRequest($email,$mail = true)
	{
		if($fs = $this->qRow('SELECT fs.`id`,fs.`email`,fs.`name`,fs.`geschlecht` FROM `'.PREFIX.'foodsaver` fs WHERE fs.deleted_at IS NULL AND fs.`email` = '.$this->strval($email)))
		{

			$k = uniqid();
			$key = md5($k);

			$id = $this->insert('
			REPLACE INTO 	`'.PREFIX.'pass_request`
			(
				`foodsaver_id`,
				`name`,
				`time`
			)
			VALUES
			(
				'.$this->intval($fs['id']).',
				'.$this->strval($key).',
				NOW()
			)');

			if($mail)
			{
				$vars = array(
						'link'=>BASE_URL.'/login?sub=passwordReset&k='.$key,
						'name' => $fs['name'],
						'anrede' => genderWord($fs['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r')
				);

				tplMail(10, $fs['email'],$vars);
				return true;

			}
			else
			{
				return $key;
			}
		}

		return false;
	}

	public function addComment($data)
	{
		$out = false;
		if(isset($data['name']))
		{
			switch($data['name'])
			{
				case 'betrieb' : $out = $this->addCommentBetrieb($data); break;
				default:return false; break;
			}
		}

		if($out !== false)
		{
			return $out;
		}
		else
		{
			return '0';
		}
	}

	private function addCommentBetrieb($data)
	{
		if((int)$data['id'] > 0 && strlen($data['comment']) > 0)
		{
			$this->insert('
			INSERT INTO 	`'.PREFIX.'betrieb_notiz`
			(
				`foodsaver_id`,
				`betrieb_id`,
				`text`,
				`zeit`
			)
			VALUES
			(
				'.$this->getFoodsaverId().',
				'.$this->intval($data['id']).',
				'.$this->strval(urldecode($data['comment'])).',
				'.$this->dateval(date('Y-m-d H:i:s')).'
			)');

			return json_encode(array(
				'status' => 1,
				'msg' => 'Notiz wurde gespeichert!'
			));

		}

		return false;
	}

	public function getRolle()
	{
		$out = array();
		if(isset($_SESSION['client']['botschafter']))
		{
			if($name = $this->getBezirkName($_SESSION['client']['botschafter'][0]['bezirk_id']))
			{
				$out['botschafter'] = array
				(
					'bezirk_id' => (int)$_SESSION['client']['botschafter'][0]['bezirk_id'],
					'bezirk_name' => $name
				);
			}
		}

		if(isset($_SESSION['client']['verantwortlich']))
		{
			$out['verantwortlich'] = array();

			$i=0;
			foreach ($_SESSION['client']['verantwortlich'] as $v)
			{
				if($name = $this->getBetriebName($v['betrieb_id']))
				{
					$out['verantwortlich'][] = array
					(
							'betrieb_id' => (int)$v['betrieb_id'],
							'betrieb_name' => $name
					);
				}
				$i++;
				if($i==1000)
				{
					break;
				}
			}
		}

		if(empty($out))
		{
			return false;
		}
		else
		{
			return $out;
		}
	}

	public function getBezirkName($bezirk_id = false)
	{
		if($bezirk_id === false)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}
		return $this->qOne('SELECT `name` FROM `'.PREFIX.'bezirk` WHERE `id` = '.$this->intval($bezirk_id));
	}

	private function getBetriebName($betrieb_id)
	{
		return $this->qOne('SELECT `name` FROM `'.PREFIX.'betrieb` WHERE `id` = '.$this->intval($betrieb_id));
	}

	public function addBetrieb($data)
	{
		/*
		 * Array
(
    [form_submit] => newbetrieb
    [bezeichnung] => kjl
    [str] =>
    [hsnr] =>
    [plz] => 123
    [ort] =>
    [kategorie] => 2
    [status] => 2
    [betreibskette] => 3
    [ansprechpartner] =>
    [emailadresse] =>
    [telefon] =>
    [fax] =>
    [verantwortlicherfoodsaver] =>
)
		 */



		if($betrieb_id = $this->insert('
				INSERT INTO '.PREFIX.'betrieb
				(
					plz,
					bezirk_id,
					kette_id,
					betrieb_kategorie_id,
					name,
					str,
					hsnr,
					`status`,
					status_date,
					ansprechpartner,
					telefon,
					email,
					fax
				)
				VALUES
				(
					'.$this->strval($data['plz']).',
					'.$this->intval($data['bezirk_id']).',
					'.$this->intval($data['betreibskette']).',
					'.$this->intval($data['kategorie']).',
					'.$this->strval($data['bezeichnung']).',
					'.$this->strval($data['str']).',
					'.$this->strval($data['hsnr']).',
					'.$this->intval($data['status']).',
					'.$this->dateval(date('Y-m-d')).',
					'.$this->strval($data['ansprechpartner']).',
					'.$this->strval($data['telefon']).',
					'.$this->strval($data['emailadresse']).',
					'.$this->strval($data['fax']).'

				)
		'))
		{
			if(!empty($data['verantwortlicherfoodsaver']))
			{
				$this->addVerantwortlicher($data['verantwortlicherfoodsaver'],$betrieb_id);
			}

			return $betrieb_id;
		}

		return false;
	}

	public function getBezirkId($name)
	{
		if($id = $this->qOne('SELECT `id` FROM `'.PREFIX.'bezirk` WHERE `name` = '.$this->strval($name)))
		{
			return $id;
		}
		else
		{
			return $this->insert('INSERT INTO `'.PREFIX.'bezirk`(`name`)VALUES('.$this->strval($name).')');
		}
	}

	public function getAllFoodsaver()
	{
		return $this->q('
			SELECT 		fs.id,
						CONCAT(fs.`name`, " ", fs.`nachname`) AS `name`,
						fs.`anschrift`,
						fs.`email`,
						fs.`telefon`,
						fs.`handy`,
						fs.plz

			FROM 		`'.PREFIX.'foodsaver` fs
			WHERE		fs.deleted_at IS NULL AND fs.`active` = 1
		');
	}



	public function getBetriebe($bezirk_id = false)
	{
		if(!$bezirk_id)
		{
			$bezirk_id = $this->getCurrentBezirkId();
		}
		return $this->q('
				SELECT 	'.PREFIX.'betrieb.id,
						'.PREFIX.'betrieb.plz,
						'.PREFIX.'betrieb.kette_id,
						'.PREFIX.'betrieb.betrieb_kategorie_id,
						'.PREFIX.'betrieb.name,
						'.PREFIX.'betrieb.str,
						'.PREFIX.'betrieb.hsnr,
						'.PREFIX.'betrieb.`betrieb_status_id`

				FROM 	'.PREFIX.'betrieb

				WHERE 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval($bezirk_id).'


				');// -- AND 	'.PREFIX.'betrieb.bezirk_id = '.$this->intval(1).'
	}

	public function may()
	{
		if(isset($_SESSION) && isset($_SESSION['client']) && (int)$_SESSION['client']['id'] > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

  public function begin_transaction() {
    $this->mysqli->query('BEGIN');
  }

  public function commit() {
    $this->mysqli->commit();
  }

  public function rollback() {
    $this->mysqli->rollback();
  }

	public function sql($query)
	{
		$res = $this->mysqli->query($query);
		if ($res == false) {
			error_log('SQL QUERY ERROR URL '.$_SERVER['REQUEST_URI'].' IN '.$query.' : '.$this->mysqli->error);
		}
		return $res;
	}

	public function qOne($sql)
	{
		if($res = $this->sql($sql))
		{
			if($row = $res->fetch_array())
			{
				if(isset($row[0]))
				{
					return qs($row[0]);
				}
			}
		}
		return false;
	}

	public function qCol($sql)
	{
		$out = array();
		if($res = $this->sql($sql))
		{
			while($row = $res->fetch_array())
			{
				$out[] = qs($row[0]);
			}
		}

		if(count($out) > 0)
		{
			return $out;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Method to get an asoc array insted the colums are the keys
	 * so aftter all we can check like this if(isset($test[$key])) ...
	 *
	 * @param string $sql
	 * @return multitype:array |boolean
	 */
	public function qColKey($sql)
	{
		$out = array();
		if($res = $this->sql($sql))
		{
			while($row = $res->fetch_array())
			{
				$val = (int)($row[0]);
				$out[$val] = $val;
			}
		}

		if(count($out) > 0)
		{
			return $out;
		}
		else
		{
			return false;
		}
	}

	public function qRow($sql)
	{

		try {
			$res = $this->sql($sql);

			if(is_object($res) && ($row = $res->fetch_assoc()))
			{
				foreach ($row as $i => $r)
				{
					$row[$i] = qs($r);
				}
				return $row;
			}
		}
		catch(Exception $e)
		{
			fs_debug('Error: '.$sql.' => '.$e->getMessage());
		}
		return false;
	}

	public function del($sql)
	{
		if($res = $this->sql($sql))
		{
			return $this->mysqli->affected_rows;
		}

		return false;
	}

	public function insert($sql)
	{
		if($res = $this->sql($sql))
		{
			return $this->mysqli->insert_id;
		}
		else
		{
			return false;
		}
	}

	public function intval($val)
	{
		return (int)$val;
	}

	public function update($sql)
	{
		if($this->sql($sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function dateval($val)
	{
		return '"'.$this->safe($val).'"';
	}

	public function floatval($val)
	{
		return floatval($val);
	}

	public function strval($val,$html = false)
	{
		if(is_string($html) || $html === false)
		{
			if(is_string($html))
			{
				$val = strip_tags($val,$html);
			}
			else
			{
				$val = strip_tags($val);
			}
		}
		return '"'.$this->safe($val).'"';
	}

	public function q($sql)
	{
		$out = array();
		if($res = $this->sql($sql))
		{
			while($row = $res->fetch_assoc())
			{
				foreach ($row as $i => $r)
				{
					$row[$i] = qs($r);
				}
				$out[] = $row;
			}
		}

		if(count($out) > 0)
		{
			return $out;
		}
		else
		{
			return false;
		}
	}

	public function resetPassword($fs_id,$email)
	{
		/*
		$password = nettesPasswort();

		$crypt = $this->encryptMd5($email, $password);

		$this->update('UPDATE '.PREFIX.'foodsaver SET `passwd` = "'.$crypt.'" WHERE `id` = '.$this->intval($fs_id));

		return $password;
		*/
	}

	public function encryptMd5($email,$pass)
	{
		$email = strtolower($email);

		return md5($email.MD5_SALT.$pass);
	}

	public function __destruct()
	{
		@$this->mysqli->close();
	}

	public function close()
	{
		@$this->mysqli->close();
	}

	public function safe($str)
	{
		return $this->mysqli->escape_string($str);
	}

	public function getFoodsaverId()
	{
		return (int)$_SESSION['client']['id'];
	}

	public function relogin()
	{
		$this->initSessionData($_SESSION['client']['id']);

		return true;
	}

	public function logout()
	{
		Mem::userDel(fsId(), 'active');
		Mem::userDel(fsId(), 'lastMailMessage');
	}

	public function login($email,$pass)
	{
		$email = trim($email);
		if($client = $this->checkClient($email, $pass))
		{
			\Foodsharing\Refactor\Helper::mirrorUser($email, $pass, $client);

            $this->initSessionData($client['id']);

			$this->update('
				UPDATE '.PREFIX.'foodsaver
				SET 	last_login = NOW()
				WHERE 	id = '.(int)fsId().'
			');

			$blocked = $this->qOne('
			SELECT email FROM `'.PREFIX.'email_blacklist`
			WHERE email = '.$this->strval($email));

			return ($blocked === false);
		}
		else
		{
			return false;
		}
	}

	public function gerettet_wrapper($id)
	{
		$ger = array(
				1 => 2,
				2 => 4,
				3 => 7.5,
				4 => 15,
				5 => 25,
				6 => 45,
				7 => 64
		);

		if(!isset($ger[$id]))
		{
			return 1.5;
		}

		return $ger[$id];
	}

  /**
   * Generate a foodsharing.de style hash before 12.12.2014
   * fusion.
   * Uses sha1 of concatenation of fixed salt and password.
   */
  private function fs_sha1hash($pass)
  {
    $salt='DYZG93b04yJfIxfs2guV3Uub5wv7iR2G0FgaC9mi';
    return sha1($salt.$pass);
  }

  /**
   * Check given email and password combination,
   * update password if old-style one is detected.
   */
	public function checkClient($email,$pass = false)
	{
		$email = $this->safe(trim($email));
		if(strlen($email) < 2 || strlen($pass) < 1)
		{
			return false;
		}
		$hashed = $this->encryptMd5($email, $pass);

		$user = false;
		$sql = '
				SELECT 	`id`,
						`bezirk_id`,
						`rolle`,
						`admin`,
						`orgateam`,
						`photo`,
						`name`,
						`nachname`

				FROM 	`'.PREFIX.'foodsaver`
				WHERE 	`email`     = "'.$email.'"
				AND 	`passwd` 	= "'.$hashed.'"
				AND     `deleted_at`   IS NULL
		';

		if($user = $this->qRow($sql))
		{
			return $user;
		}
		else
		{
			$old_fs_hash = $this->fs_sha1hash($pass);
			$sql = '
        SELECT 	`id`,
            `bezirk_id`,
            `admin`,
            `orgateam`,
            `photo`

        FROM 	`'.PREFIX.'foodsaver`
        WHERE 	`email` = '.$this->strval($email).'
        AND 	`fs_password` 	= "'.$old_fs_hash.'"
      ';
			if($user = $this->qRow($sql))
			{
				$this->update("UPDATE `".PREFIX."foodsaver` SET `fs_password` = NULL, `passwd` = '".$hashed."' WHERE `id` = ".$user['id']);
				return $user;
			}

			return false;
		}


	}

	/**
	 * Method to check users online status by checking timestamp from memcahce
	 *
	 * @param integer $fs_id
	 * @return boolean
	 */
	public function isActive($fs_id)
	{
		if($time = Mem::user($fs_id, 'active'))
		{
			return !((time()-$time) > 600);
		}
		return false;
	}

	public function updateActivity($fs_id = false)
	{
		if($fs_id === false)
		{
			$fs_id = fsId();
		}
		Mem::userSet($fs_id, 'active', time());
		Mem::userSet($fs_id, 'sid', session_id());
	}

	private function initSessionData($fs_id)
	{
		$this->updateActivity($fs_id);
		if($fs = $this->qRow('
				SELECT 		`id`,
							`admin`,
							`orgateam`,
							`bezirk_id`,
							`photo`,
							`rolle`,
							`type`,
							`verified`,
							`name`,
							`nachname`,
							`lat`,
							`lon`,
							`email`,
							`token`,
							`mailbox_id`,
							`option`,
							`geschlecht`

				FROM 		`'.PREFIX.'foodsaver`

				WHERE 		`id` = '.$this->intval($fs_id).'
		'))
		{
			S::set('g_location', array(
				'lat' => $fs['lat'],
				'lon' => $fs['lon']
			));

			/*
			 * temporary special stuff for quiz
			 */
			$hastodo = false;
			$hastodo_id = 0;

			$count_fs_quiz = (int)$this->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs_id.' AND quiz_id = 1 AND `status` = 1');
			$count_bib_quiz = (int)$this->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs_id.' AND quiz_id = 2 AND `status` = 1');
			$count_bot_quiz = (int)$this->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs_id.' AND quiz_id = 3 AND `status` = 1');

			$count_verantwortlich = (int)$this->qOne('SELECT COUNT(betrieb_id) FROM '.PREFIX.'betrieb_team WHERE foodsaver_id = '.(int)$fs_id.' AND verantwortlich = 1');
			$count_botschafter = (int)$this->qOne('SELECT COUNT( bezirk_id )FROM '.PREFIX.'botschafter WHERE foodsaver_id = ' . (int)$fs_id);

			$quiz_rolle = 0;
			if($count_fs_quiz > 0)
			{
				$quiz_rolle = 1;
			}
			if($count_bib_quiz > 0)
			{
				$quiz_rolle = 2;
			}
			if($count_bot_quiz > 0)
			{
				$quiz_rolle = 3;
			}

			$this->update('UPDATE '.PREFIX.'foodsaver SET quiz_rolle = '.(int)$quiz_rolle.' WHERE id = '.(int)$fs['id']);
			/*
			echo '<pre>';
			echo $count_verantwortlich."\n";
			echo $count_fs_quiz;
			die();
			*/

			if((int)$fs['rolle'] == 1 && $count_fs_quiz == 0)
			{
				$hastodo = true;
				$hastodo_id = 1;
			}
			else if
			(
				(
					(int)$fs['rolle'] > 1 || $count_verantwortlich > 0
				)
				&&
				$count_bib_quiz === 0
			)
			{

				$hastodo = true;
				$hastodo_id = 2;

			}
			else if
			(
				(
					(int)$fs['rolle'] > 2 || $count_botschafter > 0
				)
				&&
				$count_bot_quiz === 0
			)
			{
				$hastodo = true;
				$hastodo_id = 3;
			}

			S::set('hastodoquiz', $hastodo);
			S::set('hastodoquiz-id', $hastodo_id);

			/*
			 * temp quiz stuff end...
			 */

			$mailbox = false;
			if((int)$fs['mailbox_id'] > 0)
			{
				$mailbox = true;
			}
			if((int)$fs['bezirk_id'] > 0 && $fs['rolle'] > 0)
			{
				$this->insert('
					INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_bezirk`(`foodsaver_id`, `bezirk_id`, `active`, `added`) VALUES
					('.(int)$fs['id'].','.(int)$fs['bezirk_id'].',1,NOW())
				');
			}

			if($master = $this->getVal('master','bezirk',$fs['bezirk_id']))
			{
				$this->insert('
					INSERT IGNORE INTO `'.PREFIX.'foodsaver_has_bezirk`(`foodsaver_id`, `bezirk_id`, `active`, `added`) VALUES
					('.(int)$fs['id'].','.(int)$master.',1,NOW())
				');
			}

			if($fs['photo'] != '' && file_exists('images/mini_q_'.$fs['photo']))
			{
				$image1 = new fImage('images/mini_q_'.$fs['photo']);
				if($image1->getWidth() > 36)
				{
					$image1->cropToRatio(1, 1);
					$image1->resize(35, 35);
					$image1->saveChanges();
				}
			}

			$fs['buddys'] = $this->qColKey('SELECT buddy_id FROM '.PREFIX.'buddy WHERE foodsaver_id = '.(int)$fs_id.' AND confirmed = 1');

			/*
			 * New Session Management
			 */
			S::login($fs);

			/*
			 * store all options in the session
			*/

			if(!empty($fs['option']))
			{
				$options = unserialize($fs['option']);
				foreach ($options as $key => $val)
				{
					S::setOption($key, $val);
				}
			}

			$_SESSION['login'] = true;
			$_SESSION['client'] = array
			(
				'id' => $fs['id'],
				'bezirk_id' => $fs['bezirk_id'],
				'group' => array('member' => true),
				'photo' => $fs['photo'],
				'rolle' => (int)$fs['rolle'],
				'verified' => (int)$fs['verified']
			);
			if($fs['admin'] == 1)
			{
				$_SESSION['client']['group']['admin'] = true;
			}
			if($fs['orgateam'] == 1)
			{
				$_SESSION['client']['group']['orgateam'] = true;
			}
			if((int)$fs['rolle'] > 0)
			{
				if($r = $this->q('
						SELECT 	`'.PREFIX.'botschafter`.`bezirk_id`,
								`'.PREFIX.'bezirk`.`has_children`,
								`'.PREFIX.'bezirk`.`parent_id`,
								`'.PREFIX.'bezirk`.name,
								`'.PREFIX.'bezirk`.id,
								`'.PREFIX.'bezirk`.type

						FROM 	`'.PREFIX.'botschafter`,
								`'.PREFIX.'bezirk`

						WHERE 	`'.PREFIX.'bezirk`.`id` = `'.PREFIX.'botschafter`.`bezirk_id`

						AND 	`'.PREFIX.'botschafter`.`foodsaver_id` = '.$this->intval($fs['id']).'
				'))
				{
					$_SESSION['client']['botschafter'] = $r;
					$_SESSION['client']['group']['botschafter'] = true;
					$mailbox = true;
					foreach ($r as $rr)
					{
						if(!$this->q('SELECT foodsaver_id FROM `'.PREFIX.'foodsaver_has_bezirk` WHERE foodsaver_id = '.$this->intval($fs['id']).' AND bezirk_id = '.(int)$rr['id'].' AND active = 1'))
						{
							$this->insert('
							REPLACE INTO `'.PREFIX.'foodsaver_has_bezirk`
							(
								`bezirk_id`,
								`foodsaver_id`,
								`active`,
								`added`
							)
							VALUES
							(
								'.(int)$rr['id'].',
								'.(int)$fs['id'].',
								1,
								NOW()
							)
						');
						}

					}
				}

				if($r = $this->q('
							SELECT 	b.`id`,
									b.name,
									b.type,
									b.`master`

							FROM 	`'.PREFIX.'foodsaver_has_bezirk` hb,
									`'.PREFIX.'bezirk` b

							WHERE 	hb.bezirk_id = b.id
							AND 	`foodsaver_id` = '.$this->intval($fs['id']).'
							AND 	hb.active = 1

							ORDER BY b.name
					'))
				{
					$_SESSION['client']['bezirke'] = array();
					foreach ($r as $rr)
					{
						$_SESSION['client']['bezirke'][$rr['id']] = array(
							'id' => $rr['id'],
							'name' => $rr['name'],
							'type' => $rr['type']
						);
					}
				}
			}
			$_SESSION['client']['betriebe'] = false;
			if($r = $this->q('
						SELECT 	b.`id`,
								b.name

						FROM 	`'.PREFIX.'betrieb_team` bt,
								`'.PREFIX.'betrieb` b

						WHERE 	bt.betrieb_id = b.id
						AND 	bt.`foodsaver_id` = '.$this->intval($fs['id']).'
						AND 	bt.active = 1
						ORDER BY b.name
				'))
			{
				$_SESSION['client']['betriebe'] = array();
				foreach ($r as $rr)
				{
					$_SESSION['client']['betriebe'][$rr['id']] = $rr;
				}
			}



			if($r = $this->q
			('
						SELECT 	`betrieb_id`

						FROM 	`'.PREFIX.'betrieb_team`

						WHERE 	`foodsaver_id` = '.$this->intval($fs['id']).'
						AND 	`verantwortlich` = 1
			'))
			{
				$_SESSION['client']['verantwortlich'] = $r;
				$_SESSION['client']['group']['verantwortlich'] = true;
				$mailbox = true;
			}
			S::set('mailbox', $mailbox);
		}
		else
		{
			goPage('logout');
		}
	}

	public function getTables()
	{
		$out = $this->q('SHOW TABLES');

		$tables = array();
		foreach ($out as $t)
		{
			$tables[] = end($t);
		}

		$out = array();
		foreach ($tables as $key => $t)
		{
			$out[$t] = $this->q('SHOW FULL COLUMNS FROM `'.$t.'`');
		}
		return $out;
	}

	public function getValues($fields,$table,$id)
	{
		$fields = implode('`,`', $fields);

		return $this->qRow('
			SELECT 	`'.$fields.'`
			FROM 	`'.PREFIX.$table.'`
			WHERE 	`id` = '.$this->intval($id).'
		');
	}

	public function getVal($field,$table,$id)
	{
		if(!isset($this->values[$field.'-'.$table.'-'.$id]))
		{
			$this->values[$field.'-'.$table.'-'.$id] = $this->qOne('
			SELECT 	`'.$field.'`
			FROM 	`'.PREFIX.$table.'`
			WHERE 	`id` = '.$this->intval($id).'
		');
		}

		return $this->values[$field.'-'.$table.'-'.$id];
	}

	public function updateFields($fields,$table,$id)
	{
		global $db;
		$sql = array();
		foreach ($fields as $k => $f)
		{
			if(preg_replace('/[^0-9]/', '', $f) == $f)
			{
				$sql[] = '`'.$k.'`='.$db->intval($f);
			}
			else
			{
				$sql[] = '`'.$k.'`='.$db->strval($f);
			}
		}
		return  $this->update('UPDATE `'.PREFIX.$table.'` SET '.implode(',',$sql).' WHERE `id` = '.(int)$id);
	}

	public function getTable($fields,$table,$where = '')
	{
		return $this->q('
			SELECT 	`'.implode('`,`', $fields).'`
			FROM 	`'.PREFIX.$table.'`
			'.$where.'
		');
	}

	/**
	 * set option is an key value store each var is avalable in the user session
	 *
	 * @param string $key
	 * @param var $val
	 */
	public function setOption($key,$val)
	{
		$options = array();
		if($opt = $this->getVal('option', 'foodsaver', fsId()))
		{
			$options = unserialize($opt);
		}

		$options[$key] = $val;
		return $this->update('UPDATE '.PREFIX.'foodsaver SET `option` = '.$this->strval(serialize($options)).' WHERE id = '.(int)fsId());
	}
}
