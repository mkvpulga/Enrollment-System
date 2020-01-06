<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add School Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="school_profile_code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> School Name </label>
                <input type="text" name="school_name" class="form-control" placeholder="Enter School Name">
            </div>
            <div class="form-group">
                <label>School Address</label>
                <input type="text" name="school_address" class="form-control" placeholder="Enter School Address">
            </div>
            <div class="form-group">
                <label>School Mission</label>
                <textarea name="school_mission" class="form-control" rows="5" placeholder="Enter School Mission"></textarea> 
            </div>
            <div class="form-group">
                <label>School Vision</label>
                <textarea name="school_vision" class="form-control" rows="5" placeholder="Enter School Vision"></textarea>
            </div>
        
        <div class="form-group">
                <label>School Logo</label>
                 <input type="hidden" name="MAX_FILE_SIZE" value="900000"/><br><input  type="file" onchange="readURL(this);"  name="userfile" style="height:35px;" /> <br>
                 <img id="blah"  src="#" width="300px" height="200px" alt="your image" />
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">School Profile
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <!-- <form action="school_profile.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="School Profile Description" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            </form> -->
            <?php
         
      
     
      //retrieve records
  
  // if(isset($_POST['searchbtn'])){
  //   $search_params = "";
  //     $search_params = $_POST['search_params'];
  //  //$_POST['school_profile_description'] = "gago";
  //   $query = "SELECT * FROM school_profile where school_profile_description like  '$search_params%'";
  // } else {
    $query = "SELECT * FROM school_profile";
  // }
  $query_run = mysqli_query($connection,$query);
  if(mysqli_num_rows($query_run) <= 0){
      ?>
          

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add School Profile
            </button>
            <?php 
          }
            ?>
    
  </div>

  <div class="card-body">

<?php
  	if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
  		echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['success'].' </h2> ';
  		unset($_SESSION['success']);
  	}

	if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
  		echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['status'].' </h2> ';
  		unset($_SESSION['status']);
  	}

  	?>
    <div class="table-responsive">
    	
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> School Name </th>
            <th> School Address </th>
            <th>School Mission </th>
            <th>School Vision</th>
            <th>School Logo</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
            <td> <?php  echo $row['school_name']; ?></td>
            <td> <?php  echo $row['school_address']; ?></td>
            <td> <?php  echo $row['school_mission']; ?></td>
            <td> <?php  echo $row['school_vision']; ?> </td>
            <td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['logo'] ).'" width="100px" height="50px"/>'; ?>
            <td>
                <form action="school_profile_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="school_profile_code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
     		<?php }
     	} else {
     	echo "No Record Found";
     }

     	?>
          
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>