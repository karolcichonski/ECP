<?php
	
	session_start();
	
	include 'func.php';
	$logged_user=new Worker;
	
	if(!isset($_POST['login']) || !isset($_POST['password']))
	{
			header('Location: index.php');
			session_unset();
			exit();
	}
	
	$db_connecting=connect_to_db();
	
	if(isset($db_connecting))
	{
		$login=$_POST['login'];
		$password=$_POST['password'];
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");
		$sql="SELECT*FROM workers WHERE login='$login' and password='$password'";
		
		if($result=@$db_connecting->query(sprintf("SELECT*FROM workers WHERE login='%s'",
		mysqli_real_escape_string($db_connecting, $login))))
		{
			$users_num=$result->num_rows;
			if($users_num>0)
			{
				$db_record=$result->fetch_assoc();
				if(password_verify($password,$db_record['password'])==True and $db_record['permissions']>0)
				{
					$_SESSION['is_logged'] = true;
					
					$_SESSION['logged_worker_id']=$db_record['ID'];
					$_SESSION['logged_worker_name']=$db_record['name'];
					$_SESSION['logged_worker_surname']=$db_record['surname'];
					$_SESSION['logged_worker_permissions']=$db_record['permissions'];
					
					unset($_SESSION['login_error']);
					
					$result->free_result();
					/* echo $logged_user->name; */
					header('Location: workers.php');
				}
				else
				{
					$_SESSION['login_error'] = '<span style="color:red">WRONG LOGIN OR PASSWORD!</span>';
					header('Location: index.php');
					
				}
				
			}
			else
			{
				$_SESSION['login_error'] = '<span style="color:red">WRONG LOGIN OR PASSWORD!</span>';
				header('Location: index.php');
				
			}
		}
		$db_connecting->close();
	}
?>