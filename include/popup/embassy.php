<?php 
	include "../ronarazoro.php";
	
	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		$_SESSION["user"] = user($_SESSION["user"][0]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$buildings = buildings($_SESSION["user"][10]);
		if ($_SESSION["user"][11]) 
			$alliance = alliance_all($_SESSION["user"][11]);
		if ((isset($alliance))&&(!$alliance[0][0])) 
		{
			a_quit($_SESSION["user"][0]); 
			$_SESSION["user"][11]=0;
		}

		$data=explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]);
	}
	else {
		git('../../index.php'); die();
	}
		
		if ($data[9])
		{
			echo "<script type='text/javascript'> inittabs(); </script>";
			if (!$_SESSION["user"][11]) { ?>
				<br /><br /><hr /><br /><br /><table style='text-align:center; margin-left:175px;'><tr><td>
				<form name='form1' method='post' action='a_create.php?town=<?php echo $_GET["town"]; ?>'>
				<b><?php echo $lang['allyName']; ?> :</b>
				<input type='text' name='name'>
				<input type='submit' name='button1' value='<?php echo $lang['create']; ?>' style="width:100px; height:30px;">
				</form></td></tr></table><br /><br /><hr /><br /><br />				
				<?php
			}
			else if ($alliance[0][2]==$_SESSION["user"][0]) //ittifak lideri
			{
				echo "<hr /><br /><table style='text-align:center; margin-left:100px;'><tr><td>";
				//echo "[ <a class='q_link' href='rank_edit.php'>".$lang['editRanks']."</a> ]<br />";
				
				echo "<b><u>".$lang['members']."</u></b><br /><table style='margin-left:150px;'>";
				for ($i=0; $i<count($alliance[1])-1; $i++) 
					echo "<tr><td>[<a class='q_link' href='a_kick.php?id=".$alliance[1][$i][0]."'>x</a>]</td><td style='width:100px;'>&nbsp;&nbsp;<a class='q_link' href='profile_view.php?id=".$alliance[1][$i][0]."'>".$alliance[1][$i][1]."</a></td><td style='width:100px;'>".$alliance[1][$i][14]."</td></tr>";
				echo "</table><br />";
				
				echo "<b><u>".$lang['peacePacts']."</u></b><br />";
				if(count($alliance[2]) > 1)
					for ($i=0; $i<count($alliance[2])-1; $i++) {
						$a1=alliance($alliance[2][$i][1]);
						$a2=alliance($alliance[2][$i][2]);
						echo "[<a class='q_link' href='dis_peace.php?a1=".$a1[0]."&a2=".$a2[0]."'>x</a>] ".$a1[1]."-".$a2[1]."<br />";
					}
				else echo "-yok-";
					
				echo "<br /><br /><b><u>".$lang['warDecs']."</u></b><br />";
				if(count($alliance[3]) > 1)
					for ($i=0; $i<count($alliance[3])-1; $i++){
						$a1=alliance($alliance[3][$i][1]);
						$a2=alliance($alliance[3][$i][2]);
						echo $a1[1]."-".$a2[1]."<br />";
					}
				else echo "-yok-";
				
				?>
				<ul id='tabs'>
						<li><a href='#invite'><?php echo $lang['invite']; ?></a></li>
						<li><a href='#proposePeace'><?php echo $lang['proposePeace']; ?></a></li>
						<li><a href='#decWar'><?php echo $lang['decWar']; ?></a></li>
						<li><a href='#allyName'><?php echo $lang['allyName']; ?></a></li>
						<li><a href='#delAlly'><?php echo $lang['delAlly']; ?></a></li>
				</ul>
				<div class='tabContent' id='invite'>
					<div>
						<table class='q_table' style='border:none;' width='440'>
							<tr>
								<td>
									<form name='form2' method='post' action='invite.php?town=<?php echo $_GET["town"]; ?>'>
										<p><b><?php echo $lang['playerName']; ?></b> :
											<input type='text' name='name'>
											<input type='submit' style="width:100px; height:30px;" name='button2' value='<?php echo $lang['invite']; ?>'>
										</p>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class='tabContent' id='proposePeace'>
					<div>
						<table class='q_table' style='border:none;' width='440'>
							<tr>
								<td>
									<form name='form3' method='post' action='pact.php?type=0&town=".$_GET["town"]."'>
										<p><b><?php echo $lang['allyName']; ?></b> :
											<input type='text' name='name'>
											<input type='submit' style="width:100px; height:30px;" name='button3' value='<?php echo $lang['proposePeace']; ?>'>
										</p>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class='tabContent' id='decWar'>
					<div>
						<table class='q_table' style='border:none;' width='440'>
							<tr>
								<td>
									<form name='form4' method='post' action='pact.php?type=1&town=<?php echo $_GET["town"]; ?>'>
										<p><b><?php echo $lang['allyName']; ?></b> :
											<input type='text' name='name'>
											<input type='submit' style="width:100px; height:30px;" name='button4' value='<?php echo $lang['decWar']; ?>'>
										</p>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class='tabContent' id='allyName'>
					<div>
						<table class='q_table' style='border:none; margin-left:20px;' width='440'>
							<tr>
								<td>
									<form name='form5' method='post' action='a_edit.php?town=<?php echo $_GET["town"]; ?>'>
										<p><b><?php echo $lang['allyName']; ?></b> : </p>
										<p><input type='text' style="width:300px;" name='name' value='<?php echo $alliance[0][1]; ?>'></p><br />
										<p><b><?php echo $lang['allyDesc']; ?></b> : </p>
										<p><textarea name='desc' style="width:300px; height:100px;"><?php echo $alliance[0][3]; ?></textarea></p>
										<p><input type='submit' style="width:100px; height:30px; margin-left:100px;" name='button5' value='<?php echo $lang['save']; ?>'></p>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class='tabContent' id='delAlly'>
					<div>
						<table class='q_table' style='border:none;' width='440'>
							<tr>
								<td>
									<form name='form6' method='post' action='a_del.php'>
										<p><b>Şifren</b> :
											<input type='password' name='pass'>
											<input type='submit' style="width:100px; height:30px;" name='button6' value='<?php echo $lang['delAlly']; ?>'>
										</p>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</td></tr></table><br /><br /><hr /><br /><br />	
				<?php
			}
			else
			{
				echo "<hr /><br /><table style='text-align:center; margin-left:100px;'><tr><td>";
				//echo "[ <a class='q_link' href=\"javascript: template('forums.php?town=".$town[0]."&forum=0', '', '')\">".$lang['forum']."</a> ]";
				
				echo "<b><u>".$lang['members']."</u></b><br /><table style='margin-left:150px;'>";
				for ($i=0; $i<count($alliance[1])-1; $i++) 
					echo "<tr><td style='width:100px;'>&nbsp;&nbsp;<a class='q_link' href='profile_view.php?id=".$alliance[1][$i][0]."'>".$alliance[1][$i][1]."</a></td><td style='width:100px;'>".$alliance[1][$i][14]."</td></tr>";
				echo "</table><br />";
				
				echo "<b><u>".$lang['peacePacts']."</u></b><br />";
				if(count($alliance[2]) > 1)
					for ($i=0; $i<count($alliance[2])-1; $i++) {
						$a1=alliance($alliance[2][$i][1]);
						$a2=alliance($alliance[2][$i][2]);
						echo $a1[1]."-".$a2[1]."<br />";
					}
				else echo "-yok-";
					
				echo "<br /><br /><b><u>".$lang['warDecs']."</u></b><br />";
				if(count($alliance[3]) > 1)
					for ($i=0; $i<count($alliance[3])-1; $i++){
						$a1=alliance($alliance[3][$i][1]);
						$a2=alliance($alliance[3][$i][2]);
						echo $a1[1]."-".$a2[1]."<br />";
					}
				else echo "-yok-";
				
				?>
				<ul id='tabs'>
					<li><a href='#allyName'><?php echo $lang['allyName']; ?></a></li>
					<li><a href='#quitAlly'><?php echo $lang['quitAlly']; ?></a></li>
				</ul>
				<div class='tabContent' id='allyName'>
					<div>
						<table class='q_table' style='border:none;' width='440'>
							<tr>
								<td>
									<br />
									<p><?php echo "<b>".$lang['allyName']."</b> : ".$alliance[0][1]; ?></p>
									<p><?php echo "<b>".$lang['allyDesc']."</b> : ".$alliance[0][3]; ?></p>
									<br />
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class='tabContent' id='quitAlly'>
					<div>
						<table class='q_table' style='border:none; text-align: center' width='440'>
							<tr>
								<td>
									<br />
									<form name='form7' method='post' action='a_quit.php'>
										<p><input type='submit' style="width:100px; height:30px;" name='button7' value='<?php echo $lang['quitAlly']; ?>'></p>
									</form>
									<br />
								</td>
							</tr>
						</table>
					</div>
				</div>
				</td></tr></table><br /><br /><hr /><br /><br />
				<?php
			}
		}
		else echo "<br /><br /><br /><br /><b>".$lang['constrBuilding']."</b><br /><br />";
?>
	        