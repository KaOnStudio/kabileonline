<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["a"], $_POST["id"], $_POST["parent"], $_POST["name"], $_POST["desc"], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $alliance=alliance($_SESSION["user"][11]);
 if ($alliance[2]==$_SESSION["user"][0])
 {
  if (forum(clean($_POST["a"]), clean($_POST["id"]), $_SESSION["user"][11], clean($_POST["parent"]), clean($_POST["name"]), clean($_POST["desc"]))) echo $lang['opCompleted'];
  else echo "Failed.".mysql_error();
 }
 else echo $lang['notFounder'];
}
else echo $lang['insufData'];
?>
