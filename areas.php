 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	unset_worker_mode();
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
						<form method="post" id="modul_select_form" >
							<div class="mode_selector_3">
								<div class="mode_select" onclick="add_click()" id="add_module" name="form_action">Add area</div>
								<div class="mode_select" onclick="update_click()" id="update_module" name="form_action"> Update area </div>
								<div class="mode_select" onclick="delete_click()" id="delete_module" name="form_action"> Delete area  </div>
								<div style="clear:both;"></div>
							</div>
						</form>
							
						<div class="form_container" >
							<form method="post" id="Add_form">
								<div class="form_row">
								<label> AREA NAME <input type="text"  class="form_field" name="add_area_name" required> </label>
								<label> PART <input type="text"  class="form_field" name="add_area_part"> </label>
								<label> NUMBER OF ROBOTS <input type="number"  class="add_form_field" name="add_num_robots"> </label>
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
							<form method="post" id="Update_form">
								update test
							</form>
							<form method="post" id="Delete_form">
								delete test
							</form>
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