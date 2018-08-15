<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["name"]))
{
 $_POST["name"]=clean($_POST["name"]);
 $alliance=alliance($_SESSION["user"][11]);
 $usr=user_($_POST["name"]);
 if ($usr[1]==$_POST["name"])
  if (send_report($usr[0], $lang['invitation']."/".$_SESSION["user"][11], $lang['beenInvited']." <a class='q_link' href='a_view.php?id=".$alliance[0]."'>".$alliance[1]."</a> ".$lang['foundedBy']." <a class='q_link' href='profile_view.php?id=".$_SESSION["user"][0]."'>".$_SESSION["user"][1]."</a>.</br></br>[ <a class='q_link' href='a_join.php?id=".$alliance[0]."'>".$lang['accept']."</a> ]")) msg($lang['invSent']);
  else msg($lang['invNotSent']);
 else msg($lang['noUser']);
}
else msg($lang['insufData']);
?>