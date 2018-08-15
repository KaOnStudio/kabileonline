<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["pass"]))
 if ($_SESSION["user"][2]==md5(clean($_POST["pass"])))
  if ($_SESSION["user"][1]!="guest") delacc($_SESSION["user"][0]);
  else msg($lang['guestAcc']);
 else msg($lang['accessDenied']);
else msg($lang['insufData']);
?>