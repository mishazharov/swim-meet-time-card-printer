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
if(!(isset($_POST['name']) && isset($_POST['meet']))){
	echo "0";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("REPLACE INTO meet_events (name, text, id) VALUES (?,?,?)");
$var = htmlspecialchars($_POST['name'], ENT_QUOTES);
$meet=$_POST['meet'];
$meet = array_values($meet);
$meet = json_encode($meet);
$stmt->bind_param("ssi", $var, $meet, $_POST['id']);
$stmt->execute();
echo "1";
?>