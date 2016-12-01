<?php
require_once( dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo "Please log in again";
	die();
}
if(!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)){
	echo "Invalid email format";
	die();
}
require_once( dirname(__FILE__).'/includes/db_connect.php');
if(!($stmt = $mysqli->prepare("UPDATE users SET email=? WHERE deleted=0 AND id=?"))){
	echo "Database error, please report to Dev";
	die();
}
if(!$stmt->bind_param("si", $_POST['new_email'], $_SESSION['id'])){
	echo "Database error 2, please report to Dev";
	die();
}
if(!$stmt->execute()){
	echo "Error 3: This email likely exists already, please chose a different one, or contact a coach.";
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
setcookie("username", htmlspecialchars($_POST['new_email']), time()+360);
echo "1";
?>