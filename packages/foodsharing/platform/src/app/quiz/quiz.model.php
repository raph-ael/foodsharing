<?php
class QuizModel extends Model
{
	public function listQuiz()
	{
		return $this->q('SELECT id,name FROM '.PREFIX.'quiz ORDER BY id');
	}
	
	public function addQuiz($name,$desc,$maxfp,$questcount)
	{
		return $this->insert('
			INSERT INTO `'.PREFIX.'quiz`
			(`name`,`desc`,`maxfp`,`questcount`)
			VALUES
			('.$this->strval($name).','.$this->strval($desc,true).','.(int)$maxfp.','.(int)$questcount.')	
		');
	}
	
	public function deleteSession($id)
	{
		return $this->del('DELETE FROM '.PREFIX.'quiz_session WHERE id = '.(int)$id.' LIMIT 1');
	}
	
	public function getUserSessions($fsid)
	{
		return $this->q('
			SELECT
				s.id,
				s.fp,
				s.`status`,
				s.time_start,
				UNIX_TIMESTAMP(s.time_start) AS time_start_ts,
				q.name AS quiz_name,
				q.id AS quiz_id

				
			FROM
				'.PREFIX.'quiz_session s,
				'.PREFIX.'quiz q
				
			WHERE
				s.quiz_id = q.id
				
			AND
				s.foodsaver_id = '.(int)$fsid.'
				
			ORDER BY
				q.id, s.time_start DESC
		');
	}
	
	public function getSessions($id)
	{
		return $this->q('
			SELECT
				s.id,
				MAX(s.time_start) AS time_start,
				MIN(s.`status`) AS min_status,
				MAX(s.`status`) AS max_status,
				MIN(s.`fp`) AS min_fp,
				MAX(s.`fp`) AS max_fp,
				UNIX_TIMESTAMP(MAX(s.time_start)) AS time_start_ts,	
				CONCAT(fs.name," ",fs.nachname) AS fs_name,
				fs.photo AS fs_photo,
				fs.id AS fs_id,
				count(s.foodsaver_id) AS trycount
				
			FROM
				'.PREFIX.'quiz_session s,
				'.PREFIX.'foodsaver fs
				
			WHERE
				s.foodsaver_id = fs.id
				
			AND
				s.quiz_id = '.(int)$id.'

			GROUP BY
				s.foodsaver_id
				
			ORDER BY
				time_start DESC
		');
	}
	
	public function updateQuiz($id,$name,$desc,$maxfp,$questcount)
	{
		return $this->update('
			UPDATE	`'.PREFIX.'quiz`
			SET 	`name` = '.$this->strval($name).',
					`desc` = '.$this->strval($desc,true).',
					`maxfp` = '.(int)$maxfp.',
					`questcount` = '.(int)$questcount.'	
				
			WHERE 	`id` = '.(int)$id.'
		');
	}
	
	public function getQuiz($id)
	{
		return $this->qRow('
			SELECT 	`id`,`name`,`desc`,`maxfp`,`questcount` FROM '.PREFIX.'quiz WHERE id = '.(int)$id.'		
		');
	}
	
	public function deleteQuest($id)
	{
		$this->del('DELETE FROM '.PREFIX.'answer WHERE `question_id` = '.(int)$id);
		$this->del('DELETE FROM '.PREFIX.'question WHERE `id` = '.(int)$id);
		$this->del('DELETE FROM '.PREFIX.'question_has_quiz WHERE `question_id` = '.(int)$id);	 
	}
	
	public function deleteAnswer($id)
	{
		return $this->del('DELETE FROM '.PREFIX.'answer WHERE `id` = '.(int)$id);
	}
	
	public function addAnswer($qid,$text,$exp,$right)
	{
		return $this->insert('
			INSERT INTO `fs_answer`(`question_id`, `text`,`explanation` ,`right`) VALUES ('.(int)$qid.','.$this->strval($text).','.$this->strval($exp).', '.(int)$right.')		
		');
	}
	
	public function addQuestion($qid,$text,$fp,$duration)
	{
		if($id = $this->insert('
			INSERT INTO `fs_question`(`text`,`duration`) VALUES ('.$this->strval($text).','.(int)$duration.')
		'))
		{
			$this->insert('
				INSERT INTO `fs_question_has_quiz`(`question_id`, `quiz_id`, `fp`) VALUES ('.(int)$id.','.(int)$qid.','.(int)$fp.')		
			');
			return $id;
		}
		return false;
	}
	
	public function updateAnswer($id, $data)
	{
		return $this->update('
			UPDATE 	`'.PREFIX.'answer`
			SET 	`text` = '.$this->strval($data['text']).',
					`explanation` = '.$this->strval($data['explanation']).',
					`right` = '.(int)$data['right'].'	
			WHERE 	`id` = '.(int)$id.'
		');
	}
	
	public function getAnswer($aid)
	{
		return $this->qRow('
			SELECT 	`id`, question_id, `text`,`explanation`, `right`
			FROM	'.PREFIX.'answer
			WHERE 	id = '.(int)$aid.'		
		');
	}
	
	public function getRandomQuestions($count,$fp,$quiz_id)
	{
		return $this->q('
			SELECT
				q.id,
				q.`duration`,
				hq.fp
		
			FROM
				'.PREFIX.'question q,
				'.PREFIX.'question_has_quiz hq
		
			WHERE
				hq.question_id = q.id
		
			AND
				hq.quiz_id = '.(int)$quiz_id.'
				
			AND
				hq.fp = '.(int)$fp.'
				
			ORDER BY 
				RAND()

			LIMIT '.(int)$count.'
		');
	}
	
	public function getQuestionMetas($quiz_id)
	{
		if($questions = $this->q('
			SELECT
				q.id,
				q.`duration`,
				hq.fp
		
			FROM
				'.PREFIX.'question q,
				'.PREFIX.'question_has_quiz hq
		
			WHERE
				hq.question_id = q.id
		
			AND
				hq.quiz_id = '.(int)$quiz_id.'
		'))
		{
			$outmeta = array();
			if($meta = $this->q('
				SELECT 	hq.fp, COUNT(q.id) AS `count`
				FROM
				'.PREFIX.'question q,
				'.PREFIX.'question_has_quiz hq
		
				WHERE
					hq.question_id = q.id
			
				AND
					hq.quiz_id = '.(int)$quiz_id.'
					
				GROUP BY 
					hq.fp
			'))
			{
				
				foreach ($meta as $m)
				{
					if(!isset($outmeta[$m['fp']]))
					{
						$outmeta[$m['fp']] = $m['count'];
					}
				}
			}
			return array(
				'meta' => $outmeta,
				'question' => $questions		
			);
		}
		
	}
	
	public function getQuestion($id)
	{
		return $this->qRow('
			SELECT 	
					q.id,
					q.`text`,
					q.duration,
					q.wikilink,
					hq.fp,
					hq.quiz_id
				
				FROM 
					'.PREFIX.'question q,
					'.PREFIX.'question_has_quiz hq
				
				WHERE
					hq.question_id = q.id
				
				AND
					q.id = '.(int)$id.'		
		');
	}
	
	public function addUserComment($question_id,$comment)
	{
		if($id = $this->insert('
			INSERT INTO `'.PREFIX.'wallpost`
			(`foodsaver_id`, `body`, `time`) 
			VALUES 
			(
				'.(int)fsId().',
				'.$this->strval($comment).',
				NOW()
			)		
		'))
		{
			if($orgateam = $this->getOrgateam())
			{
				$this->addBell($orgateam, 'new_quiz_comment_title', 'new_quiz_comment', 'fa fa-question-circle', array('href'=>'/?page=quiz&sub=wall&id='.(int)$question_id), array(
					'comment' => $comment
				));
			}
			$this->insert('INSERT INTO `'.PREFIX.'question_has_wallpost`(`question_id`, `wallpost_id`, `usercomment`) VALUES ('.(int)$question_id.','.(int)$id.',1)');
			return true;
		}
		return false;
	}
	
	public function getAnswers($question_id)
	{
		return $this->q('
			SELECT 	`id`, `text`,`explanation`, `right`
			FROM	'.PREFIX.'answer
			WHERE 	question_id = '.(int)$question_id.'
		');
	}
	
	public function getRightQuestions($quiz_id)
	{
		$out = array();
		if($questions = $this->q('
				SELECT
				q.id,
				q.`text`,
				q.duration,
				q.wikilink,
				hq.fp
		
				FROM
				'.PREFIX.'question q,
				'.PREFIX.'question_has_quiz hq
		
				WHERE
				hq.question_id = q.id
		
				AND
				hq.quiz_id = '.(int)$quiz_id.'
				'))
		{
			foreach ($questions as $key => $q)
			{
				$out[$q['id']] = $q;
				if($answers = $this->q('
						SELECT 	`id`, `text`,`explanation`, `right`
						FROM	'.PREFIX.'answer
						WHERE 	question_id = '.(int)$q['id'].'
				'))
				{
					$out[$q['id']]['answers'] = array();
					foreach ($answers as $a)
					{
						$out[$q['id']]['answers'][$a['id']] = $a;
					}
				}
			}
				
			return $out;
		}
		return false;
	}
	
	public function listQuestions($quiz_id)
	{
		if($questions = $this->q('
				SELECT 	
					q.id,
					q.`text`,
					q.duration,
					q.wikilink,
					hq.fp
				
				FROM 
					'.PREFIX.'question q,
					'.PREFIX.'question_has_quiz hq
				
				WHERE
					hq.question_id = q.id
				
				AND
					hq.quiz_id = '.(int)$quiz_id.'
		'))
		{
			foreach ($questions as $key => $q)
			{
				$questions[$key]['answers'] = $this->q('
					SELECT 	`id`, `text`,`explanation`, `right`
					FROM	'.PREFIX.'answer
					WHERE 	question_id = '.(int)$q['id'].'
				');
				$questions[$key]['comment_count'] = (int)$this->qOne('SELECT COUNT(question_id) FROM '.PREFIX.'question_has_wallpost WHERE question_id = '.(int)$q['id']);
			}
			
			return $questions;
		}
		
		return false;
	}
	
	public function abortSession($sid)
	{
		$this->update('
			UPDATE
				'.PREFIX.'quiz_session

			SET
				`status` = 2
				
			WHERE
				id = '.(int)$sid.'
				
			AND
				foodsaver_id = '.(int)fsId().'
		');
	}
	
	public function getExsistingSession($quiz_id)
	{
		if($session = $this->qRow('
			SELECT 
				id,
				quiz_index,
				quiz_questions,
				easymode

			FROM
				'.PREFIX.'quiz_session
				
			WHERE
				`quiz_id` = '.$quiz_id.'
				
			AND
				foodsaver_id = '.(int)fsId().'
				
			AND
				`status` = 0
		'))
		{
			$session['quiz_questions'] = unserialize($session['quiz_questions']);
			
			return $session;
		}
		return false;
	}
	
	public function getQuizStatus($quiz_id)
	{
		$out = array
		(
				'cleared' => 0,
				'running' => 0,
				'failed' => 0,
				'last_try'	=> 0,
				'times' => 0
		);
	
		if($res = $this->q('
				SELECT foodsaver_id, `status`, UNIX_TIMESTAMP(`time_start`) AS time_ts
				FROM '.PREFIX.'quiz_session
				WHERE foodsaver_id ='.(int)fsId().'
				AND quiz_id = '.(int)$quiz_id.'
				'))
		{
			foreach ($res as $r)
			{
				$out['times']++;
				if($r['time_ts'] > $out['last_try'])
				{
					$out['last_try'] = $r['time_ts'];
				}
	
				if($r['status'] == 0)
				{
					$out['running']++;
				}
				else if($r['status'] == 1)
				{
					$out['cleared']++;
				}
				else if($r['status'] == 2)
				{
					$out['failed']++;
				}
			}
		}
	
		return $out;
	}
	
	public function initQuizSession($quiz_id, $questions, $maxfp, $questcount, $easymode = 0)
	{
		$questions = serialize($questions);
		
		return $this->insert('
			INSERT INTO '.PREFIX.'quiz_session (
				foodsaver_id, 
				quiz_id, 
				`status`, 
				quiz_index, 
				quiz_questions, 
				time_start, 
				fp, 
				maxfp, 
				quest_count,
				easymode
			) 
			VALUES
			(
				'.(int)fsId().',
				'.(int)$quiz_id.',
				0,
				0,
				'.$this->strval($questions).',
				NOW(),
				0,
				'.(int)$maxfp.',
				'.(int)$questcount.',
				'.(int)$easymode.'
			)
		');
	}
	
	public function updateQuizSession($session_id, $questions, $quiz_index)
	{
		$questions = serialize($questions);
		
		$this->update('
			UPDATE 	
				`'.PREFIX.'quiz_session`

			SET
				quiz_questions = '.$this->strval($questions).',
				quiz_index = '.(int)$quiz_index.'
				
			WHERE
				id = '.(int)$session_id.'
		');
	}
	
	public function finishQuiz($session_id, $questions, $quiz_result, $fp, $maxfp)
	{
		$quiz_result = serialize($quiz_result);
		$questions = serialize($questions);
		
		// nicht bestanden ?
		$status = 2;
		
		// quiz fertig und bestanden
		if($fp <= $maxfp)
		{
			$status = 1;
		}
		
		$this->update('
			UPDATE
				`'.PREFIX.'quiz_session`
		
			SET
				quiz_result = '.$this->strval($quiz_result).',
				quiz_questions = '.$this->strval($questions).',
				time_end = '.$this->dateval(date('Y-m-d H:i:s')).',
				`status` = '.(int)$status.',
				`fp` = '.floatval($fp).',
				`maxfp` = '.(int)$maxfp.'
		
			WHERE
				id = '.(int)$session_id.'
		');
	}
	
	public function updateQuestion($id,$quiz_id,$text,$fp,$duration,$wikilink)
	{
		$this->update('
			UPDATE 	`'.PREFIX.'question`
			SET 	`text` = '.$this->strval($text).',
					`duration` = '.(int)$duration.',
					`wikilink` = '.$this->strval($wikilink).'
			WHERE 	`id` = '.(int)$id.'
		');
		
		return $this->update('
			UPDATE 	`'.PREFIX.'question_has_quiz`
			SET 	`fp` = '.(int)$fp.'
			WHERE 	`question_id` = '.(int)$id.'
			AND 	`quiz_id` = '.(int)$quiz_id.'		
		');
	}
}
