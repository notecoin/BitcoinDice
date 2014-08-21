<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['pass']) || empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id`,`password` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

mysql_query("UPDATE `players` SET `password`='' WHERE `id`=$player[id] LIMIT 1");
echo json_encode(array('status'=>true));
?>