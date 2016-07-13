<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
	require_once( dirname(__FILE__).'/includes/functions.php');
	setcookie("username", htmlspecialchars($_POST['username']), time()+360);
	if(!(isset($_POST['username']) && isset($_POST['password']))){
		header("HTTP/1.1 303 See Other");
		header('Location: index.php?err=1');
		die();
	}
	require_once( dirname(__FILE__).'/includes/db_connect.php');
	$stmt = $mysqli->prepare("SELECT password, division, competes_with, rank, id, setup FROM users WHERE name = ? AND deleted=0");
	$var = $_POST['username'];
	$stmt->bind_param('s', $var);
	$stmt->execute();
	$stmt->bind_result($password, $division, $competes_with, $rank, $id, $setup);
	$stmt->fetch();
	$stmt->close();
	if($rank >= 3 && ADMIN_AUTH){//Admins are authenticated through the main site DB
		$mysqli->select_db(MAIN_DB);
		$stmt = $mysqli->prepare("SELECT password FROM users WHERE link = ? AND deleted=0");
		$var = $_POST['username'];
		$stmt->bind_param('s', $var);
		$stmt->execute();
		$stmt->bind_result($password);
		$stmt->fetch();
		if(password_verify($_POST['password'], $password)){
			header("HTTP/1.1 303 See Other");
			header('Location: home.php');
			$_SESSION['name'] = htmlspecialchars($_POST['username'], ENT_QUOTES);
			$_SESSION['division'] = htmlspecialchars($division, ENT_QUOTES);
			$_SESSION['competes_with'] = htmlspecialchars($competes_with, ENT_QUOTES);
			$_SESSION['rank'] = htmlspecialchars($rank, ENT_QUOTES);
			$_SESSION['id'] = htmlspecialchars($id, ENT_QUOTES);
			$_SESSION['setup'] = htmlspecialchars($setup, ENT_QUOTES);
			die();
		}else{
			header("HTTP/1.1 303 See Other");
			header('Location: index.php?err=1');
			die();
		}
	}
	if(password_verify($_POST['password'], $password)){
		header("HTTP/1.1 303 See Other");
		header('Location: home.php');
		$_SESSION['name'] = htmlspecialchars($_POST['username'], ENT_QUOTES);
		$_SESSION['division'] = htmlspecialchars($division, ENT_QUOTES);
		$_SESSION['competes_with'] = htmlspecialchars($competes_with, ENT_QUOTES);
		$_SESSION['rank'] = htmlspecialchars($rank, ENT_QUOTES);
		$_SESSION['id'] = htmlspecialchars($id, ENT_QUOTES);
		$_SESSION['setup'] = htmlspecialchars($setup, ENT_QUOTES);
		die();
	}else{
		header("HTTP/1.1 303 See Other");
		header('Location: index.php?err=1');
		die();
	}
?>