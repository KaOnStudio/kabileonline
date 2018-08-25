<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_POST["pass"], $_POST["subject"], $_POST["contents"])) 
{
 $_POST["pass"]=clean($_POST["pass"]); $_POST["subject"]=clean($_POST["subject"]); $_POST["contents"]=clean($_POST["contents"]);
 if ($_POST["subject"]!="")
  if (($_SESSION["user"][4]>3)&&($_SESSION["user"][2]==md5($_POST["pass"])))
  {
   send_to_all($_POST["subject"], $_POST["contents"]);
   msg($lang['checkRep']);
  } else msg($lang['notAdmin']);
 else msg($lang['noSubject']);
} else msg($lang['insufData']);
?>
