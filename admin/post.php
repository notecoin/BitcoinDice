<?php
/*
 *  © BitcoinDice 


 
*/

if (isset($included) && $logged==true) {

  if (!empty($_POST['s_title']) && !empty($_POST['s_url']) && !empty($_POST['s_desc']) && !empty($_POST['cur']) && !empty($_POST['acttheme']) && !empty($_POST['cur_s']) && isset($_POST['bet_fr_players']) && is_numeric((int)$_POST['bet_fr_players']) && isset($_POST['bet_fr_bots']) && is_numeric((int)$_POST['bet_fr_bots']) && isset($_POST['house_edge']) && is_numeric((double)$_POST['house_edge']) && isset($_POST['min_withdrawal']) && is_numeric((double)$_POST['min_withdrawal']) && isset($_POST['txfee']) && is_numeric((double)$_POST['txfee']) && isset($_POST['bankroll_maxbet_ratio']) && is_numeric((double)$_POST['bankroll_maxbet_ratio'])) {
    mysql_query("UPDATE `system` SET `title`='".prot($_POST['s_title'])."',`url`='".prot($_POST['s_url'])."',`activeTheme`='".prot($_POST['acttheme'])."',`currency`='".prot($_POST['cur'])."',`currency_sign`='".prot($_POST['cur_s'])."',`description`='".prot($_POST['s_desc'])."',`house_edge`=".(double)$_POST['house_edge'].",`rolls_mintime`=".(int)$_POST['bet_fr_players'].",`rolls_mintime_bB`=".(int)$_POST['bet_fr_bots'].",`min_withdrawal`=".(double)$_POST['min_withdrawal'].",`bankroll_maxbet_ratio`=".(double)$_POST['bankroll_maxbet_ratio']." WHERE `id`=1 LIMIT 1");  
    $wallet->settxfee(round((double)$_POST['txfee'],8));
  }
  if (isset($_POST['addons_form'])) {
    $giveaway=(isset($_POST['giveaway']))?1:0;
    $chat_enable=(isset($_POST['chat_enable']))?1:0;
    $bot_enable=(isset($_POST['bot_enable']))?1:0;
    
    mysql_query("UPDATE `system` SET `giveaway`=$giveaway,`giveaway_amount`=".(double)$_POST['giveaway_amount'].",`giveaway_freq`=".(int)$_POST['giveaway_freq'].",`chat_enable`=$chat_enable,`bot_enable`=$bot_enable LIMIT 1");
  }

}
?>