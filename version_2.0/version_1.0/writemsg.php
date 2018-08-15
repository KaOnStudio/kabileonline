<?php include "antet.php"; include "func.php";

if (!isset($_SESSION["user"][0])) {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['writeMsg'] ?></title>
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
        <form name="form1" method="post" action="writemsg_.php">
          <p><?php echo $lang['recipient'] ?>:
										  <input class='textbox' name="recipient" type="text" id="recipient" value="<?php if (isset($_GET["id"])) {$usr=user($_GET["id"]); echo $usr[1];} else if (isset($_GET["name"])) echo clean($_GET["name"]); else if (isset($_GET["msg"])) {$msg=message(clean($_GET["msg"])); $usr=user($msg[1]); echo $usr[1];} ?>">
          </p>
          <p><?php echo $lang['subject'] ?>: 
            <input class='textbox' name="subject" type="text" size="45" value="<?php if (isset($_GET["msg"])) {$msg=message(clean($_GET["msg"])); echo $msg[3];} else echo "no_subject"; ?>">
          </p>
          <p>
            <textarea class='textbox' name="contents" cols="60" rows="20"><?php if (isset($_GET["msg"])) {$msg=message(clean($_GET["msg"])); echo "\r\n\r\n[".$msg[5]."]\r\n".$msg[4];} ?></textarea>
          </p>
          <p>
            <input class='button' type="submit" name="button" value="<?php echo $lang['send'] ?>">
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
<p><?php about(); ?></div>

</body>

</html>