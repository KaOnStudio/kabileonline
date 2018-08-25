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

		$data = explode("-", $town[8]); $res = explode("-", $town[10]); $prod = explode("-", $town[9]); $lim = explode("-", $town[11]);
		$land = explode("/", $town[13]); $land[0] = explode("-", $land[0]); $land[1] = explode("-", $land[1]); $land[2] = explode("-", $land[2]); $land[3] = explode("-", $land[3]);
	}
	else {
		git('../../index.php'); die();
	}
			
		echo "<table border=\"1\" style='border-collapse:collapse; margin-left:-2px; margin-top:-5px;'>";
		for ($i=0; $i<count($buildings); $i++)
		{
			if($i!=12) // limaný çýkartmak için
			{
				if ((!$c_status[$i])&&(!$data[$i]))
				{
					//if (($town[16]!=-1)||($i!=12)) echo "<img src=".$imgs.$fimgs."b".$i.".png title='".$buildings[$i][2]."' width=75 heigh=100></br>";
						
					$okreq=1; $ok=1;
					$name=explode("-", $buildings[$i][2]); 
					$req=explode("/", $buildings[$i][3]); 
					$dur=explode("-", $buildings[$i][6]); 
					$upk=explode("-", $buildings[$i][7]); 
					$cost=explode("-", $buildings[$i][4]); 
					$dur[$data[$i]]=explode(":", $dur[$data[$i]]);
					for ($j=0; $j<count($req); $j++) $req[$j]=explode("-", $req[$j]);
					
					$tag1="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[$i][0]."&subB=-1'>".$lang['build']."</a>";
					
					/*
					///////////////////////////////// BÝR BÝNANIN GEREKSÝNÝMLERÝNÝN YAZILMASI /////////////////////////////////////////////////////
					if ($req[0][0]!="") 
					{	
						$tag = "";
						for ($j=0; $j<count($req); $j++)
						{
							if ($data[$req[$j][0]]<$req[$j][1]) 
								$okreq=0;
							$name=explode("-", $buildings[$req[$j][0]][2]);
							$tag=$tag.$name[0]." ".$lang['level']." ".$req[$j][1]."; ";
						} 
					}
					else $tag = "-";
					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					*/
					
					$tag2="<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".$cost[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".$cost[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".$cost[2]."<img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".$cost[3]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".$cost[4]."</br>".$lang['duration'].": ".($dur[$data[$i]][0]*$lim[4]/100).":".($dur[$data[$i]][1]*$lim[4]/100)." &nbsp; ".$lang['upkeep'].": ".$upk[0];
					
					if (($town[16]==-1)&&($i==12)) $ok=0;
						
					if ($ok)
					{
						echo "<tr>";
						echo "<td style='width:34px; padding-left:2px;'><img src=".$imgs.$fimgs."b".$i.".png title='".$buildings[$i][2]."' style='width:30px; heigh:30px;'></td>";
						echo "<td style='width:350px; padding-left:2px;'>".$buildings[$i][8]."</td>";
						echo "<td style='width:300px; text-align:center;'>".$tag2."</td>";
						echo "<td style='width:52px;'>&nbsp;".$tag1."</td>";
						echo "</tr>";
						
						/*
						if ($town[12]+$town[3]+$upk[$data[$i]]>$lim[3]) echo("</br>".$lang['noHouses']);
						if (!$okreq) echo("</br>".$lang['reqNotMet']); 
						if (!(($res[0]>=$cost[0])&&($res[1]>=$cost[1])&&($res[2]>=$cost[2])&&($res[3]>=$cost[3])&&($res[4]>=$cost[4]))) echo("</br>".$lang['noResources']);
						*/
					}
				}
			}
		}
		echo "</table>";
		
		if(!$c_status[7])
		{
			if (($data[7]<10))                                                                                 
			{
				echo "<hr /><br /><table style='text-align:center; margin-left:175px;'><tr><td>";
				
				$name = explode("-", $buildings[7][2]); if ($data[7]==10) $name=$name[1]; else $name=$name[0];
				$dur=explode("-", $buildings[7][6]); 
				$upk=explode("-", $buildings[7][7]); 
				$cost=explode("-", $buildings[7][4]); 
				$dur[$data[7]]=explode(":", $dur[$data[7]]);
				
				$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[7][0]."&subB=-1'>".$lang['upgrade']." ".$name." ".$lang['toLevel']." ".($data[7]+1)."</a></br>";
				$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[7]))."</br>".$lang['duration'].": ".($dur[$data[7]][0]*$lim[4]/100).":".($dur[$data[7]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[7]];
				
				echo $tag;
				
				if ($town[12]+$town[3]+$upk[$data[7]]>$lim[3]) 
					echo("</br>".$lang['noHouses']);
				if (!(($res[0]>=$cost[0]*pow($r, $data[7]))&&($res[1]>=$cost[1]*pow($r, $data[7]))&&($res[2]>=$cost[2]*pow($r, $data[7]))&&($res[3]>=$cost[3]*pow($r, $data[7]))&&($res[4]>=$cost[4]*pow($r, $data[7])))) echo("</br>".$lang['noResources']);
				
				echo "</td></tr></table><br /><hr /></br>";		
			}
			else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
?>