<?php
require_once(dirname(__FILE__).'/functions.php');
if(!(isset($_SESSION['name']) && isset($_SESSION['division']) && isset($_SESSION['competes_with']) && isset($_SESSION['rank']))){
	echo "Please log in to continue...";
	die();
}
require_once(dirname(__FILE__).'/db_connect.php');
$stmt = $mysqli->prepare("SELECT id, name, grade, rank, competes_with FROM users WHERE deleted=1");
$stmt->execute();
$stmt->bind_result($id, $name, $grade, $rank, $competes_with);
echo "<div class='hidden-lg hidden-md'><hr class='hidden-lg hidden-md'></div>";
while($stmt->fetch()){
	ob_start(); ?>
	<div class='row'>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" onsubmit="restore_user(this); return false;">
				<input name="id" type="hidden" value='<?php echo "$id'";?>>
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<span class="hidden-lg hidden-md control-label">Name:</span>
						<?php echo "<span data-toggle='tooltip' title='Name' class='control-label'>$name</span>";?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<span class="control-label">Grade:</span>
						<?php echo "<span class='control-label'>$grade</span>";?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<span class="hidden-lg control-label hidden-md">Division:</span>
						<?php echo "<span data-toggle='tooltip' title='Division' class='control-label'>".division_name(division($grade))."</span>";?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<span class="hidden-lg hidden-md control-label">Competes With:</span>
						<?php echo "<span data-toggle='tooltip' title='Competes With' class='control-label'>".competes_with($competes_with)."</span>";?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 bottom3">
						<span class="hidden-lg hidden-md control-label">Rank:</span>
						<?php echo "<span data-toggle='tooltip' title='Rank' class='control-label'>".rank($rank)."</span>";?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<?php
						if($_SESSION['rank'] >= 2){
							echo '<button class="btn btn-primary" style="width:100%">Restore User</button>';
						}
					?>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class='hidden-lg hidden-md'>
		<hr class='hidden-lg hidden-md'>
	</div>
<?php 
	echo ob_get_clean();
}
?>