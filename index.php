<?php
/*
 *  © BitcoinDice 


 
*/


header('X-Frame-Options: DENY'); 

$init=true;
include './inc/start.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $settings['title'].' - '.$settings['description']; ?></title>
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="themes/<?php echo $settings['activeTheme']; ?>/main.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="content/ext/msgbox/Scripts/jquery.msgBox.js"></script>
    <link rel="stylesheet" type="text/css" href="content/ext/msgbox/Styles/msgBoxLight.css">
    <script type="text/javascript" src="content/ext/qtip/jquery.qtip.min.js"></script>
    <link rel="stylesheet" type="text/css" href="content/ext/qtip/jquery.qtip.min.css">
    <script type="text/javascript" src="js/colors.js"></script>    
    <?php include './js/includer.php'; ?>
  </head>
  <body>
    <?php include './themes/'.$settings['activeTheme'].'/frontpage.php'; ?>
  </body>
</html>
<?php include './inc/end.php'; ?>