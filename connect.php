	<?php
	$host="";
	$db_user="";
	$db_password="";
	$db_name="";
	
	try{
	$db= new PDO("mysql:host={$host};dbname={$db_name};charset=utf8",$db_user, $db_password, [
	PDO::ATTR_EMULATE_PREPARES=>false, 
	PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
	]);
	
	} catch (PDOException $PDO_error)

	{
		echo $PDO_error->getMessage();
		exit('Database error');
	}
	?>