<?php 
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		check_r($_GET["town"]);
		check_w($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings=buildings($_SESSION["user"][10]);
		$wq=get_w($_GET["town"]);
		$weapons=weapons($_SESSION["user"][10]);
		$c_status=get_con($_GET["town"]);

		$data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $out=explode("-", $buildings[18][5]); $weaps=explode("-", $town[6]);
	}
	else {
		git('../../index.php'); die();
	}

		if ($data[18])
		{
			echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:-5px;'>";
			for ($i=0; $i<count($weapons); $i++)
			{
				if ($i<9)
				{
					$dur=explode(":", $weapons[$i][4]);  $cost=explode("-", $weapons[$i][3]);
					echo "<form name='weapons' method='post' action='forge.php?town=".$_GET["town"]."&type=".$i."'>";
					echo "<tr>";
					echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."1".$i.".gif' title='".$weapons[$i][2]."' style='width:40px; heigh:40px;'></td>";
					echo "<td style='width:250px; padding-left:2px;'>".$weapons[$i][5]."</td>";
					echo "<td style='width:350px; text-align:center;'><img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].": ".($dur[0]*$lim[9]/100).":".($dur[1]*$lim[9]/100)."</td>";
					echo "<td style='width:100px;text-align:center;'><input name='q' type='text' style='width:45px;' value='0'><input type='submit' style='width:45px; height:25px;' name='spear' value='".$lang['breed']."'></td>";
					echo "</tr>";
					echo "</form>";
				}
			}
			echo "</table>";
		}
	
		if ($data[18])
		{
			if (!$c_status[18])
			{
				if ($data[18]<10)
				{
					echo "</br></br><hr /></br></br><table style='text-align:center; margin-left:175px;'><tr><td>";
					
					$dur=explode("-", $buildings[18][6]); 
					$upk=explode("-", $buildings[18][7]); 
					$cost=explode("-", $buildings[18][4]); 
					$dur[$data[18]]=explode(":", $dur[$data[18]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[18][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[18][2]." ".$lang['toLevel']." ".($data[18]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[18]))."</br>".$lang['duration'].": ".($dur[$data[18]][0]*$lim[4]/100).":".($dur[$data[18]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[18]]."</br>".$lang['expSpeed'].": ".$out[$data[18]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[18]]>$lim[3]) echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[18]))&&($res[1]>=$cost[1]*pow($r, $data[18]))&&($res[2]>=$cost[2]*pow($r, $data[18]))&&($res[3]>=$cost[3]*pow($r, $data[18]))&&($res[4]>=$cost[4]*pow($r, $data[18])))) echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br></br><hr /></br></br>";
				}
				else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['constrBuilding']."</b></br></br>";
		?>
