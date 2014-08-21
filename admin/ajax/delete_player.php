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

if (empty($_GET['_player']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `id`='".prot($_GET['_player'])."' LIMIT 1"))==0) exit();

mysql_query("DELETE FROM `players` WHERE `id`='".prot($_GET['_player'])."' LIMIT 1");
echo json_encode(array('error'=>'no'));
?>