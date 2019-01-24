 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	unset_worker_mode();
	$db_table_name="ecp";
	
	if (isset($_POST['ecp_date'])){
		add_ecp();
	}
	
	if (!isset($_SESSION['ecp_selected_project'])){
		$_SESSION['ecp_selected_project']=Get_last_project_id();
		$_SESSION['ecp_selected_area']=Get_first_area_in_project($_SESSION['ecp_selected_project']);
		$_SESSION['ecp_selected_robot']=Get_first_robot_in_area($_SESSION['ecp_selected_area']);
	}
	
	if(isset($_POST['ecp_selected_robot'])){
		$_SESSION['ecp_selected_robot']=$_POST['ecp_selected_robot'];
		unset($_POST['ecp_selected_robot']);
	}
	
	if(isset($_POST['ecp_selected_area'])){
		$_SESSION['ecp_selected_area']=$_POST['ecp_selected_area'];
		unset($_POST['ecp_selected_area']);
		$_SESSION['ecp_selected_robot']=Get_first_robot_in_area($_SESSION['ecp_selected_area']);
	}
	
	if(isset($_POST['ecp_selected_project'])){
		$_SESSION['ecp_selected_project']=$_POST['ecp_selected_project'];
		unset($_POST['ecp_selected_project']);
		$_SESSION['ecp_selected_area']=Get_first_area_in_project($_SESSION['ecp_selected_project']);
		$_SESSION['ecp_selected_robot']=Get_first_robot_in_area($_SESSION['ecp_selected_area']);
	}

	$Project_id_name_atable=Projects_Id_aTable();
	$project_id_name_table=Projects_Id_Table();
	$Areas_id_name_table=Areas_Id_Table($_SESSION['ecp_selected_project']);	
	$Areas_id_name_atable=Areas_Id_aTable();
	$Robots_id_name_table=Robots_Id_Table($_SESSION['ecp_selected_area']);	
	$Robots_id_name_atable=Robots_Id_aTable();
	
	$sql="SELECT*FROM {$db_table_name} WHERE worker_id='{$_SESSION['logged_worker_id']}' ORDER BY start_time DESC";
	
	if($result=$db->query($sql))
	{
		$num_ecp_records=$result->rowCount();
		$ecp_table=$result->fetchAll();
	} 
	
	for($i=0; $i<$num_ecp_records; $i++){
		
		$ecp_table[$i]['project_name']=$Project_id_name_atable[$ecp_table[$i]['project_id']];
		$ecp_table[$i]['area_name']=$Areas_id_name_atable[$ecp_table[$i]['area_id']];
		$ecp_table[$i]['robot_name']=$Robots_id_name_atable[$ecp_table[$i]['robot_id']];
		$StartTime= new DateTime ($ecp_table[$i]['start_time']);
		$EndTime= new DateTime ($ecp_table[$i]['end_time']);
		$ecp_table[$i]['date']=$StartTime->format('Y-m-d');
		$ecp_table[$i]['start_time1']=$StartTime->format('H:i');
		$ecp_table[$i]['end_time1']=$EndTime->format('H:i');
		if($ecp_table[$i]['additional_hour']==0){
			$ecp_table[$i]['AH']="NO";	
		}else{
			$ecp_table[$i]['AH']="YES";	
		}
		
 		if($i==0){
		$last_date=$ecp_table[$i]['date'];}
		if($i>0 && $ecp_table[$i]['date']==$last_date){
			$ecp_table[$i]['date']="";
			$ecp_table[$i]['start_time1']="";
			$ecp_table[$i]['end_time1']="";
			$ecp_table[$i]['sum_time']="";
			$ecp_table[$i]['place']="";
		}else{
			$last_date=$ecp_table[$i]['date'];
		}
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
				<li> <a href="areas.php" >Areas</a></li>
				<li> <a href="robots.php" >Robots</a></li>
				<li style="background-color:#424242";"> <a href="ecp.php" >ECP</a></li>
				<li> <a href="old_ecp.php" >OLD ECP</a></li>
				<li> <a href="logout.php"> Log Out: <?php echo $_SESSION['logged_worker_name']." ".$_SESSION['logged_worker_surname']; ?> </a></li>
			</ul>
		</nav>
		
		<main>
			<div id="container">
				<section>
				<?php
					$db_name=array('date','start_time1','end_time1','sum_time','place','project_name','area_name','robot_name','operation_time','AH','type_of_work','description');
					$table_headers=array('DATE','START','END','SUM','PLACE','PROJECT','AREA','ROBOT','TIME','AH','WORK','DESCRIPTION');
					$row_number=$num_ecp_records;
					$table_title="ECP";

					$table_array=create_table($ecp_table, $table_title, $db_name, $table_headers, $row_number);
				
				?>
				</section>
				<form method="post" id="modul_select_form" >
					<div class="mode_selector_3">
						<div class="mode_select" onclick="add_click()" id="worker_add" name="form_action">Add robot</div>
						<div class="mode_select" onclick="update_click()" id="worker_update" name="form_action"> Update robot </div>
						<div class="mode_select" onclick="delete_click()" id="worker_delete" name="form_action"> Delete robot  </div>
						<div style="clear:both;"></div>
					</div>
				</form>
				<div id="form_container">
					<form method="post">
						<div class="form_row">
							<form method="post" class="ecp_filter_form">
								<label> PROJECT <select name="ecp_selected_project" class="selector" onchange="this.form.submit()">
									<?php
										for($i=0; $i<count($project_id_name_table); $i++)
										{
											if( isset($_SESSION['ecp_selected_project']) && $_SESSION['ecp_selected_project']==$project_id_name_table[$i][0]){
												echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
											}elseif (!isset($_SESSION['ecp_selected_project']) && $i==0){
												echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
											}else{
												echo '<option value="'.$project_id_name_table[$i][0].'">'.$project_id_name_table[$i][1].'</option>';
											}
										}
									
									?>
								</select></label>
							</form>
							<form method="post" class="ecp_filter_form">
								<label> AREA <select name="ecp_selected_area" class="selector" onchange="this.form.submit()">
								
									<?php
										for($i=0; $i<count($Areas_id_name_table); $i++)
										{
											if( isset($_SESSION['ecp_selected_area']) && $_SESSION['ecp_selected_area']==$Areas_id_name_table[$i][0]){
												echo '<option value="'.$Areas_id_name_table[$i][0].'" selected>'.$Areas_id_name_table[$i][1].'</option>';
											}else{
												echo '<option value="'.$Areas_id_name_table[$i][0].'" >'.$Areas_id_name_table[$i][1].'</option>';
											}
										}
									?>
								</select></label>
							</form > 
							<form method="post" class="ecp_filter_form">
								<label> ROBOT <select name="ecp_selected_robot" class="selector" onchange="this.form.submit()">
									<?php
										for($i=0; $i<count($Robots_id_name_table); $i++)
										{
											if( isset($_SESSION['ecp_selected_robot']) && $_SESSION['ecp_selected_robot']==$Robots_id_name_table[$i][0]){
												echo '<option value="'.$Robots_id_name_table[$i][0].'" selected>'.$Robots_id_name_table[$i][1].'</option>';
											}else{
												echo '<option value="'.$Robots_id_name_table[$i][0].'" >'.$Robots_id_name_table[$i][1].'</option>';
											}
										}
									?>
								</select></label>
							</form>
						</div>	
						<form method="post">
						<div class="form_row">
							<label> DATE <input type="date" class="form_field" name="ecp_date" value="<?php echo date('Y-m-d')?>"> </label>	
							<label> START TIME <input type="time"  class="form_field" name="ecp_starttime" value="06:00"> </label>
							<label> END TIME <input type="time" class="form_field" name="ecp_endtime" value="14:00"> </label>
							<label> PLACE <input type="text" class="form_field" name="ecp_place" value="Gliwice"> </label>
						</div>
						<div class="form_row">
							<label> TIME <input type="number" class="form_field" name="ecp_time" required> </label>
							<label> Type of work <select name="ecp_type_of_work" class="selector">
								<option value="Simulation checking">Simulation checking</option>
								<option value="Preparing robot for OLP">Preparing robot for OLP</option>
								<option value="Main tasks path">Main tasks path</option>
								<option value="Service tasks path">Service tasks path</option>
								<option value="Clash">Clash</option>
								<option value="Signals/actions">Signals/actions</option>
								<option value="Standard in tasks">Standard in tasks</option>
								<option value="Downloads">Downloads</option>
								<option value="Prepare cells to send">Prepare cells to send</option>
								<option value="Dokumentation">Dokumentation</option>
								<option value="MRS/SOP">MRS/SOP</option>
								<option value="Simulation changing">Simulation changing</option>
								<option value="URLOP">URLOP</option>
								<option value="Wolne">Wolne</option>
								<option value="L4">L4</option>
								<option value="Święto">Święto</option>
								<option value="Upload on plant">Upload on plant</option>
								<option value="Others">Others</option>
							</select></label>
							<label> AH <input type="checkbox" class="form_field" name="ecp_additionalhours" value=1 > </label>	
						</div>
						<div class="form_row">
							<label> DESC. <input type="text" class="form_field" name="ecp_description" style="width:600px;"> </label>
						</div>
						<?php 
							if (isset($_SESSION['AddECPStatusOK'])){
								echo '<div class="form_success">'.$_SESSION['AddECPStatusOK'].'</div>';
								/* sleep(5); */
								unset($_SESSION['AddECPStatusOK']);
								/* header ("Refresh:0"); */
								}
							
							
							if(isset($_SESSION['AddECPStatusER'])){
								echo '<div class="form_error_com">'.$_SESSION['AddECPStatusER'].'</div>';
								/* sleep(5); */
								unset($_SESSION['AddECPStatusER']);
								/* header ("Refresh:0"); */
								}
						?>
						<input type="submit" class="form_button" value="ADD TO EPC" id="add_button">
						<?php /*echo import_csv();*/?> 
					</form>
				</div>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 