<?php
	session_start();
	
include_once 'includes/connection.php'; 
	//initialize variables
	$room_no = "";
	$capacity = "";
	
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$room_no = $_POST['room_no'];
		$capacity = $_POST['capacity'];
		
		$query = "INSERT INTO room (room_no,capacity) VALUES ('$room_no','$capacity')";
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: room.php');
	
			$_SESSION['success'] = "Room Added";
		} else{
			header('Location: room.php');
			$_SESSION['status'] = "Room not Added";
		}
	
		
	}

	


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$room_no = $_POST['edit_room_no'];
	$capacity = $_POST['edit_capacity'];
	
 	$query = "UPDATE room SET room_no = '$room_no', capacity = '$capacity'where id = '$id'";

 	
 
			$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: room.php');
	
			$_SESSION['success'] = "Room Updated";
		} else{
			header('Location: room.php');
			$_SESSION['status'] = "Room not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM room WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: room.php');
	
			$_SESSION['success'] = "Room Deleted";
		} else{
			header('Location: room.php');
			$_SESSION['status'] = "Room not Deleted";
		}
	} 


//if save button is clicked
	if(isset($_POST['saveSection'])){
		$section_code = $_POST['section_code'];
		$section_description = $_POST['section_description'];
		$capacity = $_POST['capacity'];

		$query = "INSERT INTO section (section_code,section_description,capacity) VALUES ('$section_code','$section_description','$capacity')";
		$query_run = mysqli_query($connection,$query);

		if($query_run){
			header('Location: room.php');
	
			$_SESSION['sectionSuccess'] = "Section Added";
		} else{
			
				header('Location: room.php');
			$_SESSION['sectionStatus'] = "Section not added";
			


		}
		
	}

	if (isset($_POST['sectionUpdateBtn'])){
		$id = $_POST['edit_id'];
		$edit_section_code = $_POST['edit_section_code'];
		$edit_section_description = $_POST['edit_section_description'];		
		$edit_capacity = $_POST['edit_capacity'];
	
 	$query = "UPDATE section SET section_code = '$edit_section_code', section_description = '$edit_section_description', capacity = '$edit_capacity' where id = '$id'";

 			$section_query_run = mysqli_query($connection,$query);	
 			if($section_query_run){
				header('Location: room.php');
				$_SESSION['sectionSuccess'] = "Section Updated";
			} else{
				header('Location: room.php');
				$_SESSION['sectionStatus'] = "Section not Updated";
			}
 	
 	
 	
 	
	} 

	if (isset($_POST['delete_section_btn'])){
		$id = $_POST['delete_section_id'];
		
 
 	$query = "DELETE FROM section WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: room.php');
	
			$_SESSION['sectionSuccess'] = "Section Deleted";
		} else{
			header('Location: room.php');
			$_SESSION['sectionStatus'] = "Section not Deleted";
		}
	} 

?>



