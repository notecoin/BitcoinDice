<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

$new_addr=$wallet->getnewaddress();
mysql_query("INSERT INTO `deposits` (`player_id`,`address`) VALUES ($player[id],'$new_addr')");

echo json_encode(array('confirmed'=>$new_addr));
?>