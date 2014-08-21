<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

if (empty($_GET['con'])) exit();

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` LIMIT 1"));

$content='';

switch ($_GET['con']) {
  case 'my_bets':
    if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
    $player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
    
    $my_bets=mysql_query("SELECT * FROM `bets` WHERE `player`=$player[id] ORDER BY `time` DESC LIMIT 30");
    if (mysql_num_rows($my_bets)==0) $content.='<br><br><br><i>You haven\'t bet yet.</i>';
    else {
      $content.='<table id="bets_st_table">';
      $content.='<tr>';
      $content.='<th>BET ID</th>';
      $content.='<th>PLAYER</th>';
      $content.='<th>TIME</th>';
      $content.='<th>BET</th>';
      $content.='<th>MULTIPLIER</th>';
      $content.='<th>TARGET</th>';
      $content.='<th>ROLL</th>';
      $content.='<th>PROFIT</th>';
      $content.='</tr>';
      $suda=0;
      while ($my_bet=mysql_fetch_array($my_bets)) {
        $content.=($suda==0)?'<tr>':'<tr class="suda">';
        
        $username=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$my_bet[player] LIMIT 1"));
        
        $chance['under']=floor((1/($my_bet['multiplier']/100)*((100-$settings['house_edge'])/100))*100)/100;
        $chance['over']=100-$chance['under'];

        $target=($my_bet['under_over']==0)?'<'.sprintf("%.2f",$chance['under']):'>'.sprintf("%.2f",$chance['over']);
        $profit=-$my_bet['bet_amount'];
        $profit_class='lose';
        $plusko=($my_bet['bet_amount']==0)?'-':'';
        if ($my_bet['win_lose']==1) {
          $profit+=$my_bet['bet_amount']*$my_bet['multiplier'];
          $profit_class='win';
          $plusko='+';
        }

        $content.='<td class="betId first">'.$my_bet['id'].'</td>';
        $content.='<td>'.$username['alias'].'</td>';
        $content.='<td>'.date('H:i:s',strtotime($my_bet['time'])).'</td>';
        $content.='<td>'.sprintf("%.8f",$my_bet['bet_amount']).'</td>';
        $content.='<td>'.sprintf("%.2f",$my_bet['multiplier']).'</td>';
        $content.='<td>'.$target.'</td>';
        $content.='<td>'.sprintf("%.2f",$my_bet['result']).'</td>';
        $content.='<td class="'.$profit_class.' right last">'.$plusko.sprintf("%.8f",floor($profit*100000000)/100000000).'</td>';
        $content.='</tr>';
        $suda=($suda==0)?1:0;
      }
      $content.='</table>';
    }
  break;
  case 'all_bets':
    $all_bets=mysql_query("SELECT * FROM `bets` WHERE `bet_amount`!=0 ORDER BY `time` DESC LIMIT 30");
    if (mysql_num_rows($all_bets)==0) $content.='<br><br><br><i>No one has bet yet.</i>';
    else {
      $content.='<table id="bets_st_table">';
      $content.='<tr>';
      $content.='<th>BET ID</th>';
      $content.='<th>PLAYER</th>';
      $content.='<th>TIME</th>';
      $content.='<th>BET</th>';
      $content.='<th>MULTIPLIER</th>';
      $content.='<th>TARGET</th>';
      $content.='<th>ROLL</th>';
      $content.='<th>PROFIT</th>';
      $content.='</tr>';
      $suda=0;
      while ($all_bet=mysql_fetch_array($all_bets)) {
        $content.=($suda==0)?'<tr>':'<tr class="suda">';
        
        if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `id`=$all_bet[player] LIMIT 1"))!=0)
          $username=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$all_bet[player] LIMIT 1"));
        else $username['alias']='[unknown]';
        
        $chance['under']=floor((1/($all_bet['multiplier']/100)*((100-$settings['house_edge'])/100))*100)/100;
        $chance['over']=100-$chance['under'];

        $target=($all_bet['under_over']==0)?'<'.sprintf("%.2f",$chance['under']):'>'.sprintf("%.2f",$chance['over']);
        $profit=-$all_bet['bet_amount'];
        $profit_class='lose';
        $plusko=($all_bet['bet_amount']==0)?'-':'';
        if ($all_bet['win_lose']==1) {
          $profit+=$all_bet['bet_amount']*$all_bet['multiplier'];
          $profit_class='win';
          $plusko='+';
        }

        $content.='<td class="betId first">'.$all_bet['id'].'</td>';
        $content.='<td>'.$username['alias'].'</td>';
        $content.='<td>'.date('H:i:s',strtotime($all_bet['time'])).'</td>';
        $content.='<td>'.sprintf("%.8f",$all_bet['bet_amount']).'</td>';
        $content.='<td>'.sprintf("%.2f",$all_bet['multiplier']).'</td>';
        $content.='<td>'.$target.'</td>';
        $content.='<td>'.sprintf("%.2f",$all_bet['result']).'</td>';
        $content.='<td class="'.$profit_class.' right last">'.$plusko.sprintf("%.8f",floor($profit*100000000)/100000000).'</td>';
        $content.='</tr>';
        $suda=($suda==0)?1:0;
      }
      $content.='</table>';
    }
  break;
  case 'news':
    $content.='<br><br><br>';
    $query=mysql_query("SELECT * FROM `news` ORDER BY `time` DESC");
    while ($row=mysql_fetch_array($query)) {
      $content.='<div class="news_single">';
      $content.=str_replace('[I]','<i>',str_replace('[/I]','</i>',str_replace('[BR]','<br>',str_replace('[/B]','</b>',str_replace('[B]','<b>',$row['content']))))).'<br><span class="news_single_time">'.$row['time'].'</span>';
      $content.='</div>';
    }
    if (mysql_num_rows($query)==0) $content.='<i>No news available.</i>';    
  break;
  case 'giveaway':
    if ($settings['giveaway']!=1) {
      $content.='<br><br><br><i>Giveaway is not supported now.</i>';
    }
    else {
      if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
      $player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
      if ($player['balance']!=0) {
        $content.='<br><br><br>Sorry, your balance must be <b>0</b> to claim the '.$settings['currency'].' bonus.';
      }
      else {
        $content.='<br><br><br>You can claim the '.$settings['currency'].' bonus now:<br><br>';
        $content.='<big><big><b>'.$settings['giveaway_amount'].'</b> '.$settings['currency_sign'].'</big></big><br><br>';
        $content.='<table><tr><td valign="top" style="padding: 4px 0;">Enter text from image:</td><td valign="top"><input type="text" id="captchatext" maxlength="4" style="width: 140px; padding: 4px; text-transform: uppercase;"><br><img src="./content/captcha/genImage.php" style="position: relative; top: 4px;"></img></td><td valign="top"><button onclick="javascript:claim($(\'#captchatext\').val());return false;" style="padding: 4px;">Claim</button></td></tr></table>';
      }
    }
  break;
  case 'stats':
    if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
    $player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

    $content.='<br><br><br>';
    $content.='<div class="stats_">';

    $content.='<table width="100%">';
    $content.='<tr><th>Your Stats</th><th class="center"><img src="./content/images/diceStats.png"></th><th>Global Stats</th></tr>';
    $content.='<tr><td>'.$player['t_bets'].'</td><td class="center">NUMBER OF BETS</td><td>'.$settings['t_bets'].'</td></tr>';    
    $content.='<tr><td>'.$player['t_wagered'].'</td><td class="center">TOTAL WAGERED</td><td>'.$settings['t_wagered'].'</td></tr>';    
    $content.='<tr><td>'.$player['t_profit'].'</td><td class="center">TOTAL PROFIT</td><td>'.$settings['t_player_profit'].'</td></tr>';    
    $content.='<tr class="wins"><td>'.$player['t_wins'].'</td><td class="center">WINS</td><td>'.$settings['t_wins'].'</td></tr>';    
    $content.='<tr class="losses"><td>'.($player['t_bets']-$player['t_wins']).'</td><td class="center">LOSSES</td><td>'.($settings['t_bets']-$settings['t_wins']).'</td></tr>';    
    $content.='<tr class="wl"><td>'.sprintf("%.3f",$player['t_wins']/($player['t_bets']-$player['t_wins'])).'</td><td class="center">W/L RATIO</td><td>'.sprintf("%.3f",$settings['t_wins']/($settings['t_bets']-$settings['t_wins'])).'</td></tr>';    
    $content.='</table>';
    
    $content.='</div>';
  break;
  case 'chat':
    if ($settings['chat_enable']!=1) {
      $content.='<br><br><br><i>Chat is not supported now.</i>';
    }
    else {
      $content.='<br><br><br><input type="text" id="composeTxt"><button onclick="javascript:compose($(\'#composeTxt\').val());return false;" id="composeBtn">Send</button>';
      $content.='<div id="chatWindow"></div>';
      $content.='<script type="text/javascript">';
      $content.='initializeRefreshingFrameChat();';
      $content.='$("#composeTxt").keypress(function(e) { if (e.which==13) compose($("#composeTxt").val()); });';
      $content.='$("#composeTxt").qtip({content:{text:\'Press enter to send\'},style:{classes:\'qtip-bootstrap qtip-shadow\'},position:{my:\'bottom left\',at:\'top left\'}});';
      $content.='</script>';
    }
  break;
  case 'high_rollers':
    $all_bets=mysql_query("SELECT *,(`bet_amount`*`multiplier`) AS `profit_on_win` FROM `bets` WHERE `bet_amount`!=0 AND `win_lose`=1 ORDER BY `profit_on_win` DESC LIMIT 30");
    if (mysql_num_rows($all_bets)==0) $content.='<br><br><br><i>No one has bet yet.</i>';
    else {
      $content.='<table id="bets_st_table">';
      $content.='<tr>';
      $content.='<th>BET ID</th>';
      $content.='<th>PLAYER</th>';
      $content.='<th>TIME</th>';
      $content.='<th>BET</th>';
      $content.='<th>MULTIPLIER</th>';
      $content.='<th>TARGET</th>';
      $content.='<th>ROLL</th>';
      $content.='<th>PROFIT</th>';
      $content.='</tr>';
      $suda=0;
      while ($all_bet=mysql_fetch_array($all_bets)) {
        $content.=($suda==0)?'<tr>':'<tr class="suda">';
        
        if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `id`=$all_bet[player] LIMIT 1"))!=0)
          $username=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$all_bet[player] LIMIT 1"));
        else $username['alias']='[unknown]';

        $chance['under']=floor((1/($all_bet['multiplier']/100)*((100-$settings['house_edge'])/100))*100)/100;
        $chance['over']=100-$chance['under'];

        $target=($all_bet['under_over']==0)?'<'.sprintf("%.2f",$chance['under']):'>'.sprintf("%.2f",$chance['over']);
        $profit=-$all_bet['bet_amount'];
        $profit_class='lose';
        $plusko=($all_bet['bet_amount']==0)?'-':'';
        if ($all_bet['win_lose']==1) {
          $profit+=$all_bet['bet_amount']*$all_bet['multiplier'];
          $profit_class='win';
          $plusko='+';
        }

        $content.='<td class="betId first">'.$all_bet['id'].'</td>';
        $content.='<td>'.$username['alias'].'</td>';
        $content.='<td>'.date('H:i:s',strtotime($all_bet['time'])).'</td>';
        $content.='<td>'.sprintf("%.8f",$all_bet['bet_amount']).'</td>';
        $content.='<td>'.sprintf("%.2f",$all_bet['multiplier']).'</td>';
        $content.='<td>'.$target.'</td>';
        $content.='<td>'.sprintf("%.2f",$all_bet['result']).'</td>';
        $content.='<td class="'.$profit_class.' right last">'.$plusko.sprintf("%.8f",floor($profit*100000000)/100000000).'</td>';
        $content.='</tr>';
        $suda=($suda==0)?1:0;
      }
      $content.='</table>';
    }
  break;
}


echo json_encode(array('content'=>$content));
?>