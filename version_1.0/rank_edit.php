<?php include "antet.php"; include "func.php";

?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['editRanks'] ?></title>
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
        <p align="center">
          <form name='form1' method='post' action='rank_edit_.php'>
            <p><?php echo $lang['playerName']; ?>: 
            <input class='textbox' type='text' name='name'></p>
            <p><?php echo $lang['rank']; ?>: 
            <input class='textbox' type='text' name='rank'></p>
            <p><input class='button' type='submit' name='button1' value='Edit rank'></p>
          </form>
        </p>
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