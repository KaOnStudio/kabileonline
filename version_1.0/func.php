<?php
/* database'e baglaniyorm */
$db_id = mysql_connect($db_host, $db_user, $db_pass) or die("databaseye baglanamiyor.");
mysql_select_db($db_name, $db_id) or die("Database bulunamadi.");
 

 
/* time difference; gets for how much the mysql server time is ahead, compared to the http server time; */
$query = "SELECT timediff(now(), '".date("Y-m-d H:i:s")."')";
$result = mysql_query($query, $db_id);
$tdif = mysql_fetch_row($result); 
$tdif = explode(":", $tdif[0]);
if ($tdif[0][0] == "-") 
{
	$tdif[0] = abs($tdif[0]); 
	$tdif[3] = "-";
}
else 
	$tdif[3] = "+"; 
$tdif = " ".$tdif[3]." interval ".$tdif[0]." hour ".$tdif[3]." interval ".$tdif[1]." minute ".$tdif[3]." interval ".$tdif[2]." second";

/* oyuncu login ise oyuncunun kabilesinin grafik paketi */
if (isset($_SESSION["user"][0])) 
{
	$faction=faction($_SESSION["user"][10]); 
	$imgs=$_SESSION["user"][13]; $fimgs=$faction[2];
}
/* oyuncu login degilse normal grafik paketi */
else 
{
	$imgs="templates/"; 
	$fimgs="1/";
}

function msg($msg)
{//header("Location:msg.php?msg=".$msg);
	?>
	<script type="text/JavaScript" lang="JavaScript">
		window.location = "msg.php?msg=<?php echo $msg; ?>";
	</script>
<?php
}

function label($msg)
{
 	echo "<font face=\"Fixedsys\" color=\"red\">".$msg."</font>";
}
 
function clean($str)
{
 	$cleaned = stripslashes($str);
 	$cleaned = strip_tags($cleaned);
 	$cleaned = htmlspecialchars($cleaned);
 	$cleaned = mysql_real_escape_string($cleaned);
 	return $cleaned;
}

function gen_stats($dur)
{
 	global $db_id;

 	$query="SELECT count(*) FROM users";
 	$result=mysql_query($query, $db_id);
 	$row[0]=mysql_fetch_row($result);
 	$query="SELECT count(*) FROM users where hour(timediff(now(), lastVisit))<".$dur;
 	$result=mysql_query($query, $db_id);
 	$row[1]=mysql_fetch_row($result);
 
 	return $row;
}

function clean_u($dur)
{
 	global $db_id;

 	$query = "SELECT id FROM users where hour(timediff(now(), lastVisit))/24>".$dur;
 	$result = mysql_query($query, $db_id); $nr=0;
 	for (; $row=mysql_fetch_row($result); $nr++) 
		del_u($row[0]);
 
 	return $nr;
}

function town_stats($col)
{
 	global $db_id;

 	$query="SELECT * from towns order by ".$col." desc";
 	$result=mysql_query($query, $db_id); $town_stats=array();
 	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$town_stats[$i]=$row;
 
 	return $town_stats;
}

function user_stats($col)
{
 	global $db_id;

 	$query="select id, name, (select sum(".$col.") from towns where owner=users.id) from users order by (select sum(".$col.") from towns where owner=users.id) desc";
 	$result=mysql_query($query, $db_id); $user_stats=array();
 	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$user_stats[$i]=$row;
 
 	return $user_stats;
}

function alliance_stats($col)
{
 	global $db_id;

 	$query="select id, name, (select sum(".$col.") from towns where owner in (select id from users where alliance=alliances.id)) from alliances order by (select sum(".$col.") from towns where owner in (select id from users where alliance=alliances.id)) desc";
 	$result=mysql_query($query, $db_id); $alliance_stats=array();
 	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$alliance_stats[$i]=$row;
 
 	return $alliance_stats;
}

function is_user($name, $email, $ip)
{
 	global $db_id;

	$query="select count(*) from users where name='".$name."' or email='".$email."' or ip='".$ip."'";
 	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	
 	return $row[0];
}

function login($name, $pass)
{
 	global $db_id;

 	$query="select * from users where name='".$name."' and pass='".$pass."' and level>0";
 	$result=mysql_query($query, $db_id);
 	$row=mysql_fetch_row($result);
	
 	return $row;
}

function sitted($account, $sitter)
{
	global $db_id;

 	$query="select * from users where name='".$account."' and sitter='".$sitter."' and level>0";
	$result=mysql_query($query, $db_id);
 	$row=mysql_fetch_row($result);
	
 	return $row;
}

function user($id)
{
	global $db_id;

	$query="select * from users where id=".preg_replace("/[^0-9]/","", $id);
	$result=mysql_query($query, $db_id);
	if ($result)
	{
		$row=mysql_fetch_row($result);
		$row[1]=stripslashes($row[1]); 
		$row[9]=stripslashes($row[9]);
		return $row;
	} 
	else 
		return 0;
}

function users()
{
	global $db_id;

	$query="select * from users";
	$result=mysql_query($query, $db_id); 
	$users=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$users[$i]=$row;
		$users[$i][1]=stripslashes($users[$i][9]); 
		$users[$i][9]=stripslashes($users[$i][9]);
	}
	
	return $users;
}

function user_($name)
{
	global $db_id;

	$query="select * from users where name='".$name."'";
	$result=mysql_query($query, $db_id);
	if ($result)
	{
		$row=mysql_fetch_row($result);
		$row[1]=stripslashes($row[1]); 
		$row[9]=stripslashes($row[9]);
		return $row;
	} 
	else 
		return 0;
}

function config()
{
	global $db_id;

	$config=array();
	$query="select * from config order by ord asc";
	$result=mysql_query($query, $db_id);
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$config[$i]=$row;
		
	return $config;
}

function config_($var, $val)
{
	global $db_id;

	$query="update config set value='".$val."' where name='".$var."'";
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function g_points($names, $q)
{
	global $db_id;

	$query="update users set points=points+".$q." where name in (".$names.")";
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function alliance_all($id)
{
	global $db_id;
	
	$query="select * from alliances where id=".$id;
	$result=mysql_query($query, $db_id); $alliance=array();
	$alliance[0]=mysql_fetch_row($result);
	if (!$alliance[0][0]) 
	{ 
		return 0;
	}
	$query="select * from users where alliance=".$alliance[0][0];
	$result=mysql_query($query, $db_id);
	for ($i=0; $alliance[1][$i]=mysql_fetch_row($result); $i++) ;
	
	$query="select * from pacts where type=0 and (a1=".$alliance[0][0]." or a2=".$alliance[0][0].")";
	$result=mysql_query($query, $db_id);
	for ($i=0; $alliance[2][$i]=mysql_fetch_row($result); $i++) ;
	
	$query="select * from pacts where type=1 and (a1=".$alliance[0][0]." or a2=".$alliance[0][0].")";
	$result=mysql_query($query, $db_id);
	for ($i=0; $alliance[3][$i]=mysql_fetch_row($result); $i++) ;

	return $alliance;
}

function alliance_($name)
{
	global $db_id;

	$query="select * from alliances where name='".$name."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	return $row;
}

function alliance($id)
{
	global $db_id;
	
	$query="select * from alliances where id='".$id."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	return $row;
}

function forum_pruning()
{
	global $db_id;

	$query="select id from forums where parent not in (select id from forums) and parent!=0";
	$result=mysql_query($query, $db_id); $nr=0;
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
	{
		forum(3, $row[$i][0], 0, 0, 0, 0); 
		$nr++;
	}
	return $nr;
}

function forum($a, $id, $alliance, $parent, $name, $desc)
{
	global $db_id;
	
	switch($a)
	{
		case '0'://read
			$forums=array();
			$query="select * from forums where alliance=".$alliance." and parent=".$parent." order by name";
			$result=mysql_query($query, $db_id);
			for ($i=0; $row=mysql_fetch_row($result); $i++)
			{
				$forums[0][$i]=$row;
				$query="select count(*) from threads where forum=".$forums[0][$i][0];
				$row=mysql_fetch_row(mysql_query($query, $db_id));
				$forums[0][$i][5]=$row[0];
			}
			$query="select parent from forums where id=".$parent;
			$result=mysql_query($query, $db_id); $row=mysql_fetch_row($result);
			if ($row[0]) 
				$forums[1]=$row[0]; 
			else 
				$forums[1]=0;
				
			return $forums;
			break;
		case '1'://add
			if ($name)
			{
				$query="insert into forums (alliance, parent, name, description) values (".$alliance.", ".$parent.", '".$name."', '".$desc."')";
				$result=mysql_query($query, $db_id);
				if ($result) 
					return 1; 
				else 
					return 0;
			} 
			else 
				return 0;
			break;
		case '2'://edit
			$query="update forums set parent=".$parent.", name='".$name."', description='".$desc."' where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
		case '3'://delete
			$query="delete from posts where thread in (select id from threads where forum=".$id.")";
			$result=mysql_query($query, $db_id);
			$query="delete from threads where forum=".$id;
			$result=mysql_query($query, $db_id);
			$query="delete from forums where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
	}
}

function thread($a, $id, $forum, $author, $name, $desc, $content)
{
	global $db_id;
	
	switch($a)
	{
		case '0'://read
			if (!$id)
			{
				$threads=array();
				$query="select * from threads where forum=".$forum." order by date";
				$result=mysql_query($query, $db_id);
				for ($i=0; $row=mysql_fetch_row($result); $i++)
				{
					$threads[$i]=$row;
					$query="select count(*) from posts where thread=".$threads[$i][0];
					$row=mysql_fetch_row(mysql_query($query, $db_id));
					$threads[$i][7]=$row[0];
				}
				return $threads;
			}
			else
			{
				$query="select * from threads where id=".$id;
				$thread=mysql_fetch_row(mysql_query($query, $db_id));
				return $thread;
			}
			break;
		case '1'://add
			if ($name)
			{
				$query="insert into threads (forum, author, date, name, description, content) values (".$forum.", ".$author.", now(), '".$name."', '".$desc."', '".$content."')";
				$result=mysql_query($query, $db_id);
				if ($result) 
					return 1; 
				else 
					return 0;
			} 
			else 
				return 0;
			break;
		case '2'://edit
			$query="update threads set forum=".$forum.", name='".$name."', description='".$desc."', content='".$content."', date=now() where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
		case '3'://delete
			$query="delete from posts where thread=".$id;
			$result=mysql_query($query, $db_id);
			$query="delete from threads where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
	}
}

function post($a, $id, $thread, $author, $desc, $content)
{
	global $db_id;
	
	switch($a)
	{
		case '0'://read
			if (!$id)
			{
				$posts=array();
				$query="select * from posts where thread=".$thread." order by date";
				$result=mysql_query($query, $db_id);
				for ($i=0; $row=mysql_fetch_row($result); $i++) 
					$posts[$i]=$row;
				return $posts;
			}
			else
			{
				$query="select * from posts where id=".$id;
				$post=mysql_fetch_row(mysql_query($query, $db_id));
				return $post;
			}
			break;
		case '1'://add
			if ($content)
			{
				$query="insert into posts (thread, author, date, description, content) values (".$thread.", ".$author.", now(), '".$desc."', '".$content."')";
				$result=mysql_query($query, $db_id);
				if ($result) 
					return 1; 
				else 
					return 0;
			} 
			else 
				return 0;
			break;
		case '2'://edit
			$query="update posts set description='".$desc."', content='".$content."', date=now() where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
		case '3'://delete
			$query="delete from posts where id=".$id;
			$result=mysql_query($query, $db_id);
			if ($result) 
				return 1; 
			else 
				return 0;
			break;
	}
}

function faction($id)
{
	global $db_id;
	
	$query = "select * from factions where id = ".$id;
	$result = mysql_query($query, $db_id);
	$row = mysql_fetch_row($result);
	
	return $row;
}

function factions()
{
	global $db_id;
	
	$factions=array();
	$query="select * from factions";
	$result=mysql_query($query, $db_id);
	
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$factions[$i]=$row;
		
	return $factions;
}

function town($id)
{
	global $db_id;
	
	$query="select * from towns where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result)
	{
		$row=mysql_fetch_row($result);
		$row[2]=stripslashes($row[2]); 
		$row[14]=stripslashes($row[14]);
		return $row;
	} 
	else 
		return 0;
}

function town_($name)
{
	global $db_id;
	
	$query="select * from towns where name='".$name."'";
	$result=mysql_query($query, $db_id);
	
	if ($result)
	{
		$row=mysql_fetch_row($result);
		$row[2]=stripslashes($row[2]); 
		$row[14]=stripslashes($row[14]);
		return $row;
	} 
	else 
		return 0;
}

function town_xy($id)
{
	global $db_id;
	
	$query="select * from map where type=3 and subtype=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	
	return $row;
}

function towns($id)
{
	global $db_id;
	
	$query="select * from towns where owner=".$id." order by isCapital desc";
	$result=mysql_query($query, $db_id);
	$towns=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
	{
		$towns[$i]=$row; 
		$towns[$i][2]=stripslashes($row[2]); 
		$towns[$i][14]=stripslashes($row[14]);
	}
	return $towns;
}

function buildings($faction)
{
	global $db_id, $lang;
	
	$query = "select * from buildings where faction = ".$faction;
	$result = mysql_query($query, $db_id); 
	$buildings = array();
	
	for ($i=0; $row = mysql_fetch_row($result); $i++)
	{
		$buildings[$i] = $row;
		if (isset($lang['buildings']))
		{
			$buildings[$i][2]=$lang['buildings'][$faction-1][$i][0];
			$buildings[$i][8]=$lang['buildings'][$faction-1][$i][1];
		}
	}
	return $buildings;
}

function weapons($faction)
{
	global $db_id, $lang;
	
	$query="select * from weapons where faction=".$faction;
	$result=mysql_query($query, $db_id); $weapons=array();
	
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$weapons[$i]=$row;
		if (isset($lang['weapons']))
		{
			$weapons[$i][2]=$lang['weapons'][$faction-1][$i][0];
			$weapons[$i][5]=$lang['weapons'][$faction-1][$i][1];
		}
	}
	return $weapons;
}

function units($faction)
{
	global $db_id, $lang;
	
	$query="select * from units where faction=".$faction;
	$result=mysql_query($query, $db_id); $units=array();
	
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$units[$i]=$row;
		if (isset($lang['units']))
		{
			$units[$i][2]=$lang['units'][$faction-1][$i][0];
			$units[$i][10]=$lang['units'][$faction-1][$i][1];
		}
	}
	return $units;
}

