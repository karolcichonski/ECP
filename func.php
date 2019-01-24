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

function delete_worker_via_ID($id)
{
	$db_connecting=connect_to_db();
	$sql_check_per="SELECT permissions FROM workers WHERE ID=$id";
	$actual_permissions=$db_connecting->query($sql_check_per);
	$db_record=$actual_permissions->fetch_assoc();
	
	if ($db_record['permissions']!=3)
	{
		$sql="DELETE FROM `workers` WHERE ID=$id";
		$db_connecting->query($sql);
		header ("Refresh:0");
	}
	Else
	{
		$_SESSION['DelError']="You can't delete this user!";
	}
	
	$db_connecting->close();
}

function update_worker()
{
	$update_worker= new Worker;
	$update_worker->correct_data_flag=true;
	$update_worker->errors_drscriptions="";
	
	if(strlen($_POST['update_worker_name'])>0)
	{
		$update_worker->set_name($_POST['update_worker_name']);
	}
	
	if(strlen($_POST['update_worker_surname'])>0)
	{
		$update_worker->set_surname($_POST['update_worker_surname']);
	}
	
	if(strlen($_POST['update_worker_email'])>0)
	{
		$update_worker->set_email($_POST['update_worker_email']);
	}
	
	if(strlen($_POST['update_worker_phone'])>0)
	{
		$update_worker->set_phone($_POST['update_worker_phone']);
	}
	
	if(strlen($_POST['update_worker_computer'])>0)
	{
		$update_worker->set_computer_num($_POST['update_worker_computer']);
	}
	
	if(strlen($_POST['update_worker_birthday'])>0)
	{
		$update_worker->set_birthday($_POST['update_worker_birthday']); 
	}
	
	$update_worker->set_permissions($_POST['update_worker_permissions']); 

	
	if ($update_worker->correct_data_flag==true)
	{
		$update_worker->update_worker_in_db($_POST['worker_id_to_update']);
	}
	
}

function add_worker()
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
		$new_worker->set_permissions($_POST['new_worker_permissions']);
		
		if ($new_worker->correct_data_flag==true)
		{
			$new_worker->insert_worker_to_db();
		}
		if ($new_worker->correct_data_flag==false)
		{
			$_SESSION['AddError']=$new_worker->errors_descriptions;
		}
	}
	
function change_password($id, $old_password, $new_password1, $new_password2) 
{
	$worker= new Worker;
	$worker->correct_data_flag=true;
	$worker->errors_drscriptions="";
	$db_connecting=connect_to_db();	
	$sql_check_per="SELECT * FROM workers WHERE ID=$id";
	$actual_permissions=$db_connecting->query($sql_check_per);
	$db_record=$actual_permissions->fetch_assoc();
	
	if ($db_record['permissions']==3 and $_SESSION['logged_worker_permissions']!=3)
		{
			$worker->correct_data_flag=false;
			$worker->errors_descriptions="You have no permissions to change password for this user";
		}
	elseif ($db_record['permissions']<3 and $_SESSION['logged_worker_permissions']<2)
		{
			$worker->correct_data_flag=false;
			$worker->errors_descriptions="You have no permissions to change password for this user";
		}
	else
		{
			if (password_verify($old_password,$db_record['password'])==True)
			{
				$worker->set_password($new_password1,$new_password2);
				if($worker->correct_data_flag==TRUE)
				{	
					$password=$worker->get_password();
					$sql="UPDATE workers SET password='$password' WHERE ID=$id";
					$db_connecting->query($sql);
				}
			}
			else
			{
				$worker->correct_data_flag=false;
				$worker->errors_descriptions="Old password is incorrect";
			}
		}
	
	if ($worker->correct_data_flag==false)
	{
		$_SESSION['PassError']=$worker->errors_descriptions;
	}
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
	private $permissions;
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
		
	public function set_permissions($permissions)
		{
			$this->permissions=$permissions;
		}
	
	
	public function insert_worker_to_db()
	{
		$db_connecting=connect_to_db();	
		$sql="INSERT INTO workers VALUES (NULL, '$this->name', '$this->surname', '$this->email', '$this->login',
		'$this->password', '$this->phone', '$this->computer_num', '$this->birthday', '$this->permissions')";
		$db_connecting->query($sql);
		$db_connecting->close();
		header ("Refresh:0");
	}
	
	public function get_password()
	{
		return $this->password;
	}
	
	public function update_worker_in_db($id)
	{
/* 		$sql="UPDATE `workers` SET ";
		if (strlen($this->name)>0)
		{
				$sql=$sql."name='$this->name'";
		}
		$sql=$sql." WHERE ID=$id"; */
		
		$sql="UPDATE workers SET ID=$id ";
		$db_connecting=connect_to_db();	
		
		if (isset($this->name))
		{
		$sql=$sql." ,name='$this->name'";
		}
		
		if (isset($this->surname))
		{
		$sql=$sql." ,surname='$this->surname'";
		}
		
		if (isset($this->email))
		{
		$sql=$sql." ,email='$this->email'";
		}
		
		if (isset($this->phone))
		{
		$sql=$sql." ,phone='$this->phone'";
		}
		
		if (isset($this->computer_num))
		{
		$sql=$sql." ,computer_num='$this->computer_num'";
		}
		
		if (isset($this->birthday))
		{
		$sql=$sql." ,birthday='$this->birthday'";
		}
		
		if (isset($this->permissions))
		{
			$sql_check_per="SELECT permissions FROM workers WHERE ID=$id";
			$actual_permissions=$db_connecting->query($sql_check_per);
			$db_record=$actual_permissions->fetch_assoc();
			if ($db_record['permissions']!=3 and $_SESSION['logged_worker_permissions']>1)
			{
				$sql=$sql." ,permissions='$this->permissions'";
			}
			elseif($db_record['permissions']==3 and $_SESSION['logged_worker_permissions']==3)
			{
				$sql=$sql." ,permissions='$this->permissions'";
			}
			else
			{
				$_SESSION['UpdateError']="You can't change permissions fo this user!";
			}

		}

		$sql=$sql." WHERE ID=$id";
		$db_connecting->query($sql);
		$db_connecting->close();
		header ("Refresh:0");
	}
	

}
?>