<?php
session_start();
include_once 'includes/connection.php'; 




if (isset($_POST['registerbtn'])) {
		
		$announcement_headline = $_POST['announcement_headline'];
		$announcement_content = $_POST['announcement_content'];
		
	    $logo = $_FILES['userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
	    
	    $query = "INSERT INTO announcement (announcement_headline, announcement_content, announcement_attachment) VALUES ('$announcement_headline','$announcement_content','$imgContent')";

	   $query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: announcement.php');
	
			$_SESSION['success'] = "Announcement Added";
		} else{
			header('Location: announcement.php');
			$_SESSION['status'] = "Announcement not Added";
		}

	}


	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$announcement_headline = $_POST['edit_announcement_headline'];
		$announcement_content = $_POST['edit_announcement_content'];
		

	    $logo = $_FILES['edit_userfile']['tmp_name'];
	    $imgContent = addslashes(file_get_contents($logo));
	    
 if(file_exists($_FILES['edit_userfile']['tmp_name']) || is_uploaded_file($_FILES['edit_userfile']['tmp_name'])){
 	$query = "UPDATE announcement SET announcement_headline = '$announcement_headline', announcement_content = '$announcement_content', announcement_attachment = '$imgContent' where id = '$id'";

} else{
	$query = "UPDATE announcement SET announcement_headline = '$announcement_headline', announcement_content = '$announcement_content' where id = '$id'";

}
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: announcement.php');
	
			$_SESSION['success'] = "Announcement Updated";
		} else{
			header('Location: announcement.php');
			$_SESSION['status'] = "Announcement not Updated";
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