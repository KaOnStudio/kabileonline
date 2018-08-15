<?php include "antet.php"; include "func.php";

$factions=factions();
$_SESSION["code"]=rand(1000, 9999);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - install</title>
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
		<form name="form1" method="post" action="install_.php">
		  <label>Desired username
		  <input class='textbox' type="text" name="name">
		  </label>
                <p>
                  <label>Desired password
                  <input class='textbox' type="password" name="pass">
                  </label>
          </p>
                <p>
                  <label>Retype password
                  <input class='textbox' type="password" name="pass_">
                  </label>
                </p>
                <p>
                  <label>Valid email address
                  <input class='textbox' type="text" name="email">
                  </label>
                </p>
                <p>
                  <label>Faction
                  <select class='dropdown' name="faction">
				  <?php for ($i=0; $i<count($factions); $i++) echo "<option value='".$i."'>".$factions[$i][1]."</option>"; ?>
				  </select>
                  </label>
                </p>
                <p>
                  <label>type code '<?php echo $_SESSION["code"];?>'
                  <input class='textbox' type="text" name="code">
                  </label>
                </p>
                <p>
                  <label>
                  <input class='button' type="submit" name="reg" value="Submit">
                  </label>
                </p>
		</form>		</td>
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