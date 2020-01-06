<?php
	session_start();
include_once 'includes/connection.php'; 
	
	//initialize variables
	$course_code = "";
	$course_description = "";
	$year = "";
	$semester = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$course_code = $_POST['course_code'];
		$course_description = $_POST['course_description'];
		$year = $_POST['year'];
		$grade_start = 11;
		$semester = $_POST['semester'];
		$query="";
		for($x=1;$x <= $year ; $x++){
			for($y=1;$y <= $semester ; $y++){
			$query = "INSERT INTO course (course_code,course_description,year,semester) VALUES ('$course_code','$course_description','$grade_start','$y');";
			$query_run = mysqli_query($connection,$query);
		
			}
			$grade_start++;
			
		}
		
			
			
		if($query_run){
			header('Location: course.php');
	
			$_SESSION['success'] = "Course Added";
		} else{
			header('Location: course.php');
			$_SESSION['status'] = mysqli_error($connection);
		}
	
		
	}

	

	
	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$course_code = $_POST['edit_course_code'];
	$course_description = $_POST['edit_course_description'];
	$year = $_POST['edit_year'];
	$semester = $_POST['edit_semester'];
 
 	$query = "UPDATE course SET course_code = '$course_code', course_description = '$course_description', year = '$year', semester = '$semester' where id = '$id'";

 
 	if($year <= 0 || $year > 4){
			header('Location: course.php');
 		$_SESSION['status'] = "Year must be 1 to 4 only";
 		
		} else if($semester <= 0 || $semester > 2){
			header('Location: course.php');
 		$_SESSION['status'] = "Semester must be 1 or 2 only";
 		
		} else {
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: course.php');
	
			$_SESSION['success'] = "Course Updated";
		} else{
			header('Location: course.php');
			$_SESSION['status'] = "Course not Updated";
		}
	}
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM course WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: course.php');
	
			$_SESSION['success'] = "Course Deleted";
		} else{
			header('Location: course.php');
			$_SESSION['status'] = "Course not Deleted";
		}
	} 

?>

