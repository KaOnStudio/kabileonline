<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1])) delallrep($_SESSION["user"][0]);
else msg($lang['insufData']);
?>