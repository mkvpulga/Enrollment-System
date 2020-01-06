<?php
	session_start();
	
include_once 'includes/connection.php'; 
	//initialize variables
	$section_id = "";
	$subject_id = "";
	$room_id = "";
	$is_monday = "";
	$is_tuesday = "";
	$is_wednesday = "";
	$is_thursday = "";
	$is_friday = "";
	$is_saturday = "";
	$time_in = "";
	$time_out = "";
		
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$section_id = $_POST['section_id'];
		$subject_id = $_POST['subject_id'];
		$room_id = $_POST['room_id'];

    if(isset($_POST['is_monday']))
{
    if($_POST['is_monday'] == '1'){
        $is_monday ='1';
    }else{
        $is_monday ='0';
    }
}else
{
    $is_monday ='0';
}

if(isset($_POST['is_tuesday']))
{
    if($_POST['is_tuesday'] == '1'){
        $is_tuesday ='1';
    }else{
        $is_tuesday ='0';
    }
}else
{
    $is_tuesday ='0';
}


if(isset($_POST['is_wednesday']))
{
    if($_POST['is_wednesday'] == '1'){
        $is_wednesday ='1';
    }else{
        $is_wednesday ='0';
    }
}else
{
    $is_wednesday ='0';
}


if(isset($_POST['is_thursday']))
{
    if($_POST['is_thursday'] == '1'){
        $is_thursday ='1';
    }else{
        $is_thursday ='0';
    }
}else
{
    $is_thursday ='0';
}


if(isset($_POST['is_friday']))
{
    if($_POST['is_friday'] == '1'){
        $is_friday ='1';
    }else{
        $is_friday ='0';
    }
}else
{
    $is_friday ='0';
}


if(isset($_POST['is_saturday']))
{
    if($_POST['is_saturday'] == '1'){
        $is_saturday ='1';
    }else{
        $is_saturday ='0';
    }
}else
{
    $is_saturday ='0';
}
		$time_in = $_POST['time_in'] ;
		$time_out = $_POST['time_out'] ;
		
		$query = "INSERT INTO schedule (section_id, subject_id, room_id, is_monday, is_tuesday, is_wednesday, is_thursday, is_friday, is_saturday, time_in, time_out) VALUES ('$section_id','$subject_id','$room_id','$is_monday','$is_tuesday','$is_wednesday','$is_thursday','$is_friday','$is_saturday','$time_in','$time_out')";
		
		
		$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: schedule.php');
	
			$_SESSION['success'] = "Schedule Added";
		} else{
			header('Location: schedule.php');
			$_SESSION['status'] = mysqli_error($connection);
		}
	
		
	}
	if(isset($_POST['saveExpress'])){
        $section_id = $_POST['section_id2'];
        $course_id = $_POST['course_id'];
                
             $query_subjects = "SELECT * from curriculum where course_id = '$course_id'";
              $query_subjects_run = mysqli_query($connection,$query_subjects);
         if(mysqli_num_rows($query_subjects_run) > 0){
        while($row1 = mysqli_fetch_assoc($query_subjects_run)){
        $subject_id = $row1['subject_id'];
       
        
        $query = "INSERT INTO schedule (section_id, subject_id) VALUES ('$section_id','$subject_id')";
        
        
        $query_run_sched = mysqli_query($connection,$query);
    }   
} 
        if($query_run_sched){
            header('Location: schedule.php');
    
            $_SESSION['success'] = "Schedule Added";
        } else{
            header('Location: schedule.php');
            $_SESSION['status'] = "No Subject Registered in Curriculum for the selected Course";
        }
    
        
    }


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$edit_section_id = $_POST['edit_section_id'];
		$edit_subject_id = $_POST['edit_subject_id'];
		$edit_room_id = $_POST['edit_room_id'];

    if(isset($_POST['edit_is_monday']))
{
    if($_POST['edit_is_monday'] == '1'){
        $edit_is_monday ='1';
    }else{
        $edit_is_monday ='0';
    }
}else
{
    $edit_is_monday ='0';
}

if(isset($_POST['edit_is_tuesday']))
{
    if($_POST['edit_is_tuesday'] == '1'){
        $edit_is_tuesday ='1';
    }else{
        $edit_is_tuesday ='0';
    }
}else
{
    $edit_is_tuesday ='0';
}


if(isset($_POST['edit_is_wednesday']))
{
    if($_POST['edit_is_wednesday'] == '1'){
        $edit_is_wednesday ='1';
    }else{
        $edit_is_wednesday ='0';
    }
}else
{
    $edit_is_wednesday ='0';
}


if(isset($_POST['edit_is_thursday']))
{
    if($_POST['edit_is_thursday'] == '1'){
        $edit_is_thursday ='1';
    }else{
        $edit_is_thursday ='0';
    }
}else
{
    $edit_is_thursday ='0';
}


if(isset($_POST['edit_is_friday']))
{
    if($_POST['edit_is_friday'] == '1'){
        $edit_is_friday ='1';
    }else{
        $edit_is_friday ='0';
    }
}else
{
    $edit_is_friday ='0';
}


if(isset($_POST['edit_is_saturday']))
{
    if($_POST['edit_is_saturday'] == '1'){
        $edit_is_saturday ='1';
    }else{
        $edit_is_saturday ='0';
    }
}else
{
    $edit_is_saturday ='0';
}
		$edit_time_in = $_POST['edit_time_in'] ;
		$edit_time_out = $_POST['edit_time_out'] ;
		
	
 	$query = "UPDATE schedule SET section_id = '$edit_section_id', subject_id = '$edit_subject_id', room_id = '$edit_room_id', is_monday = '$edit_is_monday', is_tuesday = '$edit_is_tuesday', is_wednesday = '$edit_is_wednesday', is_thursday = '$edit_is_thursday', is_friday = '$edit_is_friday', is_saturday = '$edit_is_saturday', time_in = '$edit_time_in', time_out = '$edit_time_out' where id = '$id'";

 	
			$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: schedule.php');
	
			$_SESSION['success'] = "Schedule Updated";
		} else{
			header('Location: schedule.php');
			$_SESSION['status'] = "Schedule not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
	
 
 	$query = "DELETE FROM schedule WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: schedule.php');
	
			$_SESSION['success'] = "Schedule Deleted";
		} else{
			header('Location: schedule.php');
			$_SESSION['status'] = "Schedule not Deleted";
		}
	} 

?>



