<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["b"], $_GET["subB"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["b"]=clean($_GET["b"]); $_GET["subB"]=clean($_GET["subB"]);
 check_r($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]); $r=$faction[3];
 $buildings=buildings($_SESSION["user"][10]);
 
 
 $data=explode("-", $town[8]); $res=explode("-", $town[10]);
 $cost=explode("-", $buildings[$_GET["b"]][4]);
 $land=explode("/", $town[13]);
 if ($_GET["subB"]==-1) $d=$data[$_GET["b"]]; else { $land=explode("-", $land[$_GET["b"]]); $d=$land[$_GET["subB"]]; }
 $res[0]+=$cost[0]*pow($r, $d); $res[1]+=$cost[1]*pow($r, $d); $res[2]+=$cost[2]*pow($r, $d); $res[3]+=$cost[3]*pow($r, $d); $res[4]+=$cost[4]*pow($r, $d); $res=implode("-", $res);
 cancel_c($_GET["town"], $_GET["b"], $_GET["subB"], $res, $_SESSION["user"][10]);
}
else {header('Location: login.php'); die();}
?>