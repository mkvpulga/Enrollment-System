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
	
 if(isset($_POST['indexbtn'])){
      $user_master_id = 0;
     $username = strtolower(str_replace(" ","",$_POST['first_name'])) . strtolower(str_replace(" ","",$_POST['last_name']));
     $designation = "Student";
$query_account = "INSERT INTO user_master (username,designation,password) VALUES ('$username','$designation',md5('admin')); ";
      $query_account_run = mysqli_query($connection,$query_account);
     
    //   if($query_account_run){
    //     header('Location: index.php');
    // // mysqli_error($connection)
    //         $_SESSION['status'] = mysqli_error($connection);
    //         $_SESSION['success'] = "putanginamo";
    //   } else {
    //      header('Location: index.php');
    //      $_SESSION['status'] = mysqli_error($connection);
    //        $_SESSION['success'] = $user_master_id . "putanginamogago";
    //   }
      $query_select_account = "SELECT * from user_master where username = '$username' and password = md5('admin')";
    $query_select_account_run = mysqli_query($connection,$query_select_account);

while($row = mysqli_fetch_assoc($query_select_account_run)){
  $user_master_id = $row['id'];
}
$course_id =0;
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
//  $program = $_POST['program'];
//  if($program == 'Junior High'){
//   $grade = $_POST['grade'];
//  $query_select_grade = "SELECT * from course where year = '$grade' ";
//     $query_select_grade_run = mysqli_query($connection,$query_select_grade);

// while($row_grade = mysqli_fetch_assoc($query_select_grade_run)){
//   $course_id = $row_grade['id'];
// }
// } else {
//   $course_id = $_POST['course_id'];
 
// }
 
 
      $type = $_POST['type'];

    $contact_number = $_POST['contact_number'];
    $last_name = $_POST['last_name'];
     $middle_name = $_POST['middle_name'] ;
    $first_name = $_POST['first_name'] ;
     $suffix = $_POST['suffix'];
    $birth_date = $_POST['birth_date'];
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
    // $tertiary_school = $_POST['tertiary_school'];
    // $tertiary_year_start = $_POST['tertiary_year_start'];
     
    // $tertiary_year_end = $_POST['tertiary_year_end'] ;
   
    // $tertiary_address = $_POST['tertiary_address'] ;
     $student_status = "Registered";
    
    


    $query = "INSERT INTO student (contact_number, student_status, user_master_id, course_id, type, last_name, middle_name, first_name, suffix, birth_date, address, fathers_name, fathers_contact, fathers_address, mothers_name, mothers_contact, mothers_address, guardians_name, guardians_contact, guardians_address, primary_school, primary_year_start, primary_year_end, primary_address, secondary_school, secondary_year_start, secondary_year_end, secondary_address) VALUES ('$contact_number','$student_status', '$user_master_id','$course_id','$type', '$last_name', '$middle_name', '$first_name', '$suffix', '$birth_date', '$address', '$fathers_name', '$fathers_contact', '$fathers_address', '$mothers_name', '$mothers_contact', '$mothers_address', '$guardians_name', '$guardians_contact', '$guardians_address', '$primary_school', '$primary_year_start', '$primary_year_end', '$primary_address', '$secondary_school', '$secondary_year_start', '$secondary_year_end', '$secondary_address');";



      $query_run = mysqli_query($connection,$query);

       $_SESSION["student_id"] =   $connection->insert_id;
      $_SESSION["student_type"] = $type;
    if($query_run){
    
         echo "<script type='text/javascript'>
      
window.location='requirement_attachment.php';
</script>";
    
    } else{
        header('Location: index.php');
    // mysqli_error($connection)
            $_SESSION['status'] = mysqli_error($connection);
      $_SESSION['success'] = mysqli_error($connection);
    }
}


  if(isset($_POST['registerstudent'])){
      $user_master_id = 0;
     $username = strtolower(str_replace(" ","",$_POST['first_name'])) . strtolower(str_replace(" ","",$_POST['last_name']));
     $designation = "Student";
$query_account = "INSERT INTO user_master (username,designation,password) VALUES ('$username','$designation',md5('admin')); ";
      $query_account_run = mysqli_query($connection,$query_account);
     
    //   if($query_account_run){
    //     header('Location: index.php');
    // // mysqli_error($connection)
    //         $_SESSION['status'] = mysqli_error($connection);
    //         $_SESSION['success'] = "putanginamo";
    //   } else {
    //      header('Location: index.php');
    //      $_SESSION['status'] = mysqli_error($connection);
    //        $_SESSION['success'] = $user_master_id . "putanginamogago";
    //   }
      $query_select_account = "SELECT * from user_master where username = '$username' and password = md5('admin')";
    $query_select_account_run = mysqli_query($connection,$query_select_account);

while($row = mysqli_fetch_assoc($query_select_account_run)){
  $user_master_id = $row['id'];
}
$course_id =0;
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
//  $program = $_POST['program'];
//  if($program == 'Junior High'){
//   $grade = $_POST['grade'];
//  $query_select_grade = "SELECT * from course where year = '$grade' ";
//     $query_select_grade_run = mysqli_query($connection,$query_select_grade);

// while($row_grade = mysqli_fetch_assoc($query_select_grade_run)){
//   $course_id = $row_grade['id'];
// }
// } else {
//   $course_id = $_POST['course_id'];
 
// }
 
 
      $type = $_POST['type'];
 $contact_number = $_POST['contact_number'];
    $last_name = $_POST['last_name'];
     $middle_name = $_POST['middle_name'] ;
    $first_name = $_POST['first_name'] ;
     $suffix = $_POST['suffix'];
    $birth_date = $_POST['birth_date'];
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
    // $tertiary_school = $_POST['tertiary_school'];
    // $tertiary_year_start = $_POST['tertiary_year_start'];
     
    // $tertiary_year_end = $_POST['tertiary_year_end'] ;
   
    // $tertiary_address = $_POST['tertiary_address'] ;
     $student_status = "Registered";
    
    


    $query = "INSERT INTO student (contact_number, student_status, user_master_id, course_id, type, last_name, middle_name, first_name, suffix, birth_date, address, fathers_name, fathers_contact, fathers_address, mothers_name, mothers_contact, mothers_address, guardians_name, guardians_contact, guardians_address, primary_school, primary_year_start, primary_year_end, primary_address, secondary_school, secondary_year_start, secondary_year_end, secondary_address) VALUES ('$contact_number','$student_status', '$user_master_id','$course_id','$type', '$last_name', '$middle_name', '$first_name', '$suffix', '$birth_date', '$address', '$fathers_name', '$fathers_contact', '$fathers_address', '$mothers_name', '$mothers_contact', '$mothers_address', '$guardians_name', '$guardians_contact', '$guardians_address', '$primary_school', '$primary_year_start', '$primary_year_end', '$primary_address', '$secondary_school', '$secondary_year_start', '$secondary_year_end', '$secondary_address');";



      $query_run = mysqli_query($connection,$query);

    if($query_run){
      if ($_SESSION['stud_reg']=='true'){
         $query_session = "SELECT * from student where user_master_id = '$user_master_id'";
    $query_session = mysqli_query($connection,$query_session);

while($row_session = mysqli_fetch_assoc($query_session)){
  $_SESSION["stud_req_id"] = $row_session['id'];
  $_SESSION["stud_req_type"] = $row_session['type'];
}
     if ($_SESSION["stud_req_type"]=='New Student') {
        echo "<script type='text/javascript'>
     
      
window.location='student_requirement_create.php';
alert('Registration Completed');
</script>";
} else  if ($_SESSION["stud_req_type"]=='Old Student') {
  echo "<script type='text/javascript'>
     
      
window.location='clearance_create.php';
alert('Registration Completed');
</script>";
} else  if ($_SESSION["stud_req_type"]=='Transferee') {
  echo "<script type='text/javascript'>
     
      
window.location='student_requirement_create.php';
alert('Registration Completed');
</script>";
}

      } else {
         echo "<script type='text/javascript'>
      
window.location='index.php';
alert('Registration Completed');
</script>";
      }
     unset($_SESSION['stud_reg']);

    } else{
        header('Location: index.php');
    // mysqli_error($connection)
            $_SESSION['status'] = mysqli_error($connection);
      $_SESSION['success'] = mysqli_error($connection);
    }
}

	

	if(isset($_POST['studentsignupbtn'])){
		 $user_master_id = $_SESSION['user_id'];
     if($_SESSION['designation']=='Student'){
   $course_id =0;
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
//  $program = $_POST['program'];
//  if($program == 'Junior High'){
//   $grade = $_POST['grade'];
//  $query_select_grade = "SELECT * from course where year = '$grade' ";
//     $query_select_grade_run = mysqli_query($connection,$query_select_grade);

// while($row_grade = mysqli_fetch_assoc($query_select_grade_run)){
//   $course_id = $row_grade['id'];
// }
// } else {
//   $course_id = $_POST['course_id'];
 
// }
    }
 $type = $_POST['type'];
   $contact_number = $_POST['contact_number'];
  
    $last_name = $_POST['last_name'];
     $middle_name = $_POST['middle_name'] ;
    $first_name = $_POST['first_name'] ;
     $suffix = $_POST['suffix'];
    $birth_date = $_POST['birth_date'];
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
    // $tertiary_school ="";
    // $tertiary_year_start ="";
  
    // $tertiary_year_end="";
   
    // $tertiary_address="";
     $student_status = "Registered";
    
  if($_SESSION['designation']=='Student'){
    $query = "INSERT INTO student (contact_number, student_status, user_master_id, course_id, type, last_name, middle_name, first_name, suffix, birth_date, address, fathers_name, fathers_contact, fathers_address, mothers_name, mothers_contact, mothers_address, guardians_name, guardians_contact, guardians_address, primary_school, primary_year_start, primary_year_end, primary_address, secondary_school, secondary_year_start, secondary_year_end, secondary_address) VALUES ('$contact_number','$student_status', '$user_master_id','$course_id','$type', '$last_name', '$middle_name', '$first_name', '$suffix', '$birth_date', '$address', '$fathers_name', '$fathers_contact', '$fathers_address', '$mothers_name', '$mothers_contact', '$mothers_address', '$guardians_name', '$guardians_contact', '$guardians_address', '$primary_school', '$primary_year_start', '$primary_year_end', '$primary_address', '$secondary_school', '$secondary_year_start', '$secondary_year_end', '$secondary_address');";

    } else {
   $query = "INSERT INTO employee (contact_number, user_master_id, last_name, middle_name, first_name, suffix, birth_date, address, fathers_name, fathers_contact, fathers_address, mothers_name, mothers_contact, mothers_address, guardians_name, guardians_contact, guardians_address, primary_school, primary_year_start, primary_year_end, primary_address, secondary_school, secondary_year_start, secondary_year_end, secondary_address) VALUES ('$contact_number','$user_master_id', '$last_name', '$middle_name', '$first_name', '$suffix', '$birth_date', '$address', '$fathers_name', '$fathers_contact', '$fathers_address', '$mothers_name', '$mothers_contact', '$mothers_address', '$guardians_name', '$guardians_contact', '$guardians_address', '$primary_school', '$primary_year_start', '$primary_year_end', '$primary_address', '$secondary_school', '$secondary_year_start', '$secondary_year_end', '$secondary_address');";
}
      $query_run = mysqli_query($connection,$query);
      $_SESSIONp['error'] = mysqli_error($connection);
    if($query_run){
      unset($_SESSION['stud_reg']);
    	if ($_SESSION["password"] == 'admin'){
    		 echo "<script type='text/javascript'>
         alert('Information updated');
window.location='account_details.php';
</script>";
    	} else {
    		 echo "<script type='text/javascript'>
         alert('Information updated');
window.location='home.php';
</script>";
    	}
     

    } else{
        $_SESSION['status'] =mysqli_error($connection);
        echo "<script type='text/javascript'>

window.location='information_create.php';
</script>";
    }
}

	
	if (isset($_POST['updatebtn'])){
	$last_name = $_POST['last_name'];
  $contact_number = $_POST['contact_number'];
     $middle_name = $_POST['middle_name'] ;
    $first_name = $_POST['first_name'] ;
     $suffix = $_POST['suffix'];
    $birth_date = $_POST['birth_date'];
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
     if($primary_year_start==""){
    $primary_year_start = 0;
   }
    $primary_year_end = $_POST['primary_year_end'] ;
    if($primary_year_end==""){
    $primary_year_end = 0;
   }
    $primary_address = $_POST['primary_address'];
    $secondary_school = $_POST['secondary_school'] ;
    $secondary_year_start = $_POST['secondary_year_start'];
     if($secondary_year_start==""){
    $secondary_year_start = 0;
   }
    $secondary_year_end = $_POST['secondary_year_end'];
      if($secondary_year_end==""){
    $secondary_year_end = 0;
   }
    $secondary_address = $_POST['secondary_address'];
   //  $tertiary_school ="";
   //  $tertiary_year_start ="";
   //     if($tertiary_year_start==""){
   //  $tertiary_year_start = 0;
   // }
   //  $tertiary_year_end ="";
   //    if($tertiary_year_end==""){
   //  $tertiary_year_end = 0;
   // }
   //  $tertiary_address ="";
    $id = $_POST['id'];
    
    if($_SESSION['designation']=='Student'){
    $query = "UPDATE student SET last_name = '$last_name', middle_name = '$middle_name', first_name = '$first_name', suffix = '$suffix',birth_date = '$birth_date',contact_number = '$contact_number', address = '$address', fathers_name = '$fathers_name', fathers_contact = '$fathers_contact',fathers_address = '$fathers_address', mothers_name = '$mothers_name', mothers_contact = '$mothers_contact', mothers_address = '$mothers_address',  guardians_name = '$guardians_name', guardians_contact = '$guardians_contact', guardians_address = '$guardians_address', primary_school = '$primary_school',primary_year_start = '$primary_year_start', primary_year_end = '$primary_year_end', primary_address = '$primary_address', secondary_school = '$secondary_school',secondary_year_start = '$secondary_year_start', secondary_year_end = '$secondary_year_end', secondary_address = '$secondary_address' where id = '$id'";
} else {
     $query = "UPDATE employee SET last_name = '$last_name', middle_name = '$middle_name', first_name = '$first_name', suffix = '$suffix',birth_date = '$birth_date',contact_number = '$contact_number', address = '$address', fathers_name = '$fathers_name', fathers_contact = '$fathers_contact',fathers_address = '$fathers_address', mothers_name = '$mothers_name', mothers_contact = '$mothers_contact', mothers_address = '$mothers_address',  guardians_name = '$guardians_name', guardians_contact = '$guardians_contact', guardians_address = '$guardians_address', primary_school = '$primary_school',primary_year_start = '$primary_year_start', primary_year_end = '$primary_year_end', primary_address = '$primary_address', secondary_school = '$secondary_school',secondary_year_start = '$secondary_year_start', secondary_year_end = '$secondary_year_end', secondary_address = '$secondary_address' where id = '$id'";
}
      $query_run = mysqli_query($connection,$query);

    if($query_run){
    		header('Location: information.php');
	
			$_SESSION['success'] = "Information Updated";
     

    } else{
     header('Location: information.php');
			$_SESSION['status'] = mysqli_error($connection);
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