function get_land()
{
	global $db_id;
	
	$query="select x, y from map where type=1";
	$result=mysql_query($query, $db_id);
	
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$land[$i]=$row;
		
	return $land;
}

function map($x, $y)
{
	global $db_id;
	
	$query="select * from map where (y between ".($y-3)." and ".($y+3).")  and (x between ".($x-3)." and ".($x+3).") order by y desc, x asc";
	$result=mysql_query($query, $db_id);
	$data=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$data[$i]=$row;
		
	return $data;
}

function sector($x, $y)
{
	global $db_id;
	
	$query="select * from map where x=".$x." and y=".$y;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	
	return $row;
}

function map_img($data, $x, $y, &$i, $imgs)
{
	echo "src='".$imgs."map/env_";
	if (isset($data[$i][0]))
	{
		if (($data[$i][0]==$x)&&($data[$i][1]==$y))
		{
			if ($data[$i][2]==3)
			{
				$town=town($data[$i][3]);
				if ($town[3]<=100) echo "31";
				else if (($town[3]>100)&&($town[3]<=200)) echo "32";
				else if (($town[3]>200)&&($town[3]<=300)) echo "33";
				else if ($town[3]>300) echo "34";
			}
			else if (!$data[$i][2]) 
				echo "0".rand(1, 4);
			else 
				echo $data[$i][2].$data[$i][3];
			if ($i<count($data)-1) 
				$i++;
		}
		else 
			echo "x";
			
		echo ".gif'";
	}
	else 
		echo "x.gif'";
}

function map_lnk($data, $x, $y, &$i)
{
	if (isset($data[$i][0]))
	{
		 if (($data[$i][0]==$x)&&($data[$i][1]==$y))
		 {
			  if ($data[$i][2]==3)
			  {
				   $town=town($data[$i][3]);
				   if ($town[1])
				   {
						$usr=user($town[1]); $alliance=alliance($usr[11]);
							if (isset($_SESSION["user"][0])) $towns=towns($_SESSION["user"][0]); else $towns[0][0]=0;
						echo "href=\"javascript: xmenu(".$usr[0].", ".$town[0].", ".$towns[0][0].")\" onMouseOver=\"desc('".$town[2]."', '".$usr[1]."', '".$town[3]."', '".$alliance[1]."')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
				   }
				   else 
				    	echo "href='aquire.php?id=".$town[0]."' onMouseOver=\"desc('".$town[2]."', '[terkedilmis]', '".$town[3]."', '')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
			  }
			  else if (!$data[$i][2]) 
			  		echo "href=\"javascript: template('map_.php', 'x=".$x."&y=".$y."')\" onMouseOver=\"desc('Deniz', '-', '-', '-')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
			  else if ($data[$i][2]==2) 
			  		echo "href=\"javascript: template('map_.php', 'x=".$x."&y=".$y."')\" onMouseOver=\"desc('Dag', '-', '-', '-')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
			  else if ($data[$i][2]==1) 
			  		echo "href=\"javascript: template('map_.php', 'x=".$x."&y=".$y."')\" onMouseOver=\"desc('Kara', '-', '-', '-')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
			  if ($i<count($data)-1) 
			  		$i++;
		 }
		 else 
		 	echo "href=\"javascript: template('map_.php', 'x=".$x."&y=".$y."')\" onMouseOver=\"desc('bos', '-', '-', '-')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
	}
	else 
		echo "href=\"javascript: template('map_.php', 'x=".$x."&y=".$y."')\" onMouseOver=\"desc('bos', '-', '-', '-')\" onMouseOut=\"desc('A�iklama', '', '', '')\"";
}

function update_lastVisit($id)
{
	global $db_id;
	
	$query="select count(*) from reports where recipient=".$id." and timediff((select lastVisit from users where id=".$id."), sent)<'00:00:01'";
	$result=mysql_query($query, $db_id);
	$row[0]=mysql_fetch_row($result); 
	$row[0]=$row[0][0];
	$query="select count(*) from messages where recipient=".$id." and timediff((select lastVisit from users where id=".$id."), sent)<'00:00:01'";
	$result=mysql_query($query, $db_id);
	$row[1]=mysql_fetch_row($result); 
	$row[1]=$row[1][0];
	$query="update users set lastVisit=now(), ip='".$_SERVER["REMOTE_ADDR"]."' where id=".$id;
	mysql_query($query, $db_id);
	
	return $row;
}

function update_taxes($production, $morale, $id)
{
	global $db_id;
	
	$query="update towns set production='".$production."', morale=".$morale." where id=".$id;
	mysql_query($query, $db_id);
}

function update_formation($id, $gen)
{
	global $db_id;
	
	$town=town($id);
	$query="update towns set general='".$gen."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		header("Location: gen.php?town=".$id);
	else 
		msg("Hata!.".mysql_error());
}

function update_town($name, $desc, $id)
{
	global $db_id;
	
	$query="select count(*) from towns where name='".$name."' and id!=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if (!$row[0])
	{
		$query="update towns set name='".$name."', description='".$desc."' where id=".$id;
		mysql_query($query, $db_id);
	} 
	else 
		msg("Isim alindi!.");
}

function purge($id)
{
	global $db_id;
	
	$query="update map set type=1, subtype=3 where type=3 and subtype=".$id;
	mysql_query($query, $db_id);
	$query="delete from a_queue where a_queue.town=".$id." or a_queue.target=".$id;
	mysql_query($query, $db_id);
	$query="delete from c_queue where c_queue.town=".$id;
	mysql_query($query, $db_id);
	$query="delete from t_queue where t_queue.seller=".$id." or t_queue.buyer=".$id;
	mysql_query($query, $db_id);
	$query="delete from u_queue where u_queue.town=".$id;
	mysql_query($query, $db_id);
	$query="delete from uup_queue where uup_queue.town=".$id;
	mysql_query($query, $db_id);
	$query="delete from w_queue where w_queue.town=".$id;
	mysql_query($query, $db_id);
	$query="delete from towns where id=".$id;
	mysql_query($query, $db_id);
}

function abandon($id)
{
	global $db_id;
	
	$query="update towns set owner=0 where id=".$id;
	mysql_query($query, $db_id);
}

function aquire($id, $owner)
{
	global $db_id;
	
	$query="update towns set owner=".$owner." where id=".$id;
	mysql_query($query, $db_id);
}

function update_a($name, $desc, $id)
{
	 global $db_id;
	
	 $query="select count(*) from alliances where name='".$name."' and id!=".$id;
	 $result=mysql_query($query, $db_id);
	 $row=mysql_fetch_row($result);
	 if (!$row[0])
	 {
	 	$query="update alliances set name='".$name."', description='".$desc."' where id=".$id;
	 	mysql_query($query, $db_id);
	 } 
	 else 
	 	msg("Isim alindi!.");
}

