<?php
class QuizControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new QuizModel();
		$this->view = new QuizView();
		
		parent::__construct();
		
		if(!S::may())
		{
			goLogin();
		}
		else if(!mayEditQuiz())
		{
			go('/');
		}
	}
	
	public function index()
	{
		// quiz&a=delete&id=9
		if($id = getActionId('delete'))
		{
			$this->model->deleteSession($id);
			goBack();
		}
		
		addBread('Quiz','/?page=quiz');
		addTitle('Quiz');
		
		$topbtn = '';
		$slogan = 'Quiz-Fragen für Foodsaver, Betriebsverantwortliche & Botschafter';
		if(!isset($_GET['sub']) && isset($_GET['id']) && (int)$_GET['id'] > 0)
		{
			if($name = $this->model->getVal('name', 'quiz', $_GET['id']))
			{
				addBread($name,'/?page=quiz&id='.(int)$_GET['id']);
				$topbtn = ' - '.$name;
				$slogan = 'Klausurfragen für '.$name;
			}
			$this->listQuestions($_GET['id']);
		}
		
		if(!isset($_GET['sub']))
		{
			if(!isset($_GET['id']))
			{
				go('/?page=quiz&id=1');
			}
			addContent($this->view->topbar('Quiz'.$topbtn, $slogan, '<img src="img/quiz.png" />'),CNT_TOP);
			addContent($this->view->listQuiz($this->model->listQuiz()),CNT_LEFT);
			addContent($this->view->quizMenu(),CNT_LEFT);
		}
	}
	
	public function wall()
	{
		if($q = $this->model->getQuestion($_GET['id']))
		{
			if($name = $this->model->getVal('name', 'quiz', $q['quiz_id']))
			{
				addBread($name,'/?page=quiz&id='.(int)$_GET['id']);
			}
			addBread('Frage  #'.$q['id'],'/?page=quiz&sub=wall&id='.(int)$q['id']);
			addContent($this->view->topbar('Quizfrage  #'.$q['id'],'<a style="float:right;color:#FFF;font-size:13px;margin-top:-20px;" href="#" class="button" onclick="ajreq(\'editquest\',{id:'.(int)$q['id'].',qid:'.(int)$q['quiz_id'].'});return false;">Frage bearbeiten</a>' . $q['text'] . '<p><strong>'.$q['fp'].' Fehlerpunkte, '.$q['duration'].' Sekunden zum Antworten</strong></p>', '<img src="img/quiz.png" />'),CNT_TOP);
			addContent(v_field($this->wallposts('question', $_GET['id']), 'Kommentare'),CNT_MAIN);
			addContent($this->view->answerSidebar($this->model->getAnswers($q['id']),$_GET['id']),CNT_RIGHT);
		}
	}
	
	public function edit()
	{
		if($quiz = $this->model->getQuiz($_GET['qid']))
		{
			if($this->isSubmitted())
			{
					
				$name = strip_tags($_POST['name']);
				$name = trim($name);
					
				$desc = $_POST['desc'];
				$desc = trim($desc);
				
				$maxfp = (int)$_POST['maxfp'];
				$questcount = (int)$_POST['questcount'];
					
				if(!empty($name))
				{
					if($id = $this->model->updateQuiz($_GET['qid'],$name,$desc,$maxfp,$questcount))
					{
						fs_info('Quiz wurde erfolgreich geändert!');
						go('/?page=quiz&id='.(int)$id);
					}
				}
			}
			setEditData($quiz);
			addContent($this->view->quizForm());
		}
	}
	
	public function newquiz()
	{
		if($this->isSubmitted())
		{
			
			$name = strip_tags($_POST['name']);
			$name = trim($name);
			
			$desc = $_POST['desc'];
			$desc = trim($desc);
			
			$maxfp = (int)$_POST['maxfp'];
			$questcount = (int)$_POST['questcount'];
			
			if(!empty($name))
			{
				if($id = $this->model->addQuiz($name,$desc,$maxfp,$questcount))
				{
					fs_info('Quiz wurde erfolgreich angelegt!');
					go('/?page=quiz&id='.(int)$id);
				}
			}
		}
		
		addContent($this->view->quizForm());
	}
	
	public function sessiondetail()
	{
		if($fs = $this->model->getValues(array('name','nachname','photo','rolle','geschlecht'), 'foodsaver', $_GET['fsid']))
		{
			addBread('Quiz Sessions von '.$fs['name'].' '.$fs['nachname']);				
			addContent($this->view->topbar('Quiz-Sessions von '.$fs['name'].' '.$fs['nachname'], getRolle($fs['geschlecht'], $fs['rolle']), img($fs['photo'])),CNT_TOP);
			
			if($sessions = $this->model->getUserSessions($_GET['fsid']))
			{
				addContent($this->view->userSessions($sessions,$fs));
			}
			else
			{
				addContent($this->view->noSessions($quiz));
			}
		}
	}
	
	public function sessions()
	{
		if($quiz = $this->model->getValues(array('id','name'), 'quiz', $_GET['id']))
		{
			if($sessions = $this->model->getSessions($_GET['id']))
			{
				addContent($this->view->sessionList($sessions,$quiz));
			}
			else
			{
				addContent($this->view->noSessions($quiz));
			}
			addBread($quiz['name'],'/?page=quiz&id='.(int)$_GET['id']);
			addBread('Auswertung');
			$slogan = 'Klausurfragen für '.$quiz['name'];
			
			addContent($this->view->topbar('Auswertung für '.$quiz['name'].' Quiz', $slogan, 'img/quiz.png'),CNT_TOP);
		}
	}
	
	public function listQuestions($quiz_id)
	{
		addContent($this->view->quizbuttons($quiz_id));
		
		addContent($this->view->listQuestions($this->model->listQuestions($quiz_id),$quiz_id));
		
		addContent('<div style="height:15px;"></div>'.$this->view->quizbuttons($quiz_id));
	}
}
