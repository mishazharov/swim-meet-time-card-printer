<?php
require_once(dirname(__FILE__).'/functions.php');
require_once(dirname(__FILE__).'/db_connect.php');
$stmt = $mysqli->prepare("SELECT grade, competes_with FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($grade, $cw);
$stmt->fetch();
?>
<div class="row" style="text-align:center">
	<form method="post" class="form-inline">
		<div class="row bottom4" id="settings_confirmation_success" style="display:none;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="alert alert-success">
					<a href="#" class="close" onclick="$('#change_pass_success').hide();" aria-label="close">&times;</a>
					<strong>Success!</strong> Settings changed.
				</div>
			</div>
		</div>
		<div class="row bottom4" id="settings_confirmation_error" style="display:none;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="alert alert-danger">
					<a href="#" class="close" onclick="$('#change_pass_error').hide();" aria-label="close">&times;</a>
					<div id="change_pass_error_msg">
						<strong>Error!</strong> Settings not changed, please try again later.
					</div>
				</div>
			</div>
		</div>
		<div id="row bottom2">
			<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 bottom3">
				<div class="form-group">
					<label for="settings_confirmation_year">What grade are you in?</label>
					<select onchange="first_login(this)" name="grade" class="form-control" id="settings_confirmation_year">
						<option <?php if($grade==9)echo "selected ";?>value="9">Gr.9</option>
						<option <?php if($grade==10)echo "selected ";?>value="10">Gr.10</option>
						<option <?php if($grade==11)echo "selected ";?>value="11">Gr.11</option>
						<option <?php if($grade==12)echo "selected ";?>value="12">Gr.12</option>
						<option <?php if($grade==13)echo "selected ";?>value="13">Victory Lap</option>
					</select>
				</div>
			</div>
		</div>
		<div id="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="confirm_pass">Who will you compete with?</label>
					<select onchange="first_login(this)" name="competes_with" class="form-control" id="settings_confirmation_year_competes_with">
						<option <?php if($cw==0)echo "selected ";?>selected="" value="0">Girls</option>
						<option <?php if($cw==1)echo "selected ";?>value="1">Boys</option>
					</select>
				</div>
			</div>
		</div>
	</form>
</div>