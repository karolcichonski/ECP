 <?php
 	session_start();
	include 'func.php';
	require_once('connect.php');
	is_loged_check();
	$db_table_name="old_ecp";
	
	$workers_table=Workers_Id_Table();
	
	if(!isset($_SESSION['old_ecp_date_filter1'])){
		$_SESSION['old_ecp_date_filter1']=date("Y-m")."-01 00:00:00";
		$_SESSION['old_ecp_date_filter2']=date("Y-m-d")." 00:00:00";
		$_SESSION['old_ecp_date_filter3']=date("Y-m")."-01";
		$_SESSION['old_ecp_date_filter4']=date("Y-m-d");
	}
	
	if(isset($_POST['old_ecp_date_filter1'])){
		$_SESSION['old_ecp_date_filter1']=$_POST['old_ecp_date_filter1']." 00:00:00";
		$_SESSION['old_ecp_date_filter2']=$_POST['old_ecp_date_filter2']." 23:59:59";
		$_SESSION['old_ecp_date_filter3']=$_POST['old_ecp_date_filter1'];
		$_SESSION['old_ecp_date_filter4']=$_POST['old_ecp_date_filter2'];
	}
		
	$sql="SELECT*FROM {$db_table_name} WHERE start_time>='{$_SESSION['old_ecp_date_filter1']}' 
				and start_time<='{$_SESSION['old_ecp_date_filter2']}'  ORDER BY start_time DESC";
	
	if($result=$db->query($sql))
	{
		$num_ecp_records=$result->rowCount();
		$ecp_table=$result->fetchAll();
	} 
	
	for($i=0; $i<$num_ecp_records; $i++){
		$StartTime= new DateTime ($ecp_table[$i]['start_time']);
		$EndTime= new DateTime ($ecp_table[$i]['end_time']);
		$ecp_table[$i]['date']=$StartTime->format('Y-m-d');
		$ecp_table[$i]['start_time1']=$StartTime->format('H:i');
		$ecp_table[$i]['end_time1']=$EndTime->format('H:i');
		
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
				<li> <a href="old_ecp.php" >OLD ECP</a></li>
				<li> <a href="logout.php"> Log Out: <?php echo $_SESSION['logged_worker_name']." ".$_SESSION['logged_worker_surname']; ?> </a></li>
			</ul>
		</nav>
		
		<main>
			<div id="container">
				<section>
					<div class="form_row">
						<form method="post">
							 <label><select class="selector" name="old_ecp_worker">
								<?php
								for ($i=0;$i<count($workers_table); $i++){
									echo '<option value="'.$workers_table[$i][0].'">'.$workers_table[$i][1]." ".$workers_table[$i][2].'</option>';
								}
								?>
							</select></label>
							<label><input type="date" class="form_field" name="old_ecp_date_filter1"  value="<?php echo $_SESSION['old_ecp_date_filter3']?>"></label>
							<label><input type="date" class="form_field" name="old_ecp_date_filter2"  value="<?php echo $_SESSION['old_ecp_date_filter4']?>"></label>
							<input type="submit" class="form_button" value="ADD TO EPC" id="add_button">
						</form>
					</div>
				</section>
				<section>
					<?php
						$db_name=array('worker','start_time','end_time','sum_time','place','project','cell','description');
						$table_headers=array('worker','start_time','end_time','sum_time','place','project','cell','description');
						$row_number=$num_ecp_records;
						$table_title="ECP";

						$table_array=create_table($ecp_table, $table_title, $db_name, $table_headers, $row_number);
					
					?>
				</section>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 