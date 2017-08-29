<?php
class MaintenanceControl extends ConsoleControl
{
	private $model;

	public function __construct()
	{
		$this->model = new MaintenanceModel();
	}

	public function warnings()
	{
		$this->betriebFetchWarning();
	}

	public function daily()
	{
		/*
		 * warn food store manager if there are no fetching people
		 */
		$this->betriebFetchWarning();

		/*
		 * update bezirk ids
		 * there is this old 1:n relation foodsaver <=> bezirk we just check in one step the relation table
		 */
		//$this->updateBezirkIds();

		/*
		 * fill memcache with info about users if they want information mails etc..
		 */
		$this->memcacheUserInfo();

		/*
		 * delete old bells
		 */
		$this->deleteBells();

		/*
		 * delete unuser images
		 */
		$this->deleteImages();

		/*
		 * delete unconfirmed Betrieb dates in the past
		 */
		$this->deleteUnconformedFetchDates();

		/*
		 * deactivate too old food baskets
		 */
		$this->deactivateBaskets();

		/* 
		 * Update Bezirk closure table
		 *
		 * it gets crashed by some updates sometimes, workaround: Rebuild every day
		 */
		$this->rebuildBezirkClosure();

		/*
		 * Master Bezirk Update
		 *
		 * we have master bezirk that mean any user hierarchical under this bezirk have to be also in master self
		 */
		$this->masterBezirkUpdate();

		/*
		 * Delete old blocked ips
		 */
		$this->model->deleteOldIpBlocks();

		/*
		 * check inactive users and send wake up emails or set in sleeping mode
		 */
		//$this->sleepingMode();

		/*
		 * There may be some groups where people should automatically be added
		 * (e.g. Hamburgs BIEB group)
		 */
		$this->updateSpecialGroupMemberships();

		/**
		 * sleeping users, where the time period of sleepiness ended
		 */
		$this->wakeupSleepingUsers();


	}

	public function hourly()
	{
		/*
		 * some updates for new user management
		*/
		//$this->model->updateRolle();
	}

