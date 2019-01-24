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
				
				<form action="add_to_ecp.php" method="post" enctype="text/plain">
					<div id="form">
					
						<div>
						<label> DATE <input type="date" class="form_field" id="f_date"> </label>				
						<label> START TIME <input type="time"  class="form_field" id="f_starttime" value="06:00"> </label>
						<label> END TIME <input type="time" class="form_field" id="f_endtime" value="14:00"> </label>
						<label> PLACE <input type="text" class="form_field" id="f_place" value="Gliwice"> </label>
						</div>
						
						<div>
						<label> PROJECT <input type="text" class="form_field" id="f_project"> </label>				
						<label> AREA <input type="text"  class="form_field" id="f_area"> </label>
						<label> ROBOT <input type="text" class="form_field" id="f_robot"> </label>
						<label> TIME <input type="number" class="form_field" id="f_time"> </label>
						<label> DESCRIPTION <input type="text" class="form_field" id="f_description"> </label>
						</div>
						
						<div>
						<label> PROJECT <input type="text" class="form_field" id="f_project"> </label>				
						<label> AREA <input type="text"  class="form_field" id="f_area"> </label>
						<label> ROBOT <input type="text" class="form_field" id="f_robot"> </label>
						<label> TIME <input type="number" class="form_field" id="f_time"> </label>
						<label> DESCRIPTION <input type="text" class="form_field" id="f_description"> </label>
						</div>
						
						<div>
						<label> ADDITIONAL HOURS <input type="number" class="form_field" id="f_additionalhours"> </label>				
						<label> ADDITIONAL HOURS DESCRIPTION <input type="text"  class="form_field" id="f_ahdescription"> </label>
						</div>
						
						<input type="submit" value="ADD TO EPC" id="add_button">


					</div>
				</form>
			</div>
		</main>
		<footer>
			2018 ALPHAROB SP Z O. O. WSZELKIE PRAWA ZASTRZEŻONE
		</footer>

</body>

</html> 