 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="areas";
	
	if (isset($_POST['areas_limit'])){
		$limit_filter=$_POST['areas_limit'];
		$project_filter=$_POST['areas_project_filter'];
		$_SESSION['areas_limit']=$_POST['areas_limit'];
		$_SESSION['areas_project_filter']=$_POST['areas_project_filter'];
	}elseif(isset($_SESSION['areas_limit'])){
		$limit_filter=$_SESSION['areas_limit'];
		$project_filter=$_SESSION['areas_project_filter'];
	}else{
		$limit_filter=15;
		$project_filter=0;
	}
	

	if ($project_filter==0){
		$sql="SELECT*FROM {$db_table_name} ORDER BY id DESC limit {$limit_filter}";
	}else{
		$sql="SELECT*FROM {$db_table_name} WHERE project_id={$project_filter} ORDER BY id DESC limit {$limit_filter}";
	}
	
	
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
					<div class="form_row">
						
						<form method="post">
							<div class="form_row">			
							<label> PROJECT <select name="areas_project_filter" class="selector" value="<?php echo $project_filter; ?>" onchange="this.form.submit()">
								<?php
									for($i=0; $i<count($project_id_name_table); $i++)
									{
										if( $project_filter==$project_id_name_table[$i][0]){
										echo '<option value="'.$project_id_name_table[$i][0].'" selected>'.$project_id_name_table[$i][1].'</option>';
										}else{
											echo '<option value="'.$project_id_name_table[$i][0].'" >'.$project_id_name_table[$i][1].'</option>';
										}
									}
								?>
								<option value="0" <?php  if($project_filter==0) echo "selected "?>>"none"</option>
							</select></label>
							<label> LIM <input type="number"  class="form_field" name="areas_limit" value="<?php echo $limit_filter; ?>" style="width:40px;" onchange="this.form.submit()"> </label>
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
					<div id="form">
					
						<form method="post">
							<div class="form_row">			
							<label> PROJECT NAME <select name="project_name_add_areas" class="selector">
								<?php
									for($i=0; $i<count($project_id_name_table); $i++)
									{
										echo '<option value="'.$project_id_name_table[$i][0].'">'.$project_id_name_table[$i][1].'</option>';
									}
								?>
							</select></label>
							</div>
							<div class="form_row">
							<label> AREA NAME <input type="text"  class="form_field" name="area_name"> </label>
							<label> PART <input type="text"  class="form_field" name="area_name"> </label>
							<label> NUMBER OF ROBOTS <input type="number"  class="form_field" name="area_name"> </label>
							</div>
							
							<input type="submit" value="ADD AREA " id="add_area_button" class="form_button">
					
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