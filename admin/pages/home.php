<?php
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();
?>
<h1>Stats</h1>
<table class="vypis_table">
  <tr class="vypis_table_obsah">
    <td>Number of bets:</td>
    <td><b><?php echo $settings['t_bets']; ?></b></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Total wagered:</td>
    <td><b><?php echo sprintf("%.8f",$settings['t_wagered']); ?></b> <?php echo $settings['currency_sign']; ?></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Total profit:</td>
    <td><b><?php $settings['t_player_profit']=(0-$settings['t_player_profit']); echo ($settings['t_player_profit']>=0)?'<span style="color: green;">+'.sprintf("%.8f",$settings['t_player_profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",$settings['t_player_profit']).'</span>'; ?></b> <?php echo $settings['currency_sign']; ?></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Real house edge:</td>
    <td><b><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets`"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></b></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td style="color: green;">Wins:</td>
    <td style="color: green;"><b><?php echo $settings['t_wins']; ?></b></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td style="color: #d10000;">Losses:</td>
    <td style="color: #d10000;"><b><?php echo ($settings['t_bets']-$settings['t_wins']); ?></b></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td style="color: #a06d00;">W/L ratio:</td>
    <td style="color: #a06d00;"><b><?php echo sprintf("%.3f",$settings['t_wins']/($settings['t_bets']-$settings['t_wins'])); ?></b></td>
  </tr>
</table>
<br><br>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>Period</th>
    <th>Real house edge</th>
    <th>Profit</th>
  </tr>
  <tr>
    <td>Last hour</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 1 HOUR"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 1 HOUR")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Last 24h</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 24 HOUR"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 24 HOUR")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Last 7d</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 7 DAY"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 7 DAY")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Last 30d</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 30 DAY"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 30 DAY")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Last 6m</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 6 MONTH"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 6 MONTH")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Last 12m</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets` WHERE `time`>NOW()-INTERVAL 12 MONTH"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets` WHERE `time`>NOW()-INTERVAL 12 MONTH")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
  <tr>
    <td>Since start</td>
    <td><?php $this_q=mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN (0-((`bet_amount`*`multiplier`)-`bet_amount`)) ELSE `bet_amount` END) AS `total_profit`,SUM(`bet_amount`) AS `total_wager` FROM `bets`"); $h_e_=mysql_fetch_array($this_q); $h_e_['h_e']=($h_e_['total_wager']!=0)?(($h_e_['total_profit']/$h_e_['total_wager'])*100):0; echo ($h_e_['h_e']>=0)?'<span style="color: green;">+'.sprintf("%.5f",$h_e_['h_e']).'%</span>':'<span style="color: #d10000;">'.sprintf("%.5f",$h_e_['h_e']).'%</span>'; ?></td>
    <td><?php $profit_=mysql_fetch_array(mysql_query("SELECT SUM(CASE WHEN `win_lose`=1 THEN ((`bet_amount`*`multiplier`)-`bet_amount`) ELSE (0-`bet_amount`) END) AS `profit` FROM `bets`")); echo ((0-$profit_['profit'])>=0)?'<span style="color: green;">+'.sprintf("%.8f",0-$profit_['profit']).'</span>':'<span style="color: #d10000;">'.sprintf("%.8f",0-$profit_['profit']).'</span>'; ?></td>
  </tr>
</table>