<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["page"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["page"]=clean($_GET["page"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $offers=offers(clean($_POST["sType"]), clean($_POST["sSubType"]), clean($_POST["bType"]), clean($_POST["bSubType"]));
 $weapons=weapons($_SESSION["user"][10]);
 $merchants=get_tr($_GET["town"]);
 $loc=town_xy($_GET["town"]);
 
 $data=explode("-", $town[8]); $imgs=$_SESSION["user"][13]; $fimgs=$faction[2];
 $goods[0][0]="Crop"; $goods[0][1]="Lumber"; $goods[0][2]="Stone"; $goods[0][3]="Iron"; $goods[0][4]="Gold";
 for ($i=0; $i<count($weapons); $i++) $goods[1][$i]=$weapons[$i][2];
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['offer'] ?></title>
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
        <?php echo $lang['availMerchants'].": ".($data[10]-$merchants)."/".$data[10].".</br>"; ?>
        <table class="q_table" style="border-collapse: collapse" width="600" border="1">
            <tr>
              <td><?php echo $lang['offer'] ?></td>
              <td><?php echo $lang['search'] ?></td>
              <td><?php echo $lang['town'] ?></td>
              <td><?php echo $lang['duration'] ?></td>
              <td><?php echo $lang['send'] ?></td>
            </tr>
            <?php for ($i=$_GET["page"]*10; $i<$_GET["page"]*10+10; $i++)
			{
			 if (isset($offers[$i]))
			 {
			  if ($offers[$i][2]) $res=explode("-", $town[6]); else $res=explode("-", $town[10]);
			  $seller=town($offers[$i][0]);
			  $sloc=town_xy($seller[0]);
			  $time=sqrt(pow($loc[0]-$sloc[0], 2)+pow($loc[1]-$sloc[1], 2))/10; $dur=$time;
			  $ldur=floor($dur).":".floor(($dur-floor($dur))*60).":".floor((($dur-floor($dur))*60-floor(($dur-floor($dur))*60))*60); $dur/=4;
			  $wdur=floor($dur).":".floor(($dur-floor($dur))*60).":".floor((($dur-floor($dur))*60-floor(($dur-floor($dur))*60))*60);
			  if ($town[16]==$seller[16]) $shipL="<a class='q_link' href='o_accept.php?town=".$_GET["town"]."&send=1&seller=".$offers[$i][0]."&sType=".$offers[$i][2]."&sSubType=".$offers[$i][3]."&bType=".$offers[$i][5]."&bSubType=".$offers[$i][6]."'>ship</a>";
			  else
			  {
			   $wdur="-"; $shipL="-";
			  }
			  $send="<a class='q_link' href='o_accept.php?town=".$_GET["town"]."&send=0&seller=".$offers[$i][0]."&sType=".$offers[$i][2]."&sSubType=".$offers[$i][3]."&bType=".$offers[$i][5]."&bSubType=".$offers[$i][6]."'>".$lang['caravan']."</a> | ".$shipL;
			  if ($res[$offers[$i][6]]<$offers[$i][7]) $send=$lang['noResources'];
			  if ($data[10]-$merchants<ceil($offers[$i][7]/500*($offers[$i][5]*9+1))) $send=$lang['noMerchants'];
			  echo "<tr>
              <td><img src='".$imgs.$fimgs.$offers[$i][2].$offers[$i][3].".gif' title='".$goods[$offers[$i][2]][$offers[$i][3]]."'> ".$offers[$i][4]."</td>
              <td><img src='".$imgs.$fimgs.$offers[$i][5].$offers[$i][6].".gif' title='".$goods[$offers[$i][5]][$offers[$i][6]]."'> ".$offers[$i][7]."</td>
			  <td><a class='q_link' href='profile_view.php?id=".$seller[1]."'>".$seller[2]."</a></td>
			  <td>".$ldur." | ".$wdur."</td>
              <td>".$send."</td>
            </tr>";
			 }
			} ?>
          </table>
<?php
		  for ($i=$_GET["page"]-5; $i<=$_GET["page"]-1; $i++) if ($i>=0) echo "<a class='q_link' href='offers.php?town=".$town[0]."&page=".$i."'>".$i."</a> | ";
		  echo $_GET["page"]." | ";
		  for ($i=$_GET["page"]+1; $i<$_GET["page"]+5; $i++) if ($i<ceil(count($offers)/10)) echo "<a class='q_link' href='offers.php?town=".$town[0]."&page=".$i."'>".$i."</a> | ";
?>
        </td>
      </tr>
      <tr>
        <td class="td_bottom_menu">
          <?php menu_down(); ?>
        </td>
      </tr>
    </table>
<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>