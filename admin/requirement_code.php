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
	

if (isset($_POST['backviewbtn'])){
		// $sid = $_SESSION["sid"];

$_SESSION['stud_req_id']= $_POST['student_id'];

		
$_SESSION['stud_req_type']= $_POST['student_type'];
 
 	
			// $_SESSION['status'] = $rid ;
 	
 		 echo "<script type='text/javascript'>
      
window.location='student_requirement_create.php';
</script>";
			// header('Location: evaluation.php');
	
			
		
	}



	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$requirement_name = $_POST['requirement_name'];
		$type = $_POST['type'];
		
		$query = "INSERT INTO requirement (requirement_name,type) VALUES ('$requirement_name','$type')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: requirement.php');
	
		 	$_SESSION['success'] = "Requirement Added";
		} else{
			header('Location: requirement.php');
			$_SESSION['status'] = "Requirement not Added";
		}
	
		
	}
if(isset($_POST['updateattacmentbtn'])){
	$student_id = $_POST['student_id'];
		$requirement_id = $_POST['attach_id'];
		// $stype = $_SESSION["stype"];
		// $tangoina = $_POST['userfile'];
$logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
 
 	
	$query = " DELETE FROM student_requirement WHERE requirement_id = $requirement_id and student_id = $student_id;"; 
 $query_run = mysqli_query($connection,$query);
			
			
$query = " INSERT INTO student_requirement (student_id, requirement_id, requirement_attachment) VALUES ('$student_id', '$requirement_id', '$imgContent');"; 	
				 $query_run = mysqli_query($connection,$query);
				
		
		if($query_run){
			header('Location: requirement_attachment.php');
	
		 	$_SESSION['success'] = "Attached Requirement Completed";
		} else{
			header('Location: requirement_attachment.php');
			$_SESSION['status'] = "Attached Requirement Not Completed";
		}
	
		
	}
	
if(isset($_POST['register_require_attach'])){
	$student_id = $_SESSION['student_id'];
		$student_type = $_SESSION['student_type'];
		 $query = "SELECT * FROM requirement where type = '$student_type'";
  $saved_requirement = 0;
  $tot_requirement = 0;
  $query_run = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($query_run)){
        	$saved_requirement += 1;
           $requirement_id = $row['id'];
           $query1 = "SELECT * FROM student_requirement where requirement_id = '$requirement_id' and student_id='$student_id' and requirement_attachment <> ''";
  
  $query_run1 = mysqli_query($connection,$query1);
  while($row1 = mysqli_fetch_assoc($query_run1)){
     $tot_requirement += 1;
   }
}

   if($saved_requirement == $tot_requirement){
	 echo "<script type='text/javascript'>
   
      
window.location='index.php';
alert('Registration Completed');
</script>";
	
		} else {
			 echo "<script type='text/javascript'>
   
      
window.location='requirement_attachment.php';
alert('Attachment is required');
</script>";
		}
	}
	
	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$requirement_name = $_POST['edit_requirement_name'];
		$type = $_POST['edit_type'];
 
 	$query = "UPDATE requirement SET requirement_name = '$requirement_name', type = '$type' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: requirement.php');
	
			$_SESSION['success'] = "Requirement Updated";
		} else{
			header('Location: requirement.php');
			$_SESSION['status'] = "Requirement not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM requirement WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: requirement.php');
	
			$_SESSION['success'] = "Requirement Deleted";
		} else{
			header('Location: requirement.php');
			$_SESSION['status'] = "Requirement not Deleted";
		}
	} 

?>

