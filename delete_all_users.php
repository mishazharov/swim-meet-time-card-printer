<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if($_POST['id'] == 0 && permission_admin($_SESSION['rank'])){
	require_once(dirname(__FILE__).'/includes/db_connect.php');
	$stmt = $mysqli->prepare("DELETE FROM users WHERE rank<3");
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("DELETE FROM meets");
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("DELETE FROM timecards");
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("DELETE FROM reset_password");
	$stmt->execute();
	$stmt->close();
	echo "1";
	die();
}
echo "0";
die();
?>