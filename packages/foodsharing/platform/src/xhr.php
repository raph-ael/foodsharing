<?php 
require_once 'config.inc.php';
require_once 'lib/Session.php';
require_once 'lib/func.inc.php';

//session_init();
S::init();

require_once 'lib/db.class.php';
require_once 'lib/Caching.php';
require_once 'lang/' . LOCALE . '/' . LOCALE . '.php';
require_once 'lib/Manual.class.php';
require_once 'lib/xhr.inc.php';
require_once 'lib/xhr.view.inc.php';
require_once 'lib/view.inc.php';

$action = $_GET['f'];


$db->updateActivity();
if(isset($_GET['f']))
{
	$func = 'xhr_'.$action;
	if(function_exists($func))
	{
		/*
		 * check for page caching
		*/
		if(isset($g_page_cache[$_SERVER['REQUEST_URI']][$g_page_cache_mode]))
		{
			
			ob_start();
			echo $func($_GET);
			$page = ob_get_contents();
			Mem::setPageCache($page,$g_page_cache[$_SERVER['REQUEST_URI']][$g_page_cache_mode]);
			
			ob_end_clean();
		
			echo $page;
			//echo 'check';die();
		}
		else
		{
			echo $func($_GET);
		}
	}
}
