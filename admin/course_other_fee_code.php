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
		$other_fee_course_id = $_POST["other_fee_course_id"];
		
 
 	$query1 = "SELECT * from other_fees";
 	 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$other_fee_id = $row['id'];
// $rid = $_POST['$rrid'] ;
if(empty($_POST[$other_fee_id])) {
	$query = "DELETE FROM course_other WHERE other_fee_id = '$other_fee_id'; "; 
  $query_run = mysqli_query($connection,$query);
			
			} else {
$query = "INSERT INTO course_other (course_id,other_fee_id) VALUES ('$other_fee_course_id','$other_fee_id'); "; 	
				  $query_run = mysqli_query($connection,$query);
				
			}
    }

  
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: course_other_fee.php');
	
			$_SESSION['success'] = "Course Other fee Updated";
		} else{
			header('Location: course_other_fee.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}
	

?>

