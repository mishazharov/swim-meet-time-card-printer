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
if(!preg_match("/[0-9]{2}:[0-9]{2}\.[0-9]{2}|/", $_POST['time'])){
	echo "Your time does not match the specified format of: Minutes:Seconds.Milliseconds";
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
foreach($events as $temp){
	if($temp->event == $_POST['event']){
		$stroke = $temp->stroke;
		if($stroke > 4 && !isset($_POST['relay_letter'])){echo "You need to add a relay letter for relays."; die();}
		if($_SESSION['rank'] < 1 && $stroke > 4){ echo "You require more permissions to do this..."; die();}
		if($_SESSION['rank'] < 2 && ($temp->competes_with != $_SESSION['competes_with'] || $temp->division != $_SESSION['division'])){ echo "You require more permissions to do this..."; die();}
		$length = $temp->length;
		$event = $temp->event;
		$competes_with = $temp->competes_with;
		$division = $temp->division;
		break;
	}
}
$f_name = "";
if($_SESSION['rank'] >= 1){
	foreach($_POST['swimmer_id'] as $u_name){
		$f_name .= $u_name.".";
	}
}else{
	if(count($_POST['swimmer_id']) > 1){
		echo "Only captains can make relays...";
		die();
	}
	$f_name = $_SESSION['id'];
}
$stmt = $mysqli->prepare("INSERT INTO timecards (name, stroke, length, event, time, created_by, meet_id, division, competes_with, relay_letter, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if(!isset($_POST['relay_letter'])){$_POST['relay_letter']='';}
if($_POST['relay_letter']!=''){
	switch($_POST['relay_letter']){
		case 0:
			$_POST['relay_letter'] = 'A';
			break;
		case 1:
			$_POST['relay_letter'] = 'B';
			break;
		case 2:
			$_POST['relay_letter'] = 'C';
			break;
	}
}

if(!isset($_POST['time'])){
	$_POST['time']="";
}
$stmt->bind_param("siiisiiiisi", $f_name, $stroke, $length, $event, $_POST['time'], $_SESSION['id'], $_POST['meet_id'], $division, $competes_with, $_POST['relay_letter'], $type);
$stmt->execute();
if($mysqli->errno === 1062){
	echo "This event already exists, if you would like to edit it please see the edit timecard section";
	die();
}
echo "1";
?>