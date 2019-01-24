 <?php
 	session_start();
	include 'func.php';
	is_loged_check();
	
	if(isset($_POST['ecp_selected_project'])){
		$_SESSION['ecp_selected_project']=$_POST['ecp_selected_project'];
	}
	
	if(isset($_POST['ecp_date'])){
		$_SESSION['ecp_date']=$_POST['ecp_date'];
	}
	
	if(isset($_POST['ecp_selected_area'])){
		$_SESSION['ecp_selected_area']=$_POST['ecp_selected_area'];
	}
	
	if (isset($_SESSION['ecp_selected_project'])){
		$Areas_id_name_atable=Areas_Id_aTable($_SESSION['ecp_selected_project']);
		$Areas_id_name_table=Areas_Id_Table($_SESSION['ecp_selected_project']);	
	}
	
	$Project_id_name_atable=Projects_Id_aTable();
	$project_id_name_table=Projects_Id_Table();
	
	
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
					<table id="table"  border="1" cellspacing="0" align="center">
						<tr bgcolor="#555555">
							<th colspan="12"> ECP KAROL CICHOŃSKI</th>
						</tr>
						
						<tr bgcolor="#666666">
							<td width="80"> ID </td>
							<td width="80"> Date </td>
							<td width="80"> Project </td>
							<td width="80"> Area </td>
							<td width="80"> Robot </td>
							<td width="400"> Description </td>
							<td width="50"> Additional Hours </td>
							<td width="200"> A. H. Description </td>
							<td width="50"> Start Time </td>
							<td width="50"> End Time </td>
							<td width="100"> Place </td>
						</tr>
						
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 1 </td>
							<td> 01.11.2018 </td>
							<td> PO99245 </td>
							<td> ARG1 </td>
							<td> 116415R01 </td>
							<td> Optymalizacja tasku KLB </td>
							<td> 0 </td>
							<td>  </td>
							<td> 6:00 </td>
							<td> 14:00 </td>
							<td> Gliwice </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 2 </td>
							<td> 02.11.2018 </td>
							<td> PO992 </td>
							<td> ARG1 </td>
							<td> 116415R01 </td>
							<td> Optymalizacja tasku KLB </td>
							<td> 0 </td>
							<td>  </td>
							<td> 6:00 </td>
							<td> 14:00 </td>
							<td> Gliwice </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 3 </td>
							<td> 03.11.2018 </td>
							<td> PO992 </td>
							<td> ARG1 </td>
							<td> 116415R01 </td>
							<td> Optymalizacja tasku KLB </td>
							<td> 0 </td>
							<td>  </td>
							<td> 6:00 </td>
							<td> 14:00 </td>
							<td> Gliwice </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 4 </td>
							<td> 04.11.2018 </td>
							<td> PO992 </td>
							<td> ARG1 </td>
							<td> 116415R01 </td>
							<td> Optymalizacja tasku KLB </td>
							<td> 0 </td>
							<td>  </td>
							<td> 6:00 </td>
							<td> 14:00 </td>
							<td> Gliwice </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 5 </td>
							<td> 05.11.2018 </td>
							<td> PO992 </td>
							<td> ARG1 </td>
							<td> 116415R01 </td>
							<td> Optymalizacja tasku KLB </td>
							<td> 0 </td>
							<td>  </td>
							<td> 6:00 </td>
							<td> 14:00 </td>
							<td> Gliwice </td>
						</tr>

					</table>
				</section>
				
				<form method="post">
					<div id="form">
					
						<div class="form_row">
						<form>
						<label> DATE <input type="date" class="form_field" name="ecp_date" value="<?php echo date('Y-m-d')?>"</label>	
						<label> START TIME <input type="time"  class="form_field" id="f_starttime" value="06:00"> </label>
						<label> END TIME <input type="time" class="form_field" id="f_endtime" value="14:00"> </label>
						<label> PLACE <input type="text" class="form_field" id="f_place" value="Gliwice"> </label>
						</div>
						
						<fieldset>
						<div class="form_row">
						
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
						<label> ROBOT <input type="text" class="form_field" id="f_robot" pattern="Additional houers"> </label>
						<label> TIME <input type="number" class="form_field" id="f_time"> </label>
						<label> AH <input type="checkbox" class="form_field" id="f_additionalhours" > </label>	
						</div>
						<div class="form_row">
						<label> Type of work <select name="ecp_type_of_work" class="selector">
							<option value=1>Simulation checking</option>
							<option value=2>Preparing robot for OLP</option>
							<option value=3>Main tasks path</option>
							<option value=4>Service tasks path</option>
							<option value=5>Clash</option>
							<option value=6>Signals/actions</option>
							<option value=7>Standard in tasks</option>
							<option value=8>Downloads</option>
							<option value=9>Prepare cells to send</option>
							<option value=10>Dokumentation</option>
							<option value=11>MRS/SOP</option>
							<option value=12>Simulation changing</option>
							<option value=13>URLOP</option>
							<option value=13>Wolne</option>
							<option value=14>L4</option>
							<option value=15>Święto</option>
							<option value=16>Upload on plant</option>
							<option value=17>Others</option>
						</select></label>
						<label> DESC. <input type="text" class="form_field" id="f_description" style="width:600px;"> </label>
						</div>
						</fieldset>
						<input type="submit" class="form_button" value="ADD TO EPC" id="add_button">

					</div>
				</form>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 