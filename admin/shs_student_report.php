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
<h6 class="m-0 font-weight-bold text-primary">SHS STUDENT REPORT
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <form action="shs_student_report.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
             <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Student Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
              
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         $search_params = "";
           $student_name = "";
            $grade_level = "";
            $course_code = "";
            $semester = "";
             $section_code = "";
     if (isset($_POST['searchbtn'])){
   
   
      $search_params = $_POST['search_params'];
      if($search_params==""){
$query = "SELECT student.first_name, student.middle_name, student.last_name, student.suffix, sch.id as schedule_id, sec.section_code, sub.subject_code, sub.subject_description, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday, sub.unit, course.year,course.course_code,course.semester FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id left join section on sch.section_id = section.id left join assignment_section on section.id = assignment_section.section_id left join student on assignment_section.student_id = student.id left join course on student.course_id = course.id limit 0";
      }else {
        $query = "SELECT student.first_name, student.middle_name, student.last_name, student.suffix, sch.id as schedule_id, sec.section_code, sub.subject_code, sub.subject_description, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday, sub.unit, course.year,course.course_code,course.semester FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id left join section on sch.section_id = section.id left join assignment_section on section.id = assignment_section.section_id left join student on assignment_section.student_id = student.id left join course on student.course_id = course.id where  student.student_status = 'Enrolled' and CONCAT(student.first_name, ' ', student.middle_name, ' ', student.last_name) LIKE '%$search_params%' and course.year > 10 ";
      }
  

    


  } else {
    $query = "SELECT student.first_name, student.middle_name, student.last_name, student.suffix, sch.id as schedule_id, sec.section_code, sub.subject_code, sub.subject_description, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday, sub.unit,course.year,course.course_code,course.semester FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id left join section on sch.section_id = section.id left join assignment_section on section.id = assignment_section.section_id left join student on assignment_section.student_id = student.id left join course on student.course_id = course.id limit 0";
  }
  $query_run = mysqli_query($connection,$query);
      //retrieve records
   while($row = mysqli_fetch_assoc($query_run)){
    $student_name = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . " " . $row['suffix'];
    $grade_level = $row['year'];
     $course_code = $row['course_code'];
      $semester = $row['semester'];
       $section_code = $row['section_code'];
   }
 
   $_SESSION['shs_query'] = $query;
  $_SESSION['student_name'] = $student_name;  
  $_SESSION['grade_level'] = $grade_level;
  $_SESSION['course_code'] = $course_code;
  $_SESSION['semester'] = $semester;
  $_SESSION['section_code'] = $section_code;
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

    
             <button type="button" class="btn btn-primary" style="float: right;" onClick="window.open('print_shs_student_report.php');">
              PRINT
            </button>
    
  </div>

  <div class="card-body">
    <?php
    if($student_name!=''){
    ?>
     <div class="row">
             
              <div class="col-6">
                <h6 class="feature-title">Student Name <span style="color: red"> *</span></h6>
                  <input type="text" name="student_name" class="form-control" value="<?php  echo $student_name; ?>"  disabled="">
                <div style="height:5px"></div>
              </div>

<div class="col-6">
                <h6 class="feature-title">Grade Level <span style="color: red"> *</span></h6>
                  <input type="text" name="grade_level" class="form-control" value="<?php  echo $grade_level; ?>"  disabled="">
                <div style="height:5px"></div>
              </div>

            </div>
              <?php
            }
            ?>
             <?php
    if($course_code!=''){
    ?>
     <div class="row">
             
              <div class="col-6">
                <h6 class="feature-title">Course <span style="color: red"> *</span></h6>
                  <input type="text" name="student_name" class="form-control" value="<?php  echo $course_code; ?>"  disabled="">
                <div style="height:5px"></div>
              </div>

<div class="col-6">
                <h6 class="feature-title">Semester <span style="color: red"> *</span></h6>
                  <input type="text" name="grade_level" class="form-control" value="<?php  echo $semester; ?>"  disabled="">
                <div style="height:5px"></div>
              </div>

            </div>
              <?php
            }
            ?>
             <?php
    if($section_code!=''){
    ?>
     <div class="row">
             
              <div class="col-6">
                <h6 class="feature-title">Section <span style="color: red"> *</span></h6>
                  <input type="text" name="student_name" class="form-control" value="<?php  echo $section_code; ?>"  disabled="">
                <div style="height:5px"></div>
              </div>


            </div>
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
           <th> Section Code </th>
            <th> Subject Code </th>
            <th> Unit </th>
           
            <th> Day </th>
            <th> Time </th>
            
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
           <td> <?php  echo $row['section_code']; ?></td>
            <td> <?php  echo $row['subject_code']; ?></td>
            <td> <?php  echo $row['unit']; ?></td>
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
            <td> <?php  echo date('h:i a' , strtotime($row['time_in'])) . ' - ' . date('h:i a' , strtotime($row['time_out'])); ?></td>
           
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