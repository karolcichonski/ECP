<?php
	session_start();
	include 'func.php';
	is_loged_check();

	$db_connecting=connect_to_db();	
	$sql="SELECT*FROM workers";
		
	if($result=@$db_connecting->query($sql))
	{
		$num_workers=$result->num_rows;
	} 
	$db_connecting->close();
	
	
	if(isset($_POST['new_worker_name']))
	{
		$new_worker= new Worker;
		$new_worker->correct_data_flag=true;
		$new_worker->errors_drscriptions="";
		$new_worker->set_name($_POST['new_worker_name']);
		$new_worker->set_surname($_POST['new_worker_surname']);
		$new_worker->set_email($_POST['new_worker_email']);
		$new_worker->set_login($_POST['new_worker_login']);
		$new_worker->set_password($_POST['new_worker_password'],$_POST['new_worker_password_1']);		
		$new_worker->set_phone($_POST['new_worker_phone']);
		$new_worker->set_computer_num($_POST['new_worker_computer']);
		$new_worker->set_birthday($_POST['new_worker_birthday']);
		
		if ($new_worker->correct_data_flag==true)
		{
			$new_worker->insert_worker_to_db();
		}
	}
	
	
?>

 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ALPHAROB PROJECT PLATFORM</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link href="https://fonts.googleapis.com/css?family=Francois+One&amp;subset=latin-ext" rel="stylesheet"> 
<script src="scripts.js"></script>

</head>

