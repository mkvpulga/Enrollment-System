<?php
	session_start();
	
include_once 'includes/connection.php'; 
	//initialize variables
	$subject_code = "";
	$subject_description = "";
	$unit = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$school_year = $_POST['school_year_start'] . " - " . $_POST['school_year_end'];
		$status = $_POST['status'];

		$query = "INSERT INTO school_year (school_year,status) VALUES ('$school_year','$status')";
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: school_year.php');
	
			$_SESSION['success'] = "School Year Added";
		} else{
			header('Location: school_year.php');
			$_SESSION['status'] = "School Year not Added";
		}
	
		
	}

	if(isset($_POST['currentschoolyearbtn'])){
		$school_year = $_POST['school_year_start'] . " - " . $_POST['school_year_end'];

		$query = "UPDATE school_year SET status = 'CLOSE' where school_year <> '$school_year'";
		$query_run = mysqli_query($connection,$query);

		$query = "UPDATE student SET type = 'Old Student'";
		$query_run = mysqli_query($connection,$query);

		$query1 = "SELECT * FROM current_school_year";
		
		$query_run1 = mysqli_query($connection,$query1);
		if(mysqli_num_rows($query_run1) > 0){
			$query = "UPDATE current_school_year SET school_year = '$school_year'";
		} else {
		$query = "INSERT INTO current_school_year (school_year) VALUES ('$school_year')";
		}
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: school_year.php');
	
			$_SESSION['success'] = "Current School Year Updated";
		}else{
			header('Location: school_year.php');
			$_SESSION['status'] = "Current School Year Not Updated";
		}
	
		
	}

if(isset($_POST['openallbtn'])){
		$school_year = $_POST['current_school_year'];

		$query = "DELETE FROM school_year where school_year = '$school_year'";
		$query_run = mysqli_query($connection,$query);

		$query1 = "SELECT * FROM curriculum";
		
		$query_run1 = mysqli_query($connection,$query1);
		 while($row = mysqli_fetch_assoc($query_run1)){
		 	$curriculum_id = $row['id'];
			
		$query = "INSERT INTO school_year (school_year,status,curriculum_id) VALUES ('$school_year','OPEN','$curriculum_id')";
		
		$query_run = mysqli_query($connection,$query);
	}
		if($query_run){
			header('Location: school_year.php');
	
			$_SESSION['success'] = "All Opened";
		}else{
			header('Location: school_year.php');
			$_SESSION['status'] = "All not Opened";
		}
	
		
	}


	if (isset($_POST['updatebtn'])){
		$curriculum_id = $_POST['edit_id'];
		$school_year = $_POST['edit_school_year_start'] . " - " . $_POST['edit_school_year_end'];
		$status = $_POST['edit_status'];
			$query1 = "SELECT * FROM school_year where curriculum_id = '$curriculum_id'";

			$query_run1 = mysqli_query($connection,$query1);
if(mysqli_num_rows($query_run1) > 0){
	
	$query = "UPDATE school_year SET school_year = '$school_year', status = '$status' where curriculum_id = '$curriculum_id'";
} else {
	$query = "INSERT INTO school_year (school_year,status,curriculum_id) VALUES ('$school_year','$status','$curriculum_id')";
}
 

			$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: school_year.php');
	
			$_SESSION['success'] = "School Year Updated";
		} else{
			header('Location: school_year.php');
			$_SESSION['status'] = "School Year not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM school_year WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: school_year.php');
	
			$_SESSION['success'] = "School Year Deleted";
		} else{
			header('Location: school_year.php');
			$_SESSION['status'] = "School Year not Deleted";
		}
	} 


?>



