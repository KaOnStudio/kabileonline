<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
 $town=town($_GET["id"]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['aquireTown'] ?></title>
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
<?php echo $lang['wishAquire'] ?> "<?php echo $town[2]; ?>"?</br></br>
<a class='q_link' href='aquire_.php?id=<?php echo $town[0]; ?>'><?php echo $lang['yes'] ?></a> | <a class='q_link' href='map.php'><?php echo $lang['no'] ?></a>
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
