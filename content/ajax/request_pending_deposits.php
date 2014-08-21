<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();

$player=mysql_fetch_array(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

$pendings=array();
$n=0;
$searcher=mysql_query("SELECT * FROM `deposits` WHERE `player_id`=$player[id]");
while ($dp=mysql_fetch_array($searcher)) {
  if ($dp['received']==0) continue;
  $mins_left=6-$dp['confirmations'];
  $amount=$dp['amount'];
  
  $pendings[]=array('amount'=>$amount,'mins_left'=>$mins_left);        
}

echo json_encode($pendings);
?>
