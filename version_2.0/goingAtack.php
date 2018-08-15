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
		$iaq=get_ia($_GET["town"]);
		$aq=get_a($town[0]);
		$data = explode("-", $town[8]); 
	}
	else {
		git('index.php'); die();
	}	
				
		echo "<br /><hr /><br /><table style='text-align:center; margin-left:230px;'><tr><td>";
		if(count($aq)) {
			echo '<table style="margin-left:-160px; border-collapse:collapse; " border="1">';
			echo '<tr style="text-align:center; background:#f0d59c;  height:50px;">';
			echo '<td style="width:160px;">Hedef</td>';
			echo '<td style="width:100px;">Amaç</td>';
			echo '<td style="width:150px;">Kalan Süre</td>';
			echo '<td style="width:100px;">&nbsp;</td>';
			echo '</tr>';
			
			for ($i=0; $i<count($aq); $i++)
			{
				$eksisorunu = explode(":", $aq[$i][0]);
				if($eksisorunu[0][0] == "-") {
					echo "<script> window.location = 'town.php?town=".$town[0]."&hata=gatackq'; </script>";
				}
				else
				{
					$tget=town($aq[$i][1]);
					switch($aq[$i][2])
					{
						case 0: $what=$lang['reinforce']; break;
						case 1: $what=$lang['raid']; break;
						case 2: $what=$lang['attack']; break;
						case 3: $what=$lang['spy']; break;
					}
					
					echo "<tr style='text-align:center; height:40px;'>
					<td> ".$tget[2]."</td>
					<td>".$what."</td>
					<td><span id='aq".$i."'>".$aq[$i][0]."</span></td>
					<td><a class='q_link' href='cancel_a.php?town=".$_GET["town"]."&id=".$aq[$i][5]."'>iptal et</a></td>
					</tr>";
				}
			}
			echo '</table>';
			for ($i=0; $i<count($aq); $i++)
				echo "<script type='text/javascript'> var id=new Array(50); timer('aq".$i."', 'town.php?town=".$_GET["town"]."'); </script>";
		}
		else
			echo "</br></br><b>Kabilenizden Çıkan Bir Ordu Yok!</b></br></br>";
		echo "</td></tr></table><br /><hr /></br>";		
		
		/*
		/////////////////////////////////////////////     GELEN  GİDEN SALDIRILAR  //////////////
		if (count($iaq)) 
		for ($i=0; $i<count($iaq); $i++)
		{
		$twn=town($iaq[$i][1]);
		$tget=town($iaq[$i][2]);
		switch($iaq[$i][3])
		{
			case 0: $what=$lang['reinforce']; break;
			case 1: $what=$lang['raid']; break;
			case 2: $what=$lang['attack']; break;
			case 3: $what=$lang['spy']; break;
		}
		if (!$iaq[$i][4]) 
			$what=$lang['from']." ".$twn[2]." ".$lang['to']." ".$what; 
		else 
			$what=$lang['returnFrom']." ".$what." ".$lang['on']." ".$tget[2];
			
		echo $what." - <span id='it".$i."'>".$iaq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('it".$i."', 'town.php?town=".$_GET["town"]."'); </script></br>";
		}
		///////////////////////////////////////////////////////////////////////////////////////
		*/		
?>