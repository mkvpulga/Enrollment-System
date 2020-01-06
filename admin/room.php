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
        <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="room_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Room Number </label>
                <input type="text" name="room_no" class="form-control" placeholder="Enter Room Number">
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="text" name="capacity" class="form-control" placeholder="Enter Capacity">
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
<h6 class="m-0 font-weight-bold text-primary">Room
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 ">
   <form action="room.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Room Number" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * FROM room where room_no like  '$search_params%'";
  } else {
    $query = "SELECT * FROM room";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

            <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Room
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
            <th> Room Number </th>
            <th> Capacity </th>
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
            <td> <?php  echo $row['room_no']; ?></td>
            <td> <?php  echo $row['capacity']; ?></td>
            
            <td>
                <form action="room_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="room_code.php" method="post">
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


<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <form action="room_code.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
                <label> Section Code  </label>
 <input type="text" name="section_code" class="form-control" placeholder="Enter Section Code">
    </div>
  
       <div class="form-group">
                <label> Section Description</label>
              <input type="text" name="section_description" class="form-control" placeholder="Enter Section Description">
    </div>
             <div class="form-group">
                <label> Capacity</label>
              <input type="text" name="capacity" class="form-control" placeholder="Enter Capacity">
    </div>
            
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveSection" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Section
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="room.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="section_search_params" placeholder="Section Description" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="section_searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['section_searchbtn'])){
    $section_search_params = "";
      $section_search_params = $_POST['section_search_params'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * from section  where section_description like  '$section_search_params%' ";
  } else {
    $query = "SELECT * from section ";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

            <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addSection">
              Add Section
            </button>

  </div>

  <div class="card-body">

<?php
    if(isset($_SESSION['sectionSuccess']) && $_SESSION['sectionSuccess'] != ''){
      echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['sectionSuccess'].' </h2> ';
      unset($_SESSION['sectionSuccess']);
    }

  if(isset($_SESSION['sectionStatus']) && $_SESSION['sectionStatus'] != ''){
      echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['sectionStatus'].' </h2> ';
      unset($_SESSION['sectionStatus']);
    }

    ?>
    <div class="table-responsive">
   
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Section Code  </th>
            <th> Section Description </th>
            <th> Capacity </th>
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
            <td> <?php  echo $row['section_code']; ?></td>
            <td> <?php  echo $row['section_description']; ?></td>
           <td> <?php  echo $row['capacity']; ?></td>
            <td>
                <form action="section_edit.php" method="POST">
                    <input type="hidden" name="edit_section_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_section_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="room_code.php" method="post">
                  <input type="hidden" name="delete_section_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_section_btn" class="btn btn-danger"> DELETE</button>
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