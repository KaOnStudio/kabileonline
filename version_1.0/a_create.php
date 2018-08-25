<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["name"], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]); $_POST["name"]=clean($_POST["name"]);
 if (!$_SESSION["user"][11]) $_SESSION["user"][11]=a_create($_POST["name"], $_SESSION["user"][0]);
 else msg($lang["allreadyInAlly"]);
 header("Location: embassy.php?town=".$_GET["town"]);
}
else msg($lang['insufData']);
?>