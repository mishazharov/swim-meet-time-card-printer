<div id="edit_timecard_widget_whole">
	<h2 class="text-center">Edit/View <?php if($_SESSION['rank']==0)echo "your"; if($_SESSION['rank']==1)echo "your divisions"; if($_SESSION['rank']>=2)echo "all";?> timecards</h2>
	<?php
		require_once(dirname(__FILE__).'/functions.php');
		help("Here you can edit or delete timecards, if they have already been printed you will have to talk to your Captain in order to change something. These timecards are not arranged in order.", false);
		require_once(dirname(__FILE__).'/db_connect.php');
		$stmt = $mysqli->prepare("SELECT name, type, date, length, id FROM meets WHERE deleted=0  AND date > CURDATE() AND active = 1");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($name, $type, $date, $length, $id);
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
					<button onclick="if(this.innerHTML == 'Expand'){this.innerHTML='Hide';$(this.getAttribute('href')).collapse('toggle')}else{this.innerHTML = 'Expand';$(this.getAttribute('href')).collapse('toggle')}" href="#edit_timecard_widget_form_<?php echo $id;?>" style="width:100%" type="button" class="btn btn-primary">Expand</button>
				</div>
			</div>
			<div id="edit_timecard_widget_form_<?php echo $id;?>" class="row collapse">
				<h4 class="bottom3 text-center">Edit timecards for <?php echo $name;?></h4>
				<?php
				if($_SESSION['rank'] >= 2){
					$stmt1 = $mysqli->prepare("SELECT id, name, stroke, length, event, time, relay_letter FROM timecards WHERE deleted=0 AND meet_id=?");
					$stmt1->bind_param("i", $id);
				}else{
					$stmt1 = $mysqli->prepare("SELECT id, name, stroke, length, event, time, relay_letter FROM timecards WHERE deleted=0 AND meet_id=? AND division=? AND competes_with=?");
					$stmt1->bind_param("iii", $id, $_SESSION['division'], $_SESSION['competes_with']);
				}
				$stmt1->execute();
				$stmt1->store_result();
				$stmt1->bind_result($timecard_id, $timecard_name, $timecard_stroke, $timecard_length, $timecard_event, $timecard_time, $relay_letter);
				
				while($stmt1->fetch()){
					
					$timecard_name=explode(".", $timecard_name);
					if($_SESSION['rank'] == 0){
						foreach($timecard_name as $simple_id){
							if($simple_id == $_SESSION['id']){
								$found=true;
							}
						}
					}
					if($_SESSION['rank'] == 0){
						if(!isset($found))continue;
					}
				?>
				<form method="post" onsubmit="edit_timecard(this); return false;">
					<input type="hidden" name="timecard_id" value="<?php echo $timecard_id;?>">
					<input type="hidden" name="meet_id" value="<?php echo $id;?>">
					<div class="bottom2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="bottom2 col-lg-3 col-md-4 col-sm-12 col-xs-12">
								<?php
									$stmt2 = $mysqli->prepare("SELECT name, id FROM users WHERE deleted=0 AND rank < 2");
									$stmt2->execute();
									$stmt2->store_result();
									$stmt2->bind_result($swimmer_name, $swimmer_id);
									foreach($timecard_name as $simple_id){
										if(empty($simple_id))continue;
										if(!empty($relay_letter) && $_SESSION['rank'] < 1){
											echo '<select disabled name="swimmer_id[]" class="bottom2 form-control">';
										}else{
											echo '<select name="swimmer_id[]" class="bottom2 form-control">';
										}
										while($stmt2->fetch()){
											
											if($swimmer_id == $simple_id){
												$swimmer_name = name($swimmer_name);
												echo "<option selected value='$simple_id'>$swimmer_name</option>";
											}else if($_SESSION['rank'] > 0){
												echo "<option value='$swimmer_id'>$swimmer_name</option>";
											}
										}
										echo '</select>';
										$stmt2->data_seek(0);
									}
									$stmt2->close();
								?>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bottom2">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<?php
											if(!empty($relay_letter) && $_SESSION['rank'] < 1){
												echo '<select disabled onchange="detect_relay(this)" name="event" class="form-control">';
											}else{
												echo '<select onchange="detect_relay(this)" name="event" class="form-control">';
											}
											$stmt2 = $mysqli->prepare("SELECT text FROM meet_events WHERE deleted = 0 AND id=?");
											$stmt2->bind_param("i", $type);
											$stmt2->execute();
											$stmt2->bind_result($text);
											$stmt2->fetch();
											$stmt2->close();
											$events = json_decode($text);
											foreach($events as $options){
												if($_SESSION['rank'] < 2){
													if($_SESSION['competes_with'] != $options->competes_with || $_SESSION['division'] != $options->division){
														continue;
													}
												}
												$option_name = "Event ".$options->event.": ".$options->length." ".stroke($options->stroke)." (". division_name($options->division)." ".competes_with($options->competes_with).")";
												if($timecard_event == $options->event){
													echo "<option selected value='".$options->event."'>$option_name</option>";
												}else{
													echo "<option value='".$options->event."'>$option_name</option>";
												}
												$option_name="";
											}
										?>
										</select>
									</div>
								</div>
								<div class="row">
									<?php if(!empty($relay_letter)){?>
									<div class="text-center bottom2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<label class="radio-inline"><input required type="radio" <?php if($_SESSION['rank'] < 1)echo "disabled ";if($relay_letter==0)echo "checked='checked' ";?> value="0" name="relay_letter">A Relay</label>
										<label class="radio-inline"><input <?php if($_SESSION['rank'] < 1)echo "disabled ";if($relay_letter==1)echo "checked='checked' ";?> type="radio" value="1" name="relay_letter">B Relay</label>
										<label class="radio-inline"><input <?php if($_SESSION['rank'] < 1)echo "disabled ";if($relay_letter==2)echo "checked='checked' ";?> type="radio" name="relay_letter" value="2">C Relay</label>
									</div>
									<?php }?>
								</div>
							</div>
							<div class="bottom2 col-lg-3 col-md-4 col-sm-12 col-xs-12">
								
								<input value="<?php echo $timecard_time; ?>" <?php if(!empty($relay_letter) && $_SESSION['rank'] < 1)echo "disabled";?> type="text" pattern="[0-9]{2}:[0-9]{2}\.[0-9]{2}|" title="Time: MM:SS.MS" class="form-control" placeholder="Entry time (blank for no time)" name="time">
							</div>
							<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 text-center">
								<div class="row">
									<button style="width:100%" <?php if(!empty($relay_letter) && $_SESSION['rank'] < 1)echo "disabled";?> class="bottom2 btn btn-primary" type="submit">Save Timecard</button>
									<button style="width:100%" onclick="delete_timecard(this)" <?php if(!empty($relay_letter) && $_SESSION['rank'] < 1)echo "disabled";?> class="btn btn-danger" type="button">Delete Timecard</button>
								</div class="row">
							</div>
						</div>
					</div>
				</form>
				<?php  }?>
			</div>
			<hr class="hidden-lg hidden-md">
	<?php
			echo ob_get_clean();
		}
	?>
</div>