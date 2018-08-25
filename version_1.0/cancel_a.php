<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["id"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["id"]=clean($_GET["id"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $aq=get_a($_GET["town"]);
 $units=units($_SESSION["user"][10]);

 $b=-1; for ($i=0; $i<count($aq); $i++) if ($aq[$i][5]==$_GET["id"]) $b=$i;
 $army=explode("-", $town[7]); $sarmy=explode("-", $aq[$b][3]); $gen=explode("-", $aq[$b][4]); $ogen=explode("-", $town[15]);
 for ($i=0; $i<count($army); $i++) $army[$i]+=$sarmy[$i]; $army=implode("-", $army);
 if (!$gen[0]) $gen=$ogen; else {$gen[3]=$ogen[3];} $gen=implode("-", $gen);
 cancel_a($_GET["town"], $_GET["id"], $army, $gen);
}
else {header('Location: login.php'); die();}
?>
