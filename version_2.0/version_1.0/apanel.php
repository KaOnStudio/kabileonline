<?php include "antet.php"; include "func.php";
$config=config();
if ($_SESSION["user"][4]<3) {msg($lang['notAdmin']); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script type="text/javascript">
function dat()
{
 data=new Array(<?php for ($i=0; $i<count($config)-1; $i++) echo $config[$i][1].", "; echo $config[count($config)-1][1]; ?>);
 document.getElementById("v").value=data[document.getElementById("c").selectedIndex];
}
</script>
<head>
<title><?php echo $title; ?> - <?php echo $lang['adminPanel'] ?></title>
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
	  <form name="form" method="post" action="config.php">
	  <?php echo $lang['variable'] ?> <select class='dropdown' id="c" name="var" onChange="dat();">
	  <?php for ($i=0; $i<count($config); $i++) echo "<option class='option' value='".$config[$i][0]."'>".$config[$i][0]."</option>"; ?>
	  </select>
	  <?php echo $lang['value'] ?><input type="text" class="textbox" id="v" name="val" size="3" value="<?php echo $config[0][1]; ?>">
	  <?php echo $lang['password'] ?><input type="password" name="pass" class="textbox">
	  <input type="submit" name="button" class="button" value="<?php echo $lang['change'] ?>">
	  </form></br>
	  <a class='q_link' href='send_to_all.php'><?php echo $lang['sendToAll'] ?></a> | </br>
	  <a class='q_link' href='del_u.php'><?php echo $lang['deleteUser'] ?></a> | </br>
	  <a class='q_link' href='check_d_all.php'><?php echo $lang['checkDelQueue'] ?></a> | </br>
	  <a class='q_link' href='clean_u.php'><?php echo $lang['cleanIdle'] ?></a> | </br>
	  <a class='q_link' href='level.php'><?php echo $lang['userLevel'] ?></a> | </br>
	  <a class='q_link' href='g_points.php'><?php echo $lang['givePoints'] ?></a> | </br>
			
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
