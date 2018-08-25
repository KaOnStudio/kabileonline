<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 check_r($_GET["town"]);
 check_t($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]); $r=$faction[3];
 $buildings=buildings($_SESSION["user"][10]);
 $weapons=weapons($_SESSION["user"][10]);
 $merchants=get_tr($_GET["town"]);
 $tq=get_t($_GET["town"]);
 $c_status=get_con($_GET["town"]);
 
 $data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]);
 $goods[0][0]="Crop"; $goods[0][1]="Lumber"; $goods[0][2]="Stone"; $goods[0][3]="Iron"; $goods[0][4]="Gold";
 for ($i=0; $i<count($weapons); $i++) $goods[1][$i]=$weapons[$i][2];
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
var tabLinks = new Array();
var contentDivs = new Array();
var data=new Array(11);
<?php for ($i=0; $i<count($weapons); $i++) echo "data[".$i."]='".$weapons[$i][2]."'; "; ?>
</script>

<head>
<title><?php echo $title." - ".$buildings[10][2]; ?></title>
</head>

<body class="q_body" onLoad="inittabs(); startres();">

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
if ($data[10])
{
 echo "<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]."</br></br>";
 echo $buildings[10][8]."</br></br>";
 if (!$c_status[10])
		if ($data[10]<10)
		{
			$dur=explode("-", $buildings[10][6]); $upk=explode("-", $buildings[10][7]); $cost=explode("-", $buildings[10][4]); $dur[$data[10]]=explode(":", $dur[$data[10]]);
			$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[10][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[10][2]." ".$lang['toLevel']." ".($data[10]+1)."</a>";
			$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[10]))."</br>".$lang['duration'].": ".($dur[$data[10]][0]*$lim[4]/100).":".($dur[$data[10]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[10]];
			echo $tag;
			if ($town[12]+$town[3]+$upk[$data[10]]>$lim[3]) label("</br>".$lang['noHouses']);
			if (!(($res[0]>=$cost[0]*pow($r, $data[10]))&&($res[1]>=$cost[1]*pow($r, $data[10]))&&($res[2]>=$cost[2]*pow($r, $data[10]))&&($res[3]>=$cost[3]*pow($r, $data[10]))&&($res[4]>=$cost[4]*pow($r, $data[10])))) label("</br>".$lang['noResources']);
		}
		else echo $lang['buildingMaxLvl'];
 else echo $lang['beingUpgraded'];
}
else echo $lang['constrBuilding'];
echo "</br>------------------------------------------</br>";
if ($data[10])
{
 echo $lang['availMerchants'].": ".($data[10]-$merchants)."/".$data[10]."";
 echo "
        <ul id='tabs'>
            <li><a href='#sendTransport'>".$lang['sendTransport']."</a></li>
            <li><a href='#sellNpc'>".$lang['sellNpc']."</a></li>
            <li><a href='#sell'>".$lang['sell']."</a></li>
            <li><a href='#buy'>".$lang['buy']."</a></li>
        </ul>
        <div class='tabContent' id='sendTransport'>
                <div>
		  <table class='q_table' style='border-collapse: collapse' width='400' border='1'>
		  <tr><td>
          <form name='form0' method='post' action='trade.php?town=".$_GET["town"]."&type=1'>
            <p align='center'>".$lang['send'].":</p>
			<p align='center'><input class='textbox' type='text' name='sQ' size='5' maxlength='5' value='0'>
            <select class='dropdown' name='sType' id='sType0' onchange=\"javascript: trade_options('sType0', 'sSubType0', data);\">
			<option value='0'>".$lang['resources']."</option>
			<option value='1'>".$lang['goods']."</option>
			</select> 
			<span id='sSubType0'>
			<select class='dropdown' name='sSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select>
			</span></p>
			<p align='center'>".$lang['townName'].":</p>
			<p align='center'><input class='textbox' type='text' name='name'></p>
			<p align='center'>".$lang['maxDur']."</p>
			<p align='center'><input class='textbox' type='text' name='maxTime' size='2' maxlength='2' value='0'></p>
            <p align='center'><input class='button' type='submit' name='button0' value='".$lang['send']."'></td></tr></p>
		  </form>
		  </table>
                </div>
        </div>
        <div class='tabContent' id='sellNpc'>
                <div>
		  <table class='q_table' style='border-collapse: collapse' width='400' border='1'>
		  <tr><td>
          <form name='form11' method='post' action='npc_trade.php?town=".$_GET["town"]."'>
            <p align='center'>".$lang['offer'].":</p>
			<p align='center'><input class='textbox' type='text' name='sQ' size='5' maxlength='5' value='0'> <select class='dropdown' name='sSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select></p>
			<p align='center'>".$lang['search'].":</p>
			<p align='center'><select class='dropdown' name='bSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select></p>
            <p align='center'><input class='button' type='submit' name='button11' value='".$lang['sellNpc']."'></td></tr></p>
		  </form>
		  </table>
                </div>
        </div>
        <div class='tabContent' id='sell'>
                <div>
 		  <table class='q_table' style='border-collapse: collapse' width='400' border='1'>
		  <tr><td>
          <form name='form1' method='post' action='trade.php?town=".$_GET["town"]."&type=0'>
            <p align='center'>".$lang['offer'].":</p>
			<p align='center'><input class='textbox' type='text' name='sQ' size='5' maxlength='5' value='0'>
            <select class='dropdown' name='sType' id='sType1' onchange=\"javascript: trade_options('sType1', 'sSubType1', data);\">
			<option value='0'>".$lang['resources']."</option>
			<option value='1'>".$lang['goods']."</option>
			</select> 
			<span id='sSubType1'>
			<select class='dropdown' name='sSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select>
			</span></p>
			<p align='center'>".$lang['search'].":</p>
			<p align='center'><input class='textbox' type='text' name='bQ' size='5' maxlength='5' value='0'>
            <select class='dropdown' name='bType' id='bType1' onchange=\"javascript: trade_options('bType1', 'bSubType1', data);\">
			<option value='0'>".$lang['resources']."</option>
			<option value='1'>".$lang['goods']."</option>
			</select> 
			<span id='bSubType1'>
			<select class='dropdown' name='bSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select>
			</span></p>
			<p align='center'>".$lang['maxDur'].":</p>
			<p align='center'><input class='textbox' type='text' name='maxTime' size='2' maxlength='2' value='0'></p>
            <p align='center'><input class='button' type='submit' name='button1' value='".$lang['postOffer']."'></td></tr></p>
		  </form>
		  </table>
                </div>
        </div>
        <div class='tabContent' id='buy'>
                <div>
		  <table class='q_table' style='border-collapse: collapse' width='400' border='1'>
		  <tr><td>
          <form name='form2' method='post' action='offers.php?town=".$_GET["town"]."&page=0'>
            <p align='center'>".$lang['findOffer'].":</p>
			<p align='center'><select class='dropdown' name='sType' id='sType2' onchange=\"javascript: trade_options('sType2', 'sSubType2', data);\">
			<option value='0'>".$lang['resources']."</option>
			<option value='1'>".$lang['goods']."</option>
			</select> 
			<span id='sSubType2'>
			<select class='dropdown' name='sSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select>
			</span></p>
			<p align='center'>".$lang['andSearch'].":</p>
            <p align='center'><select class='dropdown' name='bType' id='bType2' onchange=\"javascript: trade_options('bType2', 'bSubType2', data);\">
			<option value='0'>".$lang['resources']."</option>
			<option value='1'>".$lang['goods']."</option>
			</select> 
			<span id='bSubType2'>
			<select class='dropdown' name='bSubType'><option value='0'>".$lang['crop']."</option><option value='1'>".$lang['lumber']."</option><option value='2'>".$lang['stone']."</option><option value='3'>".$lang['iron']."</option><option value='4'>".$lang['gold']."</option></select>
			</span></p>
			<p align='center'><input class='button' type='submit' name='button2' value='".$lang['find']."'> | <a class='q_link' href='offers_all.php?town=".$_GET["town"]."&page=0'>".$lang['viewAll']."</a></td></tr></p>
		  </form>
		  </table>
                </div>
        </div>";
}
if (count($tq[0])-1) echo $lang['ownOffers'].":</br>";
for ($i=0; $i<count($tq[0])-1; $i++) echo "[<a class='q_link' href='cancel_t.php?town=".$_GET["town"]."&sType=".$tq[0][$i][0]."&sSubType=".$tq[0][$i][1]."&bType=".$tq[0][$i][3]."&bSubType=".$tq[0][$i][4]."'>x</a>] ".$tq[0][$i][2]." ".$goods[$tq[0][$i][0]][$tq[0][$i][1]]." for ".$tq[0][$i][5]." ".$goods[$tq[0][$i][3]][$tq[0][$i][4]]."</br>";
echo "-----</br>";
if (count($tq[1])-1) echo $lang['ownAcceptedOffers'].":</br>"; $nr=0;
for ($i=0; $i<count($tq[1])-1; $i++)
{
 $sourceTown=town($tq[1][$i][3]);
 echo $tq[1][$i][7]." ".$goods[$tq[1][$i][5]][$tq[1][$i][6]]." to and ".$tq[1][$i][2]." ".$goods[$tq[1][$i][0]][$tq[1][$i][1]]." from ".$sourceTown[2]." in <span id='own_".$i."'>".$tq[1][$i][4]."</span><script type='text/javascript'> var id=new Array(50); timer('own_".$i."', 'marketplace.php?town=".$_GET["town"]."'); </script></br>";
 $nr++;
}
echo "-----</br>";
if (count($tq[2])-1) echo $lang['otherOffers'].":</br>";
for ($i=0; $i<count($tq[2])-1; $i++)
{
 $sourceTown=town($tq[2][$i][3]);
 echo $tq[2][$i][7]." ".$goods[$tq[2][$i][5]][$tq[2][$i][6]]." ".$lang['toAnd']." ".$tq[2][$i][2]." ".$goods[$tq[2][$i][0]][$tq[2][$i][1]]." ".$lang['from']." ".$sourceTown[2]." ".$lang['in']." <span id='other_".$nr."'>".$tq[2][$i][4]."</span><script type='text/javascript'> var id=new Array(50); timer('other_".$i."', 'marketplace.php?town=".$_GET["town"]."'); </script></br>";
 $nr++;
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