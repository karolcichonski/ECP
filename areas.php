 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="areas";
	
	if (!isset($_SESSION['area_selected_project'])){
		$_SESSION['area_selected_project']=Get_last_project_id();
	}
		
	if(isset($_POST['area_selected_project'])){
		$_SESSION['area_selected_project']=$_POST['area_selected_project'];
		unset($_POST['area_selected_project']);
	}
	
	if(isset($_POST['add_area_name']) && $_SESSION['logged_worker_permissions']>1 )
	{
		add_area();
	}
	
	if (isset($_POST['record_to_remove'])){
		remove_record_in_db($_POST['record_to_remove'], "areas");
		unset($_POST['record_to_remove']);
	}
	
	$sql="SELECT*FROM {$db_table_name} WHERE project_id={$_SESSION['area_selected_project']} ORDER BY id ASC";
	
	
	if($result=$db->query($sql))
	{
		$num_areas=$result->rowCount();
		$areas_table=$result->fetchAll();
	} 
	
	$Project_id_name_atable=Projects_Id_aTable();
	$project_id_name_table=Projects_Id_Table();
	
	for($i=0; $i<$num_areas; $i++){
		
		$areas_table[$i]['ProjectName']=$Project_id_name_atable[$areas_table[$i]['project_id']];
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

<body onload='onload_module(3,"area_mode_number")'>
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
				<li style="background-color:#424242";"> <a href="areas.php" >Areas</a></li>
				<li> <a href="robots.php" >Robots</a></li>
				<li> <a href="ecp.php" >ECP</a></li>
				<li> <a href="old_ecp.php" >OLD ECP</a></li>
				<li> <a href="logout.php"> Log Out: <?php echo $_SESSION['logged_worker_name']." ".$_SESSION['logged_worker_surname']; ?> </a></li>
			</ul>
		</nav>
		
		<main>
			<div id="container">
					<div class="form_row">
						
						<form method="post">
							<div class="form_row">			
							<label> PROJECT <select name="area_selected_project" class="selector" onchange="this.form.submit()">
								<?php
									for($i=0; $i<count($project_id_name_table); $i++)
									{
										if( $_SESSION['area_selected_project']==$project_id_name_table[$i][0]){
										echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
										}else{
											echo '<option value="'.$project_id_name_table[$i][0].'" >'.$project_id_name_table[$i][1].'</option>';
										}
									}
								?>
							</select></label>
						</form>
					</div>
				</br>
				<section>
				<?php
					$db_name=array('ProjectName','name','part','number_of_robots');
					$table_headers=array('Project name','Area name','Part','Number of robots');
					$row_number=$num_areas;
					$table_title="AREAS LIST";

					$table_array=create_table($areas_table, $table_title, $db_name, $table_headers, $row_number);
				
				?>
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
							<li onclick='module_nav_click(1,3,"area_mode_number")' id="mode_butt_1">Add area</li>
							<li onclick='module_nav_click(2,3,"area_mode_number")' id="mode_butt_2">Update area</li>
							<li onclick='module_nav_click(3,3,"area_mode_number")' id="mode_butt_3">Delete area</li>
						</ul>
					</div>
						<div class="form_container" >
							<div id="mode1" class="single_mode_container">
								<form method="post">
									<div class="form_row">
									<label> AREA NAME <input type="text"  class="form_field" name="add_area_name" required> </label>
									<label> PART <input type="text"  class="form_field" name="add_area_part"> </label>
									<label> NUMBER OF ROBOTS <input type="number"  class="form_field" name="add_num_robots"> </label>
									</div>
										<?php 
											if (isset($_SESSION['AddAreaStatusOK'])){
												echo '<div class="form_success">'.$_SESSION['AddAreaStatusOK'].'</div>';
												/* sleep(5); */
												unset($_SESSION['AddAreaStatusOK']);
												/* header ("Refresh:0"); */
												}
											
											
											if(isset($_SESSION['AddAreaStatusER'])){
												echo '<div class="form_error_com">'.$_SESSION['AddAreaStatusER'].'</div>';
												/* sleep(5); */
												unset($_SESSION['AddAreaStatusER']);
												/* header ("Refresh:0"); */
												}
										?>
									<input type="submit" value="ADD AREA " id="add_area_button" class="form_button">
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
											echo '<option value="'.$areas_table[$i]["id"].'">'.($i+1).'</option>';
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
						</div>
					</div>
				</section>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 