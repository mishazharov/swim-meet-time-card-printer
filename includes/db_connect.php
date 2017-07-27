<?php
$mysql_host = 'localhost';
$mysql_user = '';
$mysql_pass = '';
//Lets begin migrating to mysqli and prepared statements
//It is a safer, newer approach to php sql and should replace mysql_ functions as soon as possible. 
//Do not remove mysqli, it is already implemented in various scripts

define('SWIM_DB', 'swim');//the timecards, etc
define('MAIN_DB', 'main');//For admin auth
define('ADMIN_AUTH', false);//Whether to use the second DB for admin auth
define('PASS_RESET', true);//To disable password reset
define('SMTP_USER', "");//The username used to log into the SMTP server
define('SMTP_PASS', "");//The password to log into the SMPT server
define('SMTP_NAME', "");//Common name eg. Swim Website or something like that
define('SMTP_PORT', "587");//For emailing
define('SMTP_HOST', "");//Host that will send mail
define('SMTP_PROTOCOL', "tls");
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_pass, SWIM_DB);
$mysqli->set_charset("utf8");
unset($mysql_host);
unset($mysql_user);
unset($mysql_pass);
?>