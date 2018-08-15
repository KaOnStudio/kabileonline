<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $gen_stats=gen_stats(48);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $units=units($faction[0]);
 
 $army=explode("-", $town[7]); $gen=explode("-", $town[15]);
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - <?php echo $lang['general'] ?></title>
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
<?php echo $lang['chooseUnitToGeneral'] ?>:</br></br>
<?php
echo "<form name='gen' method='post' action='gen_.php?town=".$_GET["town"]."'>
<select class='dropdown' name='utype'>";
for ($i=0; $i<13; $i++) if ($army[$i]) echo"<option value='".$i."'>".$units[$i][2]."</option>";
?>
</select>
<input class='button' type='submit' name='button0' value='Promote'>
</form>
<?php
if (!$gen[1]) label($lang['noGeneral']);
else
{
 label($lang['generalLevel']." ".$gen[1]." ".$units[$gen[2]][2].".</br></br>");
 if (!$gen[0]) label($lang['generalAway']);
}
?>
</br><?php echo $lang['selFormDef'] ?>:</br></br>
<form name='gen' method='post' action='def_f.php?town=<?php echo $_GET["town"]; ?>'>
<select class='dropdown' name='formation'><option value='0'><?php echo $lang['standard'] ?></option><option value='1'><?php echo $lang['offensive'] ?></option><option value='2'><?php echo $lang['defensive'] ?></option></select></select>
<input class='button' type='submit' name='button0' value='<?php echo $lang['select'] ?>'>
</form>
<?php echo $lang['curForm'] ?>: <?php switch($gen[3]) {case 0: echo $lang['standard']; break; case 1: echo $lang['offensive']; break; case 2: echo $lang['defensive']; break;} ?>
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
