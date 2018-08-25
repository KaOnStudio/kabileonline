<?php 
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		check_r($_GET["town"]);
		check_u($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction = faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings = buildings($_SESSION["user"][10]);
		$weapons = weapons($_SESSION["user"][10]);
		$c_status = get_con($_GET["town"]);
		$uq = get_u($_GET["town"]);
		$units = units($faction[0]);

		$data = explode("-", $town[8]); $res = explode("-", $town[10]); $prod = explode("-", $town[9]); $lim = explode("-", $town[11]); $out = explode("-", $buildings[15][5]); $u_upgrades = explode("-", $town[17]); $w_upgrades = explode("-", $town[18]); $a_upgrades = explode("-", $town[19]); $army = explode("-", $town[7]); $weaps = explode("-", $town[6]);
	}
	else {
		git('../../index.php'); die();
	}

		echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:-5px;'>";
		if ($data[15])
		{
			for ($i=0; $i<count($units); $i++)
			{
				if($i!=9 and $i!=10)
				{
					$dur=explode(":", $units[$i][9]); 
					$cost=explode("-", $units[$i][4]);
					if (($u_upgrades[$i])&&($w_upgrades[$i])&&($a_upgrades[$i])) {
						echo "<form name='units' method='post' action='train.php?town=".$_GET["town"]."&type=".$i."'>";
						echo "<tr>";
						echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
						echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
						echo "<td style='width:375px; text-align:center;'><img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].":".($dur[0]*$lim[8]/100).":".($dur[1]*$lim[8]/100)." - ".$lang['hp'].":".($units[$i][5]+$u_upgrades[$i])." - ".$lang['atk'].":".($units[$i][6]+$w_upgrades[$i])." - ".$lang['def'].":".($units[$i][7]+$a_upgrades[$i])." - ".$lang['speed'].":".$units[$i][8]."</td>";
						echo "<td style='width:60px;text-align:center;'><input name='q' type='text' style='width:45px;' value='0'><input type='submit' style='width:45px; height:25px;' name='unit' value='".$lang['train']."'></td>";
						echo "</tr>";
						echo "</form>";
					}
					else {
						echo "<tr>";
						echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
						echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
						echo "<td colspan='2' style='text-align:center;'>".$lang['researchUnit']."</td>";
						echo "</tr>";
					}
					/*
					if (!$u_upgrades[$i]) echo $buildings[16][2]."</td></tr>";
					else if (!$w_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
					else if (!$a_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
					*/
				}
			}
		}
		echo "</table>";
		
		if ($data[15])
		{
			/*
			//////////////////////////////////////////////// mevcut silahlar ///////////////////////////////////////////////
			echo $lang['currentStorCap'].": ".$lim[12]." ".$lang['type']."</br>".$lang['weapStock'].":<table class='q_table' style='border-collapse: collapse; text-indent: 0; margin-left:auto; margin-right:auto; text-align: center;' width='600' border='1'><tr>";
			for ($i=0; $i<count($weapons); $i++) 
				echo "<td><img src='".$imgs.$fimgs."1".$i.".gif' title='".$weapons[$i][2]."'></td>";
			echo "</tr><tr>";
			for ($i=0; $i<count($weaps); $i++) 
				echo "<td>".$weaps[$i]."</td>";
			echo "</tr></table></br>";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			////////////////////////////////////////////// mevcut askerler ////////////////////////////////////////////////////
			echo $lang['availableTroops'].":<table class='q_table' style='border-collapse: collapse; text-indent: 0; text-align: center' width='600' border='1'><tr>";
			for ($i=0; $i<count($units); $i++) 
				echo "<td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></td>";
			echo "</tr><tr>";
			for ($i=0; $i<count($army); $i++) 
				echo "<td>".$army[$i]."</td>";
			echo "</tr></table></br>";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			*/
			if (!$c_status[15])
			{
				if ($data[15]<10)
				{
					echo "<hr /></br></br><table style='text-align:center; margin-left:175px;'><tr><td>";
					
					$dur=explode("-", $buildings[15][6]); 
					$upk=explode("-", $buildings[15][7]); 
					$cost=explode("-", $buildings[15][4]); 
					$dur[$data[15]]=explode(":", $dur[$data[15]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[15][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[15][2]." ".$lang['toLevel']." ".($data[15]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[15]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[15]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[15]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[15]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[15]))."</br>".$lang['duration'].": ".($dur[$data[15]][0]*$lim[4]/100).":".($dur[$data[15]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[15]]."</br>".$lang['expSpeed'].": ".$out[$data[15]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[15]]>$lim[3]) 
						echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[15]))&&($res[1]>=$cost[1]*pow($r, $data[15]))&&($res[2]>=$cost[2]*pow($r, $data[15]))&&($res[3]>=$cost[3]*pow($r, $data[15]))&&($res[4]>=$cost[4]*pow($r, $data[15])))) 
						echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br></br><hr /></br></br>";
				}
				else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['constrBuilding']."</b></br></br>";
?>