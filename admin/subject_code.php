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
		$subject_code = $_POST['subject_code'];
		$subject_description = $_POST['subject_description'];
		$unit = $_POST['unit'];
		$status = $_POST['status'];

		$query = "INSERT INTO subject (subject_code,subject_description,unit,status) VALUES ('$subject_code','$subject_description','$unit','$status')";
		
			
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: subject.php');
	
			$_SESSION['success'] = "Subject Added";
		} else{
			header('Location: subject.php');
			$_SESSION['status'] = "Subject not Added";
		
	}
		
	}


	


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$subject_code = $_POST['edit_subject_code'];
	$subject_description = $_POST['edit_subject_description'];
	$unit = $_POST['edit_unit'];
	$status = $_POST['edit_status'];
	
 	$query = "UPDATE subject SET subject_code = '$subject_code', subject_description = '$subject_description', unit = '$unit', status = '$status' where id = '$id'";

 	
 	
			$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: subject.php');
	
			$_SESSION['success'] = "Subject Updated";
		} else{
			header('Location: subject.php');
			$_SESSION['status'] = "Subject not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM subject WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: subject.php');
	
			$_SESSION['success'] = "Subject Deleted";
		} else{
			header('Location: subject.php');
			$_SESSION['status'] = "Subject not Deleted";
		}
	} 


//if save button is clicked
	if(isset($_POST['saveprereq'])){
		$subject_id = $_POST['subject_id'];
		$subject_required_id = $_POST['subject_required_id'];
		
		$query = "INSERT INTO pre_requisites (subject,subject_required) VALUES ('$subject_id','$subject_required_id')";
		$query_run = mysqli_query($connection,$query);

		if($query_run){
			header('Location: subject.php');
	
			$_SESSION['preReqsuccess'] = "Pre requisite Added";
		} else{
			if (!$subject_id){
			header('Location: subject.php');
			$_SESSION['preReqstatus'] = "Subject not found";
			} else if (!$subject_required_id){
			header('Location: subject.php');
			$_SESSION['preReqstatus'] = "Subject Required not found";
			} else {
				header('Location: subject.php');
			$_SESSION['preReqstatus'] = "Pre requisite not added";
			}


		}
		
	}

	if (isset($_POST['prerequpdatebtn'])){
		$id = $_POST['edit_id'];
		$subject = $_POST['subject_id'];
		$edit_subject = $_POST['edit_prereq_subject_id'];		
		$subject_required = $_POST['subject_required_id'];
	$edit_subject_required = $_POST['edit_prereq_subject_required_id'];
	
 	$query = "UPDATE pre_requisites SET subject = '$edit_subject', subject_required = '$edit_subject_required' where id = '$id'";

 	$subject_check = "SELECT * FROM pre_requisites where subject = '$edit_subject'";
	$subject_check_run = mysqli_query($connection,$subject_check);
	$subject_required_check = "SELECT * FROM pre_requisites where subject_required = '$edit_subject_required'";
	$subject_required_check_run = mysqli_query($connection,$subject_required_check);
	
 		/*if($subject != $edit_subject){
 			
 		if(mysqli_num_rows($subject_check_run) > 0){
 		header('Location: subject.php');
 		$_SESSION['preReqstatus'] = "The Subject you want to update already has a prerequisite";
 		} else {
 			$prereq_query_run = mysqli_query($connection,$query);	
 			if($prereq_query_run){
				header('Location: subject.php');
				$_SESSION['preReqsuccess'] = "Pre Requisite Updated";
			} else{
				header('Location: subject.php');
				$_SESSION['preReqstatus'] = "Pre Requisite not Updated";
			}
 		}
 	} else if($subject_required != $edit_subject_required){
 	if(mysqli_num_rows($subject_required_check_run) > 0){
 		
 			
 		header('Location: subject.php');
 		$_SESSION['preReqstatus'] = "The Subject Required you want to update is already a prerequisite to another subject";
 		} else {
 			$prereq_query_run = mysqli_query($connection,$query);	
 			if($prereq_query_run){
				header('Location: subject.php');
				$_SESSION['preReqsuccess'] = "Pre Requisite Updated";
			} else{
				header('Location: subject.php');
				$_SESSION['preReqstatus'] = "Pre Requisite not Updated";
			}
 		}
 	} else {*/
 			$prereq_query_run = mysqli_query($connection,$query);	
 			if($prereq_query_run){
				header('Location: subject.php');
				$_SESSION['preReqsuccess'] = "Pre Requisite Updated";
			} else{
				header('Location: subject.php');
				$_SESSION['preReqstatus'] = "Pre Requisite not Updated";
			}
 		// }
 	
 	
 	
 	
	} 

	if (isset($_POST['delete_prereq_btn'])){
		$id = $_POST['delete_prereq_id'];
		
 
 	$query = "DELETE FROM pre_requisites WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: subject.php');
	
			$_SESSION['preReqsuccess'] = "Prerequisite Deleted";
		} else{
			header('Location: subject.php');
			$_SESSION['preReqstatus'] = "Prerequisite not Deleted";
		}
	} 

?>



