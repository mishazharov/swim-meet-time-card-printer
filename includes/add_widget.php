<form id='add_widget' class="form-inline" onsubmit='add_user(); return false;'>
	<div class="row bottom4">
			<h2 class="text-center">Add a team member</h2>
	</div>
	<?php
	require_once( dirname(__FILE__).'/functions.php');
	help("Using this form you can add new members to this website. You must fill in the username and select the appropriate options such as grade, rank, etc. You can add multiple users by separating usernames with commas. Only usernames are required to add admins or managers.
			You can only create users that have less privileges than you (Where: Swimmer < Captain < Manager < Admin). If you are a captain, you cannot add users outside of your age group / division.", false);?>
	<div class="row bottom4" id="add_widget_success" style="display:none;">
		<div class="alert alert-success">
			<a href="#" class="close" onclick="$('#add_widget_success').hide();" aria-label="close">&times;</a>
			<strong>Success!</strong> Member(s) added.
		</div>
	</div>
	<div class="row bottom4" id="add_widget_error" style="display:none;">
		<div class="alert alert-danger">
			<a href="#" class="close" onclick="$('#add_widget_error').hide();" aria-label="close">&times;</a>
			<strong>Error!</strong> Member(s) not added, make sure your data is correct, and try again later.
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 bottom2">
			<label class="control-label hidden-md hidden-sm hidden-xs" for="add_widget_username">Usernames:</label>
		</div>
	</div>			
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 bottom2">
			<div class='form-group' style="display:block">
				<input style="width:100%" type="text" class="form-control input-lg" name="name" id="add_widget_name" placeholder="First.Last,First.Last,First.Last,..." required>
			</div>
		</div>
	</div>
	<div class="row bottom2">
		<div class="col-md-6 col-sm-6 col-xs-4 bottom2 hidden-lg">
			<div class="row">
				<div class="col-md-12 bottom5">
					<label class="control-label hidden-lg" for="add_widget_division">Grade:</label>
				</div>
				<div class="col-md-12 bottom5 hidden-lg hidden-xs">
					<label class="control-label hidden-lg hidden-xs" for="add_widget_competes_with">Competes with:</label>
				</div>
				<div class="col-md-12 bottom5 hidden-sm hidden-md hidden-lg">
					<label class="control-label hidden-lg" for="add_widget_competes_with">Gender:</label>
				</div>
				<div class="col-md-12 bottom5">
					<label class="control-label hidden-lg" for="add_widget_rank">Rank:</label>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-8 col-lg-12 bottom2">
			<div class="row">
				<div class="col-lg-2 col-lg-offset-3 col-md-12 bottom2">
					<div class='form-group'>
						<div class="" data-toggle="tooltip" title="Grade">
							<select name="grade" class="form-control" id="add_widget_grade">
								<?php
								
								if($_SESSION['division'] == 1 || $_SESSION['division'] == 0 || $_SESSION['rank'] >= 2){
										echo '<option value="9">Gr.9</option>';
										echo '<option value="10">Gr.10</option>';
								}
								if($_SESSION['division'] == 2 || $_SESSION['division'] == 0 || $_SESSION['rank'] >= 2){
										echo '<option value="11">Gr.11</option>';
										echo '<option value="12">Gr.12</option>';
										echo '<option value="13">Victory Lap</option>';
								}
								if($_SESSION['rank'] >= 2){
									echo '<option value="-1">Not sure</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-12 bottom2">
					<div class='form-group'>
						<div class="" data-toggle="tooltip" title="Competes With">
							<select name="competes_with" class="form-control" id="add_widget_competes_with">
								<?php
									if(isset($_SESSION['rank'])){
										if($_SESSION['rank'] != 1 || $_SESSION['competes_with'] == 0){
											echo '<option value="0">Girls &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
										}
										if($_SESSION['rank'] != 1 || $_SESSION['competes_with'] == 1){
											echo '<option value="1">Boys    </option>';
										}
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-12 bottom2">
					<div class='form-group'>
						<div class="" data-toggle="tooltip" title="Rank">
							<select name="rank" class="form-control" id="add_widget_rank">
								<option value="0">Swimmers</option>
								<?php
								if(isset($_SESSION['rank'])){
									if($_SESSION['rank'] > 1){
										echo '<option value="1">Captains</option>';
									}
									if($_SESSION['rank'] > 2){
										echo '<option value="2">Managers</option>';
									}
									if($_SESSION['rank'] > 3){
										echo '<option value="3">Admins</option>';
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo '
	<div class="row bottom3">
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-sx-12" style="text-align:center;">
			<div class="hidden-md hidden-sm hidden-xs" data-toggle="tooltip" title="Check if this is an open swimmer">
	';
				
				if($_SESSION['rank'] >= 2){
					echo '
					<div class="checkbox">
						<label><input name="open" type="checkbox" value=""> Open Swimmers?</label>
					</div>
					';
				} else if($_SESSION['division'] == 0){
					echo '
					<div class="checkbox">
						<label><input name="open" type="checkbox" value="" checked disabled> Open Swimmers?</label>
					</div>
					';
				}
	echo '			
			</div>
		</div>
	</div>
	';
	?>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12" style="text-align:center;">
			<button type="submit" class="btn btn-primary">Add Swimmers</button>
		</div>
	</div>
</form>