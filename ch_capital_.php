<?php 
	include "include/ronarazoro.php";

	$_GET["town"] = clean($_GET["town"]);
	ch_capital($_GET["town"], $_SESSION["user"][0]);
?>
