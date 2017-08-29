<?php

$protocol = 'http';
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
{
	$protocol = 'https';
}

define('PROTOCOL',$protocol);
define('DB_HOST','db');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_DB','foodsharing');
define('PREFIX','fs_');
define('ERROR_REPORT',E_ALL);
define('BASE_URL', $protocol . '//lmr.local/');
define('URL_INTERN',$protocol . '://lmr.local/freiwillige/');
define('DEFAULT_EMAIL','noreply@lebensmittelretten.de');
define('DEFAULT_EMAIL_NAME','Foodsharing Freiwillige');
define('VERSION','0.8.1');
define('EMAIL_PUBLIC', 'info@lebensmittelretten.de');
define('EMAIL_PUBLIC_NAME','Foodsharing Freiwillige');
define('DEFAULT_HOST','lebensmittelretten.de');
define('MAPZEN_API_KEY', 'mapzen-RaXru7A');
define('GOOGLE_API_KEY', '');

define('SMTP_HOST','');
define('SMTP_USER','');
define('SMTP_PASS','');
define('SMTP_PORT',25);
define('MEM_ENABLED', true);

define('REDIS_HOST', 'redis');
define('REDIS_PORT', 6379);

if(!defined('ROOT_DIR'))
{
	define('ROOT_DIR','./');
}
