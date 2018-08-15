<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0]))
 if (($_SESSION["user"][4]>3)&&($_SESSION["user"][2]==md5(clean($_POST["pass"])))) check_d_all();
 else msg($lang['notAdmin']);
else msg($lang['accessDenied']);
?>
