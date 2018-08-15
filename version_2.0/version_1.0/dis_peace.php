<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_GET["a1"], $_GET["a2"]))
{
 $_GET["a1"]=clean($_GET["a1"]); $_GET["a2"]=clean($_GET["a2"]);
$alli=alliance($_SESSION["user"][11]);
if ($_SESSION["user"][0]==$alli[2])
 if (dis_peace($_GET["a1"], $_GET["a2"])) msg($lang['dissolvedPeace']);
 else msg($lang['noTreaty']);
else msg($lang['notFounder']);
}
else msg($lang['insufData']);
?>