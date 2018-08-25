<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0]))
{
	$land=get_land();
	$xy=$land[rand(0, count($land)-1)];
	$towns=towns($_SESSION["user"][0]);
	if (count($towns))
	{
		$is_cap=0; 
		$data=explode("-", $towns[0][8]); 
		$army=explode("-", $towns[0][7]);
		if ($data[7]<10) 
			msg($lang['needCastle']);
		if ($army[11]<10) 
			msg($lang['needColonists']);
	}
	else 
		$is_cap=1;
}
else 
{
	header('Location: login.php'); die();
}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type="text/javascript"></script>

<head>
<title><?php echo $title; ?> - <?php echo $lang['createTown'] ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>

<table class="q_table">
	<tr>
		<td class="td_logo">
			<?php logo($title); ?>
		</td>
	</tr>
	<tr>
		<td class="td_top_menu">
			<?php menu_up(); ?>
		</td>
	</tr>
	<tr>
	  <td class="td_content">
	  <form name="form1" method="post" action="create_.php?is_cap=<?php echo $is_cap; ?>">
	    <p><?php echo $lang['desCoord'] ?>:
            <input class="textbox" name="x" id="x" type="text" size="5" value="<?php echo $xy[0]; ?>">
            <input class="textbox" name="y" id="y" type="text" size="5" value="<?php echo $xy[1]; ?>">
            [<a class='q_link' href="javascript: go('create.php');"><?php echo $lang['random'] ?></a>]
		</p>
	    <p><?php echo $lang['desCapName'] ?>: 
	      <input class="textbox" name="name" type="text" size="25" value="<?php echo $_SESSION["user"][1]; ?> kabilesi">
	    </p>
	    <p>
	      <input class="button" type="submit" name="go" value="<?php echo $lang['create'] ?>">
	    </p>
	  </form>
	  </td>
	</tr>
	<tr>
		<td class="td_bottom_menu">
			<?php menu_down(); ?>
		</td>
	</tr>
</table>

<?php echo $bottom_ad; ?>
<p><?php about(); ?></p>
</div>
</body>
</html>