<?php
  //include_once('captchatext.php');

  $pass_phrase = "";
  for ($i = 0; $i < 6; $i++) {
    $pass_phrase .= chr(rand(97, 122));
    }
    setcookie('captcha',$pass_phrase,time()+3600*24*30);
    
  

  $img = imagecreatetruecolor(100, 40);

  $bg_color = imagecolorallocate($img, 211, 211, 211);     // white
  $text_color = imagecolorallocate($img, 0, 0, 0);         // black
  $graphic_color = imagecolorallocate($img, 64, 64, 64);   // dark gray

  imagefilledrectangle($img, 0, 0, 100, 40, $bg_color);
  for ($i = 0; $i < 5; $i++) {
    imageline($img, 0, rand()%40, 100, rand() %40, $graphic_color);
  }

  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($img, rand() % 100, rand() % 40, $graphic_color);
  }
  imagettftext($img, 20, 0, 10, 30, $text_color, 'fonts/arial.ttf', $pass_phrase);
  header("Content-type: image/png");
  imagepng($img);

  imagedestroy($img);
?>
