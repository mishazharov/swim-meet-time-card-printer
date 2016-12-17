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
  								Incorrect username or password
							</div>
						</div>
					</div>
					";
				}
				if(isset($_GET['err'])&&$_GET['err']==2){
					echo "
					<div class='row'>
						<div class='col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12'>
							<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close alert'><span aria-hidden='true'>&times;</span></button>
  								<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
  								<span class='sr-only'>Success:</span>
  								Logged out successfully
							</div>
						</div>
					</div>
					";
				}
				help("On first login your username should be Firstname.Lastname, after setting up your account, it should be your email.", true);
				?>
				<div class='row'>
					<div class='col-md-10 col-md-offset-2 col-sm-12 bottom1'>
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
								<label class="control-label" for="username">Email</label>
    								<input type="text" class="form-control" 
    								<?php 
    								if(isset($_COOKIE['username'])){
										$var = $_COOKIE['username'];
										if(filter_var($var, FILTER_VALIDATE_EMAIL)){//Checks if it should look for email or name
											$name_zz = htmlspecialchars($_COOKIE['username']);
											echo "value='".$name_zz."' "; 
										}

    								}
    								?>
    								name="username" id="username" placeholder="Email" required>
							</div>
							<div 
							<?php
								echo "class='form-group";
								if(isset($_GET['err'])&& $_GET['err']==1){
									echo " has-error";
								}
								echo "'";
							?>
							>
								<label class="control-label" for="password">Password</label>
    								<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
							</div>
							<button type="submit" class="btn btn-default">Log in</button>
						</form>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<p class='text-center' style="font-size:15px">Hi swimmers, please use this form to log into the website, if you forgot your password, click <em><a href='/reset.php'>this link</a></em>, if you have not registered, click <em><a href='/registeru.php'>this link</a></em></p>
					</div>
				</div>
			</div>
		</div>
	<?php
		include(dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>