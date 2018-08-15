<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_POST["name"], $_POST["rank"]))
{
 $alliance=alliance($_SESSION["user"][11]);
 if ($_SESSION["user"][0]==$alliance[2])
 {
		$_POST["name"]=clean($_POST["name"]); $_POST["rank"]=clean($_POST["rank"]);
  $usr=user_($_POST["name"]);
  if ($usr[0])
  if ($usr[11]==$_SESSION["user"][11])
   if (update_rank($usr[0], $_POST["rank"])) msg($lang['rankUpd']);
   else msg($lang['error']);
  else msg($lang['notMemberYourAlly']);
  else msg($lang['noUser']);
 }
 else msg($lang['notFounder']);
}
else {header('Location: login.php'); die();}
?>