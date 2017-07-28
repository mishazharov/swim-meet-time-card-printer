<?php
	require_once(dirname(__FILE__).'/functions.php');
	if(!isset($_SESSION['rank'])){
		echo "Please log in again to continue...";
		die();
	}
	if($_SESSION['rank'] < 1){
		echo "This is only available to Captains...";
		die();
	}
	require_once(dirname(__FILE__).'/db_connect.php');
	echo "
		<div class='row bottom4'>
			<h2 class='text-center'>Edit team Members<h2>
		</div>
	";
	
	help("Here you can view team members and edit relevant information, captains will only be able to see and edit information from their division. Information is updated as soon as you change an option.
			If there is an error updating the entry, the box should light up red, otherwise the table will update itself. Also, you can click on titles to collapse and show divisions, and you can click on usernames to display additional information", false);
	//Unknown swimmers
	list_team(-1, -1, -1, $mysqli);
	
	//Jr boys
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 1 && $_SESSION['competes_with'] == 1)){
		list_team(1, 1, 0, $mysqli);
	}
	
	//Jr girls
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 1 && $_SESSION['competes_with'] == 0)){
		list_team(1, 0, 0, $mysqli);
	}
	//Sr boys
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 2 && $_SESSION['competes_with'] == 1)){
		list_team(2, 1, 0, $mysqli);
	}
	//Sr girls
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 2 && $_SESSION['competes_with'] == 0)){
		list_team(2, 0, 0, $mysqli);
	}
	
	//Open Boys
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 0 && $_SESSION['competes_with'] == 1)){
		list_team(0, 1, 0, $mysqli);
	}
	
	//Open girls
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 1 && $_SESSION['competes_with'] == 1)){
		list_team(0, 0, 0, $mysqli);
	}
	//Jr boys captains
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 1 && $_SESSION['competes_with'] == 1)){
		list_team(1, 1, 1, $mysqli);
	}
	//Jr girls captains
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 1 && $_SESSION['competes_with'] == 0)){
		list_team(1, 0, 1, $mysqli);
	}
	//Sr boys captains
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 2 && $_SESSION['competes_with'] == 1)){
		list_team(2, 1, 1, $mysqli);
	}
	//Jr girls captains
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 2 && $_SESSION['competes_with'] == 0)){
		list_team(2, 0, 1, $mysqli);
	}
	//Open boys captains
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 0 && $_SESSION['competes_with'] == 1)){
		list_team(0, 1, 1, $mysqli);
	}
	//Open girls 
	if($_SESSION['rank'] >= 2 || ($_SESSION['division'] == 0 && $_SESSION['competes_with'] == 0)){
		list_team(0, 0, 1, $mysqli);
	}
	if($_SESSION['rank'] >= 3){
		list_team(0, 0, 2, $mysqli);
	}
	
	
	
	function list_team($division, $competes_with, $rank, $mysqli){
		if(!($rank >= 2) && $division != -1){
			$stmt = $mysqli->prepare("SELECT name, id, grade, competes_with, rank FROM users WHERE division = ? AND competes_with = ? AND rank = ? AND deleted = 0 AND rank < 3 ORDER BY name ASC");
			$stmt->bind_param("iii", $division, $competes_with, $rank);
		}else if($division == -1){
			$stmt = $mysqli->prepare("SELECT name, id, grade, competes_with, rank FROM users WHERE (division = ? OR grade = ?) AND deleted = 0 AND rank < 3 ORDER BY name ASC");
			//echo $mysqli->error;
			$var = -1;
			$stmt->bind_param("ii", $var, $var);
		}else{
			$stmt = $mysqli->prepare("SELECT name, id, grade, competes_with, rank FROM users WHERE rank = ? AND deleted = 0 AND rank < 3 ORDER BY name ASC");
			$stmt->bind_param("i", $rank);
		}
		$stmt->execute();
		$stmt->bind_result($name, $id, $grade, $competes_with, $rank);
		
		
		
		echo "<div class='row bottom3'><div class='col-lg-4 col-md-3 col-sm-1 hidden-xs'></div><div class='col-lg-4 col-md-6 col-sm-10 col-xs-12'><a data-toggle='collapse' href='#$division$rank$competes_with'><h4 class='text-center'>";
		if($rank < 2){
			if($division == 0){
				echo "Open ";
			} else if ($division == 1){
				echo "Junior ";
			} else if($division == 2){
				echo "Senior ";
			} else if($division == -1){
				echo "Unknown Grade or Division";
			}
			if($competes_with == 0){
				echo "Girls";
			} else if($competes_with == 1){
				echo "Boys";
			}
			if($rank == 1){
				echo " Captain";
			}
		} else {
			if($rank >= 3){
				echo "Admin";
			} else if($rank == 2){
				echo "Manager";
			}
		}
		echo "</h4></a></div></div>";
		echo "<div class='collapse in' id='$division$rank$competes_with'>";
		while($stmt->fetch()){
			$yes=1;
			echo '<hr class="hidden-lg">';
			individual_form($name, $id, $grade, $competes_with, $rank);
		}
		if(isset($yes)){
			echo '<hr class="hidden-lg">';
		}
		echo "</div>";
		$stmt->close();
	}
	function individual_form($name, $id, $grade, $competes_with, $rank){ ob_start(); ?>
	<form method="post" class="form-inline">
		<input type="hidden" name="id" style="display:none" value=<?php echo "'$id'";?>>
		<div class="row bottom2">
			<div class="col-md-6 col-sm-6 col-xs-4 bottom2 hidden-lg">
				<div class="row">
					
					<?php
						if($rank >= 2){
							echo '<div class="col-md-12" style="padding-bottom:3em">';
						}else{
							echo '<div class="col-md-12 bottom5">';
						}
					?>
						<label class="control-label hidden-lg" for="team_list_widget_username">Username:</label>
					</div>
					<?php
					
						if($rank < 2)echo '<div class="col-md-12 bottom5">';
						if($rank < 2)echo '	<label class="control-label hidden-lg" for="team_list_widget_grade">Grade:</label>';
						if($rank < 2)echo '</div>';
						if($rank < 2)echo '<div class="col-md-12 bottom5 hidden-lg hidden-xs">';
						if($rank < 2)echo '	<label class="control-label hidden-lg hidden-xs" for="team_list_widget_competes_with">Competes with:</label>';
						if($rank < 2)echo '</div>';
						if($rank < 2)echo '<div class="col-md-12 bottom5 hidden-sm hidden-md hidden-lg">';
						if($rank < 2)echo '	<label class="control-label hidden-lg" for="team_list_widget_competes_with">Gender:</label>';
						if($rank < 2)echo '</div>';
					
					?>
					<div class="col-md-12 bottom5">
						<label class="control-label hidden-lg" for="team_list_widget_rank">Rank:</label>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-8 col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<div data-toggle='collapse' href='#team_list_widget_swimmer_<?php echo "$id'";?>>
						<?php
							echo "<div class='visible-lg control-label' style='margin-top: 0.6em'>$name</div>";
							echo "<div class='hidden-lg control-label bottom5' style='margin-top: 0.1em'>$name</div>";
						?>
						</div>
					</div>
					<div class="col-lg-2">
						<div class='form-group'>
							<div class="" data-toggle="tooltip" title="Grade">
							<?php
								if($rank < 2){
									echo '<select onchange="edit_user(this)" name="grade" class="form-control" id="team_list_widget_grade">';
										if($_SESSION['division'] == 1 || $_SESSION['division'] == 0 || $_SESSION['rank'] >= 2){
												if($grade==9){
													echo '<option selected value="9">Gr.9</option>';
												}else{
													echo '<option value="9">Gr.9</option>';
												}
												if($grade==10){
													echo '<option selected value="10">Gr.10</option>';
												}else{
													echo '<option value="10">Gr.10</option>';
												}
										}
										if($_SESSION['division'] == 2 || $_SESSION['division'] == 0 || $_SESSION['rank'] >= 2){
												if($grade==11){
													echo '<option selected value="11">Gr.11</option>';
												}else{
													echo '<option value="11">Gr.11</option>';
												}
												if($grade==12){
													echo '<option selected value="12">Gr.12</option>';
												}else{
													echo '<option value="12">Gr.12</option>';
												}
												if($grade==13){
													echo '<option selected value="13">Victory Lap</option>';
												}else{
													echo '<option value="13">Victory Lap</option>';
												}
										}
										if($grade == -1 && $_SESSION['rank'] >= 2){
											echo '<option selected value="-1">Not sure</option>';
										}else if($_SESSION['rank'] >= 2){
											echo '<option value="-1">Not sure</option>';
										}
									echo '</select>';
								}
							?>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class='form-group'>
						<?php
						if($rank < 2){
							echo '<div class="" data-toggle="tooltip" title="Competes With">';
							echo '	<select onchange="edit_user(this)" name="competes_with" class="form-control" id="team_list_widget_competes_with">';
								
										if(isset($_SESSION['rank'])){
											if($_SESSION['rank'] != 1 || $_SESSION['competes_with'] == 0){
												if($competes_with == 0){
													echo '<option selected value="0">Girls</option>';
												}else{
													echo '<option value="0">Girls</option>';
												}
											}
											if($_SESSION['rank'] != 1 || $_SESSION['competes_with'] == 1){
												if($competes_with == 1){
													echo '<option selected value="1">Boys</option>';
												}else{
													echo '<option value="1">Boys</option>';
												}
											}
										}

							echo '	</select>';
							echo '</div>';
						}
						?>
						</div>
					</div>
					<div class="col-lg-2">
						<div class='form-group'>
							<div class="" data-toggle="tooltip" title="Rank">
								<select onchange="edit_user(this)" name="rank" class="form-control" id="team_list_widget_rank">
									<?php
									if($rank < $_SESSION['rank']){
										echo '<option value="0">Swimmer</option>';
										if(isset($_SESSION['rank'])){
											if($_SESSION['rank'] > 1){
												if($rank == 1){
													echo '<option selected value="1">Captain</option>';
												}else{
													echo '<option value="1">Captain</option>';
												}
											}
											if($_SESSION['rank'] > 2){
												if($rank == 2){
													echo '<option selected value="2">Manager</option>';
												}else{
													echo '<option value="2">Manager</option>';
												}
											}
											if($_SESSION['rank'] > 3){
												if($rank == 3){
													echo '<option selected value="3">Admin</option>';
												}else{
													echo '<option value="3">Admin</option>';
												}
											}
										}
									}else{
										$var = htmlspecialchars(rank($rank), ENT_QUOTES);
										echo "<option>$var</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="collapse row" id='team_list_widget_swimmer_<?php echo "$id'";?>>
	<?php
	if($rank < $_SESSION['rank']){
		if($_SESSION['rank'] < 2){
			$width = 12;
		}else{
			$width = 6;
		}
		echo "<div class='col-lg-$width col-md-$width col-sm-12 col-xs-12' data-toggle='tooltip' title='This action is reversible by Managers and Admins'>";
		echo '<form method="post" onsubmit="delete_user(this); return false;">';
		echo "<input type='hidden' name='id' value='$id'>";
		echo '<button class="btn btn-warning" style="width:100%" value="Submit">Archive User</button>';
		echo '</form>';
		echo '</div>';
		
		if($_SESSION['rank'] >= 2){
			echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-toggle="tooltip" title="This action is not reversible">';
			echo '<form method="post" onsubmit="delete_user(this, 1); return false;">';
			echo "<input type='hidden' name='id' value='$id'>";
			echo '<button class="btn btn-danger" style="width:100%" value="Submit">Delete User</button>';
			echo '</form>';
			echo '</div>';
		}
	}
	?>
	</div>
	<?php
		echo ob_get_clean();
	} 
?>

