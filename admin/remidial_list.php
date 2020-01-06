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
            <div class="form-group">
                <label>Student Status</label><br>
                <input type="checkbox" name="Enrolled" value="ENROLLED" >&nbsp;Enrolled
                &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="Not_Enrolled" value="NOT ENROLLED" >&nbsp;Not Enrolled
                &nbsp; &nbsp; &nbsp;
            </div>
          
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
<h6 class="m-0 font-weight-bold text-primary">Remidial Students
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    
  <?php
         
     
    $query = "SELECT stu.id as student_id, cou.id as course_id, stu.first_name, stu.middle_name, stu.last_name, stu.suffix, cou.course_code,cou.course_description,cou.semester, cou.year, stu.student_status, stu.type, section.section_code, section.section_description, stu.address, stu.contact_number FROM conditional_pass left join student stu on conditional_pass.student_id = stu.id left join course cou on stu.course_id = cou.id left join assignment_section on stu.id = assignment_section.student_id left join section on assignment_section.section_id = section.id ";
 
      //retrieve records
  
  $_SESSION['remidial_list_query'] = $query;
  $query_run = mysqli_query($connection,$query);
      ?>
    
             <button type="button" class="btn btn-primary" style="float: right;" onClick="window.open('print_remidial_list.php');">
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
             <th> Address </th>
              <th> Contact Number </th>
             <th> Status </th>
            
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
             <td> <?php  echo $row['address']; ?></td>
              <td> <?php  echo $row['contact_number']; ?></td>
             <td> <?php  echo 'Remidial'; ?></td>
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