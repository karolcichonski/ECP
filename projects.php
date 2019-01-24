 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="projects";
	
	if(isset($_POST['new_project_name']) and $_SESSION['logged_worker_permissions']>1 )
	{
		add_project();
	}
	
	$sql="SELECT*FROM {$db_table_name} ORDER BY id DESC";
	
	if($result=$db->query($sql))
	{
		$num_projects=$result->rowCount();
		$projects_table=$result->fetchAll();
	} 
	

	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ALPHAROB PROJECT PLATFORM</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link href="https://fonts.googleapis.com/css?family=Francois+One&amp;subset=latin-ext" rel="stylesheet"> 
</head>

<body>
		<header>
			<h1 id="logo"> 
				<font color="#cc3333" size="7">alpha </font>
				<font color="lightgray"  size="7">rob  </font> 
				<font color="white"  size="7"> offline robots programing </font>
			</h1>
		</header>
		
		<nav> 
			<ul class="navigation">
				<li> <a href="workers.php" >Workers</a></li>
				<li> <a href="projects.php" >Projects</a></li>
				<li> <a href="areas.php" >Areas</a></li>
				<li> <a href="robots.php" >Robots</a></li>
				<li> <a href="ecp.php" >ECP</a></li>
				<li> <a href="logout.php"> Log Out: <?php echo $_SESSION['logged_worker_name']." ".$_SESSION['logged_worker_surname']; ?> </a></li>
			</ul>
		</nav>
		
		<main>
			<div id="container">
				<section>
					<?php
						$db_name=array('project_name','brand','software','rcs','robots_type','takt_time','customer','main_tasks','service_tasks','signals','downloads','mrs','upload_on_plant');
						$table_headers=array('Project name','Brand','Software','RCS','Robots type','Takt time','Customer','Main T.','Service T.','Signals','Downl.','MRS','Upload');
						$row_number=$num_projects;
						$table_title="PROJECTS LIST";

						$table_array=create_table($projects_table, $table_title, $db_name, $table_headers, $row_number);
					
					?>
				</section>
				
				<section>
					<div id="form">
					
						<form method="post">
							<div class="form_row">
							<label> PROJECT NAME <input type="text" class="form_field" name="new_project_name" required> </label>				
							<label> BRAND <input type="text"  class="form_field" name="new_project_brand"> </label>
							</div>
							<div class="form_row">
							<label> SOFTWARE <input type="text" class="form_field" name="new_project_software"> </label>
							<label> RCS <input type="text" class="form_field" name="new_project_rcs"> </label>
							<label> ROBOT TYPE<input type="text" class="form_field" name="new_project_robots"> </label>
							</div>
							<div class="form_row">
							<label> TAKT TIME<input type="text" class="form_field" name="new_project_takt"> </label>
							<label> CUSTOMER<input type="text" class="form_field" name="new_project_customer"> </label>
							</div>
							<div class="form_row">
							<label> MAIN T.<select class="selector" name="new_project_main"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							<label> SERVICE T.<select class="selector" name="new_project_service"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							<label> SIGNALS <select class="selector" name="new_project_signals"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							<label> DOWNLOADS<select class="selector" name="new_project_download"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							<label> MRS/SOP<select class="selector" name="new_project_mrs"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							<label> UPLOAD<select class="selector" name="new_project_upload"> 
										<option value=0 selected>NO</option>
										<option value=1>YES</option>
							</select></label>
							</div>
								<?php 
									if (isset($_SESSION['AddProjectStatusOK'])){
										echo '<div class="form_success">'.$_SESSION['AddProjectStatusOK'].'</div>';
										/* sleep(5); */
										unset($_SESSION['AddProjectStatusOK']);
										/* header ("Refresh:0"); */
										}
									
									
									if(isset($_SESSION['AddProjectStatusER'])){
										echo '<div class="form_error_com">'.$_SESSION['AddProjectStatusER'].'</div>';
										/* sleep(5); */
										unset($_SESSION['AddProjectStatusER']);
										/* header ("Refresh:0"); */
										}
								?>
							<input type="submit" value="ADD PROJECT" class="form_button">
					
						</form>
					</div>
				</section>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 