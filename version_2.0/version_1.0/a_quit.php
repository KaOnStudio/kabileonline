<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1]))
{
$alliance=alliance($_SESSION["user"][11]);
if ($_SESSION["user"][0]!=$alliance[2])
 if (a_quit($_SESSION["user"][0]))
 {
  msg($lang['independentAlly']);
  $_SESSION["user"][11]=0;
 }
 else msg($lang['error']);
else msg($lang['founderCantQuit']);
}
else msg($lang['insufData']);
?>