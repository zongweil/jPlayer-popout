<?
session_start();
if($_SESSION['id'])
{
	$_SESSION = array();
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	session_destroy();
}

exit;
?>