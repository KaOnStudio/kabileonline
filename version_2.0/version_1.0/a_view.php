<?php include "antet.php"; include "func.php";

if (isset($_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
 $alliance=alliance_all($_GET["id"]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title." - ".$lang['allyView']; ?></title>
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
<?php
	 echo $lang['members'].": </br>";
	 for ($i=0; $i<count($alliance[1])-1; $i++) echo "<a class='q_link' href='profile_view.php?id=".$alliance[1][$i][0]."'>".$alliance[1][$i][1]."</a> - ".$alliance[1][$i][14]."</br>";
	 echo "</br>".$lang['peacePacts'].": ";
	 for ($i=0; $i<count($alliance[2])-1; $i++)
	 {
	  $a1=alliance($alliance[2][$i][1]);
	  $a2=alliance($alliance[2][$i][2]);
	  echo $a1[1]."-".$a2[1]."</br>";
	 }
	 echo "</br>".$lang['warDeclar'].": ";
	 for ($i=0; $i<count($alliance[3])-1; $i++)
	 {
	  $a1=alliance($alliance[3][$i][1]);
	  $a2=alliance($alliance[3][$i][2]);
	  echo $a1[1]."-".$a2[1]."</br>";
	 }
	 echo "
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
            <p>".$lang['allyName'].":
            <input type='text' class='textbox' name='name' value='".$alliance[0][1]."' readonly='true'></p>
			<p>".$lang['allyDesc'].":</p>
            <p><textarea class='textbox' name='desc' cols='40' rows='7' readonly='true'>".$alliance[0][3]."</textarea></p>
		  </td></tr>
		  </table>";
?>
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