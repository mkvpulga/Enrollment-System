<?php
	session_start();
include_once 'includes/connection.php'; 
	
	//initialize variables
	$birth_date = "";
	$designation = "";
	$first_name = "";
	$middle_name = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
	$username = $_POST['username'] ;
	$designation = $_POST['designation'] ;

		$query = "INSERT INTO user_master (designation,username,password) VALUES ('$designation','$username',md5('admin'))";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: account.php');
	
		 	$_SESSION['success'] = "Account Added";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = mysqli_error($connection);
		}
	
		
	}

	

	
	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$designation = $_POST['edit_designation'];
	
 	$query = "UPDATE user_master SET  designation = '$designation' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: account.php');
	
			$_SESSION['success'] = "Account Updated";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = "Account not Updated";
		}
	
	} 


if (isset($_POST['resetpassbtn'])){
	
		$id = $_POST['reset_id'];
		
 	$query = "UPDATE user_master SET  password = md5('admin') where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: account.php');
	
			$_SESSION['success'] = "Reset Password Completed";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = "Reset Password not Completed";
		}
	
	} 

if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		$designation = $_POST['designation'];
 
 		$query = "DELETE FROM user_master WHERE id = '$id';";

 	$query_run = mysqli_query($connection,$query);
 	if($designation == 'Student'){
 	$query = "DELETE FROM student WHERE user_master_id = '$id';";
 	$query_run = mysqli_query($connection,$query);
 } else {
	$query = "DELETE FROM employee WHERE user_master_id = '$id';";
	$query_run = mysqli_query($connection,$query);
 }
 	
 
 	if($query_run){
			header('Location: account.php');
	
			$_SESSION['success'] = "Account Deleted";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = mysqli_error($connection);
		}
	} 

?>

