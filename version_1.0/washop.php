<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 check_r($_GET["town"]);
 check_w($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]); $r=$faction[3];
 $buildings=buildings($_SESSION["user"][10]);
 $wq=get_w($_GET["town"]);
 $weapons=weapons($_SESSION["user"][10]);
 $c_status=get_con($_GET["town"]);
 
 $data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]); $out=explode("-", $buildings[18][5]); $weaps=explode("-", $town[6]);
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
<title><?php echo $title." - ".$buildings[18][2]; ?></title>
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
<?php
if ($data[18])
{
 echo "<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]."</br></br>";
 echo $buildings[18][8]."</br></br>";
 echo $lang['currentStorCap'].": ".$lim[12]." ".$lang['type']."</br>".$lang['weapStock'].":<table class='q_table' style='border-collapse: collapse; text-indent: 0; margin-left:auto; margin-right:auto; text-align: center;' width='600' border='1'><tr>";
 for ($i=0; $i<count($weapons); $i++)	echo "<td><img src='".$imgs.$fimgs."1".$i.".gif' title='".$weapons[$i][2]."'></td>";
 echo "</tr>";
 for ($i=0; $i<count($weaps); $i++)
 {
		echo "<td>".$weaps[$i]."</td>";
 }
 echo "</tr></table>------------------------------------------</br>";
 if (!$c_status[18])
		if ($data[18]<10)
		{
			$dur=explode("-", $buildings[18][6]); $upk=explode("-", $buildings[18][7]); $cost=explode("-", $buildings[18][4]); $dur[$data[18]]=explode(":", $dur[$data[18]]);
			$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[18][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[18][2]." ".$lang['toLevel']." ".($data[18]+1)."</a>";
			$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[18]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[18]))."</br>".$lang['duration'].": ".($dur[$data[18]][0]*$lim[4]/100).":".($dur[$data[18]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[18]]."</br>".$lang['expSpeed'].": ".$out[$data[18]];
			echo $tag;
			if ($town[12]+$town[3]+$upk[$data[18]]>$lim[3]) label("</br>".$lang['noHouses']);
			if (!(($res[0]>=$cost[0]*pow($r, $data[18]))&&($res[1]>=$cost[1]*pow($r, $data[18]))&&($res[2]>=$cost[2]*pow($r, $data[18]))&&($res[3]>=$cost[3]*pow($r, $data[18]))&&($res[4]>=$cost[4]*pow($r, $data[18])))) label("</br>".$lang['noResources']);
			echo "</br>------------------------------------------";
		}
		else echo $lang['buildingMaxLvl'];
 else echo $lang['beingUpgraded'];
}
else echo $lang['constrBuilding'];
?>
			<table class="q_table" style="border-collapse: collapse; text-indent: 0; margin-left:auto; margin-right:auto; text-align: center;" width="600" border="1">
            <tr>
              <td><?php echo $lang['weaponType'] ?></td>
              <td><?php echo $lang['quantity'] ?></td>
              <td><?php echo $lang['forge'] ?></td>
            </tr>
<?php
if ($data[18])
for ($i=0; $i<count($weapons); $i++)
if ($i!=9)
{
 $dur=explode(":", $weapons[$i][4]);  $cost=explode("-", $weapons[$i][3]);
 echo "<form name='weapons' method='post' action='forge.php?town=".$_GET["town"]."&type=".$i."'><tr><td><img src='".$imgs.$fimgs."1".$i.".gif' title='".$weapons[$i][2]."'></br> ".$weapons[$i][5]."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0])." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1])." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2])." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3])." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4])."</br>".$lang['duration'].": ".($dur[0]*$lim[9]/100).":".($dur[1]*$lim[9]/100)."</td><td><input class='textbox' name='q' type='text' size='3' maxlength='3' value='0'></td><td><input class='button' type='submit' name='spear' value='".$lang['forge']."'></td></tr></form>";
}
echo "</table>";
if (count($wq)) echo $lang['weaponQueue'].":</br>";
for ($i=0; $i<count($wq); $i++) echo "[<a class='q_link' href='cancel_w.php?town=".$_GET["town"]."&type=".$wq[$i][1]."'>x</a>] ".$wq[$i][2]." ".$weapons[$wq[$i][1]][2]." - <span id='".$i."'>".$wq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('".$i."', 'washop.php?town=".$_GET["town"]."'); </script></br>";
?></p>
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