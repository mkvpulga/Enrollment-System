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
	
	
	if (isset($_POST['updatebtn'])){
		$misc_course_id = $_POST["misc_course_id"];
		
 
 	$query1 = "SELECT * from miscellaneous";
 	 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$misc_id = $row['id'];
// $rid = $_POST['$rrid'] ;
if(empty($_POST[$misc_id])) {
	$query = "DELETE FROM course_misc WHERE miscellaneous_id = '$misc_id'; "; 
  $query_run = mysqli_query($connection,$query);
			
			} else {
$query = "INSERT INTO course_misc (course_id,miscellaneous_id) VALUES ('$misc_course_id','$misc_id'); "; 	
				  $query_run = mysqli_query($connection,$query);
				
			}
    }

  
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: course_misc.php');
	
			$_SESSION['success'] = "Course Miscellaneous Updated";
		} else{
			header('Location: course_misc.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}
	

?>

