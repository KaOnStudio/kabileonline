<?php
	include "include/ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"]=clean($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('index.php'); die();
		}
	}
	else {
		git('index.php'); die();
	}	
?>
<br /><hr /><br /><table style='text-align:center; margin-left:150px;'><tr><td>
<form name="form1" method="post" action="town_edit_.php?town=<?php echo $_GET["town"]; ?>">
  <p><?php echo $lang['townName'] ?><br />
	<input  type="text" name="name" value="<?php echo $town[2]; ?>">
  </p><br />
  <p><?php echo $lang['description'] ?><br />
	<textarea  name="desc" cols="45" rows="5"><?php echo $town[14]; ?></textarea>
  </p>
  <p><br />
	<input type="submit" name="button" value="<?php echo $lang['save'] ?>" style="width:100px; height:30px;">
  </p>
</form>
</td></tr></table><br /><hr /></br>