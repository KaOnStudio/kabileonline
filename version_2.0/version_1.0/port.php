<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]); $r=$faction[3];
 $buildings=buildings($_SESSION["user"][10]);
 $c_status=get_con($_GET["town"]);
 $uq=get_u($_GET["town"]);
 $units=units($faction[0]);
 
 $data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $u_upgrades=explode("-", $town[17]); $w_upgrades=explode("-", $town[18]); $a_upgrades=explode("-", $town[19]); $army=explode("-", $town[7]);
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
<title><?php echo $title." - ".$buildings[12][2]; ?></title>
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
          <p>
<?php
if ($data[12])
{
 echo "<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]."</br></br>";
 echo $buildings[12][8]."</br></br>";
 echo $lang['availTroops'].":<table class='q_table' style='border-collapse: collapse; text-indent: 0; text-align: center' width='600' border='1'><tr>";
 for ($i=0; $i<count($units); $i++) echo "<td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></td>";
 echo "</tr><tr>";
 for ($i=0; $i<count($army); $i++) echo "<td>".$army[$i]."</td>";
 echo "</tr></table>------------------------------------------</br>";
 if (!$c_status[12])
		if ($data[12]<10)
		{
			$dur=explode("-", $buildings[12][6]); $upk=explode("-", $buildings[12][7]); $cost=explode("-", $buildings[12][4]); $dur[$data[12]]=explode(":", $dur[$data[12]]);
			$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[12][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[12][2]." ".$lang['toLevel']." ".($data[12]+1)."</a>";
			$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[12]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[12]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[12]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[12]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[12]))."</br>".$lang['duration'].": ".($dur[$data[12]][0]*$lim[4]/100).":".($dur[$data[12]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[12]];
			echo $tag;
			if ($town[12]+$town[3]+$upk[$data[12]]>$lim[3]) label("</br>".$lang['noHouses']);
			if (!(($res[0]>=$cost[0]*pow($r, $data[12]))&&($res[1]>=$cost[1]*pow($r, $data[12]))&&($res[2]>=$cost[2]*pow($r, $data[12]))&&($res[3]>=$cost[3]*pow($r, $data[12]))&&($res[4]>=$cost[4]*pow($r, $data[12])))) label("</br>".$lang['noResources']);
			echo "</br>------------------------------------------</br>";
		}
		else echo $lang['buildingMaxLvl'];
 else echo $lang['beingUpgraded'];
}
else echo $lang['constrBuilding'];
?>
       <table class="q_table" style="border-collapse: collapse; text-indent: 0; margin-left:auto; margin-right:auto;" width="600" border="1">
            <tr style='text-align: center'>
              <td><?php echo $lang['unitType'] ?></td>
              <td><?php echo $lang['quantity'] ?></td>
              <td><?php echo $lang['train'] ?></td>
            </tr>
<?php
if ($data[12])
for ($i=9; $i<11; $i++)
{
 $dur=explode(":", $units[$i][9]); $cost=explode("-", $units[$i][4]);
 if (($u_upgrades[$i])&&($w_upgrades[$i])&&($a_upgrades[$i])) echo "<form name='units' method='post' action='train.php?town=".$_GET["town"]."&type=".$i."'><tr style='text-align: center;'><td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></br>".$units[$i][10]."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].": ".($dur[0]*$lim[8]/100).":".($dur[1]*$lim[8]/100).", HP: ".($units[$i][5]+$u_upgrades[$i]).", ".$lang['atk'].": ".($units[$i][6]+$w_upgrades[$i]).", ".$lang['def'].": ".($units[$i][7]+$a_upgrades[$i]).", ".$lang['speed'].": ".$units[$i][8].".</td><td><input class='textbox' name='q' type='text' size='3' maxlength='3' value='0'></td><td><input type='submit' class='button' name='unit' value='".$lang['train']."'></td></tr></form>";
 else echo "<tr style='text-align: center;'><td><img src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></br>".$units[$i][10]."</td><td colspan='2'>".$lang['researchUnit']." ".$lang['in']." ";
 if (!$u_upgrades[$i]) echo $buildings[16][2]."</td></tr>";
 else if (!$w_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
      else if (!$a_upgrades[$i]) echo $buildings[17][2]."</td></tr>";
}
echo "</table>";
if (count($uq)) echo "Unit train queue:</br>";
for ($i=0; $i<count($uq); $i++)
{
 echo "[<a class='q_link' href='cancel_u.php?town=".$_GET["town"]."&type=".$uq[$i][1]."'>x</a>] ".$uq[$i][2]." ".$units[$uq[$i][1]][2]." - <span id='".$i."'>".$uq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('".$i."', 'washop.php?town=".$_GET["town"]."'); </script></br>";
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