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

$query_=mysql_query("SELECT * FROM `transactions` ORDER BY `time` DESC LIMIT $lima,$perPage");
$pocet=mysql_num_rows(mysql_query("SELECT `id` FROM `transactions`"));
$pages_=$pocet/$perPage;
$xplosion=explode('.',(string)$pages_);
$pages=(int)$xplosion[0]+1;

if ($page==1) {

  if (isset($_POST['_am']) && isset($_POST['_adr'])) {
    if (!empty($_POST['_am']) && is_numeric($_POST['_am'])) {
      $amount=(double)$_POST['_am'];
      if (!empty($_POST['_adr'])) {
        $validate=$wallet->validateaddress($_POST['_adr']);
        if ($validate['isvalid']==true) {
          if ($amount<=$wallet->getbalance()) {
            $txid=$wallet->sendtoaddress($_POST['_adr'],$amount);
            echo '<div class="zpravagreen"><b>Success:</b> Amount was sent.<br>Transaction ID: <i>'.$txid.'</i></div>';
          }
          else echo '<div class="zpravared"><b>Error:</b> Wallet has insufficient fund.</div>';
        }
        else echo '<div class="zpravared"><b>Error:</b> '.$settings['currency'].' address is not valid.</div>';      
      }
      else echo '<div class="zpravared"><b>Error:</b> '.$settings['currency'].' address is not valid.</div>';
    }
    else echo '<div class="zpravared"><b>Error:</b> Amount is not numeric.</div>';
  } 
  ?>
  <h1>Wallet</h1>
  <div class="zprava">
  <b>Receiving address:</b><br>
  <big>
  <?php
    echo $wallet->getnewaddress();
  ?>
  </big>
  </div>
  
  <div class="zprava">
    <b>Withdraw:</b><br>
    <form action="./?p=wallet" method="post">
      Amount: <input type="text" name="_am"> <?php echo $settings['currency_sign']; ?> address: <input type="text" name="_adr"> <input type="submit" value="Withdraw">
    </form>
  </div>
  <div class="zprava">
    <table style="border: 0; border-collapse: collapse;">
      <tr>
        <td style="padding: 0; vertical-align: middle;">
          <b>Total balance:</b><br>
          <big><?php echo $wallet->getbalance(); ?></big> <?php echo $settings['currency_sign']; ?>
          <br><br>
          <b>Free balance:</b><br>
          <big><?php $usersdeps_=mysql_fetch_array(mysql_query("SELECT SUM(`amount`) AS `sum` FROM `deposits`")); $usersdeps_['sum']=(0+(double)$usersdeps_['sum']);  $usersbal_=mysql_fetch_array(mysql_query("SELECT SUM(`balance`) AS `sum` FROM `players`")); $usersbal_['sum']=(0+(double)$usersbal_['sum']); echo ($wallet->getbalance()-$usersbal_['sum']-$usersdeps_['sum']); ?></big> <?php echo $settings['currency_sign']; ?>
        </td>
        <td style="vertical-align: middle;">
          <b>Reserved balance (users):</b><br>
          <big><?php echo $usersbal_['sum']; ?></big> <?php echo $settings['currency_sign']; ?>
          <br><br>
          <b>Reserved deposits (users):</b><br>
          <big><?php echo $usersdeps_['sum']; ?></big> <?php echo $settings['currency_sign']; ?>        
        </td>
      </tr>
    </table>
  </div>
  
<?php } ?>

<fieldset>
  <legend>Deposits/Withdrawals</legend>
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
        echo '<a style="text-decoration: '.$t_dec.';" href="./?p=wallet&_page='.($i+1).'">'.($i+1).'</a> ';
      }
      if ($pages_real>$pages) echo ' ...';
    ?>
  </div>
  <table class="vypis_table">
    <tr class="vypis_table_head">
      <th>Time</th>
      <th>Player</th>
      <th>Amount</th>
      <th>Transaction ID</th>
    </tr>
  
    <?php
    while ($tx=mysql_fetch_array($query_)) {
      if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$tx[player_id] LIMIT 1"))!=0)
        $player=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$tx[player_id] LIMIT 1"));
      else $player['alias']='[unknown]';

      $amount=sprintf("%.8f",$tx['amount']);
      if ($amount>0) {
        $am_class='win';
        $amount='+'.$amount;
      }
      else $am_class='lose';
      
      echo '<tr class="vypis_table_obsah">';
      echo '<td><small><small>'.str_replace(' ','<br>',$tx['time']).'</small></small></td>';
      echo '<td><small>'.$player['alias'].'</small></td>';
      echo '<td class="'.$am_class.'"><small>'.$amount.'</small></td>';
      echo '<td><small><small>'.$tx['txid'].'</small></small></td>';
      echo '</tr>';
    }
    ?>
  </table>
</fieldset>
