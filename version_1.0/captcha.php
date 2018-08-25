<?php
session_start();
$img=imagecreatetruecolor(120,80);
$white=imagecolorallocate($img,255,255,255);
imagettftext($img, 20, rand(0, 90), 30, 70, $white, "arial.ttf", $_SESSION["code"]);
header('Content-type: image/gif');
imagegif($img);
imagedestroy($img);
?>
