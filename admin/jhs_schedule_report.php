<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>



<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">JHS SCHEDULE REPORT
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <form action="jhs_schedule_report.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <select name="school_year" value="" class="form-control"  required="">

                <?php
      

  $query1 = "SELECT distinct(school_year) as school_year from school_year ";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
            
<option value="<?php echo $row1['school_year']; ?>"><?php echo $row1['school_year']; ?></option>
<?php 
}
}
?>
</select>
              <div class="input-group-append">
              
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
       $school_year = '';
       $query ='';
     if (isset($_POST['searchbtn'])){
   
 $school_year = $_POST['school_year'];

  

    $query = "SELECT course.course_code, course.course_description, course.year, course.semester, section.section_code, room.room_no, subject.subject_code, subject.subject_description, subject.unit, schedule.time_in, schedule.time_out, schedule.is_monday, schedule.is_tuesday, schedule.is_wednesday, schedule.is_thursday, schedule.is_friday, schedule.is_saturday from schedule left join section on  schedule.section_id = section.id left join room on schedule.room_id = room.id left join subject on schedule.subject_id = subject.id left join curriculum on subject.id = curriculum.subject_id left join school_year on curriculum.id = school_year.curriculum_id left join course on curriculum.course_id = course.id where school_year.school_year = '$school_year' and school_year.status = 'OPEN' and course.year <= 10";


  } else {
    $query = "SELECT course.course_code, course.course_description, course.year, course.semester, section.section_code, room.room_no, subject.subject_code, subject.subject_description, subject.unit, schedule.time_in, schedule.time_out, schedule.is_monday, schedule.is_tuesday, schedule.is_wednesday, schedule.is_thursday, schedule.is_friday, schedule.is_saturday from schedule left join section on  schedule.section_id = section.id left join room on schedule.room_id = room.id left join subject on schedule.subject_id = subject.id left join curriculum on subject.id = curriculum.subject_id left join school_year on curriculum.id = school_year.curriculum_id left join course on curriculum.course_id = course.id where  school_year.status = 'OPEN' and course.year > 10 limit 0 ";
  }
      //retrieve records
  
  $_SESSION['jhs_query'] = $query;
  $_SESSION['school_year'] = $school_year;
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

    
             <button type="button" class="btn btn-primary" style="float: right;" onClick="window.open('print_jhs_schedule_report.php');">
              PRINT
            </button>
    
  </div>

  <div class="card-body">
<?php
    if($school_year!=''){
    ?>
    <input type="text" name="school_year" class="form-control" value="<?php  echo $school_year; ?>"  disabled="">
    <?php
  }
    ?>
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
             <th> Grade Level </th>
              <th> Section </th>
            <th> Room </th>
             <th> Subject Code </th>
              <th> Subject Description </th>
              <th> Time </th>
           <th> Day </th>
            
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
              <td> <?php  echo $row['year']; ?></td>
               <td> <?php  echo $row['section_code']; ?></td>
                <td> <?php  echo $row['room_no'];?></td>
             <td> <?php  echo $row['subject_code']; ?></td>
              <td> <?php  echo $row['subject_description']; ?></td>
              <td> <?php  echo date('h:i a' , strtotime($row['time_in'])) . ' - ' . date('h:i a' , strtotime($row['time_out'])); ?></td>
               <td> <?php  
            $day = "";
            if ($row['is_monday'] == 1) {
              $day .= "M";
            }
            if ($row['is_tuesday'] == 1) {
              $day .= "T";
            }
            if ($row['is_wednesday'] == 1) {
              $day .= "W";
            }
            if ($row['is_thursday'] == 1) {
              $day .= "Th";
            }
            if ($row['is_friday'] == 1) {
              $day .= "F";
            }
            if ($row['is_saturday'] == 1) {
              $day .= "S";
            }
            echo $day; ?></td>
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