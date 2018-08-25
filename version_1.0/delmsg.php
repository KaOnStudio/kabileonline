<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
 delmsg($_GET["id"], $_SESSION["user"][0]);
}
else msg($lang['insufData']);
?>