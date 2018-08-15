<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["a"], $_POST["id"], $_POST["name"], $_POST["desc"], $_POST["content"], $_GET["town"], $_GET["forum"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["forum"]=clean($_GET["forum"]);
 $alliance=alliance($_SESSION["user"][11]); $thread=thread(0, clean($_POST["id"]), 0, 0, 0, 0, 0); $ok=1;
 if (clean($_POST["a"])>1) if ($_SESSION["user"][0]!=$thread[2]) $ok=0;
 if ($aaliance[2]==$_SESSION["user"][0]) $ok=1;
 if ($alliance[0]==$_SESSION["user"][11])
  if ($ok)
  {
   if (thread(clean($_POST["a"]), clean($_POST["id"]), clean($_GET["forum"]), $_SESSION["user"][0], clean($_POST["name"]), clean($_POST["desc"]), clean($_POST["content"]))) echo $lang['opCompleted'];
   else echo "Failed.".mysql_error();
  }
  else echo $lang['accessDenied'];
 else echo $lang['notMember'];
}
else echo $lang['insufData'];
?>
