<?php include "antet.php"; include "func.php";
$_POST["name"]=clean($_POST["name"]); $_POST["email"]=clean($_POST["email"]); $_POST["pass"]=clean($_POST["pass"]); $_POST["pass_"]=clean($_POST["pass_"]);
if (!is_user($_POST["name"], $_POST["email"], $_SERVER["REMOTE_ADDR"]))
 if (($_POST["name"]!="")&&($_POST["pass"]!="")&&($_POST["pass"]==$_POST["pass_"]))
  if ($_SESSION["code"]==$_POST["code"]) install($_POST["name"], md5($_POST["pass"]), $_POST["email"], $_POST["faction"]+1);
  else msg($lang['incorCode']);
 else msg($lang['dataFields']);
else msg($lang['nameTaken']);
session_destroy();
?>