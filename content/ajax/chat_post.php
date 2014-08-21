<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

if (empty($_GET['con'])) exit();

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

$alone=true;
$lastTen=mysql_query("SELECT * FROM `chat` ORDER BY `time` DESC LIMIT 10");
if (mysql_num_rows($lastTen)<10) $alone=false;
else {
  while ($each=mysql_fetch_array($lastTen)) {
    if ($each['sender']!=$player['id']) {
      $alone=false;
      break;
    }
  }
}
if ($alone) {
  echo json_encode(array('success'=>false));
  exit();
}


mysql_query("INSERT INTO `chat` (`sender`,`content`) VALUES ($player[id],'".substr(prot($_GET['con']),0,500)."')");

echo json_encode(array('success'=>true));
?>