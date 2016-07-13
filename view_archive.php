<?php
require_once( dirname(__FILE__).'/includes/functions.php');
	if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
		header("HTTP/1.1 303 See Other");
		header('Location: index.php');
		die();
	}
	if($_SESSION['rank'] < 2){
		header("HTTP/1.1 303 See Other");
		header('Location: logout.php');
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
				<div class="row">
					<h2 class="text-center">View archive</h2>
					<div style="text-align:center;" class="row bottom3">
						<a class="text-center" data-toggle="collapse" href="#team_list_widget_help">Help?</a>
					</div>
				</div>
				<div class="row">
					<div id="team_list_widget_help" class="row bottom3 collapse">
						<p class="text-left">Here you can view previously archived swimmers, and restore them if a mistake has been made. This data cannot be changed. This panel will be empty if there are no archived swimmers.</p>
					</div>
				</div>
				<div id="aw">
				<?php
				
				include( dirname(__FILE__).'/includes/archive_widget.php');
				?>
				</div>
			</div>
		</div>
	<?php
		include( dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>