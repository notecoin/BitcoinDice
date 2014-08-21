<?php
/*
 *  © BitcoinDice 


 
*/


include 'driver_test.php';
$test=new jsonRPCClient('http://'.$_GET['w_user'].':'.$_GET['w_pass'].'@'.$_GET['w_host'].':'.$_GET['w_port'].'/');
@$test_call=$test->getbalance();

echo json_encode(array('result'=>$test_call));

?>