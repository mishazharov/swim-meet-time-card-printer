<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo "You must be logged in...";
	die();
}
if($_SESSION['rank']<2){
	echo "You do not have enough permissions to perform this action.";
	die();
}
if(!(isset($_POST['name']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['meet_event_id']))){
	echo "Broken Request.";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
if(!(isset($_POST['meter']))){
	echo "You must specify the pool length.";
	die();
}
if(!($_POST['meter'] == 1 || $_POST['meter'] == 0)){
	echo "Not a valid pool length.";
	die();
}
$stmt = $mysqli->prepare("INSERT INTO meets (name, date, type, length) VALUES (?, ?, ?, ?)");
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$id = htmlspecialchars($_POST['meet_event_id'], ENT_QUOTES);
$stmt->bind_param("ssii", $name, $date, $id, $_POST['meter']);
$stmt->execute();
echo "1";
?>