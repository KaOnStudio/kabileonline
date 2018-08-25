<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0]))
 cancel_d($_SESSION["user"][0]);
else msg($lang['logWrongInput']);
?>