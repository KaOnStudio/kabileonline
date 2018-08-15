<?php include "antet.php"; include "func.php";

if (isset($_POST["name"]))
{
 $_POST["name"]=clean($_POST["name"]);
 if (isset($_SESSION["user"][0]))
  if ($_SESSION["user"][2]==md5($_POST["pass"])) ch_capital($_POST["name"], $_SESSION["user"][0]);
  else msg($lang['wrongPass']);
 else msg($lang['accessDenied']);
}
else msg($lang['noInput']);
?>
