<?
session_start();
header ("Content-type: image/png");
$image = imagecreatetruecolor(200, 50);
$first_number = rand(0, 9);
$second_number = rand(0, 9);
$_SESSION['captcha'] = $first_number + $second_number;
$text_color1 = imagecolorallocate($image, 0, 160, 0);
$text_color2 = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, 85, 15, "$first_number+$second_number", $text_color1);
imagestring($image, 5, 83, 17, "$first_number+$second_number", $text_color2);
imagepng($image);
