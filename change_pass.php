<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo '2';
	die();
}
if(!(isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['confirm_pass']))){
	echo "3";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
if($_SESSION['rank'] >= 3 && ADMIN_AUTH){
	$mysqli->select_db(MAIN_DB);
	$stmt = $mysqli->prepare("SELECT password FROM users WHERE link=?");
	$id = htmlspecialchars($_SESSION['name']);
}else{
	$stmt = $mysqli->prepare("SELECT password FROM users WHERE id=?");
	$id = htmlspecialchars($_SESSION['id']);
}
if(!$stmt->bind_param("s", $id)){
	echo "8";
	die();
}
if(!($stmt->execute())){
	echo "6";
	die();
}
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();

if(!password_verify($_POST['old_pass'], $password)){
	echo "7";
	die();
}
$cost = [
    'cost' => 10,
];
$password = password_hash($_POST['new_pass'], PASSWORD_DEFAULT, $cost);
if($_SESSION['rank'] >=3 && ADMIN_AUTH){
	$stmt = $mysqli->prepare("UPDATE users SET password=? WHERE link=?");
	$stmt->bind_param("ss", $password, $_SESSION['name']);
	$stmt->execute();
	$stmt->close();
}
$mysqli->select_db(SWIM_DB);
$stmt = $mysqli->prepare("UPDATE users SET password=? WHERE id=?");
$stmt->bind_param("si", $password, $_SESSION['id']);
$stmt->execute();
$stmt->close();

if($_SESSION['setup'] == 0){
	$stmt = $mysqli->prepare("UPDATE users SET setup=1 WHERE id=?");
	$stmt->bind_param("i", $_SESSION['id']);
	$stmt->execute();
	$stmt->close();
	$_SESSION['setup']=1;
	echo "1";
}
if($_SESSION['setup'] == 2){
	$stmt = $mysqli->prepare("UPDATE users SET setup=3 WHERE id=?");
	$stmt->bind_param("i", $_SESSION['id']);
	$stmt->execute();
	$_SESSION['setup']=3;
	echo "2";
}
echo "1";
?>