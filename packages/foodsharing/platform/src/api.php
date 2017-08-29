<?php 
require_once 'config.inc.php';
require_once 'lib/func.inc.php';

require_once 'lib/db.class.php';
require_once 'lang/' . LOCALE . '/' . LOCALE .'.php';
require_once 'lib/Manual.class.php';

/** Checks the validity of an API token
	@param $fs Foodsaver ID
	@param $key API token
	@return True or False depending on validity
 */
function check_api_token($fs, $key)
{
	global $db;
	$res = $db->qOne('SELECT COUNT(foodsaver_id) FROM '.PREFIX.'apitoken WHERE foodsaver_id = '.(int)$fs.' AND token="'.$db->safe($key).'"');
	return ($res == 1);
}

function dateToCal($timestamp) {
	return gmdate('Ymd\THis\Z', $timestamp);
}
function dateToLocalCal($timestamp) {
	return date('Ymd\THis', $timestamp);
}
function escapeString($string) {
	$string = str_replace("\r\n", "\\n", $string);
	$string = str_replace("\n", "\\n", $string);
	return preg_replace('/([\,;])/','\\\$1', $string);
}

function generate_calendar_event($utc_begin, $utc_end, $utc_change, $uid, $location, $description, $summary, $uri)
{
	$out = "BEGIN:VEVENT\r\nDTEND:";
	$out .= dateToCal($utc_end)."\r\nUID:";
	$out .= $uid."\r\nDTSTAMP:";
	$out .= dateToCal($utc_change)."\r\nLOCATION:";
	$out .= escapeString($location)."\r\nDESCRIPTION:";
	$out .= escapeString($description)."\r\nURL;VALUE=URI:";
	$out .= escapeString($uri)."\r\nSUMMARY:";
	$out .= escapeString($summary)."\r\nDTSTART:";
	$out .= dateToCal($utc_begin)."\r\nEND:VEVENT\r\n";
	return $out;
}


function api_generate_calendar($fs, $options)
{
	global $db;
	/* from https://gist.github.com/jakebellacera/635416 */
	header('Content-type: text/calendar; charset=utf-8');
	header('Content-Disposition: attachment; filename=calendar.ics');
	echo "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nPRODID:-//Foodsharing.de//NONSGML v1.0//EN\r\nCALSCALE:GREGORIAN\r\n";
	if(strpos($options, 's') !== FALSE)
	{
		$fetches = $db->q('SELECT b.id, b.name, b.str, b.hsnr, b.plz, b.stadt, a.confirmed, UNIX_TIMESTAMP(a.`date`) AS date_ts FROM '.PREFIX.'abholer a INNER JOIN '.PREFIX.'betrieb b ON a.betrieb_id = b.id WHERE a.foodsaver_id = '.(int)$fs.' AND a.`date` > NOW() - INTERVAL 1 DAY');
		if(is_array($fetches))
		{
			foreach($fetches as $f)
			{
				$datestart = $f['date_ts'];
				$dateend = $f['date_ts'] + 30 * 60;
				$uid = $f['id'].$f['date_ts'].'@fetch.foodsharing.de';
				$address = $f['str'].' '.$f['hsnr'].', '.$f['plz'].' '.$f['stadt'];
				$summary = $f['name'].' Abholung';
				if(!$f['confirmed'])
				{
					$summary .= ' (unbestätigt)';
				}
				$description = 'Foodsharing Abholung bei '.$f['name'];
				$uri = BASE_URL.'/?page=fsbetrieb&id='.$f['id'];
				// 3. Echo out the ics file's contents
				echo generate_calendar_event($datestart, $dateend, time(), $uid, $address, $description, $summary, $uri);
			}
		}
	}

	if(strpos($options, 'e') !== FALSE)
	{
		$calendar = $db->q('
				SELECT
					e.id,
					e.name,
					e.`description`,
					UNIX_TIMESTAMP(e.`start`) AS start_ts,
					UNIX_TIMESTAMP(e.`end`) AS end_ts,
					e.online,
					fe.`status`,
					loc.name as loc_name,
					loc.street,
					loc.zip,
					loc.city
				FROM
					`'.PREFIX.'event` e
				INNER JOIN
					`'.PREFIX.'foodsaver_has_event` fe
				ON
					e.id = fe.event_id AND fe.foodsaver_id = '.(int)$fs.'
				LEFT JOIN
					`'.PREFIX.'location` loc
				ON
					loc.id = e.location_id
				WHERE
					e.start  > NOW() - INTERVAL 1 DAY
				AND
					((e.public = 1 AND (fe.`status` IS NULL OR fe.`status` <> 3))
					OR
						fe.`status` IN(1,2)
					)');
		if(is_array($calendar))
		{
			foreach($calendar as $c)
			{
				$datestart = $c['start_ts'];
				$dateend = $c['end_ts'];
				$uid = $c['id'].$c['start_ts'].'@event.foodsharing.de';
				if($c['online'])
				{
					$address = "Online, mumble.lebensmittelretten.de";
				} else
				{
					$address = $c['loc_name'].', '.$c['street'].' '.$c['zip'].', '.$c['city'];
				}
				$summary = $c['name'].' Event';
				if(!$c['status'] == 1)
				{
					$summary = '('.$summary.')';
				}
				$description = 'Foodsharing Event: '.$c['description'];
				$uri = BASE_URL.'/?page=event&id='.$c['id'];
				// 3. Echo out the ics file's contents
				echo generate_calendar_event($datestart, $dateend, time(), $uid, $address, $description, $summary, $uri);
			}
		}
	}
	
	echo "END:VCALENDAR\r\n";
}

$db = new ManualDb();

$action = $_GET['f'];
$fs = $_GET['fs'];
$key = $_GET['key'];
$opts = $_GET['opts'];

if(!check_api_token($fs, $key)) {
	http_response_code(403);
	echo "Invalid access token!";
}
else
{
	switch($action)
	{
	case 'cal':
		api_generate_calendar($fs, $opts);
		break;
	}
}
