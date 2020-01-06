<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>
 <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h4 class="h4 mb-0 text-gray-800">Home</h4>
    <?php
    if($_SESSION['designation']=='Student'){
    ?>
<a class="collapse-item" style="float: right;" href="grades_preview.php"><i class="fas fa-fw fa-envelope-open"></i>&nbsp;<span>ENROLL NOW</span></a>
<?php
}
?>

  </div>
  <h5 class="h5 mb-0 text-gray-800">Upcoming Events</h5>

<div class="row">
<?php
    
   
      $query = "SELECT * FROM announcement";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>

            <div class="col-lg-6">

<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['announcement_headline']?></h6>
                </div>
                <div class="card-body">
                  <p><?php echo $row['announcement_content']?></p>
                   <img   src="data:image/jpeg;base64,<?php echo base64_encode( $row['announcement_attachment'] ) ?> " width="400px" height="300px" alt="your image" />
              </div>
              </div>
            </div>

<?php
}
?>

</div>
<h5 class="h5 mb-0 text-gray-800">School Principles</h5>

<div class="row">
<?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>

            <div class="col-lg-6">

<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">School Vision</h6>
                </div>
                <div class="card-body">
                  <p><?php echo $row['school_vision']?></p>
                  
              </div>
              </div>
            </div>

            <div class="col-lg-6">

<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">School Mission</h6>
                </div>
                <div class="card-body">
                  <p><?php echo $row['school_mission']?></p>
                  
              </div>
              </div>
            </div>

<?php
}
?>

</div>

  </div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>