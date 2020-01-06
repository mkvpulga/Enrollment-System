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
     <h6 class="m-0 font-weight-bold text-primary"> Account Details
            
    </h6>
  </div>

  <div class="card-body">
    <?php
    
     $id = $_SESSION['user_id'];

      $query = "SELECT * FROM user_master where id = '$id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
    <form action="account_details_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Username </label>
                <input type="text" name="username" value="<?php echo $row['username']?>" class="form-control" placeholder="Enter Username" >
            </div>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password"  class="form-control" placeholder="Enter Current Password">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" id="new_password" name="new_password"  class="form-control" placeholder="Enter Password">
                </div>
          
          
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
          </form>
            <?php
        
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