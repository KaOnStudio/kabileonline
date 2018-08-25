////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function AJAX() 
{
	var ajax = false;
	try { ajax = new ActiveXObject("Msxml2.XMLHTTP"); }
	catch (e) {
		try { ajax = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (e) { ajax = false; }
	}
	if ( !ajax && typeof XMLHttpRequest != 'undefined' ) {   
		try{ ajax = new XMLHttpRequest(); }
		catch(e) { ajax = false; }
	}
	if ( !ajax && window.createRequest ) {
		try{ ajax = window.createRequest(); }
		catch(e) { ajax = false; }
	}
	return ajax;
}
function popupWindowAc(file, id)
{
	var hangiroot = "";
	if(document.getElementById('root').style.display == "")  hangiroot = '2'; 
	ac('root' + hangiroot);
		
    var adres = "include/ajax/buildings.php";
    var veri = "id="+id;
	
	x = new AJAX();
    x.open("POST",adres,true);
    x.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    x.setRequestHeader('Content-Type','application/x-www-form-urlencoded; utf-8');
    x.setRequestHeader('Content-length', veri.length);
    x.setRequestHeader('Connection', 'close');
    x.send(veri);
    x.onreadystatechange=function()
    {
    	var sonucDiv = document.getElementById('handle' + hangiroot);
		if(x.readyState==1){
    		sonucDiv.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
		else if(x.readyState==2){
    		sonucDiv.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
    	else if(x.readyState==3){
    		sonucDiv.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
    	else if (x.readyState==4){
    		sonucDiv.innerHTML = x.responseText;
    	}
    }
	
    var adres2 = file;
    var veri2 = "ajax=1";
	
	y = new AJAX();
    y.open("POST",adres2,true);
    y.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    y.setRequestHeader('Content-Type','application/x-www-form-urlencoded; utf-8');
    y.setRequestHeader('Content-length', veri2.length);
    y.setRequestHeader('Connection', 'close');
    y.send(veri2);
    y.onreadystatechange=function()
    {
    	var sonucDiv2 = document.getElementById('degisecek_popup' + hangiroot);
		if(y.readyState==1){
    		sonucDiv2.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
		else if(y.readyState==2){
    		sonucDiv2.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
    	else if(y.readyState==3){
    		sonucDiv2.innerHTML = "<div style='width:680px; height:350px; margin-left:20px; margin-top:50px;'><br />Lütfen Bekleyiniz...</div>";
    	}
    	else if (y.readyState==4){
		////////////////////////////////////////////////////////////////////////////
			var myScripts = new Array(); myScripts[0]=""; var i = 0;
			sonucDiv2.innerHTML = "<br />";
			data = y.responseText;
			if (data.indexOf("<script type='text/javascript'>") > -1)
				for (start = data.indexOf("<script type='text/javascript'>"); start > -1; start = data.indexOf("<script type='text/javascript'>"))
				{
					end = data.indexOf("</script>");
					scr = document.createElement("SCRIPT"); 
					scr.type = "text/javascript"; 
					scr.text = data.substring(start + 31, end - 1);
					sonucDiv2.innerHTML += data.substring(0, start-1); 
					i++; myScripts[i] = scr; 
					if (data.length > end+9)
						data = data.substring(end + 9); 
					else 
						data = "";
				}
			sonucDiv2.innerHTML += data;
			for(j = i; j > -1; j--) sonucDiv2.appendChild(myScripts[j]);
		//////////////////////////////////////////////////////////////////////
    	}
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function dahaGuvenliEval(__txt__) {
    eval(__txt__);
}

function scriptCalistir(node) {
    var scripts = node.getElementsByTagName('SCRIPT'); 
    for (var i = 0; i < scripts.length; i++) { 
        dahaGuvenliEval(scripts[i].text);
    }
}
function _degerle(sonuc)
{
   var sonuc = /<script.*?>(.*?)<\/script>/.exec(deger);
   if(sonuc){
      eval(sonuc[1]);
   }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function registerAjaxKontrol(degisken, deger)
{
    var adres = "include/ajax/registerKontrol.php";
	if(degisken == 1)
    	var veri = "username=" + deger;
	if(degisken == 3)
		var veri = "mail=" + deger; 
	
	x = new AJAX();
    x.open("POST",adres,true);
    x.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    x.setRequestHeader('Content-Type','application/x-www-form-urlencoded; latin5_turkish_ci');
    x.setRequestHeader('Content-length', veri.length);
    x.setRequestHeader('Connection', 'close');
    x.send(veri);
    x.onreadystatechange=function()
    {
    	var sonucDiv = document.getElementById('register' + degisken);
    	if(x.readyState==1){
    		sonucDiv.innerHTML = "<img src='include/images/loading.gif' />";
    	}
		else if(x.readyState==2){
    		sonucDiv.innerHTML = "<img src='include/images/loading.gif' />";
    	}
    	else if(x.readyState==3){
    		sonucDiv.innerHTML = "<img src='include/images/loading.gif' />";
    	}
    	else if (x.readyState==4){
    		sonucDiv.innerHTML = x.responseText;
    	}
    }
}
function linkOut(id){
	document.getElementById(id).src = "include/images/" + id + ".png";
}
function linkHover(id){
	document.getElementById(id).src = "include/images/" + id + "Ust.png";
}
function text_focus(id){
	if(document.getElementById(id).value == "Kullanıcı Adınız" || document.getElementById(id).value == "Sifreniz" || document.getElementById(id).value == "kullanıcı adı" || document.getElementById(id).value == "şifre" || document.getElementById(id).value == "şifre tekrar" || document.getElementById(id).value == "mail adresi"){
		document.getElementById(id).value = "";
		document.getElementById(id).style.color = "#000";
		if(id == "password" || id == "newPassword1" || id == "newPassword2") document.getElementById(id).type = "password";
	}
}
function text_blur(id){
	if(document.getElementById(id).value == ""){
		document.getElementById(id).type = "text";
		document.getElementById(id).style.color = "#666";
		if(id == "password") document.getElementById(id).value = "Sifreniz";
		else if(id == "username") document.getElementById(id).value = "Kullanıcı Adınız";
		else if(id == "newUsername"){ document.getElementById(id).value = "kullanıcı adı"; document.getElementById('register1').innerHTML = "";  }
		else if(id == "newPassword1") document.getElementById(id).value = "şifre";
		else if(id == "newPassword2"){ document.getElementById(id).value = "şifre tekrar";  document.getElementById('register2').innerHTML = ""; }
		else if(id == "newMail"){ document.getElementById(id).value = "mail adresi";  document.getElementById('register3').innerHTML = ""; }
	}
	else if(id == "newUsername"){
		registerAjaxKontrol(1, document.getElementById(id).value);
	}
	else if(id == "newPassword1" && document.getElementById('newPassword2').value != ""){
		if (document.getElementById('newPassword1').value != document.getElementById('newPassword2').value)
			document.getElementById('register2').innerHTML = "<img src='include/images/red1.png' title='Şifrelerin Uyuşmuyor Dostum!' />";
		else
			document.getElementById('register2').innerHTML = "<img src='include/images/kabul.png' title='İki Şifreyide Aynı Yazmayı Başardın!' />";
	}
	else if(id == "newPassword2"){
		if (document.getElementById('newPassword1').value != document.getElementById('newPassword2').value)
			document.getElementById('register2').innerHTML = "<img src='include/images/red1.png' title='Şifrelerin Uyuşmuyor Dostum!' />";
		else
			document.getElementById('register2').innerHTML = "<img src='include/images/kabul.png' title='İki Şifreyide Aynı Yazmayı Başardın!' />";
	}
	else if(id == "newMail"){
		if (!mailKontrol(document.getElementById(id).value))
			document.getElementById('register3').innerHTML = "<img src='include/images/red2.png' title='Bu Bir Mail Adresi Bile Değil Adamım!' />";
		else
			registerAjaxKontrol(3, document.getElementById(id).value);
	}
}
function loginKontrol()
{
	if (document.getElementById('username').value == '' || document.getElementById('username').value == 'Kullanıcı Adınız')
	{
		alert('Kullanıcı Adını Girmelisin!');
		document.getElementById('username').focus();
		return false;
	}
	if (document.getElementById('password').value == '' || document.getElementById('password').value == 'Sifreniz')
	{
		alert('Şifreni Girmelisin!');
		document.getElementById('password').focus();
		return false;
	}
	return true;
}
//###############################################################
function timer(data, lnk)
{
	dat=document.getElementById(data);
	var time=(dat.innerHTML).split(":"); var done=0;
	if (time[2]>0) { time[2]--; if(time[2] < 10) time[2]="0"+time[2]; }
	else
	{
		time[2]=59;
		if (time[1]>0) { time[1]--; if(time[1] < 10) time[1]="0"+time[1]; }
		else
		{
			time[1]=59;
			if (time[0]>0) { time[0]--; if(time[0] < 10) time[0]="0"+time[0]; }
				
			else 
			{ 
				clearTimeout(id[data]); 
				window.location.href=lnk; 
				done=1;
			}
		}
	}
	if (!done)
	{
		dat.innerHTML=time[0]+":"+time[1]+":"+time[2];
		id[data]=setTimeout("timer('"+data+"', '"+lnk+"')", 1000);
	}
}
function registerKontrol()
{
	if (document.getElementById('newUsername').value == '' || document.getElementById('newUsername').value == 'kullanıcı adı')
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML = 'Kullanıcı Adı Oluşturmadan Üye Olmayı Düşünmüyorsun Dimi!';
		document.getElementById('newUsername').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (document.getElementById('newPassword1').value == '' || document.getElementById('newPassword1').value == 'şifre')
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Şifre Oluşturmadan Üye Olmayı Düşünmüyorsun Dimi!';
		document.getElementById('newPassword1').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (document.getElementById('newPassword2').value == '' || document.getElementById('newPassword2').value == 'şifre tekrar')
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Şifre Oluşturmadan Üye Olmayı Düşünmüyorsun Dimi!';
		document.getElementById('newPassword2').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (document.getElementById('newPassword1').value != document.getElementById('newPassword2').value)
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Şifrelerin Uyuşmuyor, Yanlış Yazdın Galiba!';
		document.getElementById('newPassword2').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (document.getElementById('newMail').value == '' || document.getElementById('newMail').value == 'mail adresi')
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Mailini Yazmadan Üye Olmayı Düşünmüyorsun Dimi!';
		document.getElementById('newMail').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (!mailKontrol(document.getElementById('newMail').value))
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Yazdığın Mail Güzel Değil, Bi Kontrol Ediver!';
		document.getElementById('newMail').focus();
		setTimeout("kapat('kontroller')",2000);
		return false;
	}
	if (document.getElementById('newKabile').value == "0")
	{
		ac('kontroller');
		document.getElementById('kontroller').innerHTML ='Kabileni Seçmeden Üye Olmayı Düşünmüyorsun Dimi!';
		document.getElementById('newKabile').focus();
		setTimeout("kapat('kontroller')",2500);
		return false;
	}
	kapat('kontroller');
	document.getElementById('registerform').submit();
	return true;
}
function sayiKontrol(e) 
{
	olay = document.all ? window.event : e;
	tus = document.all ? olay.keyCode : olay.which;
	if((tus<48||tus>57)&&tus!=8) {
		if(document.all) { olay.returnValue = false; } else { olay.preventDefault(); }
	}
}
function harfKontrol(e) 
{
	olay = document.all ? window.event : e;
	tus = document.all ? olay.keyCode : olay.which;
	if(tus>=48&&tus<=57) {
		if(document.all) { olay.returnValue = false; } else { olay.preventDefault(); }
	}
}
function mailKontrol(mail)
{
    var duzenli = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
    return duzenli.test(mail);
}
function kapat (id) {
	document.getElementById(id).style.display = "none";
}
function sonraKapat (id, aralik) {
	setTimeout("kapat('"+id+"')", aralik);
}
function ac (id) {
	document.getElementById(id).style.display = "";
}
function ackapat (id) {
	if(document.getElementById(id).style.display == "none")
		ac(id);
	else
		kapat(id);
}
function kapatMap (id) {
	document.getElementById(id).style.display = "none";
	document.getElementById(id).innerHTML = "";
}
function acMap (id) {
	document.getElementById(id).style.display = "";
}
function gosterKapat(id1, id2)
{
	ackapat(id1);
	ackapat(id2);
}
function git (path) {
	window.location = path;
}
function valueVer (id, deger) {
	document.getElementById(id).value = deger;
}
function startres()
{
	res_sec0=res_ph0/3600;
	res_sec1=res_ph1/3600;
	res_sec2=res_ph2/3600;
	res_sec3=res_ph3/3600;
	res_sec4=res_ph4/3600;

	res_start0=res_start0+res_sec0; if (res_start0 > res_limit0) res_start0=res_limit0;
	res_start1=res_start1+res_sec1; if (res_start1 > res_limit1) res_start1=res_limit1;
	res_start2=res_start2+res_sec2; if (res_start2 > res_limit2) res_start2=res_limit2;
	res_start3=res_start3+res_sec3; if (res_start3 > res_limit3) res_start3=res_limit3;
	res_start4=res_start4+res_sec4; if (res_start4 > res_limit4) res_start4=res_limit4;

	res_show0=Math.round(res_start0);
	res_show1=Math.round(res_start1);
	res_show2=Math.round(res_start2);
	res_show3=Math.round(res_start3);
	res_show4=Math.round(res_start4);

	document.getElementById("res0").innerHTML=res_show0;
	document.getElementById("res1").innerHTML=res_show1;
	document.getElementById("res2").innerHTML=res_show2;
	document.getElementById("res3").innerHTML=res_show3;
	document.getElementById("res4").innerHTML=res_show4;

	setTimeout('startres()',1000);
}
//###############################################################
function inittabs() 
{
	// Grab the tab links and content divs from the page
	var tabListItems = document.getElementById('tabs').childNodes;
	for ( var i = 0; i < tabListItems.length; i++ ) 
	{
	    if ( tabListItems[i].nodeName == "LI" ) 
		{
        	var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
        	var id = getHash( tabLink.getAttribute('href') );
        	tabLinks[id] = tabLink;
        	contentDivs[id] = document.getElementById( id );
	    }
	}

	// Assign onclick events to the tab links, and
	// highlight the first tab
	var i = 0;

	for ( var id in tabLinks ) 
	{
	    tabLinks[id].onclick = showTab;
	    tabLinks[id].onfocus = function() 
		{ 
			this.blur() 
		};
	    if ( i == 0 ) tabLinks[id].className = 'selected';
	    i++;
	}

	// Hide all content divs except the first
	var i = 0;

	for ( var id in contentDivs ) 
	{
	    if ( i != 0 ) 
			contentDivs[id].className = 'tabContent hide';
		i++;
    }
	return;
}
//###############################################################
function showTab() 
{
	var selectedId = getHash( this.getAttribute('href') );

	// Highlight the selected tab, and dim all others.
	// Also show the selected content div, and hide all others.
	for ( var id in contentDivs ) 
	{
	    if ( id == selectedId ) 
		{
        	tabLinks[id].className = 'selected';
        	contentDivs[id].className = 'tabContent';
	    } 
		else 
		{
        	tabLinks[id].className = '';
        	contentDivs[id].className = 'tabContent hide';
	    }
	}

	// Stop the browser following the link
	return false;
}

//###############################################################
function getFirstChildWithTagName( element, tagName ) 
{
	for ( var i = 0; i < element.childNodes.length; i++ ) 
	{
	    if ( element.childNodes[i].nodeName == tagName ) 
			return element.childNodes[i];
	}
}
//###############################################################
function getHash(url) 
{
	var hashPos = url.lastIndexOf ( '#' );
	return url.substring( hashPos + 1 );
}
//###############################################################
function trade_options(type, subtype, data)
{
	t=document.getElementById(type);
	st=document.getElementById(subtype);
	if (t.value==0) 
		st.innerHTML="<select name='"+subtype.substr(0, subtype.length-1)+"'><option value='0'>Tahil</option><option value='1'>Odun</option><option value='2'>Tas</option><option value='3'>Demir</option><option value='4'>Altin</option></select>";
	else 
		st.innerHTML="<select name='"+subtype.substr(0, subtype.length-1)+"'><option value='0'>"+data[0]+"</option><option value='1'>"+data[1]+"</option><option value='2'>"+data[2]+"</option><option value='3'>"+data[3]+"</option><option value='4'>"+data[4]+"</option><option value='5'>"+data[5]+"</option><option value='6'>"+data[6]+"</option><option value='7'>"+data[7]+"</option><option value='8'>"+data[8]+"</option><option value='9'>"+data[9]+"</option></select>";
}
//###############################################################
function template(lnk, vars)
{
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e) {
		// Internet Explorer
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				alert("Kullandığın Browser AJAX desteklemiyor!");
				return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4) {
			acMap('content');
			con = document.getElementById('content'); con.innerHTML = "";
			data = xmlHttp.responseText; c = 0;
			if (data.indexOf("<script type='text/javascript'>") > -1)
				for (start = data.indexOf("<script type='text/javascript'>"); start > -1; start = data.indexOf("<script type='text/javascript'>"))
				{
					end = data.indexOf("</script>");
					scr = document.createElement("SCRIPT"); 
					scr.type = "text/javascript"; 
					scr.text = data.substring(start + 31, end - 1);
					con.innerHTML += data.substring(0, start-1); 
					con.appendChild(scr);
					if (data.length > end+9)
						data = data.substring(end + 9); 
					else 
						data = "";
				}
			con.innerHTML += data;
		}
	}
	if (vars) {
		xmlHttp.open("POST", lnk, true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlHttp.send(vars);
	}
	else {
		xmlHttp.open("GET", lnk, true);
		xmlHttp.send(null);
	}
}
//###############################################################
function desc(town, player, population, alliance)
{
	if(town == "Açiklama")
		document.getElementById("descriptor").innerHTML = "";
	else
		document.getElementById("descriptor").innerHTML = "<table style='border:none; width:800px;' border='0'><tr style='height:30px'><td style='width:230px;' align='center'><b>"+town+"</b></td><td style='width:80px;' align='right'><b>Oyuncu : </b></td><td style='width:125px;' align='left'>"+player+"</td><td style='width:80px;' align='right'><b>Nüfus : </b></td style='width:80px;' align='left'><td>"+population+"</td><td style='width:80px;' align='right'><b>İttifak : </b></td><td style='width:125px;' align='left'>"+alliance+"</td></tr></table>";	
}
//###############################################################
function xmenu(uid, tid, utid)
{
	 document.getElementById("xmenu").innerHTML="<a class='q_link' href='profile_view.php?id="+uid+"'>profiline bak</a>";
	 if (utid)
		document.getElementById("xmenu").innerHTML+=" | <a class='q_link' href='writemsg.php?id="+uid+"'>mesaj yaz</a> | <a class='q_link' href='#' onclick=\"kapatMap('content'); popupWindowAc('include/popup/dispatch.php?town="+utid+"&target="+tid+"', '23');\">asker gönder</a>";
}
//###############################################################
function map()
{
	var vars="x="+document.getElementById("x").value+"&y="+document.getElementById("y").value;
	template('map_.php', vars);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
