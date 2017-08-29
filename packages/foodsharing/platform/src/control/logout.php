<?php 
$db->logout();
$_SESSION['login'] = false;
$_SESSION = array();
session_destroy();
S::destroy();
header('Location: /');
exit();