<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo 'You must be logged in...';
	die();
}
if(!(isset($_POST['swimmer_id']) && isset($_POST['event'])&& isset($_POST['time'])&& isset($_POST['meet_id']) && isset($_POST['timecard_id']))){
	echo 'Broken Request.';
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("SELECT type FROM meets WHERE deleted=0 AND id=?");
$stmt->bind_param("i", $_POST['meet_id']);
$stmt->execute();
$stmt->bind_result($type);
$stmt->fetch();
$stmt->close();
//To get the meet type id

$stmt = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted=0 AND id=?");
$stmt->bind_param("i", $type);
$stmt->execute();
$stmt->bind_result($text);
$stmt->fetch();
$stmt->close();
//Get the meet events info

$events = json_decode($text);
foreach($events as $temp){//Checks which the event on the timecard that is being deleted can be deleted by the user
	if($temp->event == $_POST['event']){
		$stroke = $temp->stroke;
		if($_SESSION['rank'] < 1 && $stroke > 3){ echo "5"; die();}
		if($_SESSION['rank'] < 2 && ($temp->competes_with != $_SESSION['competes_with'] || $temp->division != $_SESSION['division'])){ echo "7"; die();}
		$length = $temp->length;
		$event = $temp->event;
		$competes_with = $temp->competes_with;
		$division = $temp->division;
		break;
	}
}
if($_SESSION['rank'] == 0 && $_POST['swimmer_id'].length > 1){
	echo "You do not have enough permissions to perform this request";
	die();
}
$f_name = "";
if($_SESSION['rank'] >= 1){
	foreach($_POST['swimmer_id'] as $u_name){
		$f_name .= $u_name.".";
	}
}else{
	$f_name = $_SESSION['id'];
}
if($_SESSION['rank'] < 2){//If this is not an admin, more checks are done to see if the timecard can be deleted
	$stmt = $mysqli->prepare("SELECT name, division, competes_with, relay_letter FROM timecards WHERE deleted=0 AND id=?");
	$stmt->bind_param("i", $_POST['timecard_id']);
	$stmt->execute();
	$stmt->bind_result($name, $division, $competes_with, $relay_letter);
	$stmt->fetch();
	$stmt->close();
	$name = explode(".", $name);
	foreach($name as $temp){
		if(($temp == $_SESSION['id'] && empty($relay_letter)) || ($_SESSION['rank'] == 1 && $competes_with == $_SESSION['competes_with'] && $division == $_SESSION['division'])){
			$found = true;
			break;
		}
	}
	if(!isset($found)){echo "9"; die();}
}
$stmt = $mysqli->prepare("UPDATE timecards SET deleted=1 WHERE id=?");
$stmt->bind_param("i", $_POST['timecard_id']);
$stmt->execute();
echo "1";
?>