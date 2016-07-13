<form id="change_pass_widget" method="post" onsubmit="change_pass(); return false;">
	<div class='row bottom2'>
		<h2 class="text-center">Change your password</h2>
	</div>
	<div class="row bottom4" id="change_pass_success" style="display:none;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="alert alert-success">
				<a href="#" class="close" onclick="$('#change_pass_success').hide();" aria-label="close">&times;</a>
				<strong>Success!</strong> Settings changed.
			</div>
		</div>
	</div>
	<div class="row bottom4" id="change_pass_error" style="display:none;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="alert alert-danger">
				<a href="#" class="close" onclick="$('#change_pass_error').hide();" aria-label="close">&times;</a>
				<div id="change_pass_error_msg">
					<strong>Error!</strong> Settings not changed, please try again later.
				</div>
			</div>
		</div>
	</div>
	<div id="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="old_pass">Old password:</label>
				<input name="old_pass" type="password" class="form-control" id="old_pass" placeholder="Old Password" required>
			</div>
		</div>
	</div>
	<div id="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="new_pass">New password:</label>
				<input name="new_pass" type="password" class="form-control" id="new_pass" placeholder="New Password" required>
			</div>
		</div>
	</div>
	<div id="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="confirm_pass">Confirm new password:</label>
				<input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="text-center col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<button type="submit" class="btn btn-primary">Change password</button>
		</div>
	</div>
</form>