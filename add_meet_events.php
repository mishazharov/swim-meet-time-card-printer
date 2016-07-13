<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	header("HTTP/1.1 303 See Other");
	header('Location: index.php');
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
$stmt = $mysqli->prepare("INSERT INTO meet_events (name, text) VALUES (?,?)");
$var = htmlspecialchars($_POST['name'], ENT_QUOTES);
$meet = json_encode(array_values($_POST['meet']));
$stmt->bind_param("ss", $var, $meet);
$stmt->execute();
echo "1";
?>