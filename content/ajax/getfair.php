<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id`,`server_seed`,`last_server_seed` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
$player['last_seedhash']=substr($player['last_server_seed'],0,27);
$player['seedhash']=substr($player['server_seed'],0,27);
$player['last_server_seed']=(double)substr($player['last_server_seed'],27);
$player['server_seed']=(double)substr($player['server_seed'],27);
$c=($player['last_server_seed']==0)?"<small><i>You haven't bet yet</i></small>":"<small>Server Seed sha256:</small><br><br><small><small>".hash('sha256',$player['last_seedhash'].sprintf("%.32f",$player['last_server_seed']))."</small></small><br><br><small>Server Seed:</small><br><br><small><small>".$player['last_seedhash'].sprintf("%.32f",$player['last_server_seed'])."</small></small>";
$return=array(
  'con' => "<br><b>Next Bet:</b><br><br><small>Server Seed sha256:</small><br><br><small><small>".hash('sha256',$player['seedhash'].sprintf("%.32f",$player['server_seed']))."</small></small><br><br><br><b>Last Bet:</b><br><br>".$c."<br><br><small><b>Note:</b> Decimals from 3rd place are cutted off.</small>"
);
echo json_encode($return);

?>