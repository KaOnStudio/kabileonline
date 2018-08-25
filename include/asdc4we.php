<?php session_start(); ?>
<?php 

include "language/tr.php";
//$title = $lang['title']; 
//$announcement = $lang['announc']; 
//$m = 49;  $n = 49;

/*
function connect()   //database'e bağlanmak için fonk
{
	$veri_yolu = @mysql_connect("localhost", "root", "");
	if ( ! $veri_yolu ) die ("MySQL ile veri bağlantısı kurulamıyor!");
	mysql_select_db("kabilev2" , $veri_yolu) or die ("Veritabanına ulaşılamıyor!" . mysql_error());
	mysql_query("SET NAMES 'utf8'");
	return  $veri_yolu;
}
*/

function connect()   //database'e bağlanmak için fonk
{
	$veri_yolu = @mysql_connect("localhost", "xxx", "xxx");
	if ( ! $veri_yolu ) die ("MySQL ile veri bağlantısı kurulamıyor!");
	mysql_select_db("metalsim_kabile" , $veri_yolu) or die ("Veritabanına ulaşılamıyor!" . mysql_error() );
	mysql_query("SET NAMES 'utf8'");
	return  $veri_yolu;
}

//$system = array();
//$system[0] = 5;//chat message life, in minutes
//$system[1] = 5;//chat refresh time, in seconds

?>