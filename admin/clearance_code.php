<?php
	session_start();
include_once 'includes/connection.php'; 
	
	//initialize variables
	$birth_date = "";
	$designation = "";
	$first_name = "";
	$middle_name = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$clearance_name = $_POST['clearance_name'];
		
		$query = "INSERT INTO clearance (clearance_name) VALUES ('$clearance_name')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: clearance.php');
	
		 	$_SESSION['success'] = "Clearance Added";
		} else{
			header('Location: clearance.php');
			$_SESSION['status'] = "Clearance not Added";
		}
	
		
	}

	if (isset($_POST['studclearcreatebtn'])){
		// $sid = $_SESSION["sid"];
$student_id = $_POST['student_id'];
		$student_type = $_POST['student_type'];
	$course_id = $_POST['course_id'];
		// $stype = $_SESSION["stype"];

 
 	$query1 = "SELECT * from clearance ";
 	 $query_run1 = mysqli_query($connection,$query1);
 	 
    while($row = mysqli_fetch_assoc($query_run1)){
    	$cid = $row['id'];
// $rid = $_POST['$rrid'] ;

if(empty($_POST[$cid])) {
	$query = " DELETE FROM student_clearance WHERE clearance_id = $cid and student_id = $student_id;"; 
 $query_run = mysqli_query($connection,$query);
			
			} else {
$query = " INSERT INTO student_clearance (student_id,clearance_id) VALUES ($student_id,$cid);"; 	
				 $query_run = mysqli_query($connection,$query);
				
			}
    }
   $_SESSION["stud_req_id"] = $student_id;
   $_SESSION["stud_req_type"] = $student_type;
    $_SESSION["student_course_code"] = $course_id;
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
 		 echo "<script type='text/javascript'>
      
window.location='conflicts.php';
alert('Student Clearance Updated');
</script>";
			// header('Location: evaluation.php');
	
			
		} else{
			 echo "<script type='text/javascript'>
      
window.location='clearance_create.php';
alert('Student Clearance Not Updated');
</script>";
			// header('Location: clearance_create.php');
			// $_SESSION['status'] = $stud_id ;
		}
	}


	if (isset($_POST['studclearcreatebtnold'])){
		// $sid = $_SESSION["sid"];
$student_id = $_POST['student_id'];
		$student_type = $_POST['student_type'];
	$course_id = $_POST['course_id'];
		// $stype = $_SESSION["stype"];

 
 	$query1 = "SELECT * from clearance ";
 	 $query_run1 = mysqli_query($connection,$query1);
 	 
    while($row = mysqli_fetch_assoc($query_run1)){
    	$cid = $row['id'];
// $rid = $_POST['$rrid'] ;

if(empty($_POST[$cid])) {
	$query = " DELETE FROM student_clearance WHERE clearance_id = $cid and student_id = $student_id;"; 
 $query_run = mysqli_query($connection,$query);
			
			} else {
$query = " INSERT INTO student_clearance (student_id,clearance_id) VALUES ($student_id,$cid);"; 	
				 $query_run = mysqli_query($connection,$query);
				
			}
    }
   $_SESSION["stud_req_id"] = $student_id;
   $_SESSION["stud_req_type"] = $student_type;
    $_SESSION["student_course_code"] = $course_id;
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
 		 echo "<script type='text/javascript'>
      
window.location='evaluation.php';
alert('Student Clearance Updated');
</script>";
			// header('Location: evaluation.php');
	
			
		} else{
			 echo "<script type='text/javascript'>
      
window.location='clearance_create.php';
alert('Student Clearance Not Updated');
</script>";
			// header('Location: clearance_create.php');
			// $_SESSION['status'] = $stud_id ;
		}
	}

	
	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$clearance_name = $_POST['edit_clearance_name'];
		
 	$query = "UPDATE clearance SET clearance_name = '$clearance_name' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: clearance.php');
	
			$_SESSION['success'] = "Clearance Updated";
		} else{
			header('Location: clearance.php');
			$_SESSION['status'] = "Clearance not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM clearance WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: clearance.php');
	
			$_SESSION['success'] = "Clearance Deleted";
		} else{
			header('Location: clearance.php');
			$_SESSION['status'] = "Clearance not Deleted";
		}
	} 

?>

