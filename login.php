<?php

require_once( dirname(__FILE__).'/includes/functions.php');
setcookie("username", htmlspecialchars($_POST['username']), time()+360);
if(!(isset($_POST['username']))){// && isset($_POST['password'])
	header("HTTP/1.1 303 See Other");
	header('Location: index.php?err=1');
	die();
}
require_once( dirname(__FILE__).'/includes/db_connect.php');
$var = $_POST['username'];
if(filter_var($var, FILTER_VALIDATE_EMAIL)){//Checks if it should look for email or name
	$stmt = $mysqli->prepare("SELECT name, password, division, competes_with, rank, id, setup FROM users WHERE email LIKE ? AND deleted=0 AND setup <> 0");
}else{
	$auth_override = true;
	$stmt = $mysqli->prepare("SELECT name, password, division, competes_with, rank, id, setup FROM users WHERE name LIKE ? AND deleted=0 AND setup < 2 AND (email='' OR email IS NULL)");
}


$stmt->bind_param('s', $var);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows == 0){
	header("HTTP/1.1 303 See Other");
	if(isset($_POST['password'])){
		header('Location: index.php?err=1');
	}else{
		header('Location: registeru.php?err=1');
	}
	die();
}
$stmt->bind_result($name_student, $password, $division, $competes_with, $rank, $id, $setup);
$stmt->fetch();
$stmt->close();
if($rank >= 3 && ADMIN_AUTH){//Admins are authenticated through the main site DB
	$mysqli->select_db(MAIN_DB);
	$stmt = $mysqli->prepare("SELECT name, password FROM users WHERE link = ? AND deleted=0");
	$var = $_POST['username'];
	$stmt->bind_param('s', $var);
	$stmt->execute();
	$stmt->bind_result($name, $password);
	$stmt->fetch();
	if((isset($auth_override) && isset($id) && $setup < 0) || password_verify($_POST['password'], $password)){
		
		$_SESSION['name'] = htmlspecialchars($name, ENT_QUOTES);
		$_SESSION['division'] = htmlspecialchars($division, ENT_QUOTES);
		$_SESSION['competes_with'] = htmlspecialchars($competes_with, ENT_QUOTES);
		$_SESSION['rank'] = htmlspecialchars($rank, ENT_QUOTES);
		$_SESSION['id'] = htmlspecialchars($id, ENT_QUOTES);
		$_SESSION['setup'] = htmlspecialchars($setup, ENT_QUOTES);
		header("HTTP/1.1 303 See Other");
		header('Location: home.php');
		die();
	}else{
		header("HTTP/1.1 303 See Other");
		if(isset($_POST['password'])){
			header('Location: index.php?err=1');
		}else{
			header('Location: registeru.php?err=1');
		}
		die();
	}
}
if((isset($auth_override) && $setup < 3  && isset($id)) || ((isset($_POST['password']) && password_verify($_POST['password'], $password)))){
	
	$_SESSION['name'] = htmlspecialchars($name_student, ENT_QUOTES);
	$_SESSION['division'] = htmlspecialchars($division, ENT_QUOTES);
	$_SESSION['competes_with'] = htmlspecialchars($competes_with, ENT_QUOTES);
	$_SESSION['rank'] = htmlspecialchars($rank, ENT_QUOTES);
	$_SESSION['id'] = htmlspecialchars($id, ENT_QUOTES);
	$_SESSION['setup'] = htmlspecialchars($setup, ENT_QUOTES);
	header("HTTP/1.1 303 See Other");
	header('Location: home.php');
	die();
}else{
	header("HTTP/1.1 303 See Other");
	if(!isset($_POST['password'])){
		header('Location: registeru.php?err=1');
	}else{
		header('Location: index.php?err=1');
	}
	die();
}
?>