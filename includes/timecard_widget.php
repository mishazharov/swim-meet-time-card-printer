<div id="timecard_widget_whole">
	<h2 class="text-center">Add a timecard</h2>
	<?php
	    $help_text = "In order to sign up for a meet, click on the meet you would like to sign up for, and fill in the form that appears. If the form submits successfully then the meets dialogue should turn green. If you would like to make a relay, ask your Captain to make a relay timecard for you, unfortunately that interface is limited to Captains right now.";
		if(permission_captain($_SESSION['rank'])){
			$help_text .= " In order to make the relay dialogue interface appear, select a relay event first. If you have more than one relay, the fastest relay should be an \"A Relay\", the second fastest should be a \"B Relay\" and so on.";
		}
		help($help_text, false);
		require_once( dirname(__FILE__).'/db_connect.php');
		$stmt = $mysqli->prepare("SELECT name, type, date, length, id FROM meets WHERE deleted=0 AND date > CURDATE() AND active = 1");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($name, $type, $date, $length, $id);
		?>
		<div class="row bottom4" style="display:none;" id="add_timecard_widget_error">
			<div class="alert alert-success">
				<a href="#" class="close" onclick="$('#add_timecard_widget_error').hide();" aria-label="close">×</a>
				<span>Success! Timecard submitted.</span>
			</div>
		</div>
		<?php
		while($stmt->fetch()){
			ob_start();
	?>
			<div class="row bottom3">
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
					<strong><span class="hidden-lg hidden-md">Name: </span></strong>
					<?php echo "$name"; ?>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
					<strong><span class="hidden-lg hidden-md">Date: </span></strong>
					<?php $date_array = explode('-',$date); echo date("F j, Y", mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0])); ?>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
					<strong><span class="hidden-lg hidden-md">Meet type: </span></strong>
					<?php 
					$stmt1 = $mysqli->prepare("SELECT name FROM meet_events WHERE deleted=0 AND id=?"); 
					$stmt1->bind_param('i', $type);
					$stmt1->execute();
					$stmt1->bind_result($type_name);
					$stmt1->fetch();
					$stmt1->close();
					echo $type_name;
					?>
				</div>
				<div class="bottom2 col-lg-2 col-md-3 col-sm-12 col-xs-12">
					<strong><span class="hidden-lg hidden-md">Pool type: </span></strong><?php if($length == 0)echo "Yard pool"; else if($length == 1)echo "Meter pool"; ?>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
					<button onclick="if(this.innerHTML == 'Expand'){this.innerHTML='Hide';$(this.getAttribute('href')).collapse('toggle');}else{this.innerHTML = 'Expand';$(this.getAttribute('href')).collapse('toggle');}" href="#timecard_widget_form_<?php echo $id;?>" style="width:100%" type="button" class="btn btn-primary">Expand</button>
				</div>
			</div>
			<div id="timecard_widget_form_<?php echo $id;?>" class="row collapse">
				<h3 class="text-center">Meet signup for <?php echo $name;?></h3>
				<form method="post" onsubmit="add_timecard(this); return false;">
					<input type="hidden" name="meet_id" value="<?php echo $id;?>">
					<div class="bottom2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="bottom2 col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<select required name="swimmer_id[]" class="timecard_widget_names form-control">
										<?php
										if($_SESSION['rank'] > 0){
											if($_SESSION['rank'] >= 2){
												$stmt1 = $mysqli->prepare("SELECT id, name FROM users WHERE deleted = 0 AND rank < 2 ORDER BY name");
											}else{
												$stmt1 = $mysqli->prepare("SELECT id, name FROM users WHERE deleted = 0 AND rank < 2 AND division = ? AND competes_with=? ORDER BY name");
												$stmt1->bind_param("ii", $_SESSION['division'], $_SESSION['competes_with']);
											}
											$stmt1->execute();
											$stmt1->bind_result($swimmer_id, $swimmer_name);
											while($stmt1->fetch()){
												echo "<option value='$swimmer_id'>".name($swimmer_name)."</option>";
											}
										}else{
											echo "<option>".name($_SESSION['name'])."</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="bottom2 col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<select required onchange="detect_relay(this)" name="event" class="timecard_widget_select form-control">
										<?php
											
											$stmt1 = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted = 0 AND id=?");
											$stmt1->bind_param("i", $type);
											$stmt1->execute();
											$stmt1->store_result();
											$stmt1->bind_result($text);
											$stmt1->fetch();
											$stmt1->close();
											$events = json_decode($text);
											
											foreach($events as $options){
												if($_SESSION['rank'] < 2){
													if($_SESSION['competes_with'] != $options->competes_with || $_SESSION['division'] != $options->division){
														continue;
													}
												}
												if($_SESSION['rank'] < 1 &&$options->stroke > 4)continue;
												$option_name = "Event ".$options->event.": ".$options->length;
												if($length == 0){
														$option_name .= " Yard ";
													}else if($length == 1){
														$option_name .= " Meter "; 
												}
												$option_name.=" ".stroke($options->stroke)." (". division_name($options->division)." ".competes_with($options->competes_with).")";
												echo "<option value='".$options->event."'>$option_name</option>";
												$option_name="";
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row bottom2">
							<div class="col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<input id="timecard_widget_time" type="text" pattern="<?php echo timecard_regex_client();?>" title="Time: <?php echo timecard_regex_human()?>" class="form-control" placeholder="Entry time as <?php echo timecard_regex_human();?> or SS.MS (blank for no time)" name="time">
								</div>
							</div>
						</div>
						<div class="row bottom10">
							<div class="text-center">
								<button class="btn btn-primary" type="submit">Submit Timecard</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<hr class="hidden-lg hidden-md">
	<?php
			echo ob_get_clean();
		}
	?>
</div>