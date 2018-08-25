<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][1], $_GET["unit"], $_GET["tree"], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]); 
		$_GET["unit"]=clean($_GET["unit"]); 
		$_GET["tree"]=clean($_GET["tree"]);
		check_r($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]);
		$uup_status=get_uup($_GET["town"]);
		$units=units($faction[0]);
		$res=explode("-", $town[10]); $x_upgrades=explode("-", $town[$_GET["tree"]]); $cost=explode("-", $units[$_GET["unit"]][4]);

		if ($x_upgrades[$_GET["unit"]]<10)
			if (!$uup_status[$_GET["unit"]])
				if (($res[0]>=$cost[0]*($x_upgrades[$_GET["unit"]]+1))&&($res[1]>=$cost[1]*($x_upgrades[$_GET["unit"]]+1))&&($res[2]>=$cost[2]*($x_upgrades[$_GET["unit"]]+1))&&($res[3]>=$cost[3]*($x_upgrades[$_GET["unit"]]+1))&&($res[4]>=$cost[4]*($x_upgrades[$_GET["unit"]]+1)))
				{
					$res[0]-=$cost[0]*($x_upgrades[$_GET["unit"]]+1); $res[1]-=$cost[1]*($x_upgrades[$_GET["unit"]]+1); $res[2]-=$cost[2]*($x_upgrades[$_GET["unit"]]+1); $res[3]-=$cost[3]*($x_upgrades[$_GET["unit"]]+1); $res[4]-=$cost[4]*($x_upgrades[$_GET["unit"]]+1); 
					upgrade_u($_GET["town"], implode("-", $res), $_GET["unit"], $_GET["tree"], $units[$_GET["unit"]][9]);
				}
				else git("town.php?town=".$town[0]."&hata=noResources");
			else git("town.php?town=".$town[0]."&hata=unitAlrUpgraded");
		else git("town.php?town=".$town[0]."&hata=abilityMax");
	}
	else git("town.php?town=".$town[0]."&hata=insufData");
?>