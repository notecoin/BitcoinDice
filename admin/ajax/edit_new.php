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

if (empty($_GET['_new']) || !is_numeric($_GET['_new']) || empty($_GET['con']) || mysql_num_rows(mysql_query("SELECT `id` FROM `news` WHERE `id`='".prot($_GET['_new'])."' LIMIT 1"))==0) exit();

mysql_query("UPDATE `news` SET `content`='".prot($_GET['con'])."' WHERE `id`='".prot($_GET['_new'])."' LIMIT 1");
echo json_encode(array('error'=>'no'));
?>