<?php 
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		check_r($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$faction = faction($_SESSION["user"][10]); $r=$faction[3];
		$buildings = buildings($_SESSION["user"][10]);
		$wq=get_w($_GET["town"]);
		$weapons=weapons($_SESSION["user"][10]);	
		$data = explode("-", $town[8]); 

	}
	else {
		git('index.php'); die();
	}	
				
		echo "<br /><hr /><br /><table style='text-align:center; margin-left:230px;'><tr><td>";
		if(count($wq)) {
			echo '<table style="margin-left:-160px; border-collapse:collapse; " border="1">';
			echo '<tr style="text-align:center; background:#f0d59c;  height:50px;">';
			echo '<td style="width:160px;">Teçhizat</td>';
			echo '<td style="width:100px;">Miktar</td>';
			echo '<td style="width:150px;">Kalan Süre</td>';
			echo '<td style="width:100px;">&nbsp;</td>';
			echo '</tr>';
			
			for ($i=0; $i<count($wq); $i++)
			{
				$eksisorunu = explode(":", $wq[$i][0]);
				if($eksisorunu[0][0] == "-") {
					echo "<script> window.location = 'town.php?town=".$town[0]."&hata=weaponq'; </script>";
				}
				else
				{
					echo "<tr style='text-align:center; height:40px;'>
					<td> ".$weapons[$wq[$i][1]][2]."</td>
					<td>".$wq[$i][2]."</td>
					<td><span id='wq".$i."'>".$wq[$i][0]."</span></td>
					<td><a class='q_link' href='cancel_w.php?town=".$_GET["town"]."&type=".$wq[$i][1]."'>iptal et</a></td>
					</tr>";
				}
			}
			echo '</table>';
			for ($i=0; $i<count($wq); $i++)
				echo "<script type='text/javascript'> var id=new Array(50); timer('wq".$i."', 'town.php?town=".$_GET["town"]."'); </script>";
		}
		else
			echo "</br></br><b>Üretilmekte Olan Herhangi Bir Teçhizat Yok!</b></br></br>";
		echo "</td></tr></table><br /><hr /></br>";				
?>