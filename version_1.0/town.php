<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $_GET["town"]=clean($_GET["town"]);
 check_a($_GET["town"]);
 check_t($_GET["town"]);
 check_w($_GET["town"]);
 check_u($_GET["town"]);
 check_uup($_GET["town"]);
 check_c($_GET["town"], $_SESSION["user"][10]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $buildings=buildings($_SESSION["user"][10]);
 $cq=get_c($_GET["town"]);
 $iaq=get_ia($_GET["town"]);
 $b_names=array(); for ($i=0; $i<22; $i++) $b_names[$i]=$buildings[$i][2];
 $fl_data="<object width='640' height='480'><embed src='".$imgs.$fimgs."town.swf' type='application/x-shockwave-flash' width='640' height='480' FlashVars='tid=".$town[0]."&tname=".str_replace("'", "`", $town[2])."&data=".$town[8]."&w=".$town[16]."&bnames=".implode("/", $b_names)."&res=".$town[10]."&lim=".$town[11]."&upkeep=".($town[3]+$town[12])."&morale=".$town[5]."&prod=".$town[9]."'></embed></object>";
 $data=explode("-", $town[8]); $land=explode("/", $town[13]); $land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]);
 $res=explode("-", $town[10]); $lim=explode("-", $town[11]); $prod=explode("-", $town[9]);
 if ($prod[0]-$town[3]-$town[12]<5) $prod[0]=$town[3]+$town[12]+5;//noob protection against negative crop production values
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
<title><?php echo $title; ?> - <?php echo $lang['town'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body class="q_body" onLoad="startres()">

<div align="center">
<?php echo $top_ad; ?>

<table width="600" border="2" align="center" class="q_table" style="border-collapse: collapse">
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
if (!isset($_GET["v"]))
{
      echo "<div style='position:relative; top:0; left:125; cursor:url(".$imgs.$fimgs."cursor.png), auto;'>
	    <img src='".$imgs.$fimgs."x.gif'>
        <img src='".$imgs.$fimgs."border1.jpg' width='640' height='81' style='position:absolute; left:0; top:0;'>
        <img src='".$imgs.$fimgs."back.jpg' width='640' height='372' style='position:absolute; left:0; top:75;'>";
         if ($town[16]>-1) echo "<img src='".$imgs.$fimgs."water.png' width='227' height='60' style='position:absolute; left:3; top:385;'>"; 
         if ($data[0]) echo "<img src='".$imgs.$fimgs."b0.png' style='position:absolute; left:53; top:105;' name='gmill'>";
         if ($data[1]) echo "<img src='".$imgs.$fimgs."b1.png' style='position:absolute; left:80; top:150;' name='lmill'>";
         if ($data[2]) echo "<img src='".$imgs.$fimgs."b2.png' style='position:absolute; left:12; top:215;' name='smason'>";
         if ($data[3]) echo "<img src='".$imgs.$fimgs."b3.png' style='position:absolute; left:143; top:77;' name='ifoundry'>";
         if ($data[4]) echo "<img src='".$imgs.$fimgs."b4.png' style='position:absolute; left:0; top:135;' name='granary'>";
         if ($data[5]) echo "<img src='".$imgs.$fimgs."b5.png' style='position:absolute; left:478; top:115;' name='warehouse'>";
         if ($data[6]) echo "<img src='".$imgs.$fimgs."b6.png' style='position:absolute; left:555; top:101;' name='cache'>";
         if ($data[7]) if ($data[7]==10) echo "<img src='".$imgs.$fimgs."b22.png' style='position:absolute; left:328; top:165;' name='hall'>"; else echo "<img src='".$imgs.$fimgs."b7.png' style='position:absolute; left:335; top:170;' name='hall'>";
         if ($data[8]) echo "<img src='".$imgs.$fimgs."b8.png' style='position:absolute; left:187; top:180;' name='house'>";
         if ($data[9]) echo "<img src='".$imgs.$fimgs."b9.png' style='position:absolute; left:270; top:228;' name='embassy'>";
         if ($data[10]) echo "<img src='".$imgs.$fimgs."b10.png' style='position:absolute; left:437; top:200;' name='marketplace'>";
         if ($data[11]) echo "<img src='".$imgs.$fimgs."b11.png' style='position:absolute; left:447; top:257;' name='cathedral'>";
         if ($data[12]) echo "<img src='".$imgs.$fimgs."b12.png' style='position:absolute; left:32; top:305;' name='porta'>";
         if ($data[13]) echo "<img src='".$imgs.$fimgs."b13.png' width='434' height='259' style='position:absolute; left:205; top:185;' name='wall'>";
         if ($data[14]) echo "<img src='".$imgs.$fimgs."b14.png' style='position:absolute; left:567; top:300;' name='tower'>";
         if ($data[15]) echo "<img src='".$imgs.$fimgs."b15.png' style='position:absolute; left:215; top:80;' name='barracks'>";
         if ($data[16]) echo "<img src='".$imgs.$fimgs."b16.png' style='position:absolute; left:102; top:228;' name='academy'>";
         if ($data[17]) echo "<img src='".$imgs.$fimgs."b17.png' style='position:absolute; left:333; top:295;' name='blacksmith'>";
         if ($data[18]) echo "<img src='".$imgs.$fimgs."b18.png' style='position:absolute; left:192; top:288;' name='washop'>";
         if ($data[19]) echo "<img src='".$imgs.$fimgs."b19.png' style='position:absolute; left:300; top:72;' name='stable'>";
         if ($data[20]) echo "<img src='".$imgs.$fimgs."b20.png' style='position:absolute; left:380; top:74;' name='sshop'>";
         if ($data[21]) echo "<img src='".$imgs.$fimgs."b21.png' style='position:absolute; left:526; top:198;' name='wwarehouse'>";
                        echo "<img src='".$imgs.$fimgs."t_edit.png' width='34' height='36' style='position:absolute; left:460; top:407;' name='town_edit'>";
                        echo "<img src='".$imgs.$fimgs."crossroad.png' style='position:absolute; left:526; top:394;' name='crossroad'>";
        echo "<img src='".$imgs.$fimgs."border2.jpg' width='640' height='35' style='position:absolute; left:0; top:445;'>
    	    <img src='".$imgs."1/x.gif' border='0' usemap='#Map' style='position:absolute; left:0; top:80;'>";
         echo "<span style=\"position:absolute; left:0; top:0; height:75; width:640;\">
            <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]." </br>
            <img src='".$imgs.$fimgs."house_.gif' title='Upkeep'>".($town[3]+$town[12])."/".$lim[3]." <img src='".$imgs.$fimgs."morale_.gif' title='Morale'>".$town[5]."%.</br>
            Üretim : <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".($prod[0]-$town[3]-$town[12])."/h <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".$prod[1]."/h <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".$prod[2]."/h <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".$prod[3]."/h <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".$prod[4]."/h</span>"; 
        echo "<span id=\"label\" style=\"position:absolute; left:25; top:83; height:24; width:507; font-family: arial; font-size: large;\"></span>";
        echo "</div>
        <map name='Map'>";
           if ($data[0]) {$name=explode("-", $buildings[0][2]); echo "<area shape='rect' coords='60,52,115,120' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='gmill.php?town=".$town[0]."' onmouseout=\"gmill.src='".$imgs.$fimgs."b0.png', showtext('-')\" onmouseover=\"gmill.src='".$imgs.$fimgs."b0_.png', showtext('".$name[0]."')\">";}
           if ($data[1]) {$name=explode("-", $buildings[1][2]); echo "<area shape='rect' coords='80,103,155,147' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='lmill.php?town=".$town[0]."' onmouseout=\"lmill.src='".$imgs.$fimgs."b1.png', showtext('-')\" onmouseover=\"lmill.src='".$imgs.$fimgs."b1_.png', showtext('".$name[0]."')\">";}
           if ($data[2]) {$name=explode("-", $buildings[2][2]); echo "<area shape='rect' coords='20,150,87,224' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='smason.php?town=".$town[0]."' onmouseout=\"smason.src='".$imgs.$fimgs."b2.png', showtext('-')\" onmouseover=\"smason.src='".$imgs.$fimgs."b2_.png', showtext('".$name[0]."')\">";}
           if ($data[3]) {$name=explode("-", $buildings[3][2]); echo "<area shape='rect' coords='144,35,216,95' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='ifoundry.php?town=".$town[0]."' onmouseout=\"ifoundry.src='".$imgs.$fimgs."b3.png', showtext('-')\" onmouseover=\"ifoundry.src='".$imgs.$fimgs."b3_.png', showtext('".$name[0]."')\">";}
           if ($data[4]) echo "<area shape='rect' coords='0,85,62,158' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='granary.php?town=".$town[0]."' onmouseout=\"granary.src='".$imgs.$fimgs."b4.png', showtext('-')\" onmouseover=\"granary.src='".$imgs.$fimgs."b4_.png', showtext('".$buildings[4][2]." ".$lang['level']." ".$data[4]."')\">";
           if ($data[5]) echo "<area shape='rect' coords='478,59,553,133' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='warehouse.php?town=".$town[0]."' onmouseout=\"warehouse.src='".$imgs.$fimgs."b5.png', showtext('-')\" onmouseover=\"warehouse.src='".$imgs.$fimgs."b5_.png', showtext('".$buildings[5][2]." ".$lang['level']." ".$data[5]."')\">";
           if ($data[6]) echo "<area shape='rect' coords='565,55,629,120' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='cache.php?town=".$town[0]."' onmouseout=\"cache.src='".$imgs.$fimgs."b6.png', showtext('-')\" onmouseover=\"cache.src='".$imgs.$fimgs."b6_.png', showtext('".$buildings[6][2]." ".$lang['level']." ".$data[6]."')\">";
           if ($data[7]) {$name=explode("-", $buildings[7][2]); if ($data[7]==10) {$i=22; $j=1;} else {$i=7; $j=0;} echo "<area shape='rect' coords='334,105,409,185' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='hall.php?town=".$town[0]."' onmouseout=\"hall.src='".$imgs.$fimgs."b".$i.".png', showtext('-')\" onmouseover=\"hall.src='".$imgs.$fimgs."b".$i."_.png', showtext('".$name[$j]." ".$lang['level']." ".$data[7]."')\">";}
           if ($data[8]) echo "<area shape='rect' coords='185,128,260,200' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='house.php?town=".$town[0]."' onmouseout=\"house.src='".$imgs.$fimgs."b8.png', showtext('-')\" onmouseover=\"house.src='".$imgs.$fimgs."b8_.png', showtext('".$buildings[8][2]." ".$lang['level']." ".$data[8]."')\">";
           if ($data[9]) echo "<area shape='rect' coords='269,182,344,245' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='embassy.php?town=".$town[0]."' onmouseout=\"embassy.src='".$imgs.$fimgs."b9.png', showtext('-')\" onmouseover=\"embassy.src='".$imgs.$fimgs."b9_.png', showtext('".$buildings[9][2]."')\">";
           if ($data[10]) echo "<area shape='rect' coords='440,160,510,210' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='marketplace.php?town=".$town[0]."' onmouseout=\"marketplace.src='".$imgs.$fimgs."b10.png', showtext('-')\" onmouseover=\"marketplace.src='".$imgs.$fimgs."b10_.png', showtext('".$buildings[10][2]." ".$lang['level']." ".$data[10]."')\">";
           if ($data[11]) echo "<area shape='rect' coords='445,210,520,275' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='cathedral.php?town=".$town[0]."' onmouseout=\"cathedral.src='".$imgs.$fimgs."b11.png', showtext('-')\" onmouseover=\"cathedral.src='".$imgs.$fimgs."b11_.png', showtext('".$buildings[11][2]." ".$lang['level']." ".$data[11]."')\">";
           if ($data[12]) echo "<area shape='rect' coords='35,236,105,314' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='port.php?town=".$town[0]."' onmouseout=\"porta.src='".$imgs.$fimgs."b12.png', showtext('-')\" onmouseover=\"porta.src='".$imgs.$fimgs."b12_.png', showtext('".$buildings[12][2]." ".$lang['level']." ".$data[12]."')\">";
           if ($data[13]) echo "<area shape='rect' coords='210,315,455,352' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='wall.php?town=".$town[0]."' onmouseout=\"wall.src='".$imgs.$fimgs."b13.png', showtext('-')\" onmouseover=\"wall.src='".$imgs.$fimgs."b13_.png', showtext('".$buildings[13][2]." ".$lang['level']." ".$data[13]."')\">";
           if ($data[14]) echo "<area shape='rect' coords='585,245,625,320' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='tower.php?town=".$town[0]."' onmouseout=\"tower.src='".$imgs.$fimgs."b14.png', showtext('-')\" onmouseover=\"tower.src='".$imgs.$fimgs."b14_.png', showtext('".$buildings[14][2]." ".$lang['level']." ".$data[14]."')\">";
           if ($data[15]) echo "<area shape='rect' coords='220,35,290,98' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='barracks.php?town=".$town[0]."' onmouseout=\"barracks.src='".$imgs.$fimgs."b15.png', showtext('-')\" onmouseover=\"barracks.src='".$imgs.$fimgs."b15_.png', showtext('".$buildings[15][2]." ".$lang['level']." ".$data[15]."')\">";
           if ($data[16]) echo "<area shape='rect' coords='105,170,180,245' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='academy.php?town=".$town[0]."' onmouseout=\"academy.src='".$imgs.$fimgs."b16.png', showtext('-')\" onmouseover=\"academy.src='".$imgs.$fimgs."b16_.png', showtext('".$buildings[16][2]."')\">";
           if ($data[17]) echo "<area shape='rect' coords='337,235,410,315' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='blacksmith.php?town=".$town[0]."' onmouseout=\"blacksmith.src='".$imgs.$fimgs."b17.png', showtext('-')\" onmouseover=\"blacksmith.src='".$imgs.$fimgs."b17_.png', showtext('".$buildings[17][2]."')\">";
           if ($data[18]) echo "<area shape='rect' coords='195,238,265,306' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='washop.php?town=".$town[0]."' onmouseout=\"washop.src='".$imgs.$fimgs."b18.png', showtext('-')\" onmouseover=\"washop.src='".$imgs.$fimgs."b18_.png', showtext('".$buildings[18][2]." ".$lang['level']." ".$data[18]."')\">";
           if ($data[19]) echo "<area shape='rect' coords='300,30,375,90' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='stable.php?town=".$town[0]."' onmouseout=\"stable.src='".$imgs.$fimgs."b19.png', showtext('-')\" onmouseover=\"stable.src='".$imgs.$fimgs."b19_.png', showtext('".$buildings[19][2]." ".$lang['level']." ".$data[19]."')\">";
           if ($data[20]) echo "<area shape='rect' coords='380,30,450,90' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='sshop.php?town=".$town[0]."' onmouseout=\"sshop.src='".$imgs.$fimgs."b20.png', showtext('-')\" onmouseover=\"sshop.src='".$imgs.$fimgs."b20_.png', showtext('".$buildings[20][2]." ".$lang['level']." ".$data[20]."')\">";
           if ($data[21]) echo "<area shape='rect' coords='525,145,600,218' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='wwarehouse.php?town=".$town[0]."' onmouseout=\"wwarehouse.src='".$imgs.$fimgs."b21.png', showtext('-')\" onmouseover=\"wwarehouse.src='".$imgs.$fimgs."b21_.png', showtext('".$buildings[21][2]." ".$lang['level']." ".$data[21]."')\">";
                          echo "<area shape='rect' coords='460,330,495,365' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='town_edit.php?town=".$town[0]."' onmouseout=\"town_edit.src='".$imgs.$fimgs."t_edit.png', showtext('-')\" onmouseover=\"town_edit.src='".$imgs.$fimgs."t_edit_.png', showtext('".preg_replace("/'/","\'",$town[2])."')\">"; 
                          echo "<area shape='rect' coords='525,315,610,365' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href='dispatch.php?town=".$town[0]."' onmouseout=\"crossroad.src='".$imgs.$fimgs."crossroad.png', showtext('-')\" onmouseover=\"crossroad.src='".$imgs.$fimgs."crossroad_.png', showtext('".$lang['crossroad']."')\">
        </map>";
echo "</br></br></br></br></br>";
} else echo $fl_data;

