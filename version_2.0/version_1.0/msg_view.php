<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["type"], $_GET["id"]))
{
 $_GET["type"]=clean($_GET["type"]); $_GET["id"]=clean($_GET["id"]);
 if ($_GET["type"]) $msg=message($_GET["id"]);
 else $msg=report($_GET["id"]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['messages'] ?></title>
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
<?php
 if ($_GET["type"])
 {
		$usr=user($msg[1]);
		echo $lang['sender'].": <a class='q_link' href='profile_view.php?id=".$usr[0]."'>".$usr[1]."</a></br></br>";
		$reply="</br></br>[ <a class='q_link' href='writemsg.php?msg=".$msg[0]."'>".$lang['reply']."</a> ]";
 }
 label($msg[2+$_GET["type"]]);
 echo "</br></br>".str_replace("\n", "</br>", $msg[3+$_GET["type"]]).$reply;
 if (strtotime($msg[4+$_GET["type"]])>strtotime($_SESSION["user"][6])) $_SESSION["user"][6]=$msg[4+$_GET["type"]];
?>
   </p>
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