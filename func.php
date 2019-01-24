<?php


	
function is_loged_check()
{
	if(!isset($_SESSION['is_logged']))
	{
		header('Location:index.php');
		session_unset();
		exit();
	}
}
	
	
function connect_to_db()
{
	$host="localhost";
	$db_user="root";
	$db_password="";
	$db_name="ECP";
	/* Throw mysqli_sql_exception for errors instead of warnings */
	//errors are generated in exceptions instead of warnings.
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$connecting=new mysqli ($host, $db_user, $db_password, $db_name);
		if($connecting->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			mysqli_query($connecting, "SET CHARSET utf8");
			mysqli_query($connecting, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			return $connecting;
		}
		
	}
	catch(Exception $connection_error)
	{
		echo '<span style="color:red;">Connection to database failed!</span>';
		/* echo $connection_error; */
	}
}

function how_many_in_db($table_name, $atribut_name, $variable_name)
{
		$db_connecting=connect_to_db();
		
		$sql="SELECT * FROM ".$table_name." WHERE ".$atribut_name."="."'$variable_name'";
		$result=$db_connecting->query($sql);
		$how_many=$result->num_rows;
		return $how_many;
		$db_connecting->close();
}


function email_check($email)
{
	$is_correct_email_flag=TRUE;
	//sanitize mail from illegal sign
	$email_checked=filter_var($email, FILTER_SANITIZE_EMAIL);
	if((filter_var($email_checked, FILTER_VALIDATE_EMAIL)==FALSE) || ($email_checked!=$email))
	{
		$is_correct_email_flag=FALSE;
		$_SESSION['wrong_email']="It is not correct email";
	}
	
	$is_mail_exist=how_many_in_db("workers", "email",$email);
	if ($is_mail_exist>0)
	{
		$is_correct_email_flag=FALSE;
		$_SESSION['wrong_email']="E-mail is busy !";
	}
	return $is_correct_email_flag;
	
	
	
}

function password_check($password, $password1)
{
	$is_correct_password_flag=TRUE;
	
	if ($password!=$password1)
	{
		$is_correct_password_flag=FALSE;
		$_SESSION['wrong_password']="Passwords are not the same !";
	}
	else
	{
		If((strlen($password)<8)||(strlen($password)>20))
		{
			$is_correct_password_flag=FALSE;
			$_SESSION['wrong_password']="Passwords lenght is not correct !";
		}
	}

	return $is_correct_password_flag;
	
}

class Worker
{
	private $id;
	public $name;
	public $surname;
	public $email;
	public $login;
	public $password;
	public $phone;
	public $computer_number;
	public $birthday;
	
}
?>