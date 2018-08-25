<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["type"], $_POST["q"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]); $_POST["q"]=clean($_POST["q"]);
 $_POST["q"]=abs($_POST["q"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $weapons=weapons($_SESSION["user"][10]);
 $w_status=get_wea($_GET["town"]);
 $data=explode("-", $town[6]); $res=explode("-", $town[10]); $lim=explode("-", $town[11]);
 
 if ($_GET["type"]!=9) $l=$lim[9]; else $l=$lim[10];
 $dur=explode(":", $weapons[$_GET["type"]][4]); $cost=explode("-", $weapons[$_GET["type"]][3]);
 if (!$w_status[$_GET["type"]]) $a=0; else $a=1;
 if ($data[$_GET["type"]]+$_POST["q"]<=$lim[12])
  if (($res[0]>=$cost[0]*$_POST["q"])&&($res[1]>=$cost[1]*$_POST["q"])&&($res[2]>=$cost[2]*$_POST["q"])&&($res[3]>=$cost[3]*$_POST["q"])&&($res[4]>=$cost[4]*$_POST["q"]))
  {
   $res[0]-=$cost[0]*$_POST["q"]; $res[1]-=$cost[1]*$_POST["q"]; $res[2]-=$cost[2]*$_POST["q"]; $res[3]-=$cost[3]*$_POST["q"]; $res[4]-=$cost[4]*$_POST["q"]; $res=implode("-", $res);
   forge($a, $_GET["town"], $_GET["type"], abs($_POST["q"]), (floor($dur[0]*$_POST["q"]*$l/100)).":".((($dur[0]*$_POST["q"]*$l/100)-floor($dur[0]*$_POST["q"]*$l/100))*60+floor($dur[1]*$_POST["q"]*$l/100)).":".((($dur[1]*$_POST["q"]*$l/100)-floor($dur[1]*$_POST["q"]*$l/100))*60), $res);
  }
  else msg($lang['noResources']);
 else msg($lang['noStorage']);
}
else {header('Location: login.php'); die();}
?>