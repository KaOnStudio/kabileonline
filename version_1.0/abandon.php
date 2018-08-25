<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town(clean($_GET["town"]));
 if ($town[1]==$_SESSION["user"][0])
  if (!$town[4])
  {
   abandon(clean($_GET["town"]));
   header('Location: towns.php');
  }
  else msg($lang['cantAbandCapit']);
  else {header('Location: login.php'); die();}
}
else msg($lang['incorData']);
?>
