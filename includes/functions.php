<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set("error_log", "error_log");

define('URL', "#");//Url to home site in case this is not the main website
define('SITE_NAME', "Swim Site");//For the nav bar etc.
define('TIMEZONE', "America/Toronto");
$whitelist = array("settings.php", "logout.php", "change_pass.php", "new_email.php", "sconfirm.php");
if(isset($_SESSION['setup']) && $_SESSION['setup'] != 3){
	foreach($whitelist as $a){
		if(strtok(basename($_SERVER["REQUEST_URI"]), '?')==$a){
			$allowed = true;
			break;
		}
	}
	if(!isset($allowed)){
		header("HTTP/1.1 303 See Other");
		header('Location: settings.php');//Redirects people in case they have not completed setup
		die();
	}
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
$num_help_boxes = 1;
function help($text, $show){
	global $num_help_boxes;
	?>
	<div style="text-align:center;" class="row bottom3">
		<a class="text-center" data-toggle="collapse" href="#help_<?php echo "$num_help_boxes";?>">Help?</a>
	</div>
	<div id="help_<?php echo "$num_help_boxes";?>" class="row bottom3 <?php echo "collapse "; if($show)echo "in";?>">
		<?php
		if($show){
			echo '<p class="text-center">';
		}else{
			echo '<p class="text-left">';
		}
		echo $text; 
		
		?>
		</p>
	</div>
	<?php
	$num_help_boxes++;
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
function stroke_name_timecard($id){
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
		return "I.M.";
	case 5:
		return "M.R.";
	case 6:
		return "F.R.";
	}
}
function is_relay($id){
	switch($id){
	case 0:
	case 1:
	case 2:
	case 3:
	case 4:
		return false;
	case 5:
	case 6:
		return true;
	}
}
function permission_captain($rank){
	if($rank >= 1){
		return true;
	}
	return false;
}
function permission_manager($rank){
	if($rank >= 2){
		return true;
	}
	return false;
}
function permission_admin($rank){
	if($rank >= 3){
		return true;
	}
	return false;
}
function timecard_contains_user($id1){
	return "(\.|^)".$id1."(\.|$)";
}
function timecard_regex_client(){
	return "[0-9]{2}.[0-9]{2}\.[0-9]{2}|";
}
function time_to_client($time){
	return str_replace(":", ".", (String)$time);
}
function timecard_regex_human(){
	return "MM.SS.MS";
}
function timecard_regex_server(){
	return "/[0-9]{2}.[0-9]{2}\.[0-9]{2}/";
}
function convert_timecard_client_to_server($time){
	//takes "00.00.00" and turns it into "00:00.00"
	return preg_replace('/[.]/', ':', $time, 1);
}
//If bulk timecard operations ever become a thing
class SwimTimecard {
	private $is_relay = false;
	private $name = 0;//The id of the user
	private $stroke = 0;
	private $event = 0;
	private $length = 0;
	private $time = "";// The string which contains the swimmers time
	private $created_by = 0;
	private $deleted = 0;
	private $meet_id = 0;
	private $relay_letter = "";
	private $division = 0;
	private $competes_with = 0;
	private $type = 0;
	public function __construct(){
		
	}
	
	//Getters and setters below
	public function getRelay(){
		return $is_relay;
	}
	public function setName($nn){
		if(is_numeric($nn)){
			$name = $nn;
		}
	}
	public function getName(){
		return $name;
	}
	public function setStroke($nn){
		if(is_numeric($nn)){
			$stroke = $nn;
			if(is_relay($stroke)){
				$is_relay = true;
			}
		}
	}
	public function getStroke(){
		return $stroke;
	}
	public function setEvent($nn){
		if(is_numeric($nn)){
			$event = $nn;
		}
	}
	public function getEvent(){
		return $event;
	}
	public function setLength($nn){
		if(is_numeric($nn)){
			$length = $nn;
		}
	}
	public function getLength(){
		return $length;
	}
	public function setTime($nn){
		$time = $nn;
	}
	public function getTime(){
		return $time;
	}
	public function setCreatedBy($nn){
		if(is_numeric($nn)){
			$created_by = $nn;
		}
	}
	public function getCreatedBy(){
		return $created_by;
	}
	public function setDeleted($nn){
		if(is_numeric($nn)){
			$deleted = $nn;
		}
	}
	public function getDeleted(){
		return $deleted;
	}
	public function setMeetId($nn){
		if(is_numeric($nn)){
			$meet_id = $nn;
		}
	}
	public function getMeetId(){
		return $meet_id;
	}
	public function setRelayLetter($nn){
		if(getRelay()){
			$relay_letter = $nn;
		}
	}
	public function getRelayLetter(){
		return $relay_letter;
	}
	public function setDivision($nn){
		if(is_numeric($nn)){
			$division = $nn;
		}
	}
	public function getDivision(){
		return $division;
	}
	public function setCompetesWith($nn){
		if(is_numeric($nn)){
			$competes_with = $nn;
		}
	}
	public function getCompetesWith(){
		return $competes_with;
	}
	public function setType($nn){
		if(is_numeric($nn)){
			$type = $nn;
		}
	}
	public function getType(){
		return $type;
	}
	//Other methods below
}
?>