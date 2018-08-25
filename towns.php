<?php
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$thistown = town($_GET["town"]); 
		if ($thistown[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$towns=towns($_SESSION["user"][0]);
		$twnCount=count($towns);
		
		$land=get_land();
		$xy=$land[rand(0, count($land)-1)];
		$is_cap=0; 
		$data=explode("-", $towns[0][8]);
		$army=explode("-", $towns[0][7]);
	}
	else {
		git('index.php'); die();
	}	
	?>
		<div id="townsForm">
			[<a href='#' onclick="ac('createTownForm'); kapat('townsForm');"><?php echo $lang['createTown']; ?></a>]
			<br /><hr /><br /><table style='text-align:center; margin-left:200px;'><tr><td>
	          <table style="margin-left:-160px; border-collapse:collapse; " border="1">
	            <tr style="text-align:center; background:#f0d59c;  height:50px;">
	              <td style="width:160px;"><?php echo $lang['townName'] ?></td>
	              <td style="width:100px;"><?php echo $lang['population'] ?></td>
	              <td style="width:350px;" colspan="3">İşlemler</td>
	            </tr>
	            <?php 
					for ($i=0; $i<$twnCount; $i++)
					{
						$town=town_xy($towns[$i][0]); 
						echo "<tr style='text-align:center; height:40px;'>
						<td>".$towns[$i][2]."</td>
						<td>".$towns[$i][3]."</td>";
						
						
						if($thistown[0] == $towns[$i][0]) echo "<td>burdasın</td>";
						else echo "<td><a href='town.php?town=".$towns[$i][0]."'>kabileye git</a></td>";
						
						if($towns[$i][4] == 1) echo "<td colspan='2'>başkent</td>";
						else { 
							echo "<td><a href='ch_capital_.php?town=".$towns[$i][0]."'>başkent yap</a></td>";
							echo "<td><a href='purge.php?town=".$towns[$i][0]."'>kabileyi boşalt</a></td>";
						}
						
						echo "</tr>";
					} 
				?>
	          </table>
			</td></tr></table><br /><hr /></br> 
		</div>

		<div id="createTownForm" style="display:none;">
		[<a href='#' onclick="ac('townsForm'); kapat('createTownForm');"><?php echo $lang['towns']; ?></a>]
		<br /><hr /><br /><table style='text-align:center; margin-left:150px;'><tr><td style="text-align:center;">
		<?php
			$ready=1;
			if ($data[7]<10) {
				echo $lang['needCastle']."<br /><br />";  $ready=0; }
			if ($army[11]<50) {
				echo $lang['needColonists']."<br /><br />"; $ready=0; }
			if($ready)
			{
		?>
			<form name="form1" method="post" action="create_.php?is_cap=<?php echo $is_cap; ?>">
				<input name="x" id="x" type="hidden" value="<?php echo $xy[0]; ?>">
				<input name="y" id="y" type="hidden" value="<?php echo $xy[1]; ?>">
				<p>Kabilenin İsmi: 
					<input name="name" type="text" size="25" value="<?php echo $_SESSION["user"][1]; ?> kabilesi">
					<input type="submit" name="go" value="<?php echo $lang['create'] ?>" style="width:100px; height:30px;">
				</p>
			</form>
		<?php
			}
		?>
		</td></tr></table><br /><hr /></br>
		</div> 
		  
		  
		  
		  
		
