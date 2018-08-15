<?php
	include "../ronarazoro.php";
	
	if(isset( $_POST["username"]))
	{
		$username = clean($_POST["username"]);
		if(is_user1($username))
			echo "<img src='include/images/red2.png' title='Bu Kullanıcı Adı Kapılmış!' />";
		else
			echo "<img src='include/images/kabul.png' title='Bu Kullanıcı Adı Geçerli!' />";
	}
	if(isset( $_POST["mail"]))
	{
		$email = clean($_POST["mail"]);
		if(is_user2($email))
			echo "<img src='include/images/red2.png' title='Bu Mail Adresi Kullanılıyo!' />";
		else
			echo "<img src='include/images/kabul.png' title='Bu Mail Adresi Geçerli!' />";
	}
?>