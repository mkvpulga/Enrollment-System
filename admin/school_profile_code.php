<?php
session_start();

include_once 'includes/connection.php'; 



if (isset($_POST['registerbtn'])) {
		
		$school_name = $_POST['school_name'];
		$school_address = $_POST['school_address'];
		$school_mission = $_POST['school_mission'];
		$school_vision = $_POST['school_vision'];

	    $logo = $_FILES['userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
	    
	    $query = "INSERT INTO school_profile (school_name, school_address, school_mission, school_vision, logo) VALUES ('$school_name','$school_address','$school_mission','$school_vision','$imgContent')";

	   $query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: school_profile.php');
	
			$_SESSION['success'] = "School Profile Added";
		} else{
			header('Location: school_profile.php');
			$_SESSION['status'] = "School Profile not Added";
		}

	}


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$school_name = $_POST['edit_school_name'];
		$school_address = $_POST['edit_school_address'];
		$school_mission = $_POST['edit_school_mission'];
		$school_vision = $_POST['edit_school_vision'];


	    $logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
	    
 if(file_exists($_FILES['edit_userfile']['tmp_name']) || is_uploaded_file($_FILES['edit_userfile']['tmp_name'])){
 	$query = "UPDATE school_profile SET school_name = '$school_name', school_address = '$school_address', school_mission = '$school_mission', school_vision = '$school_vision', logo = '$imgContent' where id = '$id'";

} else{
	$query = "UPDATE school_profile SET school_name = '$school_name', school_address = '$school_address', school_mission = '$school_mission', school_vision = '$school_vision' where id = '$id'";

}
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: school_profile.php');
	
			$_SESSION['success'] = "School Profile Updated";
		} else{
			header('Location: school_profile.php');
			$_SESSION['status'] = "School Profile not Updated";
		}
	
	}

if (isset($_POST['createbtn'])){
		$id = $_POST['edit_id'];
		$school_name = $_POST['edit_school_name'];
		$school_address = $_POST['edit_school_address'];
		$school_mission = $_POST['edit_school_mission'];
		$school_vision = $_POST['edit_school_vision'];


	    $logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
	    
  $query = "INSERT INTO school_profile (school_name, school_address, school_mission, school_vision, logo) VALUES ('$school_name','$school_address','$school_mission','$school_vision','$imgContent')";

				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			echo "<script type='text/javascript'>
     
      
window.location='announcement.php';
alert('School Profile Updated');
</script>";
		} else{
			echo "<script type='text/javascript'>
     
      
window.location='school_profile_create.php';
alert('Something went wrong');
</script>";
		}
		}
	
	

if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM school_profile WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: school_profile.php');
	
			$_SESSION['success'] = "School Profile Deleted";
		} else{
			header('Location: school_profile.php');
			$_SESSION['status'] = "School Profile not Deleted";
		}
	} 


?>