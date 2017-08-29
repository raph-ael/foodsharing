<?php
if(getAction('neu'))
{
	handle_add();
	
	addBread(s('bread_faq'),'/?page=faq');
	addBread(s('bread_new_faq'));
			
	addContent(faq_form());

	addContent(v_field(v_menu(array(
		pageLink('faq','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
elseif($id = getActionId('delete'))
{
	if($db->del_faq($id))
	{
		fs_info(s('faq_deleted'));
		goPage();
	}
}
elseif($id = getActionId('edit'))
{
	handle_edit();
	addBread(s('bread_faq'),'/?page=faq');
	addBread(s('bread_edit_faq'));
	
	$data = $db->getOne_faq($id);
	setEditData($data);
			
	addContent(faq_form());
			
	addContent(v_field(v_menu(array(
		pageLink('faq','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
else if(isset($_GET['id']))
{
	$data = $db->getOne_faq($_GET['id']);	
	print_r($data);	
}
else
{
	addBread(s('faq_bread'),'/?page=faq');
	
	if($data = $db->get_faq())
	{
		$sort = array();
		foreach ($data as $d)
		{
			if(!isset($sort[$d['faq_kategorie_id']]))
			{
				$sort[$d['faq_kategorie_id']] = array();
			}
			$sort[$d['faq_kategorie_id']][] = $d;
		}
		
		foreach ($sort as $key => $data)
		{
			$rows = array();
			foreach ($data as $d)
			{
				$rows[] = array(
					array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=faq&a=edit&id='.$d['id'].'">'.$d['name'].'</a>'),
					array('cnt' => v_toolbar(array('id'=>$d['id'],'types' => array('edit','delete'),'confirmMsg'=>sv('delete_sure',$d['name'])))
				));
			}
			
			$table = v_tablesorter(array(
					array('name' => s('name')),
					array('name' => s('actions'),'sort' => false,'width' => 50)
			),$rows);
			
			addContent(v_field($table,$db->getVal('name', 'faq_category', $key)));
		}
		
		
	}
	else
	{
		fs_info(s('faq_empty'));
	}
			
	addContent(v_field(v_menu(array(
		array('href' => '/?page=faq&a=neu','name' => s('neu_faq'))
	)),'Aktionen'),CNT_RIGHT);
}					
function faq_form()
{
	global $db;
	$cats = $db->getBasics_faq_category();
	return v_form('faq', array(
			v_field(
				v_form_select('faq_kategorie_id',array('add'=>true,'required'=>true,'values'=>$cats)).
				v_form_textarea('name',array('style'=>'height:75px;','required'=>true)),
				
				s('neu_faq'),
				array('class'=>'ui-padding')
			),
			v_field(v_form_tinymce('answer',array('nowrapper'=>true)), s('answer'))
	));
}

function handle_edit()
{
	global $db;
	global $g_data;
	
	if(submitted())
	{
		$g_data['foodsaver_id'] = fsId();
		if($db->update_faq($_GET['id'],$g_data))
		{
			fs_info(s('faq_edit_success'));
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
		$g_data['foodsaver_id'] = fsId();
		if($db->add_faq($g_data))
		{
			fs_info(s('faq_add_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}
?>
