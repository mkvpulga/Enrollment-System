<?php
session_start();
include_once 'includes/connection.php'; 


if (isset($_POST['admincreatebtn'])) {
		
	$user_master_id = $_SESSION['user_id'];
     
 $contact_number = $_POST['contact_number'];
    $last_name = $_POST['last_name'];
     $middle_name = $_POST['middle_name'] ;
    $first_name = $_POST['first_name'] ;
     $suffix = $_POST['suffix'];
    $birth_date = '0000-00-00';
    $address = $_POST['address'];
    $fathers_name = $_POST['fathers_name'];
    $fathers_contact = $_POST['fathers_contact'] ;
    $fathers_address = $_POST['fathers_address'];
    $mothers_name = $_POST['mothers_name'];
    $mothers_contact = $_POST['mothers_contact'];
    $mothers_address = $_POST['mothers_address'];
    $guardians_name = $_POST['guardians_name'] ;
     $guardians_contact = $_POST['guardians_contact'];
    $guardians_address = $_POST['guardians_address'];
    $primary_school = $_POST['primary_school'];
    $primary_year_start = $_POST['primary_year_start'];
  
    $primary_year_end = $_POST['primary_year_end'] ;
 
    $primary_address = $_POST['primary_address'];
    $secondary_school = $_POST['secondary_school'] ;
    $secondary_year_start = $_POST['secondary_year_start'];
   
    $secondary_year_end = $_POST['secondary_year_end'];
   
    $secondary_address = $_POST['secondary_address'];
   
  
   $query = "INSERT INTO employee (contact_number, user_master_id, last_name, middle_name, first_name, suffix, birth_date, address, fathers_name, fathers_contact, fathers_address, mothers_name, mothers_contact, mothers_address, guardians_name, guardians_contact, guardians_address, primary_school, primary_year_start, primary_year_end, primary_address, secondary_school, secondary_year_start, secondary_year_end, secondary_address) VALUES ('$contact_number','$user_master_id', '$last_name', '$middle_name', '$first_name', '$suffix', '$birth_date', '$address', '$fathers_name', '$fathers_contact', '$fathers_address', '$mothers_name', '$mothers_contact', '$mothers_address', '$guardians_name', '$guardians_contact', '$guardians_address', '$primary_school', '$primary_year_start', '$primary_year_end', '$primary_address', '$secondary_school', '$secondary_year_start', '$secondary_year_end', '$secondary_address');";



      $query_run = mysqli_query($connection,$query);

 	if($query_run){
			echo "<script type='text/javascript'>
     
      
window.location='school_profile_create.php';
alert('Admin Information Updated');
</script>";
		} else{
			$_SESSION['status'] = mysqli_error($connection);
			echo "<script type='text/javascript'>
     
      
window.location='admin_create.php';
</script>";
		}
	
	    
	}



if (isset($_POST['createbtn'])) {
		
		$is_junior = $_POST['is_junior'];
		$is_senior = $_POST['is_senior'];
		if($is_junior==''){
			$is_junior = 0;
		}
		if($is_senior ==''){
			$is_senior = 0;
		}
 	$query = "INSERT INTO configuration (is_junior, is_senior) VALUES ('$is_junior','$is_senior')";

				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			echo "<script type='text/javascript'>
     
      
window.location='admin_create.php';
alert('Type of School Updated');
</script>";
		} else{
			echo "<script type='text/javascript'>
     
      
window.location='configuration_create.php';
alert('Something went wrong');
</script>";
		}
	
	    
	}


	if (isset($_POST['updatebtn'])){
		$is_junior = $_POST['is_junior'];
		$is_senior = $_POST['is_senior'];
		if($is_junior==''){
			$is_junior = 0;
		}
		if($is_senior ==''){
			$is_senior = 0;
		}

 	$query = "UPDATE configuration SET is_junior = '$is_junior', is_senior = '$is_senior'";

				$query_run = mysqli_query($connection,$query);
 	if($query_run){
 		// header('Location: configuration.php');
 		// $_SESSION['status'] = $is_junior;
			echo "<script type='text/javascript'>
     
      
window.location='home.php';
alert('Type of School Updated');
</script>";
		} else{
			
// 			$_SESSION['status'] = mysqli_error($connection);
// 			echo "<script type='text/javascript'>
     
      
// window.location='configuration.php';
// </script>";
			echo "<script type='text/javascript'>
     
      
window.location='configuration.php';
alert('Something went wrong');
</script>";
		}
	
	}

if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 
 	$query = "DELETE FROM announcement WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: announcement.php');
	
			$_SESSION['success'] = "Announcement Deleted";
		} else{
			header('Location: announcement.php');
			$_SESSION['status'] = "Announcement not Deleted";
		}
	} 


?>