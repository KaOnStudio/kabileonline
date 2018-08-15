<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["lang"]))
{
 $_GET["lang"]=clean($_GET["lang"]);
 if (ch_lang($_SESSION["user"][0], $_GET["lang"]))
 {
  $_SESSION["user"][16]=$_GET["lang"];
  msg("Language changed.");
 }
 else msg("Failure.".mysql_error());
}
else if (isset($_SESSION["lang"], $_GET["lang"]))
{
 $_GET["lang"]=clean($_GET["lang"]);
 $_SESSION["lang"]=$_GET["lang"];
 msg("Language changed.");
}
else msg($lang['insufData']);
?>
