<?php include "antet.php"; include "func.php";

$_SESSION = array();
session_destroy();
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<script src="func.js" type="text/javascript"></script>
<head>
<title><?php echo $title; ?> - <?php echo $lang['login'] ?></title>
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
		<table class="q_table" style="border-collapse: collapse" width="624" height="266" border="1">
          <tr>
            <td height="24" align="center" class='head_table'><?php echo $lang['userLogin'] ?></td>
          </tr>
          <tr>
            <td height="234" align="center"><form action="login_.php" method="post" name="form" target="_self">
              <table><tr><td><label><?php echo $lang['username'] ?></label></td>
                <td><input class='textbox' type="text" name="name" id="name"></td></tr>
              <tr><td colspan="2">&nbsp;</td></tr>
              
                <tr><td><label><?php echo $lang['password'] ?></label></td>
                   <td><input class='textbox' type="password" name="pass"></td></tr>
                <tr><td colspan="2">&nbsp;</td></tr>
              
              
                <tr><td><label>&nbsp;</label></td>
                <td><input class='button' type="submit" name="login" value="<?php echo $lang['login'] ?>"></td></tr>
                
              <tr><td colspan="2">&nbsp;</td></tr>
              
              <tr><td colspan="2"><a title='<?php echo $lang['emailPass'] ?>' class='q_link' href='javascript: forgot();'><?php echo $lang['emailPass'] ?></a></td></tr>
              </table>
            </form></td>
          </tr>
        </table>
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