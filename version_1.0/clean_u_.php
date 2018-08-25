<?php include "antet.php"; include "func.php";

if (isset($_POST["d"]))
 if (isset($_SESSION["user"][0]))
  if (($_SESSION["user"][4]>3)&&($_SESSION["user"][2]==md5(clean($_POST["pass"]))))
  {
   msg(clean_u(clean($_POST["d"]))." idle users deleted.");
  }
  else msg($lang['notAdmin']);
 else msg($lang['accessDenied']);
else msg($lang['noInput']);
?>
