<?php include "antet.php"; include "func.php";

$gen_stats=gen_stats(48);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>

<head>
<title><?php echo $title; ?> - features</title>
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
		<p>
1. Create your own capital anywhere you wish on the map. Later on, you can create other colonies to expand your ever growing empire.</br></br>
2. Upgrade buildings to build a balanced economy that will later on support you and your allies.</br></br>
3. Forge weapons that you can use to train units, or sell them for resources or other goods.</br></br>
4. Create or join existing alliances; declare war, make peace, all for you to define a political plan for world domination/peace.</br></br>
5. Train enourmous armies to defend your borders or to conquer and expand your empire.</br></br>
6. Stay in touch with all players via the integrated message system or by crating a forum for your alliance on the official website forums.</br></br>
Access the <a class='q_link' href='/forum/'>forum</a> for support and further game details.
		</p>
        </td>
      </tr>
      <tr>
        <td class="td_bottom_menu">
          <?php menu_down(); ?>
        </td>
      </tr>
    </table>
<?php echo $bottom_ad; ?>
<p><?php about(); ?></div>

</body>

</html>