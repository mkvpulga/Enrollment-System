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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Announcement
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM announcement where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="announcement_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Announcement Headline </label>
                <input type="text" name="edit_announcement_headline" value="<?php echo $row['announcement_headline']?>" class="form-control" placeholder="Enter Announcement Headline">
            </div>
            <div class="form-group">
                <label>Announcement Content</label>
                <textarea name="edit_announcement_content" rows="5"  class="form-control" placeholder="Enter Announcement Content"><?php echo $row['announcement_content']?></textarea>
            </div>
            <div class="form-group">
                <label>Announcement Attachment</label>
                 <input type="hidden" name="MAX_FILE_SIZE" value="900000"/><br><input  type="file" onchange="readURL(this);"   name="edit_userfile" style="height:35px;" /> <br>
                 <img id="blah"  src="data:image/jpeg;base64,<?php echo base64_encode( $row['announcement_attachment'] ) ?> " width="300px" height="200px" alt="your image" />
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
            <a href ="announcement.php" class="btn btn-danger"> CANCEL </a>
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