<?php

if(getAction('neu'))
{
	handle_add();
	
	addBread(s('bread_kette'),'/?page=kette');
	addBread(s('bread_new_kette'));
			
	addContent(kette_form());

	addContent(v_field(v_menu(array(
		pageLink('kette','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
elseif($id = getActionId('delete'))
{
	if($db->del_kette($id))
	{
		fs_info(s('kette_deleted'));
		goPage();
	}
}
elseif($id = getActionId('edit'))
{
	handle_edit();
	
	addBread(s('bread_kette'),'/?page=kette');
	addBread(s('bread_edit_kette'));
	
	$data = $db->getOne_kette($id);
	setEditData($data);
			
	addContent(kette_form());
			
	addContent(v_field(v_menu(array(
		pageLink('kette','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
else if(isset($_GET['id']))
{
	go('/?page=kette&a=edit&id='.(int)$_GET['id']);
}
else
{
	addBread(s('kette_bread'),'/?page=kette');
	
	if($data = $db->getBasics_kette())
	{
		$rows = array();
		foreach ($data as $d)
		{
					
			$rows[] = array(
				array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=kette&id='.$d['id'].'">'.$d['name'].'</a>'),
				array('cnt' => v_toolbar(array('id'=>$d['id'],'types' => array('edit','delete'),'confirmMsg'=>sv('delete_sure',$d['name'])))			
			));
		}
		
		$table = v_tablesorter(array(
			array('name' => s('name')),
			array('name' => s('actions'),'sort' => false,'width' => 50)
		),$rows);
		
		addContent(v_field($table,'Alle Betriebs-Ketten'));	
	}
	else
	{
		fs_info(s('kette_empty'));
	}
			
	addContent(v_field(v_menu(array(
		array('href' => '/?page=kette&a=neu','name' => s('neu_kette'))
	)),'Aktionen'),CNT_RIGHT);
}

function kette_form()
{
	return v_quickform('kette',array(
		
		v_form_text('name'),
		v_form_picture('logo',array('resize' => array(100,200,300)))	
	));
}

function handle_edit()
{
	global $db;
	global $g_data;
	
	if(submitted())
	{
		if($db->update_kette($_GET['id'],$g_data))
		{
			fs_info(s('kette_edit_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}
function handle_add()
{
	global $db;
	global $g_data;
	if(submitted())
	{
		if($db->add_kette($g_data))
		{
			fs_info(s('kette_add_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}
?>
