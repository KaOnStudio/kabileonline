<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_POST["a"], $_POST["b"]))
{
 $_GET["town"]=clean($_GET["town"]); $_POST["a"]=clean($_POST["a"]); $_POST["b"]=clean($_POST["b"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $buildings=buildings($_SESSION["user"][10]);
 $land=explode("/", $town[13]); $land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]); $land[4]=explode("-", $town[8]);
 $upk=explode("-", $buildings[$_POST["b"]][7]);
 $land[$_POST["a"]][$_POST["b"]]--; $town[3]-=$upk[$land[$_POST["a"]][$_POST["b"]]];
 if ($_POST["a"]<4)
 {
  $col="land"; $data=array(); $data[0]=implode("-", $land[0]); $data[1]=implode("-", $land[1]); $data[2]=implode("-", $land[2]); $data[3]=implode("-", $land[3]); $data=implode("/", $data);
 }
 else
 {
		$col="buildings"; $data=implode("-", $land[4]);
 }
 if ((($_POST["a"]==4)&&($_POST["b"]!=7))||($_POST["a"]<4))
 {
  $query="update towns set population=".$town[3].", ".$col."='".$data."' where id=".$town[0];
  mysql_query($query, $db_id); header("Location: hall.php?town=".$town[0]);
 }
 else msg($lang['accessDenied']);
}
else {header('Location: login.php'); die();}
?>
