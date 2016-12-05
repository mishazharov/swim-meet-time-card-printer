<?phpini_set('display_errors', 0);ini_set('display_startup_errors', 0);ini_set('log_errors', 1);ini_set("error_log", "error_log");error_reporting(E_ALL);
	require_once( dirname(__FILE__).'/includes/functions.php');
	if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
		header("HTTP/1.1 303 See Other");
		header('Location: home.php');
		die();
	}
	if(!isset($_GET['id'])){	
?>
<!DOCTYPE html>
<html>	<head>		<?php		include( dirname(__FILE__).'/includes/head.php');		?>	</head>
	<body>
		<?php		include( dirname(__FILE__).'/includes/nav.php');		?>
		<div class='container'>
			<div class='jumbotron'>
				<h2 class="text-center">Print timecards</h2>
				<div style="text-align:center;" class="row bottom3">
					<a class="text-center" data-toggle="collapse" href="#print_widget_help">Help?</a>
				</div>
				<div id="print_widget_help" class="row bottom3 collapse">
					<p class="text-left">Click on a meet name and it will take you to a printer friendly page, then click CTRL + P in order to print the timecards.</p>
				</div>
				<?php
				require_once( dirname(__FILE__).'/includes/db_connect.php');
				$stmt = $mysqli->prepare("SELECT name, id FROM meets WHERE deleted = 0 AND date > CURDATE()");
				$stmt->execute();
				$stmt->bind_result($name, $id);
				while($stmt->fetch()){
					echo "<div class='row bottom2'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><h4 class='text-center'><a href='print2.php?id=$id'>$name</a></h4></div></div>";
				}
				$stmt->close();
				?>
			</div>
		</div>		<?php		include( dirname(__FILE__).'/includes/scripts.php');		?>
	</body>
</html>
<?php
	}else{
?><!DOCTYPE html><html moznomarginboxes mozdisallowselectionprint><head><?php	include(dirname(__FILE__).'/includes/favicon.php');?><title>Print Timecards</title><style>
* { margin: 0; padding: 0;}canvas {	page-break-after: always;}@media print {  @page { margin: 0; }  body { margin: 1.6cm; }}</style>
</head><body>
<?php
		require_once( dirname(__FILE__).'/includes/db_connect.php');
		$stmt = $mysqli->prepare("SELECT type FROM meets WHERE deleted = 0 AND id=?");
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($type);
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted=0 AND id=?");
		$stmt->bind_param('i', $type);
		$stmt->execute();
		$stmt->bind_result($text);
		$stmt->fetch();
		$stmt->close();
				$stmt = $mysqli->prepare('SELECT name, id FROM users WHERE deleted=0 AND rank < 2');		$stmt->execute();		$stmt->bind_result($swimmer_name, $swimmer_id);		$u_arr_1 = array();		while($stmt->fetch()){			$swimmer_name = str_replace("\t", '', $swimmer_name);			$u_tmp_1 = new stdClass();			$u_tmp_1->name = $swimmer_name;			$u_tmp_1->id = $swimmer_id;			$u_arr_1[] = $u_tmp_1;			unset($u_tmp_1);		}		$u_arr_1 = json_encode($u_arr_1);		$u_arr_1 = str_replace("'", "&#39", $u_arr_1);		echo "<script>document.swimmers = '$u_arr_1';</script>";		unset($u_arr_1);		$text = str_replace("'", "&#39", $text);		echo "<script>document.swim_events='$text';</script>";
		$stmt->close();		$tmptmp = json_decode($text);		$arr = array();		foreach($tmptmp as $u_t){
			$stmt = $mysqli->prepare("SELECT name, time, relay_letter, event FROM timecards WHERE deleted=0 AND meet_id = ? AND event = ? ORDER BY CONVERT(time, TIME)");			$stmt->bind_param('ii', $_GET['id'], $u_t->event);
			$stmt->execute();
			$stmt->bind_result($name, $time, $relay_letter, $event);
			while($stmt->fetch()){				if(empty($name))continue;				if(empty($event))continue;				$tmp = new stdClass();
				$tmp->name = name($name);				$tmp->time = $time;				$tmp->relay_letter = $relay_letter;				$tmp->event = $event;				$arr[] = $tmp;				unset($tmp);
			}
			$stmt->close();		}		$arr = json_encode($arr);		$arr = str_replace("'", "&#39", $arr);				echo "<script>document.timecards = '$arr';</script>";
	}
