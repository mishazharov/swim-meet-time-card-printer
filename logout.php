<?php
require_once( dirname(__FILE__).'/includes/functions.php');
session_destroy();
session_unset();
header("HTTP/1.1 303 See Other");
header('Location: index.php?err=2');
die();
?>