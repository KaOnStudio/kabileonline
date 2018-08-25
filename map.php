<?php
	include "include/ronarazoro.php";
	include "include/html/panel.html";
?> 

<div style="position:absolute; margin-left:740px; margin-top:10px; z-index:100;"><a href="town.php?town=<?php echo $_GET["town"]; ?>"><img src="include/images/1/pending.gif" title="Kapat" alt="X" /></a></div>

<div class="content" id="content">
	<?php
	if (isset($_GET["x"], $_GET["y"])) {
		$x=clean($_GET["x"]); 
		$y=clean($_GET["y"]);
	}
	else if (isset($_POST["x"], $_POST["y"])) {
		$x=clean($_POST["x"]); 
		$y=clean($_POST["y"]);
	}
	else if (isset($_GET["town"]))
	{
		$town=clean($_GET["town"]);
		$loc = town_xy($town);
		$x = $loc[0]; $y=$loc[1];
	}
	else if (isset($_SESSION["user"][0]))
	{
		$towns = towns($_SESSION["user"][0]); 
		$loc = town_xy($towns[0][0]);
		$x = $loc[0]; $y=$loc[1];
	}
	else {
		$x=rand(0, 49); 
		$y=rand(0, 49);
	}
	echo "<script type='text/javascript'> template('map_.php', 'x=".$x."&y=".$y."'); </script>";
	?>
</div>
<?php 
	include "include/html/footer.html";
?>