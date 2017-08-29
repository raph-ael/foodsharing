<?php
class BcardControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new BcardModel();
		$this->view = new BcardView();
		
		parent::__construct();
		
	}
	
	public function index()
	{		
		addBread(s('bcard_generator'));
		
		addContent($this->view->top(),CNT_TOP);
		
		if($data = $this->model->getMyData())
		{
			if(strlen($data['anschrift'].', '.$data['plz'].' '.$data['stadt']) >= 49)
			{
				error('Deine Anschrift ist zu lang, Anschrift Postleitzahl und Stadt dürfen zusammen maximal 49 Zeichen haben.');
				go('/?page=settings');
			}
			if(strlen($data['telefon'].$data['handy']) <= 3)
			{
				error('Du musst eine gültige Telefonnummer angegeben haben um Deine Visitenkarte zu generieren');
				go('/?page=settings');
			}
			$sel_data = array();
			if($data['bot'])
			{
				foreach ($data['bot'] as $b)
				{
					$sel_data[] = array(
						'id' => 'bot:'.$b['id'],
						'name' => sv('bot_for',$b['name'])
					);
				}
			}
			if($data['fs'])
			{
				foreach ($data['fs'] as $fs)
				{
					$sel_data[] = array(
							'id' => 'fs:'.$fs['id'],
							'name' => sv('fs_for',$fs['name'])
					);
				}
			}
			
			addContent($this->view->optionform($sel_data));
		}
	}
	
	public function dl()
	{
		if($short = $this->getRequest('b'))
		{
			$short = explode(':', $short);
			
			$short[0] = str_replace(array('/',"\\"), '', $short[0]);
			
			$foodsaver = $this->model->getValues(array('name','nachname'), 'foodsaver', fsid());
			
			$file = 'data/visite/'.(int)$short[1].'_'.$short[0].'.pdf';

			if(file_exists($file))
			{
				$Dateiname = basename($file);
				$size = filesize($file);
				header('Content-Type: application/pdf');
				header("Content-Disposition: attachment; filename=bcard-".id($short[0])."-".id($foodsaver['name'])."-".id($foodsaver['nachname']).'.pdf');
				header("Content-Length: $size");
				readfile($file);
					
				exit();
			}
			else
			{
				goPage();
			}
		}
	}
}