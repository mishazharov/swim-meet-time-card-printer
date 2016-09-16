<?php
require_once(dirname(__FILE__).'/functions.php');
?>
<div class="row" style="text-align:center">
	<form method="post" class="form-inline">
		<div class="row bottom3">
			<div class="form-group">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" data-toggle="tooltip" title="" data-original-title="Grade">
					<select onchange="first_login(this)" name="grade" class="form-control" id="team_list_widget_grade">
						<option selected="" value="9">Gr.9</option>
						<option value="10">Gr.10</option>
						<option value="11">Gr.11</option>
						<option value="12">Gr.12</option>
						<option value="13">Victory Lap</option>
					</select>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<div class="" data-toggle="tooltip" title="" data-original-title="Who do you compete with?">
					<select onchange="first_login(this)" name="competes_with" class="form-control" id="team_list_widget_competes_with">
						<option selected="" value="0">Girls</option>
						<option value="1">Boys</option>
					</select>
				</div>
			</div>
		</div>
	</form>
</div>