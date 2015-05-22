<?php
/*
 *  © BitcoinDice 


 
*/

if(isset($_POST['rpcssl']) && 
   $_POST['rpcssl'] !== 'https') 
{
    $rpcproto="http";
}
else
{
    $rpcproto="https";
}  
include 'driver_test.php';
$test=new jsonRPCClient($rpcproto.'://'.$_GET['w_user'].':'.$_GET['w_pass'].'@'.$_GET['w_host'].':'.$_GET['w_port'].'/');
@$test_call=$test->getbalance();

echo json_encode(array('result'=>$test_call));

?>