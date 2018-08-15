<?php
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
		$prod=explode("-", $town[9]);
		$prod[4] = floor($prod[4] / 2.453);
	}
	else {
		git('index.php'); die();
	}	
?>
<br /><hr /><br /><table style='text-align:center; margin-left:20px;'><tr><td>
<p><?php echo $lang['taxesDesc'] ?></p><br />
<form name="form1" method="post" action="taxes.php?town=<?php echo $_GET["town"]; ?>">
	<select name="taxes" >
		<option value="<?php echo $prod[4]; ?>"><?php echo $prod[4]; ?></option>
		<?php
			for($i=0;$i<101;$i++)
				if($i != $prod[4])
					echo "<option value='".$i."'>".$i."</option>";
		?>
	</select>
	<input type="submit" value="<?php echo $lang['setTaxes'] ?>" style="width:100px; height:30px;">
</form>
</td></tr></table><br /><hr /></br>