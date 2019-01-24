 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="projects";
	$workers_table=Workers_Id_Table();
	$project_id_table=Projects_Id_Table();
			
	if(isset($_POST['new_project_name']) and $_SESSION['logged_worker_permissions']>1 )
	{
		add_project();
	}
	
	if (isset($_POST['record_to_remove'])){
		remove_record_in_db($_POST['record_to_remove'], "projects");
		unset($_POST['record_to_remove']);
	}
	
	
	if (isset($_POST['summary_selected_project'])){
		$_SESSION['summary_selected_project']=$_POST['summary_selected_project'];
		$projectName=$_POST['summary_selected_project'];
		for($i=0;$i<count($project_id_table);$i++){
			if($project_id_table[$i][1]==$projectName){
				$projectID=$project_id_table[$i][0];
				$sql="SELECT*FROM $db_table_name WHERE id=$projectID ORDER BY id DESC";
					if($result=$db->query($sql))
					{
						$num_projects=$result->rowCount();
						$summary_table=$result->fetchAll();
					} 
			}
		}
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
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Francois+One&amp;subset=latin-ext" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="scripts.js"></script>
</head>

<body onload='onload_module(4,"project_mode_number"), hide_table()'>
		<header>
			<h1 id="logo"> 
				<font color="#cc3333" size="7">alpha </font>
				<font color="lightgray"  size="7">rob  </font> 
				<font color="white"  size="7"> offline robots programing </font>
			</h1>
		</header>
		<div>
			<nav> 
				<ul class="navigation">
					<li> <a href="workers.php" >Workers</a></li>
					<li style="background-color:#424242";"> <a href="projects.php" >Projects</a></li>
					<li> <a href="areas.php" >Areas</a></li>
					<li> <a href="robots.php" >Robots</a></li>
					<li> <a href="ecp.php" >ECP</a></li>
					<li> <a href="old_ecp.php" >OLD ECP</a></li>
					<li> <a href="logout.php"> Log Out: <?php echo $_SESSION['logged_worker_name']." ".$_SESSION['logged_worker_surname']; ?> </a></li>
				</ul>
			</nav>
		</div>
		<main>
			<div id="container">
				<section>
					<div id="table_container">
					<?php
						$db_name=array('project_name','brand','software','rcs','robots_type','takt_time','customer','main_tasks','service_tasks','signals','downloads','mrs','upload_on_plant');
						$table_headers=array('Project name','Brand','Software','RCS','Robots type','Takt time','Customer','Main T.','Service T.','Signals','Downl.','MRS','Upload');
						$row_number=$num_projects;
						$table_title="PROJECTS LIST";
						$table_array=create_table($projects_table, $table_title, $db_name, $table_headers, $row_number);
					?>
					</div>
				</section>
				
				<section>
					<?php 
					if($_SESSION['logged_worker_permissions']<2)
					{
						echo '<div style="display:none;">';
					}
					else
					{
						echo '<div style="display:block;">';
					}
					?>
						<div>
							<ul class="mode_navigation">
								<li onclick='module_nav_click(1,4,"project_mode_number")' id="mode_butt_1">Add project</li>
								<li onclick='module_nav_click(2,4,"project_mode_number")' id="mode_butt_2">Update project</li>
								<li onclick='module_nav_click(3,4,"project_mode_number")' id="mode_butt_3">Delete project</li>
								<li onclick='module_nav_click(4,4,"project_mode_number"), toggle_table()' id="mode_butt_4">Project summary</li>
							</ul>
						</div>
						<div id="form">
							<div class="form_container">
								<div id="mode1" class="single_mode_container">
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
								<div id="mode2" class="single_mode_container">
									<form method="post">
										update test
									</form>
								</div>
								<div id="mode3" class="single_mode_container">
									<form method="post">
										<label> LP <select name="record_to_remove" class="selector">
										<?php
											for($i=0; $i<$row_number; $i++){
												echo '<option value="'.$projects_table[$i]["id"].'">'.($i+1).'</option>';
											}
											echo "</select></label>";
											if (isset($_SESSION['RemoveRecordOK'])){
												echo '<div class="form_success">'.$_SESSION['RemoveRecordOK'].'</div>';
												unset($_SESSION['RemoveRecordOK']);
												}

											if(isset($_SESSION['RemoveRecordErr'])){
												echo '<div class="form_error_com">'.$_SESSION['RemoveRecordErr'].'</div>';
												unset($_SESSION['RemoveRecordErr']);
												}
										?>
										<input type="submit" class="form_button" value="REMOVE" style="width:100px;" ></input>
									</form>
								</div>
								<div id="mode4" class="single_mode_container" style="min-height:700px;">
									<form method="post">
										<label> PROJECT <select name="summary_selected_project" class="selector" style="width:200px; margin-top:20px;">
											<?php
												
												for($i=0; $i<count($project_id_table); $i++)
												{
													if($_SESSION['summary_selected_project']==$project_id_table[$i][1]){
														echo '<option value="'.$project_id_table[$i][1].'" selected>'.$project_id_table[$i][1].'</option>';
													}else{
														echo '<option value="'.$project_id_table[$i][1].'">'.$project_id_table[$i][1].'</option>';	
													}
												}
											
											?>
										</select></label>
																
										<input type="submit" value="Generate Summary" class="form_button" style="width:200px;"></input>
									</form>
									<?php 
										if(isset($_SESSION['summary_selected_project'])){
											create_summary_table($summary_table, $projectID);
											unset($_SESSION['summary_selected_project']);
										}
									?>
									
								</div>
							</div>
						</div>
						
					</div>
				</section>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 