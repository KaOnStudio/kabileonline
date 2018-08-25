<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["pass"]))
{
 $_POST["pass"]=clean($_POST["pass"]);
 $alliance=alliance($_SESSION["user"][11]);
 if ($_SESSION["user"][2]==md5($_POST["pass"]))
 if ($alliance[2]==$_SESSION["user"][0])
 {
  if (a_del($_SESSION["user"][11])) msg($lang['AllyDeleted']);
  $_SESSION["user"][11]=0;
 } else msg($lang['notFounder']);
 else msg($lang['wrongPass']);
} else msg($lang['insufData']);
?>