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
     <h6 class="m-0 font-weight-bold text-primary"> Type of School
            
    </h6>
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
    <?php
    
    
      
    
    ?>
    <form action="configuration_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
             <div class="form-group">
              <?php
  $query = "SELECT * FROM configuration";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
              ?>

                 <input type="checkbox" name="is_junior" value="1"<?php if($row['is_junior']==1){ ?> checked="" <?php } ?> > Junior High School <br>
               <input type="checkbox" name="is_senior" value="1" <?php if($row['is_senior']==1){ ?> checked="" <?php } ?> >  Senior High School <br>
               <?php
             }
               ?>
            </div>
            
            <!-- <a href ="announcement.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>