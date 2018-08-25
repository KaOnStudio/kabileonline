<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
 $town=town($_GET["id"]);
 if (!$town[1])
 {
  aquire($_GET["id"], $_SESSION["user"][0]);
  header('Location: towns.php');
 }
 else msg($lang['townBelongs']);
}
else msg($lang['incorData']);
?>
