//###############################################################
function template(lnk, vars)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Kullandýðýn Browser AJAX desteklemiyor!");
				return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			con=document.getElementById('content'); con.innerHTML="";
			data=xmlHttp.responseText; c=0;
			if (data.indexOf("<script type='text/javascript'>")>-1)
				for (start=data.indexOf("<script type='text/javascript'>"); start>-1; start=data.indexOf("<script type='text/javascript'>"))
				{
					end=data.indexOf("</script>");
					scr=document.createElement("SCRIPT"); scr.type = "text/javascript"; scr.text=data.substring(start+31, end-1);
					con.innerHTML+=data.substring(0, start-1); con.appendChild(scr);
					if (data.length>end+9)
						data=data.substring(end+9); 
					else 
						data="";
				}
			con.innerHTML+=data;
		}
	}
	if (vars)
	{
		xmlHttp.open("POST", lnk, true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlHttp.send(vars);
	}
	else
	{
		xmlHttp.open("GET", lnk, true);
		xmlHttp.send(null);
	}
}
//###############################################################
function chat(msg, sid)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Kullandýðýn Browser AJAX desteklemiyor!");
				return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			cbox=document.getElementById("cBox");
			cbox.value+=xmlHttp.responseText;
			cbox.scrollTop=cbox.scrollHeight;
		}
	}
	xmlHttp.open("POST","chat_.php?sid="+sid, true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlHttp.send('msg='+msg);
}
//###############################################################
function go(lnk)
{
	window.location.href=lnk;
}
//###############################################################
function desc(town, player, population, alliance)
{
	document.getElementById("descriptor").innerHTML="<table class='q_table_desc' style='border-collapse: collapse' width='250' border='1'><tr><td colspan='2' align='center'>"+town+"</tr><tr><td width='117' align='center'>Oyuncu<td>"+player+"</td></tr><tr><td width='117' align='center'>Nüfus<td>"+population+"</td></tr><tr><td width='117' align='center'>Ittifak<td>"+alliance+"</td></tr></table>";
}
//###############################################################
function timer(data, lnk)
{
	dat=document.getElementById(data);
	var time=(dat.innerHTML).split(":"); var done=0;
	if (time[2]>0) time[2]--;
	else
	{
		time[2]=59;
		if (time[1]>0) time[1]--;
		else
		{
			time[1]=59;
			if (time[0]>0) 
				time[0]--;
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
//###############################################################
function forgot()
{
	usr=document.getElementById("name");
	go("forgot.php?name="+usr.value);
}
//###############################################################
function trade_options(type, subtype, data)
{
	t=document.getElementById(type);
	st=document.getElementById(subtype);
	if (t.value==0) 
		st.innerHTML="<select name='"+subtype.substr(0, subtype.length-1)+"'><option value='0'>Tahil</option><option value='1'>Odun</option><option value='2'>Tas</option><option value='3'>Demir</option><option value='4'>Altin</option></select>";
	else 
		st.innerHTML="<select name='"+subtype.substr(0, subtype.length-1)+"'><option value='0'>"+data[0]+"</option><option value='1'>"+data[1]+"</option><option value='2'>"+data[2]+"</option><option value='3'>"+data[3]+"</option><option value='4'>"+data[4]+"</option><option value='5'>"+data[5]+"</option><option value='6'>"+data[6]+"</option><option value='7'>"+data[7]+"</option><option value='8'>"+data[8]+"</option><option value='9'>"+data[9]+"</option><option value='10'>"+data[10]+"</option></select>";
}
//###############################################################
function showtext(building)
{
	if (!document.getElementById)
	return;
        textcontainerobj=document.getElementById("label");
        document.getElementById("label").innerHTML=building;
}
//###############################################################
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
function xmenu(uid, tid, utid)
{
	 document.getElementById("xmenu").innerHTML="<a class='q_link' href='profile_view.php?id="+uid+"'>bak</a>";
	 if (utid) 
		document.getElementById("xmenu").innerHTML+=" | <a class='q_link' href='writemsg.php?id="+uid+"'>yaz</a> | <a class='q_link' href='dispatch.php?town="+utid+"&target="+tid+"'>gönder</a>";
}
//###############################################################
function map()
{
	var vars="x="+document.getElementById("x").value+"&y="+document.getElementById("y").value;
	template('map_.php', vars);
}
//###############################################################
function act_forum(town)
{
	vars="a="+document.getElementById("f_a").value+"&id="+document.getElementById("f_id").value+"&parent="+document.getElementById("f_parent").value+"&name="+document.getElementById("f_name").value+"&desc="+document.getElementById("f_desc").value;
	template("forums_.php?town="+town, vars);
}
//###############################################################
function act_thread(town, forum)
{
	vars="a="+document.getElementById("t_a").value+"&id="+document.getElementById("t_id").value+"&name="+document.getElementById("t_name").value+"&desc="+document.getElementById("t_desc").value+"&content="+document.getElementById("t_content").value;
	template("thread_.php?town="+town+"&forum="+forum, vars);
}
//###############################################################
function act_post(town, thread)
{
	vars="a="+document.getElementById("p_a").value+"&id="+document.getElementById("p_id").value+"&desc="+document.getElementById("p_desc").value+"&content="+document.getElementById("p_content").value;
	template("posts_.php?town="+town+"&thread="+thread, vars);
}
//###############################################################