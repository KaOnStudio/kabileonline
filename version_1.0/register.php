<?php 
include "antet.php"; 
include "func.php";
$config = config();
if (!$config[3][1]) msg($lang['regClosed']);
$factions = factions();
$_SESSION["code"] = rand(1000, 9999);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<head>
<title><?php echo $title; ?> - <?php echo $lang['register'] ?></title>
</head>

<body class="q_body">
<div style="text-align:center;">
<?php echo $top_ad; ?>

<table class="q_table">
	<tr>
		<td class="td_logo">
			<?php logo($title); ?>
		</td>
	</tr>
	<tr>
		<td class="td_top_menu">
			<?php menu_up(); ?>
		</td>
	</tr>
	<tr>
		<td class="td_content">
            <form name="form1" method="post" action="register_.php">
            <table>
                <tr>
                    <td><label><?php echo $lang['username'] ?></label></td>
                    <td><input class='textbox' type="text" name="name"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td> <label><?php echo $lang['password'] ?></label></td>
                     <td> <input class='textbox' type="password" name="pass"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr> 
                <tr>
                    <td>  <label><?php echo $lang['retypePass'] ?></label></td>
                    <td> <input class='textbox' type="password" name="pass_"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr> 
                <tr>
                    <td>  <label><?php echo $lang['validEmail'] ?></label></td>
                    <td> <input class='textbox' type="text" name="email"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td> <label><?php echo $lang['faction'] ?></label></td>
                    <td><select class='dropdown' name="faction">
                            <?php for ($i=0; $i<count($factions); $i++) echo "<option value='".$i."'>".$factions[$i][1]."</option>"; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>  <label><?php echo $lang['typeCode'] ?> '<?php echo $_SESSION["code"];?>'</label></td>
                    <td> <input class='textbox' type="text" name="code"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr> 
                <tr>
                    <td>  <label>&nbsp;</label></td>
                    <td> <input class='button' type="submit" name="reg" value="<?php echo $lang['submit'] ?>"></td>
                </tr>
            </table>
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

<p><?php about(); ?></p>
</div>
</body>
</html>