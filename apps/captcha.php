<?php 
include('../settings/config.php');
$code = randompass(6);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(65, 28);
$bg = imagecolorallocate($im, 0, 25, 20);
$fg = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>