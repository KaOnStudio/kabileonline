<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_GET["unit"], $_GET["tree"], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["unit"]=clean($_GET["unit"]); $_GET["tree"]=clean($_GET["tree"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $uup_status=get_uup($_GET["town"]);
 $units=units($faction[0]);
 $res=explode("-", $town[10]); $x_upgrades=explode("-", $town[$_GET["tree"]]); $cost=explode("-", $units[$_GET["unit"]][4]);
 
 if ($x_upgrades[$_GET["unit"]]<10)
  if (!$uup_status[$_GET["unit"]])
   if (($res[0]>=$cost[0]*($x_upgrades[$_GET["unit"]]+1))&&($res[1]>=$cost[1]*($x_upgrades[$_GET["unit"]]+1))&&($res[2]>=$cost[2]*($x_upgrades[$_GET["unit"]]+1))&&($res[3]>=$cost[3]*($x_upgrades[$_GET["unit"]]+1))&&($res[4]>=$cost[4]*($x_upgrades[$_GET["unit"]]+1)))
   {
    $res[0]-=$cost[0]*($x_upgrades[$_GET["unit"]]+1); $res[1]-=$cost[1]*($x_upgrades[$_GET["unit"]]+1); $res[2]-=$cost[2]*($x_upgrades[$_GET["unit"]]+1); $res[3]-=$cost[3]*($x_upgrades[$_GET["unit"]]+1); $res[4]-=$cost[4]*($x_upgrades[$_GET["unit"]]+1); 
    upgrade_u($_GET["town"], implode("-", $res), $_GET["unit"], $_GET["tree"], $units[$_GET["unit"]][9]);
    header("Location: town.php?town=".$_GET["town"]);
   }
   else msg($lang['noResources']);
  else msg($lang['unitAlrUpgraded']);
 else msg($lang['abilityMax']);
}
else msg($lang['insufData']);
?>