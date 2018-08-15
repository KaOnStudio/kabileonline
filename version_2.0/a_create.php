<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][1], $_POST["name"], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]); 
		$_POST["name"] = clean($_POST["name"]);
		if (!$_SESSION["user"][11]) 
			$_SESSION["user"][11] = a_create($_POST["name"], $_SESSION["user"][0]);
		else 
			git("town.php?town=".$town[0]."&hata=allreadyInAlly");
			
		git("town.php?town=".$_GET["town"]);
	}
	else 
		git("town.php?town=".$town[0]."&hata=insufData");
?>