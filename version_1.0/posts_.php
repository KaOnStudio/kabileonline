<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["a"], $_POST["id"], $_POST["desc"], $_POST["content"], $_GET["town"], $_GET["thread"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["thread"]=clean($_GET["thread"]); $_POST["a"]=clean($_POST["a"]); $_POST["id"]=clean($_POST["id"]); $_POST["desc"]=clean($_POST["desc"]); $_POST["content"]=clean($_POST["content"]);
 $alliance=alliance($_SESSION["user"][11]); $post=post(0, $_POST["id"], 0, 0, 0, 0); $ok=1;
 if ($_POST["a"]>1) if ($_SESSION["user"][0]!=$post[2]) $ok=0;
 if ($aliance[2]==$_SESSION["user"][0]) $ok=1;
 if ($alliance[0]==$_SESSION["user"][11])
  if ($ok)
  {
   if (post($_POST["a"], $_POST["id"], $_GET["thread"], $_SESSION["user"][0], $_POST["desc"], $_POST["content"])) echo $lang['opCompleted'];
   else echo "Failed.".mysql_error();
  }
  else echo $lang['accessDenied'];
 else echo $lang['notMember'];
}
else echo $lang['insufData'];
?>
