<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo 'Not logged in!';
	die();
}
if(!(isset($_POST['swimmer_id']) && isset($_POST['event']) && isset($_POST['meet_id']))){
	echo 'Broken request!';
	die();
}

require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("SELECT type, active FROM meets WHERE deleted=0 AND id=?");
$stmt->bind_param("i", $_POST['meet_id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($type, $active);
$stmt->fetch();
$stmt->close();
//To get the meet type id
if($active != 1){
	echo "This meet is no longer open for adding timecards.";
	die();
}

$stmt = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted=0 AND id=?");
$stmt->bind_param("i", $type);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($text);
$stmt->fetch();
$stmt->close();
//Get the meet events info


echo "1";
?>