	public function rebuildBezirkClosure()
	{
		$this->model->sql('DELETE FROM fs_bezirk_closure');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.id, a.id, 0 FROM fs_bezirk AS a WHERE a.parent_id > 0');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 0');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 1');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 2');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 3');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 4');
		$this->model->sql('INSERT INTO fs_bezirk_closure (bezirk_id, ancestor_id, depth) SELECT a.bezirk_id, b.parent_id, a.depth+1 FROM fs_bezirk_closure AS a JOIN fs_bezirk AS b ON b.id = a.ancestor_id WHERE b.parent_id IS NOT NULL AND a.depth = 5');
	}

	private function updateSpecialGroupMemberships()
	{
		fs_info('updating HH bieb austausch');
		$hh_biebs = $this->model->getBiebIds(31);
		$hh_biebs[] = 3166;   // Gerard Roscoe
		$counts = $this->model->updateGroupMembers(826, $hh_biebs, true);
		fs_info('+'.$counts[0].', -'.$counts[1]);

		fs_info('updating DE Bot group');
		$bots = $this->model->getBotIds(741);
		$counts = $this->model->updateGroupMembers(881, $bots, true);
		fs_info('+'.$counts[0].', -'.$counts[1]);

		fs_info('updating berlin bieb austausch');
		$berlin_biebs = $this->model->getBiebIds(47);
		$counts = $this->model->updateGroupMembers(1057, $berlin_biebs, true);
		fs_info('+'.$counts[0].', -'.$counts[1]);
	}

	private function sleepingMode()
	{
		/*
		 * get foodsaver more than 30 days inactive set to sleeping mode and send email
		 */

		fs_info('sleeping mode');

		$inactive_fsids = array();
		if($foodsaver = $this->model->listFoodsaverInactiveSince(30))
		{
			foreach ($foodsaver as $fs)
			{
				$inactive_fsids[$fs['id']] = $fs['id'];
				$this->tplMail(27, $fs['email'],array(
					'name' => $fs['name'],
					'anrede' => s('anrede_'.$fs['geschlecht'])
				));

				$this->infoToBotsUserDeactivated($fs);
			}
			$this->model->setFoodsaverInactive($inactive_fsids);

			fs_info(count($inactive_fsids).' user going to sleep..');
		}

		/*
		 * get all foodasver theyre dont login since 14 days and send an wake up email
		 */
		if($foodsaver = $this->model->listFoodsaverInactiveSince(14))
		{
			foreach ($foodsaver as $fs)
			{
				$this->tplMail(26, $fs['email'],array(
					'name' => $fs['name'],
					'anrede' => s('anrede_'.$fs['geschlecht'])
				));
			}

			fs_info(count($foodsaver).' get an wakeup email..');
		}
	}

	private function infoToBotsUserDeactivated($foodsaver)
	{
		if($botschafer = $this->model->getUserBotschafter($foodsaver['id']))
		{
			$this->model->addBell(
				$botschafer,
				'fs_sleepmode_title',
				'fs_sleepmode',
				'fa fa-user',
				array('href' => '#','onclick' => 'profile('.$foodsaver['id'].');return false;'),
				array('name' => $foodsaver['name'],'nachname' => $foodsaver['nachname'],'id' => $foodsaver['id']),
				'fs-sleep'.(int)$foodsaver['id']
			);
		}
	}

	private function deactivateBaskets()
	{
		$count = $this->model->deactivateOldBaskets();
		fs_info($count.' old foodbaskets deactivated');
	}

	private function deleteBells()
	{
		if($ids = $this->model->listOldBellIds())
		{
			$this->model->deleteBells($ids);
			fs_info(count($ids).' old bells deleted');
		}
	}

	private function deleteUnconformedFetchDates()
	{
		fs_info('delete unfonfirmed fetchdates...');
		$count = $this->model->deleteUnconformedFetchDates();
		success($count.' deleted');
	}

	private function deleteImages()
	{
		@unlink(PUBLIC_IMAGES_DIR . '/.jpg');
		@unlink(PUBLIC_IMAGES_DIR. '/.png');

		/* foodsaver photos */
		if($foodsaver = $this->model->q('SELECT id, photo FROM '.PREFIX.'foodsaver WHERE photo != ""'))
		{
			$update = array();
			foreach ($foodsaver as $fs)
			{
				if(!file_exists(PUBLIC_IMAGES_DIR . '/'.$fs['photo']))
				{
					$update[] = $fs['id'];
				}
			}
			if(!empty($update))
			{
				$this->model->update('UPDATE '.PREFIX.'foodsaver SET photo = "" WHERE id IN('.implode(',', $update).')');
			}
		}
		$check = array();
		if($foodsaver = $this->model->q('SELECT id, photo FROM '.PREFIX.'foodsaver WHERE photo != ""'))
		{
			foreach ($foodsaver as $fs)
			{
				$check[$fs['photo']] = $fs['id'];
			}
			$dir = opendir('./images');
			$count = 0;
			while (($file = readdir($dir)) !== false)
			{
				if(strlen($file) > 3 && !is_dir(PUBLIC_IMAGES_DIR . '/'.$file))
				{
					$cfile = $file;
					if(strpos($file, '_') !== false)
					{
						$cfile = explode('_', $file);
						$cfile = end($cfile);
					}
					if(!isset($check[$cfile]))
					{
						$count++;
						@unlink(PUBLIC_IMAGES_DIR . '/'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/130_q_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/50_q_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/med_q_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/mini_q_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/thumb_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/thumb_crop_'.$file);
						@unlink(PUBLIC_IMAGES_DIR . '/q_'.$file);
					}
				}
			}
		}
	}

	private function checkAvatars()
	{
		if($foodsaver = $this->model->listAvatars())
		{
			$nophoto = array();
			foreach ($foodsaver as $fs)
			{
				if(file_exists(PUBLIC_IMAGES_DIR . '/' . $fs['photo']))
				{
					if(!file_exists(PUBLIC_IMAGES_DIR . '/50_q_' . $fs['photo']))
					{
						copy('images/' . $fs['photo'], PUBLIC_IMAGES_DIR . '/50_q_' . $fs['photo']);
						$photo = new fImage(PUBLIC_IMAGES_DIR . '/50_q_' . $fs['photo']);
						$photo->cropToRatio(1, 1);
						$photo->resize(50, 50);
						$photo->saveChanges();
					}
				}
				else
				{
					$nophoto[] = (int)$fs['id'];
				}
			}

			if(!empty($nophoto))
			{
				$this->model->noAvatars($nophoto);
				fs_info(count($nophoto).' foodsaver noavatar updates');
			}
		}
	}

	private function memcacheUserInfo()
	{
		if($foodsaver = $this->model->getUserInfo())
		{
			foreach ($foodsaver as $fs)
			{
				$info = false;
				if($fs['infomail_message'])
				{
					$info = true;
				}

				Mem::userSet($fs['id'], 'infomail', $info);
			}

			fs_info('memcache userinfo updated');
		}

		$admins = $this->model->getBotIds(0, false, true);
		if(!$admins) {
			$admins = array();
		}
		Mem::set('all_global_group_admins', serialize($admins));

	}

	private function updateBezirkIds()
	{
		$this->model->updateBezirkIds();
		fs_info('bezirk_id relation update');
	}

	private function masterBezirkUpdate()
	{
		fs_info('master bezirk update');
		/* Master Bezirke */
		if($foodasver = $this->model->q('
				SELECT
				b.`id`,
				b.`name`,
				b.`type`,
				b.`master`,
				hb.foodsaver_id

				FROM 	`'.PREFIX.'bezirk` b,
				`'.PREFIX.'foodsaver_has_bezirk` hb

				WHERE 	hb.bezirk_id = b.id
				AND 	b.`master` != 0
				AND 	hb.active = 1

		'))
		{
			foreach ($foodasver as $fs)
			{
				if(!$this->model->qRow('SELECT bezirk_id FROM `'.PREFIX.'foodsaver_has_bezirk` WHERE foodsaver_id = '.(int)$fs['foodsaver_id'].' AND bezirk_id = '.$fs['master']))
				{
					if((int)$fs['master'] > 0)
					{
						$this->model->insert('
						INSERT INTO `'.PREFIX.'foodsaver_has_bezirk`
						(
							`foodsaver_id`,
							`bezirk_id`,
							`active`,
							`added`
						)
						VALUES
						(
							'.(int)$fs['foodsaver_id'].',
							'.(int)$fs['master'].',
							1,
							NOW()
						)
						');
					}
				}
			}
		}

		success('OK');
	}

	public function flushcache()
	{
		fs_info('flush Page Cache...');

		if($keys = Mem::$cache->getAllKeys())
		{
			foreach ($keys as $key)
			{
				if(substr($key,0,3) == 'pc-')
				{
					Mem::del($key);
				}
			}
		}

		success('OK');
	}

	public function membackup()
	{
		fs_info('backup memcache to file...');

		if($keys = Mem::$cache->getAllKeys())
		{
			$bar = $this->progressbar(count($keys));
			$data = array();
			$i=0;
			foreach ($keys as $key)
			{
				$i++;
				$bar->update($i);
				if(substr($key,0,3) == 'cb-' || substr($key,0,5) == 'user-')
				{
					$data[$key] = Mem::get($key);
				}
			}
			file_put_contents(ROOT_DIR . 'tmp/membackup.ser',serialize($data));
		}

		echo "\n";
		success('OK');
	}

	public function memrestore()
	{
		fs_info('backup memcache from file...');
		if($data = file_get_contents(ROOT_DIR . 'tmp/membackup.ser'))
		{
			$data = unserialize($data);

			$bar = $this->progressbar(count($data));
			$i=0;

			$this_night_ts = (mktime (5, 0, 0, date('n'), date('j'),date('Y')) + (24*60*60));

			foreach ($data as $key => $val)
			{
				$i++;
				$bar->update($i);

				$ttl = 0;

				Mem::set($key, $val,$ttl);
			}
		}

		echo "\n";
		success('OK');
	}

	public function compress()
	{
		require_once 'lib/inc.php';

	}

	public function betriebFetchWarning()
	{
		if($foodsaver = $this->model->getAlertBetriebeAdmins())
		{
			fs_info('send '.count($foodsaver).' warnings...');
			foreach ($foodsaver as $fs)
			{
				$this->tplMail(28, $fs['fs_email'],array(
					'anrede' => s('anrede_' . $fs['geschlecht']),
					'name' => $fs['fs_name'],
					'betrieb' => $fs['betrieb_name'],
					'link' => URL_INTERN . '/?page=fsbetrieb&id='.$fs['betrieb_id']
				));
			}
			success('OK');
		}
	}

	public function setbotasbib()
	{
		if($betriebe = $this->model->q('SELECT id, name, bezirk_id FROM fs_betrieb'))
		{
			foreach ($betriebe as $b)
			{
				if(!$this->model->q('SELECT foodsaver_id FROM fs_betrieb_team WHERE verantwortlich = 1 AND betrieb_id = '.(int)$b['id']))
				{
					if($foodsaver = $this->model->q('
						SELECT 	fs.id, fs.name
						FROM fs_foodsaver fs, fs_botschafter b
						WHERE b.foodsaver_id = fs.id
						AND b.bezirk_id = '.$b['bezirk_id']))
					{
						foreach ($foodsaver as $fs)
						{
							echo $b['id'].',';
							$this->model->insert('INSERT IGNORE INTO `fs_betrieb_team`(`foodsaver_id`, `betrieb_id`, `verantwortlich`, `active`) VALUES ('.$fs['id'].','.$b['id'].',1,1)');
						}
					}
				}
			}

		}
	}

	public function dropbot()
	{
		if($foodsaver = $this->model->q('
			SELECT id, name, email
			FROM fs_foodsaver
			WHERE rolle = 3
			AND quiz_rolle < 3
			AND id NOT IN(4890,5766,4112,5448)
		'))
		{
			foreach ($foodsaver as $fs)
			{
				$this->model->update('
					UPDATE fs_foodsaver
					SET rolle = 2 WHERE id = '.(int)$fs['id'].'
				');
				$this->model->del('
					DELETE FROM fs_botschafter WHERE foodsaver_id = '.(int)$fs['id'].'
				');

				echo $fs['id'].',';
			}
			fs_info(count($foodsaver));
		}
	}

	public function dropbib()
	{
		if($foodsaver = $this->model->q('
			SELECT DISTINCT fs.id, fs.name, fs.email
			FROM fs_foodsaver fs, fs_betrieb_team t
			WHERE t.foodsaver_id = fs.id
			AND fs.quiz_rolle < 2
			AND t.verantwortlich = 1
			AND fs.id NOT IN(4890,5766,4112,5448)
		'))
		{
			foreach ($foodsaver as $fs)
			{

				$this->model->update('
					UPDATE fs_foodsaver
					SET rolle = 1 WHERE id = '.(int)$fs['id'].'
				');
				$this->model->del('
					UPDATE fs_betrieb_team SET verantwortlich = 0 WHERE foodsaver_id = '.(int)$fs['id'].'
				');

				echo $fs['id'].',';
			}

			fs_info(count($foodsaver));
		}
	}

	public function dropfs()
	{
		if($foodsaver = $this->model->q('
			SELECT id, name, email
			FROM fs_foodsaver
			WHERE rolle = 1
			AND quiz_rolle = 0
			AND id NOT IN(4890,5766,4112,5448)
		'))
		{

			foreach ($foodsaver as $fs)
			{


					/*
					 * Betrieb Status-Update
					*/

					if($betriebe = $this->model->q('SELECT betrieb_id FROM fs_betrieb_team WHERE foodsaver_id = '.(int)$fs['id']))
					{
						foreach ($betriebe as $b)
						{
							$this->model->insert('
								INSERT INTO fs_betrieb_notiz (foodsaver_id, betrieb_id, milestone,text,zeit)
								VALUES('.$fs['id'].','.$b['betrieb_id'].',2,"{QUIZ_DROPPED}",NOW())');
						}
					}

					$this->model->del('
						DELETE FROM fs_betrieb_team WHERE foodsaver_id = '.(int)$fs['id'].'
					');

					/*
					 * DELETE BEZIRKE
					*/
					$this->model->del('
						DELETE FROM fs_foodsaver_has_bezirk WHERE foodsaver_id = '.(int)$fs['id'].'
					');

					$this->model->del('
						DELETE FROM `fs_abholer` WHERE `date` > NOW() AND foodsaver_id = '.$fs['id'].'
					');

					$this->model->update('UPDATE fs_foodsaver SET rolle = 0 WHERE id = '.$fs['id']);


				echo $fs['id'].',';
			}
			fs_info(count($foodsaver));
		}
	}

	public function quizdrop()
	{
		if($foodsaver = $this->model->q('
			SELECT
				fs.id, fs.name

			FROM
				fs_foodsaver fs

			WHERE id NOT IN
			(
				SELECT
				  fs.id

				FROM
				  `fs_abholer` a,
				  fs_foodsaver fs

				WHERE a.`foodsaver_id` = fs.id

				AND a.`date` > NOW()
				AND a.`date` < "2015-01-20"
			)
			AND fs.id NOT IN
			(
				SELECT foodsaver_id FROM fs_betrieb_team WHERE verantwortlich = 1
			)
			AND fs.id NOT IN
			(
				SELECT foodsaver_id FROM fs_botschafter
			)
			AND fs.quiz_rolle = 0
			AND rolle = 1
		'))
		{
			$tmp = array();
			foreach ($foodsaver as $fs)
			{
				$tmp[] = $fs['id'];
				/*
				 * Betrieb Status-Update
				 */

				if($betriebe = $this->model->q('SELECT betrieb_id FROM fs_betrieb_team WHERE foodsaver_id = '.(int)$fs['id']))
				{
					foreach ($betriebe as $b)
					{
						$this->model->insert('
								INSERT INTO fs_betrieb_notiz (foodsaver_id, betrieb_id, milestone,text,zeit)
								VALUES('.$fs['id'].','.$b['betrieb_id'].',2,"{QUIZ_DROPPED}",NOW())');
					}
				}

				$this->model->del('
					DELETE FROM fs_betrieb_team WHERE foodsaver_id = '.(int)$fs['id'].'
				');

				/*
				 * DELETE BEZIRKE
				 */
				$this->model->del('
					DELETE FROM fs_foodsaver_has_bezirk WHERE foodsaver_id = '.(int)$fs['id'].'
				');

				$this->model->del('
					DELETE FROM `fs_abholer` WHERE `date` > NOW() AND foodsaver_id = '.$fs['id'].'
				');

				$this->model->update('UPDATE fs_foodsaver SET rolle = 0 WHERE id = '.$fs['id']);

			}

			echo implode(',',$tmp);
		}
	}

	public function eqalrole()
	{
		$count = $this->model->update('UPDATE fs_foodsaver SET rolle = quiz_rolle WHERE quiz_rolle > rolle');
		fs_info($count . ' updates...');
	}

	public function quizrole()
	{
		if($foodsaver = $this->model->q('SELECT id FROM fs_foodsaver WHERE rolle > 0'))
		{
			$bar = $this->progressbar(count($foodsaver));
			foreach ($foodsaver as $key => $fs)
			{
				$bar->update(($key+1));
				$count_fs_quiz = (int)$this->model->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs['id'].' AND quiz_id = 1 AND `status` = 1');
				$count_bib_quiz = (int)$this->model->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs['id'].' AND quiz_id = 2 AND `status` = 1');
				$count_bot_quiz = (int)$this->model->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)$fs['id'].' AND quiz_id = 3 AND `status` = 1');

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

				$this->model->update('UPDATE '.PREFIX.'foodsaver SET quiz_rolle = '.(int)$quiz_rolle.' WHERE id = '.(int)$fs['id']);
			}
		}
	}

	private function wakeupSleepingUsers()
	{
		$this->model->update('
			UPDATE
				'.PREFIX.'foodsaver
			SET
				sleep_status = 0
			WHERE
				sleep_status = 1
			AND
				sleep_until > 0
			AND
				sleep_until < CURDATE()
		');
	}
}
