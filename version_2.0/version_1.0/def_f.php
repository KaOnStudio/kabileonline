<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["formation"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $gen=explode("-", $town[15]); $gen[3]=clean($_POST["formation"]);
 update_formation($town[0], implode("-", $gen));
}
else msg($lang['insufData']);
?>
