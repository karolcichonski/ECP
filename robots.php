 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="robots";
	$sql="SELECT*FROM {$db_table_name} ORDER BY id DESC lIMIT 15";
	
	if(isset($_POST['robot_selected_project'])){
		$_SESSION['robot_selected_project']=$_POST['robot_selected_project'];
	}
	
	if(isset($_POST['robot_selected_area'])){
		$_SESSION['robot_selected_area']=$_POST['robot_selected_area'];
	}
	
	
	if(isset($_POST['robot_selected_area'])){
		$_SESSION['robot_selected_area']=$_POST['robot_selected_area'];
	}
	
	if (isset($_SESSION['robot_selected_project'])){
		$Areas_id_name_table=Areas_Id_Table($_SESSION['robot_selected_project']);	
		if ($_SESSION['robot_selected_project']==0){
			$sql="SELECT*FROM {$db_table_name} ORDER BY id DESC";
		}else{
		if(isset($_POST['robot_selected_area'])){
			$sql="SELECT*FROM {$db_table_name} WHERE project_id='{$_SESSION['robot_selected_project']}' AND area_id='{$_SESSION['robot_selected_area']}' ORDER BY id DESC";			
		}else{
			$sql="SELECT*FROM {$db_table_name} WHERE project_id='{$_SESSION['robot_selected_project']}' ORDER BY id DESC";
		}
	}
	}
	
	$Areas_id_name_atable=Areas_Id_aTable();
	$Project_id_name_atable=Projects_Id_aTable();
	$project_id_name_table=Projects_Id_Table();
	
	
	if($result=$db->query($sql))
	{
		$num_robots=$result->rowCount();
		$robots_table=$result->fetchAll();
	} 
	
	for($i=0; $i<$num_robots; $i++){
		
		$robots_table[$i]['project_name']=$Project_id_name_atable[$robots_table[$i]['project_id']];
		$robots_table[$i]['area_name']=$Areas_id_name_atable[$robots_table[$i]['area_id']];
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
					$db_name=array('name','brand','project_name','area_name','tasks','seveth_axis','type');
					$table_headers=array('Name','Brand','Project','Area','Tasks','7th Axis', 'Type');
					$row_number=$num_robots;
					$table_title="ROBOTS LIST";

					$table_array=create_table($robots_table, $table_title, $db_name, $table_headers, $row_number);
				
				?>
				</section>
				
				<section>
					<div id="form">
						<div id="robots_filter">
								<div id="robots_filterL">
								<form method="post">
									<label> PROJECT <select name="robot_selected_project" class="selector" onchange="this.form.submit()" style="width:200px;">
										<?php
											for($i=0; $i<count($project_id_name_table); $i++)
											{
												if( isset($_SESSION['robot_selected_project']) && $_SESSION['robot_selected_project']==$project_id_name_table[$i][0]){
													echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
												}elseif (!isset($_SESSION['robot_selected_project']) && $i==0){
													echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
												}else{
													echo '<option value="'.$project_id_name_table[$i][0].'">'.$project_id_name_table[$i][1].'</option>';
												}
											}
										
										?>
									</select></label>
								</form>
								</div>
								<div id="robots_filterR">
								<form method="post">
									<label> AREA <select name="robot_selected_area" class="selector" onchange="this.form.submit()" style="width:200px;">
										<?php
											for($i=0; $i<count($Areas_id_name_table); $i++)
											{
												if( isset($_SESSION['robot_selected_area']) && $_SESSION['robot_selected_area']==$Areas_id_name_table[$i][0]){
													echo '<option value="'.$Areas_id_name_table[$i][0].'" selected>'.$Areas_id_name_table[$i][1].'</option>';
												}else{
													echo '<option value="'.$Areas_id_name_table[$i][0].'" >'.$Areas_id_name_table[$i][1].'</option>';
												}
											}
										?>
										
									</select></label>
								</form>
								</div>
								<div style="clear:both;"></div>
						</div>
						<form method="post">
							<div class="form_row">
								<label> ROBOT NAME <input type="text" class="form_field" style="width:120px;" name="robot_name"> </label>	
								<label> 7yh Axis
									<select id="ax_select" name="robot_7th_axis" class="selector">
										<option value="YES" > YES </option>
										<option value="NO" selected> NO </option>
									</select>
								</label>
								<label> ROBOT TYPE<input type="text" class="form_field" style="width:120px;" name="robot_type" > </label>
							</div>
							<div class="form_row">
								<label> TASKS <input type="text" class="form_field" style="width:400px;" name="robot_tasks" > </label>
							</div>
								<input type="submit" value="ADD ROBOT" class="form_button"> 
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