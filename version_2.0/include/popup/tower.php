<?php
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		check_r($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction = faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings = buildings($_SESSION["user"][10]);
		$c_status = get_con($_GET["town"]);
		
		$data = explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $out=explode("-", $buildings[14][5]);
	}
	else {
		git('../../index.php'); die();
	}

		if ($data[14])
		{
			if (!$c_status[14])
			{
				if ($data[14]<10)
				{
					echo "</br></br><hr /></br></br><table style='text-align:center; margin-left:175px;'><tr><td>";
				
					$dur=explode("-", $buildings[14][6]); 
					$upk=explode("-", $buildings[14][7]); 
					$cost=explode("-", $buildings[14][4]); 
					$dur[$data[14]]=explode(":", $dur[$data[14]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[14][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[14][2]." ".$lang['toLevel']." ".($data[14]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[14]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[14]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[14]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[14]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[14]))."</br>".$lang['duration'].": ".($dur[$data[14]][0]*$lim[4]/100).":".($dur[$data[14]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[14]]."</br>".$lang['expOffence'].": ".$out[$data[14]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[14]]>$lim[3]) echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[14]))&&($res[1]>=$cost[1]*pow($r, $data[14]))&&($res[2]>=$cost[2]*pow($r, $data[14]))&&($res[3]>=$cost[3]*pow($r, $data[14]))&&($res[4]>=$cost[4]*pow($r, $data[14])))) echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br></br><hr /></br></br>";
				}
				else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['constrBuilding']."</b></br></br>";
?>