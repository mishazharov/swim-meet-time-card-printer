<?php
require_once( dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo "0";
	die();
}
if(!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)){
	echo "5";
	die();
}
require_once( dirname(__FILE__).'/includes/db_connect.php');
if(!($stmt = $mysqli->prepare("UPDATE users SET email=? WHERE deleted=0 AND id=?"))){
	echo "2";
	die();
}
if(!$stmt->bind_param("si", $_POST['new_email'], $_SESSION['id'])){
	echo "3";
	die();
}
if(!$stmt->execute()){
	echo "4";
	die();
}
$stmt->close();
if($_SESSION['setup'] == 1){
	$stmt = $mysqli->prepare("UPDATE users SET setup=3 WHERE name=?");
	$stmt->bind_param("s", $_SESSION['name']);
	$stmt->execute();
	$_SESSION['setup']=3;
	echo "2";
}
if($_SESSION['setup'] == 0){
	$stmt = $mysqli->prepare("UPDATE users SET setup=2 WHERE name=?");
	$stmt->bind_param("s", $_SESSION['name']);
	$stmt->execute();
	$_SESSION['setup']=2;
	echo "1";
}
echo "1";
?>