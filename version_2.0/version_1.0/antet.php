<?php
session_start();
echo("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>");
include "language/tr.php";
/* database işlemleri */
$db_host = "localhost"; 
$db_user = "xxx"; 
$db_pass = "xxx"; 
$db_name = "xxx";

$title = $lang['title']; 
$announcement = $lang['announc']; 
$m = 49;  $n = 49;
/* solda sağda ve alttaki yazılar */
$top_ad = "<table><tr><td> <font class='q_label'><img src='templates/1/kabilelogo2.png' /></font> </td><td>";
$bottom_ad = "</td><td> <font class='q_label'><img src='templates/1/kabilelogo2.png' /></font> </td></tr></table>";
$bottom_text = "<font face='Fixedsys' color='red'>Kabile created by Akjmgalp & Metalsimyaci</font></br>";

function logo($title) //logo yazdırıyorum.
{
	echo "<img src='templates/1/logo.jpg'>";
}
function menu_up() //üst menü oluşturuorum.
{
	global $lang;
	/* home */
	echo "<a class='q_link' href='index.php'>".$lang['home']."</a> | ";
	/* oyuncu login değilse giriş ve kayit */
	if (!isset($_SESSION["user"][1])) 
		echo "<a class='q_link' href='login.php'>".$lang['login']."</a> | <a class='q_link' href='register.php'>".$lang['register']."</a> | ";
	/* oyuncu login ise çıkış */
	else 
		echo "<a class='q_link' href='logout.php'>".$lang['logout']."</a> | ";
	/*harita oluştur */
	if (isset($_SESSION["user"][1], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		$loc = town_xy($_GET["town"]);
		$map_lnk = "<a class='q_link' href='map.php?x=".$loc[0]."&y=".$loc[1]."'>".$lang['map']."</a>";
	}
	else $map_lnk = "<a class='q_link' href='map.php?x=0&y=0'>".$lang['map']."</a>";
	/* harita yazdır */
	echo $map_lnk." | <a class='q_link' href='help.php'>".$lang['about']."</a> || ";
	/* oyuncu login ise profil ve kabileler */
	if (isset($_SESSION["user"][1])) {
		$towns=towns($_SESSION["user"][0]);
		$twnCount=count($towns);
		echo "<a class='q_link' href='profile_view.php?id=".$_SESSION["user"][0]."'>".$lang['profile']."</a> | ";
		if($twnCount != 1)
			echo " <a class='q_link' href='towns.php'>".$lang['towns']."</a> | ";
		else
		{
			//kabile oluşturma linkini koy!
			echo " <a class='q_link' href='create.php'>yeni kabile</a> | ";
		}
	}
	if (isset($_SESSION["user"][1])) 
	{ 
		$towns=towns($_SESSION["user"][0]);
		$twnCount=count($towns);
		if($twnCount != 0)
			echo "<a class='q_link' href='town.php?town=".$towns[0][0] ."'>".$lang['townCenter']."</a> || "; 
	}
}
function menu_down() //alt menü oluşturuyorum.
{
	global $lang;
	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		echo "<a class='q_link' href='town.php?town=".$_GET["town"]."'>".$lang['townCenter']."</a> | <a class='q_link' href='town_stats.php?town=".$_GET["town"]."'>".$lang['statistics']."</a> | ";
	}
	if (isset($_SESSION["user"][1]))
	{ 
		$alert = msg_rep_alert($_SESSION["user"][0]);
		if ($alert[0][0]) $alert[0]="<font color='red'>".$alert[0][0]."</font> "; else $alert[0]="";
		if ($alert[1][0]) $alert[1]="<font color='red'>".$alert[1][0]."</font> "; else $alert[1]="";
		if (isset($_SESSION["user"][1])) echo "<a class='q_link' href='reports.php?page=0'>".$alert[0].$lang['reports']."</a> | <a class='q_link' href='messages.php?page=0'>".$alert[1].$lang['messages']."</a> || ";
		if ((isset($_SESSION["user"][4]))&&($_SESSION["user"][4]>3)) echo "<a class='q_link' href='apanel.php'>".$lang['adminPanel']."</a> | ";
	}
}
function about()
{
	global $bottom_text; 
	echo $bottom_text;
}

$system = array();
$system[0] = 5;//chat message life, in minutes
$system[1] = 5;//chat refresh time, in seconds
?>