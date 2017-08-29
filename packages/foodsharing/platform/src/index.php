<?php 
/*
if(isset($_GET['g_path']))
{
	$path = explode('/', $_GET['g_path']);
	//print_r($path);
	
	
	switch ($path[0])
	{
		case 'group' :
			$_GET['page'] = 'bezirk';
			$_GET['bid'] = $path[1];
			$_GET['sub'] = $path[2];
			break;
			
		default:
			break;
	}
	
}
*/

require_once 'lib/inc.php';
addCss('/css/gen/style.css?v='.VERSION);
addScript('/js/gen/script.js?v='.VERSION);

//importUsers();

getCurrent();
$menu = getMenu();

getMessages();
makeHead();

if(isset($_POST['form_submit']))
{
	if(handleForm($_POST['form_submit']))
	{
		go('/?page='.getPage());
	}
}
$msgbar = '';
$logolink = '/';
if(S::may())
{
	$msgbar = v_msgBar();
	$logolink = '/dashboard';
}
else
{
	$msgbar = v_login();
}
/*
 * check for page caching
 */
if(isset($g_page_cache[$_SERVER['REQUEST_URI']][$g_page_cache_mode]))
{
	ob_start();
	include 'tpl/'.$g_template.'.php';
	$page = ob_get_contents();
	Mem::setPageCache
	(
		$page,
		$g_page_cache[$_SERVER['REQUEST_URI']][$g_page_cache_mode]
	);
	ob_end_clean();
	
	echo $page;
}
else
{
	include 'tpl/'.$g_template.'.php';
}
