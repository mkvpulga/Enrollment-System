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
        <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="account_code.php" method="POST">

        <div class="modal-body">

          
            <div class="form-group">
                <label>Attachment</label>
               <img id="blah"  src="data:image/jpeg;base64,<?php echo base64_encode( $attachment ) ?> " width="300px" height="200px" alt="your image" /> 
            </div>
          
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" maxlength="20" class="form-control" placeholder="Enter Username">
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
  <?php
    
      if(isset($_POST['new_btn'])){
        $sid = $_POST['edit_id'];
      } else {
        $sid = $_SESSION["stud_req_id"];
      
      }
      $query = "SELECT student.*, course.id as course_id FROM student left join course on student.course_id = course.id where student.id = '$sid'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      $_SESSION['student_id'] = $row['id'];
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Student Requirement
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="student_requirement_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
 <div class="form-group">
                <label> Student Name </label>
                <input type="hidden" name="student_id" class="form-control" value="<?php echo $row['id']; ?>" placeholder="Enter Student Name">
                 <input type="hidden" name="student_type" class="form-control" value="<?php echo $row['type']; ?>" placeholder="Enter Student Name">
                  <input type="hidden" name="student_course_code" class="form-control" value="<?php echo $row['course_id']; ?>" placeholder="Enter Student Name">
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?>" placeholder="Enter Student Name" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Student Type </label>
                <input type="text" name="student_type" class="form-control" value="<?php echo $row['type']; ?>" placeholder="Enter Student Type" disabled="">
                
              
            </div>
            <div class="form-group">
                <label>Requirements</label><br>
                <?php
         
      
     
      //retrieve records
  
     
 if(isset($_POST['new_btn'])){
        $stype = $_POST['edit_stype'];
      } else {
         $stype = $_SESSION["stud_req_type"];
      }
   //$_POST['course_description'] = "gago";
    $query = "SELECT * from requirement where type =  '$stype'";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $rid = "";
      $rid = $row['id'];
   $attachment='';
       $query1 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$sid'";
  
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
      
         
  
  $query_run1 = mysqli_query($connection,$query1);
  while($row1 = mysqli_fetch_assoc($query_run1)){
     $attachment=$row1['requirement_attachment'];
     // $_SESSION['attach_id']= $row1['requirement_id'];
   }
      ?>
       <input type="checkbox" name="<?php  echo $row['id']; ?>" value="<?php  echo $row['id']; ?>"  checked="">&nbsp;<?php  echo $row['requirement_name']; ?> 
       <?php
       if($attachment!=''){
       ?>
         <input type="hidden" name="attach_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="viewattachbtn" class="btn btn-success"> View Attachment </button>
                <?php
              } else {
                ?>
                <button type="submit" name="viewattachbtn" disabled="" class="btn btn-secondary"> View Attachment </button> 
                <?php
              }
                ?>
                 <hr>


                  <?php 
              
                
              } else {
                ?>
                  <input type="checkbox" name="<?php  echo $row['id']; ?>" value="<?php  echo $row['id']; ?>" >&nbsp;<?php  echo $row['requirement_name']; ?> 
                 <button type="submit" name="viewattachbtn" disabled="" class="btn btn-secondary"> View Attachment </button> 
                 <hr>
                <?php
              }
            }
                ?>
            </div>
            <!-- <a href ="student_requirement.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit" name="studreqcreatebtn" class="btn btn-primary"> Update </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
    }
            ?>




  
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>