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

if (empty($_GET['_admin']) || mysql_num_rows(mysql_query("SELECT `id` FROM `admins` WHERE `id`='".prot($_GET['_admin'])."' LIMIT 1"))==0) exit();

mysql_query("DELETE FROM `admins` WHERE `id`='".prot($_GET['_admin'])."' LIMIT 1");
echo json_encode(array('error'=>'no'));
?>