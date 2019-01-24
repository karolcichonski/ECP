 <?php
 	session_start();
	include 'func.php';
	is_loged_check();
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
					<table id="table">
						<tr bgcolor="#555555">
							<th colspan="10"> ROBOTS LIST</th>
						</tr>
						
						<tr bgcolor="#666666">
							<td width="80"> ID </td>
							<td width="80"> Name </td>
							<td width="80"> Robot Brand </td>
							<td width="80"> Project ID </td>
							<td width="80"> Project NAME </td>
							<td width="80"> AREA ID </td>
							<td width="80"> AREA NAME </td>
							<td width="80"> TASKS </td>
							<td width="80"> 7th AXIS </td>
							<td width="80"> TYPE </td>
							
						</tr>
						
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 1 </td>
							<td> 116415R01 </td>
							<td> ABB </td>
							<td> 1 </td>
							<td> PO992</td>
							<td> 1 </td>
							<td> ARG1 </td>
							<td> Handlings, ext Gluing, Clinchen</td>
							<td> YES </td>
							<td> ROB1_7600_2.80_340</td>
							
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 2 </td>
							<td> 116465R01 </td>
							<td> ABB </td>
							<td> 1</td>
							<td> PO992 </td>
							<td> 1</td>
							<td> ARG2 </td>
							<td> Handlings, ext. Clinchen, KG_LESEN </td>
							<td> YES </td>
							<td> ROB1_7600_2.80_340</td>
							

						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 3 </td>
							<td> 116465R01 </td>
							<td> KUKA </td>
							<td> 1</td>
							<td> PO992 </td>
							<td> 1</td>
							<td> ARG2 </td>
							<td> Handlings, ext. Clinchen, KG_LESEN </td>
							<td> YES </td>
							<td> ROB1_7600_2.80_340</td>
						</tr>
					</table>
				</section>
				
				<section>
					<div id="form">
					
						<form method="post">
							<div>
								<label> ROBOT NAME <input type="text" class="form_field" style="width:120px;" name="robot_name" </label>				
								<label> PROJECT ID <input type="text"  class="form_field" style="width:30px;" name="robot_project_id"> </label>
								<label> PROJECT NAME <input type="text"  class="form_field_disabled" style="width:120px;" disabled> </label>
							</div>
							<div>
								<label> AREA ID <input type="text"  class="form_field" style="width:30px;" name="robot_area_id" > </label>
								<label> AREA NAME <input type="text"  class="form_field_disabled" style="width:120px;" disabled> </label>
								<label> TASKS <input type="text" class="form_field" style="width:400px;" name="robot_tasks" > </label>
							</div>
							<div>
								<label> 7yh Axis
									<select id="ax_select" name="robot_7th_axis"  >
										<option value="YES" > YES </option>
										<option value="NO" selected> NO </option>
									</select>
								</label>
								<label> ROBOT TYPE<input type="text" class="form_field" style="width:120px;" name="robot_type" > </label>
							</div>
							
							<input type="submit" value="ADD ROBOT" id="add_button"> 
					
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