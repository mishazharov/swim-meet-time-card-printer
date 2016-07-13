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
		include(dirname(__FILE__).'/includes/nav.php');
		?>
		<div class='container'>
			<div class='jumbotron'>
				<?php
				include(dirname(__FILE__).'/includes/timecard_widget.php');
				include(dirname(__FILE__).'/includes/edit_timecard_widget.php');
				?>
			</div>
		</div>
	<?php
		include(dirname(__FILE__).'/includes/scripts.php');
	?>
	</body> 
	
</html>