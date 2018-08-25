<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["type"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $wq=get_w($_GET["town"]);
 $weapons=weapons($_SESSION["user"][10]);

 $b=-1; for ($i=0; $i<count($wq); $i++) if ($wq[$i][1]==$_GET["type"]) $b=$i;
 $res=explode("-", $town[10]); $cost=explode("-", $weapons[$_GET["type"]][3]);
 $res[0]+=$cost[0]*$wq[$b][2]; $res[1]+=$cost[1]*$wq[$b][2]; $res[2]+=$cost[2]*$wq[$b][2]; $res[3]+=$cost[3]*$wq[$b][2]; $res[4]+=$cost[4]*$wq[$b][2]; $res=implode("-", $res);
 cancel_w($_GET["town"], $_GET["type"], $res);
}
else {header('Location: login.php'); die();}
?>