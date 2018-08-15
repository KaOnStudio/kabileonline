<?php include "antet.php"; include "func.php"; ?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type='text/javascript'></script>
<head>
<title><?php echo $title; ?> - <?php echo $lang['cleanForums']; ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>

<table class="q_table">
	<tr>
		<td class="td_top_menu"><?php menu_up(); ?></td>
	</tr>
	<tr>
	  <td class="td_content">
    <form name="form1" method="post" action="clean_forums_.php">
            <label>
            <br>
            <?php echo $lang['yourPass']; ?>
            <input type="password" name="pass">
            <br><br>
            <input type="submit" name="check" value="<?php echo $lang['cleanForums']; ?>">
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
