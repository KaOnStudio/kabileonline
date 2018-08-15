<?php 
	include "include/ronarazoro.php"; 
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

	if (isset($_POST["x"], $_POST["y"])) {
		$x=clean($_POST["x"]); 
		$y=clean($_POST["y"]);
	}
	else {
		$x=rand(0, 49); 
		$y=rand(0, 49);
	}
	$data = map($x, $y);
	$sector = sector($x, $y);
	
	$i = 0;
?>
<div align="left">
	<div class="mapBackground">
		<div style="position:absolute; margin-left:600px; margin-top:10px; z-index:100;"><a href="#" onclick="kapatMap('content');"><img src="include/images/1/close.png" title="Kapat" alt="X" /></a></div>
	</div>
	<div style='position:relative; top:0px; left:160px;'>
		<?php
		for ($k = 3; $k >= -3; $k--)
		{
			$st_x = ($k + 3) * 40;
			$st_y = (3 - $k) * 20;
			?>
			<div style='position:absolute;left:<?php echo $st_x; ?>px; top:<?php echo $st_y; ?>px; width:50px;'><?php echo $y+$k; ?></div>
			<?php
		}
		for ($j = -3; $j <= 3; $j++)
		{
			$st_x = ($j + 3) * 40;
			$st_y = 160 + ($j + 3) * 20;
			?>
			<div style='position:absolute;left:<?php echo $st_x; ?>px; top:<?php echo $st_y; ?>px; width:50px;'><?php echo $x+$j; ?></div>
			<?php
		}
		?>
	</div>
	<div style="position:relative; top:-30px; left:180px;">
		<?php
		for ($k = 3; $k >= -3; $k--)
		{
			for ($j = -3; $j <= 3; $j++)
			{
				$st_x = ($k + 3) * 40 + ($j + 3) * 40;
				$st_y = (3 - $k) * 20 + ($j + 3) * 20;
				?>
				<img style='position:absolute; left:<?php echo $st_x; ?>px; top:<?php echo $st_y; ?>px; width:80px; height:80px;' <?php map_img($data, $x+$j, $y+$k, $i, $imgs); ?> >
				<?php
			}
		}
		?>
		<img src="include/images/map/map_back.gif" border="0" usemap="#Map" style='position:absolute; left:0px; top:41px; width:560px; height:280px;' >
		<map name="Map" id="Map">
			<?php
			$i = 0;
			for ($k = 3; $k >= -3; $k--)
			{
				for ($j = -3; $j <= 3; $j++)
				{
					$st_x = ($k + 3) * 40 + ($j + 3) * 40;
					$st_y = (3 - $k) * 20 + ($j + 3) * 20;
					$coords = ($st_x + 40) . ',' . $st_y . ',' . ($st_x + 80) . ',' . ($st_y + 20) . ',' . ($st_x + 40) . ',' . ($st_y + 40) . ',' . $st_x . ',' . ($st_y + 20);
					?>
					<area shape="poly" coords='<?php echo $coords; ?>' <?php map_lnk($data, $x+$j, $y+$k, $i); ?>>
					<?php
				}
			}
			if(($y+3) < 49) 
			{ 	?>
				<area shape="circle" coords='482,38,15' href="javascript: template('map_.php', '<?php echo "x=".$x."&y=".($y+1); ?>')" title="Kuzey">
				<?php
			}
			if(($y-3) > 0) 
			{ 	?>
				<area shape="circle" coords='77,241,15' href="javascript: template('map_.php', '<?php echo "x=".$x."&y=".($y-1); ?>')" title="Güney">
				<?php
			}
			if(($x+3) < 49) 
			{	?>
				<area shape="circle" coords='482,241,15' href="javascript: template('map_.php', '<?php echo "x=".($x+1)."&y=".$y; ?>')" title="Doğu">
				<?php
			}
			if(($x-3) > 0) 
			{	?>
				<area shape="circle" coords='77,38,15' href="javascript: template('map_.php', '<?php echo "x=".($x-1)."&y=".$y; ?>')" title="Batı">
				<?php
			}
			?>
		</map>
	</div>
	<div class="mapBackground2">
		<div style="margin-left:400px; margin-top:10px">
			<input type="text" id="x" size="2" value="<?php echo $x; ?>" style="width:40px; height:25px;">
			<input type="text" id="y" size="2" value="<?php echo $y; ?>" style="width:40px; height:25px;">
			<input type="button" onClick="map()" value="<?php echo $lang['go'] ?>" style="width:40px; height:25px;">
			</br>
		</div>
		<div style="margin-left:300px;">
			<label id='xmenu' style="font-family: 'Comic Sans MS', cursive;">&nbsp;</label>
		</div>
		<div id="descriptor" style="margin-left:50px; margin-top:5px; font-family: 'Comic Sans MS', cursive;">
		<!--
			<table class='q_table_desc' style='border:none' width='800' border='0'>
				<tr style='height:30px'>
					<td width='230' align='center'><b><?php echo $lang['description'] ?></b></td>
					<td width='80' align='right'><b><?php echo $lang['player'] ?> : </b></td><td width='125' align='left'>&nbsp;</td>
					<td width='80' align='right'><b><?php echo $lang['population'] ?> : </b></td width='80' align='left'><td>&nbsp;</td>
					<td width='80' align='right'><b><?php echo $lang['alliance'] ?> : </b></td><td width='125' align='left'>&nbsp;</td>
				</tr>
			</table>
		-->
		</div>
	</div>
	

	
</div>