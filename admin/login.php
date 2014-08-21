<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

session_start();
if (isset($_GET['logout'])) {
  $_SESSION['logged_']=false;
  header('Location: ./?logouted');
  exit();
}
$included=true;
include '../inc/db-conf.php';
include '../inc/functions.php';
if (!empty($_POST['hash_one']) && !empty($_POST['hash_sec']) && mysql_num_rows(mysql_query("SELECT `id` FROM `admins` WHERE `username`='".prot($_POST['hash_one'])."' AND `passwd`='".md5($_POST['hash_sec'])."' LIMIT 1"))!=0) {
  $this_admin=mysql_fetch_array(mysql_query("SELECT `username`,`ga_token` FROM `admins` WHERE `username`='".prot($_POST['hash_one'])."' AND `passwd`='".md5($_POST['hash_sec'])."' LIMIT 1"));
  if ($this_admin['ga_token']=='') {
    $_SESSION['logged_']=true;
    $_SESSION['username']=$this_admin['username'];
    mysql_query("INSERT INTO `admin_logs` (`ip`,`browser`) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."')");
    header('Location: ./');
  }
  else {
    $_SESSION['2f_1']['username']=$this_admin['username'];
    $_SESSION['2f_1']['ga_token']=$this_admin['ga_token'];
    header('Location: ./?totp');
  }
  exit();  
}
else if (!empty($_POST['totp'])) {
  include './ga_class.php';

  $verify=Google2FA::verify_key($_SESSION['2f_1']['ga_token'],$_POST['totp'],0);
   
  if ($verify==true) {
    $_SESSION['logged_']=true;
    $_SESSION['username']=$_SESSION['2f_1']['username'];
    $_SESSION['2f_1']=false;
    mysql_query("INSERT INTO `admin_logs` (`ip`,`browser`) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."')");
    
    header('Location: ./');
  }
} 
header('Location: ./?login_error');
?>