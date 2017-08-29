<?php
if(isset($_GET['id']))
{
	
	if($res = $db->getOne_faq($_GET['id']))
	{
		
		addBread('FAQ`s','/?page=listFaq');
		addBread(substr($res['name'],0,30));
		
		$cnt = '';
		
		if(!empty($res['answer']))
		{
			$cnt .= $res['answer'];
		}
		
		addContent(v_field($cnt, $res['name'],array('class'=>'ui-padding')));
	}
	else
	{
		goPage('listFaq');
	}
}
else
{

	addBread('FAQ`s','/?page=listFaq');
	
	
	
	$docs = $db->getFaqIntern();
	$menu = array();
	foreach ($docs as $d)
	{
		$menu[] = array(
			'href' => '/?page=listFaq&id='.$d['id'],
			'name' => $d['name']
		);
	}
	
	addContent(v_menu($menu,'FAQ'));
}