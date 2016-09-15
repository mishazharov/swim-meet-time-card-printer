<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
		echo "0";
		die();
}
if($_SESSION['rank'] < 2){
	echo "2";
	die();
}
if(!(isset($_POST['id']))){
	echo "3";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');

$stmt = $mysqli->prepare("UPDATE meets SET active = IF(active=1, 0, 1) WHERE id = ?");
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
echo "1";
?>