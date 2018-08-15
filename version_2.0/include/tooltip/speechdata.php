<?php
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		$town=town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$faction=faction($_SESSION["user"][10]);
		$res=explode("-", $town[10]); 
		$lim=explode("-", $town[11]); 
		$prod=explode("-", $town[9]);
		if ($prod[0]-$town[3]-$town[12]<5) $prod[0]=$town[3]+$town[12]+5;//noob protection against negative crop production values
	}
	else {
		git('index.php'); die();
	}
?>

<div>

<div id="speechbubble0" class="speechbubbles">
Değirmen
</div>

<div id="speechbubble1" class="speechbubbles">
Oduncu Evi
</div>

<div id="speechbubble2" class="speechbubbles">
Taş Ocağı
</div>

<div id="speechbubble3" class="speechbubbles">
Dökümhane
</div>

<div id="speechbubble4" class="speechbubbles">
Ambar
</div>

<div id="speechbubble5" class="speechbubbles">
Depo
</div>

<div id="speechbubble6" class="speechbubbles">
Gizli Depo
</div>

<div id="speechbubble7" class="speechbubbles">
Ana Bina
</div>

<div id="speechbubble8" class="speechbubbles">
&nbsp;&nbsp;&nbsp;Ev&nbsp;&nbsp;
</div>

<div id="speechbubble9" class="speechbubbles">
Elçilik
</div>

<div id="speechbubble10" class="speechbubbles">
Pazaryeri
</div>

<div id="speechbubble11" class="speechbubbles">
İbadethane
</div>

<div id="speechbubble12" class="speechbubbles">
Liman
</div>

<div id="speechbubble13" class="speechbubbles">
Surlar
</div>

<div id="speechbubble14" class="speechbubbles">
Kule
</div>

<div id="speechbubble15" class="speechbubbles">
Baraka
</div>

<div id="speechbubble16" class="speechbubbles">
Akademi
</div>

<div id="speechbubble17" class="speechbubbles">
Demirci
</div>

<div id="speechbubble18" class="speechbubbles">
Teçhizat Merkezi
</div>

<div id="speechbubble19" class="speechbubbles">
Ahır
</div>

<div id="speechbubble20" class="speechbubbles">
Kuşatma Atolyesi
</div>

<div id="speechbubble21" class="speechbubbles">
Cephanelik
</div>

<div id="speechbubble22" class="speechbubbles">
Tabela
</div>

<div id="speechbubble23" class="speechbubbles">
Karargah
</div>

<div id="speechbubble24" class="speechbubbles">
Gelen Ordular
</div>

<div id="speechbubble25" class="speechbubbles">
Giden Ordular
</div>

<div id="speechbubble26" class="speechbubbles">
Karargah
</div>

<div id="speechbubble27" class="speechbubbles">
Günlük Hediye
</div>

<div id="speechbubble28" class="speechbubbles">
Değirmen
</div>

<div id="speechbubble29" class="speechbubbles">
Oduncu Evi
</div>

<div id="speechbubble30" class="speechbubbles">
Taş Ocağı
</div>

<div id="speechbubble31" class="speechbubbles">
Dökümhane
</div>

<div id="speechbubble32" class="speechbubbles">
Ambar
</div>

<div id="speechbubble33" class="speechbubbles">
Depo
</div>

<div id="speechbubble34" class="speechbubbles">
Gizli Depo
</div>

<div id="speechbubble35" class="speechbubbles">
Ana Bina
</div>

<div id="speechbubble36" class="speechbubbles">
&nbsp;&nbsp;&nbsp;Ev&nbsp;&nbsp;
</div>

<div id="speechbubble37" class="speechbubbles">
Elçilik
</div>

<div id="speechbubble38" class="speechbubbles">
Pazaryeri
</div>

<div id="speechbubble39" class="speechbubbles">
İbadethane
</div>

<div id="speechbubble40" class="speechbubbles">
Baraka
</div>

<div id="speechbubble41" class="speechbubbles">
Akademi
</div>

<div id="speechbubble42" class="speechbubbles">
Demirci
</div>

<div id="speechbubble43" class="speechbubbles">
Profil
</div>

<div id="speechbubble44" class="speechbubbles">
Harita
</div>

<div id="speechbubble45" class="speechbubbles">
Kabileler
</div>

<div id="speechbubble46" class="speechbubbles">
Asker Eğitim Kuyruğu
</div>

<div id="speechbubble47" class="speechbubbles">
Bina İnşa Kuyruğu
</div>

<div id="speechbubble48" class="speechbubbles">
Silah Üretim Kuyruğu
</div>

<div id="speechbubble49" class="speechbubbles">
Çıkış
</div>

<div id="speechbubble50" class="speechbubbles">
Tahıl<br /><?php echo $lim[0]; ?>max<br /><?php echo ($prod[0]-$town[3]-$town[12]); ?>/sa
</div>

<div id="speechbubble51" class="speechbubbles">
Odun<br /><?php echo $lim[1]; ?>max<br /><?php echo $prod[1]; ?>/sa
</div>

<div id="speechbubble52" class="speechbubbles">
Taş<br /><?php echo $lim[1]; ?>max<br /><?php echo $prod[2]; ?>/sa
</div>

<div id="speechbubble53" class="speechbubbles">
Demir<br /><?php echo $lim[1]; ?>max<br /><?php echo $prod[3]; ?>/sa
</div>

<div id="speechbubble54" class="speechbubbles">
Altın<br /><?php echo $lim[2]; ?>max<br /><?php echo $prod[4]; ?>/sa
</div>

<div id="speechbubble55" class="speechbubbles">
Nüfus<br /><?php echo $lim[3]; ?>max
</div>

<div id="speechbubble56" class="speechbubbles">
Moral
</div>


</div>
