<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` LIMIT 1"));

if ($settings['giveaway']!=1) exit();

session_start();
if (empty($_GET['captcha']) || md5(strtoupper($_GET['captcha']))!=$_SESSION['f_captcha']) {
  echo json_encode(array('success'=>'false'));
  exit();
}
if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' AND `balance`=0 LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

if (empty($_SESSION['last__'])) $_SESSION['last__']=(time()-($settings['giveaway_freq']))-1;
if ($_SESSION['last__']>=(time()-($settings['giveaway_freq']))) {
  echo json_encode(array('success'=>'timenot'));
  exit();
}                  
else $_SESSION['last__']=time();


mysql_query("UPDATE `players` SET `balance`=$settings[giveaway_amount] WHERE `id`=$player[id] LIMIT 1");

echo json_encode(array('success'=>'true'));

?>