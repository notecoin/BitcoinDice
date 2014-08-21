<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();     

function prot_mail($mail2,$max_delka=0) {
  $mail=mysql_real_escape_string(trim(chop(strip_tags($mail2))));
  if (strpos($mail,"@")==0 || strpos($mail,".")==0 || substr($mail,-1)=="@" || substr($mail,-1)==".")
    $vystup=false;
  else {
    if ($max_delka!=0) {
      if (strlen($mail)>$max_delka)  $vystup=false;
      else  $vystup=$mail;
    }
    else  $vystup=$mail;
  }
  return $vystup;
}

function prot($hodnota,$max_delka=0) {
  $text=mysql_real_escape_string(strip_tags($hodnota));
  if ($max_delka!=0)  $vystup=substr($text,0,$max_delka);
  else  $vystup=$text;
  return $vystup;
}

function generateHash($delka_retezce,$capt=false) {
  if ($capt==true) $mozne_znaky='123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'; 
  else $mozne_znaky='abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $vystup='';
  for ($i=0;$i<$delka_retezce;$i++)  $vystup.=$mozne_znaky[mt_rand(0,strlen($mozne_znaky)-1)];
  return $vystup;
}

function generateServerSeed() {
  $rand_nr=mt_rand(0.01*100,99.99*100)/100;
  if (mt_rand(1,2)==2) $pre_rand=($rand_nr-0.01);
  else $pre_rand=($rand_nr+0.01);
  $str=generateHash(26).'-'.((double)(($pre_rand+0.001).mt_rand(1,99999999999999999999999999999)));
  return $str;
}

function newPlayer($wallet) {
  generate_: {
    $hash=generateHash(32);
  }
  if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='$hash' LIMIT 1"))!=0) goto generate_;
  $alias='Player_';
  $alias_i=mysql_fetch_array(mysql_query("SELECT `autoalias_increment` AS `data` FROM `system` LIMIT 1"));
  $alias_i=$alias_i['data'];
  mysql_query("UPDATE `system` SET `autoalias_increment`=`autoalias_increment`+1 LIMIT 1");
  mysql_query("INSERT INTO `players` (`hash`,`alias`,`time_last_active`,`server_seed`) VALUES ('$hash','".$alias.$alias_i."',NOW(),'".generateServerSeed()."')");
  header('Location: ./?unique='.$hash.'# Do Not Share This URL!');
  exit();
}

function zkrat($str,$max,$iflonger) {
  if (strlen($str)>$max) {
    $str=substr($str,0,$max).$iflonger;
  }
  return $str;
}
?>