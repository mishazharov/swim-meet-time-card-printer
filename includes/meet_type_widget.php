<?php require_once( dirname(__FILE__).'/functions.php'); ?>
<form method="post" onsubmit="add_meet_type(this);return false;">
	<div class="row bottom2">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<h2>Add meet type</h2>
		</div>
	</div>
	<div style="text-align:center;" class="row bottom3">
		<a class="text-center" data-toggle="collapse" href="#meet_type_widget_help">Help?</a>
	</div>
	<div id="meet_type_widget_help" class="row bottom3 collapse">
			<p class="text-left">Here you can add meet types (ie. A, B, Sprint). This will make a template for meet creation, insuring that swimmers will not sign up for events that are not present. Please add events in order so that they can be printed and sorted correctly.</p>
	</div>
	<div class="row bottom2">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<input type="text" placeholder="Meet type name" name="name" class="form-control" required>
		</div>
	</div>
	<div id="meet_type_widget_list">
		<div class="row">
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<input class="form-control" type="number" min="0" name="meet[0][event]" placeholder="Event #" required>
			</div>
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<select class="form-control" name="meet[0][length]">
					<option value="25">25 (m/yd)</option>
					<option value="50">50 (m/yd)</option>
					<option value="100">100 (m/yd)</option>
					<option value="200">200 (m/yd)</option>
					<option value="400">400 (m/yd)</option>
				</select>
			</div>
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<select class="form-control" name="meet[0][stroke]">
					<option value="0"><?php echo stroke(0);?></option>
					<option value="1"><?php echo stroke(1);?></option>
					<option value="2"><?php echo stroke(2);?></option>
					<option value="3"><?php echo stroke(3);?></option>
					<option value="4"><?php echo stroke(4);?></option>
					<option value="5"><?php echo stroke(5);?></option>
					<option value="6"><?php echo stroke(6);?></option>
				</select>
			</div>
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<select class="form-control" name="meet[0][division]">
					<option value="0">Open</option>
					<option value="1">Junior</option>
					<option value="2">Senior</option>
				</select>
			</div>
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<select class="form-control" name="meet[0][competes_with]">
					<option value="0">Girls</option>
					<option value="1">Boys</option>
				</select>
			</div>
			<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<button style="width:100%" onclick="show_more(this)" type="button" class="btn btn-primary">Show more</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<button id="meet_type_widget_add_event" class="btn btn-primary" title="This will add another event to the bottom of the list. It will not save the event list." type="button" onclick="add_event('#meet_type_widget_list')">Add event</button>
			<button id="meet_type_widget_submit" class="btn btn-primary" title="This will save the event list." type="submit">Save event list</button>
		</div>
	</div>
	<div>
		<hr class="hidden-lg hidden-md">
	</div>
</form>