<?php include "antet.php"; include "func.php"; ?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
if (isset($_POST["x"], $_POST["y"])) {$x=clean($_POST["x"]); $y=clean($_POST["y"]);}
else {$x=rand(0, $m); $y=rand(0, $n);}
$data=map($x, $y);
$i=0;
?>
     <div align="left">
        <label>
        <?php echo $lang['jumpTo'] ?>:
          <input class='textbox' type="text" id="x" size="2" value="<?php echo $x; ?>">
        </label>
        <input class='textbox' type="text" id="y" size="2" value="<?php echo $y; ?>">
        <label>
        <input class='button' type="button" onClick="map()" value="<?php echo $lang['go'] ?>">
        </label></br>
								<label id='xmenu'>-</label>
     <div style='position:relative;top:30px;left:0px;'>
<?php
for ($k = 3; $k >= -3; $k--)
{
   $st_x = ($k + 3) * 40;
   $st_y = (3 - $k) * 20;
?>
       <div style='position:absolute;left:<?php echo $st_x; ?>px;top:<?php echo $st_y; ?>px;width:50px;'><?php echo $y+$k; ?></div>
<?php
}
for ($j = -3; $j <= 3; $j++)
{
      $st_x = ($j + 3) * 40;
      $st_y = 160 + ($j + 3) * 20;
?>

        <div style='position:absolute;left:<?php echo $st_x; ?>px;top:<?php echo $st_y; ?>px;width:50px;'><?php echo $x+$j; ?></div>
<?php
}
?>
     </div>
       <div style="position:relative; top:0; left:20;">
<?php
for ($k = 3; $k >= -3; $k--)
{
   for ($j = -3; $j <= 3; $j++)
   {
      $st_x = ($k + 3) * 40 + ($j + 3) * 40;
      $st_y = (3 - $k) * 20 + ($j + 3) * 20;
?>
        <img style='position:absolute;left:<?php echo $st_x; ?>px;top:<?php echo $st_y; ?>px;width:80px;height:80px;' <?php map_img($data, $x+$j, $y+$k, $i, $imgs); ?>>
<?php
   }
}
?>
        <img src="<?php echo $imgs ?>map/map_back.gif" border="0" usemap="#Map" style='position:absolute;left:0px;top:41px;width:560px;height:280px;'>
        <map name="Map" id="Map">
<?php
$i = 0;
for ($k = 3; $k >= -3; $k--)
{
   for ($j = -3; $j <= 3; $j++)
   {
      $st_x = ($k + 3) * 40 + ($j + 3) * 40;
      $st_y = (3 - $k) * 20 + ($j + 3) * 20;
      $coords = ($st_x + 40) . ',' . $st_y . ',' . ($st_x + 80) . ',' . ($st_y + 20) . ',' . ($st_x + 40) . ',' . ($st_y + 40) . ',' . $st_x . ',' . ($st_y + 20);
?>
          <area shape="poly" coords='<?php echo $coords; ?>' <?php map_lnk($data, $x+$j, $y+$k, $i); ?>>
<?php
   }
}
?>

          <area shape="circle" coords='482,38,15' href="javascript: template('map_.php', '<?php echo "x=".$x."&y=".($y+1); ?>')" title="<?php echo $lang['North']; ?>">
          <area shape="circle" coords='77,241,15' href="javascript: template('map_.php', '<?php echo "x=".$x."&y=".($y-1); ?>')" title="<?php echo $lang['South']; ?>">
          <area shape="circle" coords='482,241,15' href="javascript: template('map_.php', '<?php echo "x=".($x+1)."&y=".$y; ?>')" title="<?php echo $lang['East']; ?>">
          <area shape="circle" coords='77,38,15' href="javascript: template('map_.php', '<?php echo "x=".($x-1)."&y=".$y; ?>')" title="<?php echo $lang['West']; ?>">
        </map>
        </div>
      <div id="descriptor" style="position:relative; top:-25; left:370;">
          <table class="q_table_desc" style="border-collapse: collapse" width="250" border="1">
            <tr>
              <td colspan="2" align="center"><?php echo $lang['description'] ?>
            </tr>
            <tr>
              <td width="117" align="center"><?php echo $lang['player'] ?><td></td>
            </tr>
            <tr>
              <td width="117" align="center"><?php echo $lang['population'] ?><td></td>
            </tr>
            <tr>
              <td width="117" align="center"><?php echo $lang['alliance'] ?><td></td>
            </tr>
          </table>
      </div>
