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

if (empty($_GET['_new']) || mysql_num_rows(mysql_query("SELECT `id` FROM `news` WHERE `id`='".prot($_GET['_new'])."' LIMIT 1"))==0) exit();

mysql_query("DELETE FROM `news` WHERE `id`='".prot($_GET['_new'])."' LIMIT 1");
echo json_encode(array('error'=>'no'));
?>