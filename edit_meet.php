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
if(!(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['meet_event_id']))){
	echo "3";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
if(!(isset($_POST['meter']))){
	echo "4";
	die();
}
if(!($_POST['meter'] == 1 || $_POST['meter'] == 0)){
	echo "4";
	die();
}
$stmt = $mysqli->prepare("REPLACE INTO meets (name, date, type, length, id) VALUES (?, ?, ?, ?, ?)");
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$id = htmlspecialchars($_POST['meet_event_id'], ENT_QUOTES);
$stmt->bind_param("ssiii", $name, $date, $id, $_POST['meter'], $_POST['id']);
$stmt->execute();
echo "1";
?>