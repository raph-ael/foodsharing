<?php
class SettingsModel extends Model
{
	public function saveInfoSettings($newsletter,$infomail)
	{
		return $this->update('
			UPDATE 	`'.PREFIX.'foodsaver`
			SET 	`newsletter` = '.(int)$newsletter.',
					`infomail_message` = '.(int)$infomail.'
			WHERE 	`id` = '.(int)fsId().'		
		');
	}
	
	public function logChangedSetting($fsid, $old, $new, $logChangedKeys)
	{
		/* the logic is not exactly matching the update mechanism but should be close enough to get all changes... */
		foreach($logChangedKeys as $k)
		{
			if(array_key_exists($k, $new) && $new[$k] != $old[$k])
			{
				$this->insert('INSERT INTO
									  '.PREFIX.'foodsaver_change_history(
										`date`,
										`fs_id`,
										`changer_id`,
										`object_name`,
										`old_value`,
										`new_value`
									  )
									VALUES(
									  NOW(),
									  '.$this->intval($fsid).',
									  '.$this->intval(fsId()).',
									  \''.$k.'\',
									  \''.$old[$k].'\',
									  \''.$new[$k].'\'
									  )');
			}
		}
	}
	
	public function getSleepData()
	{
		return $this->qRow('
			SELECT 
				sleep_status,
				sleep_from,
				sleep_until,
				sleep_msg
				
			FROM 
				'.PREFIX.'foodsaver
				
			WHERE 
				id = '.(int)fsId().'
		');
	}
	
	public function getQuizSession($sid)
	{
		$sql = '
			SELECT 
				`quiz_id`,
				`status`,
				`quiz_index`,
				`quiz_questions`,
				`quiz_result`,
				`fp`,
				`maxfp`

			FROM
				'.PREFIX.'quiz_session
				
			WHERE
				`id` = '.(int)$sid.'
				
			AND
				`foodsaver_id` = '.(int)fsId().'
		';
		$tmp = array();
		if($session = $this->qRow($sql))
		{
			$session['try_count'] = $this->qOne('SELECT COUNT(quiz_id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)fsId().' AND `quiz_id` = '.(int)$session['quiz_id']);
			
			/*
			 * First of all sort the question array and get al questions_ids etc to calculate the result
			 */
			if(!empty($session['quiz_questions']))
			{
				$session['quiz_questions'] = unserialize($session['quiz_questions']);
				
				foreach ($session['quiz_questions'] as $q)
				{
					$tmp[$q['id']] = $q;
					$ttmp = array();
					if(isset($q['answers']))
					{
						foreach ($q['answers'] as $a)
						{
							$ttmp[$a] = $a;
						}
					}
					if(!empty($ttmp))
					{
						$tmp[$q['id']]['answers'] = $ttmp;
					}
				}
			}
			
			
			
			if(!empty($session['quiz_questions']))
			{
				$session['quiz_result'] = unserialize($session['quiz_result']);
				
				foreach ($session['quiz_result'] as $k => $r)
				{
					$session['quiz_result'][$k]['user'] = $tmp[$r['id']];
					
					foreach ($r['answers'] as $k2 => $v2)
					{
						$session['quiz_result'][$k]['answers'][$k2]['right'] = 0;
						if($v2['right'] == 1)
						{
							$session['quiz_result'][$k]['answers'][$k2]['right'] = 1;
						}
						if($v2['right'] == 2)
						{
							$session['quiz_result'][$k]['answers'][$k2]['right'] = 2;
						}
						$session['quiz_result'][$k]['answers'][$k2]['user_say'] = false;
						if(isset($session['quiz_result'][$k]['user']['answers'][$v2['id']]))
						{
							$session['quiz_result'][$k]['answers'][$k2]['user_say'] = true;
						}
					}
					if(!isset($session['quiz_result'][$k]['user']['userduration']))
					{
						$session['quiz_result'][$k]['userduration'] = $session['quiz_result'][$k]['user']['duration'];
					}
					else
					{
						$session['quiz_result'][$k]['userduration'] = $session['quiz_result'][$k]['user']['userduration'];
					}
					if(!isset($session['quiz_result'][$k]['user']['noco']))
					{
						$session['quiz_result'][$k]['noco'] = false;
					}
					else
					{
						$session['quiz_result'][$k]['noco'] = $session['quiz_result'][$k]['user']['noco'];
					}
					unset($session['quiz_result'][$k]['user']);
				}
				
				if($quiz = $this->getValues(array('name','desc'), 'quiz', $session['quiz_id']))
				{
					$session = array_merge($quiz,$session);
					unset($session['quiz_questions']);
					
					/*
					 * Add questions they're complete right answered
					 */
					$session['quiz_result'] = $this->addRightAnswers($tmp,$session['quiz_result']);
					
					
					return $session;
				}
				
			}
			
			return false;
			
		}
	}
	
	/*
	 * in the session are only the failired answeres stored in so now we get all the right answers an fill out the array
	 */
	private function addRightAnswers($indexList,$fullList)
	{
		$out = array();
		
		$model = loadModel('quiz');
		
		$number = 0;
		
		foreach ($indexList as $id => $value)
		{
			$number++;
			if(!isset($fullList[$id]))
			{
				if($question = $model->getQuestion($id))
				{
					$answers = array();
					if($qanswers = $model->getAnswers($id))
					{
						foreach ($qanswers as $a)
						{
							$answers[$a['id']] = $a;
							$answers[$a['id']]['user_say'] = $a['right'];
						}
					}
					$out[$id] = array(
						'id' => $id,
						'text' => $question['text'],
						'duration' => $question['duration'],
						'wikilink' => $question['wikilink'],
						'fp' => $question['fp'],
						'answers' => $answers,	
						'number' => $number,
						'percent' => 0,
						'userfp' => 0,
						'userduration' => 10,
						'noco' => 0
					);
				}
			}
			else
			{
				$out[$id] = $fullList[$id];
			}
		}
		
		return $out;
	}
	
	public function getFairteiler()
	{
		return $this->q('
			SELECT 	ft.id,
					ft.name,
					ff.infotype,
					ff.`type`

			FROM 	`'.PREFIX.'fairteiler_follower` ff,
					`'.PREFIX.'fairteiler` ft
				
			WHERE 	ff.fairteiler_id = ft.id
			AND 	ff.foodsaver_id = '.(int)fsId().'
		');
	}
	
	public function addNewMail($email,$token)
	{
		return $this->insert('
			REPLACE INTO `'.PREFIX.'mailchange`
			(
				`foodsaver_id`,
				`newmail`,
				`time`,
				`token`
			)
			VALUES
			(
				'.(int)fsid().',
				'.$this->strval($email).',
				NOW(),
				'.$this->strval($token).'
			)
		');
	}
	
	public function abortChangemail()
	{
		$this->del('DELETE FROM `'.PREFIX.'mailchange` WHERE foodsaver_id = '.(int)fsid().'');
	}
	
	public function changeMail($email,$crypt)
	{
		$this->del('DELETE FROM `'.PREFIX.'mailchange` WHERE foodsaver_id = '.(int)fsid().'');
		$currentMail = $this->qOne('SELECT `email` FROM '.PREFIX.'foodsaver WHERE id = '.(int)fsid());
		$this->logChangedSetting(fsId(), 'email', $currentMail, $email);
		
		if($this->update('
			UPDATE `'.PREFIX.'foodsaver`
			SET `email` = '.$this->strval($email).',
				`passwd` = '.$this->strval($crypt).'	

			WHERE `id` = '.(int)fsid().'
		'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getMailchange()
	{
		return $this->qOne('SELECT `newmail` FROM '.PREFIX.'mailchange WHERE foodsaver_id = '.(int)fsid());
	}
	
	public function getForumThreads()
	{
		return $this->q('
			SELECT 	th.id,
					th.name,
					tf.infotype
		
			FROM 	`'.PREFIX.'theme_follower` tf,
					`'.PREFIX.'theme` th
		
			WHERE 	tf.theme_id = th.id
			AND 	tf.foodsaver_id = '.(int)fsId().'
		');
	}
	
	public function updateFollowFairteiler($fid,$infotype)
	{
		return $this->update('
			UPDATE 		`'.PREFIX.'fairteiler_follower`
			SET 		`infotype` = '.(int)$infotype.'
			WHERE 		`fairteiler_id` = '.(int)$fid.'
			AND 		`foodsaver_id` = '.(int)fsId().'
		');
	}
	
	public function updateFollowThread($tid,$infotype)
	{
		return $this->update('
			UPDATE 		`'.PREFIX.'theme_follower`
			SET 		`infotype` = '.(int)$infotype.'
			WHERE 		`theme_id` = '.(int)$tid.'
			AND 		`foodsaver_id` = '.(int)fsId().'
		');
	}
	
	public function unfollowThread($unfollow)
	{
		return $this->del('
			DELETE FROM 	`'.PREFIX.'theme_follower`
			WHERE 	foodsaver_id = '.(int)fsId().'
			AND 	theme_id IN('.implode(',', $unfollow).')
		');
	}
	
	public function unfollowFairteiler($unfollow)
	{
		return $this->del('
			DELETE FROM 	`'.PREFIX.'fairteiler_follower`
			WHERE 	foodsaver_id = '.(int)fsId().'
			AND 	fairteiler_id IN('.implode(',', $unfollow).')		
		');
	}
	
	public function getFsCount($bid)
	{
		return (int)$this->qOne('
			SELECT
				COUNT(hb.foodsaver_id)
	
			FROM
				'.PREFIX.'foodsaver_has_bezirk hb
	
			WHERE
				hb.bezirk_id = '.(int)$bid.'
	
			AND
				hb.active = 1
		');
	}
	
	public function getNewMail($token)
	{
		return $this->qOne('SELECT newmail FROM '.PREFIX.'mailchange WHERE `token` = '.$this->strval($token).' AND foodsaver_id = '.(int)fsid());
	}
	
	public function updateRole($role_id,$current_role)
	{
		if($role_id > $current_role)
		{
			$this->update('UPDATE '.PREFIX.'foodsaver SET `rolle` = '.(int)$role_id.' WHERE id = '.(int)fsId());
		}
	}
	
	public function hasQuizCleared($quiz_id)
	{	
		if($res = $this->qOne('
				SELECT COUNT(foodsaver_id) AS `count`
				FROM '.PREFIX.'quiz_session
				WHERE foodsaver_id ='.(int)fsId().'
				AND quiz_id = '.(int)$quiz_id.'
				AND `status` = 1
			'))
		{
			if($res > 0)
			{
				return true;
			}
		}
		return false;
	}
}
