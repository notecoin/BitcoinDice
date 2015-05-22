<?php
/*
 *  © BitcoinDice 


 
*/


if (isset($_GET['checkCons'])) {
  if (@!mysql_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pass']) || @!mysql_select_db($_POST['db_name'])) {
    header('Location: ./?step=3&db');
    exit();
  }

	if(isset($_POST['mform'])) 
    {
		if(IsChecked('rpcssl','https'))
        {
			$rpcproto='https';
        }else{
			$rpcproto='http';
		}
 
	}
  
  $included_=true;
  include 'db_data.php';
  
  $db_file=fopen('../inc/db-conf.php','wb');
  fwrite($db_file,"<?php \n");          
  fwrite($db_file,'$conf_c=true;'."\n");          
  fwrite($db_file,'mysql_connect(\''.$_POST['db_host'].'\',\''.$_POST['db_user'].'\',\''.$_POST['db_pass'].'\');'."\n");
  fwrite($db_file,'mysql_select_db(\''.$_POST['db_name'].'\');'."\n");
  fwrite($db_file,'mysql_query("SET NAMES utf8");'."\n");
  fwrite($db_file,"?>");      ?><?php
  fclose($db_file);

  $w_file=fopen('../inc/driver-conf.php','wb');
  fwrite($w_file,"<?php \n");          
  fwrite($w_file,'$driver_login=\''.$rpcproto.'://'.$_POST['w_user'].':'.$_POST['w_pass'].'@'.$_POST['w_host'].':'.$_POST['w_port'].'/\';'."\n");
  fwrite($w_file,'$DiceAccount=\''.$_POST['w_account'].'\';'."\n");
  fwrite($w_file,"?>");      ?><?php
  fclose($w_file);

  header('Location: ./?step=4');
  exit();
}

if (isset($_GET['saveB'])) {
  include '../inc/db-conf.php';
  mysql_query("UPDATE `system` SET `title`='$_POST[s_title]',`url`='$_POST[s_url]',`currency`='$_POST[s_cur]',`currency_sign`='$_POST[s_cur_sign]',`description`='$_POST[s_desc]' WHERE `id`=1");
  header('Location: ./?step=5');
  exit();
}

if (empty($_GET['step']) || ($_GET['step']!=1 && $_GET['step']!=2 && $_GET['step']!=3 && $_GET['step']!=4 && $_GET['step']!=5 && $_GET['step']!=6)) {
  header('Location: ./?step=1');
  exit();
}
else $step=$_GET['step'];

