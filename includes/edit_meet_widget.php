<div id="edit_meet_widget_whole">
	<div class="row">
		<h2 class="text-center">Edit meets</h2>
		<div style="text-align:center;" class="row bottom3">
			<a class="text-center" data-toggle="collapse" href="#edit_meet_widget_help">Help?</a>
		</div>
	</div>
	<div class="row">
		<div id="edit_meet_widget_help" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row bottom3 collapse">
			<p class="text-left">Here you can edit previously added meets. Click on a meet name to expand the form, submit the form to save the changes. Once the changes are saved, the page should refresh.
			You can also delete meets. Unless a meet was made by mistake, please do not delete meets because it will also delete all the times and timecards associated with the meet.</p>
		</div>
	</div>
	<?php 
	require_once(dirname(__FILE__).'/db_connect.php');
	$stmt1 = $mysqli->prepare("SELECT id, name, type, date, length FROM meets WHERE deleted=0");
	$stmt1->execute();
	$stmt1->store_result();
	$stmt1->bind_result($id, $name, $type, $date, $length);
	while($stmt1->fetch()){
	$date = explode("-", $date);
	ob_start();
	?>
	<div class="row bottom2">
		<a data-toggle='collapse' href=<?php echo "#edit_meet_widget_".$id;?>><h3 class="text-center"><?php echo $name;?></h3></a>
	</div>
	<div class="collapse edit_meet_widget_box" id="edit_meet_widget_<?php echo $id.'"'?>>
		<form method="post" onsubmit="edit_meet(this); return false;">
			<input type="hidden" value=<?php echo "'$id'";?> name="id">
			<div class="row bottom2">
				<div class="col-lg-offset-3 col-md-offset-2 col-lg-6 col-md-8 col-sm-12 col-xs-12">
					<input class="form-control" type="text" name="name" placeholder="Meet Name" required <?php echo "value='".$name."'";?>>
				</div>
			</div>
			<div class="row">
				<div class="bottom2 col-lg-offset-3 col-md-offset-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<input min="0" max="32" class="form-control" type="number" name="day" placeholder="Date" required <?php echo "value='".$date[2]."'";?>>
				</div>
				<div class="bottom2 col-lg-2 col-md-3 col-sm-12 col-xs-12">
					<select class="form-control" name="month" required>
						<option <?php if($date[1] == 9)echo "selected";?> value="9">September</option>
						<option <?php if($date[1] == 10)echo "selected";?> value="10">October</option>
						<option <?php if($date[1] == 11)echo "selected";?> value="11">November</option>
						<option <?php if($date[1] == 12)echo "selected";?> value="12">December</option>
						<option <?php if($date[1] == 1)echo "selected";?> value="1">January</option>
						<option <?php if($date[1] == 2)echo "selected";?> value="2">February</option>
						<option <?php if($date[1] == 3)echo "selected";?> value="3">March</option>
						<option <?php if($date[1] == 4)echo "selected";?> value="4">April</option>
						<option <?php if($date[1] == 5)echo "selected";?> value="5">May</option>
						<option <?php if($date[1] == 6)echo "selected";?> value="6">June</option>
					</select>
				</div>
				<div class="bottom2 col-lg-2 col-md-3 col-sm-12 col-xs-12 bottom2">
					<select class="form-control" name="year">
						<option <?php echo "value='".$date[0]."'";?>><?php echo date("Y");?></option>
						<?php
							if($date[0] < date("Y")){
								$temp = $date[0];
								while($temp < date("Y")){
									echo "<option value='$temp'>$temp</option>";
									$temp++;
								}
							}
						?>
					</select>
				</div>
				<div class="bottom2 col-lg-offset-3 col-md-offset-2 col-lg-6 col-md-8 col-sm-12 col-xs-12 bottom2">
					<select class="form-control" name="meet_event_id">
						<?php
						require_once(dirname(__FILE__).'/db_connect.php');
						$stmt = $mysqli->prepare("SELECT name, id FROM meet_events WHERE deleted=0");
						$stmt->execute();
						$stmt->bind_result($name, $id1);
						while($stmt->fetch()){
							if(empty($name)){
								continue;
							}
							if($type == $id1){
								echo "<option selected value='$id1'>$name</option>";
							}else{
								echo "<option value='$id1'>$name</option>";
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="row bottom2">
				<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 text-center">
					<div id="add_meet_widget_length">
						<label class="radio-inline"><input <?php if($length == 1)echo "checked='checked'";?> type="radio" value="1" name="meter">Meter pool</label>
						<label class="radio-inline"><input <?php if($length == 0)echo "checked='checked'";?> type="radio" value="0" name="meter">Yard pool</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					<button type="submit" class="btn btn-primary edit_meet_widget_submit">Edit meet</button>
					<button onclick="if(confirm('This will delete the meet, and associated timecards and times. This cannot be undone.'))delete_meet(<?php echo "$id";?>, this)" type="button" class="btn btn-danger" id="edit_meet_widget_delete">Delete meet</button>
				</div>
			</div>
		</form>
	</div>
<?php
}
?>
</div>