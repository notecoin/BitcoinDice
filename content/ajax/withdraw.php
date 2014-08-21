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

if (empty($_GET['amount']) || empty($_GET['valid_addr']) || empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();

$player=mysql_fetch_array(mysql_query("SELECT `id`,`balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

$validate=$wallet->validateaddress($_GET['valid_addr']);
if ($validate['isvalid']==false) {
  $error='yes';
  $con=0;
}
else {
  $player=mysql_fetch_array(mysql_query("SELECT `id`,`balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
  if (!is_numeric($_GET['amount']) || (double)$_GET['amount']>$player['balance'] || (double)$_GET['amount']<$settings['min_withdrawal']) {
    $error='yes';
    $con=1;
  }
  else {
    $amount=(double)$_GET['amount'];
    $txid=$wallet->sendtoaddress($_GET['valid_addr'],$amount);
    if ((string)$txid!='')
      mysql_query("UPDATE `players` SET `balance`=TRUNCATE(ROUND((`balance`-$amount),9),8) WHERE `id`=$player[id] LIMIT 1");    
    mysql_query("INSERT INTO `transactions` (`player_id`,`amount`,`txid`) VALUES ($player[id],(0-$amount),'$txid')");
    $error='no';
    $con=$txid;
  }
}
$return=array(
  'error' => $error,
  'content' => $con
);

echo json_encode($return);
?>