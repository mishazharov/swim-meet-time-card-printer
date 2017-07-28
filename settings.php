<?php
require_once(dirname(__FILE__).'/includes/functions.php');

		if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
			header("HTTP/1.1 303 See Other");
			header('Location: index.php');
			die();
		}
		include(dirname(__FILE__).'/includes/head.php');
	?>
<!DOCTYPE html>
<html>
	<body>
		<?php
		include( dirname(__FILE__).'/includes/nav.php');
		?>
		<div class='container'>
			<div class='jumbotron'>
				<h1 class="text-center">Settings</h1>
				<?php
				help("Here you can change your email and password. Please enter a valid email because it will be used to reset your password. Users that are logging in for the first time must update both email and password. Also Admins can reset the website for a new swim season by clicking 'Reset users and meets'", false);
				if(permission_admin($_SESSION['rank'])){
				?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12 bottom3" style="text-align:center;">
						<button type="submit" onclick="delete_all_users();return false;" class="btn btn-danger">Reset users and meets</button>
				</div>
				<?php
				}
				?>
				<div class="row bottom4">
					<div class="col-lg-12">
					<?php
						if($_SESSION['setup']!=3 && !permission_admin($_SESSION['rank'])){
							include( dirname(__FILE__).'/includes/settings_confirmation_widget.php');
						}
					?>
					</div>
				</div>
				<div class="row bottom4">
					<div class="col-lg-12">
					<?php
						if($_SESSION['setup']!=1){
							include( dirname(__FILE__).'/includes/change_pass_widget.php');
						}
					?>
					</div>
				</div>
				<div class="row bottom4">
					<div class="col-lg-12">
					<?php
						if($_SESSION['setup']!=2){
							include( dirname(__FILE__).'/includes/add_email_widget.php');
						}
					?>
					</div>
				</div>
			</div>
		</div>
	<?php
		include( dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>