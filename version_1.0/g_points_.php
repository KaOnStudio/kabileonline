<?php include "antet.php"; include "func.php";

if (isset($_POST["name"], $_POST["q"]))
 if (isset($_SESSION["user"][0]))
  if (($_SESSION["user"][4]>3)&&($_SESSION["user"][2]==md5(clean($_POST["pass"]))))
  {
			$_POST["name"]=clean($_POST["name"]); $_POST["q"]=clean($_POST["q"]);
   $names=$_POST["name"]; $names=explode(":", $names); $names="\"".implode("\", \"", $names)."\"";
   if ($_POST["name"]!="")
    if (g_points($names, $_POST["q"])) msg($_POST["q"]." points sent to ".$_POST["name"]);
    else msg("Failure.".mysql_error());
   else msg($lang['emptyUserList']);
  }
  else msg($lang['notAdmin']);
 else msg($lang['accessDenied']);
else msg($lang['noInput']);
?>
