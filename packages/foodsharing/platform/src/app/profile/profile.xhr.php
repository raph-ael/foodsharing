<?php 
class ProfileXhr extends Control
{
	private $foodsaver;
	private $model;
	private $view;
	
	public function __construct()
	{
		if(!S::may())
		{
			return array(
					'status' => 1,
					'script' => 'login();'
			);
		}
		$this->model = new ProfileModel();
		$this->view = new ProfileView();

		parent::__construct();
		
		if(isset($_GET['id']))
		{
			$this->model->setFsId($_GET['id']);
			$fs = $this->model->getData($_GET['id']);
			
			if(isset($fs['id']))
			{
				$this->foodsaver = $fs;
				$this->foodsaver['mailbox'] = false;
				if(S::may('orga') && (int)$fs['mailbox_id'] > 0)
				{
					$this->foodsaver['mailbox'] = $this->model->getVal('name', 'mailbox', $fs['mailbox_id']).'@'.DEFAULT_HOST;
				}
				
				/*
					* -1: no buddy
					*  0: requested
					*  1: buddy
				*/
				$this->foodsaver['buddy'] = $this->model->buddyStatus($this->foodsaver['id']);
				
				$this->view->setData($this->foodsaver);
			}
			else
			{
				$this->model->delBells('new-fs-'.(int)$_GET['id']);
				return array(
						'status' => 0
				);
			}
		}
	}
	
	public function rate()
	{
		$rate = 1;
		if(isset($_GET['rate']))
		{
			$rate = (int)$_GET['rate'];
		}
		
		$fsid = (int)$_GET['id'];
		
		if($fsid > 0)
		{		
			$type = (int)$_GET['type'];
			
			$message = '';
			if(isset($_GET['message']))
			{
				$message = strip_tags($_GET['message']);
			}
			
			if(strlen($message) < 100)
			{
				return array(
					'status' => 1,
					'script' => 'pulseError("Bitte gib mindestens einen 100 Zeichen langen Text zu Deiner Banane ein.");'
				);
			}
			
			$this->model->rate($fsid,$rate,$type,$message);

			$comment = '';
			if($msg = $this->model->getRateMessage($fsid))
			{
				$comment = $msg;
			}
			
			return array(
				'status' => 1,
				'comment' => $comment,
				'title' => 'Nachricht hinterlassen',
				'script' => '$("#fs-profile-rate-comment").dialog("close");$(".vouch-banana").tooltip("close");pulseInfo("Banane wurde gesendet!");profile('.(int)$fsid.');'
			);
		}
	}

	public function history()
	{
		$bids = $this->model->getFsBezirkIds($_GET['fsid']);
		if(S::may() && (S::may('orga') || isBotForA($bids,false,false)))
		{
			$dia = new XhrDialog();
			if($_GET['type'] == 0)
			{
				$history = $this->model->getVerifyHistory($_GET['fsid']);
				$dia->setTitle('Verifizierungshistorie');
				$dia->addContent($this->view->getHistory($history,$_GET['type']));
			}
			if($_GET['type'] == 1)
			{
				$history = $this->model->getPassHistory($_GET['fsid']);

				$dia->setTitle('Passhistorie');
				
				$dia->addContent($this->view->getHistory($history,$_GET['type']));
			}

			$dia->addOpt('width','400px');
			$dia->addOpt('height','($(window).height()-100)',false);
			
			return $dia->xhrout();
		}
	}

	public function deleteFromSlot()
	{
		$betriebModel = loadModel('betrieb');
		$betrieb = $betriebModel->getBetriebBezirkID($_GET['bid']);

		if(isOrgaTeam() || isBotFor($betrieb['bezirk_id']))
		{
			if($betriebModel->deleteFetchDate($_GET['fsid'],$_GET['bid'],date('Y-m-d H:i:s', $_GET['date'])))
			{
				return array(
				'status' => 1,
				'script' => '
					pulseSuccess("Termin gelöscht");
					reload();'
				);
			}
			else
			{
				return array(
					'status' => 1,
					'script' => 'pulseError("Es ist ein Fehler aufgetreten!");'
				);
			}
			
		}
		else 
		{
			return array(
					'status' => 1,
					'script' => 'pulseError("Du kannst nur Termine aus Deinem eigenen Bezirk löschen.");'
			);
		}
	}
	
	public function quickprofile()
	{
		if(!is_object($this->model))
		{
			$this->model = new ProfileModel();
			$this->view = new ProfileView();
		}
		
		$bezirk = $this->model->getBezirk($this->foodsaver['bezirk_id']);
		
		if($this->foodsaver['botschafter'])
		{
			$subtitle = 'ist '.genderWord($this->foodsaver['geschlecht'], 'Botschafter', 'Botschafterin', 'Botschafter/in').' f&uuml;r ';
			foreach ($this->foodsaver['botschafter'] as $i => $b)
			{
				$sep = ', ';
					
				if($i == (count($this->foodsaver['botschafter'])-2))
				{
					$sep = ' und ';
				}
					
				$subtitle .= $b['name'].$sep;
			}
		
			$subtitle = substr($subtitle, 0,(strlen($subtitle)-2));
			if($this->foodsaver['orgateam'] == 1)
			{
				$subtitle .= ', außerdem engagiert '.genderWord($this->foodsaver['geschlecht'], 'er', 'sie', 'er/sie').' sich im Foodsharing Orgateam';
			}
		}
		elseif($this->foodsaver['bezirk_id'] == 0)
		{
			$subtitle = 'hat sich bisher für keinen Bezirk entschieden.';
		}
		else
		{
			$subtitle = 'ist '.genderWord($this->foodsaver['geschlecht'], 'Foodsaver', 'Foodsaverin', 'Foodsaver').' für '.$bezirk['name'];
		}
		
		$photo = img($this->foodsaver['photo'],130,'q');
		
		return array(
				'status' => 1,
				'html' => $this->view->quickprofile($subtitle),
				'script' => ''
		);
	}
}
