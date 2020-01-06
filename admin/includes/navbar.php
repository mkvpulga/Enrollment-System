<?php
include_once 'includes/connection.php'; 
?>
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">




<!-- Sidebar - Brand -->
<li class="nav-item active">
<a class="sidebar-brand d-flex align-items-center justify-content-center nav-link" >
 
  <div class="sidebar-brand-text mx-3 fix" ><i class="fas fa-fw fa-database"></i>Dashboard</div>
</a>
</li>

<!-- Divider -->
<hr class="sidebar-divider ">

<li class="nav-item active">
  <a class="nav-link" href="home.php">
    <i class="fas fa-fw fa-home"></i>&nbsp;<span>Home</span></a>
</li>


<?php
if($_SESSION['designation']=='Administrator'){
?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-ad"></i>
    <span>Admin</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="account.php"><i class="fas fa-fw fa-universal-access"></i>&nbsp;<span>Account</span></a>
      <a class="collapse-item" href="announcement.php"><i class="fas fa-fw fa-cannabis"></i>&nbsp;<span>Announcement</span></a>
     <a class="collapse-item" href="configuration.php"><i class="fas fa-fw fa-concierge-bell"></i>&nbsp;<span>Configuration</span></a>
     <!-- <a class="collapse-item" href="#"><i class="fas fa-fw fa-school"></i>&nbsp;<span>School Year</span></a> -->
     <!-- <a class="collapse-item" href="schedule.php"><i class="fas fa-fw fa-scroll"></i>&nbsp;<span>Schedule</span></a> -->
      <a class="collapse-item" href="school_profile.php"><i class="fas fa-fw fa-school"></i>&nbsp;<span>School Profile</span></a>
     <a class="collapse-item" href="unit_fee.php"><i class="fas fa-fw fa-university"></i>&nbsp;<span>Unit Fee</span></a>
    <a class="collapse-item" href="course_misc.php"><i class="fas fa-fw fa-cocktail"></i>&nbsp;<span>Track Miscellaneous</span></a>
    <a class="collapse-item" href="course_other_fee.php"><i class="fas fa-fw fa-code"></i>&nbsp;<span>Track Other Fee</span></a>
    </div>
  </div>
</li>

<?php
} elseif($_SESSION['designation']=='Registrar'){
?>


<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cash-register"></i>
    <span>Registrar</span>
  </a>
  <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="assignment_section.php"><i class="fas fa-fw fa-compass"></i>&nbsp;<span>Section Assignment</span></a>
      <a class="collapse-item" href="student_grades.php"><i class="fas fa-fw fa-graduation-cap"></i>&nbsp;<span>Student Grades</span></a>
      <a class="collapse-item" href="conflicts_search.php" onclick="<?php $_SESSION['stud_reg'] = 'true'; ?>"><i class="fas fa-fw fa-walking"></i>&nbsp;<span>Conflicts</span></a>
        <a class="collapse-item" href="information_create.php" onclick="<?php $_SESSION['stud_reg'] = 'true'; ?>"><i class="fas fa-fw fa-registered"></i>&nbsp;<span>Walk - in Registration</span></a>
         <a class="collapse-item" href="online_registration.php" onclick="<?php $_SESSION['stud_reg'] = 'true'; ?>"><i class="fas fa-fw fa-dice-one"></i>&nbsp;<span>Online Registration</span></a>
      <a class="collapse-item" href="student_requirement.php"><i class="fas fa-fw fa-adjust"></i>&nbsp;<span>Student Requirement</span></a>
       <a class="collapse-item" href="list_of_students.php" ><i class="fas fa-fw fa-assistive-listening-systems"></i>&nbsp;<span>List Of Students</span></a>
       <a class="collapse-item" href="enrolled_students.php" ><i class="fas fa-fw fa-envelope"></i>&nbsp;<span>Enrolled Students</span></a>
        <a class="collapse-item" href="class_list.php" ><i class="fas fa-fw fa-exclamation"></i>&nbsp;<span>Class List</span></a>
         <a class="collapse-item" href="remidial_list.php" ><i class="fas fa-fw fa-redo"></i>&nbsp;<span>Remidial List</span></a>
         <a class="collapse-item" href="report_student_schedule.php" ><i class="fas fa-fw fa-reply"></i>&nbsp;<span>Schedule Report</span></a>
       <?php
if($_SESSION['is_senior']==true){
?>

        <a class="collapse-item" href="course.php"><i class="fas fa-fw fa-couch"></i>&nbsp;<span>Track</span></a>

<?php
}
?>
     <a class="collapse-item" href="curriculum.php"><i class="fas fa-fw fa-bezier-curve"></i>&nbsp;<span>Curriculum</span>
       <a class="collapse-item" href="clearance.php"><i class="fas fa-fw fa-bicycle"></i>&nbsp;<span>Clearance</span></a>
     <a class="collapse-item" href="requirement.php"><i class="fas fa-fw fa-address-card"></i>&nbsp;<span>Requirement</span></a>
     <a class="collapse-item" href="room.php"><i class="fas fa-fw fa-broom"></i>&nbsp;<span>Room/Section</span></a>
     <a class="collapse-item" href="school_year.php"><i class="fas fa-fw fa-balance-scale"></i>&nbsp;<span>School Year</span></a>
     </a>
     <a class="collapse-item" href="subject.php"><i class="fas fa-fw fa-subscript"></i>&nbsp;<span>Subject</span></a>
     </a>

    <a class="collapse-item" href="schedule.php"><i class="fas fa-fw fa-audio-description"></i>&nbsp;<span>Schedule</span></a>
    <a class="collapse-item" href="payment.php"><i class="fas fa-fw fa-backspace"></i>&nbsp;<span>Settlement</span></a>
   
      </div>
  </div>
</li>

<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThreeA" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-satellite-dish"></i>
    <span>SHS Report</span>
  </a>
  <div id="collapseThreeA" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="shs_track_report.php"><i class="fas fa-fw fa-shapes"></i>&nbsp;<span>Track Report</span></a>
      <a class="collapse-item" href="shs_section_report.php"><i class="fas fa-fw fa-share"></i>&nbsp;<span>Section Report</span></a>
       <a class="collapse-item" href="shs_student_report.php"><i class="fas fa-fw fa-share-alt"></i>&nbsp;<span>Student Report</span></a>
       <a class="collapse-item" href="shs_schedule_report.php"><i class="fas fa-fw fa-share-alt-square"></i>&nbsp;<span>Schedule Report</span></a>
      </div>
  </div>
</li>


<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThreeB" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-user-injured"></i>
    <span>JHS Report</span>
  </a>
  <div id="collapseThreeB" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="jhs_track_report.php"><i class="fas fa-fw fa-eject"></i>&nbsp;<span>Track Report</span></a>
      <a class="collapse-item" href="jhs_section_report.php"><i class="fas fa-fw fa-user-ninja"></i>&nbsp;<span>Section Report</span></a>
       <a class="collapse-item" href="jhs_student_report.php"><i class="fas fa-fw fa-fighter-jet"></i>&nbsp;<span>Student Report</span></a>
       <a class="collapse-item" href="jhs_schedule_report.php"><i class="fas fa-fw fa-jedi"></i>&nbsp;<span>Schedule Report</span></a>
      </div>
  </div>
</li>


<?php
} elseif($_SESSION['designation']=='Cashier'){
?>
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-briefcase"></i>
    <span>Cashier</span>
  </a>
  <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="cashier_payment.php"><i class="fas fa-fw fa-chess-pawn"></i>&nbsp;<span>Payment</span></a>
       
      </div>
  </div>
</li>
<?php
} elseif($_SESSION['designation']=='Student'){
  $user_master_id = $_SESSION['user_id'];
   $query_student = "SELECT student.*, course.id as course_id FROM student left join course on student.course_id = course.id where user_master_id =  '$user_master_id'";
  $query_student_run = mysqli_query($connection,$query_student);
    while($row_student = mysqli_fetch_assoc($query_student_run)){
      $_SESSION["student_id"] = $row_student['id'];
      $_SESSION["course_id"] = $row_student['course_id'];
      $_SESSION["student_type"] = $row_student['type'];
    }
?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-align-justify"></i>
    <span>Student</span>
  </a>
  <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <?php
      if($_SESSION["student_type"]=='Old Student'){
      ?>
      <a class="collapse-item" href="grades_preview.php"><i class="fas fa-fw fa-digital-tachograph"></i>&nbsp;<span>Enrollment</span></a>
        
      <?php
    }
    ?>
    
   <!-- <a class="collapse-item" href="clearance_preview.php"><i class="fas fa-fw fa-arrow-alt-circle-down"></i>&nbsp;<span>Clearance</span></a>
   <a class="collapse-item" href="requirement_preview.php"><i class="fas fa-fw fa-receipt"></i>&nbsp;<span>Requirement</span></a> -->
    </div>
  </div>
</li>

<?php
} 
?>

