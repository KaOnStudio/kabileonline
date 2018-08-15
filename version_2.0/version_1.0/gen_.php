<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["utype"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 set_gen($town[0], clean($_POST["utype"]));
}
else msg($lang['insufData']);
?>
