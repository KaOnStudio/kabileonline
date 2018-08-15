<?php include "antet.php"; include "func.php";
if (isset($_POST["name"], $_POST["pass"], $_POST["account"]))
{
 $_POST["name"]=clean($_POST["name"]); $_POST["pass"]=clean($_POST["pass"]); $_POST["account"]=clean($_POST["account"]);
 $sitter=login($_POST["name"], md5($_POST["pass"]));
 if ($sitter[2]==md5($_POST["pass"]))
 {
  $_SESSION["user"]=sitted($_POST["account"], $_POST["name"]);
  if ($_SESSION["user"][0])
   {
    $row=update_lastVisit($_SESSION["user"][0]);
	msg($lang['welcome'].", ".$_SESSION["user"][1].".</br>".$lang['youHave']." ".$row[0]." ".$lang['newRep']." ".$row[1]." ".$lang['newMsg'].".");
   }
  else msg($lang['noUserSitted']);
 }
 else msg($lang['noUserSitter']);
}
else msg($lang['noInput']);
?>