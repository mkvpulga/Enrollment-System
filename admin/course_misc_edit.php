<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


 <?php
    
    if(isset($_POST['edit_btn'])){
      $id = $_POST['edit_id'];

      $query = "SELECT * FROM course where id = '$id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Track Miscellaneous
            
    </h6>
  </div>

  <div class="card-body">
   
    <form action="course_misc_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
      <div class="form-group">
                <label> Track Code </label>
                <input type="hidden" name="misc_course_id" class="form-control" value="<?php echo $row['id']; ?>" placeholder="Enter Track Code">
                <input type="text" name="misc_course_code" class="form-control" value="<?php echo $row['course_code']; ?>" placeholder="Enter Track Code" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Track Description </label>
                <input type="text" name="misc_course_description" class="form-control" value="<?php echo $row['course_description']; ?>" placeholder="Enter Track Description" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Semester </label>
                <input type="text" name="misc_semester" class="form-control" value="<?php echo $row['semester']; ?>" placeholder="Enter Semester" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Grade </label>
                <input type="text" name="misc_year" class="form-control" value="<?php echo $row['year']; ?>" placeholder="Enter Grade" disabled="">
                
              
            </div>
            
            <div class="form-group">
                <label>Miscellaneous</label><br>
                 <?php
         
      
     
      //retrieve records
  
   $misc_course_id = "";
      $misc_course_id = $_POST['edit_id'];

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

                <input type="checkbox" name="<?php  echo $row['id']; ?>"   checked="">&nbsp;<?php  echo $row['miscellaneous_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>

                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" >&nbsp;<?php  echo $row['miscellaneous_name']  . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
              }
            }
                ?>
            </div>
          <a href ="course_misc.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
          </form>
         
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

   <?php
        }
    }
            ?>





 <?php
    
    if(isset($_POST['view_btn'])){
      $id = $_POST['view_id'];

      $query = "SELECT * FROM course where id = '$id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> VIEW Track Miscellaneous
            
    </h6>
  </div>

  <div class="card-body">
   
    <form action="course_misc_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
      <div class="form-group">
                <label> Track Code </label>
                <input type="hidden" name="misc_course_id" class="form-control" value="<?php echo $row['id']; ?>" placeholder="Enter Track Code">
                <input type="text" name="misc_course_code" class="form-control" value="<?php echo $row['course_code']; ?>" placeholder="Enter Track Code" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Track Description </label>
                <input type="text" name="misc_course_description" class="form-control" value="<?php echo $row['course_description']; ?>" placeholder="Enter Track Description" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Semester </label>
                <input type="text" name="misc_semester" class="form-control" value="<?php echo $row['semester']; ?>" placeholder="Enter Semester" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Grade </label>
                <input type="text" name="misc_year" class="form-control" value="<?php echo $row['year']; ?>" placeholder="Enter Grade" disabled="">
                
              
            </div>
            
            <div class="form-group">
                <label>Miscellaneous</label><br>
                 <?php
         
      
     
      //retrieve records
  
   $misc_course_id = "";
      $misc_course_id = $_POST['view_id'];

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

                <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled=""  checked="">&nbsp;<?php  echo $row['miscellaneous_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>

                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="" >&nbsp;<?php  echo $row['miscellaneous_name']  . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
              }
            }
                ?>
            </div>
          <a href ="course_misc.php" class="btn btn-danger"> BACK </a>
          </form>
         
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

   <?php
        }
    }
            ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>