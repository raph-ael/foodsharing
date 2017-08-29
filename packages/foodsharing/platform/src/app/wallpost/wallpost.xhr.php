<?php 
class WallpostXhr extends Control
{
	private $tables;
	private $table;
	private $id;
	
	public function __construct()
	{
		$this->model = new WallpostModel();
		$this->view = new WallpostView();

		parent::__construct();
		
		$this->tables = array(
			'fairteiler' => true,
			'foodsaver' => true,
			'application' => true,
			'bezirk' => true,
			'event' => true,
			'fsreport' => true,
			'question' => true,
			'basket' => true,
			'usernotes'=> true
		);
		
		if($this->isAllowed($_GET['table']) && (int)$_GET['id'] > 0)
		{
			$this->table = $_GET['table'];
			$this->id = (int)$_GET['id'];
			$this->model->setTable($this->table, $this->id);
			$this->view->setTable($this->table);
		}
		else
		{
			echo '{status:0}';
			exit();
		}
	}
	
	public function delpost()
	{
		if((int)$_GET['post'] > 0) {

			$fs = $this->model->getFsByPost((int)$_GET['post']);
			if ($fs == fsId()
				|| (!in_array($this->table, array('fairteiler', 'foodsaver')) && (isBotschafter() || isOrgateam())) )
			{
				if ($this->model->delpost((int)$_GET['post'])) {
					return array(
						'status' => 1
					);
				}
			}
		}
		return array(
				'status' => 0
		);
	}
	
	public function update()
	{
		if((int)$this->model->getLastPostId() != (int)$_GET['last'])
		{
			if($posts = $this->model->getLastPosts())
			{
				return array(
						'status' => 1,
						'html' => $this->view->posts($posts)
				);
			}
		}
		else
		{
			return array(
				'status' => 0
			);
		}
	}
	
	public function quickreply()
	{
		$message = trim(strip_tags($_POST['msg']));

		if(!empty($message))
		{
			if($post_id = $this->model->post($message))
			{
				echo json_encode(array(
						'status' => 1,
						'message' => 'Klasse! Dein Pinnwandeintrag wurde gespeichert.'
				));
				exit();
			}
		}
		
		echo json_encode(array(
				'status' => 0,
				'message' => 'Upps! Dein Pinnwandeintrag konnte nicht gespeichert werden.'
		));
		exit();
	}
	
	public function post()
	{
		$message = strip_tags($_POST['text']);
		if(!(empty($message) && empty($_POST['attach'])))
		{
			$attach = '';
			if(!empty($_POST['attach']))
			{
				$parts = explode(':', $_POST['attach']);
				if(count($parts) > 0)
				{
					$attach = array();
					foreach ($parts as $p)
					{
						$file = explode('-', $p);
						if(count($file) > 0)
						{
							if(!isset($attach[$file[0]]))
							{
								$attach[$file[0]] = array();
							}
							$attach[$file[0]][] = array(
								'file' => $file[1]
							);
						}
						
					}
					$attach = json_encode($attach);
				}
			}
			if($post_id = $this->model->post($message,$attach))
			{
				return array(
					'status' => 1,
					'html' => $this->view->posts($this->model->getLastPosts()),
					'script' => '
					if(u_wallpostReady != undefined && $.isFunction(u_wallpostReady))
					{
						u_wallpostReady('.(int)$post_id.');
					}'
				);
			}
			
			
			
		}
	}
	
	private function isAllowed($table)
	{
		if(isset($this->tables[$table]))
		{
			return true;
		}
		
		return false;
	}
	
	public function attachimage()
	{
		$init = '';
		if(isset($_FILES['etattach']['size']) && $_FILES['etattach']['size'] < 9136365 && $this->attach_allow($_FILES['etattach']['name'], $_FILES['etattach']['type']))
		{
			$new_filename = uniqid();
			
			$ext = strtolower($_FILES['etattach']['name']);
			$ext = explode('.', $ext);
			if(count($ext) > 1)
			{
				$ext = end($ext);
				$ext = trim($ext);
				$ext = '.'.preg_replace('/[^a-z0-9]/', '', $ext);
			}
			else
			{
				$ext = '';
			}
			
			$new_filename = $new_filename.$ext;
			
			move_uploaded_file($_FILES['etattach']['tmp_name'], 'images/wallpost/'.$new_filename);
			
			copy('images/wallpost/'.$new_filename, 'images/wallpost/thumb_'.$new_filename);
			copy('images/wallpost/'.$new_filename, 'images/wallpost/medium_'.$new_filename);
			$image = new fImage('images/wallpost/medium_'.$new_filename);
			$image->resize(530, 0);
			$image->saveChanges();
			
			$image = new fImage('images/wallpost/'.$new_filename);
			$image->resize(1000, 0);
			$image->saveChanges();
			
			$image = new fImage('images/wallpost/thumb_'.$new_filename);
			$image->cropToRatio(1, 1);
			$image->resize(75, 75);
			$image->saveChanges();
			
			$init = 'window.parent.mb_finishImage("'.$new_filename.'");';
		}
		elseif(!$this->attach_allow($_FILES['etattach']['name']))
		{
			$init = 'window.parent.pulseInfo(\''.jsSafe(s('wrong_file')).'\');window.parent.mb_clear();';
		}
		else 
		{
			$init = 'window.parent.pulseInfo(\''.jsSafe(s('file_to_big')).'\');window.parent.mb_clear();';
		}
		
		echo '<html><head>

		<script type="text/javascript">
			function init()
			{
				'.$init.'
			}
		</script>
				
		</head><body onload="init();"></body></html>';
		
		exit();
	}
	
	public function attach_allow($filename,$mime = '')
	{
		if(strlen($filename) < 300)
		{
			$ext = explode('.', $filename);
			$ext = end($ext);
			$ext = strtolower($ext);
			$allowed = array(
					'jpg' => true,
					'jpeg' => true,
					'png' => true,
					'gif' => true,
					'png' => true
			);
			$notallowed_mime = array();
				
			if(isset($allowed[$ext]))
			{
				return true;
			}
		}
	
		return false;
	}
}
