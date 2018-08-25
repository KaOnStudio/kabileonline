<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["page"]))
{
 $_GET["page"]=clean($_GET["page"]);
 $messages=messages($_SESSION["user"][0]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['messages'] ?></title>
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
        <a class='q_link' href='writemsg.php'><?php echo $lang['write'] ?></a>
        <table class="q_table" style="border-collapse: collapse" width="600" border="1">
            <tr>
              <td><?php echo $lang['subject'] ?></td>
              <td><?php echo $lang['sender'] ?></td>
              <td><?php echo $lang['sentAt'] ?></td>
              <td><?php echo $lang['delete'] ?></td>
	      <td><?php echo $lang['reply'] ?></td>
            </tr>
<?php for ($i=$_GET["page"]*10; $i<$_GET["page"]*10+10; $i++)
			{
			 if (isset($messages[$i]))
			 {
			  $usr=user($messages[$i][1]);
			  echo "<tr>
              <td>";
					if ($messages[$i][6]) echo "[new] ";
					echo "<a class='q_link' href='msg_view.php?type=1&id=".$messages[$i][0]."'>".$messages[$i][3]."</a></td>
			  <td><a class='q_link' href='profile_view.php?id=".$usr[0]."'>".$usr[1]."</a></td>
              <td>".$messages[$i][5]."</td>
			  <td><a class='q_link' href='delmsg.php?id=".$messages[$i][0]."'>x</a></td>
			  <td><a class='q_link' href='writemsg.php?msg=".$messages[$i][0]."'>".$lang['reply']."</a></td>
            </tr>";
			 }
			}
?>
          </table>
          <?php for ($i=$_GET["page"]-5; $i<=$_GET["page"]-1; $i++) if ($i>=0) echo "<a class='q_link' href='messages.php?page=".$i."'>".$i."</a> | ";
		  echo $_GET["page"]." | ";
		  for ($i=$_GET["page"]+1; $i<$_GET["page"]+5; $i++) if ($i<ceil(count($messages)/10)) echo "<a class='q_link' href='messages.php?page=".$i."'>".$i."</a> | ";
		  echo "<a class='q_link' href='delallmsg.php'>".$lang['deleteAll']."</a>"; ?>
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