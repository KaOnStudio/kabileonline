<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"]))
{
 $_GET["town"]=clean($_GET["town"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 $faction=faction($_SESSION["user"][10]);
 $factions=factions();
 $units=units($faction[0]);
 
 $army=explode("-", $town[7]);
 if (isset($_GET["target"])) $target=clean($_GET["target"]); else $target="";
}
else {header('Location: login.php'); die();}
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<script src="func.js" type="text/javascript"></script>

<head>
<title><?php echo $title." - combat simulator"; ?></title>
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
          <p>
<?php
$fdata=""; for ($i=1; $i<=count($factions); $i++) $fdata=$fdata."<option value='".$i."'>".$factions[$i-1][1]."</option>";
if (!isset($_POST["d_army"])) echo "<form name='c_sim' method='post' action='csim.php?town=".$_GET["town"]."'>
<table class='q_table' style='border-collapse: collapse' width='600' border='1'>
<tr><td colspan='2' align='center'>defender</td></tr>
<tr><td title='The factions in the game influence economics and warfare.'>faction</td><td><select class='dropdown' name='d_faction'>".$fdata."</select></td></tr>
<tr><td title='The number of units for each unit type.'>army</td><td><input class='textbox' name='d_army' type='text' size='45' value='".$town[7]."'></td></tr>
<tr><td title='[<general presence>-<level>-<unit type>-<formation>]'>general</td><td><input class='textbox' name='d_gen' type='text' size='45' value='".$town[15]."'></td></tr>
<tr><td title='The level of each building.'>buildings</td><td><input class='textbox' name='d_buildings' type='text' size='45' value='".$town[8]."'></td></tr>
<tr><td title='6th and 7th number represent the bonus for defense & offense.'>limits</td><td><input class='textbox' name='d_limits' type='text' size='65' value='".$town[11]."'></td></tr>
<tr><td title='Amount of stored resources, by type.'>resources</td><td><input class='textbox' name='d_resources' type='text' size='65' value='".$town[10]."'></td></tr>
<tr><td title='Amount of stored weapons, by type.'>weapons</td><td><input class='textbox' name='d_weapons' type='text' size='45' value='".$town[6]."'></td></tr>
<tr><td title='Unit HP upgrades, by unit type.'>unit upgrades</td><td><input class='textbox' name='d_unit_u' type='text' size='45' value='".$town[17]."'></td></tr>
<tr><td title='Unit ATK upgrades, by unit type.'>weapon upgrades</td><td><input class='textbox' name='d_weapon_u' type='text' size='45' value='".$town[18]."'></td></tr>
<tr><td title='Unit DEF upgrades, by unit type.'>armor upgrades</td><td><input class='textbox' name='d_armor_u' type='text' size='45' value='".$town[19]."'></td></tr>
</table>
<table class='q_table' style='border-collapse: collapse' width='600' border='1'>
<tr><td colspan='2' align='center'>attacker</td></tr>
<tr><td title='The factions in the game influence economics and warfare.'>faction</td><td><select class='dropdown' name='a_faction'>".$fdata."</select></td></tr>
<tr><td title='The number of units for each unit type.'>army</td><td><input class='textbox' name='a_army' type='text' size='45' value='".$town[7]."'></td></tr>
<tr><td title='[<general presence>-<level>-<unit type>-<formation>]'>general</td><td><input class='textbox' name='a_gen' type='text' size='45' value='".$town[15]."'></td></tr>
<tr><td title='Unit HP upgrades, by unit type.'>unit upgrades</td><td><input class='textbox' name='a_unit_u' type='text' size='45' value='".$town[17]."'></td></tr>
<tr><td title='Unit ATK upgrades, by unit type.'>weapon upgrades</td><td><input class='textbox' name='a_weapon_u' type='text' size='45' value='".$town[18]."'></td></tr>
<tr><td title='Unit DEF upgrades, by unit type.'>armor upgrades</td><td><input class='textbox' name='a_armor_u' type='text' size='45' value='".$town[19]."'></td></tr>
</table>
<select class='dropdown' name='type'>
<option value='1'>raid</option>
<option value='2'>attack</option>
</select>
<input class='button' type='submit' name='button0' value='Simulate combat'>
</form>";
else
{
 $data[0][0]=$_POST["d_faction"]; $data[0][1]=explode("-", $_POST["d_army"]); $data[0][2]=explode("-", $_POST["d_gen"]); $data[0][3]=explode("-", $_POST["d_buildings"]); $data[0][4]=explode("-", $_POST["d_limits"]); $data[0][5]=explode("-", $_POST["d_resources"]); $data[0][6]=explode("-", $_POST["d_weapons"]); $data[0][7]=explode("-", $_POST["d_unit_u"]); $data[0][8]=explode("-", $_POST["d_weapon_u"]); $data[0][9]=explode("-", $_POST["d_armor_u"]);
 $data[1][0]=$_POST["a_faction"]; $data[1][1]=explode("-", $_POST["a_army"]); $data[1][2]=explode("-", $_POST["a_gen"]); $data[1][3]=explode("-", $_POST["a_unit_u"]); $data[1][4]=explode("-", $_POST["a_weapon_u"]); $data[1][5]=explode("-", $_POST["a_armor_u"]);
 $data[2]=$_POST["type"];
 $data=battle($data);
 echo "<form name='c_sim' method='post' action='csim.php?town=".$_GET["town"]."'>
<table class='q_table' style='border-collapse: collapse' width='600' border='1'>
<tr><td colspan='2' align='center'>defender</td></tr>
<tr><td title='The factions in the game influence economics and warfare.'>faction</td><td><select class='dropdown' name='d_faction'>".$fdata."</select></td></tr>
<tr><td title='The number of units for each unit type.'>army</td><td><input class='textbox' name='d_army' type='text' size='45' value='".implode("-", $data[0][1])."'></td></tr>
<tr><td title='[<general presence>-<level>-<unit type>-<formation>]'>general</td><td><input class='textbox' name='d_gen' type='text' size='45' value='".implode("-", $data[0][2])."'></td></tr>
<tr><td title='The level of each building.'>buildings</td><td><input class='textbox' name='d_buildings' type='text' size='45' value='".implode("-", $data[0][3])."'></td></tr>
<tr><td title='6th and 7th number represent the bonus for defense & offense.'>limits</td><td><input class='textbox' name='d_limits' type='text' size='65' value='".implode("-", $data[0][4])."'></td></tr>
<tr><td title='Amount of stored resources, by type.'>resources</td><td><input class='textbox' name='d_resources' type='text' size='65' value='".implode("-", $data[0][5])."'></td></tr>
<tr><td title='Amount of stored weapons, by type.'>weapons</td><td><input class='textbox' name='d_weapons' type='text' size='45' value='".implode("-", $data[0][6])."'></td></tr>
<tr><td title='Unit HP upgrades, by unit type.'>unit upgrades</td><td><input class='textbox' name='d_unit_u' type='text' size='45' value='".$town[17]."'></td></tr>
<tr><td title='Unit ATK upgrades, by unit type.'>weapon upgrades</td><td><input class='textbox' name='d_weapon_u' type='text' size='45' value='".$town[18]."'></td></tr>
<tr><td title='Unit DEF upgrades, by unit type.'>armor upgrades</td><td><input class='textbox' name='d_armor_u' type='text' size='45' value='".$town[19]."'></td></tr>
</table>
<table class='q_table' style='border-collapse: collapse' width='600' border='1'>
<tr><td colspan='2' align='center'>attacker</td></tr>
<tr><td title='The factions in the game influence economics and warfare.'>faction</td><td><select class='dropdown' name='a_faction'>".$fdata."</select></td></tr>
<tr><td title='The number of units for each unit type.'>army</td><td><input class='textbox' name='a_army' type='text' size='45' value='".implode("-", $data[1][1])."'></td></tr>
<tr><td title='[<general presence>-<level>-<unit type>-<formation>]'>general</td><td><input class='textbox' name='a_gen' type='text' size='45' value='".implode("-", $data[1][2])."'></td></tr>
<tr><td title='Unit HP upgrades, by unit type.'>unit upgrades</td><td><input class='textbox' name='a_unit_u' type='text' size='45' value='".$town[17]."'></td></tr>
<tr><td title='Unit ATK upgrades, by unit type.'>weapon upgrades</td><td><input class='textbox' name='a_weapon_u' type='text' size='45' value='".$town[18]."'></td></tr>
<tr><td title='Unit DEF upgrades, by unit type.'>armor upgrades</td><td><input class='textbox' name='a_armor_u' type='text' size='45' value='".$town[19]."'></td></tr>
<tr><td title='Stolen resources.'>Looted resources</td><td><input class='textbox' type='text' readonly='true' size='45' value='".implode("-", $data[3])."'></td></tr>
<tr><td title='Stolen weapons.'>Looted weapons</td><td><input class='textbox' type='text' readonly='true' size='45' value='".implode("-", $data[4])."'></td></tr>
</table>
<select class='dropdown' name='type'>
<option value='1'>raid</option>
<option value='2'>attack</option>
</select>
<input class='button' type='submit' name='button0' value='Simulate combat'>
</form>";
}
?>
          </p>
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
