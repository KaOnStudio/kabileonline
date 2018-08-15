<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"], $_POST["taxes"]))
	{
		$_GET["town"]=clean($_GET["town"]); 
		$_POST["taxes"]=clean($_POST["taxes"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$town[8]=explode("-", $town[8]);
		$prod=explode("-", $town[9]);
		$buildings=buildings($_SESSION["user"][10]);
		$buildings[11][5]=explode("-", $buildings[11][5]);
		if (abs($_POST["taxes"])<=210)
		{
			if ($town[8][11])
				$bonus=$buildings[11][5][$town[8][11]-1]; 
			else $bonus=0;
			$exact_tax = ceil(abs($_POST["taxes"]) * 2.453);
			update_taxes($prod[0]."-".$prod[1]."-".$prod[2]."-".$prod[3]."-".$exact_tax, 100+$bonus-abs($_POST["taxes"]), $_GET["town"]);
			git_("town.php?town=".$_GET["town"], "olumlu", "Vergi Başarıyla Değiştirildi!");
		} 
		else git_("town.php?town=".$_GET["town"], "olumsuz", $lang['taxHigh']);
	}
	else {
		git('index.php'); die();
	}
?>