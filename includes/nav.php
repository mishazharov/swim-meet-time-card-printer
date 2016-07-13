<?php require_once(dirname(__FILE__).'/db_connect.php');?>
<nav class="navbar navbar-default">
		<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand hidden-sm" href="<?php echo URL;?>"><?php echo SITE_NAME;?></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           				<span class="sr-only">Toggle navigation</span>
           				<span class="icon-bar"></span>
           				<span class="icon-bar"></span>
           				<span class="icon-bar"></span>
          				</button>
				</div>
				<div id='navbar' class='navbar-collapse collapse'>
					<ul class="nav navbar-nav">
					<li <?php if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="home.php" || strtok(basename($_SERVER["REQUEST_URI"]), '?')=="index.php")echo "class='active'";?> ><a href='home.php'>Swim</a></li>
					<?php
						if(isset($_SESSION['rank']) && $_SESSION['rank'] >= 1){
							if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="users.php"){
								echo "<li class='active'><a href='users.php'>Users</a></li>";
							}else{
								echo "<li><a href='users.php'>Users</a></li>";
							}
							if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="view_archive.php" && $_SESSION['rank']>=2){
								echo "<li class='active'><a href='view_archive.php'>Archive</a></li>";
							}else if($_SESSION['rank']>=2){
								echo "<li><a href='view_archive.php'>Archive</a></li>";
							}
							if($_SESSION['rank']>=2){
								echo "<li class='dropdown'>";
								echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meets<span class="caret"></span></a>';
								echo "<ul class='dropdown-menu'>";
								if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="meets.php" && $_SESSION['rank']>=2){
									echo "<li class='active'><a href='meets.php'>Add a meet</a></li>";
								}else if($_SESSION['rank']>=2){
									echo "<li><a href='meets.php'>Add a meet</a></li>";
								}
								if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="meet_type.php" && $_SESSION['rank']>=2){
									echo "<li class='active'><a href='meet_type.php'>Add meet events</a></li>";
								}else if($_SESSION['rank']>=2){
									echo "<li><a href='meet_type.php'>Add meet events</a></li>";
								}
								echo "</ul>";
								echo "</li>";
								if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="print.php" && $_SESSION['rank']>=2){
									echo "<li class='active'><a href='print.php'>Print Timecards</a></li>";
								}else if($_SESSION['rank']>=2){
									echo "<li><a href='print.php'>Print Timecards</a></li>";
								}
							}
						}
						if(strtok(basename($_SERVER["REQUEST_URI"]), '?')=="settings.php"){
							echo "<li class='active'><a href='settings.php'>Settings</a></li>";
						}else if(isset($_SESSION['rank'])){
							echo "<li><a href='settings.php'>Settings</a></li>";
						}
						if(isset($_SESSION['rank'])){
							echo "<li><a href='logout.php'>Log Out</a></li>";
						}
					?>
				</div>
		</div>
</nav>