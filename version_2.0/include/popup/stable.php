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

		$data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $out=explode("-", $buildings[19][5]); $weaps=explode("-", $town[6]);
	}
	else {
		git('../../index.php'); die();
	}
		
		
		if ($data[19])
		{
			echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:10px;'>";
			
			$dur=explode(":", $weapons[9][4]); $cost=explode("-", $weapons[9][3]);
			echo "<form name='spears' method='post' action='forge.php?town=".$_GET["town"]."&type=9'>";
			echo "<tr>";
			echo "<td style='width:50px; padding-left:2px;'><img src='".$imgs.$fimgs."19.gif' title='".$weapons[9][2]."' style='width:45px; heigh:45px;'></td>";
			echo "<td style='width:250px; padding-left:2px;'>".$weapons[9][5]."</td>";
			echo "<td style='width:350px; text-align:center;'><img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].": ".($dur[0]*$lim[10]/100).":".($dur[1]*$lim[10]/100).".</td>";
			echo "<td style='width:100px;text-align:center;'><input name='q' type='text' style='width:45px;' value='0'><input type='submit' style='width:45px; height:25px;' name='spear' value='".$lang['breed']."'></td>";
			echo "</tr>";
			echo "</form>";
			
			echo "</table>";
		}
		
		/*
		if (count($wq)) echo "Weapon forge queue:</br>";
		for ($i=0; $i<count($wq); $i++)
		{
			echo "[<a class='q_link' href='cancel_w.php?town=".$_GET["town"]."&type=".$wq[$i][1]."'>x</a>] ".$wq[$i][2]." ".$weapons[$wq[$i][1]][2]." - <span id='".$i."'>".$wq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('".$i."', 'stable.php?town=".$_GET["town"]."'); </script></br>";
		}
		*/
		
		if ($data[19])
		{
			if (!$c_status[19])
			{
				if ($data[19]<10)
				{
					echo "</br></br><hr /></br></br><table style='text-align:center; margin-left:175px;'><tr><td>";
					
					$dur=explode("-", $buildings[19][6]); 
					$upk=explode("-", $buildings[19][7]); 
					$cost=explode("-", $buildings[19][4]); 
					$dur[$data[19]]=explode(":", $dur[$data[19]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[19][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[19][2]." ".$lang['toLevel']." ".($data[19]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[19]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[19]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[19]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[19]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[19]))."</br>".$lang['duration'].": ".($dur[$data[19]][0]*$lim[4]/100).":".($dur[$data[19]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[19]]."</br>".$lang['expSpeed'].": ".$out[$data[19]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[19]]>$lim[3]) echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[19]))&&($res[1]>=$cost[1]*pow($r, $data[19]))&&($res[2]>=$cost[2]*pow($r, $data[19]))&&($res[3]>=$cost[3]*pow($r, $data[19]))&&($res[4]>=$cost[4]*pow($r, $data[19])))) echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br><hr /></br>";
				}
				else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['constrBuilding']."</b></br></br>";
		?>
