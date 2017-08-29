<?php 
class QuizXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new QuizModel();
		$this->view = new QuizView();

		parent::__construct();
	}
	
	public function hideinfo()
	{
		S::setOption('quiz-infobox-seen', true);
	}
	
	public function addquest()
	{
		/*
		 *  [app] => quiz
    [m] => addquest
    [text] => rgds
    [fp] => fdgh
)
		 */
		if(mayEditQuiz())
		{
			if(isset($_GET['text']) && isset($_GET['fp']) && isset($_GET['qid']))
			{
				$fp = (int)$_GET['fp'];
				$text = strip_tags($_GET['text']);
				$duration = (int)$_GET['duration'];
				
				if(!empty($text))
				{
					if($id = $this->model->addQuestion($_GET['qid'],$text,$fp,$duration))
					{
						fs_info('Frage wurde angelegt');
						return array(
							'status' => 1,
							'script' => 'goTo("/?page=quiz&id='.(int)$_GET['qid'].'&fid='.(int)$id.'");'
						);	
					}
				}
				else
				{
					return array(
						'status' => 1,
						'script' => 'pulseError("Du solltest eine Frage angeben ;)");'
					);
				}
			}
		}
		
	}
	
	public function delquest()
	{
		if(mayEditQuiz() && isset($_GET['id']))
		{
			$this->model->deleteQuest($_GET['id']);
			return array(
					'status' => 1,
					'script' => '$(".question-'.(int)$_GET['id'].'").remove();$("#questions").accordion("refresh");pulseInfo("Frage gelöscht!");'
			);
		}
	}
	
	public function delanswer()
	{
		if(mayEditQuiz() && isset($_GET['id']))
		{
			$this->model->deleteAnswer($_GET['id']);
			return array(
				'status' => 1,
				'script' => '$("#answer-'.(int)$_GET['id'].'").remove();pulseInfo("Antwort gelöscht!");'		
			);
		}
	}
	
	public function addansw()
	{
		/*
		 * 
		qid		1
		right	1
		text	458
		 */
		
		if(mayEditQuiz())
		{
			if(isset($_GET['text']) && isset($_GET['right']) && isset($_GET['qid']))
			{
				$text = strip_tags($_GET['text']);
				$exp = strip_tags($_GET['explanation']);
				$right = (int)$_GET['right'];
		
				if(!empty($text) && ($right == 0 || $right == 1 || $right == 2))
				{
					if($id = $this->model->addAnswer($_GET['qid'],$text,$exp,$right))
					{
						return array(
								'status' => 1,
								'script' => 'pulseInfo("Antwort wurde angelegt");$("#answerlist-'.(int)$_GET['qid'].'").append(\'<li class="right-'.(int)$right.'">'.jsSafe(nl2br(strip_tags($text))).'</li>\');$( "#questions" ).accordion( "refresh" );'
						);
					}
				}
				else
				{
					return array(
							'status' => 1,
							'script' => 'pulseError("Du solltest einen Text angeben ;)");'
					);
				}
			}
		}
		
	}
	
	public function updateansw()
	{
		if(mayEditQuiz())
		{
			if(isset($_GET['text']) && isset($_GET['right']) && isset($_GET['id']))
			{
				$text = strip_tags($_GET['text']);
				$exp = strip_tags($_GET['explanation']);
				$right = (int)$_GET['right'];
			
				if(!empty($text) && ($right == 0 || $right == 1 || $right == 2))
				{
					$this->model->updateAnswer($_GET['id'],array(
						'text' => $text,
						'explanation' => $exp,
						'right' => $right		
					));
					return array(
							'status' => 1,
							'script' => 'pulseInfo("Antwort wurde geändert");$("#answer-'.(int)$_GET['id'].'").replaceWith(\'<li id="answer-'.(int)$_GET['id'].'" class="right-'.(int)$right.'">'.jsSafe(nl2br(strip_tags($text))).'</li>\');$( "#questions" ).accordion( "refresh" );'
					);
					
				}
				else
				{
					return array(
							'status' => 1,
							'script' => 'pulseError("Du solltest einen Text angeben ;)");'
					);
				}
			}
		}
	}
	
	public function editanswer()
	{
		if(mayEditQuiz())
		{
			if($answer = $this->model->getAnswer($_GET['id']))
			{
				$answer['isright'] = $answer['right'];
				setEditData($answer);
				$dia = new XhrDialog();
				
				$dia->addAbortButton();
				$dia->setTitle('Antwort bearbeiten');
				$dia->addOpt('width', 500);
				$dia->addContent($this->view->answerForm());
				
				$dia->addButton('Speichern', 'ajreq(\'updateansw\',{id:'.(int)$_GET['id'].',explanation:$(\'#explanation\').val(),text:$(\'#text\').val(),right:$(\'#isright\').val()});$(\'#'.$dia->getId().'\').dialog("close");');
				
				$return = $dia->xhrout();
				
				$return['script'] .= '
				$("#text, #explanation").css({
				"width":"95%",
				"height":"50px"
				});
				$("#text, #explanation").autosize();';
				
				return $return;
			}
		}
		
	}
	
	public function addanswer()
	{
		$dia = new XhrDialog();
		
		$dia->addAbortButton();
		$dia->setTitle('Neue Antwort zu Frage #'.(int)$_GET['qid']);
		$dia->addOpt('width', 500);
		$dia->addContent($this->view->answerForm());
		
		$dia->addButton('Speichern', 'ajreq(\'addansw\',{qid:'.(int)$_GET['qid'].',explanation:$(\'#explanation\').val(),text:$(\'#text\').val(),right:$(\'#right\').val()});$(\'#'.$dia->getId().'\').dialog("close");');
		
		$return = $dia->xhrout();
		
		$return['script'] .= '
		$("#text, #explanation").css({
		"width":"95%",
		"height":"50px"
		});
		$("#text, #explanation").autosize();';
		
		return $return;
	}
	
	public function addquestion()
	{
		$dia = new XhrDialog();
		
		$dia->addAbortButton();
		$dia->setTitle('Neue Frage eingeben');
		$dia->addOpt('width', 500);
		$dia->addContent($this->view->questionForm());
		
		$dia->addButton('Speichern', 'ajreq(\'addquest\',{qid:'.(int)$_GET['qid'].',duration:$(\'#duration\').val(),text:$(\'#text\').val(),fp:$(\'#fp\').val()});');
		
		$return = $dia->xhrout();
		
		$return['script'] .= '
			$("#text").css({
				"width":"95%",
				"height":"50px"
			});
			$("#text").autosize();
			$("#fp").css({
				"width":"95%"
			});';
		
		return $return;
	}
	
	public function editquest()
	{
		if(mayEditQuiz())
		{
			if($quest = $this->model->getQuestion($_GET['id']))
			{
				setEditData($quest);
				$dia = new XhrDialog();
				
				$dia->addAbortButton();
				$dia->setTitle('Frage bearbeiten');
				$dia->addOpt('width', 500);
				$dia->addContent($this->view->questionForm());
				
				$dia->addButton('Speichern', 'ajreq(\'updatequest\',{id:'.(int)$_GET['id'].',qid:'.(int)$_GET['qid'].',wikilink:$(\'#wikilink\').val(),duration:$(\'#duration\').val(),text:$(\'#text\').val(),fp:$(\'#fp\').val()});');
				
				$return = $dia->xhrout();
				
				$return['script'] .= '
				$("#text").css({
					"width":"95%",
					"height":"50px"
				});
				$("#text").autosize();
				$("#fp").css({
					"width":"95%"
				});';
				
				return $return;
			}
		}
	}
	
	public function abort()
	{
		if(S::may())
		{
			$this->model->abortSession($_GET['sid']);
			
			return array(
				'status' => 1,
				'script' => 'pulseInfo("Quiz wurde abgebrochen");reload();'	
			);
		}
	}
	
	private function abortOrOpenDialog($session_id)
	{
		return '
				$("body").append(\'<div id="abortOrPause">'.JsSafe($this->view->abortOrPause()).'</div>\');
				$("#abortOrPause").dialog({
					autoOpen: false,
					title: "Quiz wirklich abbrechen?",
					modal: true,
					buttons: [
						{
							text: "Quiz-Pausieren",
							click: function(){
								$(this).dialog("close");
								ajreq("pause",{app:"quiz",sid:'.(int)$session_id.'});
							}
						}
					]
				});';
	}
	
	private function replaceDoubles($questions)
	{
		return $questions;
	}
	
	/**
	 * Method to initiate a quiz session so get the defined amount of questions sort it randomly and store it in an session variable
	 * 
	 */
	public function startquiz()
	{
		if(!S::may())
		{
			return false;
		}
		/*
		 * First we want to check is there an quiz session what the user have lost?
		 */
		if($session = $this->model->getExsistingSession($_GET['qid']))
		{
			// if yes reinitiate the running quiz session
			S::set('quiz-id', (int)$_GET['qid']);
			S::set('quiz-questions', $session['quiz_questions']);
			S::set('quiz-index', $session['quiz_index']);
			S::set('quiz-session', $session['id']);
			$easymode = false;
			if ($session['easymode'] == 1 && (int)$_GET['qid'] == 1)
			{
				$easymode = true;
			}
			S::set('quiz-easymode', $easymode);
			
			/*
			 * Make a little output that the user can continue the quiz
			 */
			$dia = new XhrDialog();
			
			$dia->setTitle('Quiz fortführen');
			
			$dia->addContent( '<h1>Du hast Dein Quiz nicht beendet</h1><p>Aber keine Sorge Du kannst einfach jetzt das Quiz zum Ende bringen.</p><p>Also viel Spaß beim weiterquizzen.</p>');
			$dia->addButton('Quiz fortführen', 'ajreq(\'next\',{app:\'quiz\'});');
			$return = $dia->xhrout();
			
			$return['script'] .= $this->abortOrOpenDialog($session['id']);
			
			return $return;
			
		}
		/*
		 * Otherwiser we start a new quiz session
		 */
		else if($quiz = $this->model->getQuiz($_GET['qid']))
		{
			
			/*
			 * if foodsaver quiz user can choose between easy and quick mode
			*/
			
			if($_GET['qid'] == 1 && isset($_GET['easymode']) && $_GET['easymode'] == 1)
			{
				S::set('quiz-easymode', true);
				$quiz['questcount'] = 20;
			}
			else
			{
				S::set('quiz-easymode', false);
			}
			
			/*
			 * first get random sorted quiz questions
			 */
			if($questions = $this->getRandomQuestions($_GET['qid'],$quiz['questcount']))
			{
				//Get the description how the quiz works
				$content = $this->model->getContent(17);
				
				// for safety check if there are not to many questions
				$questions = array_slice($questions, 0, (int)$quiz['questcount']);
				
				// check for double question (bugfix)
				$questions = $this->replaceDoubles($questions);
				
				/*
				 * Store quiz data in the users session
				 */
				S::set('quiz-id', (int)$_GET['qid']);
				S::set('quiz-questions', $questions);
				S::set('quiz-index', 0);
				
				/*
				 * Make a litte output for the user that he/she cat just start the quiz now
				 */
				$dia = new XhrDialog();
				$dia->addOpt('width', 600);
				$dia->setTitle($quiz['name'].'-Quiz');
				$dia->addContent($this->view->initQuiz($quiz,$content));
				$dia->addAbortButton();
				$dia->addButton('Quiz Starten', 'ajreq(\'next\',{app:\'quiz\'});$(\'#'.$dia->getId().'\').dialog(\'close\');');
				
				$return = $dia->xhrout();
				
				$return['script'] .= $this->abortOrOpenDialog($session['id']);
				
				return $return;
				
			}
		}
		
		/*
		 * If we cant get an quiz from the db send an error
		 */
		return array(
			'status' => 1,
			'script' => 'pulseError("Quiz konnte nicht gestartet werden...");'
		);
	}
	
	public function endpopup()
	{
		$dia = new XhrDialog();

		$dia->addOpt('width', 720);

		$content_id = 36;

		$dia->addAbortButton();
		
		if(S::get('hastodoquiz-id') == 1)
		{
			$dia->addButton('Jetzt mit dem Quiz meine Rolle als Foodsaver bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_fs\');');
		}
		else if(S::get('hastodoquiz-id') == 2)
		{
			$dia->addButton('Jetzt mit dem Quiz meine Rolle als Betriebsverantwortliche*r bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_bip\');');
		}
		else if(S::get('hastodoquiz-id') == 3)
		{
			$dia->addButton('Jetzt mit dem Quiz meine Rolle als Botschafter*In bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_bot\');');
		}
		
		$content = $this->model->getContent($content_id);
		$dia->setTitle($content['title']);
		$dia->addContent($content['body']);
			
		return $dia->xhrout();
	}
	
	public function quizpopup()
	{
		if(S::may('fs'))
		{
			$count = (int)$this->model->qOne('SELECT COUNT(id) FROM '.PREFIX.'quiz_session WHERE foodsaver_id = '.(int)fsId().' AND quiz_id = ' . (int)S::get('hastodoquiz-id') . ' AND `status` = 1');
			if($count == 0)
			{
				$dia = new XhrDialog();
				$dia->addOpt('width', 720);
				$content_id = 18;
				$dia->addAbortButton();
				
				if(S::get('hastodoquiz-id') == 1)
				{
					$dia->addButton('Ja, ich möchte jetzt mit dem Quiz meine Rolle als Foodsaver bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_fs\');');
				}
				else if(S::get('hastodoquiz-id') == 2)
				{
					$content_id = 34;
					$dia->addButton('Ja, ich möchte jetzt mit dem Quiz meine Rolle als Betriebsverantwortliche/r bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_bip\');');
				}
				else if(S::get('hastodoquiz-id') == 3)
				{
					$content_id = 35;
					$dia->addButton('Ja, ich möchte jetzt mit dem Quiz meine Rolle als Botschafter bestätigen!', 'goTo(\'/?page=settings&sub=upgrade/up_bot\');');
				}
				
				$content = $this->model->getContent($content_id);
				$dia->setTitle($content['title']);
				$dia->addContent($content['body']);
					
				return $dia->xhrout();
			}
		}
		return array(
			'status' => 0
		);
	}
	
	public function addcomment()
	{
		if(S::may() && !empty($_GET['comment']) && (int)$_GET['id'] > 0)
		{
			$this->model->addUserComment((int)$_GET['id'], $_GET['comment']);
			return array(
				'status' => 1,
				'script' => 'pulseInfo("Kommentar wurde gespeichert");$("#qcomment-'.(int)$_GET['id'].'").hide();'		
			);
		}
		
	}
	/**
	 * xhr request to get next question stored in the users session
	 * 
	 * @return boolean|string|multitype:number string |Ambigous <boolean, multitype:number string , string>
	 */
	public function next()
	{
		if(!S::may())
		{
			return false;
		}
		/*
		 * Try to find a current quiz session ant retrieve the questions
		 */
		if($quiz = S::get('quiz-questions'))
		{
			$dia = new XhrDialog();
			$dia->addClass('quiz-questiondialog');
			// get quiz_index it is the current array index of the questions
			$i = S::get('quiz-index');
			
			/*
			 * If the quiz index is 0 we have to start a new quiz session 
			 */
			
			$easymode = 0;
			if(S::get('quiz-easymode'))
			{
				$easymode = 1;
			}
			
			if($i == 0)
			{				
				$quuizz = $this->model->getQuiz(S::get('quiz-id'));
				// init quiz session in DB
				if($id = $this->model->initQuizSession(S::get('quiz-id'), $quiz, $quuizz['maxfp'], $quuizz['questcount'],$easymode))
				{
					S::set('quiz-session', $id);
				}
			}
			
			// this variable we need to output an message that the last question was only a joke 
			$was_a_joke = false;
			
			/*
			 *  check if an answered quiz question is arrived
			 */
			if(isset($_GET['answer']))
			{
				/*
				 * parse the anser parameter
				 */
				$answers = urldecode($_GET['answer']);
				$params = array();
				parse_str($_GET['answer'], $params);
				
				/*
				 * store params in the quiz array to save users answers
				 */
				if(isset($params['qanswers']))
				{
					$quiz[($i-1)]['answers'] = $params['qanswers'];
				}
				
				/*
				 * check if there are 0 point for the questions its a joke
				 */
				if($quiz[($i-1)]['fp'] == 0)
				{
					$was_a_joke = true;
				}
				
				/*
				 * store the time how much time has the user need
				 */
				$quiz[($i-1)]['userduration'] = (time() - (int)S::get('quiz-quest-start'));
				
				/*
				 * has store noco ;) its the value when the user marked that no answer is correct
				 */
				$quiz[($i-1)]['noco'] = (int)$_GET['noco'];
				
				/*
				 * And store it all back to the session
				 */
				S::set('quiz-questions', $quiz);
			}
			
			/*
			 * Have a look has the user entered an comment for this question?
			*/
			if(isset($_GET['comment']) && !empty($_GET['comment']))
			{
				$comment = strip_tags($_GET['comment']);
				
				$comment = $_GET['commentanswers'] . $comment;
				
				// if yes lets store in the db
				$this->model->addUserComment((int)$_GET['qid'], $comment);
			}
			
			/*
			 * Check the special param if the next question should not be displayed
			 */
			if(isset($_GET['special']))
			{
				// make a break
				if($_GET['special'] == 'pause')
				{
					$this->model->updateQuizSession(S::get('quiz-session'), $quiz, $i);
					return $this->pause();
				}
				
				//
				if($_GET['special'] == 'result')
				{
					$this->model->updateQuizSession(S::get('quiz-session'), $quiz, $i);
					return $this->resultNew($quiz[($i-1)],$dia->getId());
				}
			}
			
			
			/*
			 * check if there is a next question in quiz array push it to the user
			 * othwise forward to the result of the quiz
			 */
			if(isset($quiz[$i]))
			{
				// get the question
				if($question = $this->model->getQuestion($quiz[$i]['id']))
				{		
					// get possible answers		
					$comment_aswers = '';
					if($answers = $this->model->getAnswers($question['id']))
					{
						// random sorting for the answers
						shuffle($answers);

						$x=1;
						foreach ($answers as $a)
						{
							$comment_aswers .= $x.'. Frage #'.$a['id'].' => '.preg_replace('/[^a-zA-Z0-9\ \.]/','',tt($a['text'],25))."\n";
							$x++;
						}
						
						/*
						 * increase the question index so we are at the next question ;)
						 */ 
						$i++;
						S::set('quiz-index',$i);
						
						// update quiz session
						$session_id = S::get('quiz-session');
						$this->model->updateQuizSession($session_id, $quiz, $i);
						S::set('quiz-quest-start',time());
						
						/*
						 * let's prepare the output dialog
						 */
						$dia->addOpt('width', 1000);
						$dia->addOpt('height', '($(window).height()-40)',false);
						$dia->addOpt('position', 'center');
						$dia->setTitle('Frage '.($i).' / '.count($quiz));
						
						
						
						$dia->addContent($this->view->quizQuestion($question,$answers));
						
						/*
						 * for later function is not ready yet :)
						 */
						$dia->addButton('Weiter', 'questcheckresult();return false;');
						$dia->addButton('Pause', 'ajreq(\'pause\',{app:\'quiz\',sid:\''.$session_id.'\'});');

						$dia->addButton('nächste Frage','ajreq(\'next\',{app:\'quiz\',qid:'.(int)$question['id'].',commentanswers:"'.jsSafe($comment_aswers).'"});$(".quiz-questiondialog .ui-dialog-buttonset .ui-button").button( "option", "disabled", true );$(".quiz-questiondialog .ui-dialog-buttonset .ui-button span").prepend(\'<i class="fa fa-spinner fa-spin"></i> \')');

						/*
						 * add next() Button
						 */

						$dia->addOpt('open','
						function(){
							setTimeout(function(){
								$close = $("#'.$dia->getId().'").prev().children(".ui-dialog-titlebar-close");
								$close.unbind("click");
								$close.click(function(){
									ajreq("pause",{app:"quiz",sid:'.(int)$session_id.'});
									//abortOrPause("'.$dia->getId().'");
								});
								$("#quizcomment").hide();
								$(".quiz-questiondialog .ui-dialog-buttonset button:last").hide();
								$(".quiz-questiondialog .ui-dialog-buttonset .ui-button:contains(\'Pause\')").hide();
								$(".ui-dialog-titlebar-close").hide();
							},100);
						}',false);
						
						$return = $dia->xhrout();
						
						// additional output if it was a joke question
						if($was_a_joke)
						{
							$return['script'] .= 'pulseInfo("<h3>Das war eine Scherzfrage</h3>Du kannst beruhigt weitermachen und auch wenn die möglichen Antworten nicht falsch sind, müssen diese Fragen nicht richtig beantwortet werden, sie dienen lediglich des auflockerns für Zwischendurch ;)",{sticky:true});';
						}
						
						/*
						 * strange but it works ;) generate the js code and send is to the client for execute
						 */
						
						
						$quizbreath = '
							$(\'#quizwrapper\').show();
							$(\'#quizbreath\').hide();
							var count = '.(int)$question['duration'].';
							var counter = null;
						';
						
						if($easymode == 0)
						{
							$quizbreath = '
							$(\'#quizwrapper\').hide();
							$(\'#quizbreath\').show();
							$("#'.$dia->getId().'").next(".ui-dialog-buttonpane").css("visibility","hidden");
							var count = '.(int)$question['duration'].';
							var counter = null;
									
							function timer()
							{
							  count--;
					          $("#countdown").progressbar("value",count);
							  //$("#countdown").text((count)+"");
							  if (count <= 0)
							  {
							     questcheckresult(true);
							     return;
							  }
							}
							
							setTimeout(function(){
								$(\'#quizbreath span\').text("Auf die Plätze!");
							},3000);
							setTimeout(function(){
								$(\'#quizbreath span\').text("Fertig...");
							},4000);
							setTimeout(function(){
								$(\'#quizbreath span\').text("Weiter gehts!");
							},5000);
							
							setTimeout(function(){
								
								
								counter = setInterval(timer, 1000); 
								$("#countdown").progressbar({
						             value: '.$question['duration'].',
						             max:'.$question['duration'].'
						        });
									
								$(\'#quizwrapper\').show();
								$(\'#quizbreath\').hide();
								$(".ui-dialog-buttonpane").css("visibility","visible");
							},6000);';
							
						}
						
						$return['script'] .= '
							
							function abortOrPause()
							{
								$("#abortOrPause").dialog("open");
							}
							
							function questcomment(el)
							{
								if($(\'#qanswers input:checked\').length > 0)
								{
									clearInterval(counter);
									$(".ui-dialog-buttonpane button:contains(\'Kommentar\')").hide();
									$("#quizwrapper input, #countdown").hide();
									$("#quizwrapper").css({
										"height":"50%",
										"overflow":"auto"
									});
									$("#quizcomment").show();
								}
								else
								{
									pulseError(\'Bitte treffe erst eine Auswahl!\')
								}
							}
							
							function questgonext(special)
							{
								if(special == undefined)
								{
									special = 0;
								}
								clearInterval(counter);
								ajreq(\'next\',{answer:$(\'.qanswers\').serialize(),noco:$(\'.nocheck:checked\').length,app:\'quiz\',commentanswers:"'.jsSafe($comment_aswers).'",comment:$(\'#quizusercomment\').val(),qid:'.(int)$question['id'].',special:special});
							}
							
							function breaknext()
							{
								if($(\'#qanswers input:checked\').length > 0)
								{
									questgonext("pause");
								}
								else
								{
									pulseError(\'Bitte treffe erst eine Auswahl!\')
								}
							}
							
							function questionnext()
							{
								if($(\'#qanswers input:checked\').length > 0)
								{
									questgonext();
								}
								else
								{
									pulseError(\'Bitte treffe eine Auswahl!\')
								}
							}
							
							function questcheckresult(nowait)
							{
								if(nowait == undefined)
								{
									nowait = false;
								}
								if(nowait || $(\'#qanswers input:checked\').length > 0)
								{
									questgonext("result");
								}
								else
								{
									pulseError(\'Bitte treffe erst eine Auswahl!\')
								}	
							}
										
							$("li.noanswer").click(function(){
								setTimeout(function(){
									if($("input.nocheck:checked").length > 0)
									{
										$("li.answer input").each(function(){
											this.checked = false;
										});
									}
								},50);
							});
							
							$("li.answer input").click(function(){
								if(this.checked)
								{
								
								}
							});
							
							$("li.answer, li.noanswer").click(function(ev){
								
								var nName = ev.target.nodeName.toLowerCase();
								
								if(nName == "li" || nName == "label")
								{
									if($(this).children("label").children("input:checked").length >= 1)
									{
										$(this).children("label").children("input")[0].checked = false;
									}
									else
									{
										$(this).children("label").children("input")[0].checked = true;
									}
								}
							});
							
							$("li.answer").click(function(){
								
								if($("li.answer input:checked").length > 0)
								{
									$("input.nocheck")[0].checked = false;
								}
							});
	
							var width = 1000;
							if($(window).width() < 1000)
							{
								width = ($(window).width()-40);
							}
							$("#'.$dia->getId().'").dialog("option",{
								width:width,
								height:($(window).height()-40)
							});
							$(window).resize(function(){
								var width = 1000;
								if($(window).width() < 1000)
								{
									width = ($(window).width()-40);
								}
								$("#'.$dia->getId().'").dialog("option",{
									width:width,
									height:($(window).height()-40)
								});
							});
						
							
							
						' . $quizbreath;
						return $return;
					}
					else
					{
						$i++;
						S::set('quiz-index',$i);
						return array(
							'status' => 1,
							'script' => 'pulseError("Diese Frage hat Keine Antworten, überspringe...");ajreq("next",{app:"quiz"});'		
						);
					}
				}
			}
			else
			{
				return $this->quizResult();
			}
		}
		
		$i++;
		S::set('quiz-index',$i);
		return array(
				'status' => 1,
				'script' => 'pulseError("Es ist ein Fehler aufgetreten, Frage wird übersprungen");ajreq("next",{app:"quiz"});'
		);
		
	}
	
	private function quizResult()
	{
		if(!S::may())
		{
			return false;
		}
		
		if($quiz = $this->model->getQuiz(S::get('quiz-id')))
		{
			if($questions = S::get('quiz-questions'))
			{
				
				if($rightQuestions = $this->model->getRightQuestions(S::get('quiz-id')))
				{
					$explains = array();
					$fp = 0;
					$question_number = 0;
					foreach ($questions as $q_key => $q)
					{
						$question_number++;
						$valid = $this->validateAnswer($rightQuestions, $q);
						$fp += $valid['fp'];
						foreach ($valid['explain'] as $e)
						{
							if(!isset($explains[$q['id']]))
							{
								$explains[$q['id']] = $rightQuestions[$q['id']];
								$explains[$q['id']]['explains'] = array();
							}
							$explains[$q['id']]['explains'][] = $e;
							$explains[$q['id']]['number'] = $question_number;
							$explains[$q['id']]['percent'] = round($valid['percent'],2);
							$explains[$q['id']]['userfp'] = round($valid['fp'],2);
						}
					}
				}
				
				$this->model->finishQuiz(S::get('quiz-session'), $questions, $explains, $fp, $quiz['maxfp']);
				
				return array(
					'status' => 1,
					'script' => 'goTo("/?page=settings&sub=quizsession&sid='.(int)S::get('quiz-session').'");'
				);
				
				$dia = new XhrDialog();
				$dia->setTitle('Ergebnis');
				
				$dia->addOpt('width', 600);
				$dia->addOpt('height', '($(window).height()-60)',false);
				
				$dia->addContent($this->view->result($explains,$fp,$quiz['maxfp']));
				
				$return = $dia->xhrout();
				$return['script'] .= '
				
				$("#explains").accordion({
						heightStyle: "content",
						animate: 200,
						collapsible: true,
						autoHeight: false, 
	    				active: false 
					});
					
					var width = 1000;
					if($(window).width() < 1000)
					{
						width = ($(window).width()-40);
					}
					$("#'.$dia->getId().'").dialog("option",{
						width:width,
						height:($(window).height()-40)
					});
					$(window).resize(function(){
						var width = 1000;
						if($(window).width() < 1000)
						{
							width = ($(window).width()-40);
						}
						$("#'.$dia->getId().'").dialog("option",{
							width:width,
							height:($(window).height()-40)
						});
					});';
				
				return $return;
				
			}
		}
	}

	private function resultNew($question,$diaId)
	{
		$uanswers = array();

		if(isset($question['answers']) && is_array($question['answers']))
		{
			foreach ($question['answers'] as $a)
			{
				$uanswers[$a] = $a;
			}
		}
		// get the question
		if($quest = $this->model->getQuestion($question['id']))
		{
			// get possible answers
			if($answers = $this->model->getAnswers($question['id']))
			{
				$joke = false;
				if($question['fp'] == 0)
				{
					$joke = true;
				}
	
				$out = array();
				foreach ($answers as $a)
				{
					// schwerzfrageoder
					if($joke)
					{
						$bg = '#F5F5B5';
						$atext = '';
						$color = '#4A3520';
					}
					//neutraleantwort
					else if($a['right'] == 2)
					{
						$atext = 'Neutrale Antwort wird nicht gewertet';
						$bg = '#F5F5B5';
						$color = '#4A3520';
					}
					// Antwort richtig angeklickt
					else if((isset($uanswers[$a['id']]) && $a['right'] == 1) || (!isset($uanswers[$a['id']]) && $a['right'] == 0))
					{
						if($a['right'] == 0)
						{
							$atext = 'Diese Antwort war natürlich falsch, das hast Du richtig erkannt';
						}
						else
						{
							$atext = 'Richtig! Diese Antwort stimmt.';
						}
						$bg = '#599022';
						$color = '#ffffff';
					}
					// Antwort richtig weil nicht angeklickt
					else
					{
						if($a['right'] == 0)
						{
							$atext = 'Falsch, Diese Antwort stimmt nicht.';
						}
						else
						{
							$atext = 'Auch diese Antwort wäre richtig gewesen.';
						}
						$bg = '#E74955';
						$color = '#ffffff';
					}
						
					$out[] = array(
						'id' => $a['id'],
						'exp' => nl2br($a['explanation']),
						'bg' => $bg,
						'atext' => $atext,
						'color'=> $color
					);
				}
			}
		}
	
		
		return array(
			'status' => 1,
			'script' => '
				$(".ui-dialog-titlebar-close").show();
				
				$(".quiz-questiondialog .ui-dialog-buttonset .ui-button").hide();
				$(".quiz-questiondialog .ui-dialog-buttonset .ui-button:last").show();
				$(".quiz-questiondialog .ui-dialog-buttonset .ui-button:contains(\'Pause\')").show();
				$("#quizcomment").show();
				$("#countdown").hide();
				
				var answers = '.json_encode($out).';
				$(".answer, .answer span").css({
					"cursor":"default"
				});
				$("#qanswers input").attr("disabled",true);
				$(".noanswer").hide();
				for(var i=0;i<answers.length;i++)
				{
					$("#qanswer-" + answers[i].id).css({
						"background-color":answers[i].bg,
						"color":answers[i].color
					}).effect("highlight").attr("onmouseover","return false;").attr("onmouseout","return false;");
					$("#qanswer-" + answers[i].id).append(\'<div style="margin:15px 0 0 43px;">\'+answers[i].atext+\'</div><div id="explanation-\'+answers[i].id+\'" style="font-weight:bold;margin:15px 0 0 43px;"><span class="tail">\'+answers[i].exp.substr(0,60)+\'...</span><span class="complete" style="display:none">\'+answers[i].exp+\'</span> <a style="color:\'+answers[i].color+\';font-weight:bold;" href="#" onclick="$(this).parent().children().toggle();return false;">mehr lesen <i class="fa fa-arrow-circle-o-right"></i></a></div>\');
				}
				
			'
		);
		
	}
	
	public function pause()
	{
		$dia = new XhrDialog();
		$dia->setTitle('Pause');
		$dia->addContent($this->view->pause());
		$dia->addJsBefore('
			
		');
		$dia->addJs('
			clearInterval(counter);	
		');
		
		$dia->addOpt('open','
			function(){
				setTimeout(function(){
					$close = $("#'.$dia->getId().'").prev().children(".ui-dialog-titlebar-close");
					//$close.unbind("click");
					$close.click(function(){
						ajreq(\'next\',{app:\'quiz\'});
					});
				},200);
			}',false);
		
		$dia->addButton('Später weitermachen','$(this).dialog("close");');
		$dia->addButton('weiter gehts!','ajreq(\'next\',{app:\'quiz\'});');
		
		return $dia->xhrout();
	
	}
	
	private function validateAnswer($rightQuestions,$question)
	{
		
		$explains = array();
		
		$wrongAnswers = 0;
		$checkCount = 0;
		
		$everything_false = true;
		
		$useranswers = array();
		if(isset($question['answers']) && is_array($question['answers']))
		{
			$useranswers = $question['answers'];
		}
		$allNeutral= true;
		if(isset($rightQuestions[$question['id']]['answers']))
		{
			foreach ($rightQuestions[$question['id']]['answers'] as $id => $a)
			{			
				
				switch ($a['right'])
				{
					// Antwort soll falsch sein
					case 0 : 
						$checkCount++;
						$allNeutral = false;
						if(in_array($a['id'], $useranswers))
						{
							$wrongAnswers++;
							// Erklärungen anfügen
							$explains[$a['id']] = $rightQuestions[$question['id']]['answers'][$a['id']];
						}
						break;
					// Antwort ist richtig wenn nicht im array fehler
					case 1 : 
						$everything_false = false;
						$allNeutral = false;
						$checkCount++;
						if(!in_array($a['id'], $useranswers))
						{
							$wrongAnswers++;
							// Erklärungen anfügen
							$explains[$a['id']] = $rightQuestions[$question['id']]['answers'][$a['id']];
						}
						break;
					default :
						
						// Bei Neutralen Fragen einfach erklärung anfügen
						$explains[$a['id']] = $rightQuestions[$question['id']]['answers'][$a['id']];
						break;
				}
			}
		}
		else
		{
			$wrongAnswers = count($rightQuestions[$question['id']]['answers']);
		}

		// wie viel Prozent sind falsch?
		$percent = $this->percentFrom($checkCount, $wrongAnswers);
		
		$fp = $this->percentTo($question['fp'], $percent);
		
		// wenn alles falsch angeklickt wurde, das aber nicht stimmt, gibt's die volle Fehlerpunktezahl
		if(
			(!$everything_false && !isset($question['noco']))
			||
			(!$everything_false && (int)$question['noco'] > 0)
		)
		{
			$fp = $question['fp'];
			$percent = 100;
		}
		
		// fix alle fragen sind neutral
		if($allNeutral)
		{
			$fp = 0;
			$percent = '0';
		}
		
		return array(
			'fp' => $fp,
			'explain' => $explains,
			'percent' => $percent
		);
	}
	
	private function getRandomQuestions($quiz_id, $count = 6)
	{
		$count_questions = $count;

		if($questions = $this->model->getQuestionMetas($quiz_id))
		{
			// Wie viele Fragen gibt es insgesamt?
			$summe = 0;
			foreach($questions['meta'] as $key => $m)
			{
				$summe += $m;
			}
			
			$out = array();
			// Prozentanzeil von jeder Fragenart
			foreach($questions['meta'] as $key => $m)
			{
				$percent = round($this->percentFrom($summe,$m));
		
				$count = round($this->percentTo($count_questions, $percent));
		
				if($rquest = $this->model->getRandomQuestions($count,$key,$quiz_id))
				{
					foreach ($rquest as $r)
					{
						$out[] = $r;
					}
				}
			}

			if(!empty($out))
			{
				shuffle($out);
				return $out;
			}
			
			return false;
		}
	}
	
	private function percentTo($part, $percent)
    {
        return ($part / 100) * $percent;
    }
	
	private function percentFrom($total,$part)
	{
		if($total == 0)
		{
			return 100;
		}
		return ($part / ($total / 100));
	}
	
	public function updatequest()
	{
		if(mayEditQuiz())
		{
			
			/*
			 *   [id] => 10
			     [text] => test
			     [fp] => 3
			 */
			if(isset($_GET['text']) && isset($_GET['fp']) && isset($_GET['id']))
			{
				$fp = (int)$_GET['fp'];
				$text = strip_tags($_GET['text']);
				$duration = (int)$_GET['duration'];
				$wikilink = strip_tags($_GET['wikilink']);
				
				if(!empty($text))
				{
					$this->model->updateQuestion($_GET['id'],$_GET['qid'],$text,$fp,$duration,$wikilink);
					fs_info('Frage wurde geändert');
					return array(
						'status' => 1,
						'script' => 'reload();'
					);	
					
				}
				else
				{
					return array(
						'status' => 1,
						'script' => 'pulseError("Du solltest einen Text angeben ;)");'
					);
				}
			}
		}
	}
}
