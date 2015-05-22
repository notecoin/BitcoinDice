<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();

if (isset($_POST['s_title'])) {
  if (!empty($_POST['s_title']) && !empty($_POST['s_url']) && !empty($_POST['s_desc']) && !empty($_POST['cur']) && !empty($_POST['cur_s']) && isset($_POST['bet_fr_players']) && is_numeric((int)$_POST['bet_fr_players']) && isset($_POST['bet_fr_bots']) && is_numeric((int)$_POST['bet_fr_bots']) && isset($_POST['house_edge']) && is_numeric((double)$_POST['house_edge']) && isset($_POST['min_withdrawal']) && is_numeric((double)$_POST['min_withdrawal']) && isset($_POST['txfee']) && is_numeric((double)$_POST['txfee']) && isset($_POST['bankroll_maxbet_ratio']) && is_numeric((double)$_POST['bankroll_maxbet_ratio'])) {
    echo '<div class="zpravagreen"><b>Success!</b> Data was successfuly saved.</div>';  
  }
  else {
    echo '<div class="zpravared"><b>Error!</b> One of fields is empty.</div>';
  }
}

?>

<h1>Settings</h1>
<br>
<form action="./?p=settings" method="post">
  <table>
    <tr>
      <td>Active Theme:</td>
      <td>
        <select name="acttheme">
          <?php
            $tdir=opendir('../themes/');
            while (false!==($ctheme=readdir($tdir))) {
              $ifselected='';
              if ($ctheme=='.' || $ctheme=='..') continue;
              if (file_exists('../themes/'.$ctheme.'/main.css') && file_exists('../themes/'.$ctheme.'/frontpage.php'))
                if ($ctheme==$settings['activeTheme']) $ifselected=' selected="selected"';
                echo '<option value="'.$ctheme.'"'.$ifselected.'>'.$ctheme."\r\n";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td style="width: 180px;">Site Title:</td>
      <td style="width: 200px;"><input type="text" name="s_title" value="<?php echo $settings['title']; ?>"></td>
    </tr>
    <tr>
      <td>Site URL:</td>
      <td><input type="text" name="s_url" value="<?php echo $settings['url']; ?>"></td>
      <td><small><i>Without <b>http://</b>.</i></small></td>
    </tr>
    <tr>
      <td>Site Description:</td>
      <td><input type="text" name="s_desc" value="<?php echo $settings['description']; ?>"></td>
    </tr>
    <tr>
      <td>Currency:</td>
      <td><input type="text" name="cur" value="<?php echo $settings['currency']; ?>"></td>
    </tr>
    <tr>
      <td>Currency Sign:</td>
      <td><input type="text" name="cur_s" value="<?php echo $settings['currency_sign']; ?>"></td>
    </tr>
    <tr>
      <td>Bet freq. (players):</td>
      <td><input title="0 = unlimited" type="text" name="bet_fr_players" value="<?php echo $settings['rolls_mintime']; ?>"> ms</td>
      <td><small><i>Minimal pause between bets in <b>millisecons</b>.</i></small></td>
    </tr>
    <tr>
      <td>Bet freq. (bots):</td>
      <td><input title="0 = unlimited" type="text" name="bet_fr_bots" value="<?php echo $settings['rolls_mintime_bB']; ?>"> ms</td>
      <td><small><i>Minimal pause between bets in <b>millisecons</b>.</i></small></td>
    </tr>
    <tr>
      <td>House edge:</td>
      <td><input type="text" name="house_edge" value="<?php echo $settings['house_edge']; ?>"> %</td>
      <td><small><i>Your approximate profit from total wagered amount.</i></small></td>
    </tr>
    <tr>
      <td>Minimal withdrawal:</td>
      <td><input type="text" name="min_withdrawal" value="<?php echo $settings['min_withdrawal']; ?>"> <?php echo $settings['currency_sign']; ?></td>
    </tr>
    <tr>
      <td>Transaction fee</td>
      <td><input type="text" name="txfee" value="<?php $infofee=$wallet->getinfo(); echo $infofee['paytxfee']; ?>"> <?php echo $settings['currency_sign']; ?></td>
      <td><small><i>Transaction fee to <?php echo $settings['currency']; ?> network.</i></small></td>
    </tr>
    <tr>
      <td>Bankroll/max bet ratio</td>
      <td><input type="text" name="bankroll_maxbet_ratio" value="<?php echo $settings['bankroll_maxbet_ratio']; ?>"></td>
      <td><small><i>The default ratio between amount in wallet and max available bet is set to 25. So for example if you want to allow players to bet 1 <?php echo $settings['currency_sign']; ?>, you have to have 25 <?php echo $settings['currency_sign']; ?> in wallet.</i></small></td>
    </tr>	
    <tr>
      <td></td>
      <td><input type="submit" value="Save"></td>
    </tr>
  </table>
</form>
