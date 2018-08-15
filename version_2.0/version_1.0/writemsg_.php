<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["recipient"], $_POST["subject"], $_POST["contents"])) 
{
 $_POST["recipient"]=clean($_POST["recipient"]); $_POST["subject"]=clean($_POST["subject"]); $_POST["contents"]=clean($_POST["contents"]);
 if ($_POST["subject"]!="")
 {
  $usr=user_($_POST["recipient"]);
  if (isset($usr[0]))
   if (send_message($_SESSION["user"][0], $usr[0], $_POST["subject"], $_POST["contents"])) msg($lang['msgSent']);
   else msg($lang['msgNotSent']);
  else msg($lang['noUser']);
 } else msg($lang['noSubject']);
} else msg($lang['insufData']);
?>