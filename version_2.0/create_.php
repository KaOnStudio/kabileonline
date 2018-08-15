<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["is_cap"], $_POST["x"], $_POST["y"], $_POST["name"]))
	{
		$_POST["name"]=clean($_POST["name"]); $_POST["x"]=clean($_POST["x"]); $_POST["y"]=clean($_POST["y"]);
		$_GET["is_cap"]=clean($_GET["is_cap"]);
		$towns=towns($_SESSION["user"][0]); $twnCount=count($towns); $ok=1;
		if ($twnCount)
		{
			$is_cap=0; $data=explode("-", $towns[0][8]); $army=explode("-", $towns[0][7]);
			if ($data[7]<10) {$ok=0; msg($lang['needCastle']);}
			if ($army[11]<50) {$ok=0; msg($lang['needColonists']);}
		}
		$sector=sector($_POST["x"], $_POST["y"]);
		if ($ok)
			if ($sector[2]==1) 
				create($_SESSION["user"][0], $_POST["name"], $_POST["x"], $_POST["y"], $_GET["is_cap"]);
			else msg($lang['cantConstrThere']);
	}
	else msg($lang['insufData']);
?>