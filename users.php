<?php
require_once( dirname(__FILE__).'/includes/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']) && $_SESSION['rank'] > 0)){
	header("HTTP/1.1 303 See Other");
	header('Location: index.php');
	die();
}
if($_SESSION['rank'] < 1){
	header("HTTP/1.1 303 See Other");
	header('Location: logout.php');
	die();
}
include( dirname(__FILE__).'/includes/head.php');
?>
<!DOCTYPE html>
<html>
	<body>
		<?php
		include( dirname(__FILE__).'/includes/nav.php');
		?>
		<div class='container'>
			<div class='jumbotron'>
				<div class='row'>
					<div class='col-md-10 col-sm-12 col-lg-offset-1'>
						<?php
						include( dirname(__FILE__).'/includes/add_widget.php');
						echo '<hr />';
						echo '<div id="tlw">';
						include( dirname(__FILE__).'/includes/team_list_widget.php');
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
		include(dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>