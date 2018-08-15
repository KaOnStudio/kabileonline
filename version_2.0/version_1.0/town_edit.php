<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['townEdit'] ?></title>
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
		<form name="form1" method="post" action="town_edit_.php?town=<?php echo $_GET["town"]; ?>">
		  <p><?php echo $lang['townName'] ?>: 
		    <input class='textbox' type="text" name="name" value="<?php echo $town[2]; ?>">
          </p>
		  <p><?php echo $lang['description'] ?>: 
		    <textarea class='textbox' name="desc" cols="45" rows="5"><?php echo $town[14]; ?></textarea>
		  </p>
		  <p>
		    <input class='button' type="submit" name="button" value="<?php echo $lang['save'] ?>">
		  </p>
		</form>
		<p align="center">&nbsp;</p>
      </td>
	</tr>
	<tr>
		<td class="td_bottom_menu">
		<?php menu_down(); ?></td>
	</tr>
</table>

<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>