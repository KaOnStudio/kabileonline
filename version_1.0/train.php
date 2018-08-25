<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["type"], $_POST["q"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]); $_POST["q"]=clean($_POST["q"]);
 $_POST["q"]=abs($_POST["q"]);//anti cheat
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $units=units($faction[0]);
 $u_status=get_uns($_GET["town"]);
 $weaps=explode("-", $town[6]); $res=explode("-", $town[10]); $lim=explode("-", $town[11]); $u_upgrades=explode("-", $town[17]); $w_upgrades=explode("-", $town[18]); $a_upgrades=explode("-", $town[19]);
 
 $l=$lim[8]; $dur=explode(":", $units[$_GET["type"]][9]); $cost=explode("-", $units[$_GET["type"]][4]); $req=explode("-", $units[$_GET["type"]][3]);
 $okreq=1; if ($req[0]!="") for ($i=0; $i<count($req); $i++) if ($weaps[$req[$i]]<$_POST["q"]) $okreq=0; else $weaps[$req[$i]]-=$_POST["q"]; $weaps=implode("-", $weaps);
 if (!$u_status[$_GET["type"]]) $a=0; else $a=1;
 if (($u_upgrades[$_GET["type"]])&&($w_upgrades[$_GET["type"]])&&($a_upgrades[$_GET["type"]]))
  if ($town[12]+$town[3]+$_POST["q"]<=$lim[3])
   if (($res[0]>=$cost[0]*$_POST["q"])&&($res[1]>=$cost[1]*$_POST["q"])&&($res[2]>=$cost[2]*$_POST["q"])&&($res[3]>=$cost[3]*$_POST["q"])&&($res[4]>=$cost[4]*$_POST["q"]))
    if ($okreq)
    {
     $res[0]-=$cost[0]*$_POST["q"]; $res[1]-=$cost[1]*$_POST["q"]; $res[2]-=$cost[2]*$_POST["q"]; $res[3]-=$cost[3]*$_POST["q"]; $res[4]-=$cost[4]*$_POST["q"]; $res=implode("-", $res);
     train($a, $_GET["town"], $_GET["type"], abs($_POST["q"]), (floor($dur[0]*$_POST["q"]*$l/100)).":".((($dur[0]*$_POST["q"]*$l/100)-floor($dur[0]*$_POST["q"]*$l/100))*60+floor($dur[1]*$_POST["q"]*$l/100)).":".((($dur[1]*$_POST["q"]*$l/100)-floor($dur[1]*$_POST["q"]*$l/100))*60), $res, $weaps);
    }
    else msg($lang['noItems']);
   else msg($lang['noResources']);
  else msg($lang['noHouses']);
 else msg($lang['researchUnit']." ".$lang['toLevel']." 1.");
}
else {header('Location: login.php'); die();}
?>
