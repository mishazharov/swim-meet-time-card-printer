<?php
session_start();

define('URL', "#");//Url to home site in case this is not the main website
define('SITE_NAME', "Swim Site");//For the nav bar etc.
define('TIMEZONE', "America/Toronto");

if(isset($_SESSION['setup']) && $_SESSION['setup'] != 3 && (strtok(basename($_SERVER["REQUEST_URI"]), '?')!="settings.php") && (strtok(basename($_SERVER["REQUEST_URI"]), '?')!="logout.php") && (strtok(basename($_SERVER["REQUEST_URI"]), '?')!="change_pass.php") && (strtok(basename($_SERVER["REQUEST_URI"]), '?')!="new_email.php")){
	header("HTTP/1.1 303 See Other");
	header('Location: settings.php');//Redirects people in case they have not completed setup
	die();
}
date_default_timezone_set(TIMEZONE);//Sets the timezone
function division($grade){//DOES NOT WORK FOR OPEN SWIMMERS!!!!
	switch($grade){
		case 9:
		case 10:
			return 1;
		case 11:
		case 12:
		case 13:
			return 2;
		default:
			return -1;
	}
}
function division_name($division){
	switch($division){
		case 0:
			return "Open";
		case 1:
			return "Junior";
		case 2:
			return "Senior";
	}
}
function rank($rank){
	switch($rank){
		case 0:
			return "Swimmer";
		case 1:
			return "Captain";
		case 2:
			return "Manager";
		case 3:
			return "Admin";
		case ($rank > 3):
			return "Super Admin";
		default:
			return "Unknown Rank";
		
	}
}
function competes_with($competes_with){
	switch($competes_with){
		case 0:
			return "Girls";
		case 1:
			return "Boys";
		default:
			return "Unknown";
		
	}
}
function name($name){
	return str_replace(".", " ", $name);
}
function stroke($id){
	switch($id){
	case 0:
		return "Fly";
	case 1:
		return "Back";
	case 2:
		return "Breast";
	case 3:
		return "Free";
	case 4:
		return "I.M";
	case 5:
		return "Medley relay";
	case 6:
		return "Free relay";
	}
}
?>