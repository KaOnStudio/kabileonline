<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town($_GET["town"]);
 if ($town[0])
  if ($town[1]==$_SESSION["user"][0])
   if (!$town[4])
   {
    purge($_GET["town"]);
    header('Location: towns.php');
   }
   else msg($lang['cantPurgeCap']);
  else {header('Location: login.php'); die();}
 else msg($lang['noTown']);
}
else msg($lang['incorData']);
?>
