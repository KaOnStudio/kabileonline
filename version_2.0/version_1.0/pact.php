<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["name"], $_GET["type"], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]); $_POST["name"]=clean($_POST["name"]);
 $alliance=alliance($_SESSION["user"][11]);
 if ($_SESSION["user"][0]==$alliance[2])
  if (pact($_GET["type"], $_POST["name"], $_SESSION["user"][11])) msg($lang['pactSent']);
  else msg($lang['noSuchAlly']);
 else msg($lang['notFounder']);
}
else msg($lang['insufData']);
?>