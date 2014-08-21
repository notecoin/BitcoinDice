<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($init)) exit();



session_start();

$included=true;
$conf_c=false;
include './inc/db-conf.php';
if ($conf_c==false) {
  header('Location: ./install/');
  exit();
}
include './inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include './inc/functions.php';


if (empty($_GET['unique'])) {
  if (!empty($_COOKIE['unique_D_']) && mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_COOKIE['unique_D_'])."' LIMIT 1"))!=0) {
    header('Location: ./?unique='.$_COOKIE['unique_D_'].'# Do Not Share This URL!');
    exit();  
  }
  newPlayer($wallet);
}
else { // !empty($_GET['unique'])
  if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['unique'])."' LIMIT 1"))!=0) {
    $player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['unique'])."' LIMIT 1"));
    $unique=prot($_GET['unique']);
    setcookie('unique_D_',prot($_GET['unique']),(time()+60*60*24*365*5),'/');  
  }
  else {
    setcookie('unique_D_',false,(time()-10000),'/');
    header('Location: ./');    
    exit();
  }
}


if ($player['password']!='' && (empty($_COOKIE['protected_D_']) || $_COOKIE['protected_D_']!=$player['password'])) {  
  if (isset($_GET['bad_'])) echo '<script type="text/javascript">alert(\'Wrong password!\')</script>';
  echo '<script type="text/javascript">window.location.href=\'./content/requestAccess.php?_unique='.$unique.'&pass=\'+prompt(\'This URL is password protected. Please, enter password:\');</script>';
  exit();
}

$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` WHERE `id`=1 LIMIT 1"));

if (!file_exists('./themes/'.$settings['activeTheme'].'/main.css') || !file_exists('./themes/'.$settings['activeTheme'].'/frontpage.php')) {
  echo '<b>Error!</b> Can\'t load active theme.';
  exit();
}
?>