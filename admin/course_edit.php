<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Course
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM course where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="course_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Course Code </label>
                <input type="text" name="edit_course_code" value="<?php echo $row['course_code']?>" class="form-control" placeholder="Enter Course Code">
            </div>
            <div class="form-group">
                <label>Course Description</label>
                <input type="text" name="edit_course_description" value="<?php echo $row['course_description']?>" class="form-control" placeholder="Enter Course Description">
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="edit_year" value="<?php echo $row['year']?>" class="form-control" placeholder="Enter Year">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="edit_semester" value="<?php echo $row['semester']?>" class="form-control" placeholder="Enter Semester">
            </div>
            <a href ="course.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
          </form>
            <?php
        }
    }
            ?>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>