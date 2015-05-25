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

$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` LIMIT 1"));

$player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
$player['server_seed_']=$player['server_seed'];
$player['server_seed']=(double)substr($player['server_seed'],27);


if (!isset($_GET['w']) || (double)$_GET['w']<0 || (double)$_GET['w']>$player['balance']) {     // bet amount
  echo json_encode(array('error'=>'yes','data'=>'invalid_bet'));
  exit();
}
if (!isset($_GET['m']) || !is_numeric((double)$_GET['m']) || (double)$_GET['m']<1.01202 || (double)$_GET['m']>9900) {      // multiplier
  echo json_encode(array('error'=>'yes','data'=>'invalid_m'));
  exit();
}
if (!isset($_GET['hl']) || !is_int((int)$_GET['hl']) || ($_GET['hl']!=0 && $_GET['hl']!=1)) {       // high / low
  echo json_encode(array('error'=>'yes','data'=>'invalid_hl'));
  exit();
}


$wager=(double)$_GET['w'];
if ($wager<0.00000001 && $wager!=0) {
  echo json_encode(array('error'=>'yes','data'=>'too_small'));
  exit();
}
$reservedBalance=mysql_fetch_array(mysql_query("SELECT SUM(`balance`) AS `sum` FROM `players`"));
$reservedWaitingBalance=mysql_fetch_array(mysql_query("SELECT SUM(`amount`) AS `sum` FROM `deposits`"));
$serverBalance=$wallet->getbalance($DiceAccount);
$serverFreeBalance=($serverBalance-$reservedBalance['sum']-$reservedWaitingBalance['sum']);

$jakynasobekminimalne=$settings['bankroll_maxbet_ratio'];

if (($wager*$jakynasobekminimalne)>$serverFreeBalance) {
  echo json_encode(array('error'=>'yes','data'=>'too_big_bet','under'=>($serverFreeBalance/$jakynasobekminimalne)));
  exit();
}


$multiplier=round((double)$_GET['m'],2);
$under_over=(int)$_GET['hl'];

$chance['under']=floor((1/($multiplier/100)*((100-$settings['house_edge'])/100))*100)/100;
$chance['over']=100-$chance['under'];

$result=round($player['server_seed'],2);
$win_lose=(($under_over==0 && $result<=$chance['under']) || ($under_over==1 && $result>=$chance['over']))?1:0;

$profit=-$wager;

$wagermmultiplier=$wager*$multiplier;

$player_=mysql_fetch_array(mysql_query("SELECT `balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
if ($player_['balance']<$wager) {
  echo json_encode(array('error'=>'yes','data'=>'invalid_bet'));
  exit();
}

$newBalance=$player_['balance']-$wager;


if ($win_lose==1) {
  $newBalance+=$wagermmultiplier;
  $profit+=$wagermmultiplier;
}
          
mysql_query("UPDATE `players` SET `balance`=TRUNCATE(ROUND($newBalance,9),8),`t_bets`=`t_bets`+1,`t_wagered`=TRUNCATE(ROUND((`t_wagered`+$wager),9),8),`t_wins`=`t_wins`+$win_lose,`t_profit`=TRUNCATE(ROUND((`t_profit`+$profit),9),8) WHERE `id`=$player[id] LIMIT 1");
mysql_query("INSERT INTO `bets` (`player`,`under_over`,`bet_amount`,`multiplier`,`result`,`win_lose`) VALUES ($player[id],$under_over,$wager,$multiplier,$result,$win_lose)");
mysql_query("UPDATE `system` SET `t_bets`=`t_bets`+1,`t_wagered`=TRUNCATE(ROUND((`t_wagered`+$wager),9),8),`t_wins`=`t_wins`+$win_lose,`t_player_profit`=TRUNCATE(ROUND((`t_player_profit`+$profit),9),8) LIMIT 1");

//new seed

$newSeed=generateServerSeed();
mysql_query("UPDATE `players` SET `last_server_seed`='$player[server_seed_]',`server_seed`='$newSeed' WHERE `id`=$player[id] LIMIT 1");


echo json_encode(array('error'=>'no','result'=>$result,'win_lose'=>$win_lose));

?>