<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["unit"], $_GET["tree"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["unit"]=clean($_GET["unit"]); $_GET["tree"]=clean($_GET["tree"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $upq=get_up($_GET["town"]);
 $units=units($_SESSION["user"][10]);

 $res=explode("-", $town[10]); $cost=explode("-", $units[$_GET["unit"]][4]); $x_upgrades=explode("-", $town[$_GET["tree"]]);
 $res[0]+=$cost[0]*($x_upgrades[$_GET["unit"]]+1); $res[1]+=$cost[1]*($x_upgrades[$_GET["unit"]]+1); $res[2]+=$cost[2]*($x_upgrades[$_GET["unit"]]+1); $res[3]+=$cost[3]*($x_upgrades[$_GET["unit"]]+1); $res[4]+=$cost[4]*($x_upgrades[$_GET["unit"]]+1); $res=implode("-", $res);
 cancel_uup($_GET["town"], $_GET["unit"], $_GET["tree"], $res);
}
else {header('Location: login.php'); die();}
?>