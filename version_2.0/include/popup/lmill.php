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
		
		$data = explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $land=explode("/", $town[13]); $land=explode("-", $land[1]); $out=explode("-", $buildings[1][5]);
		$name=explode("-", $buildings[1][2]);
	}
	else {
		git('../../index.php'); die();
	}
	
		if ($data[1])
		{
			if (!$c_status[1])
			{
				echo '<table style="text-align:center;"><tr>';
				for ($i=0; $i<count($land); $i++)
				{
					echo "<td "; if(count($land)==4) echo " style='width:330px;' "; echo ">";
					if ($land[$i]<10)
					{
						$j=$i+1;
						$name=explode("-", $buildings[1][2]); 
						$dur=explode("-", $buildings[1][6]); 
						$upk=explode("-", $buildings[1][7]); 
						$cost=explode("-", $buildings[1][4]); 
						$dur[$land[$i]]=explode(":", $dur[$land[$i]]);
						$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[1][0]."&subB=".$i."'>".$j.".".$name[1]."  : ".$lang['upgrade']." ".$lang['toLevel']." ".($land[$i]+1)."</a>";
						$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $land[$i]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $land[$i]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $land[$i]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $land[$i]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $land[$i]))."</br>".$lang['duration'].": ".($dur[$land[$i]][0]*$lim[4]/100).":".($dur[$land[$i]][1]*$lim[4]/100)."</br>".$lang['expProduction'].": ".$out[$land[$i]];
						
						echo $tag;
						
						if ($town[12]+$town[3]+$upk[$land[$i]]>$lim[3]) 
							echo("</br>".$lang['noHouses']);
						if (!(($res[0]>=$cost[0]*pow($r, $land[$i]))&&($res[1]>=$cost[1]*pow($r, $land[$i]))&&($res[2]>=$cost[2]*pow($r, $land[$i]))&&($res[3]>=$cost[3]*pow($r, $land[$i]))&&($res[4]>=$cost[4]*pow($r, $land[$i])))) 
							echo("</br>".$lang['noResources']);
					}
					else echo $lang['buildingMaxLvl']."</br></br>";
					echo "</td>";
					if((count($land) == 6 and $i == 2) or (count($land) == 4 and $i == 1))
						echo "</tr><tr><td colspan=\"".($i+1)."\">&nbsp;</tr><tr><td colspan=\"".($i+1)."\"><hr /></tr><tr><td colspan=\"".($i+1)."\">&nbsp;</tr><tr>";
				}
				echo "</tr></table>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br>".$lang['constrBuilding']."</br></br>";
	?>