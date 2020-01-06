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
     <h6 class="m-0 font-weight-bold text-primary"> ATTACHED Requirement
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	$attachment = '';
  	
  		$id = $_SESSION['attach_id']  ;
      $student_id = $_SESSION["student_id"];
      $student_name = '';
        $student_type = '';
  $query = "SELECT * FROM student where id = '$student_id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      $student_name = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . " " . $row['suffix'];
       $student_type = $row['type'];
    }

  		$query = "SELECT * FROM requirement where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			 $query1 = "SELECT * FROM student_requirement where requirement_id = '$id' and student_id = '$student_id'";
    $query_run1 = mysqli_query($connection,$query1);

    foreach ($query_run1 as $row1) {  
      $attachment = $row1['requirement_attachment'];
    }
  	
  	?>
    <form action="requirement_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="attach_id" value="<?php echo $row['id']; ?>">
             <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                <input type="hidden" name="student_type" value="<?php echo $student_type; ?>">
             <div class="form-group">
                <label> Student Name </label>
                <input type="text" readonly="" name="student_name" value="<?php echo $student_name?>" class="form-control" placeholder="Enter Student Name">
            </div>
<div class="form-group">
                <label> Requirement Name </label>
                <input type="text" readonly="" name="attach_requirement_name" value="<?php echo $row['requirement_name']?>" class="form-control" placeholder="Enter Requirement Name">
            </div>
            

            <div class="form-group">
                <label>Requirement Attachment</label>
                 <br>
                 <img id="blah"  src="data:image/jpeg;base64,<?php echo base64_encode( $attachment ) ?> " width="300px" height="200px" alt="your image" />
                 
            
        </div>
             <button type="submit" name="backviewbtn" class="btn btn-danger"> BACK </button>
          </form>
            <?php
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