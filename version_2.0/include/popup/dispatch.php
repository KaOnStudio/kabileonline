<?php 
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		check_a($_GET["town"]);
		$town=town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]);
		$units=units($faction[0]);
		$aq=get_a($town[0]);

		$data=explode("-", $town[8]); $army=explode("-", $town[7]); $gen=explode("-", $town[15]);
		if (isset($_GET["target"])) {
			$target=town($_GET["target"]); $target=$target[2];
		} 
		else 
			$target="";
	}
	else {
		git('../../index.php'); die();
	}

		//echo "[<a class='q_link' href='gen.php?town=".$_GET["town"]."'>".$lang['general']."</a>]";
		echo "<form name='dispatch' method='post' action='sendt.php?town=".$_GET["town"]."'>";	
		
		echo "<table class='q_table' style='border-collapse: collapse; text-indent: 0; margin-left:10px; text-align: center;' width='600' border='1'><tr>";
		for ($i=0; $i<count($units); $i++) 
			if($army[$i]!=0 and $i!=9 and $i!=10)
				echo "<td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></td>";
		echo "</tr><tr>";
		for ($i=0; $i<count($army); $i++)
			if($army[$i]!=0 and $i!=9 and $i!=10)
				echo "<td><a href='#' onclick=\"valueVer('q_".$i."','".$army[$i]."')\">".$army[$i]."</a></td>";
		echo "</tr><tr>";
		for ($i=0; $i<count($army); $i++)
			if($army[$i]!=0 and $i!=9 and $i!=10)
				echo "<td><input id='q_".$i."' name='q_".$i."' type='text' style='width:40px;' value='0'></td>";
		echo "</tr></table>";
		
		//if (!$gen[1]) echo($lang['noGeneral']); 
		//else if (!$gen[0]) echo($lang['generalAway']);
			
		echo "</br><table class='q_table' style='border-collapse: collapse; text-indent: 0; text-align: center;' width='500' border='0'>";
		?>
		<tr style="height:30px;"><td style="text-align:right;">Ordunu Hangi Kabileye Gönderiyorsun : </td><td><input name='target' type='text' style="width:150px;" value="<?php echo $target; ?>"></td></tr>
		<tr style="height:30px;"><td style="text-align:right;">Ordunu Hangi Amaçla Gönderiyorsun : </td><td><select class='dropdown' name='type' style="width:150px;">
			<option value='1'><?php echo $lang['raid']; ?></option>
			<option value='2'><?php echo $lang['attack']; ?></option>
			<option value='3'><?php echo $lang['spy']; ?></option>
			<option value='0'><?php echo $lang['reinforce']; ?></option>
		</select></td></tr>
		<!--
		<tr style="height:30px;"><td style="text-align:right;">Generalin Orduyla Gitsin Mi? : </td><td><select class='dropdown' name='general' style="width:150px;">
			<option value='0'>Hayır Gitmesin</option>
			<option value='1'>Evet Gitsin</option>
		</select></td></tr>
		-->
		<tr style="height:30px;"><td style="text-align:right;">Ordun Hangi Düzenle Savaşsın : </td><td><select class='dropdown' name='formation' style="width:150px;">
			<option value='0'><?php echo $lang['standard']; ?></option>
			<option value='1'><?php echo $lang['offensive']; ?></option>
			<option value='2'><?php echo $lang['defensive']; ?></option>
		</select></td></tr>
		
		<tr style="height:30px;"><td></td><td><input type='submit' name='button0' value='<?php echo $lang['send']; ?>' style="width:100px;"  ></td></tr>
		</table>
		</form>
		</br>