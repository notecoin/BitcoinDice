<?php
/*
 *  © BitcoinDice 


 
*/


if (!isset($included)) exit();
  
$perPage=20;
  
$page=1;
if (!empty($_GET['_page']) && is_numeric($_GET['_page']) && is_int((int)$_GET['_page'])) {
  $page=(int)$_GET['_page'];
  $lima=-$perPage+($page*$perPage);
}
else $lima=0;  

$query_=mysql_query("SELECT * FROM `bets` WHERE `bet_amount`!=0 ORDER BY `time` DESC LIMIT $lima,$perPage");
$pocet=mysql_num_rows(mysql_query("SELECT `id` FROM `bets` WHERE `bet_amount`!=0"));
$pages_=$pocet/$perPage;
$xplosion=explode('.',(string)$pages_);
$pages=(int)$xplosion[0]+1;

?>
<h1>Bets</h1>
<div class="strankovani">
  Page: 
  <?php
    $pagesvetsi=false;
    $pages_real=$pages;
    if ($pages>15) {
      $pagesvetsi=true;
      $pages=15;
    }
    $e=0;

    if ($pagesvetsi) {
      if ($page>8) {
        $e=$page-8;
        $pages=$page+7;
        if ($pages>$pages_real) $pages=$pages_real;
      }
    }
    if ($e!=0) echo '... ';
    for ($i=$e;$i<$pages;$i++) {
      $t_dec=(($i+1)==$page)?'underline':'none';
      echo '<a style="text-decoration: '.$t_dec.';" href="./?p=bets&_page='.($i+1).'">'.($i+1).'</a> ';
    }
    if ($pages_real>$pages) echo ' ...';
  ?>
</div>

<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>ID</th>
    <th>Player</th>
    <th>Time</th>
    <th>Bet</th>
    <th>Multiplier</th>
    <th>Target</th>
    <th>Roll</th>
    <th>Profit</th>
  </tr>
  <?php
  while ($row=mysql_fetch_array($query_)) {
    if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"))!=0)
      $player=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"));
    else $player['alias']='[unknown]';
    
    $chance['under']=floor((1/($row['multiplier']/100)*((100-$settings['house_edge'])/100))*100)/100;
    $chance['over']=100-$chance['under'];

    $target=($row['under_over']==0)?'<'.sprintf("%.2f",$chance['under']):'>'.sprintf("%.2f",$chance['over']);
    $profit=-$row['bet_amount'];
    $profit_class='lose';
    $plusko=($row['bet_amount']==0)?'-':'';
    if ($row['win_lose']==1) {
      $profit+=$row['bet_amount']*$row['multiplier'];
      $profit_class='win';
      $plusko='+';
    }

    echo '<tr class="vypis_table_obsah">';
    echo '<td><small>'.$row['id'].'</small></td>';
    echo '<td title="'.$player['alias'].'" onclick="javascript:prompt(\'Alias:\',\''.$player['alias'].'\');"><small>'.zkrat($player['alias'],10,'<b>...</b>').'</small></td>';
    echo '<td><small><small>'.str_replace(' ','<br>',$row['time']).'</small></small></td>';
    echo '<td><small><b>'.rtrim(rtrim(sprintf("%.8f",$row['bet_amount']),'0'),'.').'</b> '.$settings['currency_sign'].'</small></td>';
    echo '<td><small><b>'.sprintf("%.2f",$row['multiplier']).'</b>x</small></td>';
    echo '<td><small>'.$target.'</small></td>';
    echo '<td><small>'.sprintf("%.2f",$row['result']).'</small></td>';
    echo '<td class="'.$profit_class.'"><small>'.$plusko.sprintf("%.8f",floor($profit*100000000)/100000000).'</small></td>';
    echo '</tr>'."\n";
  }
    
  ?>
</table>
