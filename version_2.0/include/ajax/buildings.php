<?php
	include "../ronarazoro.php";
	
	if(isset( $_POST["id"]))
	{
		$id = $_POST["id"];
		if($id < 22)
		{
			$buildings = buildings($_SESSION["user"][10]);
			if($id<4 || $id==7) {
				$name = explode("-", $buildings[$id][2]);
				$name = $name[0];
			}
			else
				$name = $buildings[$id][2];
			
			echo "<b>".$name."</b> - ".$buildings[$id][8];
		}
		elseif($id == 22){
			echo "<b>Kabile Tabelası</b>";
		}
		elseif($id == 23){
			echo "<b>Karargah</b>";
		}
		elseif($id == 24){
			echo "<b>Asker Eğitme ve Geliştirme Listesi</b>";
		}
		elseif($id == 25){
			echo "<b>Bina İnşa ve Yükseltme Listesi</b>";
		}
		elseif($id == 26){
			echo "<b>Silah Üretim ve Yükseltme Listesi</b>";
		}
		elseif($id == 27){
			echo "<b>Kabilenize Doğru Gelen Ordular</b>";
		}
		elseif($id == 28){
			echo "<b>Kabilenizden Çıkan Ordular</b>";
		}
		elseif($id == 29){
			echo "<b>Kabileleriniz</b>";
		}
		elseif($id == 30){
			echo "<b>Vergi Dairesi</b>";
		}
	}
?>