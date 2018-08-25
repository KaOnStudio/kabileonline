<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $_SESSION["user"]=user($_SESSION["user"][0]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $buildings=buildings($_SESSION["user"][10]);
 if ($_SESSION["user"][11]) $alliance=alliance_all($_SESSION["user"][11]);
 if ((isset($alliance))&&(!$alliance[0][0])) {a_quit($_SESSION["user"][0]); $_SESSION["user"][11]=0;}

 $data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<script src="func.js" type="text/javascript"></script>
<script type="text/javascript">
var prev="";
var tabLinks = new Array();
var contentDivs = new Array();
</script>

<head>
<title><?php echo $title." - ".$buildings[9][2]; ?></title>
</head>

<body class="q_body" onLoad="inittabs();">

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
		<td class="td_content" id="content">
<?php
if ($data[9])
{
		echo $buildings[9][8]."</br></br></br>";
	 if (!$_SESSION["user"][11])
		echo "<form name='form1' method='post' action='a_create.php?town=".$_GET["town"]."'>
       ".$lang['allyName'].": 
        <input class='textbox' type='text' name='name'>
        <input class='button' type='submit' name='button1' value='".$lang['create']."'>
        </form></br>";
	else if ($alliance[0][2]==$_SESSION["user"][0])
	{
	 echo "</br></br>[ <a class='q_link' href='rank_edit.php'>".$lang['editRanks']."</a> ]</br></br>";
	 echo $lang['members'].":</br>";
	 for ($i=0; $i<count($alliance[1])-1; $i++) echo "[<a class='q_link' href='a_kick.php?id=".$alliance[1][$i][0]."'>x</a>] <a class='q_link' href='profile_view.php?id=".$alliance[1][$i][0]."'>".$alliance[1][$i][1]."</a> - ".$alliance[1][$i][14]."</br>";
	 echo "</br>".$lang['peacePacts'].":</br>";
	 for ($i=0; $i<count($alliance[2])-1; $i++)
	 {
	  $a1=alliance($alliance[2][$i][1]);
	  $a2=alliance($alliance[2][$i][2]);
	  echo "[<a class='q_link' href='dis_peace.php?a1=".$a1[0]."&a2=".$a2[0]."'>x</a>] ".$a1[1]."-".$a2[1]."</br>";
	 }
	 echo "</br>".$lang['warDecs'].":</br>";
	 for ($i=0; $i<count($alliance[3])-1; $i++)
	 {
	  $a1=alliance($alliance[3][$i][1]);
	  $a2=alliance($alliance[3][$i][2]);
	  echo $a1[1]."-".$a2[1]."</br>";
	 }
	 echo "<ul id='tabs'>
	    <li><a href='#invite'>".$lang['invite']."</a></li>
	    <li><a href='#proposePeace'>".$lang['proposePeace']."</a></li>
	    <li><a href='#decWar'>".$lang['decWar']."</a></li>
	    <li><a href='#allyName'>".$lang['allyName']."</a></li>
	    <li><a href='#delAlly'>".$lang['delAlly']."</a></li>
	</ul>
	<div class='tabContent' id='invite'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
          <form name='form2' method='post' action='invite.php?town=".$_GET["town"]."'>
            <p>".$lang['playerName'].": 
            <input class='textbox' type='text' name='name'>
            <input class='button' type='submit' name='button2' value='".$lang['invite']."'></td></tr></p>
		  </form>
		  </table>
		 </div>
	</div>
	<div class='tabContent' id='proposePeace'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
          <form name='form3' method='post' action='pact.php?type=0&town=".$_GET["town"]."'>
            <p>".$lang['allyName'].": 
            <input class='textbox' type='text' name='name'>
            <input class='button' type='submit' name='button3' value='".$lang['proposePeace']."'></td></tr></p>
		  </form>
		  </table>
		 </div>
	</div>
	<div class='tabContent' id='decWar'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
          <form name='form4' method='post' action='pact.php?type=1&town=".$_GET["town"]."'>
            <p>".$lang['allyName'].": 
            <input class='textbox' type='text' name='name'>
            <input class='button' type='submit' name='button4' value='".$lang['decWar']."'></td></tr></p>
		  </form>
		  </table>
		 </div>
	</div>
	<div class='tabContent' id='allyName'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
		  <form name='form5' method='post' action='a_edit.php?town=".$_GET["town"]."'>
            <p>".$lang['allyName'].": 
            <input class='textbox' type='text' name='name' value='".$alliance[0][1]."'></p>
			<p>".$lang['allyDesc'].":</p>
            <p><textarea class='textbox' name='desc' cols='45' rows='7'>".$alliance[0][3]."</textarea></p>
            <p><input class='button' type='submit' name='button5' value='".$lang['save']."'></p>
          </form>
		  </td></tr>
		  </table>
		 </div>
	</div>
	<div class='tabContent' id='delAlly'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
		  <form name='form6' method='post' action='a_del.php'>
            <p>".ucfirst($lang['password']).": 
            <input class='textbox' type='password' name='pass'>
            <input class='button' type='submit' name='button6' value='".$lang['delAlly']."'></p>
          </form>
		  </td></tr>
		  </table>
		 </div>
	</div>";
	}
	else
	{
	 echo "[ <a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=0', '', '')\">".$lang['forum']."</a> ]</br></br>".$lang['members'].":</br>";
	 for ($i=0; $i<count($alliance[1])-1; $i++) echo "<a class='q_link' href='profile_view.php?id=".$alliance[1][$i][0]."'>".$alliance[1][$i][1]."</a> - ".$alliance[1][$i][14]."</br>";
	 echo "</br>".$lang['peacePacts'].":</br>";
	 for ($i=0; $i<count($alliance[2])-1; $i++)
	 {
	  $a1=alliance($alliance[2][$i][1]);
	  $a2=alliance($alliance[2][$i][2]);
	  echo $a1[1]."-".$a2[1]."</br>";
	 }
	 echo "</br>".$lang['warDecs'].":</br>";
	 for ($i=0; $i<count($alliance[3])-1; $i++)
	 {
	  $a1=alliance($alliance[3][$i][1]);
	  $a2=alliance($alliance[3][$i][2]);
	  echo $a1[1]."-".$a2[1]."</br>";
	 }
	 echo"
	<ul id='tabs'>
	    <li><a href='#allyName'>".$lang['allyName']."</a></li>
	    <li><a href='#quitAlly'>".$lang['quitAlly']."</a></li>
	</ul>
	<div class='tabContent' id='allyName'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse' width='440' border='1'>
		  <tr><td>
		  </br>
            <p>".$lang['allyName'].": ".$alliance[0][1]."</p>
			<p>".$lang['allyDesc'].":</p>
            <p><textarea class='textbox' name='desc' cols='45' rows='7' readonly='true'>".$alliance[0][3]."</textarea></p>
		  </br>
		  </td></tr>
		  </table>
		 </div>
	</div>
	<div class='tabContent' id='quitAlly'>
                 <div>
		  <table class='q_table' style='border-collapse: collapse; text-align: center' width='440' border='1'>
		  <tr><td>
		  </br>
		  <p>".$lang['allyName'].": ".$alliance[0][1]."</p>
		  <form name='form7' method='post' action='a_quit.php'>
            <input class='button' type='submit' name='button7' value='".$lang['quitAlly']."'></p>
          </form>
		  </td></tr>
		  </table>
		 </div>
	</div>";
	}
}
else echo $lang['constrBuilding'];
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