<?php
/*
 *  © BitcoinDice 


 
*/

// CRON must be running every minute!
$included=true;
include '../../inc/db-conf.php';
include '../../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../../inc/functions.php';


$deposits=mysql_query("SELECT * FROM `deposits`");
while ($dp=mysql_fetch_array($deposits)) {
  $received=0;
  $txid='';
  $txs=$wallet->listtransactions('',2000);
  $txs=array_reverse($txs);
  foreach ($txs as $tx) {
    if ($tx['category']!='receive') continue;
    if ($tx['confirmations']<1) continue;
    if ($tx['address']!=$dp['address']) continue;
    $received=$tx['amount'];
    $txid=$tx['txid'];
    break;
  }
  if ($received<0.00000001) continue;
  $txid=($txid=='')?'[unknown]':$txid;
  if ($dp['received']==1) {
    mysql_query("UPDATE `deposits` SET `confirmations`=`confirmations`+1 WHERE `id`=$dp[id] LIMIT 1");
    if (++$dp['confirmations']>=6) {
      $delExed=false;
      do {
        $delExed=mysql_query("DELETE FROM `deposits` WHERE `id`=$dp[id] LIMIT 1");
      } while ($delExed==false);
      if ($delExed==true) {
        if (mysql_num_rows(mysql_query("SELECT `id` FROM `transactions` WHERE `txid`='$dp[txid]' AND `txid`!='[unknown]' LIMIT 1"))!=0) continue;
        mysql_query("UPDATE `players` SET `balance`=TRUNCATE(ROUND((`balance`+$received),9),8) WHERE `id`=$dp[player_id] LIMIT 1");
        mysql_query("INSERT INTO `transactions` (`player_id`,`amount`,`txid`) VALUES ($dp[player_id],$dp[amount],'$dp[txid]')");
      }
    }
    continue;
  }  
  
  mysql_query("UPDATE `deposits` SET `received`=1,`amount`=$received,`txid`='$txid' WHERE `id`=$dp[id] LIMIT 1");
}
mysql_query("DELETE FROM `deposits` WHERE `time_generated`<NOW()-INTERVAL 7 DAY");

?>