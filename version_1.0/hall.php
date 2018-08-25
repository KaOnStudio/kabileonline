<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
check_r($_GET["town"]);
$town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
$faction=faction($_SESSION["user"][10]); $r=$faction[3];
$buildings=buildings($_SESSION["user"][10]);
$c_status=get_con($_GET["town"]);

$data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]);
$land=explode("/", $town[13]); $land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]);
$name=explode("-", $buildings[7][2]); if ($data[7]==10) $name=$name[1]; else $name=$name[0];
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
//-----------------
function ch_a(v)
{
 var land=new Array(4);
 land[0]="<select class='dropdown' name='b'><?php for ($i=0; $i<count($land[0]); $i++) if ($land[0][$i]) echo "<option value='".$i."'>".$lang['farm']."_".$i." [".$land[0][$i]."]</option>"; echo "</select>"; ?>";
 land[1]="<select class='dropdown' name='b'><?php for ($i=0; $i<count($land[1]); $i++) if ($land[1][$i]) echo "<option value='".$i."'>".$lang['forrest']."_".$i." [".$land[1][$i]."]</option>"; echo "</select>"; ?>";
 land[2]="<select class='dropdown' name='b'><?php for ($i=0; $i<count($land[2]); $i++) if ($land[2][$i]) echo "<option value='".$i."'>".$lang['quarry']."_".$i." [".$land[2][$i]."]</option>"; echo "</select>"; ?>";
 land[3]="<select class='dropdown' name='b'><?php for ($i=0; $i<count($land[3]); $i++) if ($land[3][$i]) echo "<option value='".$i."'>".$lang['ore_site']."_".$i." [".$land[3][$i]."]</option>"; echo "</select>"; ?>";
 land[4]="<select class='dropdown' name='b'><?php for ($i=0; $i<count($lang['buildings'][$_SESSION["user"][10]-1]); $i++) if ($data[$i]) echo "<option value='".$i."'>".$lang['buildings'][$_SESSION["user"][10]-1][$i][0]." [".$data[$i]."]</option>"; echo "</select>"; ?>";
	document.getElementById("b").innerHTML=land[v];
}
</script>

<head>
<title><?php echo $title." - ".$name; ?></title>
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
                <td class="td_content" style='height: 100'>
<?php
echo "<img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'><span id=\"res0\"></span>/".$lim[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'><span id=\"res1\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'><span id=\"res2\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'><span id=\"res3\"></span>/".$lim[1]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'><span id=\"res4\"></span>/".$lim[2]."</br></br>";
?>
          <p><?php echo $lang['taxesDesc'] ?></p>
          <form name="form1" method="post" action="taxes.php?town=<?php echo $_GET["town"]; ?>">
            <input class='textbox' name="taxes" type="text" size="5" value="<?php echo $prod[4]; ?>">
            <input class='button' type="submit" value="<?php echo $lang['setTaxes'] ?>">
          </form>
										<form name="form2" method="post" action="demolish.php?town=<?php echo $_GET["town"]; ?>">
            <select class='dropdown' name="a" id="a" onChange="ch_a(document.getElementById('a').selectedIndex)"><option value="0"><?php echo $lang['farm']; ?></option><option value="1"><?php echo $lang['forrest']; ?></option><option value="2"><?php echo $lang['quarry']; ?></option><option value="3"><?php echo $lang['ore_site']; ?></option><option value="4"><?php echo $lang['building']; ?></option></select>
												<span id="b"><select class='dropdown' name="b"></select></span>
            <input class='button' type="submit" value="<?php echo $lang['demolish'] ?>">
          </form>
          <p>
                     <?php
                        if (($data[7]<10)&&(!$c_status[7]))                                                                                 
                        {
                         $dur=explode("-", $buildings[7][6]); $upk=explode("-", $buildings[7][7]); $cost=explode("-", $buildings[7][4]); $dur[$data[7]]=explode(":", $dur[$data[7]]);
                         $tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[7][0]."&subB=-1'>".$lang['upgrade']." ".$name." ".$lang['toLevel']." ".($data[7]+1)."</a></br>".$buildings[7][8];
                         $tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[7]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[7]))."</br>".$lang['duration'].": ".($dur[$data[7]][0]*$lim[4]/100).":".($dur[$data[7]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[7]];
                         echo $tag;
                         if ($town[12]+$town[3]+$upk[$data[7]]>$lim[3]) label("</br>".$lang['noHouses']);
                         if (!(($res[0]>=$cost[0]*pow($r, $data[7]))&&($res[1]>=$cost[1]*pow($r, $data[7]))&&($res[2]>=$cost[2]*pow($r, $data[7]))&&($res[3]>=$cost[3]*pow($r, $data[7]))&&($res[4]>=$cost[4]*pow($r, $data[7])))) label("</br>".$lang['noResources']);
                         echo "</br>------------------------------------------</br>";
                        }
                     ?>
										</p>
          <p><?php echo $lang['buildDesc'] ?></br>
            </br>
<?php for ($i=0; $i<count($buildings); $i++)
                   if ((!$c_status[$i])&&(!$data[$i]))
                   {
                     if (($town[16]!=-1)||($i!=12)) echo "<img src=".$imgs.$fimgs."b".$i.".png title='".$buildings[$i][2]."' width=75 heigh=100></br>";
                     $okreq=1; $ok=1;
                         $name=explode("-", $buildings[$i][2]); $req=explode("/", $buildings[$i][3]); $dur=explode("-", $buildings[$i][6]); $upk=explode("-", $buildings[$i][7]); $cost=explode("-", $buildings[$i][4]); $dur[$data[$i]]=explode(":", $dur[$data[$i]]);
                         for ($j=0; $j<count($req); $j++) $req[$j]=explode("-", $req[$j]);
                         $tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[$i][0]."&subB=-1'>".$name[0]." ".$lang['build']."</a></br>".$buildings[$i][8]."</br>".$lang['req'].": ";
                         if ($req[0][0]!="") for ($j=0; $j<count($req); $j++)
                         {
                          if ($data[$req[$j][0]]<$req[$j][1]) $okreq=0;
                          $name=explode("-", $buildings[$req[$j][0]][2]);
                          $tag=$tag.$name[0]." ".$lang['level']." ".$req[$j][1]."; ";
                         } else $tag=$tag."-";
                         $tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".$cost[0]." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".$cost[1]." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".$cost[2]."<img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".$cost[3]." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".$cost[4]."</br>".$lang['duration'].": ".($dur[$data[$i]][0]*$lim[4]/100).":".($dur[$data[$i]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[0];
                         if (($town[16]==-1)&&($i==12)) $ok=0;
                         if ($ok)
                         {
                          echo $tag;
                          if ($town[12]+$town[3]+$upk[$data[$i]]>$lim[3]) label("</br>".$lang['noHouses']);
                          if (!$okreq) label("</br>".$lang['reqNotMet']);
                          if (!(($res[0]>=$cost[0])&&($res[1]>=$cost[1])&&($res[2]>=$cost[2])&&($res[3]>=$cost[3])&&($res[4]>=$cost[4]))) label("</br>".$lang['noResources']);
                          echo "</br>------------------------------------------</br>";
                         }
                        } ?>
              </p></td>
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