<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo '0';
	die();
}
if(!(isset($_POST['name']) && isset($_POST['grade']) && isset($_POST['competes_with']) && isset($_POST['rank']))){
	echo "0";
	die();
}
if($_POST['rank'] >= $_SESSION['rank']){
	echo "0";
	die();
}

if(empty($_POST['name'])){
	echo "0";
	die();
}
require_once(dirname(__FILE__). '/includes/db_connect.php');
$usernames = explode(",",$_POST['name']);
$sql = "INSERT INTO users (name, division, competes_with, rank, password, grade) VALUES (?, ?, ?, ?, ?, ?)";
foreach($usernames as $username){
	
	if(empty($username) || count(explode(".", $username)) != 2){
		continue;
	}
	
	$stmt = $mysqli->prepare($sql);
	$name = htmlspecialchars($username);
	if($_POST['grade'] == 9 || $_POST['grade'] == 10){
		$division = 1;
	}
	if($_POST['grade'] == 11 || $_POST['grade'] == 12 || $_POST['grade'] == 13){
		$division = 2;
	}
	if($_POST['grade'] == -1){
		$division = -1;
	}
	if(isset($_POST['open']) || $_SESSION['division'] == 0){
		$division = 0;
	}
	$competes_with = htmlspecialchars($_POST['competes_with']);
	if($_SESSION['rank'] == 1){
		if(!($_SESSION['division'] == $division)){
			echo "0";
			die();
		}
		if(!($_SESSION['competes_with'] == $competes_with)){
			echo "0";
			die();
		}
	}

	$rank = htmlspecialchars($_POST['rank']);
	$grade = htmlspecialchars($_POST['grade']);
	$cost = [
		'cost' => 12,
	];
	$password = password_hash($name, PASSWORD_DEFAULT, $cost);
	if(!($stmt->bind_param("siiisi", $name, $division, $competes_with, $rank, $password, $grade))){
		echo "0";
		die();
	}
	if(!($stmt->execute())){
		echo "2";
		die();
	}
	$stmt->close();
}
echo "1";
?>