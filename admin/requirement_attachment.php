<?php
session_start();
include('includes/header.php'); 
// include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>





<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Requirement
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     
            <?php
         $student_type = $_SESSION["student_type"];
      
     
      //retrieve records
  
  
    $query = "SELECT * FROM requirement where type = '$student_type'";
  
  $query_run = mysqli_query($connection,$query);
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
            <th> Requirement Name </th>
            <th> Type </th>
            <th> Attachment </th>
            <th>ATTACH </th>
          
          </tr>
        </thead>
        <tbody>
      <?php

      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
           $attachment='';
          $student_id = $_SESSION['student_id'];
           $requirement_id = $row['id'];
           $query1 = "SELECT * FROM student_requirement where requirement_id = '$requirement_id' and student_id='$student_id'";
  
  $query_run1 = mysqli_query($connection,$query1);
  while($row1 = mysqli_fetch_assoc($query_run1)){
     $attachment=$row1['requirement_attachment'];
   }
          ?>
          <tr>
            <td> <?php  echo $row['requirement_name']; ?></td>
            <td> <?php  echo $row['type']; ?></td>
            <?php

            ?>
            <td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $attachment ).'" width="100px" height="50px" alt="your_image"/>'; ?>
            <td>
                <form action="requirement_attachment_edit.php" method="POST">
                    <input type="hidden" name="attach_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="attach_btn" class="btn btn-primary"> ATTACH</button>
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
     <form action="requirement_code.php" method="POST" >
       <button type="submit" style="float: right;" name="register_require_attach" class="btn btn-primary btn-md" >
              Register
                <i class="fas fa-file-signature ml-1"></i>
  </form>
  </div>
  
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>