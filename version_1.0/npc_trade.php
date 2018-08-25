<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["sQ"], $_POST["sSubType"], $_POST["bSubType"]))
{
 $_POST["sQ"]=clean($_POST["sQ"]); $_POST["sSubType"]=clean($_POST["sSubType"]); $_POST["bSubType"]=clean($_POST["bSubType"]);
 $_GET["town"]=clean($_GET["town"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $res=explode("-", $town[10]);
 
   if ($res[$_POST["sSubType"]]>=$_POST["sQ"])
   {
      $r=rand(25, 75);
      $res[$_POST["sSubType"]]-=$_POST["sQ"]; $res[$_POST["bSubType"]]+=$_POST["sQ"]*$r/100; $res=implode("-", $res);
      if (npc_trade($_GET["town"], $res)) msg($lang['transComplete']." ".$r."%.");
	  else msg($lang['error']);
   }
   else msg($lang['noResources']);
}
else {header('Location: login.php'); die();}
?>