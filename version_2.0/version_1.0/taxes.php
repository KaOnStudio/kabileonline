<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["taxes"]))
{
 $_GET["town"]=clean($_GET["town"]); $_POST["taxes"]=clean($_POST["taxes"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $town[8]=explode("-", $town[8]);
 $prod=explode("-", $town[9]);
 $buildings=buildings($_SESSION["user"][10]);
 $buildings[11][5]=explode("-", $buildings[11][5]);
 if (abs($_POST["taxes"])<=210)
 {
  if ($town[8][11]) $bonus=$buildings[11][5][$town[8][11]-1]; else $bonus=0;
  update_taxes($prod[0]."-".$prod[1]."-".$prod[2]."-".$prod[3]."-".abs($_POST["taxes"]), 100+$bonus-abs($_POST["taxes"]), $_GET["town"]);
  echo '<script type="text/javascript" lang="javascript"> window.location="town.php?town='.$_GET["town"].'" </script>';
 } else msg($lang['taxHigh']);
}
else {header('Location: login.php'); die();}
?>