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

class Worker
{
	private $id;
	private $name;
	private $surname;
	private $email;
	private $login;
	private $password;
	private $phone;
	private $computer_num;
	private $birthday;
	public $correct_data_flag;
	public $errors_descriptions;
	
	public function set_name($name)
	{
		$this->name=$name;
	}	
	
	public function set_surname($surname)
	{
		$this->surname=$surname;
	}
	
	public function set_email($email)
	{
		$correct_email_flag=TRUE;
		$email_checked=filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($email_checked, FILTER_VALIDATE_EMAIL)==FALSE) || ($email_checked!=$email))
			{
				$correct_email_flag=FALSE;
				$this->correct_data_flag=FALSE;
				$this->errors_descriptions=$this->errors_descriptions." It is not correct email ! ,";
			}
		
		$is_mail_exist=how_many_in_db("workers", "email",$email);
		
		if ($is_mail_exist>0)
			{
				$correct_email_flag=FALSE;
				$this->correct_data_flag=FALSE;
				$this->errors_descriptions=$this->errors_descriptions." E-mail is busy ! ,";
			}
		
		if ($correct_email_flag==TRUE)
			{
				$this->email=$email;
			}
	}
	
	public function set_login($login)
	{
		$correct_login_flag=TRUE;
		$login_checked=filter_var($login, FILTER_SANITIZE_EMAIL);
		if($login_checked!=$login)
		{
			$correct_login_flag=FALSE;
			$this->correct_data_flag=FALSE;
			$this->errors_descriptions=$this->errors_descriptions." It is not correct login ! ,";
		}
		
		$is_login_exist=how_many_in_db("workers", "login",$login);
		if ($is_login_exist>0)
		{
			$correct_login_flag=FALSE;
			$this->correct_data_flag=FALSE;
			$this->errors_descriptions=$this->errors_descriptions." Login is busy ! ,";
		}
		
		If((strlen($login)<3)||(strlen($login)>20))
		{
			$correct_login_flag=FALSE;
			$this->correct_data_flag=FALSE;
			$this->errors_descriptions=$this->errors_descriptions." Login lenght is not correct ! , ";
		}
		
		if ($correct_login_flag==TRUE)
			{
				$this->login=$login;
			}
	
	}
	
	public function set_password($password, $password1)
	{
		$correct_password_flag=TRUE;
		if ($password!=$password1)
		{
			$correct_password_flag=FALSE;
			$this->correct_data_flag=FALSE;
			$this->errors_descriptions=$this->errors_descriptions." Passwords are not the same ! ,";
		}
		
		If((strlen($password)<8)||(strlen($password)>20))
		{
			$correct_password_flag=FALSE;
			$this->correct_data_flag=FALSE;
			$this->errors_descriptions=$this->errors_descriptions." Passwords lenght is not correct ! ";
		}
		
		if ($correct_password_flag==TRUE)
		{
			$this->password=password_hash($password , PASSWORD_DEFAULT);
		}
		
	}
	
	public function set_phone($phone)
		{
			$this->phone=$phone;
		}
	
	public function set_computer_num($computer_num)
		{
			$this->computer_num=$computer_num;
		}
		
	public function set_birthday($birthday)
		{
			$this->birthday=$birthday;
		}
	
	public function insert_worker_to_db()
	{
		$db_connecting=connect_to_db();	
		$sql="INSERT INTO workers VALUES (NULL, '$this->name', '$this->surname', '$this->email', '$this->login',
		'$this->password', '$this->phone', '$this->computer_num', '$this->birthday')";
		$db_connecting->query($sql);
		$db_connecting->close();
		header ("Refresh:0");
	}
	
}
?>