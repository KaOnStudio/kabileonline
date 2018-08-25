<?php include "antet.php"; include "func.php";
$config=config();
if (!$config[3][1]) msg($lang['regClosed']);
else
{
 $_POST["email"]=clean($_POST["email"]); $_POST["name"]=clean($_POST["name"]); $_POST["pass"]=clean($_POST["pass"]); $_POST["pass_"]=clean($_POST["pass_"]); $_POST["faction"]=clean($_POST["faction"]);
 if (!$config[0][1]) $ip=$_SERVER["REMOTE_ADDR"]; else $ip="-";
 if (!$config[1][1]) $email=$_POST["email"]; else $email="-";
 
 if (!is_user($_POST["name"], $email, $ip))
  if (($_POST["name"]!="")&&($_POST["pass"]!="")&&($_POST["pass"]==$_POST["pass_"]))
   if ($_SESSION["code"]==$_POST["code"]) reg($_POST["name"], md5($_POST["pass"]), $_POST["email"], $_POST["faction"]+1);
   else msg($lang['incorCode']);
  else msg($lang['dataFields']);
 else msg($lang['taken']);
 session_destroy();
}
?>