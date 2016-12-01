<?php
//DELETE FROM users WHERE ID = 44
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo '0';
	die();
}
if(!isset($_POST['id']) || empty($_POST['id'])){
	echo '2';
	die();
}
if($_SESSION['rank'] < 2){
	echo "0";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("SELECT rank FROM users WHERE deleted=0 AND id=?");
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
$stmt->bind_result($rank);
if($rank > $_SESSION['rank']){
	echo "0";
	die();
}
$stmt->close();


$stmt = $mysqli->prepare("DELETE FROM users WHERE id=?");//Deleted 2 = really deleted
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();$stmt->close();$stmt = $mysqli->prepare("UPDATE timecards SET deleted=1 WHERE name REGEXP ?");$regex = timecard_contains_user($_POST['id']);$stmt->bind_param("s", $regex);$stmt->execute();
echo "1";
?>