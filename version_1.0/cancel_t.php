<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["sType"], $_GET["sSubType"], $_GET["bType"], $_GET["bSubType"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["sType"]=clean($_GET["sType"]); $_GET["sSubType"]=clean($_GET["sSubType"]); $_GET["bType"]=clean($_GET["bType"]); $_GET["bSubType"]=clean($_GET["bSubType"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $tq=get_t($_GET["town"]);

 $b=-1; for ($i=0; $i<count($tq[0])-1; $i++) if (($tq[0][$i][0]==$_GET["sType"])&&($tq[0][$i][1]==$_GET["sSubType"])&&($tq[0][$i][3]==$_GET["bType"])&&($tq[0][$i][4]==$_GET["bSubType"])) $b=$i;
 if ($_GET["sType"]) $res=explode("-", $town[6]); else $res=explode("-", $town[10]);
 $res[$_GET["sSubType"]]+=$tq[0][$b][2]; $res=implode("-", $res);
 
 cancel_t($_GET["town"], $_GET["sType"], $_GET["sSubType"], $_GET["bType"], $_GET["bSubType"], $res);
}
else {header('Location: login.php'); die();}
?>