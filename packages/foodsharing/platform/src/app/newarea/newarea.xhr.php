<?php 
class NewareaXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new NewareaModel();
		$this->view = new NewareaView();

		parent::__construct();
	}
	
	public function orderFs()
	{
		if(isOrgaTeam())
		{
			if((int)$_GET['bid'] == 0)
			{
				return array(
					'status' => 1,
					'script' => 'error("Du musst noch einen Bezirk auswählen. in den Die Foodsaver sortiert werden.");'
				);
			}
			else
			{
				$bezirk_id = (int)$_GET['bid'];
				$fsids = explode('-', $_GET['fs']);
				if(count($fsids) > 0)
				{
					$count = 0;
					$js = '';
					foreach ($fsids as $fid)
					{
						$fid = (int)$fid;
						if($fid > 0)
						{
							$count++;
							$this->model->linkBezirk($fid, $bezirk_id);
							
							$foodsaver = $this->model->getValues(array('geschlecht','email','name','nachname'), 'foodsaver', $fid);
							$anrede = genderWord($foodsaver['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r');
							$name = $foodsaver['name'];
							
							$message = str_replace(array('{ANREDE}','{NAME}'), array($anrede,$name), $_GET['msg']);
							
							
							libmail(array(
								'email' => 'info@lebensmittelretten.de',
								'email_name' => 'Foodsharing Freiwillige'
							), $foodsaver['email'], $_GET['subject'], $message);
							$this->model->clearWantNew($fid);
							
							$js .= '$(".wantnewcheck[value=\''.$fid.'\']").parent().parent().remove();';
						}
					}
					return array(
						'status' => 1,
						'script' => 'pulseInfo("'.$count.' E-Mails wurden versendet");'.$js	
					);
				}
			}
		}
	}
	
	public function deleteMarked()
	{
		if(isOrgaTeam())
		{
			$parts = explode('-', $_GET['del']);
			if(count($parts) > 0)
			{
				foreach ($parts as $p)
				{
					$this->model->clearWantNew($p);
				}
			}
			
			return array(
				'status' => 1
			);
		}
	}
}