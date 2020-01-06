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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT School Profile
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM school_profile where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="school_profile_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> School Name </label>
                <input type="text" name="edit_school_name" value="<?php echo $row['school_name']?>" class="form-control" placeholder="Enter School Name">
            </div>
            <div class="form-group">
                <label>School Address</label>
                <input type="text" name="edit_school_address" value="<?php echo $row['school_address']?>" class="form-control" placeholder="Enter School Address">
            </div>
            <div class="form-group">
                <label>School Mission</label>
                <textarea name="edit_school_mission" rows="5"  class="form-control" placeholder="Enter School Mission"><?php echo $row['school_mission']?></textarea>
            </div>
            <div class="form-group">
                <label>School Vision</label>
                <textarea name="edit_school_vision" rows="5" class="form-control" placeholder="Enter School Vision"><?php echo $row['school_vision']?></textarea>
            </div>
            <div class="form-group">
                <label>School Logo</label>
                 <input type="hidden" name="MAX_FILE_SIZE" value="900000"/><br><input  type="file" onchange="readURL(this);"   name="edit_userfile" style="height:35px;" /> <br>
                 <img id="blah"  src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] ) ?> " width="300px" height="200px" alt="your image" />
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
            <a href ="school_profile.php" class="btn btn-danger"> CANCEL </a>
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