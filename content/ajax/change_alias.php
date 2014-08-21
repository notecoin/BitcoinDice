<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['alias']) || empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();

if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `alias`='".prot($_GET['alias'])."' LIMIT 1"))!=0) {
  echo json_encode(array('error'=>'yes','content'=>'This alias is alredy taken :-('));
  exit();
}
if (strlen(prot($_GET['alias']))<3) {
  echo json_encode(array('error'=>'yes','content'=>'Alias can not be shorter than 3 characters!'));
  exit();
}

mysql_query("UPDATE `players` SET `alias`='".prot($_GET['alias'])."' WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1");

echo json_encode(array('error'=>'no','content'=>true));
?>