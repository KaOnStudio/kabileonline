<?php include "antet.php"; include "func.php"; ?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<script src="func.js" type='text/javascript'></script>
<head>
<title><?php echo $title; ?> - <?php echo $lang['home'] ?></title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>
    <table class="q_table">
      <tr>
        <td class="td_logo"><?php logo($title); ?></td>
      </tr>
      <tr>
        <td class="td_top_menu">
	<?php menu_up(); ?>
	</td>
      </tr>
      <tr>
        <td class="td_content" id="content" align="left" valign="top"></td>
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
<?php
if (isset($_GET["x"], $_GET["y"])) {$x=clean($_GET["x"]); $y=clean($_GET["y"]);}
else if (isset($_POST["x"], $_POST["y"])) {$x=clean($_POST["x"]); $y=clean($_POST["y"]);}
else if (isset($_SESSION["user"][0]))
{
 $towns=towns($_SESSION["user"][0]); $loc=town_xy($towns[0][0]);
 $x=$loc[0]; $y=$loc[1];
}
else {$x=rand(0, $m); $y=rand(0, $n);}
echo "<script type='text/javascript'> template('map_.php', 'x=".$x."&y=".$y."'); </script>";
?>