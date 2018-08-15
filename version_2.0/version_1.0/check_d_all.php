<?php include "antet.php"; include "func.php"; ?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['checkDelQueue'] ?></title>
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
    <form name="form1" method="post" action="check_d_all_.php?value=1">
            <label>
            <br>
            <?php echo $lang['yourPass'] ?>
            <input class="textbox" type="password" name="pass">
            <br><br>
            <input class="button" type="submit" name="check" value="<?php echo $lang['checkDelQueue'] ?>">
            </label>
	  </form>
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
