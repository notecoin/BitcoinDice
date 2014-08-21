<?php
/*
 *  © BitcoinDice 


 
*/

mysql_query("UPDATE `players` SET `time_last_active`=NOW(),`lastip`='".$_SERVER['REMOTE_ADDR']."' WHERE `id`=$player[id] LIMIT 1");
mysql_close();

?>

    <script type="text/javascript">
      _stats_content('all_bets');
      
      $("#_st_stats").qtip({
        content: {
          text: 'Statistics'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'bottom left',
          at: 'top left'
        }
      });
      <?php if ($settings['giveaway']==1) { ?>
      $("#_st_giveaway").qtip({
        content: {
          text: 'Free <?php echo $settings['currency']; ?>s'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'                                   
        },
        position: {
          my: 'bottom left',
          at: 'top left'
        }
      });
      <?php } ?>
      $("#_st_automat").qtip({
        content: {
          text: 'Automatic Betting (Bot)'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'bottom left',
          at: 'top left'
        }
      });
      $("#_st_news").qtip({
        content: {
          text: 'News'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'bottom left',
          at: 'top left'
        }
      });
      $("#_st_chat").qtip({
        content: {
          text: 'Chat'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'bottom left',
          at: 'top left'
        }
      });
      $(".balanceRefresh").qtip({
        content: {
          text: 'Refresh Balance'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'center left',
          at: 'center right'
        }
      });
      $("#under_over").qtip({
        content: {
          text: 'Click to Invert'
        },
        style: {
          classes: 'qtip-bootstrap qtip-shadow'
        },
        position: {
          my: 'bottom center',
          at: 'top center'
        }
      });
      $("#betTb_multiplier").focusin(function(){
        $("#betTb_multiplier_Rp").css('background-color','#FFF8D5');
      });
      $("#betTb_multiplier").focusout(function(){
        $("#betTb_multiplier_Rp").css('background-color','inherit');
      });
      $("#betTb_multiplier_bB").focusin(function(){
        $("#betTb_multiplier_Rp_bB").css('background-color','#FFF8D5');
      });
      $("#betTb_multiplier_bB").focusout(function(){
        $("#betTb_multiplier_Rp_bB").css('background-color','inherit');
      });
      $("#betTb_multiplier").change(function(){
        var repaired=parseFloat($("#betTb_multiplier").val()).toFixed(2);
        if (isNaN(repaired)==true) $("#betTb_multiplier").val('2.00');
        else if (repaired<1) $("#betTb_multiplier").val((1).toFixed(2));
        else if (repaired>(10000*(1-(<?php echo $settings['house_edge']; ?>/100)))) $("#betTb_multiplier").val((10000*(1-(<?php echo $settings['house_edge']; ?>/100))).toFixed(2));
        else $("#betTb_multiplier").val(repaired);
        recountProfit();
        recountChance();
      });
      $("#betTb_multiplier_bB").change(function(){
        var repaired=parseFloat($("#betTb_multiplier_bB").val()).toFixed(2);
        if (isNaN(repaired)==true) $("#betTb_multiplier_bB").val('2.00');
        else if (repaired<1) $("#betTb_multiplier_bB").val((1).toFixed(2));
        else if (repaired>(10000*(1-(<?php echo $settings['house_edge']; ?>/100)))) $("#betTb_multiplier_bB").val((10000*(1-(<?php echo $settings['house_edge']; ?>/100))).toFixed(2));
        else $("#betTb_multiplier_bB").val(repaired);
        recountChance_bB();
      });
      $("#betTb_chance").focusin(function(){
        $("#betTb_chance_Rp").css('background-color','#FFF8D5');                
      });
      $("#betTb_chance").focusout(function(){
        $("#betTb_chance_Rp").css('background-color','inherit');
      });
      $("#betTb_chance_bB").focusin(function(){
        $("#betTb_chance_Rp_bB").css('background-color','#FFF8D5');                
      });
      $("#betTb_chance_bB").focusout(function(){
        $("#betTb_chance_Rp_bB").css('background-color','inherit');
      });
      $("#betTb_chance").change(function(){
        var repaired=parseFloat($("#betTb_chance").val()).toFixed(2);
        if (isNaN(repaired)==true) $("#betTb_chance").val('49.50');
        else if (repaired<(0.01)) $("#betTb_chance").val((0.01).toFixed(2));
        else if (repaired>(100-<?php echo $settings['house_edge']; ?>)) $("#betTb_chance").val((100-<?php echo $settings['house_edge']; ?>).toFixed(2));
        else $("#betTb_chance").val(repaired);
        recountProfit();
        recountPayout();
      });
      $("#betTb_chance_bB").change(function(){
        var repaired=parseFloat($("#betTb_chance_bB").val()).toFixed(2);
        if (isNaN(repaired)==true) $("#betTb_chance_bB").val('49.50');
        else if (repaired<(0.01)) $("#betTb_chance_bB").val((0.01).toFixed(2));
        else if (repaired>(100-<?php echo $settings['house_edge']; ?>)) $("#betTb_chance_bB").val((100-<?php echo $settings['house_edge']; ?>).toFixed(2));
        else $("#betTb_chance_bB").val(repaired);
        recountPayout_bB();
      });
      $("#bt_wager").change(function(){
        var repaired=parseFloat($("#bt_wager").val()).toFixed(8);
        if (isNaN(repaired)==true) $("#bt_wager").val('0.00000000');
        else $("#bt_wager").val(repaired);
        recountProfit();
      });
      $("#bt_wager_bB").change(function(){
        var repaired=parseFloat($("#bt_wager_bB").val()).toFixed(8);
        if (isNaN(repaired)==true) $("#bt_wager_bB").val('0.00000000');
        else $("#bt_wager_bB").val(repaired);
      });
      $("#bt_rolls_bB").change(function(){
        var repaired=parseInt($("#bt_rolls_bB").val());
        if (isNaN(repaired)==true) $("#bt_rolls_bB").val('100');
        else if (repaired<1) $("#bt_rolls_bB").val(1);
        else if (repaired>10000) $("#bt_rolls_bB").val(10000); 
        else $("#bt_rolls_bB").val(repaired);
      });
      $("#bt_profit").change(function(){
        var repaired=parseFloat($("#bt_profit").val()).toFixed(8);
        if (isNaN(repaired)==true) recountProfit();
        else {
          $("#betTb_profit").val(repaired);
          $("#betTb_multiplier").val((parseFloat(repaired)+parseFloat($("#bt_wager").val()))/parseFloat($("#bt_wager").val())).change();
        }
      });
      $("#bB_loss_increase_by").change(function(){
        var repaired=parseFloat($("#bB_loss_increase_by").val());
        if (isNaN(repaired)==true) repaired=100.00;
        $("#bB_loss_increase_by").val(repaired.toFixed(2));
        onLoss_increase=repaired.toFixed(2);        
      });
      $("#bB_loss_increase_by").focusin(function(){
        $("#bB_loss_increase_by_Rp").css('background-color','#FFF8D5');                
      });
      $("#bB_loss_increase_by").focusout(function(){
        $("#bB_loss_increase_by_Rp").css('background-color','inherit');
      });
      $("#bB_win_increase_by").change(function(){
        var repaired=parseFloat($("#bB_win_increase_by").val());
        if (isNaN(repaired)==true) repaired=100.00;
        $("#bB_win_increase_by").val(repaired.toFixed(2));        
        onWin_increase=repaired.toFixed(2);
      });
      $("#bB_win_increase_by").focusin(function(){
        $("#bB_win_increase_by_Rp").css('background-color','#FFF8D5');                
      });
      $("#bB_win_increase_by").focusout(function(){
        $("#bB_win_increase_by_Rp").css('background-color','inherit');
      });
      $("#bB_loss_return").change(function(event) {
        if ($("#bB_loss_return").prop('checked')==true) {
          $("#bB_loss_increase").prop('checked',false);
          onLoss=0;
        }
        else {
          $("#bB_loss_increase").prop('checked',true);
          onLoss=1;
        }
      });
      $("#bB_loss_increase").change(function(event) {
        if ($("#bB_loss_increase").prop('checked')==true) {
          $("#bB_loss_return").prop('checked',false);
          onLoss=1;
        }
        else {
          $("#bB_loss_return").prop('checked',true);
          onLoss=0;
        }
      });
      $("#bB_win_return").change(function(event) {
        if ($("#bB_win_return").prop('checked')==true) {
          $("#bB_win_increase").prop('checked',false);
          onWin=0;
        }
        else {
          $("#bB_win_increase").prop('checked',true);
          onWin=1;
        }
      });
      $("#bB_win_increase").change(function(event) {
        if ($("#bB_win_increase").prop('checked')==true) {
          $("#bB_win_return").prop('checked',false);
          onWin=1;
        }
        else {
          $("#bB_win_return").prop('checked',true);
          onWin=0;
        }
      });
      $("#bB_operate_rolls").change(function(event) {
        if ($("#bB_operate_rolls").prop('checked')==true) {
          $("#bB_operate_secs").prop('checked',false);
          operateMode=0;
        }
        else {
          $("#bB_operate_secs").prop('checked',true);
          operateMode=1;
        }
      });
      $("#bB_operate_secs").change(function(event) {
        if ($("#bB_operate_secs").prop('checked')==true) {
          $("#bB_operate_rolls").prop('checked',false);
          operateMode=1;
        }
        else {
          $("#bB_operate_rolls").prop('checked',true);
          operateMode=0;
        }
      });
      $("#bB_max_loss_val").change(function(){
        var repaired=parseFloat($("#bB_max_loss_val").val()).toFixed(8);
        if (isNaN(repaired)==true) $("#bB_max_loss_val").val('0.00000000');
        else $("#bB_max_loss_val").val(repaired);
      });
      $("#bB_max_win_val").change(function(){
        var repaired=parseFloat($("#bB_max_win_val").val()).toFixed(8);
        if (isNaN(repaired)==true) $("#bB_max_win_val").val('0.00000000');
        else $("#bB_max_win_val").val(repaired);
      });

    </script>
