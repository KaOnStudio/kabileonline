<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 check_r($_GET["town"]);
 check_uup($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]); $r=$faction[3];
 $buildings=buildings($_SESSION["user"][10]);
 $upq=get_up($_GET["town"]);
 $c_status=get_con($_GET["town"]);
 $units=units($faction[0]);
 $uup_status=get_uup($town[0]);
 
 $data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $w_upgrades=explode("-", $town[18]); $a_upgrades=explode("-", $town[19]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type="text/javascript"></script>
<script type="text/javascript">
var res_start0=<?php echo floor($res[0]);?>; var res_start1=<?php echo floor($res[1]);?>; var res_start2=<?php echo floor($res[2]);?>; var res_start3=<?php echo floor($res[3]);?>; var res_start4=<?php echo floor($res[4]);?>;
var res_limit0=<?php echo $lim[0];?>; var res_limit1=<?php echo $lim[1];?>; var res_limit2=<?php echo $lim[1];?>; var res_limit3=<?php echo $lim[1];?>; var res_limit4=<?php echo $lim[2];?>;
var res_ph0=<?php echo ($prod[0]-$town[3]-$town[12]);?>; var res_ph1=<?php echo ($prod[1]);?>; var res_ph2=<?php echo ($prod[2]);?>; var res_ph3=<?php echo ($prod[3]);?>; var res_ph4=<?php echo ($prod[4]);?>;
var res_sec0=0; var res_sec1=0; var res_sec2=0; var res_sec3=0; var res_sec4=0;
</script>

<head>
<title><?php echo $title." - ".$buildings[17][2]; ?></title>
</head>

<body class="q_body" onLoad="startres()">

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
		  <table class="q_table" style="border-collapse: collapse; text-indent: 0; text-align: center; margin-left:auto; margin-right:auto;" width="600" border="1">
            <tr>
              <td><?php echo $lang['unitType'] ?></td>
              <td colspan='2'><?php echo $lang['weapon']." & ".$lang['armor'] ?></td>
            </tr>
<?php
if ($data[17])
{
 echo "<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]."</br></br>";
 echo $buildings[17][8]."</br></br>";
 for ($i=0; $i<count($units); $i++)
 {
  $cost=explode("-", $units[$i][4]);
  if ($w_upgrades[$i]<10) $wl="<a class='q_link' href='u_upgrade.php?unit=".$units[$i][0]."&tree=18&town=".$_GET["town"]."'>".$lang['upgrade']." ".$lang['toLevel']." ".($w_upgrades[$i]+1)."</a></br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*($w_upgrades[$i]+1))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*($w_upgrades[$i]+1))."</br>".$lang['duration'].": ".$units[$i][9].", ".$lang['atk'].": ".($units[$i][6]+$w_upgrades[$i]+1); else $wl=$lang['atk'].": ".($units[$i][6]+$w_upgrades[$i]);
  if ($a_upgrades[$i]<10) $al="<a class='q_link' href='u_upgrade.php?unit=".$units[$i][0]."&tree=19&town=".$_GET["town"]."'>".$lang['upgrade']." ".$lang['toLevel']." ".($a_upgrades[$i]+1)."</a></br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*($a_upgrades[$i]+1))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*($a_upgrades[$i]+1))."</br>".$lang['duration'].": ".$units[$i][9].", ".$lang['def'].": ".($units[$i][7]+$a_upgrades[$i]+1); else $al=$lang['def'].": ".($units[$i][7]+$a_upgrades[$i]);
  if (!$uup_status[$i]) echo "<tr><td rowspan='2'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></br>".$units[$i][10]."</td><td>".$lang['weapon']."</td><td style='white-space: nowrap'>".$wl."</td></tr><tr><td>".$lang['armor']."</td><td style='white-space: nowrap'>".$al."</td></tr>";
		else echo "<tr><td rowspan='2'><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></br>".$units[$i][10]."</td><td>".$lang['weapon']."</td><td rowspan='2'>".$lang['upgrading']."</td></tr><tr><td>".$lang['armor']."</td></tr>";
 }
 echo "</table>";
 if (count($upq)) echo $lang['unitUpgQueue'].":</br>";
 for ($i=0; $i<count($upq); $i++) echo "[<a class='q_link' href='cancel_uup.php?town=".$_GET["town"]."&unit=".$upq[$i][1]."&tree=".$upq[$i][2]."'>x</a>] ".$units[$upq[$i][1]][2]." - <span id='".$i."'>".$upq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('".$i."', 'blacksmith.php?town=".$_GET["town"]."'); </script></br>";
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