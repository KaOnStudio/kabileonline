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
		$cq=get_c($_GET["town"]);
		$data = explode("-", $town[8]); 
		$land = explode("/", $town[13]); 
		$land[0] = explode("-", $land[0]); 
		$land[1] = explode("-", $land[1]); 
		$land[2] = explode("-", $land[2]); 
		$land[3] = explode("-", $land[3]);
	}
	else {
		git('index.php'); die();
	}	
				
		echo "<br /><hr /><br /><table style='text-align:center; margin-left:230px;'><tr><td>";
		if(count($cq)) {
			echo '<table style="margin-left:-160px; border-collapse:collapse; " border="1">';
			echo '<tr style="text-align:center; background:#f0d59c;  height:50px;">';
			echo '<td style="width:160px;">Bina</td>';
			echo '<td style="width:100px;">Seviye</td>';
			echo '<td style="width:150px;">Kalan Süre</td>';
			echo '<td style="width:100px;">&nbsp;</td>';
			echo '</tr>';
			
			for ($i=0; $i<count($cq); $i++)
			{
				$eksisorunu = explode(":", $cq[$i][0]);
				if($eksisorunu[0][0] == "-") {
					echo "<script> window.location = 'town.php?town=".$town[0]."&hata=insaq'; </script>";
				}
				else
				{
					$name=explode("-", $buildings[$cq[$i][1]][2]);
					if ($cq[$i][2]>-1)
					{
						$s=1; $l=$land[$cq[$i][1]][$cq[$i][2]]+1;
					}
					else
					{
						$s=0; $l=$data[$cq[$i][1]]+1;
					}
					echo "<tr style='text-align:center; height:40px;'>
						<td> ".$name[$s]."</td>
						<td>".($l+1)."</td>
						<td><span id='cq".$i."'>".$cq[$i][0]."</span></td>
						<td><a class='q_link' href='cancel_c.php?town=".$_GET["town"]."&b=".$cq[$i][1]."&subB=".$cq[$i][2]."'>iptal et</a></td>
						</tr>";
				}
			}
			echo '</table>';
			for ($i=0; $i<count($cq); $i++)
				echo "<script type='text/javascript'> var id=new Array(50); timer('cq".$i."', 'town.php?town=".$_GET["town"]."'); </script>";
		}
		else
			echo "</br></br><b>İnşa Halinde Bir Binanız Yok!</b></br></br>";
		echo "</td></tr></table><br /><hr /></br>";		
			
?>