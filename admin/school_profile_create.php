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
     <h6 class="m-0 font-weight-bold text-primary"> School Profile
            
    </h6>
  </div>

  <div class="card-body">
  	
    <form action="school_profile_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> School Name </label>
                <input type="text" name="edit_school_name"  class="form-control" placeholder="Enter School Name">
            </div>
            <div class="form-group">
                <label>School Address</label>
                <input type="text" name="edit_school_address"  class="form-control" placeholder="Enter School Address">
            </div>
            <div class="form-group">
                <label>School Mission</label>
                <textarea name="edit_school_mission" rows="5"  class="form-control" placeholder="Enter School Mission"></textarea>
            </div>
            <div class="form-group">
                <label>School Vision</label>
                <textarea name="edit_school_vision" rows="5" class="form-control" placeholder="Enter School Vision"></textarea>
            </div>
            <div class="form-group">
                <label>School Logo</label>
                 <input type="hidden" name="MAX_FILE_SIZE" value="900000"/><br><input  type="file" onchange="readURL(this);"   name="edit_userfile" style="height:35px;" /> <br>
                 <img id="blah"  src="" width="300px" height="200px" alt="your image" />
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
            <!-- <a href ="school_profile.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit" name="createbtn" class="btn btn-primary"> Update </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>