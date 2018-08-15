<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 check_a($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $units=units($faction[0]);
 $aq=get_a($town[0]);
 
 $data=explode("-", $town[8]); $army=explode("-", $town[7]); $gen=explode("-", $town[15]);
 if (isset($_GET["target"])) {$target=town($_GET["target"]); $target=$target[2];} else $target="";
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type="text/javascript"></script>

<head>
<title><?php echo $title." - ".$lang['dispatch']; ?></title>
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
          <p>
<?php echo $lang['sendTroopsTo'] ?>
       <table class="q_table" style="border-collapse: collapse" width="400" border="1">
       <tr>
       <td><?php echo $lang['icon'] ?></td>
       <td><?php echo $lang['available'] ?></td>
       <td><?php echo $lang['send'] ?></td>
       </tr>
<?php
echo "<form name='dispatch' method='post' action='sendt.php?town=".$_GET["town"]."'>
<select class='dropdown' name='type'>
<option value='0'>".$lang['reinforce']."</option>
<option value='1'>".$lang['raid']."</option>
<option value='2'>".$lang['attack']."</option>
<option value='3'>".$lang['spy']."</option>
</select> ".$lang['townOf']." <input class='textbox' name='target' type='text' value=\"".$target."\"></br></br>
<select class='dropdown' name='general'><option value='0'>".$lang['withoutGeneral']."</option><option value='1'>".$lang['withGeneral']."</option></select> ".$lang['using']." <select class='dropdown' name='formation'><option value='0'>".$lang['standard']."</option><option value='1'>".$lang['offensive']."</option><option value='2'>".$lang['defensive']."</option></select> ".$lang['formation'].".</br>";
if (!$gen[1]) label($lang['noGeneral']); else if (!$gen[0]) label($lang['generalAway']);
for ($i=0; $i<13; $i++) echo "<tr><td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></td><td>".$army[$i]."</td><td><input class='textbox' name='q_".$i."' type='text' size='4' maxlength='4' value='0'></td></tr>";
echo "</table>";
?>
<input class='button' type='submit' name='button0' value='<?php echo $lang['send'] ?>'>
</form>
</br></br>
[<a class='q_link' href='csim.php?town=<?php echo $_GET["town"]; ?>'><?php echo $lang['cSim'] ?></a>]
[<a class='q_link' href='gen.php?town=<?php echo $_GET["town"]; ?>'><?php echo $lang['general'] ?></a>]</br>----------</br>
<?php
if (count($aq)) echo $lang['deployQueue'].":</br>";
for ($i=0; $i<count($aq); $i++)
{
 $tget=town($aq[$i][1]);
 switch($aq[$i][2])
 {
  case 0: $what="reinforce"; break;
  case 1: $what="raid"; break;
  case 2: $what="attack"; break;
  case 3: $what="spy"; break;
 }
 echo "[<a class='q_link' href='cancel_a.php?town=".$_GET["town"]."&id=".$aq[$i][5]."'>x</a>] ".$what." ".$tget[2]." - <span id='".$i."'>".$aq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('".$i."', 'dispatch.php?town=".$_GET["town"]."'); </script></br>";
}
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
