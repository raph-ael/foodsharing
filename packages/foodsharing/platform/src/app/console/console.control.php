<?php

function __autoload($class_name)
{
	$first = substr($class_name,0,1);

	$folder = 'flourish';

	switch ($first)
	{
		case 'f' : $folder = 'flourish'; break;
		case 'v' : $folder = 'views'; break;
	}

	$file = ROOT_DIR . 'lib/' . $folder . '/' . $class_name . '.php';

	if (file_exists($file))
	{
		include $file;
		return;
	}
	else
	{
		error('file not loadable: '.$file);
	}
}

class ConsoleControl
{	
	public function __construct()
	{
		
	}
	
	public function progressbar($count)
	{
		return new Console_ProgressBar('[%bar%] %percent% ETA:%estimate%', '=>', '-', 80, $count);
	}
	
	public function calcDuration($start_ts,$current_item,$total_count)
	{
		$duration = (time() - $start_ts);
		$duration_one = ($duration/$current_item);
		$time_left = $duration_one * ($total_count - $current_item);
		
		return 'duration: '.$this->secs_to_h($duration).' time left: ' . $this->secs_to_h($time_left);
	}
	
	public function secs_to_h($secs)
	{
        $units = array(
                "week"   => 7*24*3600,
                "day"    =>   24*3600,
                "hour"   =>      3600,
                "minute" =>        60,
                "second" =>         1,
        );

	// specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
                if ( $quot = intval($secs / $divisor) ) {
                        $s .= "$quot $name";
                        $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                        $secs -= $quot * $divisor;
                }
        }

        return substr($s, 0, -2);
	}
	
	public function tplMail($tpl_id,$to,$var = array())
	{
		global $db;
		if(!is_object($db))
		{
			$db = new ManualDb();
		}
	
		if($message = $db->getOne_message_tpl($tpl_id))
		{
			$search = array();
			$replace = array();
	
			foreach ($var as $key => $v)
			{
				$search[] = '{'.strtoupper($key).'}';
				$replace[] = $v;
			}
	
			$message['body'] = str_replace($search, $replace, $message['body']);
	
			$message['subject'] = str_replace($search, $replace, $message['subject']);
	
			$email = new AsyncMail();
			$email->setFrom(DEFAULT_EMAIL,DEFAULT_EMAIL_NAME);
			$email->addRecipient($to);
			$email->setSubject($message['subject']);
			$email->setHTMLBody(emailBodyTpl($message['body']));
			$email->setBody($message['body']);
	
			$email->send();
		}
	}
}

function validEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function s($id)
{
	global $g_lang;

	if(isset($g_lang[$id])) return $g_lang[$id];
	else return $id;
}

function rolleWrapInt($roleInt)
{
	$roles = array(
		0 => 'user',
		1 => 'fs',
		2 => 'bieb',
		3 => 'bot',
		4 => 'orga',
		5 => 'admin'
	);

	return $roles[$roleInt];
}

function rolleWrap($roleStr)
{
	$roles = array(
		'user' => 0,
		'fs' => 1,
		'bieb' => 2,
		'bot' => 3,
		'orga' => 4,
		'admin' => 5
	);

	return $roles[$roleStr];
}

function loadModel($model = 'api')
{
	require_once ROOT_DIR.'app/core/core.model.php';
	require_once ROOT_DIR.'app/'.$model.'/'.$model.'.model.php';
	$mod = ucfirst($model).'Model';
	return new $mod();
}

function loadApp($app)
{
	$app = strtolower($app);

	if(file_exists(ROOT_DIR . 'app/console/'.$app.'/'.$app.'.control.php') && file_exists(ROOT_DIR . 'app/console/'.$app.'/'.$app.'.model.php'))
	{
		require_once ROOT_DIR . 'app/console/'.$app.'/'.$app.'.control.php';
		require_once ROOT_DIR . 'app/console/'.$app.'/'.$app.'.model.php';

		$mod = ucfirst($app).'Control';

		return new $mod();
	}

	return false;
}

function error($msg)
{
	if(QUIET)
	{
		return false;
	}
	echo "\033[31m".cliTime()." [ERROR]\t" . $msg." \033[0m\n";
}

function info($msg)
{
	if(QUIET)
	{
		return false;
	}
	//echo "\033[37m[INFO]\t" . $msg." \033[0m\n";
	echo "".cliTime()." [INFO]\t" . $msg . "\n";
}

