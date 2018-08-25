<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0]));
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - send report to all</title>
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
        <form name="form1" method="post" action="send_to_all_.php">
          <p>Subject: 
            <input class='textbox' name="subject" type="text" size="45">
          </p>
          <p>
            <textarea class='textbox' name="contents" cols="60" rows="20"></textarea>
          </p>
          <p>Your pass:
            <input class='textbox' name="pass" type="password" size="20">
          </p>
          <p>
              <input class='button' type="submit" name="button" value="Send">
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
