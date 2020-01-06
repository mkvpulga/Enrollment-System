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
        <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="announcement_code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Announcement Headline </label>
                <input type="text" name="announcement_headline" class="form-control" placeholder="Enter Announcement Headline">
            </div>
           
            <div class="form-group">
                <label>Announcement Content</label>
                <textarea name="announcement_content" class="form-control" rows="5" placeholder="Enter Announcement Content"></textarea> 
            </div>
           
        
        <div class="form-group">
                <label>Announcement Attachment</label>
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
<h6 class="m-0 font-weight-bold text-primary">Announcement
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="announcement.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Announcement Headline" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            </form>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['announcement_description'] = "gago";
    $query = "SELECT * FROM announcement where announcement_headline like  '$search_params%'";
  } else {
    $query = "SELECT * FROM announcement";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Announcement
            </button>
            
    
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
            <th> Announcement Headline </th>
            <th> Announcement Content </th>
            <th>Announcement Attachment </th>
           
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
            <td> <?php  echo $row['announcement_headline']; ?></td>
            <td> <?php  echo $row['announcement_content']; ?></td>
            <td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['announcement_attachment'] ).'" width="100px" height="50px"/>'; ?>
            <td>
                <form action="announcement_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="announcement_code.php" method="post">
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