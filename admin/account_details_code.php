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
		$birth_date = $_POST['birth_date'];
		$designation = $_POST['designation'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$username = $_POST['username'] ;

		$query = "INSERT INTO user_master (birth_date,designation,first_name,middle_name,last_name,username,password) VALUES ('$birth_date','$designation','$first_name','$middle_name','$last_name','$username',md5('admin'))";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: account.php');
	
		 	$_SESSION['success'] = "Account Added";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = "Account not Added";
		}
	
		
	}

	

	
	if (isset($_POST['updatebtn'])){
		$id = $_SESSION['user_id'];
		$username = $_POST['username'];
		$current_password = $_POST['current_password'];
		$password_stored = $_SESSION['password'];
		$new_password = $_POST['new_password'];
		
 	$query = "UPDATE user_master SET username = '$username', password = md5('$new_password') where id = '$id'";

 
 	if($current_password==$password_stored){
				$query_run = mysqli_query($connection,$query);

} else {
	echo "<script type='text/javascript'>
	window.location='account_details.php';
alert('Current password is not correct');
</script>";
	// header('Location: account_details.php');
		
		} 


 	if($query_run){
 		echo "<script type='text/javascript'>
 		window.location='home.php';
alert('Password successfully changed');
</script>";
			// header('Location: home.php');
		
		} 
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM user_master WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: account.php');
	
			$_SESSION['success'] = "Account Deleted";
		} else{
			header('Location: account.php');
			$_SESSION['status'] = "Account not Deleted";
		}
	} 

?>

