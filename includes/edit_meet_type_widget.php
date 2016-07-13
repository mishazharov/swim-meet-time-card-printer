<div id="edit_meet_type_widget_whole">
	<h2 class="text-center">Edit meet type</h2>
	<div style="text-align:center;" class="row bottom3">
		<a class="text-center" data-toggle="collapse" href="#edit_meet_type_widget_help">Help?</a>
	</div>
	<div id="edit_meet_type_widget_help" class="row bottom3 collapse">
		<p class="text-left">Click on a meet type name in order to expand a form. You can change the event numbers, who can participate in events, delete events and insert new ones.</p>
	</div>
	<?php
		require_once(dirname(__FILE__).'/db_connect.php');
		$stmt = $mysqli->prepare("SELECT id, name, text FROM meet_events WHERE deleted=0");
		$stmt->execute();
		$stmt->bind_result($id, $name, $text);
		while($stmt->fetch()){

			if(empty($name) || empty($text)){
				continue;
			}
			$event = json_decode($text);
			$event = (array) $event;
			$event = array_values($event);
			$i=0;
			echo '<a data-toggle="collapse" href="#'.$id.'">';
			echo '<h3 class="text-center">'.$name.'</h3>';
			echo '</a>';
			echo '<div class="collapse edit_meet_type_widget_box" id='.$id.'>';
			echo '<form method="post" onsubmit="edit_meet_type(this); return false;">';
			echo "<input name='id' type='hidden' value='$id'>";
			echo '<div class="row bottom2">';
			echo '	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">';
			echo '		<input type="text" value="'.$name.'" placeholder="Meet type name" name="name" class="form-control" required>';
			echo '	</div>';
			echo '</div>';
			echo '<div id="edit_meet_type_widget_list_'.$id.'">';

			foreach($event as $temp){
					
					ob_start();?>
						<div class="row">
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<input value=<?php $var=$temp->event;echo "'$var'";?> class="form-control" type="number" min="0" name="meet[<?php echo "$i";?>][event]" placeholder="Event #" required>
							</div>
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select class="form-control" name="meet[<?php echo "$i";?>][length]">
									<option <?php if($temp->length=='25')echo 'selected';?> value="25">25 (m/yd)</option>
									<option <?php if($temp->length=='50')echo 'selected';?> value="50">50 (m/yd)</option>
									<option <?php if($temp->length=='100')echo 'selected';?> value="100">100 (m/yd)</option>
									<option <?php if($temp->length=='200')echo 'selected';?> value="200">200 (m/yd)</option>
									<option <?php if($temp->length=='400')echo 'selected';?> value="400">400 (m/yd)</option>
								</select>
							</div>
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select class="form-control" name="meet[<?php echo "$i";?>][stroke]">
									<option <?php if($temp->stroke=='0')echo 'selected';?> value="0">Butterfly</option>
									<option <?php if($temp->stroke=='1')echo 'selected';?> value="1">Back</option>
									<option <?php if($temp->stroke=='2')echo 'selected';?> value="2">Breast</option>
									<option <?php if($temp->stroke=='3')echo 'selected';?> value="3">Free</option>
									<option <?php if($temp->stroke=='4')echo 'selected';?> value="4">I.M</option>
									<option <?php if($temp->stroke=='5')echo 'selected';?> value="5">Medley Relay</option>
									<option <?php if($temp->stroke=='6')echo 'selected';?> value="6">Free Relay</option>
								</select>
							</div>
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select class="form-control" name="meet[<?php echo "$i";?>][division]">
									<option <?php if($temp->division=='0')echo 'selected';?> value="0">Open</option>
									<option <?php if($temp->division=='1')echo 'selected';?> value="1">Junior</option>
									<option <?php if($temp->division=='2')echo 'selected';?> value="2">Senior</option>
								</select>
							</div>
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select class="form-control" name="meet[<?php echo "$i";?>][competes_with]">
									<option <?php if($temp->competes_with=='0')echo 'selected';?> value="0">Girls</option>
									<option <?php if($temp->competes_with=='1')echo 'selected';?> value="1">Boys</option>
								</select>
							</div>
							<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<button style="width:100%" onclick="show_more(this)" type="button" class="btn btn-primary">Show more</button>
							</div>
							<hr class="hidden-lg hidden-md">
						</div>
						
				<?php
				echo ob_get_clean();
				$i++;
			}
			echo '</div>';
			echo '<div class="row">';
			echo '	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">';
			echo '		<button class="btn btn-primary" title="This will add another event to the bottom of the list. It will not save the event list." type="button" onclick="add_event('."'#edit_meet_type_widget_list_"."$id'".')">Add event</button>';
			echo '		<button class="edit_meet_type_widget_submit btn btn-primary" title="This will save the event list." type="submit">Save event list</button>';
			echo '		<button onclick="if(confirm(\'This will permanently delete the event list\'))delete_meet_type('.$id.',this)" class="btn btn-danger" title="This will save the event list." type="button">Delete event list</button>';
			echo '	</div>';
			
			echo '</div>';
			echo '</form>';
			echo '</div>';
		}
	?>
</div>
	