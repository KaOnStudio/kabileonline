<?php include "antet.php"; include "func.php";

if (isset($_GET["id"]))
{
 $_GET["id"]=clean($_GET["id"]);
 $_GET["id"]=clean($_GET["id"]);
 check_d($_GET["id"]);
 $del=get_d($_GET["id"]);
 $usr=user($_GET["id"]);
 if (isset($usr[10])) $faction=faction($usr[10]); else $faction=array(0, 0, 0, 0);
 $towns=towns($_GET["id"]);
 if ($usr[11]) $alliance=alliance($usr[11]);
 $twnCount=count($towns); $population=0; $capital=array();
 for ($i=0; $i<$twnCount; $i++)
 {
  if ($towns[$i][4]) $capital=town_xy($towns[$i][0]);
  $population+=$towns[$i][3];
 }
} else header('Location: index.php');
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type="text/javascript"></script>

<head>
<title><?php echo $title; ?> - <?php echo $lang['profileView'] ?></title>
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
		<form name="form1" method="post" action="profile_edit.php">
		  <p>&nbsp;</p>
		  <table class="q_table" style="border-collapse: collapse" width="400" border="1">
            <tr>
              <td class='head_table' colspan="2" align="center"><?php echo $usr[1]; ?></td>
            </tr>
            <tr>
              <td width="184" align="center"><?php echo $lang['faction'] ?></td>
              <td width="183" align="center"><?php echo $faction[1]; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['ally'] ?></td>
              <td align="center"><?php if ($usr[11]) echo "<a class='q_link' href='a_view.php?id=".$alliance[0]."'>".$alliance[1]."</a>"; else echo "-"; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['towns'] ?></td>
              <td align="center"><?php echo $twnCount; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['population'] ?></td>
              <td align="center"><?php echo $population; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['email'] ?></td>
              <td align="left">
                <label>
                <?php if ((isset($_SESSION["user"][1]))&&($_SESSION["user"][1]==$usr[1])) echo "<input class='textbox' name='email' type='text' size='45' value='".$usr[3]."'>"; ?>
              </label></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['description'] ?></td>
              <td align="center">
              <label>
              <textarea class="textbox" name="desc" cols="45" rows="5" <?php if ((!isset($_SESSION["user"][1]))||($_SESSION["user"][1]!=$usr[1])) echo "readonly='true'"; ?>><?php echo $usr[9]; ?></textarea>
              </label></td>
            </tr>
	    <tr>
              <td align="center"><?php echo $lang['points'] ?></td>
              <td align="center"><?php echo $usr[7]; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['regDate'] ?></td>
              <td align="center"><?php echo $usr[5]; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo $lang['lastVisit'] ?></td>
              <td align="center"><?php echo $usr[6]; ?></td>
            </tr>
            <?php if ((isset($_SESSION["user"][1]))&&($_SESSION["user"][1]==$usr[1]))
	    {
	     echo "<tr><td align='center'>".$lang['sitter']."</td><td align='left'><input class='textbox' type='text' name='sitter' value='".$usr[12]."'></td></tr><tr><td align='center'>".$lang['graphPackPath']."</td><td align='left'><input class='textbox' type='text' name='grpath' value='".$usr[13]."'></td></tr><tr><td align='center'>".$lang['language']."</td><td align='left'>
	     <select class='dropdown' name='lang'><option value='".$_SESSION["user"][16]."'>".$_SESSION["user"][16]."</option>";
             $dir=dir("language/");
             while($filename=$dir->read()) if (($filename[0]!=".")&&($filename!=$_SESSION["user"][16])) echo "<option value='".$filename."'>".$filename."</option>";
             $dir->close();
	     echo "</select></td></tr>";
	    }?>
            <?php if ((isset($_SESSION["user"][1]))&&($_SESSION["user"][1]==$usr[1])) echo "<tr> <td align='center'>".$lang['enterPass']."</td><td align='left'><input class='textbox' type='password' name='pass'></td></tr><tr><td align='center'><input class='button' type='submit' name='submit' value='".$lang['save']."'></td><td><---^^</td></tr></form><form name='form2' method='post' action='pass.php'><tr><td align='center'>".$lang['oldPass']."</td><td align='left'><input class='textbox' type='password' name='pass'></td></tr><tr><td align='center'>".$lang['newPass']."</td><td align='left'><input class='textbox' type='password' name='pass_'></td></tr><tr><td align='center'>".$lang['retypePass']."</td><td align='left'><input class='textbox' type='password' name='pass__'></td></tr><tr><td align='center'><input class='button' type='submit' name='edit_pass' value='".$lang['save']."'></td><td><---^^</td></tr></form><form name='form3' method='post' action='delacc.php'><tr><td align='center'>".$lang['enterPass']."</td><td align='left'><input class='textbox' type='password' name='pass'></td></tr><tr><td align='center'><input class='button' type='submit' name='edit_pass' value='".$lang['delAcc']."'></td><td><---^^</td></tr></form>"; ?>
          </table>
<?php
if ((isset($_SESSION["user"][1]))&&($_SESSION["user"][1]==$usr[1]))
 if ($del) echo "<span id='1'>".$del."</span> ".$lang['toDel'].". [<a class='q_link' href='cancel_d.php'>cancel</a>]\n<script type='text/javascript'>var id=new Array(50); timer('1', 'profile_view.php?id=".$_SESSION["user"][0]."'); </script>";
?>
          <table class="q_table" style="border-collapse: collapse" width="400" border="1">
            <tr>
              <td><?=ucfirst($lang['townName'])?></td>
              <td><?php echo $lang['population'] ?></td>
              <td><?php echo $lang['coords'] ?></td>
              <td><?php echo $lang['description'] ?></td>
            </tr>
            <?php for ($i=0; $i<$twnCount; $i++)
			{
			 $town=town_xy($towns[$i][0]); 
			 echo "<tr>
              <td><a class='q_link' href='map.php?x=".$town[0]."&y=".$town[1]."'>".$towns[$i][2]."</a></td>
              <td>".$towns[$i][3]."</td>
              <td>(".$town[0].", ".$town[1].")</td>
			  <td><a class='q_link' href='msg.php?msg=".str_replace("'", "\"", str_replace("\n", "</br>", $towns[$i][14]))."'>view</a></td>
            </tr>";
			} ?>
          </table>
          <?php echo $lang['options'] ?>:</br>
		<a class="q_link" href="map.php?<?php if (isset($capital[0])) echo "x=".$capital[0]."&y=".$capital[1]; ?>"><?php echo $lang['centerMap'] ?></a></br>
        <a class="q_link" href="writemsg.php?name=<?php echo $usr[1]; ?>"><?php echo $lang['writeMsg'] ?></a></br>
		<p align="center">&nbsp;</p>
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