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
        <h5 class="modal-title" id="exampleModalLabel">Track Miscellaneous</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="student_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Track Code </label>
                <input type="hidden" name="misc_course_id" class="form-control" value="<?php  echo $_SESSION["misc_course_id"]; ?>" placeholder="Enter Student Name">
                <input type="text" name="misc_course_code" class="form-control" value="<?php  echo $_SESSION["misc_course_code"]; ?>" placeholder="Enter Track Code" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Track Description </label>
                <input type="text" name="misc_course_description" class="form-control" value="<?php  echo $_SESSION["misc_course_description"]; ?>" placeholder="Enter Track Description" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Semester </label>
                <input type="text" name="misc_semester" class="form-control" value="<?php  echo $_SESSION["misc_semester"]; ?>" placeholder="Enter Semester" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Grade </label>
                <input type="text" name="misc_year" class="form-control" value="<?php  echo $_SESSION["misc_year"]; ?>" placeholder="Enter Grade" disabled="">
                
              
            </div>
            <div class="form-group">
                <label>Miscellaneous</label><br>
                 <?php
         
      
     
      //retrieve records
  
   $misc_course_id = "";
      $misc_course_id = $_SESSION["misc_course_id"];

   //$_POST['course_description'] = "gago";
    $query = "SELECT * from miscellaneous ";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $misc_id = "";
      $misc_id = $row['id'];

       $query1 = "SELECT * from course_misc where miscellaneous_id =  '$misc_id' and course_id =  '$misc_course_id'";
  
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
   
      ?>

                <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="" checked>&nbsp;<?php  echo $row['miscellaneous_name'] . $misc_course_id . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>

                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="">&nbsp;<?php  echo $row['miscellaneous_name'] . $misc_course_id  . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
              }
            }
                ?>
            </div>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Track Miscellaneous
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="course_misc.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Track Code" aria-label="Search" aria-describedby="basic-addon2">
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
   //$_POST['student_description'] = "gago";
    $query = "SELECT * FROM course where course_code like  '$search_params%' ";
  } else {
    $query = "SELECT * FROM course";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

    
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
            <th> Track Code </th>
            <th> Track Description </th>
             <th> Semester </th>
             <th> Grade </th>
              <th>VIEW </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
            <td> <?php  echo $row['course_code']; $_SESSION["misc_course_code"] = $row['course_code']; ?></td>
           <td> <?php  echo $row['course_description']; $_SESSION["misc_course_description"] = $row['course_description']; ?></td>
            <td> <?php  echo $row['semester']; $_SESSION["misc_semester"] = $row['semester']; ?></td>
            <td> <?php  echo $row['year']; $_SESSION["misc_year"] = $row['year']; ?></td>
           <td>
                <form action="course_misc_edit.php" method="POST">
                    <input type="hidden" name="view_id" value="<?php echo $row['id']; $_SESSION["misc_course_id"] = $row['id'] ?>">
                     <button type="submit" name="view_btn" class="btn btn-primary"> VIEW</button>
               
                </form>
            </td>
            <td>
                <form action="course_misc_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-success"> UPDATE</button>
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