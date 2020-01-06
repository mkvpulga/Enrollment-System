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
$stud_id = $_POST['student_id'];
		

		// $stype = $_SESSION["stype"];

 
 	$query1 = "SELECT * from requirement ";
 	 
			$_SESSION['success'] = mysqli_error($connection);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$rid = $row['id'];
// $rid = $_POST['$rrid'] ;

if(empty($_POST[$rid])) {
	$query = " DELETE FROM student_requirement WHERE requirement_id = $rid;"; 
 $query_run = mysqli_query($connection,$query);
			
			} else {
$query = " INSERT INTO student_requirement (student_id,requirement_id) VALUES ($stud_id,$rid);"; 	
				 $query_run = mysqli_query($connection,$query);
				
			}
    } 
	
 $query_run = mysqli_query($connection,$query);
   
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: student_requirement.php');
	
			$_SESSION['success'] = "Student Requirement Updated";
		} else{
			header('Location: student_requirement.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}


	if (isset($_POST['evaluationbtn'])){
		 $average_grade = $_POST['grade'];
$stud_id = $_POST['student_id'];
	$student_type =	$_SESSION["stud_req_type"];
	$current_grade_level = '';
	$current_course_code = '';
	$current_semester = 0;
	$max_sem = 0;
	$next_grade_level = '';
	$next_semester = 0;
	$course_id=0;
	$query1 = "SELECT * from course left join student on course.id = student.course_id where student.id = '$stud_id' ";
 	 
 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	
    		$current_grade_level = $row['year'];
	$current_course_code = $row['course_code'];
	$current_semester = $row['semester'];
    }

    if($current_grade_level>10){
    	$query1 = "SELECT *,max(semester) as max_sem from course where course_code = '$current_course_code' ";
 	 
 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$max_sem = $row['max_sem'];
    	if($current_semester==$max_sem){
    		$next_grade_level = $current_grade_level + 1;
    		$next_semester = 1;
    	} else {
    		$next_grade_level = $current_grade_level;
    		$next_semester = $current_semester + 1;
    	}
    }

    }

	if($student_type=='Old Student'){
$query1 = "SELECT * from course where course_code = '$current_course_code' and year =  '$next_grade_level' and semester = '$next_semester'";
 	 
 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$course_id=$row['id'];
    }
    if($next_grade_level>12){
    	echo "<script type='text/javascript'>
      
window.location='evaluation.php';
alert('Student Cannot Advance Anymore');
</script>";
    }else {
    $query = " UPDATE student set course_id = '$course_id' where id = '$stud_id';"; 	
				 $query_run = mysqli_query($connection,$query);
				}
	}

 	if($average_grade>=75){
 		
 		 echo "<script type='text/javascript'>
      
window.location='assignment_section_create.php';
alert('The Student Passed');
</script>";
	
			
		} else{
			echo "<script type='text/javascript'>
      
window.location='evaluation.php';
alert('The Student Failed');
</script>";
		}
	}


if (isset($_POST['conditionalpassbtn'])){
		 $num_of_failed = $_POST['num_of_failed'];
$stud_id = $_POST['student_id'];
	$student_type =	$_SESSION["stud_req_type"];
	$query = "DELETE From conditional_pass where student_id = '$stud_id';"; 	
				 $query_run = mysqli_query($connection,$query);
 $query = "INSERT into conditional_pass (student_id) values ('$stud_id');"; 	
				 $query_run = mysqli_query($connection,$query);

 	if($query_run){
 		
 		 echo "<script type='text/javascript'>
      
window.location='remidial_list.php';
</script>";
	
			
		} else{
			echo "<script type='text/javascript'>
      
window.location='conflicts.php';
alert('Something went wrong');
</script>";
		}
	}

if (isset($_POST['retainbtn'])){

		 $num_of_failed = $_POST['num_of_failed'];
$stud_id = $_POST['student_id'];
	$student_type =	$_SESSION["stud_req_type"];
	// $query = "DELETE From conditional_pass where student_id = '$stud_id';"; 	
	// 			 $query_run = mysqli_query($connection,$query);
 // $query = "INSERT into conditional_pass (student_id) values ('$stud_id');"; 	
	// 			 $query_run = mysqli_query($connection,$query);


				 $_SESSION["stud_req_id"] = $stud_id;
 	// if($query_run){
 		
 		 echo "<script type='text/javascript'>
      
window.location='assignment_section_create.php';
 alert('Student is retained');
</script>";
	
			
// 		} else{
// 			echo "<script type='text/javascript'>
      
// window.location='conflicts.php';
// alert('Something went wrong');
// </script>";
// 		}
	}
?>

