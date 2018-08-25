<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["name"], $_POST["desc"]))
{
 $_GET["town"]=clean($_GET["town"]); $_POST["name"]=clean($_POST["name"]); $_POST["desc"]=clean($_POST["desc"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 update_town($_POST["name"], $_POST["desc"], $_GET["town"]);
 header("Location: town.php?town=".$_GET["town"]);
}
else {header('Location: login.php'); die();}
?>