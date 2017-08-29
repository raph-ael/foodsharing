<?php

$protocol = 'http';
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
{
    $protocol = 'https';
}
$http_host = 'localhost';
if(isset($_SERVER['HTTP_HOST'])) {
    $http_host = $_SERVER['HTTP_HOST'];
}

define('PROTOCOL',$protocol);
define('DB_HOST',  env('DB_HOST', '127.0.0.1'));
define('DB_USER',env('DB_USERNAME', 'forge'));
define('DB_PASS',env('DB_PASSWORD', ''));
define('DB_DB',env('DB_DATABASE', 'forge'));
define('PREFIX','fs_');
define('ERROR_REPORT',E_ALL);
define('BASE_URL', $protocol . '//'.$http_host.'/');
define('URL_INTERN',$protocol . '://'.$http_host.'/freiwillige/');
define('DEFAULT_EMAIL','noreply@lebensmittelretten.de');
define('DEFAULT_EMAIL_NAME','Foodsharing Freiwillige');
define('VERSION','0.8.1');
define('EMAIL_PUBLIC', 'info@lebensmittelretten.de');
define('EMAIL_PUBLIC_NAME','Foodsharing Freiwillige');
define('DEFAULT_HOST','lebensmittelretten.de');
define('MAPZEN_API_KEY', 'mapzen-RaXru7A');
define('GOOGLE_API_KEY', 'AIzaSyCkFfCoOnj8ZjGGcApHS1rX6Rt6OxrW6hQ');

define('SMTP_HOST','');
define('SMTP_USER','');
define('SMTP_PASS','');
define('SMTP_PORT',25);
define('MEM_ENABLED', false);

define('SOCK_URL', 'http://chat:1338/');
define('REDIS_HOST', 'redis');
define('REDIS_PORT', 6379);

if(!defined('ROOT_DIR'))
{
    define('ROOT_DIR','./');
}

define('HIDDEN_TMP_DIR', storage_path('tmp'));
define('PUBLIC_TMP_DIR', public_path('tmp'));
define('PUBLIC_IMAGES_DIR', public_path('images'));


if(!defined('SOCK_URL')) {
    define('SOCK_URL', 'http://127.0.0.1:1338/');
}

define('LOCALE', config('app.locale'));
define('LOCALES', config('translation-manager.locales'));
define('MD5_SALT', 'very-secret-characters12345');