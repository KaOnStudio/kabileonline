<?php include "antet.php"; include "func.php";
if (isset($_SESSION["user"][0]))
{
 $chat_s=chat_s();
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['home'] ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>
    <table class="q_table">
      <tr>
        <td class="td_logo"><?php logo($title); ?></td>
      </tr>
      <tr>
        <td class="td_top_menu">
	<?php menu_up(); ?>
	</td>
      </tr>
      <tr>
        <td class="td_content">
	<span id="chat_t"><?php echo $system[1]; ?></span> <?php echo $lang['chatRefresh']; ?></br>
<script src="func.js" type="text/javascript"></script>
<script type='text/javascript'>
msg=""; sid=1;
function keyUp(key)
{
 if (key==13) submit_msg();
}
function submit_msg()
{
 msg+=document.getElementById("chatmsg").value+" "; document.getElementById("chatmsg").value="";
}
function wipe()
{
 document.getElementById("cBox").value="";
}
function get_sid()
{
 sid=document.getElementById("sid").value;
}
function sTimer(data)
{
	dat=document.getElementById(data);
	var time=dat.innerHTML; var done=0;
	if (time>0) time--;
	else
	{
	 clearTimeout(id[data]); time=<?php echo $system[1]; ?>;
	 chat(msg, sid);
	 msg="";
	}
	dat.innerHTML=time;
	id[data]=setTimeout("sTimer('"+data+"')", 1000);
}
id=0; sTimer('chat_t');
</script>
<textarea class="textbox" id="cBox" cols="60" rows="20" readonly="true"></textarea></br>
<input class="textbox" type="text" id="chatmsg" size="60" onKeyUp="keyUp(event.keyCode)"<?php if ($_SESSION["user"][15]) echo " readonly='true'"; ?>>
<input class="button" type="button" value="<?php echo $lang['send']; ?>" onClick="submit_msg()"><input class="button" type="button" value="<?php echo $lang['clear']; ?>" onClick="wipe()">
<select class="dropdown" id="sid" onChange="get_sid()">
<?php for ($i=0; $i<count($chat_s); $i++) echo "<option value='".$chat_s[$i][0]."'>".$chat_s[$i][1]."</option>"; ?>
</select>
	</td>
      </tr>
      <tr>
        <td class="td_bottom_menu">
        <?php menu_down(); ?>
        </td>
      </tr>
    </table>
<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>
