<?php include "antet.php"; include "func.php";

$gen_stats=gen_stats(48);
?>
<html>
<?php echo "<link rel='stylesheet' type='text/css' href='".$imgs.$fimgs."default.css'>"; ?>
<head>
<title><?php echo $title; ?> - credits</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
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
        <td class="td_content"><p style="color:#C00">Ana Kadro : </p>
        <p><u><b>Ibrahim BILGE</b></u> (AkjmgalP)</p>
        <p><u><b>Hasan URAL</b></u> (Metalsimyaci) </p><br/>
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