<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["type"], $_POST["sQ"], $_POST["sType"], $_POST["sSubType"], $_POST["maxTime"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]); $_POST["name"]=clean($_POST["name"]); $_POST["sQ"]=clean($_POST["sQ"]); $_POST["sType"]=clean($_POST["sType"]); $_POST["sSubType"]=clean($_POST["sSubType"]); $_POST["maxTime"]=clean($_POST["maxTime"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $merchants=get_tr($_GET["town"]);
 $loc=town_xy($_GET["town"]);
 $data=explode("-", $town[8]);
 
 if ($data[10]-$merchants>=ceil($_POST["sQ"]/500*($_POST["sType"]*9+1)))
 if ($_GET["type"])
  if (isset($_POST["name"]))
  {
   if ($_POST["sType"]) $res=explode("-", $town[6]); else $res=explode("-", $town[10]);
   if ($res[$_POST["sSubType"]]>=$_POST["sQ"])
   {
    $buyer=town_($_POST["name"]);
    if (isset($buyer[0]))
    {
   	 $btowner=user($buyer[1]);
   	 $pact=get_pact($_SESSION["user"][11], $btowner[11]);
	   if (!$pact)
	   {
	    $bloc=town_xy($buyer[0]);
	    if ($town[16]==$buyer[16]) $spd=40; else $spd=10;
	    $date=sqrt(pow($loc[0]-$bloc[0], 2)+pow($loc[1]-$bloc[1], 2))/$spd;
	    if ((!$_POST["maxTime"])||(($_POST["maxTime"])&&($_POST["maxTime"]>=$date)))
	    {
	     $date=strtotime("+".floor($date)." hours ".floor(($date-floor($date))*60)." minutes");
       $date=strftime("%y-%m-%d %H:%M:%S", $date);
       $res[$_POST["sSubType"]]-=$_POST["sQ"];
       trade($_GET["town"], $buyer[0], $_POST["sQ"], $_POST["sType"], $_POST["sSubType"], 0, 0, 0, $_GET["type"], $date, implode("-", $res), $_POST["maxTime"]);
	     } else msg($lang['durExceeds']);
	   } else msg($lang['cantTradeEnemy']);
    }
    else msg($lang['noTown']);
   }
   else msg($lang['noResources']);
  }
  else {header('Location: login.php'); die();}
 else if (isset($_POST["bQ"], $_POST["bType"], $_POST["bSubType"]))
 {
  if ($_POST["sType"]) $res=explode("-", $town[6]); else $res=explode("-", $town[10]);
  if ($res[$_POST["sSubType"]]>=$_POST["sQ"])
  {
   $res[$_POST["sSubType"]]-=$_POST["sQ"];
   trade($_GET["town"], 0, $_POST["sQ"], $_POST["sType"], $_POST["sSubType"], $_POST["bQ"], $_POST["bType"], $_POST["bSubType"], $_GET["type"], "1988-01-25 12:00:00", implode("-", $res), $_POST["maxTime"]);
  }
  else msg("Not enough resources/goods.");
 }
 else {header('Location: login.php'); die();}
 else msg($lang['noMerchants']);
}
else {header('Location: login.php'); die();}
?>