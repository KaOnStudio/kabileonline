<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"], $_GET["b"], $_GET["subB"]))
	{
		$_GET["town"] = clean($_GET["town"]); $_GET["b"] = clean($_GET["b"]); $_GET["subB"] = clean($_GET["subB"]);
		$okreq = 1; $okhouse = 1;
		check_r($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}

		$faction = faction($_SESSION["user"][10]); 
		$r=$faction[3];

		$buildings = buildings($_SESSION["user"][10]);

		$c_status=get_con($_GET["town"]);
		$cq=get_c($_GET["town"]);

		$data=explode("-", $town[8]); $res=explode("-", $town[10]); $lim=explode("-", $town[11]); $land=explode("/", $town[13]);
		$dur=explode("-", $buildings[$_GET["b"]][6]); $cost=explode("-", $buildings[$_GET["b"]][4]); $req=explode("/", $buildings[$_GET["b"]][3]); $upk=explode("-", $buildings[$_GET["b"]][7]);
		if ($_GET["subB"]==-1) 
		{
			$d=$data[$_GET["b"]]; 
			$dur[$d]=explode(":", $dur[$d]);
		}
		else 
		{
			$land=explode("-", $land[$_GET["b"]]); 
			$d=$land[$_GET["subB"]]; 
			$dur[$d]=explode(":", $dur[$d]);
		}
		for ($j=0; $j<count($req); $j++) 
			$req[$j]=explode("-", $req[$j]);
		if ($req[0][0]!="") 
			for ($j=0; $j<count($req); $j++) 
				if ($data[$req[$j][0]]<$req[$j][1]) 
					$okreq=0;
		if ($town[12]+$town[3]+$upk[$d]>$lim[3]) 
			$okhouse=0;
		if (!$c_status[$_GET["b"]])
			if ($d<10)
				if ($okreq)
					if(count($cq)<3)
						if ((($res[0]>=$cost[0]*pow($r, $d))&&($res[1]>=$cost[1]*pow($r, $d))&&($res[2]>=$cost[2]*pow($r, $d))&&($res[3]>=$cost[3]*pow($r, $d))&&($res[4]>=$cost[4]*pow($r, $d))))
							if ($okhouse)
							{
								$res[0]-=$cost[0]*pow($r, $d); $res[1]-=$cost[1]*pow($r, $d); $res[2]-=$cost[2]*pow($r, $d); $res[3]-=$cost[3]*pow($r, $d); $res[4]-=$cost[4]*pow($r, $d); $res=implode("-", $res);
								build($_GET["town"], $_GET["b"], $_GET["subB"], (floor($dur[$d][0]*$lim[4]/100)).":".((($dur[$d][0]*$lim[4]/100)-floor($dur[$d][0]*$lim[4]/100))*60+floor($dur[$d][1]*$lim[4]/100)).":".((($dur[$d][1]*$lim[4]/100)-floor($dur[$d][1]*$lim[4]/100))*60), $res, $_SESSION["user"][10]);
							}
							else git("town.php?town=".$town[0]."&hata=noHouses");
						else git("town.php?town=".$town[0]."&hata=noResources");
					else git("town.php?town=".$town[0]."&hata=queueFull");
				else git("town.php?town=".$town[0]."&hata=reqNotMet");
			else git("town.php?town=".$town[0]."&hata=buildingMaxLvl");
		else git("town.php?town=".$town[0]."&hata=buildingUnderConstr");
	}
	else {
		git('index.php'); die();
	}
?>