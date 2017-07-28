<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set("error_log", "error_log");
require_once( dirname(__FILE__).'/includes/functions.php');
require_once(dirname(__FILE__).'/includes/db_connect.php');require_once( dirname(__FILE__).'/fpdf/fpdf.php');require_once( dirname(__FILE__).'/fpdi/fpdi.php');

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile('timecard.pdf');

$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);

require_once( dirname(__FILE__).'/includes/db_connect.php');
$stmt = $mysqli->prepare("SELECT type, length FROM meets WHERE deleted = 0 AND id=?");
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$stmt->bind_result($type, $pool_length);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted=0 AND id=?");
$stmt->bind_param('i', $type);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($text);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare('SELECT name, id FROM users WHERE deleted=0');
$stmt->execute();
$stmt->bind_result($swimmer_name, $swimmer_id);
$u_arr_1 = array();
while($stmt->fetch()){
	$swimmer_name = str_replace("\t", '', $swimmer_name);
	$u_tmp_1 = new stdClass();
	$u_tmp_1->name = $swimmer_name;
	$u_arr_1[$swimmer_id] = $u_tmp_1;
	unset($u_tmp_1);
}
//$u_arr_1 contains user information, $u_arr_1[user_id]
$stmt->close();
$text = str_replace("'", "&#39", $text);
$tmptmp = json_decode($text);
$arr = array();
if($tmptmp == null){
	echo "Invalid meet";
	die();
}
$i = 0;
$x_off = 0;
$y_off = 0;
foreach($tmptmp as $u_t){
	$stmt = $mysqli->prepare("SELECT name, time, relay_letter, event FROM timecards WHERE deleted=0 AND meet_id = ? AND event = ? ORDER BY CONVERT(time, TIME)");
	$stmt->bind_param('ii', $_GET['id'], $u_t->event);
	$stmt->execute();
	$stmt->bind_result($name, $time, $relay_letter, $event);
	$ok = true;
	if(isset($_SESSION['rank']) && !permission_manager($_SESSION['rank']) && ($_SESSION['division'] != $u_t->division || $_SESSION['competes_with'] != $u_t->competes_with)){
		$ok = false;
	}
	while($stmt->fetch() && $ok){
		if(empty($name))continue;
		if(empty($event))continue;

		if($i == 0){
			$x_off = 0;
			$y_off = 0;
		}
		if($i == 1){
			$x_off = 102;
			$y_off = 0;
		}
		if($i == 2){
			$x_off = 0;
			$y_off = 120.5;
		}
		if($i == 3){
			$x_off = 102;
			$y_off = 120.5;
		}
		//Sets names in PDF
		$pdf->SetFont('Arial','', 12);
		$name = explode(".", $name);
		$further_y_disp = 0;
		foreach($name as $n){
			if($n == "")continue;
			$pdf->SetXY(30 + $x_off, 58.5 + $y_off + $further_y_disp);
			if($n != -1){	
				$s_name = explode(".", $u_arr_1[$n]->name);
			}
			//Edge case for -1 name
			if($n != -1){
				$pdf->Write(0, $s_name[1]);
			}
			$pdf->SetXY(68 + $x_off, 58.5 + $y_off + $further_y_disp);
			if($n != -1){
				$pdf->Write(0, $s_name[0]);
			}
			$further_y_disp += 5;
		}
		
		//Sets School in PDF
		$pdf->SetFont('Arial','', 11);
		$pdf->SetXY(30 + $x_off, 49 + $y_off);
		if($relay_letter != ""){
			$pdf->Write(0, "Ursula Franklin Academy (" . $relay_letter .")");
		}else{
			$pdf->Write(0, "Ursula Franklin Academy");
		}
		
		//Sets Event in PDF
		$pdf->SetFont('Arial','', 20);
		$pdf->SetXY(35 + $x_off, 27 + $y_off);
		$pdf->Write(0, $event);
		
		//Sets Time in PDF
		$pdf->SetFont('Arial','', 12);
		$pdf->SetXY(68 + $x_off, 29 + $y_off);
		if($time == ""){
			$pdf->Write(0, "NT");
		}else{
			$pdf->Write(0, $time);
		}
		
		//Sets Length in PDF
		$pdf->SetFont('Arial','', 12);
		$pdf->SetXY(11 + $x_off, 42 + $y_off);
		if($pool_length == 1){
			$pdf->Write(0, "  ".$u_t->length." m");
		} else {
			$pdf->Write(0, $u_t->length." yds.");
		}
		
		//Sets division in pdf
		$pdf->SetFont('Arial','', 12);
		$pdf->SetXY(30 + $x_off, 34 + $y_off);
		$pdf->Write(0, division_name($u_t->division));
		$pdf->SetXY(50 + $x_off, 34 + $y_off);
		$pdf->Write(0, division_name($u_t->division));
		$pdf->SetXY(70 + $x_off, 34 + $y_off);
		$pdf->Write(0, division_name($u_t->division));
		
		//Sets stroke in pdf
		$pdf->SetFont('Arial','', 12);
		$pdf->SetXY(32 + $x_off, 42 + $y_off);
		$pdf->Write(0, stroke_name_timecard($u_t->stroke));
		$pdf->SetXY(52 + $x_off, 42 + $y_off);
		$pdf->Write(0, stroke_name_timecard($u_t->stroke));
		$pdf->SetXY(71 + $x_off, 42 + $y_off);
		$pdf->Write(0, stroke_name_timecard($u_t->stroke));
		
		$tmp = new stdClass();
		$tmp->name = name($name);
		$tmp->time = $time;
		$arr[] = $tmp;
		unset($tmp);
		if($i == 3){
			$tplIdx = $pdf->importPage(1);
			$pdf->addPage();
			$pdf->useTemplate($tplIdx);
			$i = 0;
		}else{
			$i++;
		}
	}
	$stmt->close();
}
$pdf->Output();
?>