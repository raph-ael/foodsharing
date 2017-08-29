<?php
$db->relogin();
//die();
if(isset($_GET['url']) && !empty($_GET['url']))
{
	$url = urldecode($_GET['url']);
	if(substr($url, 0,4) !== 'http')
	{
		go($url);
	}
	else
	{
		go('/dashboard');
	}
}