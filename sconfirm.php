<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo '5';
	die();
}
if(!isset($_POST['grade']) || !isset($_POST["competes_with"])){
	echo '4';
	die();
}
if($_POST['grade'] > 14 || $_POST['grade'] < 9){
	echo '3';
	die();
}
if($_POST["competes_with"]!=0 && $_POST["competes_with"] !=1){
	echo '2';
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("UPDATE users SET grade=?, competes_with=?, division=? WHERE deleted=0 AND id=?");
$_SESSION['division'] = division($_POST['grade']);
if(isset($_POST['open'])){
	$_SESSION['division'] = 0;
}
$stmt->bind_param("iiii", $_POST['grade'], $_POST["competes_with"], $_SESSION['division'], $_SESSION["id"]);
$_SESSION['competes_with'] = $_POST["competes_with"];
$stmt->execute();
//echo $_POST['grade']." ". $_POST["competes_with"]." ". $_SESSION["id"];
echo "1";
?>