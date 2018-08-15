<?php
	include "include/ronarazoro.php";
	include "include/html/header.html";
	
	$config = config(); //$config[3][1] register açık ise true döner.
	
	if(isset($_POST["newUsername"]))
	{
		$_POST["newUsername"] = clean($_POST["newUsername"]); 
		$config=config();
		if ($config[4][1])
		{
			$usr = user_($_POST["newUsername"]);
			if ($usr[1] == $_POST["newUsername"])
			{
				$pass = rand(1000, 9999);
				if(setPass($usr[0], md5($pass))) {
					if (mail($usr[3], "Gecici Sifreniz : ".$pass)) 
						msg($lang['emailSent']);
					else 
						msg($lang['mailFail']);
				}
				else
					msg("Şifre Değiştirilemedi, Tekrar Deneyiniz!");
			}
			else msg($lang['noUser']);
		}
		else msg($lang['mailPassOff']);
	} 
?>
<div class="contentRegister">
    <br />
	<div class='bilgiMesaj' id='townBilgiDivi' style='display:inherit; height:40px; '>Aşağıdaki Bölüme Kullanıcı Adınızı Yazınız.<br />Kayıt Olurken Verdiğiniz Mail Adresine Geçici Şifreniz Gönderilecektir.</div>
    <form id="forgotform" method="post" action="forgot.php">
    <div style="width:475px; height:400px; margin-left:75px; padding-left:250px; margin-top:0px;"><br /><br /><br /><br /><br /><br />
        <div class="textboxdiv"><input type="text" class="textbox" id="newUsername" name="newUsername" value="kullanıcı adı" onFocus="text_focus('newUsername')" onBlur="text_blur('newUsername')" /></div>
        <div style="clear:both"></div><br />
        <div class="buton" onclick="if(document.getElementById('newUsername').value == '' || document.getElementById('newUsername').value == 'kullanıcı adı') alert('Kullanıcı Adını Yazmadınız!'); else document.getElementById('forgotform').submit();" style="text-align:center; cursor:pointer; font-weight:bold; padding-top:7px; font-size:18px; margin-left:60px;">gönder</div><br />
    </div>
    </form>
</div>
<?php 
	include "include/html/footerIndex.html";
?>			
		