<?php
$g_page_cache_mode = 'g';
if(S::may())
{
	$g_page_cache_mode = 'u';
}

if(isset($g_page_cache[$_SERVER['REQUEST_URI']][$g_page_cache_mode]) && ($page = Mem::getPageCache()) !== false && !isset($_GET['flush']))
{
	echo $page;
	exit();
}
