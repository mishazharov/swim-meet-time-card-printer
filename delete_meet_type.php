<?php
//DELETE FROM users WHERE ID = 44
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo 'You must be logged in...';
	die();
}
if(!isset($_POST['id']) || empty($_POST['id'])){
	echo 'Broken Request.';
	die();
}
if($_SESSION['rank'] < 2){
	echo "You do not have enough permissions to perform this action.";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');

$stmt = $mysqli->prepare("UPDATE meet_events SET deleted=1 WHERE deleted=0 AND id=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
$stmt->close();

$stmt = $mysqli->prepare("UPDATE meets SET deleted=1 WHERE deleted=0 AND type=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();

$stmt = $mysqli->prepare("UPDATE timecards SET deleted=1 WHERE deleted=0 AND type=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
echo "1";
?>