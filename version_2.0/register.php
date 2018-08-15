<?php
	include "include/ronarazoro.php";
	include "include/html/header.html";
	
	$config = config(); //$config[3][1] register açık ise true döner.
	
	$eklendi = -1;
	if(isset($_POST["newUsername"]))
	{
		$_POST["newMail"]		= clean($_POST["newMail"]); 
		$_POST["newUsername"]	= clean($_POST["newUsername"]); 
		$_POST["newPassword1"]	= clean($_POST["newPassword1"]); 
		$_POST["newKabile"]		= clean($_POST["newKabile"]);
		
		if(!is_user1($_POST["newUsername"]))
			if(!is_user2($_POST["newMail"]))
				$eklendi = reg($_POST["newUsername"], md5($_POST["newPassword1"]), $_POST["newMail"], $_POST["newKabile"]); //başarılı ise 1, başarısız ise 0 döner.
			else
				$eklendi = 2;
		else
			$eklendi = 3;
		
		session_destroy();
	}	
?>
<div class="contentRegister">
    <br />
    <?php 
    if($eklendi==0) echo "
    <div class='olumsuzMesaj'>
        Bir Hata Oluştu, Lütfen Tekrar Deneyiniz.
    </div>";
	if($eklendi==1) echo "
    <div class='olumluMesaj'>
        Başarıyla Kaydoldun!
    </div>";
	if($eklendi==2) echo "
    <div class='olumsuzMesaj'>
        Bu Mail Adresi Zaten Kullanılıyor.
    </div>";
	if($eklendi==3) echo "
    <div class='olumsuzMesaj'>
        Bu Kullanıcı Adı Zaten Kullanılıyor.
    </div>";	
    if(!$config[3][1]) echo "
    <div class='bilgiMesaj'>
        Şuanda Yeni Üye Alımı Durdurulmuş Durumdadır!
    </div>";	
    ?>
    <div id="kontroller" class="olumsuzMesaj" style="display:none; position:absolute;" onclick="kapat('kontroller');"></div>
    <form id="registerform" method="post" action="register.php">
    <div style="width:475px; height:400px; margin-left:75px; padding-left:250px; margin-top:0px;"><br /><br />
    
        <div class="textboxdiv"><input type="text" class="textbox" id="newUsername" name="newUsername" value="kullanıcı adı" onFocus="text_focus('newUsername')" onBlur="text_blur('newUsername')" /></div>
        <div id="register1" style="width:32px; height:32px; float:left; margin-top:7px;"></div>
        <div style="clear:both"></div><br />
        
        <div class="textboxdiv"><input type="text" class="textbox" id="newPassword1" name="newPassword1" value="şifre" onFocus="text_focus('newPassword1')" onBlur="text_blur('newPassword1')" /></div><br />
        <div style="clear:both"></div><br />
        
        <div class="textboxdiv"><input type="text" class="textbox" id="newPassword2" name="newPassword2" value="şifre tekrar" onFocus="text_focus('newPassword2')" onBlur="text_blur('newPassword2')" /></div>
        <div id="register2" style="width:32px; height:32px; float:left; margin-top:7px;"></div>
        <div style="clear:both"></div><br />
        
        <div class="textboxdiv"><input type="text" class="textbox" id="newMail" name="newMail" value="mail adresi" onFocus="text_focus('newMail')" onBlur="text_blur('newMail')" /></div>
        <div id="register3" style="width:32px; height:32px; float:left; margin-top:7px;"></div>
        <div style="clear:both"></div><br />
        
        <div class="textboxdiv"><select class="textbox" id="newKabile" name="newKabile">
        	<option value="0" style="background:#CCC;">Kabile</option>
            <option value="1" style="color:#000;" <?php if(isset($_GET["faction"]) and get("faction")=="1") echo "selected=selected"; ?> >Svanan İmparatorluğu</option>
            <option value="2" style="color:#000;" <?php if(isset($_GET["faction"]) and get("faction")=="2") echo "selected=selected"; ?> >Ronark Krallığı</option>
            <option value="3" style="color:#000;" <?php if(isset($_GET["faction"]) and get("faction")=="3") echo "selected"; ?> >Melgit Hanlığı</option></select></div>
        <div id="register4" style="width:32px; height:32px; float:left; margin-top:7px;"></div><br />
        <div style="clear:both"></div><br />
        
        <div class="buton" onclick="registerKontrol();" style="text-align:center; cursor:pointer; font-weight:bold; padding-top:7px; font-size:18px; margin-left:60px;">BAŞLA</div><br />
    </div>
    </form>
    
</div>
<?php 
	include "include/html/footerIndex.html";
?>			
		