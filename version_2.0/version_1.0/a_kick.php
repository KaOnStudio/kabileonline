<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
$alliance=alliance($_SESSION["user"][11]);
 if ($_SESSION["user"][0]==$alliance[2])
  if ($_SESSION["user"][0]!=clean($_GET["id"]))
   if (a_quit(clean($_GET["id"]))) msg($lang['leftAlly']);
   else msg($lang['error']);
  else msg($lang['cantKickSelf']);
 else msg($lang['onlyFounderKick']);
}
else msg($lang['insufData']);
?>