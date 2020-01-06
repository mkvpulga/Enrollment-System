<?php
session_start();
include('includes/header.php'); 
// include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
  
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
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Admin Information
            
    </h6>
  </div>

  <div class="card-body">
  	
    <form action="configuration_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="user_master_id" value="<?php echo $_SESSION['user_id']; ?>">
             
<div class="form-group">
                <label> First Name </label>
                <input type="text" name="first_name"  class="form-control" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name"  class="form-control" placeholder="Enter Last Name">
            </div>
        
            <!-- <a href ="school_profile.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit" name="admincreatebtn" class="btn btn-primary"> Update </button>
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