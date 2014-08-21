<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

session_start();
if (!isset($_SESSION['logged_']) || $_SESSION['logged_']!==true) exit();

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';
include '../ga_class.php';

if (empty($_GET['newtoken']) || empty($_GET['totp']) || empty($_GET['id'])) exit();

$verify=Google2FA::verify_key(prot($_GET['newtoken']),$_GET['totp'],0);

if ($verify==true) {

  mysql_query("UPDATE `admins` SET `ga_token`='".prot($_GET['newtoken'])."' WHERE `id`=".prot($_GET['id'])." LIMIT 1");

  echo json_encode(array('success'=>'yes'));
}
else echo json_encode(array('success'=>'no'));
?>
