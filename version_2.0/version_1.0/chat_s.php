<?php include "antet.php"; include "func.php";
$chat_s=chat_s();
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script type="text/javascript">
function dat()
{
 data=new Array(<?php for ($i=0; $i<count($chat_s)-1; $i++) echo "'".$chat_s[$i][1]."', "; echo "'".$chat_s[count($chat_s)-1][1]."'"; ?>);
 document.getElementById("rn").value=data[document.getElementById("room").selectedIndex];
 document.getElementById("ri").value=document.getElementById("room").value;
}
</script>
<head>
<title><?php echo $title; ?> - <?php echo $lang['chatRooms']; ?></title>
</head>

<body class="q_body">

<div align="center">
<?php echo $top_ad; ?>
    <table class="q_table">
      <tr>
        <td class="td_logo">
		<?php logo($title); ?></td>
      </tr>
      <tr>
        <td class="td_top_menu"><?php menu_up(); ?></td>
      </tr>
      <tr>
        <td class="td_content">
	  <form name="form" method="post" action="chat_s_.php">
	  room <select class="dropdown" id="room" onChange="dat();">
	  <?php for ($i=0; $i<count($chat_s); $i++) echo "<option value='".$chat_s[$i][0]."'>".$chat_s[$i][1]."</option>"; ?>
	  </select>
	  id <input class="textbox" type="text" id="ri" name="ri" size="3" value="<?php echo $chat_s[0][0]; ?>"> name <input type="text" id="rn" name="rn" value="<?php echo $chat_s[0][1]; ?>"></br>
	  action <select class="dropdown" name="a"><option value="1">add</option><option value="2">edit</option><option value="3">remove</option></select></br>
	  password <input class="textbox" type="password" name="pass">
	  <input class="button" type="submit" value="go">
	  </form>
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
