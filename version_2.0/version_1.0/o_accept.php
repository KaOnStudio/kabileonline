<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["send"], $_GET["seller"], $_GET["sType"], $_GET["sSubType"], $_GET["bType"], $_GET["bSubType"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["send"]=clean($_GET["send"]); $_GET["seller"]=clean($_GET["seller"]); $_GET["sType"]=clean($_GET["sType"]); $_GET["sSubType"]=clean($_GET["sSubType"]); $_GET["bType"]=clean($_GET["bType"]); $_GET["bSubType"]=clean($_GET["bSubType"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $offer=offer($_GET["seller"], $_GET["sType"], $_GET["sSubType"], $_GET["bType"], $_GET["bSubType"]);
 $merchants=get_tr($_GET["town"]);
 $loc=town_xy($_GET["town"]);
 $data=explode("-", $town[8]);
 if ($_GET["bType"]) $res=explode("-", $town[6]); else $res=explode("-", $town[10]);
 if ($_GET["send"]) $spd=40; else $spd=10;
 
 $seller=town($_GET["seller"]);
 $stowner=user($seller[1]);
 $pact=get_pact($_SESSION["user"][11], $stowner[11]);
 if (!$pact)
 {
  $bloc=town_xy($seller[0]);
  if ((!$_GET["send"])||(($_GET["send"])&&($town[16]>-1)&&($town[16]==$seller[16])))
   if ($res[$offer[6]]>=$offer[7])
    if ($data[10]-$merchants>=ceil($offer[7]/500*($offer[5]*9+1)))
    {
     $date=sqrt(pow($loc[0]-$bloc[0], 2)+pow($loc[1]-$bloc[1], 2))/$spd;
     if ((!$offer[13])||(($offer[13])&&($offer[13]>=$date)))
	 {
      $date=strtotime("+".floor($date)." hours ".floor(($date-floor($date))*60)." minutes");
      $date=strftime("%y-%m-%d %H:%M:%S", $date);
      $res[$_GET["bSubType"]]-=$offer[7]; $res=implode("-", $res);
      o_accept($_GET["town"], $_GET["seller"], $_GET["sType"], $_GET["sSubType"], $_GET["bType"], $_GET["bSubType"], $res, $date);
	 }
	 else msg($lang['durExceeds']);
    }
    else msg($lang['noMerchants']);
   else msg($lang['noResources']);
  else msg($lang['cantTradeWater']);
 }
 else msg($lang['cantTradeEnemy']);
}
else msg($lang['insufData']);
?>