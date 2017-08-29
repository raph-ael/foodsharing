<?php 
if(!S::may('orga'))
{
	go('/');
}

handleEmail();
addBread(s('mailinglist'),'/?page=email');
$bezirk = $db->getBezirk();

if($emailstosend = $db->getEmailsToSend())
{
	addContent(v_email_statusbox($emailstosend));
}

$recip = '';
$mode = '';
if(isOrgaTeam())
{
	$recip = v_form_recip_chooser();
	$mode = v_form_select('mode',array('required'=>true,'values'=>array(
			array('id'=>1,'name'=>s('send_as_pm')),
			array('id'=>2,'name'=>s('send_as_email'))
	)));
}
elseif(isBotschafter())
{
	$recip = v_form_recip_chooser_mini();
}
global $g_data;
if(!isset($g_data['message']))
{
	$g_data['message'] = '<p><strong>{ANREDE} {NAME}</strong><br /><br /><br />';
}

$mbmodel = loadModel('mailbox');

$boxes = $mbmodel->getBoxes();
foreach ($boxes as $key => $b)
{
	$boxes[$key]['name'] = $b['name'].'@'.DEFAULT_HOST;
}
addContent(v_form('Nachrichten Verteiler', array(
		v_field(
				$recip.$mode.
				v_form_select('mailbox_id',array('values'=>$boxes,'required' => true)).
				v_form_text('subject',array('required' => true)).
				v_form_file('attachement'),
					
				s('mailing_list'),
				array('class'=>'ui-padding')
		),
		v_field(v_form_tinymce('message',array('nowrapper'=>true,'type'=>'email','filemanager' => true)), s('message'))
),array('submit'=>'Zum Senden Vorbereiten')));

addStyle('#testemail{width:91%;}');

$g_data['testemail'] = $db->getVal('email', 'foodsaver', fsId());

addContent(v_field(v_form_text('testemail').v_input_wrapper('', '<a class="button" href="#" onclick="ajreq(\'testmail\',{email:$(\'#testemail\').val(),subject:$(\'#subject\').val(),message:$(\'#message\').tinymce().getContent()},\'post\');return false;">Test-Mail senden</a>'), 'Newsletter Testen',array('class'=>'ui-padding')),CNT_RIGHT);

global $g_data;

addJs("$('#rightmenu').menu();");
addContent(v_field('<div class="ui-padding">'.s('personal_styling_desc').'</div>', s('personal_styling')),CNT_RIGHT);

