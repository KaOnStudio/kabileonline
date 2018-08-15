<?php

	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		check_r($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings=buildings($_SESSION["user"][10]);
		$c_status=get_con($_GET["town"]);
		$uq=get_u($_GET["town"]);
		$units=units($faction[0]);

		$data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $out=explode("-", $buildings[20][5]); $u_upgrades=explode("-", $town[17]); $w_upgrades=explode("-", $town[18]); $a_upgrades=explode("-", $town[19]); $army=explode("-", $town[7]);
	}
	else {
		git('../../index.php'); die();
	}
	
		if ($data[15])
		{
			echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:10px;'>";
			for ($i=7; $i<9; $i++)
			{
				$dur=explode(":", $units[$i][9]);  $cost=explode("-", $units[$i][4]);
				if ( (($u_upgrades[$i])&&($w_upgrades[$i])&&($a_upgrades[$i])) or true ) {
					echo "<form name='units' method='post' action='train.php?town=".$_GET["town"]."&type=".$i."'>";
					echo "<tr>";
					echo "<td style='width:50px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:45px; heigh:45px;'></td>";
					echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
					echo "<td style='width:350px; text-align:center;'><img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].": ".($dur[0]*$lim[8]/100).":".($dur[1]*$lim[8]/100).", ".$lang['hp'].": ".($units[$i][5]+$u_upgrades[$i]).", ".$lang['atk'].": ".($units[$i][6]+$w_upgrades[$i]).", ".$lang['def'].": ".($units[$i][7]+$a_upgrades[$i]).", ".$lang['speed'].": ".$units[$i][8].".</td>";
					echo "<td style='width:100px;text-align:center;'><input name='q' type='text' style='width:45px;' value='0'><input type='submit' style='width:45px; height:25px;' name='unit' value='".$lang['breed']."'></td>";
					echo "</tr>";
					echo "</form>";
				}
				else {
					echo "<tr style='text-align: center;'>";
					echo "<td style='width:50px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:45px; heigh:45px;'></td>";
					echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
					echo "<td style='width:450px; text-align:center;' colspan='2'>".$lang['researchUnit']." ".$lang['in']." ";
					if (!$u_upgrades[$i]) echo $buildings[16][2]."</td></tr>";
					else if (!$w_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
					else if (!$a_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
				}
			}
			echo "</table>";
		}
	
		if ($data[20])
		{
			if (!$c_status[20])
			{
				if ($data[20]<10)
				{
					echo "</br><hr /></br><table style='text-align:center; margin-left:175px;'><tr><td>";
					
					$dur=explode("-", $buildings[20][6]); 
					$upk=explode("-", $buildings[20][7]); 
					$cost=explode("-", $buildings[20][4]); 
					$dur[$data[20]]=explode(":", $dur[$data[20]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[20][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[20][2]." ".$lang['toLevel']." ".($data[20]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[20]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[20]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[20]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[20]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[20]))."</br>".$lang['duration'].": ".($dur[$data[20]][0]*$lim[4]/100).":".($dur[$data[20]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[20]]."</br>Expected speed percentage: ".$out[$data[20]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[20]]>$lim[3]) echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[20]))&&($res[1]>=$cost[1]*pow($r, $data[20]))&&($res[2]>=$cost[2]*pow($r, $data[20]))&&($res[3]>=$cost[3]*pow($r, $data[20]))&&($res[4]>=$cost[4]*pow($r, $data[20])))) echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br><hr /></br>";
				}
				else echo "</br></br><b>".$lang['buildingMaxLvl']."</b></br>";
			}
			else echo "</br></br><b>".$lang['beingUpgraded']."</b></br>";
		}
		else echo "</br></br><b>".$lang['constrBuilding']."</b></br>";

		
?>
