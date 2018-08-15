<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["name"], $_POST["desc"], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]); $_POST["name"]=clean($_POST["name"]); $_POST["desc"]=clean($_POST["desc"]);
 $alliance=alliance($_SESSION["user"][11]);
 if ($alliance[2]==$_SESSION["user"][0])
 {
  update_a($_POST["name"], $_POST["desc"], $_SESSION["user"][11]);
  header("Location: embassy.php?town=".$_GET["town"]);
 }
 else msg($lang['notFounder']);
}
else msg($lang['insufData']);
?>