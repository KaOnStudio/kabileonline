<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0]))
{
 $towns=towns($_SESSION["user"][0]);
 $twnCount=count($towns);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['towns'] ?></title>
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
		<td class="td_content" valign="top"></br>
          <?php if (!$twnCount) echo "[<a class='q_link' href='create.php'>".$lang['createTown']."</a>]"; else echo "[<a class='q_link' href='create.php'>".$lang['createTown']."</a>]"; ?>
          <table class="q_table" style="border-collapse: collapse" width="600" border="1">
            <tr>
              <td class='head_table'><?php echo $lang['townName'] ?></td>
              <td class='head_table'><?php echo $lang['population'] ?></td>
              <td class='head_table'><?php echo $lang['coords'] ?></td>
              <td class='head_table'><?php echo $lang['abandon'] ?></td>
              <td class='head_table'><?php echo $lang['purge'] ?></td>
	      
            </tr>
            <?php for ($i=0; $i<$twnCount; $i++)
			{
			 $town=town_xy($towns[$i][0]); 
			 echo "<tr>
              <td><a class='q_link' href='town.php?town=".$towns[$i][0]."'>".$towns[$i][2]."</a></td>
              <td>".$towns[$i][3]."</td>
              <td><a class='q_link' href='map.php?x=".$town[0]."&y=".$town[1]."'>(".$town[0].", ".$town[1].")</a></td>
              <td>[<a class='q_link' href='abandon.php?town=".$towns[$i][0]."'>".$lang['abandon']."</a>]</td>
              <td>[<a class='q_link' href='purge.php?town=".$towns[$i][0]."'>".$lang['purge']."</a>]</td>
	      
            </tr>";
			} ?>
          </table>
	  [<a class='q_link' href='ch_capital.php'><?php echo $lang['changeCap'] ?></a>]
      </td>
	</tr>
	<tr>
		<td class="td_bottom_menu">
		<?php menu_down(); ?></td>
	</tr>
</table>

<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>