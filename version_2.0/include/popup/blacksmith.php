<?php 
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		check_r($_GET["town"]);
		check_uup($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction = faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings = buildings($_SESSION["user"][10]);
		$upq=get_up($_GET["town"]);
		$c_status = get_con($_GET["town"]);
		$units=units($faction[0]);
		$uup_status=get_uup($town[0]);
		
		$data = explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $w_upgrades=explode("-", $town[18]); $a_upgrades=explode("-", $town[19]);
	}
	else {
		git('../../index.php'); die();
	}

		if ($data[17])
		{
			echo "<table border=\"1\" style='border-collapse:collapse; margin-left:20px; margin-top:-5px;'>";
			for ($i=0; $i<count($units); $i++)
			{
				if($i!=9 and $i!=10)//gemileri çýkardým.
				{
					$cost=explode("-", $units[$i][4]);
					if ($w_upgrades[$i]<10) {
						$wl="<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*($w_upgrades[$i]+1))."</br>".$lang['duration'].":".$units[$i][9]."  -  ".$lang['atk'].":".($units[$i][6]+$w_upgrades[$i]+1); 
					}
					else 
						$wl = "<br />".$lang['atk'].": ".($units[$i][6]+$w_upgrades[$i]);
					if ($a_upgrades[$i]<10) {
						$al="<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*($a_upgrades[$i]+1))."</br>".$lang['duration'].":".$units[$i][9]."  -  ".$lang['def'].":".($units[$i][7]+$a_upgrades[$i]+1); 
					}
					else 
						$al = "<br />".$lang['def'].": ".($units[$i][7]+$a_upgrades[$i]);
						
					if (!$uup_status[$i]) {
						echo "<tr>";
						echo "<td rowspan='2' style='width:50px; padding-left:5px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
						echo "<td style='width:50px; text-align:center;'>".$lang['weapon']."</td>";
						echo "<td style='width:350px; text-align:center;'>".$wl."</td>";
						echo "<td style='width:150px; text-align:center;'>&nbsp;&nbsp;Seviye ".$w_upgrades[$i]."&nbsp;&nbsp;";
						if($w_upgrades[$i]<10) echo "|&nbsp;&nbsp;<a class='q_link' href='u_upgrade.php?unit=".$units[$i][0]."&tree=18&town=".$_GET["town"]."'>".$lang['upgrade']."</a>";
						echo "</td>";
							
						echo "</tr><tr>";
						echo "<td style='width:50px; text-align:center;'>".$lang['armor']."</td>";
						echo "<td style='width:350px; text-align:center;'>".$al."</td>";
						echo "<td style='width:150px; text-align:center;'>&nbsp;&nbsp;Seviye ".$a_upgrades[$i]."&nbsp;&nbsp;";
						if($a_upgrades[$i]<10) echo "|&nbsp;&nbsp;<a class='q_link' href='u_upgrade.php?unit=".$units[$i][0]."&tree=19&town=".$_GET["town"]."'>".$lang['upgrade']."</a>";
						echo "</td>";
						echo "</tr>";
					}
					else {
						echo "<tr>";
						echo "<td rowspan='2' style='width:50px; padding-left:5px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
						echo "<td style='width:50px; text-align:center;'>".$lang['weapon']."</td>";
						echo "<td rowspan='2' colspan='2' style='width:350px; text-align:center;'><br />".$lang['upgrading']."<br /></td>";
						echo "</tr><tr>";
						echo "<td style='width:50px; text-align:center;'>".$lang['armor']."</td>";
						echo "</tr>";
					}
				}
			}
			echo "</table>";
		}
		else echo $lang['constrBuilding'];

?>