if ($step==3 && (!is_writable('../inc/db-conf.php') || !is_writable('../inc/driver-conf.php'))) {
  header('Location: ./?step=2');
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>BitcoinDice 1.0 - Installation</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./install_page.css">
    <link rel="shortcut icon" href="./favicon.ico">
    <script type="text/javascript" src="jquery.js"></script>
  </head>
  <body>
    <div class="allbody">
      <div class="alls" style="text-align: center;">
        <h1>BitcoinDice 1.0 Installation</h1>
      </div>
    </div>
    <?php
    switch ($step) {
      case 1:
      ?>
        <script type="text/javascript">
          function next() {
            window.location.href='./?step=2';
          }
        </script>
        <div class="allbody">
          <div class="alls">
            <h3>Welcome!</h3>
            This is an automatic installation script. Please, follow the instructions on the following screens.
          </div>
        </div>
      <?php
      break;
      case 2:
      ?>
        <script type="text/javascript">
          function next() {
            window.location.href='./?step=3';
          }
        </script>
        <div class="allbody">
          <div class="alls">
            <h3>File Permissions</h3>
            Please make sure that following files are writable (chmod 777):
            <br>
            <table>
              <tr>
                <td><i>inc/db-conf.php</i></td>
                <td>&nbsp;&nbsp;</td>
                <td><?php if (is_writable('../inc/db-conf.php')) { echo '<span style="color: green;"><b>Yes</b></span>'; } else { echo '<span style="color: red;"><b>No</b></span>'; } ?></td>
              </tr>
              <tr>
                <td><i>inc/driver-conf.php</i></td>
                <td>&nbsp;&nbsp;</td>
                <td><?php if (is_writable('../inc/driver-conf.php')) { echo '<span style="color: green;"><b>Yes</b></span>'; } else { echo '<span style="color: red;"><b>No</b></span>'; } ?></td>
              </tr>
            </table>
            <br>
            The above files should be writable, otherwise the installation will not continue!
          </div>
        </div>
      <?php
      break;
      case 3:
      ?>
        <script type="text/javascript">
          function next() {
            $.ajax({
              'url': './db_test_call.php?db_user='+$("input#db_user").val()+'&db_pass='+$("input#db_pass").val()+'&db_host='+$("input#db_host").val()+'&db_db='+$("input#db_db").val(),
              'dataType': "json",
              'success': function(data) {
                if (data['error']=='no') checkWallet();
                else alert('Database error! Can\'t connect to database! Please check if provided informations are correct and try again.');
              }
            });
          }
          function checkWallet() {
            $.ajax({
              'url': './driver_test_call.php?w_user='+$("input#w_user").val()+'&w_pass='+$("input#w_pass").val()+'&w_host='+$("input#w_host").val()+'&w_port='+$("input#w_port").val(),
              'dataType': "json",
              'success': function(data) {
                document.getElementById('mform').submit();
              },
              'error': function() {
                alert('Wallet error! Can\'t connect to wallet! Please check if provided informations are correct and try again.');
              }
            });
          }
        </script>
        <div class="allbody">
          <div class="alls">
            <form id="mform" method="post" action="./?checkCons">
              <h3>Database Info</h3>
              <i>Please fill in correct database info:</i>
              <br>
              <table>
                <tr>
                  <td>Host:</td>
                  <td><input type="text" name="db_host" id="db_host" value="localhost"></td>
                </tr>
                <tr>
                  <td>Username:</td>
                  <td><input type="text" name="db_user" id="db_user" placeholder="DB user"></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="text" name="db_pass" id="db_pass" placeholder="DB pass"></td>
                </tr>
                <tr>
                  <td>Database:</td>
                  <td><input type="text" name="db_name" id="db_db" placeholder="DB name"></td>
                </tr>
              </table>
              
              <h3>Wallet Info</h3>
              <i>Please fill in correct wallet info:</i>
              <br>
              <table>
			    <tr>
                  <td>Rpc Ssl:</td>
                  <td><input type="checkbox" name="rpcssl[]" value="https" />Enabled<br /></td>
                </tr>
                <tr>
                  <td>Host:</td>
                  <td><input type="text" name="w_host" id="w_host" value="localhost"></td>
                </tr>
                <tr>
                  <td>Login:</td>
                  <td><input type="text" name="w_user" id="w_user" placeholder="Wallet user"></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="text" name="w_pass" id="w_pass" placeholder="Wallet password"></td>
                </tr>
                <tr>
                  <td>Port:</td>
                  <td><input type="text" name="w_port" id="w_port" placeholder="Wallet port"></td>
                </tr>
                <tr>
                  <td>Account:</td>
                  <td><input type="text" name="w_account" id="w_account" placeholder="Wallet Account"></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      <?php
      break;
      case 4:
      ?>
        <script type="text/javascript">
          function next() {
            document.getElementById('mform').submit();
          }
        </script>
        <div class="allbody">
          <div class="alls">
            <h3>Basic Settings</h3>
            <br>
            <form id="mform" action="./?saveB" method="post">
              <table>
                <tr>
                  <td>Site title:</td>
                  <td><input type="text" name="s_title"></td>
                </tr>
                <tr>
                  <td>Site description:</td>
                  <td><input type="text" name="s_desc"></td>
                </tr>
                <tr>
                  <td>URL:</td>
                  <td><input type="text" name="s_url"></td>
                  <td>(<b>without <i>http://</i></b>)</td>
                </tr>
                <tr>
                  <td>Currency:</td>
                  <td><input type="text" name="s_cur" value="Bitcoin" disabled></td>
                </tr>
                <tr>
                  <td>Currency sign:</td>
                  <td><input type="text" name="s_cur_sign" value="BTC" disabled></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      <?php
      break;
      case 5:
      ?>
        <script type="text/javascript">
          function next() {
            window.location.href='./?step=6';
          }
        </script>
        <div class="allbody">
          <div class="alls">
            <h3>CRON setup</h3>
            In order to BitcoinDice work properly, you must have the CRON set this way:
            <br><br>
            <b>Every 1 minute</b>: <i>content/cron/check_deposits.php</i>
            <br><br><hr>
            <b>Example (Linux):</b>
            <br><br>
            1) <i>Open CRON table:</i>
            <br>
            $ crontab -e
            <br><br>
            2) <i>Add the following line:</i>
            <br>
            * * * * * cd /var/www/content/cron; php check_deposits.php;
            <br><br>
            3) Save CRON table by pressing <b>CTRL</b>+<b>X</b>, than confirm (<b>Y</b>) and press <b>enter</b>.
            <br><br>
            4) Restart CRON service:
            <br>
            $ service cron restart
            <br><br>
            That's all.            
             
          </div>
        </div>
      <?php
      break;
      case 6:
      ?>
        <div class="allbody">
          <div class="alls">
            <h3>Thank You!</h3>
            <br>
            Your installation is done! You can login to administration or try your luck at your own gambling site :-) 
            <br>
            <br>
            Admin details:<br>
            &nbsp;Username: <b>admin</b><br>
            &nbsp;Password: <b>admin</b>
            <br>
            <br>
            <i>Don't forget to change this info after first login!</i>
            <br>
            <br>
            <b>Warning!</b> Please remove the <i>/install</i> directory now, otherwise there is a security risk.
          </div>
        </div>
      <?php        
      break;
    }
    ?>    
    <div class="allbody">
      <div class="alls" style="padding: 5px; height: 30px;">
        <div style="float: left; font-style: italic;">
          <h2>Step: <?php echo $step; ?></h2>
        </div>
        <div style="float: right;">
          <?php
          if ($step==6) echo '<input id="next" type="button" onclick="javascript:window.location.href=\'../admin/\';" value="Go to Admin!" style="padding: 5px;">';
          else echo '<input id="next" type="button" onclick="javascript:next();" value="Next ->" style="padding: 5px;">';
          ?>
        </div>
      </div>
    </div>
    <?php
    if ($step==3 && isset($_GET['db'])) echo '<script type="text/javascript">alert("Can\'t connect to database! Please check if provided informations are correct and try again.");</script>';
    ?>
  </body>
</html>