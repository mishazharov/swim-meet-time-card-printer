<div class="row">
	<h2 class="text-center">Add meet</h2>
	<div style="text-align:center;" class="row bottom3">
		<a class="text-center" data-toggle="collapse" href="#add_meet_widget_help">Help?</a>
	</div>
</div>
<div class="row">
	<div id="add_meet_widget_help" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row bottom3 collapse">
		<p class="text-left">Here you can add a meet. This will let swimmers sign up for their events. You must enter the meet date, and you should also select the meet type so that swimmers do not choose events that are not available during the meet. Please select whether this meet is taking place in a yard or meter pool, this is so times can be automatically converted. The entry will archive itself after the meet is over.</p>
	</div>
</div>
<form method="post" onsubmit="add_meet(this);return false;">
	<div class="row bottom2">
		<div class="col-lg-offset-3 col-md-offset-2 col-lg-6 col-md-8 col-sm-12 col-xs-12">
			<input class="form-control" type="text" name="name" placeholder="Meet Name" required>
		</div>
	</div>
	<div class="row">
		<div class="bottom2 col-lg-offset-3 col-md-offset-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
			<input min="1" max="31" class="form-control" type="number" name="day" placeholder="Date" required>
		</div>
		<div class="bottom2 col-lg-2 col-md-3 col-sm-12 col-xs-12">
			<select class="form-control" name="month" required>
			<?php
			$month = date("m");
			?>
				<option <?php if($month == 9)echo "selected";?> value="9">September</option>
				<option <?php if($month == 10)echo "selected";?> value="10">October</option>
				<option <?php if($month == 11)echo "selected";?> value="11">November</option>
				<option <?php if($month == 12)echo "selected";?> value="12">December</option>
				<option <?php if($month == 1)echo "selected";?> value="1">January</option>
				<option <?php if($month == 2)echo "selected";?> value="2">February</option>
				<option <?php if($month == 3)echo "selected";?> value="3">March</option>
				<option <?php if($month == 4)echo "selected";?> value="4">April</option>
				<option <?php if($month == 5)echo "selected";?> value="5">May</option>
				<option <?php if($month == 6)echo "selected";?> value="6">June</option>
			</select>
		</div>
		<div class="bottom2 col-lg-2 col-md-3 col-sm-12 col-xs-12 bottom2">
			<select class="form-control" name="year">
				<option <?php echo "value='".date("Y")."'";?>><?php echo date("Y");?></option>
				<option <?php echo "value='".(date("Y")+1)."'";?>><?php echo (date("Y")+1);?></option>
			</select>
		</div>
		<div class="bottom2 col-lg-offset-3 col-md-offset-2 col-lg-6 col-md-8 col-sm-12 col-xs-12 bottom2">
			<select class="form-control" name="meet_event_id">
				<?php
				require_once(dirname(__FILE__).'/db_connect.php');
				$stmt = $mysqli->prepare("SELECT name, id FROM meet_events WHERE deleted=0");
				$stmt->execute();
				$stmt->bind_result($name, $id);
				while($stmt->fetch()){
					if(empty($name)){
						continue;
					}
					echo "<option value='$id'>$name</option>";
				}
				?>
			</select>
		</div>
	</div>
	<div class="row bottom2">
		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 text-center">
			<div id="add_meet_widget_length">
				<label class="radio-inline"><input type="radio" value="1" name="meter" required>Meter pool</label>
				<label class="radio-inline"><input type="radio" value="0" name="meter">Yard pool</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<button type="submit" class="btn btn-primary" id="add_meet_widget_submit">Add meet</button>
		</div>
	</div>
</form>