<?php include "antet.php"; include "func.php";

if (isset($_SESSION["user"][0], $_GET["town"], $_GET["thread"], $_GET["page"]))
{
 $_GET["town"]=clean($_GET["town"]); $_GET["thread"]=clean($_GET["thread"]); $_GET["page"]=clean($_GET["page"]);
 $town=town($_GET["town"]); if ($town[1]!=$_SESSION["user"][0]) {header('Location: login.php'); die();}
 if ($_SESSION["user"][11])
 {
  $alliance=alliance_all($_SESSION["user"][11]);
  $thread=thread(0, $_GET["thread"], 0, 0, 0, 0, 0); $t_author=user($thread[2]);
  $posts=post(0, 0, $thread[0], 0, 0, 0);
 }
 if ((isset($alliance))&&(!$alliance[0][0])) {a_quit($_SESSION["user"][0]); $_SESSION["user"][11]=0;}
 $data=explode("-", $town[8]);
}
else {header('Location: login.php'); die();}

       if ($data[9])
	if (!$_SESSION["user"][11]) echo $lang['joinAllianceFirst'];
	else if ($_SESSION["user"][11]==$alliance[0][0])//if you are a member of the alliance
	{
	 echo "<a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=".$thread[1]."', '', '')\">".$lang['up']."</a></br></br><table class='q_table'><tr><td class='td_forum'>".$thread[4]." ".$lang['from']." ".$thread[3]." ".$lang['by']." <a class='q_link' href=\"javascript: template('profile_view.php?id=".$t_author[0]."', '', '')\">".$t_author[1]."</a></br>".$thread[5]."</td></tr>";
         echo "<tr><td class='td_forum'>".str_replace("\n", "</br>", $thread[6])."</td></tr>";
         echo "</table>";
	 echo "<table class='q_table'><tr><td class='td_forum'>#</td><td class='td_forum'>".$lang['reply']."</td><td class='td_forum'>".$lang['author']."</td><td class='td_forum'>".$lang['date']."</td></tr>";
         for ($i=$_GET["page"]*10; $i<$_GET["page"]*10+10; $i++)
	  if (isset($posts[$i][0]))
	  {
	   $author=user($posts[$i][2]);
	   echo "<tr><td class='td_forum'>".$i."</td><td class='td_forum'>".$posts[$i][4]."</td><td class='td_forum'><a class='q_link' href=\"javascript: template('profile_view.php?id=".$posts[$i][2]."', '', '')\">".$author[1]."</a></td><td class='td_forum'>".$posts[$i][3]."</td></tr><tr><td colspan='4' class='td_forum'>".str_replace("\n", "</br>", $posts[$i][5])."</td></tr>";
	  }
         echo "</table>";
	 for ($i=$_GET["page"]-5; $i<=$_GET["page"]-1; $i++) if ($i>=0) echo "<a class='q_link' href=\"javascript: template('posts.php?town=".$town[0]."&thread=".$thread[0]."&page=".$i."', '')\">".$i."</a> | ";
         echo $_GET["page"]." | ";
	 for ($i=$_GET["page"]+1; $i<$_GET["page"]+5; $i++) if ($i<ceil(count($posts)/10)) echo "<a class='q_link' href=\"javascript: template('posts.php?town=".$town[0]."&thread=".$thread[0]."&page=".$i."', '')\">".$i."</a> | ";
	 
	 echo "<table class='q_table'><tr><td class='td_forum'>";
	 echo $lang['post']." ".$lang['action']." <select id='p_a' onChange=\"if (document.getElementById('p_a').value>2) {document.getElementById('p_post').style.visibility='visible'; document.getElementById('p_data').style.visibility='hidden';} else {document.getElementById('p_post').style.visibility='hidden'; document.getElementById('p_data').style.visibility='visible';} if (document.getElementById('p_a').value>1) document.getElementById('p_post').style.visibility='visible';\"><option value='1'>".$lang['add']."</option><option value='2'>".$lang['edit']."</option><option value='3'>".$lang['delete']."</option></select> <span id='p_post' style='visibility: hidden'>".$lang['reply']." <select id='p_id'>";
	 for ($i=$_GET["page"]*10; $i<$_GET["page"]*10+10; $i++) if (isset($posts[$i][0])) echo "<option value='".$posts[$i][0]."'>".$i."</option>";
	 echo "</select></span> <span id='p_data'></br>".$lang['description']." <input type='text' id='p_desc'> ".$lang['content']." <textarea rows='5' cols='50' id='p_content'></textarea></span></br></br>";
         echo "<input type='button' onClick='act_post(".$town[0].", ".$_GET["thread"].")' value='".$lang['go']."'></td></tr></table>";
	}
        else echo $lang['notMember'];
       else echo $lang['constrBuilding'];
?>
