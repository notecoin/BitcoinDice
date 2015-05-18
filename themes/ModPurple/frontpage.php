<?php
/*
 *  © BitcoinDice 


 
*/


?>

    <div id="all" class="menu-line">
      <div id="content">
        <div class="logo"><a href="./"><?php echo $settings['title']; ?></a></div>
        <div class="menu">
          <a href="#" onclick="javascript:return fair();">FAIR?</a>                         
          <a href="#" onclick="javascript:return account();">ACCOUNT</a>
        </div>
      </div>
    </div>
    <div id="all" class="menu-line-draw"></div>    
    <div id="all" class="c">
      <div id="content" class="centers">
         <div class="wrap">
          <div class="c_center">
              <table width="100%">
                <tr>
                  <td valign="top" id="blikators" style="padding-top: 2px; width: 140px;">
                    <small><small><b>BALANCE</b></small></small><br>
                    <big><b><span class="balance"><?php echo sprintf("%.8f",$player['balance']); ?></span></b> <?php echo $settings['currency_sign']; ?></big>
                  </td>
                  <td valign="top" align="left">
                    <a class="balanceRefresh" href="#" onclick="javascript:refreshBalance();return false;"><img src="./themes/<?php echo $settings['activeTheme']; ?>/images/balance_refresh.png" style="position: relative; top: 8px; width: 24px; height: 26px;"></a>
                  </td>
                  <td valign="top" align="right">
                    <a class="balanceRegulators" href="#" onclick="javascript:return deposit();">DEPOSIT</a>
                    <a class="balanceRegulators" href="#" onclick="javascript:return withdraw();">WITHDRAW</a>
                  </td>
                </tr>
              </table>
              <br>
              <div id="c_centerSepDice"></div>
              <div id="c_centerSep" class="c_centerSepL"></div>
              <div id="c_centerSep" class="c_centerSepR"></div>
              <br>
              <div style="float: left;">
                <small><small><b>BET AMOUNT</b></small></small><br>
                <input type="text" id="bt_wager" class="bt_input top3 wagerInput" value="0.00000000"><a href="#" onclick="javascript:clickdouble();return false;" class="bt_button double rightSep">2x</a><a href="#" onclick="javascript:clickmax();return false;" class="bt_button max">MAX</a>
              </div>
              <div style="float: right;">
                <small><small><b>PROFIT ON WIN</b></small></small><br>
                <input type="text" id="bt_profit" class="bt_input top3 wagerInput profitInput" value="0.00000000"><a href="#" onclick="javascript:maxProfit();return false;" class="bt_button max">MAX</a>            
              </div>
              <div class="betTb">
                <div id="under_over" class="betTbL" onclick="javascript:inverse();">
                  <span id="under_over_txt" class="under_over_txt">ROLL UNDER TO WIN</span><br>
                  <span id="under_over_num" class="under_over_num">49.50</span>
                </div>
                <div class="betTbC">
                  <small><small><b>MULTIPLIER</b></small></small><br>
                  <input type="text" id="betTb_multiplier" class="bt_input top3 betTb_input betTb_payoutL" value="2.00"><input type="text" id="betTb_multiplier_Rp" class="bt_input top3 betTb_input betTb_payoutR" readonly="readonly" onclick="javascript:$('#betTb_multiplier').focus();" value="x">
                </div>
                <div class="betTbR">
                  <small><small><b>WIN CHANCE</b></small></small><br>
                  <input type="text" id="betTb_chance" class="bt_input top3 betTb_input betTb_payoutL" value="49.50"><input type="text" id="betTb_chance_Rp" class="bt_input top3 betTb_input betTb_payoutR" readonly="readonly" onclick="javascript:$('#betTb_chance').focus();" value="%">
                </div>
              </div>
              <a href="#" onclick="javascript:place($('#bt_wager').val(),$('#betTb_multiplier').val(),false);return false;" id="betBtn" class="betBtn">ROLL DICE</a>
          </div>

          <!-- BETTING BOT -- BASICLY INVISIBLE -->
          <div class="c_right">
            <a id="bB_closer" href="#" onclick="javascript:robotLayoutOff();return false;"></a>
            <div class="betTb bettingBot_betTb">
              <div class="betTbWrap">
                <div id="under_over_bB" class="betTbL betTbL_bB" onclick="javascript:inverse_bB();">
                  <span id="under_over_txt_bB" class="under_over_txt under_over_txt_bB">ROLL UNDER TO WIN</span><br>
                  <span id="under_over_num_bB" class="under_over_num under_over_num_bB">49.50</span>
                </div>
                <div class="betTbC">
                  <small><small><b>MULTIPLIER</b></small></small><br>
                  <input type="text" id="betTb_multiplier_bB" class="bt_input top3 betTb_input betTb_payoutL lessHeight" value="2.00"><input type="text" id="betTb_multiplier_Rp_bB" class="bt_input top3 betTb_input betTb_payoutR lessHeight" readonly="readonly" onclick="javascript:$('#betTb_multiplier_bB').focus();" value="x">
                </div>
                <div class="betTbR">
                  <small><small><b>WIN CHANCE</b></small></small><br>
                  <input type="text" id="betTb_chance_bB" class="bt_input top3 betTb_input betTb_payoutL lessHeight" value="49.50"><input type="text" id="betTb_chance_Rp_bB" class="bt_input top3 betTb_input betTb_payoutR lessHeight" readonly="readonly" onclick="javascript:$('#betTb_chance_bB').focus();" value="%">
                </div>
              </div>
              <div class="betTb_s">
                <table width="95%" style="border-collapse: collapse;">
                  <tr>
                    <td valign="top" style="padding-bottom: 4px;">
                      <small><b>OPERATE</b></small><br>
                      <div style="margin-top: 19px;">
                        <input id="bB_operate_rolls" class="bB_checkbox" type="checkbox" checked="checked">
                        <label for="bB_operate_rolls" class="bB_label"><small>Rolls</small></label>                
                        <input id="bB_operate_secs" class="bB_checkbox" type="checkbox">
                        <label for="bB_operate_secs" class="bB_label"><small>Seconds</small></label>                
                      </div>
                      <div>
                        <input type="text" id="bt_rolls_bB" class="bt_input top3 betTb_input betTb_rto lessHeight" value="100">
                      </div>
                    </td>
                    <td valign="top" style="padding-bottom: 4px;">    
                      <div><small><b>ON LOSS</b></small></div>
                      <div>
                        <input id="bB_loss_return" class="bB_checkbox" type="checkbox">
                        <label for="bB_loss_return" class="bB_label"><small>Return to Base</small></label>                
                      </div>
                      <div>
                        <input id="bB_loss_increase" class="bB_checkbox" type="checkbox" checked="checked">
                        <label for="bB_loss_increase" class="bB_label"><small>Increase Bet by:</small></label><br>                
                        <input type="text" id="bB_loss_increase_by" class="bt_input top3 betTb_input betTb_payoutL increaseLossLeft lessHeight" value="100.00"><input type="text" id="bB_loss_increase_by_Rp" class="bt_input top3 betTb_input betTb_payoutR increaseLoss lessHeight" readonly="readonly" onclick="javascript:$('#bB_loss_increase_by').focus();" value="%">
                      </div>

                    </td>
                    <td valign="top" style="padding-bottom: 4px;">
                      <div><small><b>ON WIN</b></small></div>
                      <div>
                        <input id="bB_win_return" class="bB_checkbox" type="checkbox" checked="checked">
                        <label for="bB_win_return" class="bB_label"><small>Return to Base</small></label>                
                      </div>
                      <div>
                        <input id="bB_win_increase" class="bB_checkbox" type="checkbox">
                        <label for="bB_win_increase" class="bB_label"><small>Increase Bet by:</small></label><br>                
                        <input type="text" id="bB_win_increase_by" class="bt_input top3 betTb_input betTb_payoutL increaseLossLeft lessHeight" value="0.00"><input type="text" id="bB_win_increase_by_Rp" class="bt_input top3 betTb_input betTb_payoutR increaseLoss lessHeight" readonly="readonly" onclick="javascript:$('#bB_win_increase_by').focus();" value="%">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" style="padding-top: 10px;">
                      <div>
                        <small><small><b>BASE BET</b></small></small><br>
                        <input type="text" id="bt_wager_bB" class="bt_input top3 betTb_input betTb_fixed lessHeight" value="0.00000000">
                      </div>                    
                    </td>
                    <td valign="top" style="padding-top: 8px;">
                      <div style="margin-top: 2px;">
                        <input id="bB_max_loss" class="bB_checkbox" type="checkbox">
                        <label for="bB_max_loss" class="bB_label"><small>Max Loss:</small></label><br>                
                        <input type="text" id="bB_max_loss_val" class="bt_input top3 betTb_input lessHeight" style="width: 85px;" value="0.00000000">                        
                      </div>                    
                    </td>
                    <td valign="top" style="padding-top: 8px;">
                      <div style="margin-top: 2px;">
                        <input id="bB_max_win" class="bB_checkbox" type="checkbox">
                        <label for="bB_max_win" class="bB_label"><small>Max Profit:</small></label><br>                
                        <input type="text" id="bB_max_win_val" class="bt_input top3 betTb_input lessHeight" style="width: 85px;" value="0.00000000">                        
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>          
            <a href="#" onclick="javascript:startAutomat();return false;" id="botBtn" class="betBtn">START AUTOMATIC BETTING</a>
          </div>
          <!--// BETTING BOT -- BASICLY INVISIBLE -->

        </div>
      </div>
    </div>    

    <div id="all" class="downer">
      <div id="content" class="stats_switcher">
        <a href="#" onclick="javascript:_stats_content('my_bets');return false;" id="_st_my_bets">MY BETS</a>
        <a href="#" onclick="javascript:_stats_content('all_bets');return false;" id="_st_all_bets">ALL BETS</a>
        <a href="#" onclick="javascript:_stats_content('high_rollers');return false;" id="_st_high_rollers">HIGH ROLLERS</a>

        <?php if ($settings['giveaway']==1) { ?><a href="#" class="mini" onclick="javascript:_stats_content('giveaway');return false;" id="_st_giveaway"><img src="./themes/<?php echo $settings['activeTheme']; ?>/icons/giveaway.png" style="position: relative; top: 5px; width: 35px; height: 35px;"></a><?php } ?>
        <a href="#" class="mini" onclick="javascript:_stats_content('news');return false;" id="_st_news"><img src="./themes/<?php echo $settings['activeTheme']; ?>/icons/news.png" style="position: relative; top: 5px; width: 35px; height: 35px;"></a> 
        <?php if ($settings['chat_enable']==1) { ?><a href="#" class="mini" onclick="javascript:_stats_content('chat');return false;" id="_st_chat"><img src="./themes/<?php echo $settings['activeTheme']; ?>/icons/chat.png" style="position: relative; top: 5px; width: 35px; height: 35px;"></a><?php } ?>  
        <?php if ($settings['bot_enable']==1) { ?><a href="#" class="mini" onclick="javascript:robotLayoutChange();return false;" id="_st_automat"><img src="./themes/<?php echo $settings['activeTheme']; ?>/icons/automat.png" style="position: relative; top: 5px; width: 35px; height: 35px;"></a><?php } ?>
        <a href="#" class="mini" onclick="javascript:_stats_content('stats');return false;" id="_st_stats"><img src="./themes/<?php echo $settings['activeTheme']; ?>/icons/stats.png" style="position: relative; top: 8px; width: 35px; height: 28px;"></a>
      </div>
    </div>
    <div id="all" class="stats">
      <div id="content">
      </div>
    </div>
    <div id="all" class="footer">
      <div id="content" class="footer">
        &copy; <?php echo Date('Y').' '.$settings['title']; ?>. All rights reserved.
      </div>
    </div>
