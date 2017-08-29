<?php 
class FairteilerXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new FairteilerModel();
		$this->view = new FairteilerView();

		parent::__construct();
	}
	
	public function load()
	{
		if(($id = (int)$_GET['id']) > 0)
		{
			if($fairteiler = $this->model->getFairteiler($id))
			{
				$fairteiler['updates'] = false;
				if($updates = $this->model->getLastUpdates($id))
				{
					$fairteiler['updates'] = $updates;
				}
				
				return array(
					'status' => 1,
					'html' => $this->view->publicFairteilerMap($fairteiler),
					'name' => $fairteiler['name']
				);
			}
		}
	}
	
	public function infofollower()
	{
		if(!$this->mayFairteiler($_GET['fid']))
		{
			return false;
		}
		
		if($ft = $this->model->getFairteiler($_GET['fid']))
		{
			if($follower = $this->model->getEmailFollower($_GET['fid']))
			{
				$post = $this->model->getLastFtPost($_GET['fid']);
				
				$body = nl2br($post['body']);

				if(!empty($post['attach']))
				{
					$attach = json_decode($post['attach'],true);
					if(isset($attach['image']) && !empty($attach['image']))
					{
						foreach ($attach['image'] as $img)
						{
							$body .= '
							<div>
								<img src="http://www.'.DEFAULT_HOST.'/images/wallpost/medium_'.$img['file'].'" />
							</div>';
						}
					}
				}
				
				foreach ($follower as $f)
				{
					tplMail(18, $f['email'],array(
						'link' => 'http://www.lebensmittelretten.de/?page=fairteiler&sub=ft&id='.(int)$_GET['fid'],
						'name' => $f['name'],
						'anrede' => genderWord($f['geschlecht'], 'Lieber', 'Liebe', 'Liebe/r'),
						'fairteiler' => $ft['name'],
						'post' => $body
					));
				}
			}
			
			if($follower = $this->model->getInfoFollower($_GET['fid']))
			{
				$this->model->addBell(
					$follower, 
					'ft_update_title', 
					'ft_update', 
					'img img-recycle yellow', 
					array('href' => '/?page=fairteiler&sub=ft&id='.(int)$_GET['fid']), 
					array('name' => $ft['name'],'user'=>S::user('name'),'teaser'=>tt($post['body'],100)),
					'fairteiler-'.(int)$_GET['fid']
				);
			}
		}
		
		return array(
			'status' => 1
		);
	}
	
	private function mayFairteiler($fid)
	{
		if($ids = $this->model->getFairteilerIds())
		{
			if(isset($ids[$fid]))
			{
				return true;
			}
		}
		
		return false;
	}
}
