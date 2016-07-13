<div id="add_email_widget">	<h2 class="text-center bottom4">Email for password reset</h2>
	<div class="row">
		<div class="col-lg-12">
			<div class="row bottom4" id="add_email_success" style="display:none;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="alert alert-success">
						<a href="#" class="close" onclick="$('#add_email_success').hide();" aria-label="close">&times;</a>
						<strong>Success!</strong> Settings changed.
					</div>
				</div>
			</div>
			<div class="row bottom4" id="add_email_error" style="display:none;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="alert alert-danger">
						<a href="#" class="close" onclick="$('#add_email_error').hide();" aria-label="close">&times;</a>
						<div id="change_pass_error_msg">
							<strong>Error!</strong> Settings not changed, please try again later.
						</div>
					</div>
				</div>
			</div>
			<form method="post" onsubmit="add_email(this); return false;">
				<div class="row bottom2">
					<div class="col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-sx-12">
						<label for="new_email">New email:</label>
						<input name="new_email" type="text" class="form-control" id="new_email" placeholder="New email" required>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12" style="text-align:center;">
						<button type="submit" class="btn btn-primary">Add email</button>
					</div>
				</div>
			</form>
		</div>
	</div></div>