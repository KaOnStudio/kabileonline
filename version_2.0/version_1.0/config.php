<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][1], $_POST["pass"]))
 if ($_SESSION["user"][2]==md5(clean($_POST["pass"])))
  if ($_SESSION["user"][4]==5)
  {
   if (config_(clean($_POST["var"]), clean($_POST["val"]))) msg("Variables changed.");
   else msg("Failed.".mysql_error());
  }
  else msg("Only the owner can modify game variables.");
 else msg("Incorrect password.");
else msg("Insuficient data.");
?>