echo '<table align="center" style="background: url(templates/1/border4.jpg) repeat-y center top;">';
echo '<tr>';
echo '<td style="width:40px;">&nbsp;</td>';
echo '<td style="width:160px;">&nbsp;</td>';
echo '<td style="width:80px;">&nbsp;</td>';
echo '<td style="width:130px;">&nbsp;</td>';
echo '</tr>';
if (count($cq)) echo '<tr><td style="text-align:center;" colspan="4">'.$lang['constQueue'].'</td></tr>';
for ($i=0; $i<count($cq); $i++)
{
	$name=explode("-", $buildings[$cq[$i][1]][2]);
	if ($cq[$i][2]>-1)
	{
		$s=1; $l=$land[$cq[$i][1]][$cq[$i][2]]+1;
	}
	else
	{
		$s=0; $l=$data[$cq[$i][1]]+1;
	}
	echo "<tr><td>[<a class='q_link' href='cancel_c.php?town=".$_GET["town"]."&b=".$cq[$i][1]."&subB=".$cq[$i][2]."'>x</a>]</td><td> ".$name[$s]."</td><td> ".$lang['level']." ".$l."</td><td><span id='cq".$i."'>".$cq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('cq".$i."', 'town.php?town=".$_GET["town"]."'); </script></td><tr>";
}
echo '<tr><td colspan="4">&nbsp;</td></tr>';
echo '</table>';

echo "</br>---------------</br>";
if (count($iaq)) echo $lang['incQueue'].":</br>";
for ($i=0; $i<count($iaq); $i++)
{
 $twn=town($iaq[$i][1]);
 $tget=town($iaq[$i][2]);
 switch($iaq[$i][3])
 {
  case 0: $what=$lang['reinforce']; break;
  case 1: $what=$lang['raid']; break;
  case 2: $what=$lang['attack']; break;
  case 3: $what=$lang['spy']; break;
 }
 if (!$iaq[$i][4]) $what=$lang['from']." ".$twn[2]." ".$lang['to']." ".$what; else $what=$lang['returnFrom']." ".$what." ".$lang['on']." ".$tget[2];
 echo $what." - <span id='it".$i."'>".$iaq[$i][0]."</span><script type='text/javascript'> var id=new Array(50); timer('it".$i."', 'town.php?town=".$_GET["town"]."'); </script></br>";
}
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