<?php
/*
 *  © BitcoinDice 


 
*/

  if (!isset($included)) exit();
  
  $perPage=20;
  
  $ifSearch='';
  $podm='';
  if (!empty($_GET['_search'])) {
    $podm=" WHERE `hash` LIKE '%".prot($_GET['_search'])."%' OR `alias` LIKE '%".prot($_GET['_search'])."%'";
    if (is_numeric($_GET['_search'])) $podm.=" OR `balance`=".prot($_GET['_search'])." OR `id`=".prot($_GET['_search']);
    $ifSearch=$_GET['_search'];
  }
  $page=1;
  if (!empty($_GET['_page']) && is_numeric($_GET['_page']) && is_int((int)$_GET['_page'])) {
    $page=(int)$_GET['_page'];
    $lima=-$perPage+($page*$perPage);
  }
  else $lima=0;  
  $query_=mysql_query("SELECT `id`,`alias`,`hash`,`balance`,`time_last_active`,`lastip` FROM `players`$podm ORDER BY `time_created` DESC LIMIT $lima,$perPage");
  $pocet=mysql_num_rows(mysql_query("SELECT `id` FROM `players`$podm"));
  $pages_=$pocet/$perPage;
  $xplosion=explode('.',(string)$pages_);
  $pages=(int)$xplosion[0]+1;

?>
<h1>Players</h1>
<script type="text/javascript">
  function delete_player(p_id,r_id) {
    if (confirm('Do you really want to delete this player?')) {
      $.ajax({
        'url': 'ajax/delete_player.php?_player='+p_id,
        'dataType': "json",
        'success': function(data) {
          $("tr#"+r_id).remove();
          message('success','Player has been deleted.');
        }
      });
    }
  }
  function edit_player(p_id,r_id,p_b,p_a,p_h) {
    var p_alias=prompt('Alias:',p_a);
    if (p_alias==null) return false;
    var p_hash=prompt('Hash:',p_h);
    if (p_hash==null) return false;
    var p_bal=prompt('Balance:',p_b);
    if (p_bal==null && typeof(p_bal)!='string') return false;
    if (p_alias!='' && p_hash!='' && p_alias!=null && p_hash!=null && p_bal!=null) {
      $.ajax({
        'url': 'ajax/edit_player.php?_player='+p_id+'&a='+p_alias+'&h='+p_hash+'&b='+p_bal,
        'dataType': "json",
        'success': function(data) {
          $("tr#"+r_id+" td.p__ali").html('<small>'+p_alias+'</small>');
          $("tr#"+r_id+" td.p__hash").html('<small><small>'+p_hash+'</small></small>');
          $("tr#"+r_id+" td.p__bal").html('<small><b>'+p_bal+'</b> <?php echo $settings['currency_sign']; ?></small>');
          $("tr#"+r_id+" a#edit_karos").attr('onclick',"javascript:edit_player("+p_id+",'"+r_id+"','"+p_bal+"','"+p_alias+"','"+p_hash+"');return false;");
          message('success','Player has been updated.');
        }
      });
    } else message('error',"One of fields has an incorrect value. Please, try again.");
  }
</script>
<div class="zprava">
  <b>Search:</b><br>
  <form method="get">
    <input type="hidden" name="p" value="players">
    <input type="text" name="_search" placeholder="Search by hash, alias, balance or ID" style="width: 300px;"> <input type="submit" value="Search">
  </form>
</div>
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
      echo '<a style="text-decoration: '.$t_dec.';" href="./?p=players&_page='.($i+1).'">'.($i+1).'</a> ';
    }
    if ($pages_real>$pages) echo ' ...';
  ?>
</div>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>ID</th>
    <th>Alias</th>
    <th>Hash</th>
    <th>Balance</th>
    <th>Last Access</th>
    <th>Manage</th>
  </tr>
  <?php
  $row_=0;                   
  while ($row=mysql_fetch_array($query_)) {
    $row['lastip']=($row['lastip']=='')?'[unknown]':$row['lastip'];
    echo '<tr class="vypis_table_obsah" id="row'.$row_.'">';
    echo '<td><small>'.$row['id'].'</small></td>';
    echo '<td class="p__ali" title="'.$row['alias'].'" onclick="javascript:prompt(\'Alias:\',\''.$row['alias'].'\');"><small>'.zkrat($row['alias'],10,'<b>...</b>').'</small></td>';
    echo '<td class="p__hash"><small><small>'.$row['hash'].'</small></small></td>';
    echo '<td class="p__bal"><small><b>'.$row['balance'].'</b> '.$settings['currency_sign'].'</small></td>';
    echo '<td><small><small>'.$row['time_last_active'].'<br><b>IP:</b> '.$row['lastip'].'</small></small></td>';
    echo '<td><a href="#" onclick="javascript:delete_player('.$row['id'].',\'row'.$row_.'\');return false;" title="Delete Player"><img src="./imgs/cross.png" style="width: 16px;"></a>&nbsp;<a href="#" onclick="javascript:edit_player('.$row['id'].',\'row'.$row_.'\',\''.$row['balance'].'\',\''.$row['alias'].'\',\''.$row['hash'].'\');return false;" title="Edit Player" id="edit_karos"><img src="./imgs/edit.png" style="width: 16px;"></a></td>';
    echo '</tr>'."\n";
    $row_++;
  }
    
  ?>
</table>
