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
				<li> <a href="workers.html" >Workers</a></li>
				<li> <a href="projects.html" >Projects</a></li>
				<li> <a href="areas.html" >Areas</a></li>
				<li> <a href="robots.html" >Robots</a></li>
				<li> <a href="ecp.html" >ECP</a></li>
			</ul>
		</nav>
		
		<main>
			<div id="container">
				<section>
					<table id="table">
						<tr bgcolor="#555555">
							<th colspan="8"> AREAS LIST</th>
						</tr>
						
						<tr bgcolor="#666666">
							<td width="80"> AREA ID </td>
							<td width="80"> Project ID </td>
							<td width="80"> Project name </td>
							<td width="80"> NAME </td>
							
						</tr>
						
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 1 </td>
							<td> 1 </td>
							<td> PO992 </td>
							<td> ARG1</td>

							
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 2 </td>
							<td> 2 </td>
							<td> PO992 </td>
							<td> ARG2</td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 3 </td>
							<td> 3 </td>
							<td> BR203 </td>
							<td> UB73_A </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 4 </td>
							<td> 3 </td>
							<td> BR203 </td>
							<td> UB73_B </td>
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 5 </td>
							<td> 3 </td>
							<td> BR203 </td>
							<td> UB73_C </td>
						</tr>
						
					</table>
				</section>
				
				<section>
					<div id="form">
					
						<form action="add_to_areas.php" method="post" enctype="text/plain">
							<div>
							<label> PROJECT ID <input type="text" class="form_field" style="width:30px;" name="area_project_id"> </label>				
							<label> PROJECT NAME <input type="text"  class="form_field_disabled" disabled > </label>
							<label> AREA NAME <input type="text"  class="form_field" name="area_name"> </label>
							</div>
							
							<input type="submit" value="ADD AREA " id="add_button">
					
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