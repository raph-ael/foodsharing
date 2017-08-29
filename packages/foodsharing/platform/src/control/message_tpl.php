<?php
if(!S::may('orga'))
{
	go('/');
}

if(getAction('neu'))
{
	handle_add();
	
	addBread(s('bread_message_tpl'),'/?page=message_tpl');
	addBread(s('bread_new_message_tpl'));
			
	addContent(message_tpl_form());

	addContent(v_field(v_menu(array(
		pageLink('message_tpl','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
elseif($id = getActionId('delete'))
{
	if(del_message_tpl($id))
	{
		fs_info(s('message_tpl_deleted'));
		goPage();
	}
}
elseif($id = getActionId('edit'))
{
	handle_edit();
	
	addBread(s('bread_message_tpl'),'/?page=message_tpl');
	addBread(s('bread_edit_message_tpl'));
	
	$data = getOne_message_tpl($id);
	setEditData($data);
			
	addContent(message_tpl_form());
			
	addContent(v_field(v_menu(array(
		pageLink('message_tpl','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
else
{
	addBread(s('message_tpl_bread'),'/?page=message_tpl');
	
	if($data = getBasics_message_tpl())
	{
		$rows = array();
		foreach ($data as $d)
		{
			$rows[] = array(
				array('cnt'=>$d['id']),
				array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=message_tpl&a=edit&id='.$d['id'].'">'.$d['name'].'</a>')		
			);
		}
		
		$table = v_tablesorter(array(
			array('name' => 'ID','width'=>30),
			array('name' => s('name'))
		),$rows);
		
		addContent(v_field($table,'Alle E-Mail Vorlagen'));	
	}
	else
	{
		fs_info(s('message_tpl_empty'));
	}
			
	addContent(v_field(v_menu(array(
		array('href' => '/?page=message_tpl&a=neu','name' => s('neu_message_tpl'))
	)),'Aktionen'),CNT_RIGHT);
}
function message_tpl_form()
{
	global $db;
	global $g_data;
	$g_data['language_id'] = 1;
	return v_form('E-Mail Vorlage', array(
			v_field(
					v_form_select('language_id').
					v_form_text('name',array('required'=>true)).
					v_form_text('subject',array('required' => array())).
					v_form_file('attachement'),
					'E-Mail Vorlage',
					array('class'=>'ui-padding')
			),
			v_field(v_form_tinymce('body',array('nowrapper'=>true)), s('message'))
	),array('submit'=>'Speichern'));
}

function handle_edit()
{
	global $g_data;
	if(submitted())
	{
		if(update_message_tpl($_GET['id'],$g_data))
		{
			fs_info(s('message_tpl_edit_success'));
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
		if($db->add_message_tpl($g_data))
		{
			fs_info(s('message_tpl_add_success'));
			goPage();
		}
		else
		{
			error(s('error'));
		}
	}
}

function getBasics_message_tpl()
{
	global $db;
	return $db->q('
			SELECT 	 	`id`,
						`name`
			
			FROM 		`'.PREFIX.'message_tpl`
			ORDER BY  	`name`');
}
	
function getOne_message_tpl($id)
{
	global $db;
	$out = $db->qRow('
			SELECT
			`id`,
			`language_id`,
			`name`,
			`subject`,
			`body`
			
			FROM 		`'.PREFIX.'message_tpl`
			
			WHERE 		`id` = ' . (int)$id);

	return $out;
}

function del_message_tpl($id)
{
	global $db;
	return $db->del('
			DELETE FROM 	`'.PREFIX.'message_tpl`
			WHERE 			`id` = '.$db->intval($id));
}

function update_message_tpl($id,$data)
{
	global $db;
	return $db->update('
		UPDATE 	`'.PREFIX.'message_tpl`

		SET 	`language_id` =  '.$db->intval($data['language_id']).',
				`name` =  '.$db->strval($data['name']).',
				`subject` =  '.$db->strval($data['subject']).',
				`body` =  '.$db->strval($data['body'],'<p><br><a><h1><h2><h3><ul><li><ol>').'

		WHERE 	`id` = '.$db->intval($id));
}			
?>
