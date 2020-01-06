<?php
	session_start();
	
include_once 'includes/connection.php'; 
	//initialize variables
	$stud_id = 0;
	$stud_type = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	
	
	if (isset($_POST['updatebtn'])){
		// $sid = $_SESSION["sid"];
$student_id = $_POST['student_id'];
		
$section_id = $_POST['section_id'];

		// $stype = $_SESSION["stype"];

 
$query = " DELETE FROM assignment_section where student_id = '$student_id';"; 	

 $query_run = mysqli_query($connection,$query);
$query = " INSERT INTO assignment_section (student_id,section_id) VALUES ($student_id,$section_id);"; 	
				 
				
    
	
 $query_run = mysqli_query($connection,$query);
   
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: assignment_section.php');
	
			$_SESSION['success'] = "Student Section Updated";
		} else{
			header('Location: assignment_section.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}
	
if (isset($_POST['assignsectioncreatebtn'])){
		// $sid = $_SESSION["sid"];
$student_id = $_POST['student_id'];
		
$section_id = $_POST['section_id'];

		// $stype = $_SESSION["stype"];

 $query = " UPDATE student SET  student_status = 'Enrolled' where id = '$student_id'";
		// $query=""; 
		 $query_run = mysqli_query($connection,$query);
		 
$query = " DELETE FROM assignment_section where student_id = '$student_id';"; 	

 $query_run = mysqli_query($connection,$query);
$query = " INSERT INTO assignment_section (student_id,section_id) VALUES ($student_id,$section_id);"; 	
				 
				
    
	
 $query_run = mysqli_query($connection,$query);
   
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
 		 echo "<script type='text/javascript'>
      
window.location='home.php';
alert('Student Section Updated');
</script>";
			// header('Location: assignment_section.php');
	
			// $_SESSION['success'] = "Student Section Updated";
		} else{
			header('Location: assignment_section.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}
?>

