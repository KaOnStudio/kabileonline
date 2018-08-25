<?php include "antet.php"; include "func.php";
if (isset($_SESSION["user"][0], $_POST["msg"], $_GET["sid"]))
{
 $_GET["sid"]=clean($_GET["sid"]); $_POST["msg"]=clean($_POST["msg"]);
 if ($_POST["msg"])
  if ($_POST["msg"][0]=="/")
  {
   switch($_POST["msg"][1])
   {
    case 'w'://whisper
    {
     $msg=explode(" ", $_POST["msg"], 3);
     $usr=user_($msg[1]);
     if ($usr[0])
     {
      $msg[2]=$_SESSION["user"][1]." whispered: ".$msg[2];
      send_chat($_SESSION["user"][0], $_GET["sid"], clean($msg[2]), $usr[0]);
     }
     else send_chat($_SESSION["user"][0], $_GET["sid"], "[No such character.]", $_SESSION["user"][0]);
    } break;
    case 'm'://mute
    {
     if ($_SESSION["user"][4]>2)
     {
      $msg=explode(" ", $_POST["msg"], 2);
      $usr=user_($msg[1]);
      if ($usr[0])
      {
       mute($usr[0], 1);
       send_chat($_SESSION["user"][0], $_GET["sid"], "[Character muted.]", $_SESSION["user"][0]);
      }
      else send_chat($_SESSION["user"][0], $_GET["sid"], "[No such character.]", $_SESSION["user"][0]);
     }
     else send_chat($_SESSION["user"][0], $_GET["sid"], "[You are not a moderator.]", $_SESSION["user"][0]);
    } break;
    case 'u'://unmute
    {
     if ($_SESSION["user"][4]>2)
     {
      $msg=explode(" ", $_POST["msg"], 2);
      $usr=user_($msg[1]);
      if ($usr[0])
      {
       mute($usr[0], 0);
       send_chat($_SESSION["user"][0], $_GET["sid"], "[Character unmuted.]", $_SESSION["user"][0]);
      }
      else send_chat($_SESSION["user"][0], $_GET["sid"], "[No such character.]", $_SESSION["user"][0]);
     }
     else send_chat($_SESSION["user"][0], $_GET["sid"], "[You are not a moderator.]", $_SESSION["user"][0]);
    } break;
   }
  }
  else send_chat($_SESSION["user"][0], $_GET["sid"], $_SESSION["user"][1].": ".clean($_POST["msg"]), 0);
 $chat=get_chat($_SESSION["user"][0], $_GET["sid"], $_SESSION["user"][6], $system[0]);
 $_SESSION["user"][6]=date('Y-m-d H:i:s'); $data="";
 for ($i=0; $i<count($chat); $i++) $data=$data.$chat[$i]."\r\n";
 echo $data;
}
else msg("Insuficient data.");
?>
