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
				<div style="text-align:center;" class="row bottom3">
					<a class="text-center" data-toggle="collapse" href="#settings_help">Help?</a>
				</div>
				<div id="settings_help" class="row bottom3 collapse">
						<p class="text-left">Here you can change your email and password. Please enter a valid email because it will be used to reset your password. Users that are logging in for the first time must update both email and password.</p>
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