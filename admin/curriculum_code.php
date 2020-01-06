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
		$course_id = '';
		$grade = $_POST['grade'];
		$track_code = $_POST['track_code'];
			$sem = $_POST['sem'];
		if($grade <= 10){
			$query1 = "SELECT * from course where year = '$grade'";
		} else {
			
			$query1 = "SELECT * from course where year = '$grade' and course_code = '$track_code' and semester = '$sem'";
		}
		
		$query_run1 = mysqli_query($connection,$query1);
		  while($row2 = mysqli_fetch_assoc($query_run1)){
		  	$course_id = $row2['id'];
		  }
		
		
		$subject_id = $_POST['edit_subject_id'];
		
		$query = "INSERT INTO curriculum (course_id,subject_id) VALUES ('$course_id','$subject_id')";
		
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: curriculum.php');
	
			$_SESSION['success'] = "Curriculum Added";
		} else{
			header('Location: curriculum.php');
			$_SESSION['status'] = "Curriculum Not Added";
		}
	
		
	}

	


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$course_id = '';
		$grade = $_POST['grade'];
		$track_code = $_POST['track_code'];
			$sem = $_POST['sem'];
		if($grade <= 10){
			$query1 = "SELECT * from course where year = '$grade'";
		} else {
			
			$query1 = "SELECT * from course where year = '$grade' and course_code = '$track_code' and semester = '$sem'";
		}
		
		$query_run1 = mysqli_query($connection,$query1);
		  while($row2 = mysqli_fetch_assoc($query_run1)){
		  	$course_id = $row2['id'];
		  }
		
		
		$subject_id = $_POST['edit_subject_id'];
		
		$query = "UPDATE curriculum set course_id = $course_id, subject_id = $subject_id where id = '$id'";
		
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: curriculum.php');
	
			$_SESSION['success'] = "Curriculum Updated";
		} else{
			header('Location: curriculum.php');
			$_SESSION['status'] = "Curriculum Not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM curriculum WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: curriculum.php');
	
			$_SESSION['success'] = "Curriculum Deleted";
		} else{
			header('Location: curriculum.php');
			$_SESSION['status'] = "Curriculum not Deleted";
		}
	} 

?>



