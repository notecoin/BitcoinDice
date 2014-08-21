<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

$content='';

$messages=mysql_query("SELECT * FROM `chat` WHERE `time`>NOW()-INTERVAL 10 MINUTE ORDER BY `time` DESC");
while ($message=mysql_fetch_array($messages)) {
  $content.='<div id="chat_message">';
  $sender=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$message[sender] LIMIT 1"));
  $content.='<div id="content" title="'.$message['time'].'"><b>'.$sender['alias'].'</b>: '.$message['content'].'</div>';
  $content.='</div>';
}

echo json_encode(array('content'=>$content));

mysql_query("DELETE FROM `chat` WHERE `time`<=NOW()-INTERVAL 10 MINUTE");
?>