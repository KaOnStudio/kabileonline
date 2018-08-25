<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["forum"]))
{
 $_GET["forum"]=clean($_GET["forum"]);
 if (isset($_GET["town"])) $town=town(clean($_GET["town"])); else if (isset($_SESSION["town"])) $town=town($_SESSION["town"]); else {header('Location: login.php'); die();}
 if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 if ($_SESSION["user"][11])
 {
  $alliance=alliance_all($_SESSION["user"][11]);
  $forums=forum(0, 0, $_SESSION["user"][11], $_GET["forum"], 0, 0);
  $threads=thread(0, 0, $_GET["forum"], 0, 0, 0, 0);
 }
 if ((isset($alliance))&&(!$alliance[0][0])) {a_quit($_SESSION["user"][0]); $_SESSION["user"][11]=0;}
 $data=explode("-", $town[8]);
}
else {header('Location: login.php'); die();}

       if ($data[9])
	if (!$_SESSION["user"][11]) echo $lang['joinAllianceFirst'];
	else if ($alliance[0][2]==$_SESSION["user"][0])//if you are the owner of the alliance
	{
	 echo "<a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=".$forums[1]."', '', '')\">".$lang['up']."</a></br></br><table class='q_table'><tr><td class='td_forum'>".$lang['forum']."</td><td class='td_forum'>".$lang['threads']."</td></tr>";
	 for ($i=0; $i<count($forums[0]); $i++) echo "<tr><td class='td_forum'><a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=".$forums[0][$i][0]."', '', '')\">".$forums[0][$i][3]."</a></br>".$forums[0][$i][4]."</td><td class='td_forum'>".$forums[0][$i][5]."</td></tr>";
         echo "</table>";
	 echo "<table class='q_table'><tr><td class='td_forum'>thread</td><td class='td_forum'>".$lang['author']."</td><td class='td_forum'>".$lang['posts']."</td><td class='td_forum'>".$lang['date']."</td></tr>";
	 for ($i=0; $i<count($threads); $i++)
	 {
	  $author=user($threads[$i][2]);
	  echo "<tr><td class='td_forum'><a class='q_link' href=\"javascript: template('posts.php?town=".$town[0]."&thread=".$threads[$i][0]."&page=0', '', '')\">".$threads[$i][4]."</a></br>".$threads[$i][5]."</td><td class='td_forum'><a class='q_link' href=\"javascript: template('profile_view.php?id=".$author[0]."', '', '')\">".$author[1]."</a></td><td class='td_forum'>".$threads[$i][7]."</td><td class='td_forum'>".$threads[$i][3]."</td></tr>";
	 }
         echo "</table>";
	 
	 echo "<table class='q_table'><tr><td class='td_forum'>";
	 echo $lang['forum']." ".$lang['action']." <select id='f_a' onChange=\"if (document.getElementById('f_a').value>2) document.getElementById('f_data').style.visibility='hidden'; else document.getElementById('f_data').style.visibility='visible'; if (document.getElementById('f_a').value>1) document.getElementById('f_forum').style.visibility='visible'; else document.getElementById('f_forum').style.visibility='hidden';\"><option value='1'>".$lang['add']."</option><option value='2'>".$lang['edit']."</option><option value='3'>".$lang['delete']."</option></select> <span style='visibility:hidden' id='f_forum'>".$lang['forum']." <select id='f_id'><option value='0'>".$lang['root']."</option>";
	 for ($i=0; $i<count($forums[0]); $i++) echo "<option value='".$forums[0][$i][0]."'>".$forums[0][$i][3]."</option>";
	 echo "</select></span> <span id='f_data'>parent <select id='f_parent'><option value='0'>".$lang['root']."</option>";
	 for ($i=0; $i<count($forums[0]); $i++) echo "<option value='".$forums[0][$i][0]."'>".$forums[0][$i][3]."</option>";
	 echo "</select> ".$lang['name']." <input type='text' id='f_name'> ".$lang['description']." <input type='text' id='f_desc'></span></br></br>";
         echo "<input type='button' onClick='act_forum(".$town[0].")' value='".$lang['go']."'></td></tr></table>";
	 
	 echo "<table class='q_table'><tr><td class='td_forum'>";
	 echo $lang['thread']." ".$lang['action']." <select id='t_a' onChange=\"if (document.getElementById('t_a').value>2) document.getElementById('t_data').style.visibility='hidden'; else {document.getElementById('t_thread').style.visibility='hidden'; document.getElementById('t_data').style.visibility='visible';} if (document.getElementById('t_a').value>1) document.getElementById('t_thread').style.visibility='visible';\"><option value='1'>".$lang['add']."</option><option value='2'>".$lang['edit']."</option><option value='3'>".$lang['delete']."</option></select> <span id='t_thread' style='visibility: hidden'>".$lang['thread']." <select id='t_id'>";
	 for ($i=0; $i<count($threads); $i++) echo "<option value='".$threads[$i][0]."'>".$threads[$i][4]."</option>";
	 echo "</select></span> <span id='t_data'></br>".$lang['name']." <input type='text' id='t_name'> ".$lang['description']." <input type='text' id='t_desc'> ".$lang['content']." <textarea rows='5' cols='50' id='t_content'></textarea></span></br></br>";
         echo "<input type='button' onClick='act_thread(".$town[0].", ".$_GET["forum"].")' value='".$lang['go']."'></td></tr></table>";
	}
	else if ($_SESSION["user"][11]==$alliance[0][0])//if you are just a member
	{
	 echo "<a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=".$forums[1]."', '', '')\">".$lang['up']."</a></br></br><table class='q_table'><tr><td class='td_forum'>".$lang['forum']."</td><td class='td_forum'>".$lang['threads']."</td></tr>";
	 for ($i=0; $i<count($forums[0]); $i++) echo "<tr><td class='td_forum'><a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=".$forums[0][$i][0]."', '', '')\">".$forums[0][$i][3]."</a></br>".$forums[0][$i][4]."</td><td class='td_forum'>".$forums[0][$i][5]."</td></tr>";
         echo "</table>";
	 echo "<table class='q_table'><tr><td class='td_forum'>".$lang['thread']."</td><td class='td_forum'>".$lang['author']."</td><td class='td_forum'>".$lang['posts']."</td><td class='td_forum'>".$lang['date']."</td></tr>";
	 for ($i=0; $i<count($threads); $i++)
	 {
	  $author=user($threads[$i][2]);
	  echo "<tr><td class='td_forum'><a class='q_link' href=\"javascript: template('posts.php?town=".$town[0]."&thread=".$threads[$i][0]."&page=0', '', '')\">".$threads[$i][4]."</a></br>".$threads[$i][5]."</td><td class='td_forum'><a class='q_link' href=\"javascript: template('profile_view.php?id=".$author[0]."', '', '')\">".$author[1]."</a></td><td class='td_forum'>".$threads[$i][7]."</td><td class='td_forum'>".$threads[$i][3]."</td></tr>";
	 }
         echo "</table>";
	 echo "<table class='q_table'><tr><td class='td_forum'>";
	 echo $lang['thread']." ".$lang['action']." <select id='t_a' onChange=\"if (document.getElementById('t_a').value>2) document.getElementById('t_data').style.visibility='hidden'; else {document.getElementById('t_thread').style.visibility='hidden'; document.getElementById('t_data').style.visibility='visible';} if (document.getElementById('t_a').value>1) document.getElementById('t_thread').style.visibility='visible';\"><option value='1'>".$lang['add']."</option><option value='2'>".$lang['edit']."</option><option value='3'>".$lang['delete']."</option></select> <span id='t_thread' style='visibility: hidden'>".$lang['thread']." <select id='t_id'>";
	 for ($i=0; $i<count($threads); $i++) echo "<option value='".$threads[$i][0]."'>".$threads[$i][4]."</option>";
	 echo "</select></span> <span id='t_data'></br>".$lang['name']." <input type='text' id='t_name'> ".$lang['description']." <input type='text' id='t_desc'> ".$lang['content']." <textarea rows='5' cols='50' id='t_content'></textarea></span></br></br>";
         echo "<input type='button' onClick='act_thread(".$town[0].", ".$_GET["forum"].")' value='".$lang['go']."'></td></tr></table>";
	}
        else echo $lang['notMember'];
       else echo $lang['constrBuilding'];
?>
