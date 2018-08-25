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
		$uq = get_u($_GET["town"]);
		$upq=get_up($_GET["town"]);
		$units=units($faction[0]);
		$data = explode("-", $town[8]); 
		$u_upgrades=explode("-", $town[17]);
	}
	else {
		git('index.php'); die();
	}	
				
		echo "<br /><hr /><br /><table style='text-align:center; margin-left:230px;'><tr><td>";
		if(count($uq)) {
			echo '<table style="margin-left:-160px; border-collapse:collapse; " border="1">';
			echo '<tr style="text-align:center; background:#f0d59c;  height:50px;">';
			echo '<td style="width:160px;">Asker</td>';
			echo '<td style="width:100px;">Miktar</td>';
			echo '<td style="width:150px;">Kalan Süre</td>';
			echo '<td style="width:100px;">&nbsp;</td>';
			echo '</tr>';
			
			for ($i=0; $i<count($uq); $i++)
			{
				$eksisorunu = explode(":", $uq[$i][0]);
				if($eksisorunu[0][0] == "-") {
					echo "<script> window.location = 'town.php?town=".$town[0]."&hata=troopq'; </script>";
				}
				else
				{
					echo "<tr style='text-align:center; height:40px;'>
					<td> ".$units[$uq[$i][1]][2]."</td>
					<td>".$uq[$i][2]."</td>
					<td><span id='uq".$i."'>".$uq[$i][0]."</span></td>
					<td><a class='q_link' href='cancel_u.php?town=".$_GET["town"]."&type=".$uq[$i][1]."'>iptal et</a></td>
					</tr>";
				}
			}
			echo '</table>';
			for ($i=0; $i<count($uq); $i++)
				echo "<script type='text/javascript'> var id=new Array(50); timer('uq".$i."', 'town.php?town=".$_GET["town"]."'); </script>";
		}
		else
			echo "</br></br><b>Eğitimde Askerin Yok!</b></br></br>";
		echo "</td></tr></table><br /><hr /></br>";	
		
		echo "<table style='text-align:center; margin-left:230px;'><tr><td>";
		if(count($upq)) {
			echo '<table style="margin-left:-160px; border-collapse:collapse; " border="1">';
			echo '<tr style="text-align:center; background:#f0d59c;  height:50px;">';
			echo '<td style="width:160px;">Asker</td>';
			echo '<td style="width:100px;">Seviye</td>';
			echo '<td style="width:150px;">Kalan Süre</td>';
			echo '<td style="width:100px;">&nbsp;</td>';
			echo '</tr>';
			
			for ($i=0; $i<count($upq); $i++)
			{
				$eksisorunu = explode(":", $upq[$i][0]);
				if($eksisorunu[0][0] == "-") {
					echo "<script> window.location = 'town.php?town=".$town[0]."&hata=troopq'; </script>";
				}
				else
				{
					echo "<tr style='text-align:center; height:40px;'>
					<td> ".$units[$upq[$i][1]][2]."</td>
					<td>".($u_upgrades[$upq[$i][1]] + 1)."</td>
					<td><span id='upq".$i."'>".$upq[$i][0]."</span></td>
					<td><a class='q_link' href='cancel_uup.php?town=".$_GET["town"]."&unit=".$upq[$i][1]."&tree=".$upq[$i][2]."'>iptal et</a></td>
					</tr>";
				}
			}
			echo '</table>';
			for ($i=0; $i<count($upq); $i++)
				echo "<script type='text/javascript'> var id=new Array(50); timer('upq".$i."', 'town.php?town=".$_GET["town"]."'); </script>";
		}
		else
			echo "</br></br><b>Herhangi Bir Asker Yükseltme İşlemi Yok!</b></br></br>";
		echo "</td></tr></table><br /><hr /></br>";	
		
?>