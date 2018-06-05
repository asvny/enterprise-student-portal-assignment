<?php
  // Based on this tutorial https://www.sitepoint.com/simple-captchas-php-gd/
  include("../session.php");
  
  $captcha_image = imagecreatetruecolor(120, 30);
  
  $background = imagecolorallocate($captcha_image, 0, 0, 0);
  imagefill($captcha_image, 0, 0, $background);
  
  $linecolor = imagecolorallocate($captcha_image, 200, 120, 320);
  $textcolor = imagecolorallocate($captcha_image, 255, 255, 255);
  
  for ($i = 0; $i < 5; $i++) {
      imagesetthickness($captcha_image, rand(1, 2));
      imageline($captcha_image, 0, rand(0, 24), 120, rand(0, 24), $linecolor);
  }
  
  $captcha = '';
  
  for ($i = 12; $i <= 120; $i += 24) {
      $captcha = $captcha . ($num = rand(0, 9));
      imagechar($captcha_image, rand(2, 8), $i, rand(4, 6), $num, $textcolor);
  }
  
  $_SESSION['captchaValue'] = $captcha;
  
  header('Content-type: image/png');
  
  imagepng($captcha_image);
  imagedestroy($captcha_image);
?>