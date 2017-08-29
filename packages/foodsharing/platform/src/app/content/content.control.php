<?php
class ContentControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new ContentModel();
		$this->view = new ContentView();
		
		parent::__construct();
		
	}
	
	public function index()
	{
		if(!isset($_GET['sub']))
		{
			if(!S::may('orga'))
			{
				go('/');
			}
			
			$db = $this->model;
			
			if(getAction('neu'))
			{
				$this->handle_add();
			
				addBread(s('bread_content'),'/?page=content');
				addBread(s('bread_new_content'));
			
				addContent($this->content_form());
			
				addContent(v_field(v_menu(array(
				pageLink('content','back_to_overview')
				)),s('actions')),CNT_RIGHT);
			}
			elseif($id = getActionId('delete'))
			{
				if($db->del_content($id))
				{
					fs_info(s('content_deleted'));
					goPage();
				}
			}
			elseif($id = getActionId('edit'))
			{
				$this->handle_edit();
			
				addBread(s('bread_content'),'/?page=content');
				addBread(s('bread_edit_content'));
			
				$data = $db->getOne_content($id);
				setEditData($data);
			
				addContent($this->content_form());
			
				addContent(v_field(v_menu(array(
				pageLink('content','back_to_overview')
				)),s('actions')),CNT_RIGHT);
			}
			else if($id = getActionId('view'))
			{
				if($cnt = $this->model->getContent($id))
				{
					addBread($cnt['title']);
					addTitle($cnt['title']);

					addContent($this->view->simple($cnt));
				}
			}
			else if(isset($_GET['id']))
			{
				go('/?page=content&a=edit&id='.(int)$_GET['id']);
			}
			else
			{
				addBread(s('content_bread'),'/?page=content');
			
				if($data = $db->getBasics_content())
				{
					$rows = array();
					foreach ($data as $d)
					{
			
						$rows[] = array(
								array('cnt'=>$d['id']),
								array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=content&id='.$d['id'].'">'.$d['name'].'</a>'),
								array('cnt' => v_toolbar(array('id'=>$d['id'],'types' => array('edit','delete'),'confirmMsg'=>sv('delete_sure',$d['name'])))
								));
					}
			
					$table = v_tablesorter(array(
							array('name' => 'ID','width'=>30),
							array('name' => s('name')),
							array('name' => s('actions'),'sort' => false,'width' => 50)
					),$rows);
			
					addContent(v_field($table,'Öffentliche Webseiten bearbeiten'));
				}
				else
				{
					fs_info(s('content_empty'));
				}
			
				addContent(v_field(v_menu(array(
				array('href' => '/?page=content&a=neu','name' => s('neu_content'))
				)),'Aktionen'),CNT_RIGHT);
			}
		}
		
	}
	
	public function partner()
	{
		if($cnt = $this->model->getContent(10))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
			
			addContent($this->view->partner($cnt));
		}
	}

	public function unterstuetzung()
	{
		if($cnt = $this->model->getContent(42))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
			
			addContent($this->view->simple($cnt));
		}
	}
	
	public function leeretonne()
	{
		if($cnt = $this->model->getContent(46))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
			
			addContent($this->view->simple($cnt));
		}
	}

	public function fairteilerrettung()
	{
		if($cnt = $this->model->getContent(49))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
			
			addContent($this->view->simple($cnt));
		}

	}
	
	public function faq()
	{
		addBread('F.A.Q');
		addTitle('F.A.Q.');
		
		$cat_ids = array(1,6,7);
		if(S::may('fs'))
		{
			$cat_ids[] = 2;
			$cat_ids[] = 4;
		}
		if(S::may('bot'))
		{
			$cat_ids[] = 5;
		}
		
		if($faq = $this->model->listFaq($cat_ids))
		{
			addContent($this->view->faq($faq));
		}
	}
	
	public function impressum()
	{
		if($cnt = $this->model->getContent(8))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
				
			addContent($this->view->impressum($cnt));
		}
	}
	
	public function about()
	{
		if($cnt = $this->model->getContent(9))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);
				
			addContent($this->view->about($cnt));
		}
	}
	
	public function ratgeber()
	{
		$this->setContentWidth(9, 7);
		addBread('Ratgeber');
		addTitle('Ratgeber');
		addContent($this->view->ratgeber());
		
		addContent($this->view->ratgeberRight(),CNT_RIGHT);
	}

	public function fuer_unternehmen()
	{
		if($cnt = $this->model->getContent(4))
		{
			addBread($cnt['title']);
			addTitle($cnt['title']);

			addContent($this->view->partner($cnt));
		}
	}

	private function content_form($title = 'Content Management')
	{
		return v_form('faq', array(
			v_field(
				v_form_text('name',array('required'=>true)).
				v_form_text('title',array('required'=>true)),

				$title,
				array('class'=>'ui-padding')
			),
			v_field(v_form_tinymce('body',array('filemanager' => true,'public_content'=>true,'nowrapper'=>true)), 'Inhalt')
		),array('submit'=>s('save')));
	}

	private function handle_edit()
	{
		global $db;
		global $g_data;
		if(submitted())
		{
			$g_data['last_mod'] = date('Y-m-d H:i:s');
			if($db->update_content($_GET['id'],$g_data))
			{
				fs_info(s('content_edit_success'));
				go('/?page=content&a=edit&id='.(int)$_GET['id']);
			}
			else
			{
				error(s('error'));
			}
		}
	}

	private function handle_add()
	{
		global $db;
		global $g_data;
		if(submitted())
		{
			$g_data['last_mod'] = date('Y-m-d H:i:s');
			if($db->add_content($g_data))
			{
				fs_info(s('content_add_success'));
				goPage();
			}
			else
			{
				error(s('error'));
			}
		}
	}
}
