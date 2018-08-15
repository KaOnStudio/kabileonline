<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["page"]))
{
 $_GET["page"]=clean($_GET["page"]);
 $reports=reports($_SESSION["user"][0]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['reports'] ?></title>
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
        <table class="q_table" style="border-collapse: collapse" width="600" border="1">
            <tr>
              <td><?php echo $lang['subject'] ?></td>
              <td><?php echo $lang['sentAt'] ?></td>
              <td><?php echo $lang['delete'] ?></td>
            </tr>
<?php for ($i=$_GET["page"]*10; $i<$_GET["page"]*10+10; $i++)
			{
			 if (isset($reports[$i]))
				{
					echo "<tr>
              <td>";
					if ($reports[$i][5]) echo "[new] ";
					echo "<a class='q_link' href='msg_view.php?type=0&id=".$reports[$i][0]."'>".$reports[$i][2]."</a></td>
              <td>".$reports[$i][4]."</td>
			  <td><a class='q_link' href='delrep.php?id=".$reports[$i][0]."'>x</a></td>
            </tr>";
				}
			}
?>
          </table>
          <?php for ($i=$_GET["page"]-5; $i<=$_GET["page"]-1; $i++) if ($i>=0) echo "<a class='q_link' href='reports.php?page=".$i."'>".$i."</a> | ";
		  echo $_GET["page"]." | ";
		  for ($i=$_GET["page"]+1; $i<$_GET["page"]+5; $i++) if ($i<ceil(count($reports)/10)) echo "<a class='q_link' href='reports.php?page=".$i."'>".$i."</a> | ";
		  echo "<a class='q_link' href='delallrep.php'>".$lang['deleteAll']."</a>"; ?>
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