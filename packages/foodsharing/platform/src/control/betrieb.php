<?php
$bezirk_id = getGet('bid');
if(!S::may()) {
  goLogin();
}

if(!isset($_GET['bid']))
{
	$bezirk_id = getBezirkId();
}
else
{
	$bezirk_id = (int)$_GET['bid'];
}

if(!isOrgaTeam() && $bezirk_id == 0)
{
	$bezirk_id = getBezirkId();
}
if($bezirk_id > 0)
{
	$bezirk = $db->getBezirk($bezirk_id);
}
else
{
	$bezirk = array('name'=>'kompletter Datenbank');
}
if(getAction('new'))
{	
	if(S::may('bieb'))
	{
		handle_add($bezirk_id);
	
		addBread(s('bread_betrieb'),'/?page='.$page);
		addBread(s('bread_new_betrieb'));
			
		addContent(betrieb_form($bezirk,$page));

	
	
		addContent(v_field(v_menu(array(
		array('name'=>s('back_to_overview'),'href'=>'/?page=fsbetrieb&bid='.$bezirk_id)
		)),s('actions')),CNT_RIGHT);
	}elseif(!S::may('bieb'))
	{
		fs_info('Zum Anlegen eines Betriebes musst Du Betriebsverantwortlicher sein');
		go('?page=settings&sub=upgrade/up_bip');
	}

}
elseif($id = getActionId('delete'))
{
	/*
	if($db->del_betrieb($id))
	{
		info(s('betrieb_deleted'));
		goPage();
	}
	*/
}
elseif($id = getActionId('edit'))
{
	addBread(s('bread_betrieb'),'/?page=betrieb');
	addBread(s('bread_edit_betrieb'));
	$data = $db->getOne_betrieb($id);
	
	addTitle($data['name']);
	addTitle(s('edit'));
	
	if((isOrgaTeam() || $db->isVerantwortlich($id)) || isBotFor($data['bezirk_id']))
	{
		handle_edit();
		
		setEditData($data);
		
		$bezirk = $db->getValues(array('id','name'),'bezirk',$data['bezirk_id']);
		
		addContent(betrieb_form($bezirk));
	}
	else
	{
		fs_info('Diesen Betrieb kannst Du nicht bearbeiten');
	}
	
			
	addContent(v_field(v_menu(array(
		pageLink('betrieb','back_to_overview')
	)),s('actions')),CNT_RIGHT);
}
else if(isset($_GET['id']))
{
	go('/?page=fsbetrieb&id='.(int)$_GET['id']);
}
else
{
	addBread(s('betrieb_bread'),'/?page=betrieb');
	

	if(S::may('bieb'))
	{
		addContent(v_menu(array(
				array('href' => '/?page=betrieb&a=new&bid='.(int)$bezirk_id,'name' => 'Neuen Betrieb eintragen')
		),'Aktionen'),CNT_RIGHT);
	}
	
	if($betriebe = $db->listBetriebReq($bezirk_id))
	{
		if(isset($_GET['v']) && $_GET['v'] == 'karte')
		{
			echo 'map';die();
			//addContent(v_field(v_multimap($betriebe),'Alle Betriebe aus '.$bezirk['name'].v_switch(array('Liste','Karte'))));
		}
		else
		{
			$betriebrows = array();
			foreach ($betriebe as $b)
			{
				$status = v_getStatusAmpel($b['betrieb_status_id']);
	
				$betriebrows[] = array(
						array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=betrieb&id='.$b['id'].'">'.$b['name'].'</a>'),
						array('cnt' => $b['str'].' '.$b['hsnr']),
						array('cnt' => ($b['added'])),
						array('cnt' => $b['bezirk_name']),
						array('cnt' => $status),
						array('cnt' => v_toolbar(array('id'=>$b['id'],'types' => array('comment','edit','delete'),'confirmMsg'=>'Soll '.$b['name'].' wirklich unwideruflich gel&ouml;scht werden?'))
									
				));
			}
	
			$table = v_tablesorter(array(
					array('name' => 'Name'),
					array('name' => 'Anschrift'),
					array('name' => 'eingetragen'),
					array('name' => s('bezirk')),
					array('name' => 'Status','width'=>50),
					array('name' => 'Aktionen','sort' => false,'width' => 75)
			),$betriebrows,array('pager'=>true));
	
			addJs('$("#comment").dialog({title:"Kommentar zum Betrieb"});');
	
			addContent(v_field($table,v_toolbar(array('types'=>array('new'))).'Alle Betriebe aus dem Bezirk '.$bezirk['name'].v_switch(array('Liste','Karte'))));
	
		}
	}
	else
	{
		fs_info('Es sind noch keine Betriebe eingetragen');
	}
	
	/*
	if($data = $db->getBasics_betrieb())
	{
		$rows = array();
		foreach ($data as $d)
		{
					
			$rows[] = array(
				array('cnt' => '<a href="/?page=betrieb&id='.$d['id'].'">'.$d['name'].'</a>'),
				array('cnt' => v_toolbar(array('id'=>$d['id'],'types' => array('edit','delete'),'confirmMsg'=>sv('delete_sure',$d['name'])))			
			));
		}
		
		$table = v_tablesorter(array(
			array('name' => s('name')),
			array('name' => s('actions'),'sort' => false,'width' => 50)
		),$rows);
		
		$content = v_field($table,'Alle betrieb');	
	}
	else
	{
		info(s('betrieb_empty'));		
	}
			
	$right = v_field(v_menu(array(
		array('href' => '/?page=betrieb&a=neu','name' => s('neu_betrieb'))
	)),'Aktionen');
	*/
}					
function betrieb_form($bezirk = false,$page = '')
{
	global $db;
	global $g_data;
	
	
	$bc = v_bezirkChooser('bezirk_id',$bezirk);
	
	
	$lebensmittel_values = $db->getBasics_lebensmittel();
	
	
	if(!isset($g_data['foodsaver']))
	{
		$g_data['foodsaver'] = array(fsId());
	}
	if(isset($_GET['id']))
	{
		$g_data['foodsaver'] = $db->getBetriebLeader($_GET['id']);
	}
	$verantwortlich_select = '';
	if(isOrgateam() || isBotschafter())
	{
		$foodsaver_values = $db->getBasics_foodsaver();
		$verantwortlich_select = v_form_checkbox('foodsaver',array('values' => $foodsaver_values));
	
	}
	else if(getAction('new'))
	{
		$verantwortlich_select = v_input_wrapper(s('foodsaver'), '<input type="hidden" name="foodsaver[]" value="'.fsId().'" />Du wirst durch die Eintragrung vorerst verantwortlich für Diesen Betrieb');
	}
	
	
	addJs('
		$(".cb-foodsaver").click(function(){
				if($(".cb-foodsaver:checked").length >= 4)
				{
					pulseError(\''.jsSafe(s('max_3_leader')).'\');
					return false;
				}
				
			});		
			
		$("#lat-wrapper").hide();
		$("#lon-wrapper").hide();
	');
	
	$first_post = '';
	if(getAction('new'))
	{
		$first_post = v_form_textarea('first_post',array('required'=>true));
	}
	if(isset($g_data['stadt']))
	{
		$g_data['ort'] = $g_data['stadt'];
	}
	$view = loadView();
	
	addJs('$("textarea").css("height","70px");$("textarea").autosize();');
	
	return v_quickform('betrieb',array(
	
			$bc,
			v_form_hidden('page', $page),
			v_form_text('name'),
			$view->latLonPicker('LatLng',array('hsnr'=>true)),
			
			
			v_form_select('kette_id',array('add'=>true,'values'=>db_get_kette(), 'desc' => 'Bitte nur inhabergeführte Betriebe selbstständig ansprechen, niemals Betriebe einer Kette anfragen!')),
			v_form_select('betrieb_kategorie_id',array('add'=>true,'values' => db_get_betrieb_kategorie())),
			
			v_form_select('betrieb_status_id',array('values' => db_get_betrieb_status())),
			
			v_form_text('ansprechpartner'),
			v_form_text('telefon'),
			v_form_text('fax'),
			v_form_text('email'),
			
			v_form_checkbox('lebensmittel',array('values' => $lebensmittel_values)),
			v_form_date('begin'),
			v_form_textarea('besonderheiten'),
			v_form_textarea('public_info',array('maxlength' => 180,'desc' => 'Hier kannst Du einige Infos für die Foodsaver angeben, die sich für das Team bewerben möchten. <br />(max. 180 Zeichen)<div>'.v_info('<strong>Wichtig</strong> Gib hier keine genauen Abholzeiten an.<br />Es ist öfters vorgekommen, dass Leute unabgesprochen zum Laden gegangen sind.').'</div>')),
			v_form_select('public_time',array('values'=>array(
					array('id'=>0,'name'=>'Keine Angabe'),
					array('id'=>1,'name'=>'morgens'),
					array('id'=>2,'name'=>'mittags/nachmittags'),
					array('id'=>3,'name'=>'abends'),
					array('id'=>4,'name'=>'nachts')
			))),
			$first_post,
			v_form_select('ueberzeugungsarbeit',array('values'=>array(
				array('id'=>1,'name'=>'Überhaupt kein Problem, er/sie war/en sofort begeistert!'),
				array('id'=>2,'name'=>'Nach einiger Überzeugungsarbeit erklärte er/sie sich bereit mitzumachen '),
				array('id'=>3,'name'=>'Ganz schwierig, aber am Ende hat er/sie eingewilligt'),
				array('id'=>4,'name'=>'Zuerst sah es so aus, als ob er/sie nicht mitmachen wollte, aber dann hat sie/er sich doch bei mir gemeldet')
			))),
			v_form_select('presse',array('values'=>array(
				array('id'=>1,'name'=> 'Ja'),
				array('id'=>0,'name'=> 'Nein')
			))),
			v_form_select('sticker',array('values'=>array(
				array('id'=>1,'name'=> 'Ja'),
				array('id'=>0,'name'=> 'Nein')
			))),
			v_form_select('prefetchtime',array('values'=>array(
				array('id'=>1209600,'name'=> '2 Wochen'),
				array('id'=>1814400,'name'=> '3 Wochen'),
				array('id'=>2419200,'name'=> '4 Wochen')
			))),
			v_form_select('abholmenge',array('values'=>array(
				array('id'=>1,'name'=> '1-3kg'),
				array('id'=>2,'name'=> '3-5kg'),
				array('id'=>3,'name'=> '5-10kg'),
				array('id'=>4,'name'=> '10-20kg'),
				array('id'=>5,'name'=> '20-30kg'),
				array('id'=>6,'name'=> '40-50kg'),
				array('id'=>7,'name'=> 'mehr als 50kg')
			))),
			
			$verantwortlich_select
	));
}

function handle_edit()
{
	global $db;
	global $g_data;
	if(submitted())
	{
		/*
		$g_data['lat'] = '';
		$g_data['lon'] = '';
		if($ll = getLatLon($g_data['str'].' '.$g_data['hsnr'], $g_data['plz'],$g_data['stadt']))
		{
			$g_data['lat'] = $ll['lat'];
			$g_data['lon'] = $ll['lng'];
		}
		*/
		//$g_data['foodsaver'] = array($g_data['foodsaver']);
		
		$g_data['stadt'] = $g_data['ort'];
		
		if($db->update_betrieb($_GET['id'],$g_data))
		{
			fs_info(s('betrieb_edit_success'));
			go('/?page=fsbetrieb&id='.(int)$_GET['id']);
		}
		else
		{
			error(s('error'));
		}
	}
}

function handle_add($bezirk_id)
{
	global $db;
	global $g_data;
	if(submitted())
	{
		
		$g_data['status_date'] = date('Y-m-d H:i:s');
		
		if(!isset($g_data['bezirk_id']))
		{
			$g_data['bezirk_id'] = getBezirkId();
		}
		
		$g_data['stadt'] = $g_data['ort'];
		
		if($id = $db->add_betrieb($g_data))
		{
			$db->add_betrieb_notiz(array(
					'foodsaver_id' =>fsId(),
					'betrieb_id' => $id,
					'text' => '{BETRIEB_ADDED}',
					'zeit' => date('Y-m-d H:i:s',(time()-10)),
					'milestone' => 1
			));
			
			if(isset($g_data['first_post']) && !empty($g_data['first_post']))
			{
				$db->add_betrieb_notiz(array(
						'foodsaver_id' =>fsId(),
						'betrieb_id' => $id,
						'text' => $g_data['first_post'],
						'zeit' => date('Y-m-d H:i:s'),
						'milestone' => 0
				));
			}
			
			$foodsaver = $db->getFoodsaver($g_data['bezirk_id']);
			
			$model = loadModel('betrieb');
			$model->addBell($foodsaver, 'store_new_title', 'store_new', 'img img-store brown', array(
				'href' => '/?page=fsbetrieb&id='.(int)$id
			), array(
				'user' => S::user('name'),
				'name' => $g_data['name']
			), 'store-new-'.(int)$id);
			
			fs_info(s('betrieb_add_success'));
			
			go('/?page=fsbetrieb&id='.(int)$id);
			
			
		}
		else
		{
			error(s('error'));
		}
	}
}

function db_get_kette()
{
	global $db;
	$out = $db->q('
			SELECT
			`id`,
			`name`,
			`logo`
			
			FROM 		`'.PREFIX.'kette`
			ORDER BY `name`');

	return $out;
}
function db_get_betrieb_kategorie()
{
	global $db;
	$out = $db->q('
			SELECT
			`id`,
			`name`
			
			FROM 		`'.PREFIX.'betrieb_kategorie`
			ORDER BY `name`');

	return $out;
}
function db_get_betrieb_status()
{
	global $db;
	$out = $db->q('
			SELECT
			`id`,
			`name`
			
			FROM 		`'.PREFIX.'betrieb_status`
			ORDER BY `name`');

	return $out;
}
?>