<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
<?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);
if(mysqli_num_rows($query_run) > 0){
    foreach ($query_run as $row) {
      
    
    ?>
          <!-- Topbar Search -->
          <img   src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] ) ?> " width="100px" height="50px" alt="your image" />
               <h4 class="input-group mb-0 text-gray-800"><?php echo $row['school_name']?></h4>
<?php
}
} else {
?>         
<img   src="" width="100px" height="50px" alt="School Logo" />
               <h4 class="input-group mb-0 text-gray-800">School Name</h4>
<?php
}
?>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

         


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
               <?php

    $user_master_id = $_SESSION["user_id"];
    if($_SESSION['designation']=='Student'){
      $query = "SELECT * FROM student where user_master_id = $user_master_id";
    } else {
 $query = "SELECT * FROM employee where user_master_id = $user_master_id";
    }
    $query_run = mysqli_query($connection,$query);
    foreach ($query_run as $row) {
echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name']; 
}
?>
                  
                </span>
                <img class="img-profile rounded-circle" src="image/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              
                <a class="dropdown-item" href="account_details.php">
                  <i class="fas fa-exchange-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Account Details
                </a>
                <a class="dropdown-item" href="information.php">
                  <i class="fas fa-person-booth fa-sm fa-fw mr-2 text-gray-400"></i>
                  Other Information
                </a>

       
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-blog fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php"><span>Logout</span></a>
 
        <!--   <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>
 -->

        </div>
      </div>
    </div>
  </div>