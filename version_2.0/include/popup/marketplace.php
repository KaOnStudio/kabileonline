<?php
	include "../ronarazoro.php";

	if (isset($_SESSION["user"][0], $_GET["town"]))
	{
		$_GET["town"] = clean($_GET["town"]);
		check_r($_GET["town"]);
		check_t($_GET["town"]);
		$town = town($_GET["town"]); 
		if ($town[1]!=$_SESSION["user"][0]) {
			git('../../index.php'); die();
		}
		$faction = faction($_SESSION["user"][10]); $r = $faction[3];
		$buildings = buildings($_SESSION["user"][10]);
		$weapons = weapons($_SESSION["user"][10]);
		$merchants = get_tr($_GET["town"]);
		$tq = get_t($_GET["town"]);
		$c_status = get_con($_GET["town"]);

		$data = explode("-", $town[8]); $res=explode("-", $town[10]); $prod=explode("-", $town[9]); $lim=explode("-", $town[11]);
		$goods[0][0]="Tahıl"; $goods[0][1]="Odun"; $goods[0][2]="Taş"; $goods[0][3]="Demir"; $goods[0][4]="Altın";
		for ($i=0; $i<count($weapons); $i++) $goods[1][$i]=$weapons[$i][2];
	}
	else {
		git('../../index.php'); die();
	}
		
		if ($data[10])
		{
			echo "<script type='text/javascript'> inittabs(); var data=new Array(10); "; for ($i=0; $i<(count($weapons)-1); $i++) echo "data[".$i."]='".$weapons[$i][2]."'; "; echo "</script>";
			echo "<b>".$lang['availMerchants'].": ".($data[10]-$merchants)."/".$data[10]."</b>";
			?>
			<hr /><table style='text-align:center; margin-left:100px;'><tr><td>
			<ul id='tabs'>
				<li><a href='#sendTransport'><?php echo $lang['sendTransport']; ?></a></li>
				<li><a href='#sellNpc'><?php echo $lang['sellNpc']; ?></a></li>
				<li><a href='#sell'><?php echo $lang['sell']; ?></a></li>
				<li><a href='#buy'><?php echo $lang['buy']; ?></a></li>
			</ul>
			<div class='tabContent' id='sendTransport'>
				<div>
					<table class='q_table' style='border:none;' width='400'>
						<tr>
							<td>
								<form name='form0' method='post' action='trade.php?town=<?php echo $_GET["town"]; ?>&type=1'><br />
									<p align='center'><b><?php echo $lang['send']; ?></b></p>
									<p align='center'><input type='text' name='sQ' size='5' maxlength='5' value='0'>
										<select class='dropdown' name='sType' id='sType0' onchange="javascript: trade_options('sType0', 'sSubType0', data);">
											<option value='0'><?php echo $lang['resources']; ?></option>
											<option value='1'><?php echo $lang['goods']; ?></option>
										</select> 
										<span id='sSubType0'>
											<select class='dropdown' name='sSubType'>
												<option value='0'><?php echo $lang['crop']; ?></option>
												<option value='1'><?php echo $lang['lumber']; ?></option>
												<option value='2'><?php echo $lang['stone']; ?></option>
												<option value='3'><?php echo $lang['iron']; ?></option>
												<option value='4'><?php echo $lang['gold']; ?></option>
											</select>
										</span>
									</p><br />
									<p align='center'><b><?php echo $lang['townName']; ?></b></p>
									<p align='center'><input type='text' name='name'><input type='hidden' name='maxTime' value='0'></p><br />
									<p align='center'><input type='submit' style="width:100px; height:30px;" name='button0' value='<?php echo $lang['send']; ?>'></p>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class='tabContent' id='sellNpc'>
				<div>
					<table class='q_table' style='border:none;' width='400'>
						<tr>
							<td>
								<form name='form11' method='post' action='npc_trade.php?town=<?php echo $_GET["town"]; ?>'><br />
									<p align='center'><b><?php echo $lang['sell']; ?></b></p>
									<p align='center'><input type='text' name='sQ' size='5' maxlength='5' value='0'> 
										<select class='dropdown' name='sSubType'>
											<option value='0'><?php echo $lang['crop']; ?></option>
											<option value='1'><?php echo $lang['lumber']; ?></option>
											<option value='2'><?php echo $lang['stone']; ?></option>
											<option value='3'><?php echo $lang['iron']; ?></option>
											<option value='4'><?php echo $lang['gold']; ?></option>
										</select>
									</p><br />
									<p align='center'><b><?php echo $lang['buy']; ?></b></p>
									<p align='center'>
										<select class='dropdown' name='bSubType'>
											<option value='0'><?php echo $lang['crop']; ?></option>
											<option value='1'><?php echo $lang['lumber']; ?></option>
											<option value='2'><?php echo $lang['stone']; ?></option>
											<option value='3'><?php echo $lang['iron']; ?></option>
											<option value='4'><?php echo $lang['gold']; ?></option>
										</select>
									</p><br />
									<p align='center'><input type='submit' style="width:100px; height:30px;" name='button11' value='<?php echo $lang['sellNpc']; ?>'></p>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class='tabContent' id='sell'>
				<div>
					<table class='q_table' style='border:none;' width='400'>
						<tr>
							<td>
								<form name='form1' method='post' action='trade.php?town=<?php echo $_GET["town"]; ?>&type=0'><br />
									<p align='center'><b><?php echo $lang['sell']; ?></b></p>
									<p align='center'><input type='text' name='sQ' size='5' maxlength='5' value='0'>
										<select class='dropdown' name='sType' id='sType1' onchange="javascript: trade_options('sType1', 'sSubType1', data);">
											<option value='0'><?php echo $lang['resources']; ?></option>
											<option value='1'><?php echo $lang['goods']; ?></option>
										</select> 
										<span id='sSubType1'>
											<select class='dropdown' name='sSubType'>
												<option value='0'><?php echo $lang['crop']; ?></option>
												<option value='1'><?php echo $lang['lumber']; ?></option>
												<option value='2'><?php echo $lang['stone']; ?></option>
												<option value='3'><?php echo $lang['iron']; ?></option>
												<option value='4'><?php echo $lang['gold']; ?></option>
											</select>
										</span>
									</p><br />
									<p align='center'><b><?php echo $lang['buy']; ?></b></p>
									<p align='center'><input type='text' name='bQ' size='5' maxlength='5' value='0'><input type='hidden' name='maxTime' value='0'>
										<select class='dropdown' name='bType' id='bType1' onchange="javascript: trade_options('bType1', 'bSubType1', data);">
											<option value='0'><?php echo $lang['resources']; ?></option>
											<option value='1'><?php echo $lang['goods']; ?></option>
										</select> 
										<span id='bSubType1'>
											<select class='dropdown' name='bSubType'>
												<option value='0'><?php echo $lang['crop']; ?></option>
												<option value='1'><?php echo $lang['lumber']; ?></option>
												<option value='2'><?php echo $lang['stone']; ?></option>
												<option value='3'><?php echo $lang['iron']; ?></option>
												<option value='4'><?php echo $lang['gold']; ?></option>
											</select>
										</span>
									</p><br />
									<p align='center'><input type='submit' style="width:100px; height:30px;" name='button1' value='<?php echo $lang['postOffer']; ?>'></p>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class='tabContent' id='buy'>
				<div>
					<table class='q_table' style='border:none;' width='400'>
						<tr>
							<td>
								<form name='form2' method='post' action='offers.php?town=<?php echo $_GET["town"]; ?>&page=0'><br />
									<p align='center'><b><?php echo $lang['buy']; ?></b></p>
									<p align='center'>
										<select class='dropdown' name='sType' id='sType2' onchange="javascript: trade_options('sType2', 'sSubType2', data);">
											<option value='0'><?php echo $lang['resources']; ?></option>
											<option value='1'><?php echo $lang['goods']; ?></option>
										</select> 
										<span id='sSubType2'>
											<select class='dropdown' name='sSubType'>
												<option value='0'><?php echo $lang['crop']; ?></option>
												<option value='1'><?php echo $lang['lumber']; ?></option>
												<option value='2'><?php echo $lang['stone']; ?></option>
												<option value='3'><?php echo $lang['iron']; ?></option>
												<option value='4'><?php echo $lang['gold']; ?></option>
											</select>
										</span>
									</p><br />
									<p align='center'><b><?php echo $lang['sell']; ?></b></p>
									<p align='center'>
										<select class='dropdown' name='bType' id='bType2' onchange="javascript: trade_options('bType2', 'bSubType2', data);">
											<option value='0'><?php echo $lang['resources']; ?></option>
											<option value='1'><?php echo $lang['goods']; ?></option>
										</select> 
										<span id='bSubType2'>
											<select class='dropdown' name='bSubType'>
												<option value='0'><?php echo $lang['crop']; ?></option>
												<option value='1'><?php echo $lang['lumber']; ?></option>
												<option value='2'><?php echo $lang['stone']; ?></option>
												<option value='3'><?php echo $lang['iron']; ?></option>
												<option value='4'><?php echo $lang['gold']; ?></option>
											</select>
										</span>
									</p><br />
									<p align='center'><input style="width:60px; height:25px;" type='submit' name='button2' value='<?php echo $lang['find']; ?>'> || 
									<a class='q_link' href='offers_all.php?town=<?php echo $_GET["town"]; ?>&page=0'><?php echo $lang['viewAll']; ?></a></p>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div>
			</td></tr></table><br /><br /><hr /><br /><br />
			<?php
		}
		if ($data[10])
		{
			if (!$c_status[10])
			{
				if ($data[10]<10)
				{
					echo "<table style='text-align:center; margin-left:175px;'><tr><td>";
					
					$dur=explode("-", $buildings[10][6]); 
					$upk=explode("-", $buildings[10][7]); 
					$cost=explode("-", $buildings[10][4]); 
					$dur[$data[10]]=explode(":", $dur[$data[10]]);
					
					$tag="<a class='q_link' href='build.php?town=".$town[0]."&b=".$buildings[10][0]."&subB=-1'>".$lang['upgrade']." ".$buildings[10][2]." ".$lang['toLevel']." ".($data[10]+1)."</a>";
					$tag=$tag."</br>".$lang['cost'].": <img src='".$imgs.$fimgs."00.gif' title='".$lang['crop']."'>".floor($cost[0]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."01.gif' title='".$lang['lumber']."'>".floor($cost[1]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."02.gif' title='".$lang['stone']."'>".floor($cost[2]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."03.gif' title='".$lang['iron']."'>".floor($cost[3]*pow($r, $data[10]))." <img src='".$imgs.$fimgs."04.gif' title='".$lang['gold']."'>".floor($cost[4]*pow($r, $data[10]))."</br>".$lang['duration'].": ".($dur[$data[10]][0]*$lim[4]/100).":".($dur[$data[10]][1]*$lim[4]/100)."</br>".$lang['upkeep'].": ".$upk[$data[10]];
					
					echo $tag;
					
					if ($town[12]+$town[3]+$upk[$data[10]]>$lim[3]) echo("</br>".$lang['noHouses']);
					if (!(($res[0]>=$cost[0]*pow($r, $data[10]))&&($res[1]>=$cost[1]*pow($r, $data[10]))&&($res[2]>=$cost[2]*pow($r, $data[10]))&&($res[3]>=$cost[3]*pow($r, $data[10]))&&($res[4]>=$cost[4]*pow($r, $data[10])))) echo("</br>".$lang['noResources']);
					echo "</td></tr></table></br></br><hr /></br></br>";
				}
				else echo "</br></br></br></br><b>".$lang['buildingMaxLvl']."</b></br></br>";
			}
			else echo "</br></br></br></br><b>".$lang['beingUpgraded']."</b></br></br>";
		}
		else echo "</br></br></br></br><b>".$lang['constrBuilding']."</b></br></br>";
		///////////////////////////////////////////////////////7///////////////////////////////////////////////////////7
		
		if (count($tq[0])-1) echo $lang['ownOffers'].":</br>";
		for ($i=0; $i<count($tq[0])-1; $i++) 
			echo "[<a class='q_link' href='cancel_t.php?town=".$_GET["town"]."&sType=".$tq[0][$i][0]."&sSubType=".$tq[0][$i][1]."&bType=".$tq[0][$i][3]."&bSubType=".$tq[0][$i][4]."'>x</a>] ".$tq[0][$i][2]." ".$goods[$tq[0][$i][0]][$tq[0][$i][1]]." for ".$tq[0][$i][5]." ".$goods[$tq[0][$i][3]][$tq[0][$i][4]]."</br>";
			
		///////////////////////////////////////////////////////7///////////////////////////////////////////////////////7
		
		if (count($tq[1])-1) echo $lang['ownAcceptedOffers'].":</br>"; $nr=0;
		for ($i=0; $i<count($tq[1])-1; $i++)
		{
			$sourceTown=town($tq[1][$i][3]);
			echo $tq[1][$i][7]." ".$goods[$tq[1][$i][5]][$tq[1][$i][6]]." to and ".$tq[1][$i][2]." ".$goods[$tq[1][$i][0]][$tq[1][$i][1]]." from ".$sourceTown[2]." in <span id='own_".$i."'>".$tq[1][$i][4]."</span><script type='text/javascript'> var id=new Array(50); timer('own_".$i."', 'marketplace.php?town=".$_GET["town"]."'); </script></br>";
			$nr++;
		}
		
		///////////////////////////////////////////////////////7///////////////////////////////////////////////////////7
		
		if (count($tq[2])-1) echo $lang['otherOffers'].":</br>";
		for ($i=0; $i<count($tq[2])-1; $i++)
		{
			$sourceTown=town($tq[2][$i][3]);
			echo $tq[2][$i][7]." ".$goods[$tq[2][$i][5]][$tq[2][$i][6]]." ".$lang['toAnd']." ".$tq[2][$i][2]." ".$goods[$tq[2][$i][0]][$tq[2][$i][1]]." ".$lang['from']." ".$sourceTown[2]." ".$lang['in']." <span id='other_".$nr."'>".$tq[2][$i][4]."</span><script type='text/javascript'> var id=new Array(50); timer('other_".$i."', 'marketplace.php?town=".$_GET["town"]."'); </script></br>";
			$nr++;
		}
		
		///////////////////////////////////////////////////////7///////////////////////////////////////////////////////7
?>

