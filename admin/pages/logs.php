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

$query_=mysql_query("SELECT * FROM `admin_logs` ORDER BY `time` DESC LIMIT $lima,$perPage");
$pocet=mysql_num_rows(mysql_query("SELECT * FROM `admin_logs`"));
$pages_=$pocet/$perPage;
$xplosion=explode('.',(string)$pages_);
$pages=(int)$xplosion[0]+1;

?>

<h1>Access Log</h1>
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
    <th>Time</th>
    <th>IP address</th>
  </tr>
  <?php
  while ($row=mysql_fetch_array($query_)) {

    echo '<tr class="vypis_table_obsah">';
    echo '<td><small>'.$row['id'].'</small></td>';
    echo '<td><small><small>'.$row['time'].'</small></small></td>';
    echo '<td><small>'.$row['ip'].'</small></td>';
    echo '</tr>'."\n";
  }
    
  ?>
</table>
