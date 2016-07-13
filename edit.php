<?php
require_once(dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
		header("HTTP/1.1 303 See Other");
		header('Location: index.php');
		die();
}
if(!(isset($_POST['id']) && (isset($_POST['grade']) || isset($_POST['competes_with']) || isset($_POST['rank'])))){
	echo "0";
	die();
}
if($_SESSION['rank'] < 1){
	echo "0";
	die();
}
require_once(dirname(__FILE__).'/includes/db_connect.php');
if(!($stmt = $mysqli->prepare("SELECT rank, division, competes_with FROM users WHERE id = ? AND deleted = 0"))){
	echo "2";
	die();
}
$var = htmlspecialchars($_POST['id'], ENT_QUOTES);
$stmt->bind_param("i", $var);
$stmt->execute();
$stmt->bind_result($rank, $division, $competes_with);
$stmt->fetch();
if($rank >= $_SESSION['rank']){
	echo "3";
	die();
}
if($_SESSION['rank'] == 1){
	if($division != $_SESSION['division'] && !($division == -1)){
		echo "4";
		die();
	}
	if($competes_with != $_SESSION['competes_with']){
		echo "5";
		die();
	}
}
$stmt->close();
if(($division != 0 && $division != division($_POST['grade'])) && $_SESSION['rank'] < 2){
	echo "21";
	die();
}
if(isset($_POST['grade'])){
	if(!($stmt = $mysqli->prepare("UPDATE users SET grade=? WHERE deleted=0 AND id=?"))){
		echo "10";
		die();
	}
	$var = htmlspecialchars($_POST['grade']);
	$stmt->bind_param("ii", $var, $_POST['id']);
	if(!$stmt->execute()){
		echo "8";
		die();
	}
	$stmt->close();
	if($division != 0 && $division != division($_POST['grade'])){
		if(!($stmt = $mysqli->prepare("UPDATE users SET division=? WHERE deleted=0 AND id=?"))){
			echo "15";
			die();
		}
		$var = htmlspecialchars(division($_POST['grade']));
		$stmt->bind_param("ii", $var, $_POST['id']);
		if(!$stmt->execute()){
			echo "12";
			die();
		}
	}
}
if(isset($_POST['competes_with'])){
	if(!($stmt = $mysqli->prepare("UPDATE users SET competes_with=? WHERE deleted=0 AND id=?"))){
		echo "9";
		die();
	}
	$var = htmlspecialchars($_POST['competes_with']);
	$stmt->bind_param("ii", $var, $_POST['id']);
	if(!$stmt->execute()){
		echo "11";
		die();
	}
	$stmt->close();
}
if(isset($_POST['rank'])){
	if(!($stmt = $mysqli->prepare("UPDATE users SET rank=? WHERE deleted=0 AND id=?"))){
		echo "13";
		die();
	}
	$var = htmlspecialchars($_POST['rank']);
	$stmt->bind_param("ii", $var, $_POST['id']);
	if(!$stmt->execute()){
		echo "14";
		die();
	}
	$stmt->close();
}
echo "1";
?>
