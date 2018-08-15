<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["type"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["type"]=clean($_GET["type"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $uq=get_u($_GET["town"]);
 $units=units($_SESSION["user"][10]);

 $b=-1; for ($i=0; $i<count($uq); $i++) if ($uq[$i][1]==$_GET["type"]) $b=$i;
 $res=explode("-", $town[10]); $cost=explode("-", $units[$_GET["type"]][4]); $req=explode("-", $units[$_GET["type"]][3]); $weaps=explode("-", $town[6]);
 if ($units[$_GET["type"]][3]) for ($i=0; $i<count($req); $i++) $weaps[$req[$i]]+=$uq[$b][2];
 $weaps=implode("-", $weaps);
 $res[0]+=$cost[0]*$uq[$b][2]; $res[1]+=$cost[1]*$uq[$b][2]; $res[2]+=$cost[2]*$uq[$b][2]; $res[3]+=$cost[3]*$uq[$b][2]; $res[4]+=$cost[4]*$uq[$b][2]; $res=implode("-", $res);
 cancel_u($_GET["town"], $_GET["type"], $res, $weaps, $uq[$b][2]);
}
else {header('Location: login.php'); die();}
?>
