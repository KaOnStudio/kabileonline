<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_POST["a"], $_POST["ri"], $_POST["rn"]))
 if (($_SESSION["user"][4]>3)&&($_SESSION["user"][2]==md5(clean($_POST["pass"]))))
 {
  update_room(clean($_POST["a"]), clean($_POST["ri"]), clean($_POST["rn"]));
  header('Location: chat_s.php');
 }
 else msg("You are not an admin.");
else msg("Access denied.");
?>