<body onload="add_worker_selected()">
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
							<th colspan="8"> WORKERS LIST</th>
						</tr>
						
						<tr bgcolor="#666666">
							<td width="80"> ID </td>
							<td width="80"> Name </td>
							<td width="80"> Surname </td>
							<td width="80"> Email </td>
							<td width="80"> Login </td>
							<td width="80"> Phone </td>
							<td width="80"> Computer number</td>
							<td width="80"> Birthday</td>
							
						</tr>
						
						<?php
							for ($i = 1; $i <= $num_workers; $i++) 
							{
		
								$row = mysqli_fetch_assoc($result);
								$a1 = $row['ID'];
								$Worer_ID_table[$i]=$a1;
								$a2 = $row['name'];
								$a3 = $row['surname'];
								$a4 = $row['email'];
								$a5 = $row['login'];
								$Worer_login_table[$i]=$a5;
								$a6 = $row['phone'];
								$a7 = $row['computer_num'];
								$a8 = $row['birthday'];		
		
echo<<<END
<tr class="table_row" bgcolor="#999999">
<td class="table_column">$a1</td>
<td class="table_column">$a2</td>
<td class="table_column">$a3</td>
<td class="table_column">$a4</td>
<td class="table_column">$a5</td>
<td class="table_column">$a6</td>
<td class="table_column">$a7</td>
<td class="table_column">$a8</td>
</tr>

END;
			
	}
						?>
					</table>
				</section>
				
				<section>
					<div id="form">
						<form method="post" id="modul_select_form">
							<div class="mode_select"><label><input type="radio" onclick="add_worker_selected()" id="worker_add" name="form_action" checked> Add new worker </label></div>
							<div class="mode_select"><label><input  type="radio" onclick="update_worker_selected()" id="worker_update" name="form_action"> Updadte worker</label></div>
							<div class="mode_select"><label><input  type="radio" onclick="delete_worker_selected()" id="worker_delete" name="form_action"> Delete worker</label></div>
							<div  class="mode_select" id="worker_select" onchange="update_worker_form()" >
								<select name="chose_worker">
								<?php
								for ($i = 1; $i <= $num_workers; $i++) 
									{
									echo '<option value="'.$Worer_ID_table[$i].'">'.$Worer_login_table[$i].'</option>';
									}
								?>
								</select>
								
								<input type="submit" value="Refresh" id="refresh_button" class="mode_select">
								
							</div>
						
						</form>
							<form method="post" id="Add_form">
								<div>
								<label> LOGIN <input type="text" class="form_field" name="new_worker_login"> </label>
								<label> PASSWORD<input type="password" class="form_field" name="new_worker_password"> </label>
								<label> REPEAT PASSWORD<input type="password" class="form_field" name="new_worker_password_1"> </label>
								</div>
										<?php 
										if(isset($new_worker)){
										if($new_worker->correct_data_flag==FALSE)
										{
											echo '<div class="form_error_com">'.$new_worker->errors_descriptions.'</div>';
										}
										}
									?>
								<div>
								<label> NAME <input type="text" class="form_field" name="new_worker_name" id="WorkerNameField"> </label>				
								<label> SURNAME <input type="text"  class="form_field" name="new_worker_surname"> </label>
								<label> E-MAIL <input type="email" class="form_field" name="new_worker_email"> </label>
								</div>
								<div>
								<label> PHONE<input type="tel" class="form_field" name="new_worker_phone"> </label>
								<label> COMPUTER NUMBER<input type="text" class="form_field" name="new_worker_computer"> </label>
								<label> birthday<input type="date" class="form_field" name="new_worker_birthday"> </label>
								</div>
								
								<input type="submit" value="ADD WORKER" id="add_button" class="form_button">
						
							</form>
							
							<form method="post" id="Update_form">
								<div>
								<label> LOGIN
								<select name="chose_login" id="form_field">
								<?php
								for ($i = 1; $i <= $num_workers; $i++) 
									{
									echo '<option value="'.$Worer_ID_table[$i].'">'.$Worer_login_table[$i].'</option>';
									}
								?>
								</select> </label>
								<label> PASSWORD<input type="password" class="form_field" name="update_worker_password"> </label>
								<label> REPEAT PASSWORD<input type="password" class="form_field" name="update_worker_password_1"> </label>
								</div>
										<?php 
										if(isset($_SESSION['wrong_login']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_login'].'</div>';
											unset($_SESSION['wrong_login']);
										}
										if(isset($_SESSION['wrong_email']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_email'].'</div>';
											unset($_SESSION['wrong_email']);
										}
										if(isset($_SESSION['wrong_password']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_password'].'</div>';
											unset($_SESSION['wrong_password']);
										}
									?>
								<div>
								<label> NAME <input type="text" class="form_field" name="update_worker_name" id="WorkerNameField"> </label>				
								<label> SURNAME <input type="text"  class="form_field" name="update_worker_surname"> </label>
								<label> E-MAIL <input type="email" class="form_field" name="update_worker_email"> </label>
								</div>
								<div>
								<label> PHONE<input type="tel" class="form_field" name="update_worker_phone"> </label>
								<label> COMPUTER NUMBER<input type="text" class="form_field" name="update_worker_computer"> </label>
								<label> birthday<input type="date" class="form_field" name="update_worker_birthday"> </label>
								</div>
								
								<input type="submit" value="UPDATE WORKER" id="delete_button" class="form_button">
						
							</form>
							
							<form method="post" id="Delete_form">
								<div>
								<label> LOGIN
								<select name="chose_login" id="form_field">
								<?php
								for ($i = 1; $i <= $num_workers; $i++) 
									{
									echo '<option value="'.$Worer_ID_table[$i].'">'.$Worer_login_table[$i].'</option>';
									}
								?>
								</select> </label>
								</div>
										<?php 
										if(isset($_SESSION['wrong_login']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_login'].'</div>';
											unset($_SESSION['wrong_login']);
										}
										if(isset($_SESSION['wrong_email']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_email'].'</div>';
											unset($_SESSION['wrong_email']);
										}
										if(isset($_SESSION['wrong_password']))
										{
											echo '<div class="form_error_com">'.$_SESSION['wrong_password'].'</div>';
											unset($_SESSION['wrong_password']);
										}
									?>
								<div>
								<input type="submit" value="DELETE WORKER" id="delete_button" class="form_button">
						
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