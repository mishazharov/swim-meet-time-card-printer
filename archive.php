<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo '5';
	die();
}
if(!isset($_POST['id']) || empty($_POST['id'])){
	echo '2';
	die();
}
if($_SESSION['rank'] < 1){
	echo '4';
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("SELECT rank FROM users WHERE deleted=0 AND id=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
$stmt->bind_result($rank);
if($rank > $_SESSION['rank']){//Prevents people from deleting admins etc. (ranks higher than you)
	echo "3";
	die();
}
$stmt->close();


$stmt = $mysqli->prepare("UPDATE users SET deleted=1 WHERE deleted=0 AND id=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
echo "1";
?>
