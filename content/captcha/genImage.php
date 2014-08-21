<?php
/*
 *  © BitcoinDice 


 
*/
	
  
session_start();
$possibilities='ABCDEFGHIJKLMNPQRSTUVWXYZ112233445566778899';
$randomnr='';
for ($i=0;$i<4;$i++)    
  $randomnr.=substr($possibilities,rand(0,(strlen($possibilities)-1)),1);
$_SESSION['f_captcha']=md5($randomnr);
$im=imagecreatetruecolor(150,50);
$white=imagecolorallocate($im,255,255,255);
$grey=imagecolorallocate($im,128,128,128);
$black=imagecolorallocate($im,0,0,0); 
imagefilledrectangle($im,0,0,200,35,$black);
$font='./font/captcha-font.ttf';
imagettftext($im,35,2,22,45,$grey,$font,$randomnr);
imagettftext($im,35,2,15,42,$white,$font,$randomnr);
header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");
header ("Content-type: image/gif");
imagegif($im);
imagedestroy($im);

?>