function success($msg)
{
	if(QUIET)
	{
		return false;
	}
	echo "\033[32m".cliTime()." [INFO]\t" . $msg." \033[0m\n";
}

function cliTime()
{
	return date('Y-m-d H:i:s');
}

function qs($str)
{
	return $str;
}

function autolink($str, $attributes=array()) {
	$attributes['target'] = '_blank';
	$attrs = '';
	foreach ($attributes as $attribute => $value) {
		$attrs .= " {$attribute}=\"{$value}\"";
	}
	$str = ' ' . $str;
	$str = preg_replace(
			'`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
			'$1<a href="$2"'.$attrs.'>$2</a>',
			$str
	);
	$str = substr($str, 1);
	$str = preg_replace('`href=\"www`','href="http://www',$str);
	// fügt http:// hinzu, wenn nicht vorhanden
	return $str;
}

function emailBodyTpl($message, $email = false, $token = false)
{

	$unsubscribe = '
	<tr>
		<td height="20" valign="top" style="background-color:#FAF7E5">
			<div style="text-align:center;padding-top:10px;font-size:11px;font-family:Arial;padding:15px;color:#594129;">
				Willst Du Keine Nachrichten mehr bekommen? Du kannst Deinen unter <a style="color:#F36933" href="'.BASE_URL.'/?page=settings&sub=info" target="_blank">Deinen Einstellungen</a> einstellen, welche Mails Du bekommst.
			</div>
		</td>
	</tr>';

	if($email !== false && $token !== false)
	{
		$unsubscribe = '
		<tr>
			<td height="20" valign="top" style="background-color:#FAF7E5">
				<div style="text-align:center;padding-top:10px;font-size:11px;font-family:Arial;padding:15px;color:#594129;">
					Möchtest Du keinen Newsletter mehr erhalten? <a style="color:#F36933" href="http://www.lebensmittelretten.de/unsubscribe/'.$token.'-'.$email.'" target="_blank">Klicke hier zum Abbestellen.</a> Du kannst Deinen unter <a style="color:#F36933" href="http://www.lebensmittelretten.de/freiwillige/?page=settings&sub=info" target="_blank">Deinen Einstellungen</a> einstellen, welche Mails Du bekommst.
				</div>
			</td>
		</tr>';
	}

	$message = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $message);

	$search = array('<a','<td','<li');
	$replace = array('<a style="color:#F36933"','<td style="font-size:13px;font-family:Arial;color:#31210C;"','<li style="margin-bottom:11px"');

	return '<html><head><style type="text/css">a{text-decoration:none;}a:hover{text-decoration:underline;}a.button{display:inline-block;padding:6px 16px;border:1px solid #FFFFFF;background-color:#4A3520;color:#FFFFFF !important;font-weight:bold;border-radius:8px;}a.button:hover{border:1px solid #4A3520;background-color:#ffffff;color:#4A3520 !important;text-decoration:none !important;}.border{padding:10px;border-top:1px solid #4A3520;border-bottom:1px solid #4A3520;background-color:#FFFFFF;}</style></head>
	<body style="margin:0;padding:0;">
		<div style="background-color:#F1E7C9;border:1px solid #628043;border-top:0px;padding:2%;padding-top:0;margin-top:0px;">

<table width="100%" style="margin-bottom:10px;margin-top:-2px;">
<tr>
				<td valign="top" height="30" style="background-color:#4A3520">
					<div style="padding:5px;font-size:13px;font-family:Arial;color:#FAF7E5;overflow:hidden;" align="left">
						<a style="display:block;color:#FAF7E5;text-decoration:none;" href="http://www.lebensmittelretten.de/" target="_blank">
							<span style="margin-left:10px;font-size:20px;font-family:Arial Black, Arial;font-weight:bold;color:#FAF7E5;letter-spacing:-1px;">food</span><span style="margin-right:10px;font-size:20px;font-family:Arial Black, Arial;font-weight:bold;color:#4D971E;letter-spacing:-1px">sharing</span> <span style="font-style:italic">Lebensmittelretten<span style="color:#F36933">.</span>de</span>
						</a>
					</div>
				</td></tr>
</table>
			<table height="100%" width="100%">
				<tr>
				<td valign="top" style="background-color:#FAF7E5">
					<div style="padding:5px;font-size:13px;font-family:Arial;padding:15px;color:#31210C;">
						'.str_replace($search,$replace,$message).'
					</div>
				</td>
				</tr>
				'.$unsubscribe.'
			</table>
		</div>
	</body>
</html>';
}
