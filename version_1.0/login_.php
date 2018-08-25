<?php include "antet.php"; include "func.php";
if (isset($_POST["name"], $_POST["pass"]))
{
	$_POST["name"]=clean($_POST["name"]); 
	$_POST["pass"]=clean($_POST["pass"]);
	$_SESSION["user"]=login($_POST["name"], md5($_POST["pass"]));
	$config=config();
	if ((!$config[2][1])&&($_SESSION["user"][4]<4))
	{
		$_SESSION = array();
		session_destroy();
		msg($lang['loginClosed']);
	}
	else if ($_SESSION["user"][0])
	{
		if (check_d($_SESSION["user"][0]))
		{
			$row=update_lastVisit($_SESSION["user"][0]);
			msg($lang['welcome'].", ".$_SESSION["user"][1].".</br>".$lang['youHave']." ".$row[0]." ".$lang['newRep']." ".$row[1]." ".$lang['newMsg'].".");
		}
		else 
			header('Location: logout.php');
	}
	else 
		msg($lang['noUserWrong']);
}
else 
	msg($lang['noInput']);
?>