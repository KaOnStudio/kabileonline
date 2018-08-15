<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["pass"]))
 if ($_SESSION["user"][2]==md5(clean($_POST["pass"])))
 {
		$_POST["email"]=clean($_POST["email"]); $_POST["desc"]=clean($_POST["desc"]); $_POST["sitter"]=clean($_POST["sitter"]); $_POST["grpath"]=clean($_POST["grpath"]); $_POST["lang"]=clean($_POST["lang"]);
  $ar=array("\'", "\""); $_GET["email"]=str_replace($ar, "", clean($_GET["email"]));
  profile($_SESSION["user"][0], $_POST["email"], $_POST["desc"], $_POST["sitter"], $_POST["grpath"], $_POST["lang"]);
  $_SESSION["user"][3]=$_POST["email"]; $_SESSION["user"][9]=$_POST["desc"]; $_SESSION["user"][12]=$_POST["sitter"]; $_SESSION["user"][13]=$_POST["grpath"]; $_SESSION["user"][16]=$_POST["lang"];
 }
 else msg($lang['accessDenied']);
else msg($lang['insufData']);
?>