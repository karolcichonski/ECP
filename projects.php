 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="projects";
	
	$sql="SELECT*FROM {$db_table_name}";
	
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
						$db_name=array('id','project_name','brand','software','rcs','robots_type','takt_time','upload_on_plant','customer');
						$table_headers=array('ID','Project name','Brand','Software','RCS','Robots type','Takt time','Upload on plant','Customer');
						$row_number=$num_projects;
						$table_title="PROJECTS LIST";

						$table_array=create_table($projects_table, $table_title, $db_name, $table_headers, $row_number);
					
					?>
				</section>
				
				<section>
					<div id="form">
					
						<form method="post">
							<div>
							<label> PROJECT NAME <input type="text" class="form_field" name="project_name"> </label>				
							<label> BRAND <input type="text"  class="form_field" name="project_brand"> </label>
							</div>
							<div>
							<label> SOFTWARE <input type="text" class="form_field" name="project_software"> </label>
							<label> RCS <input type="text" class="form_field" name="project_rcs"> </label>
							<label> ROBOT TYPE<input type="text" class="form_field" name="project_robots"> </label>
							</div>
							<div>
							<label> TAKT TIME<input type="text" class="form_field" name="project_takt"> </label>
							<label> CUSTOMER<input type="text" class="form_field" name="project_customer"> </label>
							</div>
							
							<input type="submit" value="ADD PROJECT" id="add_button">
					
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