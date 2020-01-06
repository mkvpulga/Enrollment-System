<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>

  <?php
    
       $sid = $_SESSION["student_id"];
      $query = "SELECT student.*, course.id as course_id FROM student left join course on student.course_id = course.id where student.id = '$sid'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
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
  
     
         $stype = $row['type'];
      
   //$_POST['course_description'] = "gago";
    $query = "SELECT * from requirement where type =  '$stype'";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $rid = "";
      $rid = $row['id'];

       $query1 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$sid'";
  
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
   
      ?>

                <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="" value="<?php  echo $row['id']; ?>"  checked="">&nbsp;<?php  echo $row['requirement_name']; ?> <br>


                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" disabled="" value="<?php  echo $row['id']; ?>" >&nbsp;<?php  echo $row['requirement_name']; ?> <br>
                <?php
              }
            }
                ?>
            </div>
            <!-- <a href ="student_requirement.php" class="btn btn-danger"> CANCEL </a> -->
            <!-- <button type="submit" name="studreqcreatebtn" class="btn btn-primary"> Update </button> -->
          </form>
            
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