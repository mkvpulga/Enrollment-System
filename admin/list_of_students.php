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
        <h5 class="modal-title" id="exampleModalLabel">List of Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="list_of_students.php" method="POST">

        <div class="modal-body">

           
            <div class="form-group">
                <label>Track Code</label><br>
                 <?php
         
      
     
    $query = "SELECT * from course ";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      
      ?>

                <input type="checkbox" name="<?php  echo $row['id']; ?>" value="<?php  echo $row['id']; ?>" >&nbsp;<?php  echo $row['course_code']; ?>
                &nbsp; &nbsp; &nbsp;


                <?php
            }
                ?>
            </div>
            <!-- <div class="form-group">
                <label>Student Status</label><br>
                <input type="checkbox" name="Enrolled" value="ENROLLED" >&nbsp;Enrolled
                &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="Not_Enrolled" value="NOT ENROLLED" >&nbsp;Not Enrolled
                &nbsp; &nbsp; &nbsp;
            </div> -->
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" name="registerbtn" class="btn btn-primary">Filter</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Students
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="course.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <!-- <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Track Description" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div> -->
             <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addadminprofile">
              FILTERS
            </button>
            <?php
         
      
     $query = "";
  $cids = "";
   $sstatus = "";
      //retrieve records
  if (isset($_POST['registerbtn'])){
   
 $cids = "";
 $sstatus = "";

  $course_query = "SELECT * from course ";
   $course_query_run = mysqli_query($connection,$course_query);
    while($row = mysqli_fetch_assoc($course_query_run)){
      $cid = $row['id'];
// $rid = $_POST['$rrid'] ;
 
if(empty($_POST[$cid])) {
  
      
      } else {
$cids .= $_POST[$cid];  
        $cids .= ","; 
      }
    }
   
if($cids != "") {
    $cids = rtrim($cids,",");
      
      }
      if(empty($_POST["Enrolled"])) {
  
      
      } else {
        $sstatus .= "'";  
$sstatus .= $_POST["Enrolled"];
$sstatus .= "'"; 
        $sstatus .= ","; 
      }
    
     if(empty($_POST["Not_Enrolled"])) {
  
      
      } else {
$sstatus .= "'";  
$sstatus .= $_POST["Not_Enrolled"];
$sstatus .= "'"; 
        $sstatus .= ","; 
      }
   
if($cids != "") {
    $cids = rtrim($cids,",");
      
      }
      if($sstatus != "") {
    $sstatus = rtrim($sstatus,",");
      
      }

    $query = "SELECT stu.id as student_id, cou.id as course_id, stu.first_name, stu.middle_name, stu.last_name, stu.suffix, cou.course_code, cou.year, cou.semester, stu.student_status, stu.type FROM student stu inner join course cou on stu.course_id = cou.id";

    if($cids != "" || $sstatus != "") {
     $query .= " WHERE";
      if($cids != "" && $sstatus == ""){
        $query .= " cou.id in ($cids)";
      } else if ($cids == "" && $sstatus != "") {
        $query .= " stu.student_status in ($sstatus)";
      } else {
         $query .= " cou.id in ($cids) or stu.student_status in ($sstatus)";
      }
      }
      if($sstatus != "") {
    $sstatus = rtrim($sstatus,",");
      
      }

  } else {
    $query = "SELECT stu.id as student_id, cou.id as course_id, stu.first_name, stu.middle_name, stu.last_name, stu.suffix, cou.course_code, cou.year, cou.semester, stu.student_status, stu.type FROM student stu inner join course cou on stu.course_id = cou.id";
  }

  $_SESSION['student_list_query'] = $query;
  $_SESSION['cids'] = $cids;
  $_SESSION['sstatus'] = $sstatus;
   $query_run = mysqli_query($connection,$query);

      ?>
          </form>

    
             <button type="button" class="btn btn-primary" style="float: right;" onClick="window.open('print_student_list.php');">
              PRINT
            </button>
    
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
            <th> Student Full Name </th>
             <th> Track </th>
              <th> Grade </th>
               <th> Semester </th>
             <!-- <th> Status </th> -->
             <!--  <th>VIEW </th>
            <th>DELETE </th> -->
          </tr>
        </thead>
        <tbody>
      <?php
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
            <td> <?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix'];?></td>
             <td> <?php  echo $row['course_code']; ?></td>
               <td> <?php  echo $row['year']; ?></td>
                 <td> <?php  echo $row['semester']; ?></td>
             <!-- <td> <?php  echo $row['student_status']; ?></td> -->
           <!-- <td>
                <form action="student_edit.php" method="POST">
                    <input type="hidden" name="view_id" value="<?php echo $row['student_id']; ?>">
                     <button type="button" class="btn btn-primary view" value="<?php echo $row['student_id']; ?>"  data-toggle="modal" data-target="#addadminprofile">
              VIEW
            </button>
                </form>
            </td>
            <td>
                <form action="student_requirement_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['student_id']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-success"> UPDATE</button>
                </form>
            </td> -->
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