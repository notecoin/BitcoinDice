<?php
/*
 *  © BitcoinDice 


 
*/

$included=true;
include '../inc/db-conf.php';
include '../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `password` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

if (empty($_GET['pass']) || md5($_GET['pass'])!=$player['password']) {
  header('Location: ../?unique='.$_GET['_unique'].'&bad_');
  exit();
}
else {
  setcookie('protected_D_',md5($_GET['pass']),0,'/');
  header('Location: ../?unique='.$_GET['_unique'].'# Do Not Share This URL!');
  exit();
}

?>