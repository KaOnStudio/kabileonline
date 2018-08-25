<?php
/* database işlemleri */
$db_host = "localhost"; 
$db_user = "hih2010_kabile"; 
$db_pass = "kay123.seri"; 
$db_name = "hih2010_kabile";

include "func.php";


global $db_id;

$query="SELECT COUNT(id) from towns";
$result=mysql_query($query, $db_id);
$row=mysql_fetch_row($result);

$town_stats=town_stats("population");

for($i=0; $i<$row[0]; $i++)
{
	$id 		= 	$town_stats[$i][0];
	
	/*
	echo $town_stats[$i][6];
	echo "<br>";
	echo $town_stats[$i][7];
	echo "<br>";
	echo $town_stats[$i][10];
	echo "<br>";
	echo "---------------------------------------<br>";
	*/

	$silahlar	=	$town_stats[$i][6];	 $silahlar 	=  explode("-", $silahlar);  	//silahlar 0-0-60-0-77-0-77-50-50-67-0
	$silah1 	= 	mt_rand(0, 9); $silah2 = mt_rand(0, 9); $silahlar[$silah1] += mt_rand(50, 100); $silahlar[$silah2] += mt_rand(50, 100);
	$silahlar 	= 	$silahlar[0]."-".$silahlar[1]."-".$silahlar[2]."-".$silahlar[3]."-".$silahlar[4]."-".$silahlar[5]."-".$silahlar[6]."-".$silahlar[7]."-".$silahlar[8]."-".$silahlar[9]."-".$silahlar[10];
	
	$ordular	=	$town_stats[$i][7];  $ordular 	=  explode("-", $ordular);  	//ordular 0-0-0-0-100-100-0-0-0-0-0-0-0
	$ordular[5]+=	mt_rand(50, 100); 	$ordular[11]+= 5;
	$ordular 	= 	$ordular[0]."-".$ordular[1]."-".$ordular[2]."-".$ordular[3]."-".$ordular[4]."-".$ordular[5]."-".$ordular[6]."-".$ordular[7]."-".$ordular[8]."-".$ordular[9]."-".$ordular[10]."-".$ordular[11]."-".$ordular[12];
	
	
	$kaynaklar	=	$town_stats[$i][10]; $kaynaklar =  explode("-", $kaynaklar);  	//kaynaklar 11100-11500-11500-11500-7400
	$limitler	=	$town_stats[$i][11]; $limitler 	=  explode("-", $limitler);  	//limitler 11100-11500-7400
	$kaynaklar[4] = $limitler[2];	$kaynak1 = mt_rand(0, 3);  if($kaynak1 == 0) $kaynaklar[$kaynak1] = $limitler[0]; else $kaynaklar[$kaynak1] = $limitler[1];
	$kaynaklar 	= 	$kaynaklar[0]."-".$kaynaklar[1]."-".$kaynaklar[2]."-".$kaynaklar[3]."-".$kaynaklar[4];
	
	/*
	echo $silahlar;
	echo "<br>";
	echo $ordular;
	echo "<br>";
	echo $kaynaklar;
	*/
	
	$query = "UPDATE towns SET weapons='".$silahlar."', army='".$ordular."', resources='".$kaynaklar."' WHERE id=".$id;
	$result=mysql_query($query, $db_id);
	
	//if($i==0) break;
	// akjmgalp : 1, metalsimyaci : 14...
} 

?>