?><?php if(isset($_GET['id'])){ ?>
<script>var img = new Image();img.onload = function() {	var timecards = JSON.parse(document.timecards);	var swimmers = JSON.parse(document.swimmers);	var events = JSON.parse(document.swim_events);	var scale = 0.8;		for(var i = 0; i < timecards.length; i+=4){		var c = document.createElement('canvas');		c.width = 790;		c.height = 449 * 2;		var ctx = c.getContext("2d");		ctx.font = "200 25px Calibri";		draw_timecard(ctx, 0, 0, scale, timecards[i], swimmers, events);		ctx.font = "200 25px Calibri";		draw_timecard(ctx, img.width + 10, 0, scale, timecards[i + 1], swimmers, events);		ctx.font = "200 25px Calibri";		draw_timecard(ctx, 0, img.height, scale, timecards[i + 2], swimmers, events);		ctx.font = "200 25px Calibri";		draw_timecard(ctx, img.width + 10, img.height, scale, timecards[i + 3], swimmers, events);		document.body.appendChild(c);	}};function draw_timecard(ctx, x, y, scale, timecard, swimmers, events){	ctx.drawImage(img, x * scale, y * scale, img.width * scale, img.height * scale);	var event;	for(var i = 0; i < events.length; i++){		if(events[i] && timecard && events[i].event == timecard.event){			event = events[i];			break;		}	}	ctx.font = "200 20px Calibri";	if(timecard){		ctx.fillText(timecard.event, (x * scale) + 100, (y * scale) + 35);		var timecard_names = timecard.name.split(' ');				for(var b = 0; b < timecard_names.length; b++){			if(timecard_names[i] == '')continue;			for(var i = 0; i < swimmers.length; i++){				if(swimmers[i].id == timecard_names[b]){					var names = swimmers[i].name.split('.');					ctx.fillText(names[0], (x * scale) + 230, (y * scale) + 155 + (b * 19));					names.shift();					ctx.fillText(names.join(' '), (x * scale) + 85, (y * scale) + 155 + (b * 19));				}			}		}	}	if(event && timecard.relay_letter){		ctx.fillText('Ursula Franklin Academy (' + timecard.relay_letter + ')', (x * scale) + 85, (y * scale) + 118);	}else{		ctx.fillText('Ursula Franklin Academy ', (x * scale) + 85, (y * scale) + 118);	}	if(event){		if(timecard.time == ''){			ctx.fillText('NT', (x * scale) + 232, (y * scale) + 42);		}		ctx.fillText(timecard.time, (x * scale) + 232, (y * scale) + 42);	}	if(event){		senior_delete(ctx);		open_delete(ctx);		junior_delete(ctx);	}	if(event){		ctx.font = "500 15px Calibri";		ctx.fillStyle="black";		ctx.fillText(division(parseInt(event.division)), (x * scale) + 100, (y * scale) + 61);		ctx.fillText(division(parseInt(event.division)), (x * scale) + 170, (y * scale) + 61);		ctx.fillText(division(parseInt(event.division)), (x * scale) + 240, (y * scale) + 61);		ctx.font = "200 20px Calibri";	}	event_length_draw(ctx, event);	event_stroke_draw(ctx, event);	ctx.fillStyle="black";	function event_length_draw(ctx, event){		if(event){			ctx.fillStyle="white";			ctx.fillRect(x * scale + 18, y * scale + 70, 55, 30);			ctx.fillStyle="black";			ctx.fillText(event.length, (x * scale) + 30, (y * scale) + 90);			//ctx.fill();		}	}	function event_stroke_draw(ctx, event){		if(event){			ctx.fillStyle="white";			ctx.fillRect(x * scale + 85, y * scale + 69, 55, 30);			ctx.fillRect(x * scale + 160, y * scale + 69, 55, 30);			ctx.fillRect(x * scale + 230, y * scale + 69, 55, 30);			ctx.fillRect(x * scale + 300, y * scale + 69, 55, 30);			ctx.fillStyle="black";			ctx.font = "500 15px Calibri";			ctx.fillText(stroke(parseInt(event.stroke)), (x * scale) + 95, (y * scale) + 90);			ctx.fillText(stroke(parseInt(event.stroke)), (x * scale) + 170, (y * scale) + 90);			ctx.fillText(stroke(parseInt(event.stroke)), (x * scale) + 240, (y * scale) + 90);			ctx.fillText(stroke(parseInt(event.stroke)), (x * scale) + 310, (y * scale) + 90);			ctx.font = "200 20px Calibri";			//ctx.fill();		}	}	function open_delete(ctx){		ctx.fillStyle="white";		ctx.fillRect(x * scale + 227, y * scale + 48, 65, 15);		ctx.fillStyle="black";	}	function senior_delete(ctx){		ctx.fillStyle="white";		ctx.fillRect(x * scale + 158, y * scale + 48, 65, 15);		ctx.fillStyle="black";	}	function junior_delete(ctx){		ctx.fillStyle="white";		ctx.fillRect(x * scale + 83	, y * scale + 48, 65, 15);		ctx.fillStyle="black";	}}function stroke(id){	switch(id){		case 0:			return 'FLY';		case 1:			return 'BACK';		case 2:			return 'BREAST';		case 3:			return 'FREE';		case 4:			return 'I.M.';		case 5:			return 'M.R.';		case 6:			return 'F.R.';	}}function division(division){	switch(division){		case 0:			return 'OPEN';		case 1:			return 'JUNIOR';		case 2:			return 'SENIOR';	}}img.src = 'js/timecard.png';</script><?php }?></body></html>