function update_rank($id, $rank)
{
	global $db_id;
	
	$query="update users set rank='".$rank."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function check_d($id)
{
	global $db_id;
	
	$query="select timediff(dueTime, now()) from d_queue where user=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0][0])
		if ($row[0][0]=="-")
		{
			$query="update map set type=1, subtype=6 where subtype in (select id from towns where owner=".$id.")";
			mysql_query($query, $db_id);
			$query="select id from alliances where founder=".$id;
			$result=mysql_query($query, $db_id); 
			$row=mysql_fetch_row($result);
			if ($row[0])//if the user is an alliance founder
			{
				$query="delete from alliances where id=".$row[0];
				mysql_query($query, $db_id);
				$query="delete from pacts where (a1=".$row[0]." or a2=".$row[0].")";
				mysql_query($query, $db_id);
			}
			$query="delete from a_queue where (a_queue.town in (select id from towns where owner=".$id.") or a_queue.target in (select id from towns where owner=".$id."))";
			mysql_query($query, $db_id);
			$query="delete from c_queue where c_queue.town in (select id from towns where owner=".$id.")";
			mysql_query($query, $db_id);
			$query="delete from d_queue where user=".$id;
			mysql_query($query, $db_id);
			$query="delete from t_queue where (t_queue.seller in (select id from towns where owner=".$id.") or t_queue.buyer in (select id from towns where owner=".$id."))";
			mysql_query($query, $db_id);
			$query="delete from u_queue where u_queue.town in (select id from towns where owner=".$id.")";
			mysql_query($query, $db_id);
			$query="delete from uup_queue where uup_queue.town in (select id from towns where owner=".$id.")";
			mysql_query($query, $db_id);
			$query="delete from w_queue where w_queue.town in (select id from towns where owner=".$id.")";
			mysql_query($query, $db_id);
			$query="delete from messages where recipient=".$id;
			mysql_query($query, $db_id);
			$query="delete from reports where recipient=".$id;
			mysql_query($query, $db_id);
			$query="delete from towns where owner=".$id;
			mysql_query($query, $db_id);
			$query="delete from users where id=".$id;
			mysql_query($query, $db_id);
			return 0;
		}
		
	return 1;
}

function del_u($id)
{
	global $db_id;
	
	$query="update map set type=1, subtype=6 where subtype in (select id from towns where owner=".$id.")";
	mysql_query($query, $db_id);
	$query="select id from alliances where founder=".$id;
	$result=mysql_query($query, $db_id); 
	$row=mysql_fetch_row($result);
	if ($row[0])//if the user is an alliance founder
	{
		$query="delete from alliances where id=".$row[0];
		mysql_query($query, $db_id);
		$query="delete from pacts where (a1=".$row[0]." or a2=".$row[0].")";
		mysql_query($query, $db_id);
	}
	$query="delete from a_queue where (a_queue.town in (select id from towns where owner=".$id.") or a_queue.target in (select id from towns where owner=".$id."))";
	mysql_query($query, $db_id);
	$query="delete from c_queue where c_queue.town in (select id from towns where owner=".$id.")";
	mysql_query($query, $db_id);
	$query="delete from d_queue where user=".$id;
	mysql_query($query, $db_id);
	$query="delete from t_queue where (t_queue.seller in (select id from towns where owner=".$id.") or t_queue.buyer in (select id from towns where owner=".$id."))";
	mysql_query($query, $db_id);
	$query="delete from u_queue where u_queue.town in (select id from towns where owner=".$id.")";
	mysql_query($query, $db_id);
	$query="delete from uup_queue where uup_queue.town in (select id from towns where owner=".$id.")";
	mysql_query($query, $db_id);
	$query="delete from w_queue where w_queue.town in (select id from towns where owner=".$id.")";
	mysql_query($query, $db_id);
	$query="delete from messages where recipient=".$id;
	mysql_query($query, $db_id);
	$query="delete from reports where recipient=".$id;
	mysql_query($query, $db_id);
	$query="delete from towns where owner=".$id;
	mysql_query($query, $db_id);
	$query="delete from users where id=".$id;
	mysql_query($query, $db_id);
}

function check_r($id)
{
	global $db_id;
	
	$query="select production, resources, limits, timediff(now(), lastCheck), morale, upkeep, population from towns where id=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	$time=explode(":", $row[3]); 
	$time=$time[0]+$time[1]/60+$time[2]/3600;
	
	$res=explode("-", $row[1]); 
	$prod=explode("-", $row[0]); 
	$lim=explode("-", $row[2]); 
	$m=$row[4]/100;
	
	if ($prod[0]-$row[5]-$row[6]<5) $prod[0]=$row[5]+$row[6]+5;//noob protection against negative crop production values
	if ($res[0]+($prod[0]-$row[5]-$row[6])*$time*$m<=$lim[0]) $res[0]+=($prod[0]-$row[5]-$row[6])*$time*$m; else $res[0]=$lim[0];
	if ($res[1]+$prod[1]*$time*$m<=$lim[1]) $res[1]+=$prod[1]*$time*$m; else $res[1]=$lim[1];
	if ($res[2]+$prod[2]*$time*$m<=$lim[1]) $res[2]+=$prod[2]*$time*$m; else $res[2]=$lim[1];
	if ($res[3]+$prod[3]*$time*$m<=$lim[1]) $res[3]+=$prod[3]*$time*$m; else $res[3]=$lim[1];
	if ($res[4]+$prod[4]*$time<=$lim[2]) $res[4]+=$prod[4]*$time; else $res[4]=$lim[2];
	$res=$res[0]."-".$res[1]."-".$res[2]."-".$res[3]."-".$res[4];
	
	$query="update towns set resources='".$res."', lastCheck=now() where id=".$id;
	$result=mysql_query($query, $db_id);
}

function check_c($id, $faction)
{
	global $db_id, $tdif;
	$town=town($id);
	$buildings=buildings($faction);
	$data=explode("-", $town[8]); 
	$res=explode("-", $town[10]); 
	$lim=explode("-", $town[11]); 
	$prod=explode("-", $town[9]); 
	$land=explode("/", $town[13]);
	
	$land[0]=explode("-", $land[0]); 
	$land[1]=explode("-", $land[1]); 
	$land[2]=explode("-", $land[2]); 
	$land[3]=explode("-", $land[3]);
	
	$query="select timediff(dueTime".$tdif.", now()), b, subB from c_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
	if ($row[0][0]=="-")
	{
		if ($row[2]>-1)
		{
			$land[$row[1]][$row[2]]++; $ldata="";
			for ($i=0; $i<count($land); $i++) $ldata[$i]=implode("-", $land[$i]);
			$ldata=implode("/", $ldata);
			$out=explode("-", $buildings[$row[1]][5]); $prod[$row[1]]=0;
			for ($i=0; $i<count($land[$row[1]]); $i++)
			if ($land[$row[1]][$i]) $prod[$row[1]]+=$out[$land[$row[1]][$i]-1];
			$pdata=implode("-", $prod);
			$query="update towns set land='".$ldata."', production='".$pdata."' where id=".$id;
			mysql_query($query, $db_id);
		}
		else 
		switch($row[1])
		{
			case 0:
			{
				$data[$row[1]]=1; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 1:
			{
				$data[$row[1]]=1; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 2:
			{
				$data[$row[1]]=1; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 3:
			{
				$data[$row[1]]=1; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 4:
			{
				$data[4]++; $lim[0]=explode("-", $buildings[4][5]); $lim[0]=$lim[0][$data[4]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 5:
			{
				$data[5]++; $lim[1]=explode("-", $buildings[5][5]); $lim[1]=$lim[1][$data[5]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 6:
			{
				$data[6]++; $lim[5]=explode("-", $buildings[6][5]); $lim[5]=$lim[5][$data[6]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 7:
			{
				$data[7]++; $lim[4]=explode("-", $buildings[7][5]); $lim[4]=$lim[4][$data[7]-1]; $lim[2]+=800; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 8:
			{
				$data[8]++; $lim[3]=explode("-", $buildings[8][5]); $lim[3]=$lim[3][$data[8]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 9:
			{
				$data[9]++; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 10:
			{
				$data[10]++; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 11:
			{
				$mdata=explode("-", $buildings[11][5]);
				$data[11]++; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."', morale=".(100-$prod[4]+$mdata[$data[11]-1])." where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 12:
			{
				$data[12]++; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 13:
			{
				$data[13]++; $lim[6]=explode("-", $buildings[13][5]); $lim[6]=$lim[6][$data[13]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 14:
			{
				$data[14]++; $lim[7]=explode("-", $buildings[14][5]); $lim[7]=$lim[7][$data[14]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 15:
			{
				$data[15]++; $lim[8]=explode("-", $buildings[15][5]); $lim[8]=$lim[8][$data[15]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 16:
			{
				$data[16]=1; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 17:
			{
				$data[17]++; $bdata=implode("-", $data);
				$query="update towns set buildings='".$bdata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 18:
			{
				$data[18]++; $lim[9]=explode("-", $buildings[18][5]); $lim[9]=$lim[9][$data[18]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 19:
			{
				$data[19]++; $lim[10]=explode("-", $buildings[19][5]); $lim[10]=$lim[10][$data[19]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 20:
			{
				$data[20]++; $lim[11]=explode("-", $buildings[20][5]); $lim[11]=$lim[11][$data[20]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			case 21:
			{
				$data[21]++; $lim[12]=explode("-", $buildings[21][5]); $lim[12]=$lim[12][$data[21]-1]; $bdata=implode("-", $data); $ldata=implode("-", $lim);
				$query="update towns set buildings='".$bdata."', limits='".$ldata."' where id=".$id;
				mysql_query($query, $db_id);
			} 
			break;
			default: ;
		}
		$query="delete from c_queue where c_queue.town=".$id." and c_queue.b=".$row[1]." and c_queue.subB=".$row[2];
		mysql_query($query, $db_id);
	}
}

function check_w($id)
{
	global $db_id, $tdif;
	$town=town($id);
	$data=explode("-", $town[6]);

	$query="select timediff(dueTime".$tdif.", now()), type, quantity from w_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
		if ($row[0][0]=="-")
		{
			$data[$row[1]]+=$row[2]; $d=implode("-", $data);
			$query="update towns set weapons='".$d."' where id=".$id;
			mysql_query($query, $db_id);
			$query="delete from w_queue where town=".$id." and type=".$row[1];
			mysql_query($query, $db_id);
		}
}

function html_weaps($weaps)
{
	global $imgs, $fimgs;
	$html_data="<table class='q_table' style='border-collapse: collapse' width='600' border='1'><tr>";
	for ($i=0; $i<count($weaps); $i++) 
		$html_data.="<td><img src='".$imgs.$fimgs."1".$i.".gif'></td>";
	
	$html_data.="</tr><tr>";
	for ($i=0; $i<count($weaps); $i++) 
		$html_data.="<td>".$weaps[$i]."</td>";
	
	$html_data.="</tr></table>";

	return $html_data;
}

function html_res($res)
{
	global $imgs, $fimgs;
	$html_data="<table class='q_table' style='border-collapse: collapse' width='600' border='1'><tr>";
	for ($i=0; $i<count($res); $i++) 
		$html_data.="<td><img height='25' src='".$imgs.$fimgs."0".$i.".gif'></td>";
	
	$html_data.="</tr><tr>";
	for ($i=0; $i<count($res); $i++) 
		$html_data.="<td>".round($res[$i])."</td>";
		
	$html_data.="</tr></table>";

	return $html_data;
}

function html_army($army, $f)
{
	global $imgs, $fimgs;
	$units=units($f);
	$html_data="<table class='q_table' style='border-collapse: collapse' width='600' border='1'><tr>";
	for ($i=0; $i<count($army); $i++) 
		$html_data.="<td><img height='25' src='".$imgs.$fimgs."2".$i.".gif' title='".$units[$i][2]."'></td>";
		
	$html_data.="</tr><tr>";
	for ($i=0; $i<count($army); $i++) 
		$html_data.="<td>".$army[$i]."</td>";
		
	$html_data.="</tr></table>";

	return $html_data;
}

function check_a($id)
{
 global $db_id, $tdif;
 
 $query="select timediff(dueTime".$tdif.", now()), town, target, type, phase, army, general, uup, wup, aup, rLoot, wLoot, intel, sent, dueTime, id from a_queue where town=".$id." or target=".$id." order by dueTime asc";
 $result=mysql_query($query, $db_id);
 for (; $line=mysql_fetch_row($result); )
  if ($line[0][0]=="-")
  {
   $town=town($line[1]); $lim=explode("-", $town[11]);
   $to_owner=user($town[1]);
   $target=town($line[2]);
   $ta_owner=user($target[1]);
   if ($target[0])//if the target town exists
    if ($line[3])//if it is not a reinforcement
    {
     $data[0][0]=$ta_owner[10]; $data[0][1]=explode("-", $target[7]); $data[0][2]=explode("-", $target[15]); $data[0][3]=explode("-", $target[8]); $data[0][4]=explode("-", $target[11]); $data[0][5]=explode("-", $target[10]); $data[0][6]=explode("-", $target[6]); $data[0][7]=explode("-", $target[17]); $data[0][8]=explode("-", $target[18]); $data[0][9]=explode("-", $target[19]);
     $data[1][0]=$to_owner[10]; $data[1][1]=explode("-", $line[5]); $data[1][2]=explode("-", $line[6]); $data[1][3]=explode("-", $line[7]); $data[1][4]=explode("-", $line[8]); $data[1][5]=explode("-", $line[9]);
     $data[2]=$line[3]; $data[3]=explode("-", $line[10]); $data[4]=explode("-", $line[11]); $data[5]=$line[12];
     if (!$line[4])//if phase 0
     {
      $data=battle($data); $siege_target=-1; $buildings=buildings($ta_owner[10]);
      $line[13]=explode("-", $line[13]);
      $date=strtotime("+".$line[13][0]." hours ".$line[13][1]." minutes", strtotime($line[14]));
      $date=strftime("%y-%m-%d %H:%M:%S", $date);
      //population update due to possible siege damage
       if ($target[8]!=implode("-", $data[0][3]))
       {
        $target[8]=explode("-", $target[8]);
        for ($i=0; $i<22; $i++) if ($target[8][$i]>$data[0][3][$i])
        {
									$siege_target=$i;
 	       $buildings[$i][7]=explode("-", $buildings[$i][7]);
	        $target[3]-=$buildings[$i][7][$target[8][$i]];
        }
       }

      if ($data[1][1][11]<100)
      {
       $query="update towns set population=".$target[3].", army='".implode("-", $data[0][1])."', upkeep=".array_sum($data[0][1]).", general='".implode("-", $data[0][2])."', buildings='".implode("-", $data[0][3])."', resources='".implode("-", $data[0][5])."', weapons='".implode("-", $data[0][6])."' where id=".$target[0];
       mysql_query($query, $db_id);
      }
      else//if there are 100 or more colonists in attacking army
      {
							$data[1][1][11]-=100;
							$query="update towns set owner='".$to_owner[0]."', isCapital=0, population=".$target[3].", army='".implode("-", $data[0][1])."', upkeep=".array_sum($data[0][1]).", general='".implode("-", $data[0][2])."', buildings='".implode("-", $data[0][3])."', resources='".implode("-", $data[0][5])."', weapons='".implode("-", $data[0][6])."' where id=".$target[0];
							mysql_query($query, $db_id);
							send_report($to_owner[0], "�ehir Ele Ge�irildi!", " ".$target[2].".");
							send_report($ta_owner[0], "�ehir Ele Ge�irildi!", "".$target[2]."kabilesi ".$town[2]." taras�ndan ele ge�irildi!.");
      }
      if (!$data[5]) $data[5]=array("[no info]");
      $query="update a_queue set phase=1, dueTime='".$date."', army='".implode("-", $data[1][1])."', general='".implode("-", $data[1][2])."', rLoot='".implode("-", $data[3])."', wLoot='".implode("-", $data[4])."', intel='".implode("-", $data[5])."' where town=".$town[0]." and id=".$line[15];
      mysql_query($query, $db_id);
						$data[0][1]=html_army($data[0][1], $ta_owner[10]); $data[1][1]=html_army($data[1][1], $to_owner[10]); $data[0][10]=html_army($data[0][10], $ta_owner[10]); $data[1][10]=html_army($data[1][10], $to_owner[10]); $data[3]=html_res($data[3]); $data[4]=html_weaps($data[4]);
						if ($siege_target>-1) $siege_target="</br>Y�k�lan binalar: ".$buildings[$siege_target][2]; else $siege_target="";
      send_report($ta_owner[0], "Sava� Raporu", "Sald�ran <a class='q_link' href='profile_view.php?id=".$town[1]."'>".$town[2]."</a></br>sava�tan �nce d��man askeri : </br>".$data[1][10]."</br>sava�tan sonra d��man askeri : </br>".$data[1][1]."</br>sava�tan �nce senin askerlerin : </br>".$data[0][10]."</br>sava�tan sonra senin askerlerin : </br>".$data[0][1].$siege_target);
						send_report($to_owner[0], "Sava� Raporu, eve-d�n��", "D�n�len Yer : <a class='q_link' href='profile_view.php?id=".$target[1]."'>".$target[2]."</a></br>sava�tan �nce senin askerlerin : </br>".$data[1][10]."</br>sava�tan sonra senin askerlerin : </br>".$data[1][1]."</br>sava�tan �nce d��man askeri : </br>".$data[0][10]."</br>sava�tan sonra d��man askeri : </br>".$data[0][1]."</br>Al�nan kaynaklar : ".$data[3]."</br>Al�nan silahlar : ".$data[4].$siege_target);
     }
     else if ($town[0])//if phase 1
     {
      $army=explode("-", $town[7]); for ($i=0; $i<13; $i++) $army[$i]+=$data[1][1][$i];
      $ogen=explode("-", $town[15]); if ($data[1][2][0]) {$data[1][2][3]=$ogen[3]; $ogen=$data[1][2];} $ogen=implode("-", $ogen);
      $res=explode("-", $town[10]); for ($i=0; $i<5; $i++) $res[$i]+=$data[3][$i]; $res=implode("-", $res);
      $weaps=explode("-", $town[6]); for ($i=0; $i<11; $i++) if ($weaps[$i]+$data[4][$i]<=$lim[12]) $weaps[$i]+=$data[4][$i]; else $weaps[$i]=$lim[12]; $weaps=implode("-", $weaps);
      $query="update towns set army='".implode("-", $army)."', upkeep=".array_sum($army).", general='".$ogen."', resources='".$res."', weapons='".$weaps."' where id=".$town[0];
      mysql_query($query, $db_id);
      $query="delete from a_queue where town=".$town[0]." and id=".$line[15];
      mysql_query($query, $db_id);
     }
    }
    else//reinforce target
    {
     $army=explode("-", $target[7]); $qarmy=explode("-", $line[5]); for ($i=0; $i<count($army); $i++) $army[$i]+=$qarmy[$i];
     $query="update towns set army='".implode("-", $army)."', upkeep=".array_sum($army)." where id=".$target[0];
     mysql_query($query, $db_id);
     $query="delete from a_queue where town=".$town[0]." and id=".$line[15];
     mysql_query($query, $db_id);
					$line[5]=html_army($qarmy, $to_owner[10]);
     send_report($to_owner[0], "Takviye birlikler g�nderildi!", "</br>".$line[5]."</br>�uraya-> <a class='q_link' href='profile_view.php?id=".$target[1]."'>".$target[2]."</a>");
     send_report($ta_owner[0], "Takviye birlikler geldi!", "</br>".$line[5]."</br>�urdan-> <a class='q_link' href='profile_view.php?id=".$town[1]."'>".$town[2]."</a>");
    }
   else if ($town[0])//if source town exists
   {
    $army=explode("-", $town[7]); for ($i=0; $i<13; $i++) $army[$i]+=$data[1][1][$i];
    $ogen=explode("-", $town[15]); if ($data[1][2][0]) {$data[1][2][3]=$ogen[3]; $ogen=$data[1][2];} $ogen=implode("-", $ogen);
    $res=explode("-", $town[10]); for ($i=0; $i<5; $i++) $res[$i]+=$data[3][$i]; $res=implode("-", $res);
    $weaps=explode("-", $town[6]); for ($i=0; $i<11; $i++) if ($weaps[$i]+$data[4][$i]<=$lim[12]) $weaps[$i]+=$data[4][$i]; else $weaps[$i]=$lim[12]; $weaps=implode("-", $weaps);
    $query="update towns set army='".implode("-", $army)."', upkeep=".array_sum($army).", general='".$ogen."', resources='".$res."', weapons='".$weaps."' where id=".$town[0];
    mysql_query($query, $db_id);
    $query="delete from a_queue where town=".$town[0]." and id=".$line[15];
    mysql_query($query, $db_id);
   }
   else//if there is no target town and no source town
   {
    $query="delete from a_queue where town=".$town[0]." and id=".$line[15];
    mysql_query($query, $db_id);
   }
  }
}

function check_u($id)
{
	global $db_id, $tdif;
	$town=town($id);
	$data=explode("-", $town[7]);

	$query="select timediff(dueTime".$tdif.", now()), type, quantity from u_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
		if ($row[0][0]=="-")
		{
			$data[$row[1]]+=$row[2]; $d=implode("-", $data);
			$query="update towns set army='".$d."' where id=".$id;
			mysql_query($query, $db_id);
			$query="delete from u_queue where town=".$id." and type=".$row[1];
			mysql_query($query, $db_id);
		}
}

function check_uup($id)
{
	global $db_id, $tdif;
	$town=town($id);
	$data[17]=explode("-", $town[17]); $data[18]=explode("-", $town[18]); $data[19]=explode("-", $town[19]);

	$query="select timediff(dueTime".$tdif.", now()), unit, tree from uup_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
		if ($row[0][0]=="-")
		{
			$data[$row[2]][$row[1]]++; $d=implode("-", $data[$row[2]]);
			if ($row[2]==17) 
				$col="uUpgrades"; 
			else if ($row[2]==18) 
				$col="wUpgrades"; 
			else if ($row[2]==19) 
				$col="aUpgrades";
			$query="update towns set ".$col."='".$d."' where id=".$id;
			mysql_query($query, $db_id);
			$query="delete from uup_queue where town=".$id." and unit=".$row[1]." and tree=".$row[2];
			mysql_query($query, $db_id);
		}
}

function check_t($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), seller, buyer, sType, sSubType, sQ, bType, bSubType, bQ from t_queue where type=1 and (seller=".$id." or buyer=".$id.") order by dueTime asc";
	$result=mysql_query($query, $db_id);

	for (; $offer=mysql_fetch_row($result); )
		if ($offer[0][0]=="-")
		{
			$seller=town($offer[1]);
			$buyer=town($offer[2]);
			if ($offer[6]) 
			{
				$scol="weapons"; 
				$sdata=explode("-", $seller[6]);
			} 
			else 
			{
				$scol="resources"; 
				$sdata=explode("-", $seller[10]);
			}
			if ($offer[3]) 
			{
			$bcol="weapons"; 
			$bdata=explode("-", $buyer[6]);
			} 
			else 
			{
				$bcol="resources"; 
				$bdata=explode("-", $buyer[10]);
			}
			$sdata[$offer[7]]+=$offer[8]; $bdata[$offer[4]]+=$offer[5];
			$sdata=implode("-", $sdata); $bdata=implode("-", $bdata);
			$query="update towns set ".$scol."='".$sdata."' where id=".$seller[0];
			mysql_query($query, $db_id);
			$query="update towns set ".$bcol."='".$bdata."' where id=".$buyer[0];
			mysql_query($query, $db_id);
			$query="delete from t_queue where seller=".$offer[1]." and sType=".$offer[3]." and sSubType=".$offer[4]." and bType=".$offer[6]." and bSubType=".$offer[7];
			mysql_query($query, $db_id);
		}
}

function check_d_all()
{
	global $db_id;

	$query="select timediff(dueTime, now()), user from d_queue";
	$result=mysql_query($query, $db_id); 
	$d_list=array(); $d=0;
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$d_list[$i]=$row;
		if ($row[0][0]=="-") 
			if (!check_d($row[1])) 
				$d++;
	}
	msg($d." users deleted. ".(count($d_list)-$d)." accounts not due.");
}

function get_d($id)
{
	global $db_id;

	$query="select timediff(dueTime, now()) from d_queue where user=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	return $row[0];
}

function get_con($id)
{
	global $db_id;

	$query = "select b from c_queue where town = ".$id;
	$result = mysql_query($query, $db_id);
	$b = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	for ($i=0; $row = mysql_fetch_row($result); $i++) 
		$b[$row[0]] = 1;

	return $b;
}

function get_wea($id)
{
	global $db_id;

	$query="select type from w_queue where town=".$id;
	$result=mysql_query($query, $db_id);
	$w=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$w[$row[0]]=1;
	return $w;
}

function get_uup($id)
{
	global $db_id;

	$query="select unit from uup_queue where town=".$id;
	$result=mysql_query($query, $db_id);
	$u=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$u[$row[0]]=1;
	return $u;
}

function get_uns($id)
{
	global $db_id;

	$query="select type from u_queue where town=".$id;
	$result=mysql_query($query, $db_id);
	$u=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$u[$row[0]]=1;
	return $u;
}

function get_tr($id)
{
	global $db_id;

	$merchants=0;
	$query="select sType, sQ from t_queue where seller=".$id;
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
		if ($row[0]) 
			$merchants+=ceil($row[1]/50); 
		else 
			$merchants+=ceil($row[1]/500);
	$query="select bType, bQ from t_queue where buyer=".$id;
	$result=mysql_query($query, $db_id);
	for (; $row=mysql_fetch_row($result); )
		if ($row[0]) 
			$merchants+=ceil($row[1]/50); 
		else 
			$merchants+=ceil($row[1]/500);

	return $merchants;
}

function get_t($id)
{
	global $db_id, $tdif;

	$tq=array();
	$query="select sType, sSubType, sQ, bType, bSubType, bQ from t_queue where seller=".$id." and type=0";
	$result=mysql_query($query, $db_id);
	for ($i=0; $tq[0][$i]=mysql_fetch_row($result); $i++) ;
	$query="select bType, bSubType, bQ, buyer, timediff(dueTime".$tdif.", now()), sType, sSubType, sQ from t_queue where seller=".$id." and type=1";
	$result=mysql_query($query, $db_id);
	for ($i=0; $tq[1][$i]=mysql_fetch_row($result); $i++) ;
	$query="select sType, sSubType, sQ, seller, timediff(dueTime".$tdif.", now()), bType, bSubType, bQ from t_queue where buyer=".$id." and type=1";
	$result=mysql_query($query, $db_id);
	for ($i=0; $tq[2][$i]=mysql_fetch_row($result); $i++) ;

	return $tq;
}

function get_w($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), type, quantity from w_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id); $wq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$wq[$i]=$row;
	return $wq;
}

function get_u($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), type, quantity from u_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id); $uq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$uq[$i]=$row;
	return $uq;
}

function get_a($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), target, type, army, general, id from a_queue where town=".$id." and phase=0 order by dueTime asc";
	$result=mysql_query($query, $db_id); $aq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$aq[$i]=$row;
	return $aq;
}

function get_ia($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), town, target, type, phase from a_queue where (target=".$id." and phase=0) or (town=".$id." and phase=1) order by dueTime asc";
	$result=mysql_query($query, $db_id); $iaq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$iaq[$i]=$row;
	return $iaq;
}

function get_up($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), unit, tree from uup_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id); $upq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$upq[$i]=$row;
	return $upq;
}

function get_c($id)
{
	global $db_id, $tdif;

	$query="select timediff(dueTime".$tdif.", now()), b, subB from c_queue where town=".$id." order by dueTime asc";
	$result=mysql_query($query, $db_id); $cq=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$cq[$i]=$row;
	return $cq;
}

function get_pact($a1, $a2)
{
	global $db_id;

	$query="select type from pacts where (a1=".$a1." and a2=".$a2.") or (a1=".$a2." and a2=".$a1.")";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	return $row[0];
}

function cancel_d($id)
{
	global $db_id;

	$query="delete from d_queue where user=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		msg("Silme iste�i geri al�nd�!.");
	else 
		msg("Hata!.".mysql_error());
}

function cancel_c($id, $b, $subB, $res, $faction)
{
	global $db_id;
	$town=town($id);
	$buildings=buildings($faction);
	$data=explode("-", $town[8]); $land=explode("/", $town[13]); $upk=explode("-", $buildings[$b][7]);
	$land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]);

	if ($subB==-1) 
		$pop=$town[3]-$upk[$data[$b]];
	else 
		$pop=$town[3]-$upk[$land[$b][$subB]];
	$query="update towns set resources='".$res."', population=".$pop." where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from c_queue where town=".$id." and b=".$b;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function cancel_a($id, $tid, $army, $gen)
{
	global $db_id;

	$army=explode("-", $army);
	$query="update towns set army='".implode("-", $army)."', upkeep=".array_sum($army).", general='".$gen."' where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from a_queue where town=".$id." and id=".$tid;
	$result=mysql_query($query, $db_id);
	if ($result) 
		header("Location: dispatch.php?town=".$id);
	else 
		msg("Hata!.".mysql_error());
}

function cancel_w($id, $type, $res)
{
	global $db_id;

	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from w_queue where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function cancel_u($id, $type, $res, $weaps, $q)
{
	global $db_id;
	$town=town($id); $town[7]=explode("-", $town[7]);

	$query="update towns set resources='".$res."', weapons='".$weaps."', upkeep=".array_sum($town[7])." where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from u_queue where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function cancel_uup($id, $unit, $tree, $res)
{
	global $db_id;

	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from uup_queue where town=".$id." and unit=".$unit." and tree=".$tree;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function cancel_t($id, $sType, $sSubType, $bType, $bSubType, $res)
{
	global $db_id;
	$town=town($id);
	$data=explode("-", $town[6]);

	if ($sType) 
		$scol="weapons"; 
	else 
		$scol="resources";
	$query="update towns set ".$scol."='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from t_queue where seller=".$id." and sType=".$sType." and sSubType=".$sSubType." and bType=".$bType." and bSubType=".$bSubType;
	$result=mysql_query($query, $db_id);
	if ($result) 
		header("Location: marketplace.php?town=".$id);
	else 
		msg("Hata!.".mysql_error());
}

function send_report($to, $subject, $contents)
{
	global $db_id;

	$query="insert into reports(recipient, subject, contents, sent) values(".$to.", '".mysql_real_escape_string($subject)."', '".mysql_real_escape_string($contents)."', now())";
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function send_to_all($subject, $contents)
{
	global $db_id;

	$users=users();
	for ($i=0; $i<count($users); $i++)
	{
		$query="insert into reports(recipient, subject, contents, sent) values(".$users[$i][0].", '".$subject."', '".$contents."', now())";
		mysql_query($query, $db_id);
	}
}

function send_message($from, $to, $subject, $contents)
{
	global $db_id;

	$query="insert into messages(sender, recipient, subject, contents, sent) values(".$from.", ".$to.", '".$subject."', '".$contents."', now())";
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function msg_rep_alert($id)
{
	global $db_id;
	$output = array();
	$query = "select count(*) from reports where recipient=".$id." and timediff('".$_SESSION["user"][6]."', sent)<'00:00:00'";
	$result = mysql_query($query, $db_id); 
	$output[0] = mysql_fetch_row($result);

	$query = "select count(*) from messages where recipient=".$id." and timediff('".$_SESSION["user"][6]."', sent)<'00:00:00'";
	$result = mysql_query($query, $db_id); 
	$output[1] = mysql_fetch_row($result);
	return $output;
}

function messages($id)
{
	global $db_id;

	$query="select * from messages where recipient=".$id." order by sent desc";
	$result=mysql_query($query, $db_id); $reports=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$reports[$i]=$row;
		if (strtotime($row[5])>strtotime($_SESSION["user"][6])) 
			$reports[$i][6]=1; 
		else 
			$reports[$i][6]=0;//if message is new
	}
	return $reports;
}

function reports($id)
{
	global $db_id;

	$query="select * from reports where recipient=".$id." order by sent desc";
	$result=mysql_query($query, $db_id); $reports=array();
	for ($i=0; $row=mysql_fetch_row($result); $i++)
	{
		$reports[$i]=$row;
		if (strtotime($row[4])<strtotime($_SESSION["user"][4])) 
			$reports[$i][5]=1; 
		else 
			$reports[$i][5]=0;//if report is new
	}
	return $reports;
}

function offers($sType, $sSubType, $bType, $bSubType)
{
	global $db_id;

	$offers=array();
	$query="select * from t_queue where type=0 and sType=".$sType." and sSubType=".$sSubType." and bType=".$bType." and bSubType=".$bSubType;
	$result=mysql_query($query, $db_id);
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$offers[$i]=$row;
	return 
		$offers;
}

function offer($seller, $sType, $sSubType, $bType, $bSubType)
{
	global $db_id;

	$query="select * from t_queue where seller=".$seller." and sType=".$sType." and sSubType=".$sSubType." and bType=".$bType." and bSubType=".$bSubType;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	return $row;
}

function report($id)
{
	global $db_id;

	$query="select * from reports where id=".$id;
	$result=mysql_query($query, $db_id); $reports=array();
	$row=mysql_fetch_row($result);
	return $row;
}

function message($id)
{
	global $db_id;

	$query="select * from messages where id=".$id;
	$result=mysql_query($query, $db_id); $reports=array();
	$row=mysql_fetch_row($result);
	return $row;
}

function delrep($id, $owner)
{
	global $db_id;
	$report=report($id);

	if ($owner!=$report[1]) 
	{ 
		msg($lang['accessDenied']);
	}
	else
	{
		$query="delete from reports where id=".$id;
		$result=mysql_query($query, $db_id); $reports=array();
		if ($result) 
			header('Location: reports.php?page=0');
		else 
			msg("Hata!.".mysql_error());
	}
}

function delallrep($id)
{
	global $db_id;

	$query="delete from reports where recipient=".$id;
	$result=mysql_query($query, $db_id); $reports=array();
	if ($result) 
		header('Location: reports.php?page=0');
	else 
		msg("Hata!.".mysql_error());
}

function delmsg($id, $owner)
{
	global $db_id;
	$message=message($id);

	if ($owner!=$message[2]) 
	{ 
		msg($lang['accessDenied']);
	}
	else
	{
		$query="delete from messages where id=".$id;
		$result=mysql_query($query, $db_id); $reports=array();
		if ($result) 
			header('Location: messages.php?page=0');
		else 
			msg("Hata!.".mysql_error());
	}
}

function delallmsg($id)
{
	global $db_id;

	$query="delete from messages where recipient=".$id;
	$result=mysql_query($query, $db_id); $reports=array();
	if ($result) 
		header('Location: messages.php?page=0');
	else 
		msg("Hata!.".mysql_error());
}

function delacc($id)
{
	global $db_id;

	$query="select count(*) from d_queue where user=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if (!$row[0])
	{
		$date=strtotime("+1 day"); $date=strftime("%y-%m-%d %H:%M:%S", $date);
		$query="insert into d_queue(user, dueTime) values('".$id."', '".$date."')";
		$result=mysql_query($query, $db_id);
		if ($result) 
			msg("Hesap 1 g�n i�inde silinecektir!.");
		else 
			msg("Hata!.".mysql_error());
	} 
	else 
		msg("Bu hesap zaten silinmek �zere ayarlanm��!.");
}

function build($id, $b, $subB, $time, $res, $faction)
{
	global $db_id;
	$town=town($id); $buildings=buildings($faction); $data=explode("-", $town[8]); $land=explode("/", $town[13]); $upk=explode("-", $buildings[$b][7]);
	$land[0]=explode("-", $land[0]); $land[1]=explode("-", $land[1]); $land[2]=explode("-", $land[2]); $land[3]=explode("-", $land[3]);

	$time=explode(":", $time);

	$query="select max(dueTime) from c_queue where town=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0]!="") 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".($time[2]+rand(0, 9))." seconds", strtotime($row[0])); 
	else 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".($time[2]+rand(0, 9))." seconds");
	$date=strftime("%y-%m-%d %H:%M:%S", $date);
	$query="insert into c_queue(town, dueTime, b, subB) values('".$id."', '".$date."', '".$b."', '".$subB."')";
	$result=mysql_query($query, $db_id);
	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($subB==-1) 
		$pop=$town[3]+$upk[$data[$b]];
	else 
		$pop=$town[3]+$upk[$land[$b][$subB]];
	$query="update towns set population=".$pop." where id=".$id;
	$result=mysql_query($query, $db_id);

	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function forge($a, $id, $type, $q, $time, $res)
{
	global $db_id;
	$town=town($id);
	$time=explode(":", $time);

	if (!$a) 
		$query="select max(dueTime) from w_queue where town=".$id;
	else 
		$query="select dueTime from w_queue where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id); $row=mysql_fetch_row($result);
	if ($row[0]!="") 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".$time[2]." seconds", strtotime($row[0])); 
	else 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".$time[2]." seconds");
	$date=strftime("%y-%m-%d %H:%M:%S", $date);
	if (!$a) 
		$query="insert into w_queue(town, dueTime, type, quantity) values('".$id."', '".$date."', '".$type."', '".$q."')";
	else 
		$query="update w_queue set dueTime='".$date."', quantity=quantity+".$q." where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id);
	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function train($a, $id, $type, $q, $time, $res, $weaps)
{
	global $db_id;
	$town=town($id); $town[7]=explode("-", $town[7]);

	$time=explode(":", $time);

	if (!$a) 
		$query="select max(dueTime) from u_queue where town=".$id;
	else 
		$query="select dueTime from u_queue where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0]!="") 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".$time[2]." seconds", strtotime($row[0])); 
	else 
		$date=strtotime("+".$time[0]." hours ".$time[1]." minutes ".$time[2]." seconds");
	$date=strftime("%y-%m-%d %H:%M:%S", $date);
	if (!$a) 
		$query="insert into u_queue(town, dueTime, type, quantity) values('".$id."', '".$date."', '".$type."', '".$q."')";
	else 
		$query="update u_queue set dueTime='".$date."', quantity=quantity+".$q." where town=".$id." and type=".$type;
	$result=mysql_query($query, $db_id);
	$query="update towns set resources='".$res."', weapons='".$weaps."', upkeep=".(array_sum($town[7])+$q)." where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		echo "<script type='text/javascript'>history.go(-1)</script>";
	else 
		msg("Hata!.".mysql_error());
}

function set_gen($id, $utype)
{
	global $db_id;
	$town=town($id);

	$query="update towns set general='1-1-".$utype."-0' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		msg("Birlik generalli�e terfi etti!Sadece bir generalin olabilir,bu y�zden eski generalin emekli oldu!.");
	else 
		msg("Hata!.".mysql_error());
}

function battle($data)
{
	$d_units=units($data[0][0]);
	$a_units=units($data[1][0]);
	$def=array(); $atk=array(); 
	$data[0][10]=$data[0][1]; 
	$data[1][10]=$data[1][1];
	$bo[0][1]=$data[0][4][6]; //def&atk bonuses
	$bo[0][0]=$data[0][4][7]; 
	$bo[1][1]=0; $bo[1][0]=0;
	switch($data[0][2][3])
	{
		case 1: //offensive
			$bo[0][0]+=0.25*$bo[0][0]; 
			$bo[0][1]-=0.25*$bo[0][1]; 
			break;
		case 2: //defensive
			$bo[0][0]-=0.25*$bo[0][0]; 
			$bo[0][1]+=0.25*$bo[0][1]; 
			break;
	}
	switch($data[1][2][3])
	{
		case 1: //offensive
			$bo[1][0]+=0.25*$bo[1][0]; 
			$bo[1][1]-=0.25*$bo[1][1]; 
			break;
		case 2: //defensive
			$bo[1][0]-=0.25*$bo[1][0]; 
			$bo[1][1]+=0.25*$bo[1][1]; 
			break;
	}
	//naval combat
	if ((($data[1][1][9])||($data[1][1][10]))&&(($data[0][1][9])||($data[0][1][10])))
	{
		$def[0]=($d_units[9][5]+$data[0][7][9])*$data[0][1][9]+($d_units[10][5]+$data[0][7][10])*$data[0][1][10]; 
		$def[1]=($d_units[9][6]+$data[0][8][9])*$data[0][1][9]+($d_units[10][6]+$data[0][8][10])*$data[0][1][10]; 
		$def[2]=($d_units[9][7]+$data[0][9][9]+$d_units[10][7]+$data[0][9][10])/2;
		$def[1]+=$def[1]*$bo[0][0]/100; $def[2]+=$def[2]*$bo[0][1]/100;
		$atk[0]=($a_units[9][5]+$data[1][3][9])*$data[1][1][9]+($a_units[10][5]+$data[1][3][10])*$data[1][1][10]; 
		$atk[1]=($a_units[9][6]+$data[1][4][9])*$data[1][1][9]+($a_units[10][6]+$data[1][4][10])*$data[1][1][10]; 
		$atk[2]=($a_units[9][7]+$data[1][5][9]+$a_units[10][7]+$data[1][5][10])/2;
		$atk[1]+=$atk[1]*$bo[1][0]/100; $atk[2]+=$atk[2]*$bo[1][1]/100;
		$ah=$def[0]/$atk[1]*(100-$def[2])/100; $dh=$atk[0]/$def[1]*(100-$atk[2])/100;
		$admg=($atk[0]-$ah*$def[1]*(100-$atk[2])/100)/$atk[0]; 
		$ddmg=($def[0]-$dh*$atk[1]*(100-$def[2])/100)/$def[0];
		if ($admg<0) 
			$admg=0; 
		else if ($admg>1) 
			$admg=1;
		if ($ddmg<0) 
			$ddmg=0; 
		else if ($ddmg>1) 
			$ddmg=1;
		if ($ah<$dh)//if attacking ships win
		{
			$data[1][1][9]=ceil($data[1][1][9]*$admg); 
			$data[1][1][10]=ceil($data[1][1][10]*$admg);
			$data[0][1][9]=0; 
			$data[0][1][10]=0;
			for ($i=0; $i<count($a_units); $i++) //drowned units
				if (($i<9)||($i>10)) 
					$data[1][1][$i]=ceil($data[1][1][$i]*$admg);
		}
		else//if defending ships win
		{
			$data[0][1][9]=ceil($data[0][1][9]*$ddmg); $data[0][1][10]=ceil($data[0][1][10]*$ddmg);
			$data[1][1]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			$data[0][2][1]++; 
			if ($data[1][2][1]) //defending general promoted, the other demoted
				$data[1][2][1]--;
			$data[3]=array(0, 0, 0, 0, 0); 
			$data[4]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			return $data;
		}
	}
	//land combat
	$def[0]=0; $def[1]=0; $def[2]=0; $atk[0]=0; $atk[1]=0; $atk[2]=0;
	for ($i=0; $i<count($d_units); $i++) 
		if (($i<9)||($i>10))
		{
			$def[0]+=($d_units[$i][5]+$data[0][7][$i])*$data[0][1][$i]; $def[1]+=($d_units[$i][6]+$data[0][8][$i])*$data[0][1][$i]; $def[2]+=$d_units[$i][7]+$data[0][9][$i];
			$atk[0]+=($a_units[$i][5]+$data[1][3][$i])*$data[1][1][$i]; $atk[1]+=($a_units[$i][6]+$data[1][4][$i])*$data[1][1][$i]; $atk[2]+=$a_units[$i][7]+$data[1][5][$i];
		}
	if ($data[0][2][0]) 
	{
		$def[1]+=($d_units[$data[0][2][2]][6]+$data[0][8][$data[0][2][2]])*$data[0][2][1]; 
		$def[2]+=$d_units[$data[0][2][2]][7]+$data[0][9][$data[0][2][2]];
	}
	if ($data[1][2][0]) 
	{
		$atk[1]+=($a_units[$data[1][2][2]][6]+$data[1][4][$data[1][2][2]])*$data[1][2][1]; 
		$atk[2]+=$a_units[$data[1][2][2]][7]+$data[1][5][$data[1][2][2]];
	}
	$def[2]/=11; $def[1]+=$def[1]*$bo[0][0]/100; $def[2]+=$def[2]*$bo[0][1]/100;
	$atk[2]/=11; $atk[1]+=$atk[1]*$bo[1][0]/100; $atk[2]+=$atk[2]*$bo[1][1]/100;
	/*
	$atk - attacker data
	$def - defender data
	---
	0 - hp, 1 - atk, 2 - def
	*/
	if (($atk[0])&&($def[0]))//if any attaking/defending troops remained
	{
		$ah=$def[0]/$atk[1]*(100-$def[2])/100; $dh=$atk[0]/$def[1]*(100-$atk[2])/100;
		$admg=($atk[0]-$ah*$def[1]*(100-$atk[2])/100)/$atk[0]; $ddmg=($def[0]-$dh*$atk[1]*(100-$def[2])/100)/$def[0];
		$qadmg=($atk[0]-$def[1]*(100-$atk[2])/100)/$atk[0]; $qddmg=($def[0]-$atk[1]*(100-$def[2])/100)/$def[0];
		if ($admg<0) $admg=0; else if ($admg>1) $admg=1;
		if ($ddmg<0) $ddmg=0; else if ($ddmg>1) $ddmg=1;
		if ($qadmg<0) $qadmg=0; else if ($qadmg>1) $qadmg=1;
		if ($qddmg<0) $qddmg=0; else if ($qddmg>1) $qddmg=1;
		if ($ah<$dh)//if attackers win
		{
			if ($data[2]==2)//if there was an 'attack'
			{
				$atc=0;
				for ($i=0; $i<count($d_units); $i++) 
				{
					$data[1][1][$i]=ceil($data[1][1][$i]*$admg); 
					$atc+=$data[1][1][$i];
				}
				$data[0][1]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
				//siege damage
				if (($data[1][1][7])||($data[1][1][8])) 
				{
					$b=rand(0, 21); 
					if ($data[0][3][$b]) 
						$data[0][3][$b]--;
				}
				//plunder
				$atc*=10;//each unit can carry 10 of each resource
				for ($i=0; $i<5; $i++)
					if ($atc>0)
					{
						if ($data[0][5][$i]-$data[0][4][5]>$atc) 
						{
							$data[3][$i]=$atc; $data[0][5][$i]-=$atc;
						} 
						else if ($data[0][5][$i]-$data[0][4][5]>0) 
						{
							$data[3][$i]=$data[0][5][$i]-$data[0][4][5]; $data[0][5][$i]=$data[0][4][5];
						} 
						else 
							$data[3][$i]=0;
					} 
					else 
						$data[3][$i]=0;
				$atc/=10;//each unit can carry 1 of each weapon
				for ($i=0; $i<11; $i++)
					if ($atc>0)
					{
						if ($data[0][6][$i]>$atc) 
						{
							$data[4][$i]=$atc; $data[0][6][$i]-=$atc;
						} 
						else 
						{
							$data[4][$i]=$data[0][6][$i]; $data[0][6][$i]=0;
						}
					} 
					else 
						$data[4][$i]=0;
						
				$data[1][2][1]++; 
				if ($data[0][2][1]) //attacking general promoted, the other demoted
					$data[0][2][1]--;
			}
			else//if there was a 'raid' or 'spy' mission
			{
				$atc=0;
				for ($i=0; $i<count($d_units); $i++)
				{
					$data[1][1][$i]=ceil($data[1][1][$i]*$qadmg); $data[0][1][$i]=ceil($data[0][1][$i]*$qddmg); $atc+=$data[1][1][$i];
					//check to see if one side >> the other
					if ($data[1][1][$i]<=0) 
						$data[1][1][$i]=0; 
					if ($data[0][1][$i]<=0) 
						$data[0][1][$i]=0;
				}
				$atc*=10;//each unit can carry 10 of each resource
				for ($i=0; $i<5; $i++)
					if ($atc>0)
					{
						if ($data[0][5][$i]-$data[0][4][5]>$atc) 
						{
							$data[3][$i]=$atc; $data[0][5][$i]-=$atc;
						} 
						else if ($data[0][5][$i]-$data[0][4][5]>0) 
						{
							$data[3][$i]=$data[0][5][$i]-$data[0][4][5]; $data[0][5][$i]=$data[0][4][5];
						} 
						else 
							$data[3][$i]=0;
					} 
					else 
						$data[3][$i]=0;
						
				$atc/=10;//each unit can carry 1 of each weapon
				for ($i=0; $i<11; $i++)
					if ($atc>0)
					{
						if ($data[0][6][$i]>$atc) 
						{
							$data[4][$i]=$atc; $data[0][6][$i]-=$atc;
						} 
						else 
						{
							$data[4][$i]=$data[0][6][$i]; $data[0][6][$i]=0;
						}
					} 
					else 
						$data[4][$i]=0;
				if ($data[2]==3) 
					$data[5]=$data[0][1];
			}
		}
		else//if defenders win
		{
			if ($data[2]==2)//if there was an 'attack'
			{
				for ($i=0; $i<count($a_units); $i++) 
					$data[0][1][$i]=ceil($data[0][1][$i]*$ddmg);
				$data[1][1]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
				$data[0][2][1]++; 
				if ($data[1][2][1]) //defending general promoted, the other demoted
					$data[1][2][1]--;
				$data[3]=array(0, 0, 0, 0, 0); 
				$data[4]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			}
			else//if there was a 'raid' or 'spy' mission
				for ($i=0; $i<count($a_units); $i++)
				{
					$data[0][1][$i]=ceil($data[0][1][$i]*$qddmg); $data[1][1][$i]=ceil($data[1][1][$i]*$qadmg);
					 //check to see if one side >> the other
					if ($data[0][1][$i]<=0) 
						$data[0][1][$i]=0; 
					if ($data[1][1][$i]<=0) 
						$data[1][1][$i]=0;
				}
			$data[3]=array(0, 0, 0, 0, 0); 
			$data[4]=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		}
	}
	else if ($atk[0])//if there are no defenders
	{
		//if attack, siege damage
		if ($data[2]==2) 
			if (($data[1][1][7])||($data[1][1][8])) 
			{
				$b=rand(0, 21); 
				if ($data[0][3][$b]) 
					$data[0][3][$b]--;
			}
		$atc=0; 
		for ($i=0; $i<count($d_units); $i++) 
			$atc+=$data[1][1][$i];
		$atc*=10;//each unit can carry 10 of each resource
		for ($i=0; $i<5; $i++) 
			if ($data[0][5][$i]-$data[0][4][5]>$atc) 
			{
				$data[3][$i]=$atc; 
				$data[0][5][$i]-=$atc;
			} 
			else if ($data[0][5][$i]-$data[0][4][5]>0) 
			{
				$data[3][$i]=$data[0][5][$i]-$data[0][4][5]; 
				$data[0][5][$i]=$data[0][4][5];
			} 
			else 
				$data[3][$i]=0;
				
		$atc/=10;//each unit can carry 1 of each weapon
		for ($i=0; $i<11; $i++) 
			if ($data[0][6][$i]>$atc) 
			{
				$data[4][$i]=$atc; 
				$data[0][6][$i]-=$atc;
			} 
			else 
			{
				$data[4][$i]=$data[0][6][$i]; 
				$data[0][6][$i]=0;
			}
		$data[5]=$data[0][1];
	}
	return $data;
}

function trade($id, $buyer, $sQ, $sType, $sSubType, $bQ, $bType, $bSubType, $type, $dueTime, $res, $maxTime)
{
	global $db_id;
	$town=town($id);
	$loc=town_xy($id);
	if ($sType) 
		$scol="weapons"; 
	else 
		$scol="resources";

	$query="select count(*) from t_queue where seller=".$id." and sType=".$sType." and sSubType=".$sSubType." and bType=".$bType." and bSubType=".$bSubType;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if (!$row[0])
	{
		$query="insert into t_queue(seller, buyer, sType, sSubType, sQ, bType, bSubType, bQ, type, dueTime, x, y, water, maxTime) values(".$id.", ".$buyer.", ".$sType.", ".$sSubType.", ".$sQ.", ".$bType.", ".$bSubType.", ".$bQ.", ".$type.", '".$dueTime."', ".$loc[0].", ".$loc[1].", ".$town[16].", ".$maxTime.")";
		mysql_query($query, $db_id);
		$query="update towns set ".$scol."='".$res."' where id=".$id;
		$result=mysql_query($query, $db_id);
		if ($result) 
			header("Location: marketplace.php?town=".$id);
		else 
			msg("Hata!.".mysql_error());
	} 
	else 
	{ 
		msg("�uan zaten ayn� tipte bir teklifin/nakliyen var!");
	}
}

function npc_trade($id, $res)
{
	global $db_id;

	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1; 
	else 
		return 0;
}

function upgrade_u($id, $res, $unit, $tree, $time)
{
	global $db_id;

	$time=explode(":", $time);
	$query="select max(dueTime) from uup_queue where town=".$id;
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0]!="") 
		$date=strtotime("+ ".$time[0]." hours ".$time[1]." minutes", strtotime($row[0]));
	else 
		$date=strtotime("+ ".$time[0]." hours ".$time[1]." minutes");
	$date=strftime("%y-%m-%d %H:%M:%S", $date);
	$query="insert into uup_queue(town, unit, tree, dueTime) values(".$id.", ".$unit.", ".$tree.", '".$date."')";
	mysql_query($query, $db_id);
	$query="update towns set resources='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if (!$result) 
		msg("Hata!.".mysql_error());
}

function dispatch($town, $target, $type, $dueTime, $time, $qarmy, $army, $gen)
{
	global $db_id;

	$query="select max(id), count(*) from a_queue where town=".$town[0];
	$result=mysql_query($query, $db_id);
	$id=mysql_fetch_row($result);
	if ($id[1]) 
		$id=$id[0]+1; 
	else 
		$id=1;
	$query="insert into a_queue(town, target, id, type, phase, dueTime, army, general, uup, wup, aup, sent) values(".$town[0].", ".$target[0].", ".$id.", ".$type.", 0, '".$dueTime."', '".$qarmy."', '".$gen."', '".$town[17]."', '".$town[18]."', '".$town[19]."', '".$time."')";
	mysql_query($query, $db_id); $army=explode("-", $army);
	$ogen=explode("-", $town[15]); $gen=explode("-", $gen); 
	if (($gen[0])&&($type)) 
		$ogen[0]=0; 
	$ogen=implode("-", $ogen);
	$query="update towns set army='".implode("-", $army)."', general='".$ogen."', upkeep=".array_sum($army)." where id=".$town[0];
	$result=mysql_query($query, $db_id);
	if (!$result) 
		msg("Hata!.".mysql_error());
}

function pass($id, $pass)
{
	global $db_id;

	$query="update users set pass='".$pass."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		msg("�ifre ba�ar�yla de�i�tirildi!");
	else 
		msg("Hata!.".mysql_error());
}

function ban($name, $value)
{
	global $db_id;

	$query="update users set level='".$value."' where name='".$name."'";
	$result=mysql_query($query, $db_id);
	if ($result)
		if ($value) 
			msg("Ba�ar�l�!. '".$name."' isimli oyuncunun tipi ba�ar�yla de�i�tirildi!.");
		else 
			msg("Ba�ar�l�!. '".$name."' isimli oyuncunun tipi ba�ar�yla de�i�tirildi!.");
	else 
		msg("Hata!.".mysql_error());
}

function ch_capital($name, $usr_id)
{
	global $db_id;

	$usr=user($usr_id); $town=town_($name);
	if ($town[1]==$usr_id)
		if($town[0]) 
		{
			$query="select id from towns where isCapital=1 and owner=".$usr[0];
			$result=mysql_query($query, $db_id); $row=mysql_fetch_row($result);
			$query="update towns set isCapital=0 where id=".$row[0];
			mysql_query($query, $db_id);
			$query="update towns set isCapital=1 where id=".$town[0];
			$result=mysql_query($query, $db_id);
			if ($result) 
				msg(" '".$town[2]."' kabilesi ba�ar�yla ba�kent olarak de�i�tirildi!.");
			else 
				msg("Hata!.".mysql_error());
		}
		else 
			msg("Ba�ar�s�z...");
	else 
		msg("Bu kabile size ait de�il.");
}

function ch_lang($id, $lang)
{
	global $db_id;

	$query="update users set lang='".$lang."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function profile($id, $email, $desc, $sitter, $grpath, $lang)
{
	global $db_id;

	$query="update users set email='".$email."', description='".$desc."', sitter='".$sitter."', grPath='".$grpath."', lang='".$lang."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		msg("Profil ba�ar�yla g�ncellendi!.");
	else 
		msg("Hata!.".mysql_error());
}

function reg($name, $pass, $email, $faction)
{
	global $db_id;

	$query="insert into users(name, pass, email, level, joined, lastVisit, points, ip, faction) values('".$name."', '".$pass."', '".$email."', 1, now(), now(), 0, '".$_SERVER["REMOTE_ADDR"]."', ".$faction.")";
	$result=mysql_query($query, $db_id);
	if ($result) 
		msg("Tebrikler. �uanda '".$name."' olarak kay�t oldun. Hemen giri� yap�p kabileni olu�turabilirsin...<br><br><a href='guide.php'> Ba�lang�� rehberi</a>");
	else 
		msg("Hata!.".mysql_error());
}

function a_create($name, $founder)
{
	global $db_id;

	$query="select count(*) from alliances where name='".$name."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0]) 
	{ 
		msg("�sim al�nd�!.");
	}
	else
	{
		$query="insert into alliances(name, founder) values('".$name."', ".$founder.")";
		$result=mysql_query($query, $db_id);
		$query="select LAST_INSERT_ID()";
		$result=mysql_query($query, $db_id);
		$row=mysql_fetch_row($result);
		$query="update users set alliance=".$row[0].", rank='founder' where id=".$founder;
		$result=mysql_query($query, $db_id);
		if ($result) 
			return $row[0];
		else 
			msg("Hata.".mysql_error());
	}
}

function a_join($a_id, $usr_id)
{
	global $db_id;

	$query="select count(*) from reports where recipient=".$usr_id." and subject='Davet/".$a_id."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0])
	{
		$query="delete from reports where recipient=".$usr_id." and subject='Davet/".$a_id."'";
		mysql_query($query, $db_id);
		$query="update users set alliance=".$a_id.", rank='member' where id=".$usr_id;
		$result=mysql_query($query, $db_id);
		if ($result) 
			return 1;
	}
	else 
		return 0;
}

function a_quit($id)
{
	global $db_id;

	$query="update users set alliance=0 where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function a_del($id)
{
	global $db_id;

	$query="delete from alliances where id=".$id;
	$result=mysql_query($query, $db_id);
	$query="delete from pacts where a1=".$id." or a2=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function pact($type, $name, $id)
{
	global $db_id;
	$a2=alliance_($name);
	$a1=alliance($id);
	$usr=user($a1[2]);

	if (!$type)
	{
		if (send_report($a2[2], "Bar�� anla�mas� /".$a1[0]."-".$a2[0], " <a class='q_link' href='profile_view.php?id=".$a1[2]."'>".$usr[1]."</a> taraf�ndan kurulan <a class='q_link' href='a_view.php?id=".$a1[0]."'>".$a1[1]."</a> ittifa�� size bar�� anla�mas� �neriyor.</br></br>[ <a class='q_link' href='peace_.php?a1=".$a1[0]."&a2=".$a2[0]."'>Kabul!</a> ]")) 
			return 1;
		else 
			return 0;
	}
	else
	{
		$query="delete from pacts where type=0 and ((a1=".$a1[0]." and a2=".$a2[0].") or ((a1=".$a2[0]." and a2=".$a1[0].")))";
		mysql_query($query, $db_id);
		$query="insert into pacts(type, a1, a2) values(1, ".$a1[0].", ".$a2[0].")";
		$result=mysql_query($query, $db_id);
		if ($result) 
			return 1;
		else 
			return 0;
	}
	return 0;
}

function peace_($a1, $a2)
{
	global $db_id;
	$a1=alliance($a1);
	$a2=alliance($a2);

	$query="select count(*) from reports where recipient=".$a2[2]." and subject='Peace pact/".$a1[0]."-".$a2[0]."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if (!$row[0]) 
	{ 
		return 0;
	}
	$query="delete from pacts where type=1 and ((a1=".$a2[0]." and a2=".$a1[0].") or ((a1=".$a1[0]." and a2=".$a2[0].")))";
	mysql_query($query, $db_id);
	$query="delete from reports where recipient=".$a2[2]." and subject='Peace pact/".$a1[0]."-".$a2[0]."'";
	mysql_query($query, $db_id);
	$query="insert into pacts(type, a1, a2) values(0, ".$a1[0].", ".$a2[0].")";
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function dis_peace($a1, $a2)
{
	global $db_id;

	$query="delete from pacts where a1=".$a1." and a2=".$a2;
	$result=mysql_query($query, $db_id);
	if ($result) 
		return 1;
	else 
		return 0;
}

function o_accept($id, $seller, $sType, $sSubType, $bType, $bSubType, $res, $dueTime)
{
	global $db_id;

	if ($bType) 
		$bcol="weapons"; 
	else 
		$bcol="resources";
	$query="update t_queue set type=1, buyer=".$id.", dueTime='".$dueTime."' where seller=".$seller." and sType=".$sType." and sSubType=".$sSubType." and bType=".$bType." and bSubType=".$bSubType;
	$result=mysql_query($query, $db_id);
	$query="update towns set ".$bcol."='".$res."' where id=".$id;
	$result=mysql_query($query, $db_id);
	if ($result) 
		header("Location: marketplace.php?town=".$id);
	else 
		msg("Hata!.".mysql_error());
}

function create($owner, $name, $x, $y, $is_cap)
{
	global $db_id;

	$query="select count(*) from towns where name='".$name."'";
	$result=mysql_query($query, $db_id);
	$row=mysql_fetch_row($result);
	if ($row[0]) 
	{ 
		msg("�sim al�nd�!.");
	}
	else
	{
		$land=rand(1, 4);
		switch($land)
		{
			case 1: $land="0-0-0-0-0-0/0-0-0-0/0-0-0-0/0-0-0-0"; break;
			case 2: $land="0-0-0-0/0-0-0-0-0-0/0-0-0-0/0-0-0-0"; break;
			case 3: $land="0-0-0-0/0-0-0-0/0-0-0-0-0-0/0-0-0-0"; break;
			case 4: $land="0-0-0-0/0-0-0-0/0-0-0-0/0-0-0-0-0-0"; break;
		}

		$query="select subtype from map where ((x=".$x." and y=".($y-1).") or (x=".($x-1)." and y=".$y.") or (x=".$x." and y=".($y+1).") or (x=".($x+1)." and y=".$y.")) and type=0";
		$result=mysql_query($query, $db_id);
		$index=-1;
		while ($row=mysql_fetch_row($result)) 
			if ($row[0]>-1) 
				$index=$row[0];

		$query="insert into towns(owner, name, population, isCapital, morale, weapons, army, buildings, production, resources, limits, upkeep, land, general, water, uUpgrades, wUpgrades, aUpgrades, lastCheck) values(".$owner.", '".$name."', 2, ".$is_cap.", 100, '0-0-0-0-0-0-0-0-0-0-0', '0-0-0-0-0-0-0-0-0-0-0-0-0', '0-0-0-0-0-0-0-1-0-0-0-0-0-0-0-0-0-0-0-0-0-0', '15-6-6-6-0', '500-300-300-300-150', '600-400-200-20-100-0-0-0-0-0-0-0-0', 0, '".$land."', '0-0-0-0', ".$index.", '0-0-0-0-0-0-0-0-0-0-0-0-0', '0-0-0-0-0-0-0-0-0-0-0-0-0', '0-0-0-0-0-0-0-0-0-0-0-0-0', now())";
		mysql_query($query, $db_id);

		$query="select LAST_INSERT_ID()";
		$result=mysql_query($query, $db_id);
		$row=mysql_fetch_row($result);

		$query="update map set type=3, subtype=".$row[0]." where x=".$x." and y=".$y;
		mysql_query($query, $db_id);

		if (!$is_cap)
		{
			$towns=towns($_SESSION["user"][0]);
			$army=explode("-", $towns[0][7]); $army[11]-=100; $army=implode("-", $army);
			$query="update towns set army='".$army."', upkeep=upkeep-100 where id=".$towns[0][0];
			mysql_query($query, $db_id);
		}
		if ($result) 
			msg("Tebrikler, Kabileniz ba�ar�yla olu�turuldu...");
		else 
			msg("Hata!.".mysql_error());
	}
}

function install($name, $pass, $email, $faction)
{
	global $db_id;

	$query="insert into users(name, pass, email, level, joined, lastVisit, points, ip, grPath, faction) values('".$name."', '".$pass."', '".$email."', 5, now(), now(), 0, '".$_SERVER["REMOTE_ADDR"]."', 'default/', ".$faction.")";
	$result=mysql_query($query, $db_id);

	$handle = fopen ("map.dat","r") or die("Map.dat dosyas� a��lamad�!.");
	$ok=1;
	for ($i=0; $info[$i] = fscanf ($handle, "%i %i %i %i"); $i++)
	{
		if (!$info[$i][3])
		switch($info[$i][2])
		{
			case 1: $info[$i][3]=rand(1, 6); break;
			case 2: $info[$i][3]=rand(1, 4); break;
			default: ;
		}
		$query="insert into map(x, y, type, subtype) values (".$info[$i][0] .", ".$info[$i][1].", ".$info[$i][2].", ".$info[$i][3].")";
		$result=mysql_query($query, $db_id);	
		if (!$result) 
			$ok=0;
	}
	fclose($handle);
	if ($ok) 
		msg("Map.dat ba�ar�yla eklendi!");
	else 
		msg("Hata!.".mysql_error());
}
//chat fonksiyonlar�...
function send_chat($se, $sid, $msg, $re)
{
	global $db_id;

	$query="insert into chat (sId, timeStamp, message, recipient, sender) values (".$sid.", now(), '".$msg."', ".$re.", ".$se.")";
	mysql_query($query, $db_id);
}

function mute($id, $v)
{
	global $db_id;

	$query="update users set mute=".$v." where id=".$id;
	mysql_query($query, $db_id);
}

function get_chat($id, $sid, $lcheck, $span)
{
	global $db_id, $tdif;

	$query="delete from chat where hour(timediff(now(), timeStamp))>".($span/60)." or minute(timediff(now(), timeStamp))>".($span%60);
	$result=mysql_query($query, $db_id);
	$query="select message from chat where (sId=".$sid." and timeStamp>'".$lcheck."'".$tdif." and ((recipient=0 or recipient=".$id.") or sender=".$id.")) or (timeStamp>'".$lcheck."'".$tdif." and recipient=".$id.")";
	$result=mysql_query($query, $db_id);
	$msgs=array(); 
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$msgs[$i]=$row[0];
	return $msgs;
}

function chat_s()
{
	global $db_id;

	$query="select * from chat_s";
	$result=mysql_query($query, $db_id);
	$chat_s=array(); 
	for ($i=0; $row=mysql_fetch_row($result); $i++) 
		$chat_s[$i]=$row;
	return $chat_s;
}

function update_room($a, $ri, $rn)
{
	global $db_id;

	switch ($a)
	{
		case 1: $query="insert into chat_s (name) values ('".$rn."')"; break;
		case 2: $query="update chat_s set name='".$rn."' where id=".$ri; break;
		case 3: $query="delete from chat_s where id=".$ri; break;
		default: ;
	}
	mysql_query($query, $db_id);
}
//chat fonksiyonlar�n�n biti�i

?>