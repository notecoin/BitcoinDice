<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

session_start();
if (isset($_SESSION['logged_']) && $_SESSION['logged_']==true)
  $logged=true;
else $logged=false;
//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//
$included=true;
include '../inc/db-conf.php';
include '../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../inc/functions.php';

include './post.php';
$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` WHERE `id`=1 LIMIT 1"));
?>  
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $settings['title']; ?> - ADMINISTRATION</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./layout.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">
      function message(type,cont) {
        if (type=='error') {
          color='zpravared';
          h='Error:';
        }
        else if (type=='success') {
          color='zpravagreen';
          h='Success:';
        }
        $("div.messages").html('<div class="'+color+'"><b>'+h+'</b> '+cont+'</div>');
      }
    </script>
  </head>
  <body>
    <div id="all">
      <div id="content" style="text-align: center;">
        <div class="main head">
          <div style="float: left; text-align: left; margin-left: 5px; position: relative; top: 4px;">
            <b>ADMINISTRATION - <?php echo $settings['title']; ?></b>
            <br>
            <a href="http://<?php echo $settings['url']; ?>" target="_blank" title="Opens site in new window">← go to site</a>
          </div>
          <div style="float: right; margin-right: 10px; line-height: 40px;">
            User: <?php if ($logged) echo '<b>'.$_SESSION['username'].'</b> | <a href="./login.php?logout">Logout</a>'; else echo '<b>Unlogged</b>'; ?>
          </div>
          <img src="./imgs/dice.png">
        </div>
        <div class="main">
          <div class="obsah">
            <?php
            if (!$logged) { 
              if (isset($_GET['login_error'])) echo '<div class="zpravared"><b>Error: </b>Login error.</div>';
              if (isset($_GET['logouted'])) echo '<div class="zpravagreen"><b>Success: </b>You have been logged out.</div>';
              
              if (!isset($_GET['totp'])) {
                ?>
                <form action="login.php" method="post">
                  <table id="loginT" border="0">
                    <tr><td>Username:</td><td><input type="text" name="hash_one"></td></tr>
                    <tr><td>Password:</td><td><input type="password" name="hash_sec"></td></tr>
                    <tr><td></td><td><input type="submit" name="prihlaseni" value="Login"></td></tr>
                  </table>
                </form>
                <?php
              }
              else {
                ?>
                <div class="zprava"><b>Notice:</b> Two-factor authentication is enabled for this account.</div>
                <form action="login.php" method="post">
                  <table id="loginT" border="0">
                    <tr><td>Username:</td><td><b><?php echo $_SESSION['2f_1']['username']; ?></b></td></tr>
                    <tr><td>Enter one-time password:</td><td><input type="text" name="totp"></td></tr>
                    <tr><td></td><td><input type="submit" name="prihlaseni" value="Login"></td></tr>
                  </table>
                </form>
                <?php              
              }
            }
            else {
              echo '<div class="messages"></div>';
              if (!empty($_GET['p']) && file_exists('./pages/'.$_GET['p'].'.php'))
                include './pages/'.$_GET['p'].'.php';
              else if (empty($_GET['p'])) include './pages/home.php';
              else include '404.php';  
            }
            ?>
          </div>
          <div class="menu_">
            <ul>
              <?php if (!$logged) { ?>
              <li><a href="./">Login</a></li>
              <?php } if ($logged) { ?>
              <li><a href="./"<?php if (!isset($_GET['p']) || (isset($_GET['p']) && $_GET['p']=='home')) echo ' class="active_"'; ?>>Stats</a></li>
              <li><a href="./?p=players"<?php if (isset($_GET['p']) && $_GET['p']=='players') echo ' class="active_"'; ?>>Players</a></li>
              <li><a href="./?p=bets"<?php if (isset($_GET['p']) && $_GET['p']=='bets') echo ' class="active_"'; ?>>Bets</a></li>          
              <li><a href="./?p=wallet"<?php if (isset($_GET['p']) && $_GET['p']=='wallet') echo ' class="active_"'; ?>>Wallet</a></li>
              <li><a href="./?p=news"<?php if (isset($_GET['p']) && $_GET['p']=='news') echo ' class="active_"'; ?>>News</a></li>
              <li><a href="./?p=admins"<?php if (isset($_GET['p']) && $_GET['p']=='admins') echo ' class="active_"'; ?>>Admins</a></li>
              <li><a href="./?p=addons"<?php if (isset($_GET['p']) && $_GET['p']=='addons') echo ' class="active_"'; ?>>Addons</a></li>
              <li><a href="./?p=settings"<?php if (isset($_GET['p']) && $_GET['p']=='settings') echo ' class="active_"'; ?>>Settings</a></li>          
              <li><p align="center"><small><small><strong><strong>- THIS ACCOUNT -</strong></strong></small></small></p></li>
              <li><a href="./?p=set_ga"<?php if (isset($_GET['p']) && $_GET['p']=='set_ga') echo ' class="active_"'; ?>>Security</a></li>          
              <li><a href="./?p=logs"<?php if (isset($_GET['p']) && $_GET['p']=='logs') echo ' class="active_"'; ?>>Access Log</a></li>          
              <?php } ?>
            </ul>
          </div>          
        </div>
        <div class="main paticka">&copy; <?php echo date('Y',time()).' '; ?> | <?php echo $settings['title']; ?> Administration</div>
      </div>
    </div>
  </body>
</html>