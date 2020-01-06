<?php
session_start();
include('includes/header.php'); 
// include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> ATTACH Requirement
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	$attachment = '';
  	if(isset($_POST['attach_btn'])){
  		$id = $_POST['attach_id'];
      $student_id = $_SESSION["student_id"];

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
<div class="form-group">
                <label> Requirement Name </label>
                <input type="text" readonly="" name="attach_requirement_name" value="<?php echo $row['requirement_name']?>" class="form-control" placeholder="Enter Requirement Name">
            </div>
            <div class="form-group">
                <label>Type</label> 
                   <input type="text" readonly="" name="attach_type" value="<?php echo $row['type']?>" class="form-control" placeholder="Enter Type">
            </div>

            <div class="form-group">
                <label>Requirement Attachment</label>
                 <input type="hidden" name="MAX_FILE_SIZE" value="900000"/><br><input  type="file" onchange="readURL(this);"   name="edit_userfile" style="height:35px;" /> <br>
                 <img id="blah"  src="data:image/jpeg;base64,<?php echo base64_encode( $attachment ) ?> " width="300px" height="200px" alt="your image" />
                 <script type="text/javascript">
                   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    ;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

                 </script>
            
        </div>
            <a href ="requirement_attachment.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updateattacmentbtn" class="btn btn-primary"> ATTACH </button>
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
// include('includes/footer.php');
?>