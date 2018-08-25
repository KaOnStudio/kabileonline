<?php
	include "include/ronarazoro.php";
	
	$_SESSION = array();
	session_destroy();
	
	git("index.php");
?>