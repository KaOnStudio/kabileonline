<?php
	include "include/ronarazoro.php";
	
	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		$_GET["town"]=clean($_GET["town"]);
		check_a($_GET["town"]);
		check_t($_GET["town"]);
		check_w($_GET["town"]);
		check_u($_GET["town"]);
		check_uup($_GET["town"]);
		check_c($_GET["town"], $_SESSION["user"][10]);
		check_r($_GET["town"]);
		$town=town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]);
		$buildings=buildings($_SESSION["user"][10]);
		$cq=get_c($_GET["town"]);
		$iaq=get_ia($_GET["town"]);
		$aq=get_a($town[0]);
		$b_names=array(); 
		for ($i=0; $i<22; $i++) 
			$b_names[$i]=$buildings[$i][2];
		
		$data=explode("-", $town[8]); $land=explode("/", $town[13]); $land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]);
		$res=explode("-", $town[10]); $lim=explode("-", $town[11]); $prod=explode("-", $town[9]);
		if ($prod[0]-$town[3]-$town[12]<5) $prod[0]=$town[3]+$town[12]+5;//noob protection against negative crop production values
	}
	else {
		git('index.php'); die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="include/style.css" />
<link rel="shortcut icon" href="arka.ico"/>
<script language="JavaScript" type="text/javascript" src="include/default.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="include/tooltip/speechbubbles.css" />
<script language="JavaScript" type="text/javascript" src="include/tooltip/speechbubbles.js"></script>
<script language="JavaScript" type="text/javascript" src="include/drag.js"></script>
<script type="text/javascript" language="JavaScript">
	/***********************************************
	* Visit http://www.dynamicdrive.com/ for this script and 100s more.
	***********************************************/
	jQuery(function($){ //on document.ready
	 	//Apply tooltip to links with class="addspeech", plus look inside 'speechdata.txt' for the tooltip markups
		$('a.addspeech').speechbubble({url:'include/tooltip/speechdata.php?town=<?php echo $town[0]; ?>',  type:'1'})
		$('a.addspeech2').speechbubble({url:'include/tooltip/speechdata.php?town=<?php echo $town[0]; ?>', type:'2'})
	})

	var res_start0=<?php echo floor($res[0]);?>; 
	var res_start1=<?php echo floor($res[1]);?>; 
	var res_start2=<?php echo floor($res[2]);?>; 
	var res_start3=<?php echo floor($res[3]);?>; 
	var res_start4=<?php echo floor($res[4]);?>;
	var res_limit0=<?php echo $lim[0];?>; 
	var res_limit1=<?php echo $lim[1];?>; 
	var res_limit2=<?php echo $lim[1];?>; 
	var res_limit3=<?php echo $lim[1];?>; 
	var res_limit4=<?php echo $lim[2];?>;
	var res_ph0=<?php echo ($prod[0]-$town[3]-$town[12]);?>; 
	var res_ph1=<?php echo ($prod[1]);?>; 
	var res_ph2=<?php echo ($prod[2]);?>; 
	var res_ph3=<?php echo ($prod[3]);?>; 
	var res_ph4=<?php echo ($prod[4]);?>;
	var res_sec0=0; 
	var res_sec1=0; 
	var res_sec2=0; 
	var res_sec3=0; 
	var res_sec4=0;

	var prev		= "";
	var tabLinks 	= new Array();
	var contentDivs = new Array();
	var data = new Array(11);
	<?php $weapons=weapons($_SESSION["user"][10]); for ($i=0; $i<count($weapons); $i++) echo "data[".$i."]='".$weapons[$i][2]."'; "; ?>
</script>
<title>KABİLE ONLİNE</title>
</head>
<body bgcolor="#000000" onLoad="startres();">
<div class="wrapper">
	<div class="main">
    	<div class="ustPanel">
			<!--//////////////////////////  SOL PANEL   //////////////////////////////-->
			<div style="position:absolute; left:213px; top:20px; height:116px; width:194px;">
				<table border="0" style="border-collapse: collapse; border:none; text-indent: 0;">
					<tr style="height:40px;">
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble28" onclick="popupWindowAc('include/popup/gmill.php?town=<?php echo $town[0]; ?>','0');">		<img src="include/images/1/b0<?php if (!$data[0]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble29" onclick="popupWindowAc('include/popup/lmill.php?town=<?php echo $town[0]; ?>','1');">		<img src="include/images/1/b1<?php if (!$data[1]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble30" onclick="popupWindowAc('include/popup/smason.php?town=<?php echo $town[0]; ?>','2');">	<img src="include/images/1/b2<?php if (!$data[2]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble31" onclick="popupWindowAc('include/popup/ifoundry.php?town=<?php echo $town[0]; ?>','3');">	<img src="include/images/1/b3<?php if (!$data[3]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble32" onclick="popupWindowAc('include/popup/granary.php?town=<?php echo $town[0]; ?>','4');">	<img src="include/images/1/b4<?php if (!$data[4]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
					</tr>
					<tr style="height:40px;"> 
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble33" onclick="popupWindowAc('include/popup/warehouse.php?town=<?php echo $town[0]; ?>','5');">	<img src="include/images/1/b5<?php if (!$data[5]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble34" onclick="popupWindowAc('include/popup/cache.php?town=<?php echo $town[0]; ?>','6');">		<img src="include/images/1/b6<?php if (!$data[6]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble35" onclick="popupWindowAc('include/popup/hall.php?town=<?php echo $town[0]; ?>','7');">		<img src="include/images/1/b7<?php if (!$data[7]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble36" onclick="popupWindowAc('include/popup/house.php?town=<?php echo $town[0]; ?>','8');">		<img src="include/images/1/b8<?php if (!$data[8]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble37" onclick="popupWindowAc('include/popup/embassy.php?town=<?php echo $town[0]; ?>','9');">	<img src="include/images/1/b9<?php if (!$data[9]) echo "_"; ?>.png"  style="width:36px; height:36px; border:none;" /></a></td>
					</tr>
					<tr style="height:40px;">
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble38" onclick="popupWindowAc('include/popup/marketplace.php?town=<?php echo $town[0];?>','10');"><img src="include/images/1/b10<?php if (!$data[10]) echo "_"; ?>.png" style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble39" onclick="popupWindowAc('include/popup/cathedral.php?town=<?php echo $town[0]; ?>','11');">	<img src="include/images/1/b11<?php if (!$data[11]) echo "_"; ?>.png" style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble40" onclick="popupWindowAc('include/popup/barracks.php?town=<?php echo $town[0]; ?>','15');">	<img src="include/images/1/b15<?php if (!$data[15]) echo "_"; ?>.png" style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble41" onclick="popupWindowAc('include/popup/academy.php?town=<?php echo $town[0]; ?>','16');">	<img src="include/images/1/b16<?php if (!$data[16]) echo "_"; ?>.png" style="width:36px; height:36px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble42" onclick="popupWindowAc('include/popup/blacksmith.php?town=<?php echo $town[0]; ?>','17');"><img src="include/images/1/b17<?php if (!$data[17]) echo "_"; ?>.png" style="width:36px; height:36px; border:none;" /></a></td>
					</tr>
				</table>
			</div>
			<!--/////////////////////////////////////////////////////////////////////-->
			
			<!--//////////////////////////  KAYNAKLAR   //////////////////////////////-->
			<div style="position:absolute; text-align:center; left:463px; top:33px; height:25px; width:395px; color:#6a0606; font-weight:bold; font-size:14;">
					<a href="#" class="addspeech2" rel="#speechbubble50"><img src='include/images/1/00.gif' title='Tahıl'><span id="res0"></span></a>&nbsp;
					<a href="#" class="addspeech2" rel="#speechbubble51"><img src='include/images/1/01.gif' title='Odun'><span id="res1"></span></a>&nbsp;
					<a href="#" class="addspeech2" rel="#speechbubble52"><img src='include/images/1/02.gif' title='Taş'><span id="res2"></span></a>&nbsp;
					<a href="#" class="addspeech2" rel="#speechbubble53"><img src='include/images/1/03.gif' title='Demir'><span id="res3"></span></a>&nbsp;
					<a href="#" class="addspeech2" rel="#speechbubble54"><img src='include/images/1/04.gif' title='Altın'><span id="res4"></span></a>&nbsp;
					<a href="#" class="addspeech2" rel="#speechbubble55"><img src='include/images/1/population.png' title='Nüfus'><?php echo ($town[3]+$town[12]); ?></a>
			<!--
			<img src='".$imgs.$fimgs."morale_.gif' title='Moral'>"."</br>";
			-->		
			</div>
			<!--///////////////////////////////////////////////////////////////////////////////-->
			
			<!--//////////////////////////////// ORTA PANEL ///////////////////////////////////-->
			<div style="position:absolute; left:475px; top:77px; height:65px; width:120px;">
				<table border="0" style="border-collapse: collapse; border:thin red; text-indent: 0;">
					<tr style="height:33px;">
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble43"><img src="include/images/panelProfil.png" style="width:36px; height:31px; border:none;" /></a></td>
						<?php $loc = town_xy($town[0]); $x = $loc[0]; $y = $loc[1]; ?>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble44" onclick="template('map_.php','<?php echo "x=".$x."&y=".$y; ?>');"><img src="include/images/panelHarita.png" style="width:36px; height:31px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble45" onclick="popupWindowAc('towns.php?town=<?php echo $town[0]; ?>','29');"><img src="include/images/panelKabileler.png" style="width:36px; height:31px; border:none;" /></a></td>
					</tr>
					<tr style="height:33px;">
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble46" onclick="popupWindowAc('troopQueue.php?town=<?php echo $town[0]; ?>','24');"><img src="include/images/panelAskerKuyruk.png" style="width:36px; height:31px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble47" onclick="popupWindowAc('buildQueue.php?town=<?php echo $town[0]; ?>','25');"><img src="include/images/panelBinaKuyruk.png" style="width:36px; height:31px; border:none;" /></a></td>
						<td style="width:40px; padding:1px 1px 1px 1px;"><a href="#" class="addspeech2" rel="#speechbubble48" onclick="popupWindowAc('weaponQueue.php?town=<?php echo $town[0]; ?>','26');"><img src="include/images/panelSilahKuyruk.png" style="width:36px; height:31px; border:none;" /></a></td>
					</tr>
				</table>
			</div>
			<!--///////////////////////////////////////////////////////////////////////////////-->

			<!--//////////////////////////  SAĞ PANEL  ////////////////////////////////////////-->
			<div style="position:absolute; left:887px; top:26px; height:120px; width:200px;">
				<div style="float:left; margin-top:0px; margin-left:22px;"><a href="#" class="addspeech2" rel="#speechbubble24" onclick="popupWindowAc('comingAtack.php?town=<?php echo $town[0]; ?>','27');"><img src="include/images/1/gelenSaldiri<?php if(count($iaq)==0) echo "1"; else echo "2"; ?>.png" style="border:none;"></a></div>
				<div style="float:right; margin-top:0px; margin-right:27px;"><a href="#" class="addspeech2" rel="#speechbubble25" onclick="popupWindowAc('goingAtack.php?town=<?php echo $town[0]; ?>','28');"><img src="include/images/1/gidenSaldiri<?php if(count($aq)==0) echo "1"; else echo "2"; ?>.png" style="border:none;"></a></div>
				<div style="clear:both; height:20px;"></div>
				<div style="float:left;  margin-left:22px;"><a href="#" class="addspeech2" rel="#speechbubble26" onclick="popupWindowAc('include/popup/dispatch.php?town=<?php echo $town[0]; ?>','23');"><img src="include/images/1/orduButonu.png" style="border:none;"></a></div>
				<div style="float:right; margin-right:27px;"><a href="#" class="addspeech2" rel="#speechbubble27"><img src="include/images/1/hediyeButonu1.png" style="border:none;"></a></div>	
			</div> 
			<!--/////////////////////////////////////////////////////////////////////////////-->
			<!--////////////////////////// MORAL ////////////////////////////////////////-->
			<div style="position:absolute; left:1034px; top:183px; height:63px; width:45px;">
				<a href="#" class="addspeech2" rel="#speechbubble56" onclick="popupWindowAc('set_tax.php?town=<?php echo $town[0]; ?>','30');"><img src="include/images/moral.png" /></a>
                <div style="margin-left:5px; margin-top:-22px; font-weight:bold; font-size:12px; width:33px; text-align:center;">
					<?php echo $town[5]; ?>
                </div>
			</div>
			<!--/////////////////////////////////////////////////////////////////////////////-->
		</div>
		<!--harita için bir div-->
		<div style="position: absolute; display:none; z-index:50; width: 897px;	height: 449px; margin: 0px 0px 0px 0px; border: none;" id="content"></div>
		
		
<div class="contentTown" style="cursor:url(<?php echo $imgs.$fimgs; ?>cursor.png), auto;"> 

	<!--////////////////////////////////////////////////////////////  POPUP DİV  1  ///////////////////////////////////////////////////////-->
	<div id="root" class="popupWindow" style="display:none;">
		<div id="handle" style="float:left; margin-left:20px; margin-top:16px; width:650px; cursor:move; "></div>
		<div style="float:right; margin-right:30px; margin-top:16px;"><a href="#" onclick="kapat('root');"><img src="include/images/1/close.png" title="Kapat" alt="X" /></a></div>
		<div id="degisecek_popup" style="width:680px; height:350px; margin-left:20px; margin-top:50px; text-align:center; overflow:auto;"></div>
	</div>
	<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
	
	<!--////////////////////////////////////////////////////////////  POPUP DİV  2  ///////////////////////////////////////////////////////-->
	<div id="root2" class="popupWindow" style="display:none;">
		<div id="handle2" style="float:left; margin-left:20px; margin-top:16px; width:650px; cursor:move;"></div>
		<div style="float:right; margin-right:30px; margin-top:16px;"><a href="#" onclick="kapat('root2');"><img src="include/images/1/close.png" title="Kapat" alt="X" /></a></div>
		<div id="degisecek_popup2" style="width:680px; height:350px; margin-left:20px; margin-top:50px; text-align:center; overflow:auto;"></div>
	</div>
	<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
	<script language="javascript">
	    var theHandle = document.getElementById("handle");
	    var theRoot   = document.getElementById("root");
		Drag.init(theHandle, theRoot);
		
		var theHandle2 = document.getElementById("handle2");
	    var theRoot2   = document.getElementById("root2");
		Drag.init(theHandle2, theRoot2);
	</script>
	
	<?php
	if(isset($_GET["hata"])){
		$hatakod = clean($_GET["hata"]);
		if($hatakod == "troopq") {
			echo "<script language='javascript' type='text/javascript'> popupWindowAc('troopQueue.php?town=".$town[0]."','24'); </script>";
		}
		else if($hatakod == "insaq") {
			echo "<script language='javascript' type='text/javascript'> popupWindowAc('buildQueue.php?town=".$town[0]."','25'); </script>";
		}
		else if($hatakod == "weaponq") {
			echo "<script language='javascript' type='text/javascript'> popupWindowAc('weaponQueue.php?town=".$town[0]."','26'); </script>";
		}
		else if($hatakod == "dispatch") {
			echo "<script language='javascript' type='text/javascript'> popupWindowAc('goingAtack.php?town=".$town[0]."','28'); </script>";
		}
		else {
			echo "<div class='olumsuzMesaj' id='townHataDivi'>".$lang[$hatakod]."</div>";
			echo "<script language='javascript' type='text/javascript'> sonraKapat('townHataDivi', 2000); </script>";
		}
	}
	if(isset($_POST["welcome"])){
		echo "<div class='bilgiMesaj' id='townBilgiDivi'>".clean($_POST["welcome"])."</div>";
		echo "<script language='javascript' type='text/javascript'> sonraKapat('townBilgiDivi', 3000); </script>";
	}
	if(isset($_POST["show"])){
		$show_popup = post("show");
		if($show_popup == "buildq") {
			echo "<script language='javascript' type='text/javascript'> popupWindowAc('buildQueue.php?town=".$town[0]."','25'); </script>";
		}
	}
	if(isset($_POST["olumsuz"])){
		$show_msg = post("olumsuz");
		msj($show_msg, "olumsuz");
	}
	if(isset($_POST["olumlu"])){
		$show_msg = post("olumlu");
		msj($show_msg, "olumlu");
	}
	if(isset($_POST["bilgi"])){
		$show_msg = post("bilgi");
		msj($show_msg, "bilgi");
	}

	$ust_bosluk = 12;
	$sol_bosluk = 2;
	
	echo "<div style='position:relative; top:0; left:125; cursor:url(".$imgs.$fimgs."cursor.png), auto;'>";
		//echo "<img src='".$imgs.$fimgs."x.gif'><img src='".$imgs.$fimgs."back.jpg' width='640' height='372' style='position:absolute; left:0; top:".($ust_bosluk + 25).";'>";
		
		if ($data[0]) 	echo "<img src='".$imgs.$fimgs."b0.png' style='position:absolute; left:".($sol_bosluk + 53)."; top:".($ust_bosluk + 65).";' name='gmill'>";
		if ($data[1]) 	echo "<img src='".$imgs.$fimgs."b1.png' style='position:absolute; left:".($sol_bosluk + 80)."; top:".($ust_bosluk + 100).";' name='lmill'>";
		if ($data[2]) 	echo "<img src='".$imgs.$fimgs."b2.png' style='position:absolute; left:".($sol_bosluk + 12)."; top:".($ust_bosluk + 165).";' name='smason'>";
		if ($data[3]) 	echo "<img src='".$imgs.$fimgs."b3.png' style='position:absolute; left:".($sol_bosluk + 143)."; top:".($ust_bosluk + 27).";' name='ifoundry'>";
		if ($data[4]) 	echo "<img src='".$imgs.$fimgs."b4.png' style='position:absolute; left:".($sol_bosluk + 0)."; top:".($ust_bosluk + 85).";' name='granary'>";
		if ($data[5]) 	echo "<img src='".$imgs.$fimgs."b5.png' style='position:absolute; left:".($sol_bosluk + 478)."; top:".($ust_bosluk + 65).";' name='warehouse'>";
		if ($data[6]) 	echo "<img src='".$imgs.$fimgs."b6.png' style='position:absolute; left:".($sol_bosluk + 555)."; top:".($ust_bosluk + 51).";' name='cache'>";
		if ($data[7]) 	if ($data[7]==10) echo "<img src='".$imgs.$fimgs."b22.png' style='position:absolute; left:".($sol_bosluk + 328)."; top:".($ust_bosluk + 115).";' name='hall'>"; 
						else echo "<img src='".$imgs.$fimgs."b7.png' style='position:absolute; left:".($sol_bosluk + 335)."; top:".($ust_bosluk + 120).";' name='hall'>";
		if ($data[8]) 	echo "<img src='".$imgs.$fimgs."b8.png' style='position:absolute; left:".($sol_bosluk + 187)."; top:".($ust_bosluk + 130).";' name='house'>";
		if ($data[9]) 	echo "<img src='".$imgs.$fimgs."b9.png' style='position:absolute; left:".($sol_bosluk + 270)."; top:".($ust_bosluk + 178).";' name='embassy'>";
		if ($data[10])	echo "<img src='".$imgs.$fimgs."b10.png' style='position:absolute; left:".($sol_bosluk + 437)."; top:".($ust_bosluk + 150).";' name='marketplace'>";
		if ($data[11]) 	echo "<img src='".$imgs.$fimgs."b11.png' style='position:absolute; left:".($sol_bosluk + 447)."; top:".($ust_bosluk + 207).";' name='cathedral'>";
		
		if ($data[13]) 	echo "<img src='".$imgs.$fimgs."b13.png' style='position:absolute; left:".($sol_bosluk + 205)."; top:".($ust_bosluk + 135).";' name='wall' width='434' height='259' >";
		if ($data[14]) 	echo "<img src='".$imgs.$fimgs."b14.png' style='position:absolute; left:".($sol_bosluk + 567)."; top:".($ust_bosluk + 250).";' name='tower'>";
		if ($data[15]) 	echo "<img src='".$imgs.$fimgs."b15.png' style='position:absolute; left:".($sol_bosluk + 215)."; top:".($ust_bosluk + 30).";' name='barracks'>";
		if ($data[16]) 	echo "<img src='".$imgs.$fimgs."b16.png' style='position:absolute; left:".($sol_bosluk + 102)."; top:".($ust_bosluk + 178).";' name='academy'>";
		if ($data[17]) 	echo "<img src='".$imgs.$fimgs."b17.png' style='position:absolute; left:".($sol_bosluk + 333)."; top:".($ust_bosluk + 245).";' name='blacksmith'>";
		if ($data[18]) 	echo "<img src='".$imgs.$fimgs."b18.png' style='position:absolute; left:".($sol_bosluk + 192)."; top:".($ust_bosluk + 238).";' name='washop'>";
		if ($data[19]) 	echo "<img src='".$imgs.$fimgs."b19.png' style='position:absolute; left:".($sol_bosluk + 300)."; top:".($ust_bosluk + 22).";' name='stable'>";
		if ($data[20]) 	echo "<img src='".$imgs.$fimgs."b20.png' style='position:absolute; left:".($sol_bosluk + 380)."; top:".($ust_bosluk + 24).";' name='sshop'>";
		if ($data[21]) 	echo "<img src='".$imgs.$fimgs."b21.png' style='position:absolute; left:".($sol_bosluk + 526)."; top:".($ust_bosluk + 148).";' name='wwarehouse'>";
		
		echo "<img src='".$imgs.$fimgs."t_edit.png' width='34' height='36' style='position:absolute; left:".($sol_bosluk + 460)."; top:".($ust_bosluk + 357).";' name='town_edit'>";
		echo "<img src='".$imgs.$fimgs."crossroad.png' style='position:absolute; left:".($sol_bosluk + 526)."; top:".($ust_bosluk + 347).";' name='crossroad'>";
		echo "<img src='".$imgs.$fimgs."x.gif' border='0' usemap='#Map' style='position:absolute; left:".($sol_bosluk + 0)."; top:".($ust_bosluk + 30).";'>";
		echo "<span id=\"label\" style=\"position:absolute; left:".($sol_bosluk + 25)."; top:".($ust_bosluk + 33)."; height:24; width:507; font-family: arial; font-size: large;\"></span>";
	echo "</div>";
	echo "<map name='Map'>";
		if ($data[0]) {
			$name=explode("-", $buildings[0][2]); 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble0\"><area shape='rect' coords='60,52,115,120' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/gmill.php?town=".$town[0]."','0');\"  onmouseout=\"gmill.src='".$imgs.$fimgs."b0.png'\" onmouseover=\"gmill.src='".$imgs.$fimgs."b0_.png'\"></a>"; }
		if ($data[1]) {
			$name=explode("-", $buildings[1][2]); 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble1\"><area shape='rect' coords='80,103,155,147' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/lmill.php?town=".$town[0]."','1');\" onmouseout=\"lmill.src='".$imgs.$fimgs."b1.png'\" onmouseover=\"lmill.src='".$imgs.$fimgs."b1_.png'\"></a>"; }
		if ($data[2]) {
			$name=explode("-", $buildings[2][2]); 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble2\"><area shape='rect' coords='20,150,87,224' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/smason.php?town=".$town[0]."','2');\" onmouseout=\"smason.src='".$imgs.$fimgs."b2.png'\" onmouseover=\"smason.src='".$imgs.$fimgs."b2_.png'\"></a>"; }
		if ($data[3]) {
			$name=explode("-", $buildings[3][2]); 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble3\"><area shape='rect' coords='144,35,216,95' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/ifoundry.php?town=".$town[0]."','3');\" onmouseout=\"ifoundry.src='".$imgs.$fimgs."b3.png'\" onmouseover=\"ifoundry.src='".$imgs.$fimgs."b3_.png'\"></a>"; }
		if ($data[4]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble4\"><area shape='rect' coords='0,85,62,158' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/granary.php?town=".$town[0]."','4');\" onmouseout=\"granary.src='".$imgs.$fimgs."b4.png'\" onmouseover=\"granary.src='".$imgs.$fimgs."b4_.png'\"></a>";
		if ($data[5]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble5\"><area shape='rect' coords='478,59,553,133' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/warehouse.php?town=".$town[0]."','5');\" onmouseout=\"warehouse.src='".$imgs.$fimgs."b5.png'\" onmouseover=\"warehouse.src='".$imgs.$fimgs."b5_.png'\"></a>";
		if ($data[6]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble6\"><area shape='rect' coords='565,55,629,120' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/cache.php?town=".$town[0]."','6');\" onmouseout=\"cache.src='".$imgs.$fimgs."b6.png'\" onmouseover=\"cache.src='".$imgs.$fimgs."b6_.png'\"></a>";
		if ($data[7]) {
			$name=explode("-", $buildings[7][2]); 
			if ($data[7]==10) { $i=22; $j=1; } else { $i=7; $j=0; } 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble7\"><area shape='rect' coords='334,105,409,185' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/hall.php?town=".$town[0]."','7');\"  onmouseout=\"hall.src='".$imgs.$fimgs."b".$i.".png'\" onmouseover=\"hall.src='".$imgs.$fimgs."b".$i."_.png'\"></a>";}
		if ($data[8]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble8\"><area shape='rect' coords='185,128,260,200' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/house.php?town=".$town[0]."','8');\"  onmouseout=\"house.src='".$imgs.$fimgs."b8.png'\" onmouseover=\"house.src='".$imgs.$fimgs."b8_.png'\"></a>";
		if ($data[9]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble9\"><area shape='rect' coords='269,182,344,245' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/embassy.php?town=".$town[0]."','9');\" onmouseout=\"embassy.src='".$imgs.$fimgs."b9.png'\" onmouseover=\"embassy.src='".$imgs.$fimgs."b9_.png'\"></a>";
		if ($data[10]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble10\"><area shape='rect' coords='440,160,510,210' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/marketplace.php?town=".$town[0]."','10');\" onmouseout=\"marketplace.src='".$imgs.$fimgs."b10.png'\" onmouseover=\"marketplace.src='".$imgs.$fimgs."b10_.png'\"></a>";
		if ($data[11]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble11\"><area shape='rect' coords='445,210,520,275' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/cathedral.php?town=".$town[0]."','11');\" onmouseout=\"cathedral.src='".$imgs.$fimgs."b11.png'\" onmouseover=\"cathedral.src='".$imgs.$fimgs."b11_.png'\"></a>";
		
		if ($data[13]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble13\"><area shape='rect' coords='210,315,455,352' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/wall.php?town=".$town[0]."','13');\" onmouseout=\"wall.src='".$imgs.$fimgs."b13.png'\" onmouseover=\"wall.src='".$imgs.$fimgs."b13_.png'\"></a>";
		if ($data[14]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble14\"><area shape='rect' coords='585,245,625,320' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/tower.php?town=".$town[0]."','14');\" onmouseout=\"tower.src='".$imgs.$fimgs."b14.png'\" onmouseover=\"tower.src='".$imgs.$fimgs."b14_.png'\"></a>";
		if ($data[15]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble15\"><area shape='rect' coords='220,35,290,98' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/barracks.php?town=".$town[0]."','15');\" onmouseout=\"barracks.src='".$imgs.$fimgs."b15.png'\" onmouseover=\"barracks.src='".$imgs.$fimgs."b15_.png'\"></a>";
		if ($data[16]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble16\"><area shape='rect' coords='105,170,180,245' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/academy.php?town=".$town[0]."','16');\" onmouseout=\"academy.src='".$imgs.$fimgs."b16.png'\" onmouseover=\"academy.src='".$imgs.$fimgs."b16_.png'\"></a>";
		if ($data[17]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble17\"><area shape='rect' coords='337,235,410,315' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/blacksmith.php?town=".$town[0]."','17');\" onmouseout=\"blacksmith.src='".$imgs.$fimgs."b17.png'\" onmouseover=\"blacksmith.src='".$imgs.$fimgs."b17_.png'\"></a>";
		if ($data[18]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble18\"><area shape='rect' coords='195,238,265,306' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/washop.php?town=".$town[0]."','18');\" onmouseout=\"washop.src='".$imgs.$fimgs."b18.png'\" onmouseover=\"washop.src='".$imgs.$fimgs."b18_.png'\"></a>";
		if ($data[19]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble19\"><area shape='rect' coords='300,30,375,90' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/stable.php?town=".$town[0]."','19');\" onmouseout=\"stable.src='".$imgs.$fimgs."b19.png'\" onmouseover=\"stable.src='".$imgs.$fimgs."b19_.png'\"></a>";
		if ($data[20]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble20\"><area shape='rect' coords='380,30,450,90' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/sshop.php?town=".$town[0]."','20');\" onmouseout=\"sshop.src='".$imgs.$fimgs."b20.png'\" onmouseover=\"sshop.src='".$imgs.$fimgs."b20_.png'\"></a>";
		if ($data[21]) 
			echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble21\"><area shape='rect' coords='525,145,600,218' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/wwarehouse.php?town=".$town[0]."','21');\" onmouseout=\"wwarehouse.src='".$imgs.$fimgs."b21.png'\" onmouseover=\"wwarehouse.src='".$imgs.$fimgs."b21_.png'\"></a>";
					  
		echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble22\"><area shape='rect' coords='460,330,495,365' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('town_edit.php?town=".$town[0]."','22');\" onmouseout=\"town_edit.src='".$imgs.$fimgs."t_edit.png'\" onmouseover=\"town_edit.src='".$imgs.$fimgs."t_edit_.png'\"></a>"; 
					  
		echo "<a href=\"#\" class=\"addspeech\" rel=\"#speechbubble23\"><area shape='rect' coords='525,315,610,365' style='cursor:url(".$imgs.$fimgs."cursor.png), auto;' href=\"#\" onclick=\"popupWindowAc('include/popup/dispatch.php?town=".$town[0]."','23');\" onmouseout=\"crossroad.src='".$imgs.$fimgs."crossroad.png'\" onmouseover=\"crossroad.src='".$imgs.$fimgs."crossroad_.png'\"></a>";
	echo "</map>";
?>
</div>
<?php 
	include "include/html/footer.html";
?>