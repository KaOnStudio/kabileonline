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
		
		$data = explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $u_upgrades=explode("-", $town[17]);
	}
	else {
		git('../../index.php'); die();
	}
	
		if ($data[16])
		{
			echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:-5px;'>";
			for ($i=0; $i<count($units); $i++)
			{
				if($i!=9 and $i!=10)//gemileri çýkardým.
				{
					$cost=explode("-", $units[$i][4]);
					if ($u_upgrades[$i]<10)
					{
						if (!$uup_status[$i]) {
							echo "<tr>";
							echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
							echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
							echo "<td style='width:360px; text-align:center;'><img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*($u_upgrades[$i]+1))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*($u_upgrades[$i]+1))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*($u_upgrades[$i]+1))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*($u_upgrades[$i]+1))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*($u_upgrades[$i]+1))."</br>".$lang['duration'].":".$units[$i][9]." - ".$lang['hp'].":".($units[$i][5]+$u_upgrades[$i]+1)." - ".$lang['speed'].":".$units[$i][8]."</td>";
							echo "<td style='width:75px;text-align:center;'>Seviye ".$u_upgrades[$i]."<br /><a class='q_link' href='u_upgrade.php?unit=".$units[$i][0]."&tree=17&town=".$_GET["town"]."'>".$lang['upgrade']."</a></td>";
							echo "</tr>";
						}
						else {
							echo "<tr>";
							echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
							echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
							echo "<td colspan='2' style='text-align:center;'>".$lang['upgrading']."</td>";
							echo "</tr>";
						}
					}
					else 
					{
						echo "<tr>";
						echo "<td style='width:34px; padding-left:2px;'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."' style='width:40px; heigh:40px;'></td>";
						echo "<td style='width:250px; padding-left:2px;'>".$units[$i][10]."</td>";
						echo "<td colspan='2' style='text-align:center;'>".$lang['hp'].": ".($units[$i][5]+$u_upgrades[$i]).", ".$lang['speed'].": ".$units[$i][8]."</td>";
						echo "</tr>";
					}
				}
			}
			echo "</table>";
		}
		else echo $lang['constrBuilding'];

?>
