<?php include "antet.php"; include "func.php";

if (isset($_GET["name"]))
{
 $_GET["name"]=clean($_GET["name"]);
 $config=config();
 if ($config[4][1])
 {
  $usr=user_($_GET["name"]);
  if ($usr[1]==$_GET["name"])
  {
   $pass=rand(1000, 9999);
   pass($usr[0], md5($pass));
   if (mail($usr[3], "Game password", $lang['yourPass']." ".$lang['is'].": ".$pass)) msg($lang['emailSent']);
   else msg($lang['mailFail']);
  }
  else msg($lang['noUser']);
 }
 else msg($lang['mailPassOff']);
} else msg($lang['noSpecUser']);
?>