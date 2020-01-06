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
		$logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
$student_type = $_POST['student_type'];

		// $stype = $_SESSION["stype"];

 
 	$query1 = "SELECT * from requirement  where type = '$student_type'";
 	 
			$_SESSION['success'] = mysqli_error($connection);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$rid = $row['id'];
// $rid = $_POST['$rrid'] ;
 $query2 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$student_id'";
  
  $query_run2 = mysqli_query($connection,$query2);
  if(mysqli_num_rows($query_run2) > 0){
  	if(empty($_POST[$rid])) {
	$query = " DELETE FROM student_requirement WHERE requirement_id = $rid and student_id = $student_id;"; 
 $query_run = mysqli_query($connection,$query);
			
			}
  } else {
  	if(!empty($_POST[$rid])) {
	$query = " INSERT INTO student_requirement (student_id,requirement_id, requirement_attachment) VALUES ($student_id,$rid, '$imgContent');"; 
 $query_run = mysqli_query($connection,$query);
			
			}
  }
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	// if($query_run){
			header('Location: student_requirement.php');
	
			$_SESSION['success'] = "Student Requirement Updated";
		// } else{
		// 	header('Location: student_requirement.php');
		// 	$_SESSION['status'] = mysqli_error($connection) ;
		// }
	}
}

if (isset($_POST['viewattachbtn'])){
		// $sid = $_SESSION["sid"];

$_SESSION['student_id']= $_POST['student_id'];

		
$_SESSION['attach_id']= $_POST['attach_id'];
 
 	
			// $_SESSION['status'] = $rid ;
 	
 		 echo "<script type='text/javascript'>
      
window.location='requirement_attachment_view.php';
</script>";
			// header('Location: evaluation.php');
	
			
		
	}

	if (isset($_POST['studreqcreatebtn'])){
		// $sid = $_SESSION["sid"];
$student_id = $_POST['student_id'];

		$student_type = $_POST['student_type'];
		$student_course_code = $_POST['student_course_code'];
		// $stype = $_SESSION["stype"];
$logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
 
 	$query1 = "SELECT * from requirement where type = '$student_type'";
 	 $query_run1 = mysqli_query($connection,$query1);
 	 
    while($row = mysqli_fetch_assoc($query_run1)){
    	$rid = $row['id'];
    	 $query2 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$student_id'";
  
  $query_run2 = mysqli_query($connection,$query2);
  if(mysqli_num_rows($query_run2) > 0){
  	if(empty($_POST[$rid])) {
	$query = " DELETE FROM student_requirement WHERE requirement_id = $rid and student_id = $student_id;"; 
 $query_run = mysqli_query($connection,$query);
			
			}
  } else {
  	if(!empty($_POST[$rid])) {
	$query = " INSERT INTO student_requirement (student_id,requirement_id, requirement_attachment) VALUES ($student_id,$rid, '$imgContent');"; 
 $query_run = mysqli_query($connection,$query);
			
			}
  }

    }
	
  $_SESSION["stud_req_id"] = $student_id ;
   $_SESSION["stud_req_type"] = $student_type ;
    $_SESSION["student_course_code"] = $student_course_code ;
  
    if($student_type=='New Student'){
  echo "<script type='text/javascript'>
      
window.location='assignment_section_create.php';
alert('Student Requirement Updated');
</script>";
    } else {
	 echo "<script type='text/javascript'>
      
window.location='evaluation.php';
alert('Student Requirement Updated');
</script>";
    }
	
	}
	

?>

