<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_GET["a1"], $_GET["a2"]))
{
 $_GET["a1"]=clean($_GET["a1"]); $_GET["a2"]=clean($_GET["a2"]);
$a2=alliance($_GET["a2"]);
if ($_SESSION["user"][0]==$a2[2])
 if (peace_($_GET["a1"], $_GET["a2"])) msg($lang['signedPtreaty']);
 else msg($lang['noPTreaty']);
else msg($lang['notFounder']);
}
else msg($lang['insufData']);
?>