addContent('
<div id="dialog-confirm" title="E-Mail senden?" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>'.s('shure').'</p>
</div>
<h3 class="head ui-widget-header ui-corner-top">von Dir gesendete Mails</h3>
<div class="ui-widget ui-widget-content ui-corner-bottom margin-bottom">
<ul id="rightmenu">',CNT_RIGHT);

$i=0;
$divs = '';
if($mails = $db->getSendMails())
{
	foreach ($mails as $m)
	{
		$i++;
		addContent('
		<li><a href="#" onclick="$(\'#right-'.$i.'\').dialog(\'open\');return false;">'.date('d.m.',strtotime($m['zeit'])).' '.$m['name'].'</a></li>',CNT_RIGHT);
		
		$divs .= '
		<div id="right-'.$i.'" style="display:none;">
			'.nl2br($m['message']).'
		</div>';
		
		$js .= '
		$("#right-'.$i.'").dialog({autoOpen:false,title:"'.jsSafe($m['name'],'"').'",modal:true});';
	}
}
addContent('
</ul>
</div>
'.$divs,CNT_RIGHT);

function handleEmail()
{
	global $db;
	if(submitted())
	{
		$betreff = getPost('subject');
		$nachricht = getPost('message');
		$mailbox_id = getPost('mailbox_id');
		
		$nachricht = handleImages($nachricht);
		
		$data = getPostData();
		
		$foodsaver = array();
		
		if(isBotschafter() || isOrgaTeam())
		{
			if($data['recip_choose'] == 'bezirk')
			{
				$foodsaver = $db->getEmailAdressen();
			}
			else if($data['recip_choose'] == 'botschafter')
			{
				$foodsaver = $db->getAllBotschafter();
			}
			else if($data['recip_choose'] == 'orgateam')
			{
				$foodsaver = $db->getOrgateam();
			}
			
		}
		if(isOrgaTeam())
		{
			if($data['recip_choose'] == 'all')
			{
				$foodsaver = $db->getAllEmailFoodsaver();
			}
			else if($data['recip_choose'] == 'newsletter')
			{
				$foodsaver = $db->getAllEmailFoodsaver(true);
			}
			else if($data['recip_choose'] == 'newsletter_all')
			{
				$foodsaver = $db->getAllEmailFoodsaver(true, false);
			}
			else if($data['recip_choose'] == 'newsletter_only_foodsharer')
			{
				$foodsaver = $db->q('
					SELECT 	`id`,`email`
					FROM `'.PREFIX.'foodsaver`
					WHERE newsletter = 1 AND rolle = 0		
				');
			}
			elseif($data['recip_choose'] == 'all_no_botschafter')
			{
				$foodsaver = $db->getAllFoodsaverNoBotschafter();
			}
			elseif ($data['recip_choose'] == 'filialverantwortlich')
			{
				$foodsaver = $db->getAllFilialverantwortlich();
			}
			elseif ($data['recip_choose'] == 'noquizfinishall')
			{
				$foodsaver = $db->q('
					SELECT DISTINCT fs.id,
							fs.email,
							fs.name,
							qs.status

					FROM 	fs_foodsaver fs
						
					LEFT JOIN
							fs_quiz_session qs
						
					ON 
						fs.id = qs.foodsaver_id
						
					WHERE fs.rolle > 0 AND qs.status IS NULL	
				');
			}
			else if($data['recip_choose'] == 'allfs14dayslogin')
			{
				$foodsaver = $db->q('
						SELECT 
							fs.id,
							fs.email,
							fs.name
						
						FROM 
							fs_foodsaver fs
						
						WHERE 
							rolle > 0
						
						AND 
							to_days(fs.last_login) >= (to_days(now())-14) 
						
				');
			}
			elseif ($data['recip_choose'] == 'noquizfinishall14')
			{
				$foodsaver = $db->q('
					SELECT DISTINCT fs.id,
							fs.email,
							fs.name,
							fs.last_login,
							qs.status
			
					FROM 	fs_foodsaver fs
			
					LEFT JOIN
							fs_quiz_session qs
			
					ON
						fs.id = qs.foodsaver_id
			
					WHERE fs.rolle > 0 AND qs.status IS NULL
						
					AND to_days(fs.last_login) >= (to_days(now())-14) 
				');
			}
			elseif ($data['recip_choose'] == 'noquizfinishbip')
			{
				$foodsaver = $db->q('
					SELECT DISTINCT fs.id, fs.email, fs.name, qs.status
					FROM fs_betrieb_team t
					LEFT JOIN fs_foodsaver fs ON fs.id = t.foodsaver_id
					LEFT JOIN fs_quiz_session qs ON fs.id = qs.foodsaver_id
					WHERE t.verantwortlich = 1
					AND qs.status IS NULL
				');
			}
			elseif($data['recip_choose'] == 'quizfinishallfs')
			{
				$foodsaver = $db->q('
					SELECT id, email, name

					FROM fs_foodsaver 
						
					WHERE quiz_rolle = 1
				');
			}
			elseif ($data['recip_choose'] == 'noquizfinishfs')
			{
				$foodsaver = $db->q('
					SELECT DISTINCT fs.id,
							fs.email,
							fs.name,
							qs.status
		
					FROM 	fs_foodsaver fs
		
					LEFT JOIN
							fs_quiz_session qs
		
					ON
						fs.id = qs.foodsaver_id
		
					WHERE fs.rolle = 1 AND qs.status IS NULL
				');
			}
			elseif ($data['recip_choose'] == 'noquizfinishbot')
			{
				$foodsaver = $db->q('
					SELECT DISTINCT fs.id,
							fs.email,
							fs.name,
							qs.status
			
					FROM 	fs_foodsaver fs
			
					LEFT JOIN
							fs_quiz_session qs
			
					ON
						fs.id = qs.foodsaver_id
			
					WHERE fs.rolle = 3 AND qs.status IS NULL
				');
			}
			elseif ($data['recip_choose'] == 'allberlin')
			{
				$cbs = $db->getChildBezirke(47);
				
				$plzs = array( 	"10115", "10117", "10119", "10178", "10179", "10243", "10245", "10247", "10249", "10315", "10317", "10318", "10319", "10365", "10367", "10369", "10405", "10407", "10409", "10435", "10437", "10439", "10551", "10553", "10555", "10557", "10559", "10585", "10587", "10589", "10623", "10625", "10627", "10629", "10707", "10709", "10711", "10713", "10715", "10717", "10719", "10777", "10779", "10781", "10783", "10785", "10787", "10789", "10823", "10825", "10827", "10829", "10961", "10963", "10965", "10967", "10969", "10997", "10999", "12043", "12045", "12047", "12049", "12051", "12053", "12055", "12057", "12059", "12099", "12101", "12103", "12105", "12107", "12109", "12157", "12159", "12161", "12163", "12165", "12167", "12169", "12203", "12205", "12207", "12209", "12247", "12249", "12277", "12279", "12305", "12307", "12309", "12347", "12349", "12351", "12353", "12355", "12357", "12359", "12435", "12437", "12439", "12459", "12487", "12489", "12524", "12526", "12527", "12529", "12555", "12557", "12559", "12587", "12589", "12619", "12621", "12623", "12627", "12629", "12679", "12681", "12683", "12685", "12687", "12689", "13051", "13053", "13055", "13057", "13059", "13086", "13088", "13089", "13125", "13127", "13129", "13156", "13158", "13159", "13187", "13189", "13347", "13349", "13351", "13353", "13355", "13357", "13359", "13403", "13405", "13407", "13409", "13435", "13437", "13439", "13465", "13467", "13469", "13503", "13505", "13507", "13509", "13581", "13583", "13585", "13587", "13589", "13591", "13593", "13595", "13597", "13599", "13627", "13629", "14050", "14052", "14053", "14055", "14057", "14059", "14089", "14109", "14129", "14163", "14165", "14167", "14169", "14193", "14195", "14197", "14199");
				
				$sql = '
					SELECT 
						DISTINCT fs.id,
						fs.name,
						fs.nachname,
						fs.geschlecht,
						fs.email

					FROM 
						'.PREFIX.'foodsaver fs,
						'.PREFIX.'foodsaver_has_bezirk hb
						
					WHERE 
						fs.id = hb.foodsaver_id						
								
					AND
					(
						hb.bezirk_id IN('.implode(',',$cbs).') 
						
						OR 
							stadt LIKE "%Berlin%"
							
						OR
							plz IN("'.implode('","',$plzs).'")
					)
				';
				
				$foodsaver = $db->q($sql);
			}
			elseif ($data['recip_choose'] == 'dropquiz01')
			{
				$foodsaver = $db->q('
					SELECT id, email, name
					FROM fs_foodsaver
					WHERE quiz_rolle =0
					AND rolle >0		
				');
			}
			elseif ($data['recip_choose'] == 'dropquizbackup01')
			{
				$foodsaver = $db->q('
					SELECT id, email, name
					FROM fs_foodsaver
					WHERE rolle > 0
					AND quiz_rolle = 0
				');
			}
			elseif ($data['recip_choose'] == 'allnotberlin')
			{
				$foodsaver = $db->getAllEmailFoodsaver(true);
				$cbs = $db->getChildBezirke(47);
				
				$plzs = array( 	"10115", "10117", "10119", "10178", "10179", "10243", "10245", "10247", "10249", "10315", "10317", "10318", "10319", "10365", "10367", "10369", "10405", "10407", "10409", "10435", "10437", "10439", "10551", "10553", "10555", "10557", "10559", "10585", "10587", "10589", "10623", "10625", "10627", "10629", "10707", "10709", "10711", "10713", "10715", "10717", "10719", "10777", "10779", "10781", "10783", "10785", "10787", "10789", "10823", "10825", "10827", "10829", "10961", "10963", "10965", "10967", "10969", "10997", "10999", "12043", "12045", "12047", "12049", "12051", "12053", "12055", "12057", "12059", "12099", "12101", "12103", "12105", "12107", "12109", "12157", "12159", "12161", "12163", "12165", "12167", "12169", "12203", "12205", "12207", "12209", "12247", "12249", "12277", "12279", "12305", "12307", "12309", "12347", "12349", "12351", "12353", "12355", "12357", "12359", "12435", "12437", "12439", "12459", "12487", "12489", "12524", "12526", "12527", "12529", "12555", "12557", "12559", "12587", "12589", "12619", "12621", "12623", "12627", "12629", "12679", "12681", "12683", "12685", "12687", "12689", "13051", "13053", "13055", "13057", "13059", "13086", "13088", "13089", "13125", "13127", "13129", "13156", "13158", "13159", "13187", "13189", "13347", "13349", "13351", "13353", "13355", "13357", "13359", "13403", "13405", "13407", "13409", "13435", "13437", "13439", "13465", "13467", "13469", "13503", "13505", "13507", "13509", "13581", "13583", "13585", "13587", "13589", "13591", "13593", "13595", "13597", "13599", "13627", "13629", "14050", "14052", "14053", "14055", "14057", "14059", "14089", "14109", "14129", "14163", "14165", "14167", "14169", "14193", "14195", "14197", "14199");
				
				$sql = '
					SELECT
						DISTINCT fs.id
				
					FROM
						'.PREFIX.'foodsaver fs,
						'.PREFIX.'foodsaver_has_bezirk hb
				
					WHERE
						fs.id = hb.foodsaver_id
				
					AND
					(
						hb.bezirk_id IN('.implode(',',$cbs).')
				
						OR
							stadt LIKE "%Berlin%"
				
						OR
							plz IN("'.implode('","',$plzs).'")
					)
				';
				
				if($nots = $db->qColKey($sql))
				{
					
					$tmp = array();
					foreach ($foodsaver as $fs)
					{
						if(!isset($nots[$fs['id']]))
						{
							$tmp[] = $fs;
						}
					}
					
					$foodsaver = $tmp;
				}
			}
			elseif ($data['recip_choose'] == 'filialbot')
			{
				$foodsaver1 = $db->getAllFilialverantwortlich();
				$foodsaver2 = $db->getAllBotschafter();
				$tmp = array_merge($foodsaver1,$foodsaver2);
				$foodsaver = array();
				foreach ($tmp as $t)
				{
					$foodsaver[$t['id']] = $t;
				}
			}
			elseif($data['recip_choose'] == 'manual')
			{
				$foodsaver = $data['recip_choosemanual'];
				str_replace(array("\r"), '', $foodsaver);
				$foodsaver = explode("\n",$foodsaver);
				
				$bezirk = getBezirk();
				
				$count = 0;
				foreach ($foodsaver as $i => $fs)
				{
					$arr = explode(';', $fs);
					
					foreach ($arr as $y => $a)
					{
						$arr[$y] = trim($a);
					}
					
					$name = '';
					$email = $arr[0];
					
					if(isset($arr[1]))
					{
						$name = $arr[1];
					}
					
					if(validEmail($email))
					{
						libmail($bezirk, $email, $betreff, str_replace('{NAME}', $name, $nachricht));
						$count++;
					}
					else
					{
						unset($foodsaver[$i]);
					}
				}
				
				fs_info('Die E-Mail wurde erfolgreich an '.$count.' E-Mail-Adressen gesendet');
				
				$foodsaver = array();
			}
			else if ($data['recip_choose'] == 'filialbez')
			{
				$foodsaver = $db->getEmailBiepBez($data['recip_choose-choose']);
			}
			else if(isset($data['recip_choose-choose']))
			{
				if($data['recip_choose'] == 'choosebot')
				{
					$foodsaver = $db->getEmailBotFromBezirkList($data['recip_choose-choose']);
				}
				else
				{
					$foodsaver = $db->getEmailFoodSaverFromBezirkList($data['recip_choose-choose']);
				}
			}
		}
		else
		{
			$foodsaver = $db->getEmailAdressen();
		}
		
		if(!empty($foodsaver))
		{
			$attach = handleAttach('attachement');
		
			$out = array();
			foreach ($foodsaver as $fs)
			{
				$out[$fs['id']] = $fs;
			}
			$foodsaver = array();
			foreach ($out as $o)
			{
				$foodsaver[] = $o;
			}
			/*
			 * Array
			(
			    [form_submit] => nachrichtenverteiler
			    [recip_choose] => bezirk
			    [mode] => 1
			    [subject] => asdasdasd
			    [message] => <p>asdasdafds</p>
			)

			 */
			$db->initEmail($mailbox_id,$foodsaver,$nachricht, $betreff,$attach,$data['mode']);
			goPage();
		}
		elseif($data['recip_choose'] != 'manual')
		{
			error('In den ausgew&auml;hlten Bezirken gibt es noch keine Foodsaver');
		}
	}
}

function v_email_statusbox($mail)
{
	global $db;
	$out = '';

	/*
	 *  [0] => Array
	(
			[id] => 4
			[name] => asdas
			[message] => <p>asdasf</p>
			[zeit] => 2013-09-03 22:12:59
			[anz] => 1
	)
	*/
	$recip = $db->qCol('
		SELECT 	CONCAT(fs.name," ",fs.nachname)
		FROM 	`'.PREFIX.'email_status` e,
				`'.PREFIX.'foodsaver` fs
		WHERE 	e.foodsaver_id = fs.id
		AND 	e.email_id = '.$mail['id'].'
	');

	$id = id('mailtosend');

	addJs('
		$("#'.$id.'-link").fancybox({
			minWidth : 600,
			scrolling :"auto",
			closeClick : false,
			helpers : {
			  overlay : {closeClick: false}
			}
		});

		$("#'.$id.'-link").trigger("click");

		$("#'.$id.'-continue").button().click(function(){

			'.$id.'_continue_xhr();
			return false;
		});
					
		$("#'.$id.'-abort").button().click(function(){
			showLoader();
			$.ajax({
				url:"xhr/?f=abortEmail",
				data:{id:'.(int)$mail['id'].'},
				complete:function(){hideLoader();closeBox();}
			});
		});
					

	');

	addJsFunc('
	function '.$id.'_continue_xhr()
	{
			showLoader();
			$.ajax({
					dataType:"json",
					url:"xhr/?f=continueMail&id='.(int)$mail['id'].'",
					success : function(data){
						$("#'.$id.'-continue").hide();
						if(data.status == 1)
						{
							$("#'.$id.'-comment").html(data.comment);
							$("#'.$id.'-left").html(data.left);
							'.$id.'_continue_xhr();
						}
						else if(data.status == 2)
						{
							$("#'.$id.'-comment").html(data.comment);
							hideLoader();
						}
						else
						{
							alert("Du hast nich nie nötigen Rechte E-Mails zu versenden");
						}
					}
			});
		}');

	$style = '';
	if(count($recip) > 50)
	{
		$style = ' style="height:100px;overflow:auto;font-size:10px;background-color:#fff;color:#333;padding:5px;"';
	}

	addHidden('
			<a id="'.$id.'-link" href="#'.$id.'">&nbsp;</a>
			<div class="popbox" id="'.$id.'">
				<h3>E-Mail senden</h3>
				<p class="subtitle">Es sind noch <span id="'.$id.'-left">'.$mail['anz'].'</span> E-Mails zu versenden</p>

				<div id="'.$id.'-comment">
					'.v_input_wrapper('Empfänger', '<div'.$style.'>'.implode(', ', $recip).'</div>').'
					'.v_input_wrapper(s('subject'), $mail['name']).'
					'.v_input_wrapper(s('message'), nl2br($mail['message'])).'
				
				</div>
				<a id="'.$id.'-continue" href="#">Mit dem Senden weitermachen</a> <a id="'.$id.'-abort" href="#">Senden Abbrechen</a>
			</div>');

	return $out;
}

function handleImages($body)
{
	if(strpos($body,'<') === false)
	{
		return $body;
	}

	$doc = new DOMDocument();
	$doc->loadHTML($body);
	$tags = $doc->getElementsByTagName('img');

	try
	{
		foreach($tags as $tag)
		{
			$src = $tag->getAttribute('src');
			$wwith = $tag->getAttribute('width');
			$hheight = $tag->getAttribute('height');
			$iname = $tag->getAttribute('name');

			if(!empty($wwith) || !empty($hheight))
			{
				$old_filepath = '';

				$file = explode('/', $src);
				$filename = end($file);

				if(strpos($src,'images/upload/') !== false)
				{
					$old_filepath = explode('images/upload', $src);
					$old_filepath = end($old_filepath);
				}
				elseif(!empty($iname) && strpos($iname,'/') !== false)
				{
					$old_filepath = $iname;
				}

				$file = 'images/upload'.$old_filepath;

				if(file_exists($file) && !is_dir($file))
				{
						
					$ffile = explode('/', $old_filepath);
					$filename = end($ffile);
						
					$new_path = 'images/newsletter/';
					$new_filename = $filename;
					$y = 1;
						
					while (file_exists($new_path.$new_filename))
					{
						$new_filename = $y.'-'.$filename;
						$y++;
					}
					copy($file, $new_path.$new_filename);
					$fimage = new fImage($new_path.$new_filename);
					if(!empty($src) && $width = $tag->getAttribute('width'))
					{
						$fimage->resize($width, 0);
					}
					else if(!empty($src) && $height = $tag->getAttribute('height'))
					{
						$fimage->resize(0, $height);
					}
					$fimage->saveChanges();
					$tag->setAttribute('src', BASE_URL.'/'.$new_path.$new_filename);
					$tag->setAttribute('name', $old_filepath);
					$tag->removeAttribute('width');
					$tag->removeAttribute('height');
				}
			}
			elseif (substr($src, 0,7) != 'http://' && substr($src, 0,8) != 'https://')
			{
				$tag->setAttribute('src',BASE_URL.'/'.$src);
			}
		}

		$html = $doc->saveHTML();
		$html = explode('<body>', $html);
		$html = end($html);
		$html = explode('</body>', $html);
		$html = $html[0];
		return $html;
	}
	catch(Exception $e)
	{
		if(isAdmin())
		{
			echo($e->getMessage());
			die();
		}

		return $body;
	}
}
?>
