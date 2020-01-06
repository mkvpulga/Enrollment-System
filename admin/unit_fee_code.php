<?php
	session_start();
	
include_once 'includes/connection.php'; 
	//initialize variables
	$course_id = "";
	$subject_id = "";
	
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['savebtn'])){
		$course_id = $_POST['edit_course_id'];
		$amount_per_unit = $_POST['edit_amount_per_unit'];
		
		$query = "INSERT INTO unit_fee (course_id,amount_per_unit) VALUES ('$course_id','$amount_per_unit')";
		
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: unit_fee.php');
	
			$_SESSION['success'] = "Unit fee Added";
		} else{
			header('Location: unit_fee.php');
			$_SESSION['status'] = "Unit fee not Added";
		}
	
		
	}

	


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$course_id = $_POST['edit_course_id'];
		$amount_per_unit = $_POST['edit_amount_per_unit'];
	
	
 	$query = "UPDATE unit_fee SET course_id = '$course_id', amount_per_unit = '$amount_per_unit' where id = '$id'";

 	
			$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: unit_fee.php');
	
			$_SESSION['success'] = "Unit fee Updated";
		} else{
			header('Location: unit_fee.php');
			$_SESSION['status'] = "Unit fee not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM unit_fee WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: unit_fee.php');
	
			$_SESSION['success'] = "Unit fee Deleted";
		} else{
			header('Location: unit_fee.php');
			$_SESSION['status'] = "Unit fee not Deleted";
		}
	} 

?>



