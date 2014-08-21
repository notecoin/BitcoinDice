<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$balance=mysql_fetch_array(mysql_query("SELECT `balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
$balance_=sprintf("%.8f",$balance['balance']);
$return=array(
  'balance' => $balance_
);
echo json_encode($return);
?>