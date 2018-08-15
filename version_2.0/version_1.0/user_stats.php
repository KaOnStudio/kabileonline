<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
	$_GET["town"]=clean($_GET["town"]);
	if (isset($_POST["col"])) 
		$col=clean($_POST["col"]); 
	else if (isset($_GET["col"])) 
		$col=clean($_GET["col"]); 
	else 
		$col="population";
	if (isset($col))
	{
		$user_stats=user_stats($col);
		if (isset($_POST["id"]))
		{
			$_POST["id"]=clean($_POST["id"]);
			$_POST["id"] = $_POST["id"] - 1;
			if ($_POST["id"] < 0) 
				$_POST["id"] = 0;
			$_POST["id"]=preg_replace("/[^0-9]/","", $_POST["id"]);
			if ($_POST["id"] < count($user_stats)) 
				$id=$_POST["id"];
			else msg("Böyle bir sira yok...");
		}
		else if (isset($_GET["id"]))
		{
			if ($_GET["id"] < 0) 
				$_GET["id"] = 0;
			$_GET["id"]=preg_replace("/[^0-9]/","", $_GET["id"]);
			if (($_GET["id"] < count($user_stats))&&($_GET["id"] >= 0)) 
				$id=$_GET["id"];
			else if ($_GET["id"] >= count($user_stats))
			{
				if(count($user_stats) < 10)
					$id = 0;
				else
					$id=count($user_stats)-10;
			}
		}
		else if (isset($_POST["value"]))
		{
			$_POST["value"]=clean($_POST["value"]);
			$id=0;
			for ($i=0; (($i<count($user_stats))&&(!$id)); $i++) 
				if ($user_stats[$i][1]==$_POST["value"]) 
					$id=$i;
		}
		else
		{
			$id=0;
			for ($i=0; (($i<count($user_stats))&&(!$id)); $i++) 
				if ($user_stats[$i][0]==$_SESSION["user"][0]) 
					$id=$i;
		}
	}
} 
else 
{
	header('Location: login.php'); die();
}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['userStats'] ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>
    <table class="q_table">
      <tr>
        <td class="td_logo">
		<?php logo($title); ?></td>
      </tr>
      <tr>
        <td class="td_top_menu"><?php menu_up(); ?></td>
      </tr>
      <tr>
        <td class="td_content">
<a class='q_link' href='town_stats.php?town=<?php echo $_GET["town"]; ?>'><?php echo $lang['townStats'] ?></a> | <?php echo $lang['playerStats'] ?> | <a class='q_link' href='alliance_stats.php?town=<?php echo $_GET["town"]; ?>'><?php echo $lang['allyStats'] ?></a></br></br>
<!--
<form name='form1' method='post' action='user_stats.php?town=<?php// echo $_GET["town"]; ?>'>
<?php// echo $lang['viewStatsFor'] ?>
<select class='dropdown' name='col'><option value='population'><?php// echo $lang['population'] ?></option><option value='upkeep'><?php// echo $lang['upkeep'] ?></option></select>
<input class='button' type='submit' name='button1' value='<?php// echo $lang['view'] ?>'>
</form>
-->

<table class="q_table" style="border-collapse: collapse" width="400" border="1">
	<tr>
	  <td><?php echo $lang['nom']; ?></td>
	  <td><?php echo $lang['player']; ?></td>
	  <td><?php echo "Puan"; ?></td>
	</tr>
<?php
if (isset($col))
{
	for ($i=$id; (($i<$id+10)&&($i<count($user_stats))); $i++) 
	{
		$siralama = $i + 1;
		echo "<tr><td>".$siralama."</td><td><a class='q_link' href='profile_view.php?id=".$user_stats[$i][0]."'>".$user_stats[$i][1]."</a></td><td>".$user_stats[$i][2]."</td></tr>";
	}
}
?>
</table>

<form name='form2' method='post' action='user_stats.php?town=<?php echo $_GET["town"]; ?>'>
<?php echo $lang['jumpToNo'] ?>
<input class='textbox' type='text' size='5' name='id' value='<?php if (isset($col)) echo $id+1; ?>'>
<!--
<?php// echo $lang['for'] ?>
<select class='dropdown' name='col'><option value='population'><?php// echo $lang['population'] ?></option><option value='upkeep'><?php// echo $lang['upkeep'] ?></option></select>
-->
<input class='button' type='submit' name='button2' value='<?php echo $lang['go'] ?>'>
</form>

<form name='form3' method='post' action='user_stats.php?town=<?php echo $_GET["town"]; ?>'>
<?php echo $lang['jumpToUser'] ?>
<input class='textbox' type='text' size='15' name='value' value='<?php if (isset($_POST["value"])) echo $_POST["value"]; ?>'>
<!--
<?php// echo $lang['for'] ?>
<select class='dropdown' name='col'><option value='population'><?php// echo $lang['population'] ?></option><option value='upkeep'><?php// echo $lang['upkeep'] ?></option></select>
-->
<input class='button' type='submit' name='button3' value='<?php echo $lang['go'] ?>'>
</form>

<?php 
if (isset($id)) 
	echo "<a class='q_link' href='user_stats.php?town=".$_GET["town"]."&col=".$col."&id=".($id-10)."'><<</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a class='q_link' href='user_stats.php?town=".$_GET["town"]."&col=".$col."&id=".($id+10)."'>>></a>"; 
?>
		</td>
      </tr>
      <tr>
        <td class="td_bottom_menu">
          <?php menu_down(); ?>
        </td>
      </tr>
    </table>
<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>