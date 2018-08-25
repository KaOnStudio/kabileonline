<?php include "antet.php"; include "func.php";

$gen_stats=gen_stats(48);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['givePoints'] ?></title>
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
	  <form name="form1" method="post" action="g_points_.php">
	    <label>
	    <?php echo $lang['userNamesSeparated']; ?>
	    <input class='textbox' type="text" name="name" size="60">
	    </label>
	    <label>
	    <?php echo $lang['points']; ?>
	    <input class='textbox' type="text" name="q" size="2">
	    </label>
            <label>
            <br>
            <?php echo $lang['yourPass'] ?>
            <input class='textbox' type="password" name="pass">
            <br>
            <input class='button' type="submit" name="gp" value="Give points">
            </label>
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
<p><?php about(); ?></div>

</body>

</html>
