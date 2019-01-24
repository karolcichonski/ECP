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
							<th colspan="8"> PROJECT LIST</th>
						</tr>
						
						<tr bgcolor="#666666">
							<td width="80"> ID </td>
							<td width="80"> Project name </td>
							<td width="80"> Brand </td>
							<td width="80"> Software </td>
							<td width="80"> RCS </td>
							<td width="80"> Robots Type </td>
							<td width="80"> Takt Time </td>
							<td width="80"> Customer </td>
							
						</tr>
						
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 1 </td>
							<td> PO992 </td>
							<td> VW</td>
							<td> Process Simulate</td>
							<td> XXX </td>
							<td> ABB</td>
							<td> 90s </td>
							<td> ASE</td>
							
						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 2 </td>
							<td> W206 </td>
							<td> Daimler</td>
							<td> Delmia </td>
							<td> KRC4</td>
							<td> KUKA </td>
							<td> 120s </td>
							<td> EngRoTec </td>
							

						</tr>
						
						<tr class="table_row" bgcolor="#999999" >
							<td> 3 </td>
							<td> V177_MFA2 </td>
							<td> daimler </td>
							<td> Delmia </td>
							<td> KRC4 </td>
							<td> KUKA</td>
							<td> 150s </td>
							<td> TKSY </td>
						</tr>
					</table>
				</section>
				
				<section>
					<div id="form">
					
						<form action="add_to_projects.php" method="post" enctype="text/plain">
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