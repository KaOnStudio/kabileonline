<?php include "antet.php"; include "func.php";
	$_SESSION = array();
	session_destroy();
	msg($lang['cya']);
?>