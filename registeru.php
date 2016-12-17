<?php
	require_once(dirname(__FILE__).'/includes/functions.php');
	if(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank'])){
		header("HTTP/1.1 303 See Other");
		header('Location: home.php');
		die();
	}
	include(dirname(__FILE__).'/includes/head.php');
?>
<!DOCTYPE html>
<html>
	<body>
		<?php
		include(dirname(__FILE__).'/includes/nav.php');
		?>
		<div class='container'>
			<div class='jumbotron'>
				<?php
				if(isset($_GET['err'])&&$_GET['err']==1){
					echo "
					<div class='row'>
						<div class='col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12'>
							<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close alert'><span aria-hidden='true'>&times;</span></button>
  								<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
  								<span class='sr-only'>Error:</span>
  								You're not expected here, please login on the homepage, or talk to a captain/manager/coach
							</div>
						</div>
					</div>
					";
				}
				help("To register, enter your name in the following format: FirstName.LastName", true);
				?>
				<div class='row'>
					<div class='col-md-10 col-md-offset-4 col-sm-12 bottom1'>
						<form class='form-inline' method='post' action='login.php'>
							<div 
							<?php
								echo "class='form-group";
								if(isset($_GET['err'])&& $_GET['err']==1){
									echo " has-error";
								}
								echo "'";
							?>
							>
								<label class="control-label" for="username">Username</label>
    								<input type="text" class="form-control" name="username" id="username" placeholder="FirstName.LastName" required>
							</div>
							<button type="submit" class="btn btn-default">Register</button>
						</form>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<p class='text-center' style="font-size:15px">Hi swimmers, if you're already registered, click <em><a href='/'>this link</a></em></p>
					</div>
				</div>
			</div>
		</div>
	<?php
		include(dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>