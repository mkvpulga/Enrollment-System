<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


   
<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Student Grades
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">

    <?php
    $num_of_failed = 0;
    if (isset($_POST['updatebtn'])){
     $student_id = $_POST['student_id'];
    
 $curriculum_id = $_POST['curriculum_id'];
 $grade_id = $_POST['grade_id'];
 $grade = $_POST['grade'];
  
  if($grade_id == ''){
$query = "INSERT INTO grade (curriculum_id,student_id,grade) VALUES ('$curriculum_id','$student_id','$grade')";

  } else {
    $query = "UPDATE grade SET grade = '$grade'where id = '$grade_id'";

  }
  
  
      $query_run = mysqli_query($connection,$query);
      if($query_run){
      
      $_SESSION['success'] = "Student Grade Updated";
    } else{
      $_SESSION['status'] = "Student Grade not Updated";
    }
  $student_id = $_POST['student_id'];
      $student_course_code = $_POST['student_course_code'];
  
  } 


  $student_id = $_SESSION["stud_req_id"];
      $student_course_code = $_SESSION["student_course_code"];
       if(isset($_POST['select_btn'])){
 $student_id = $_POST['student_id'];
  $student_course_code = $_POST['course_id'];
  }
 $course_year = 0;
     $query = "SELECT  student.*, course.year FROM  student  left join course on student.course_id = course.id where student.id = '$student_id' ";
     $query_run = mysqli_query($connection,$query);
     while($row = mysqli_fetch_assoc($query_run)){
        $course_year = $row['year'];
        }
      if(isset($_POST['grades_btn'])){
     $student_id = $_POST['student_id'];
      $student_course_code = $_POST['student_course_code'];
     }
     
     $query = "SELECT  curriculum.id as curriculum_id, subject.subject_code, subject.subject_description, subject.unit FROM  curriculum  right join course on curriculum.course_id = course.id right join subject on curriculum.subject_id = subject.id where course.id = '$student_course_code' order by course.year, course.semester";
     $query_run = mysqli_query($connection,$query);
     $divisor = 0;
     $tot_grade = 0;
     ?>
                 
          

             <!-- <button type="button" class="btn btn-primary" data-backdrop="static" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Curriculum
            </button> -->
    
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
     $query_student = "SELECT  * from student where id = '$student_id'";
     $query_student_run = mysqli_query($connection,$query_student);
     while($row_student = mysqli_fetch_assoc($query_student_run)){
    ?>
    <div class="form-group">
                <label> Student Name </label>
                <input type="hidden" name="student_id" class="form-control" value="<?php echo $row_student['id']; ?>" placeholder="Enter Student Name">
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row_student['first_name'] , " " , $row_student['middle_name'] , " " , $row_student['last_name'] , " " , $row_student['suffix']; ?>" placeholder="Enter Student Name" disabled="">
                
            </div>
            <div class="form-group">
                <label> Student Type </label>
                <input type="text" name="student_type" class="form-control" value="<?php echo  $_SESSION["stud_req_type"]; ?>" placeholder="Enter Student Type" disabled="">
                
              
            </div>
<?php
}
            ?>
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> Subject Code </th>
            <th> Subject Description </th>
            <?php
            if ($course_year>10){
              ?>
              <th> Unit </th>
            <?php
            }
            ?>
            <th> Grade </th>
            <th>Status </th>
            <th>INPUT </th>
            
          </tr>
        </thead
        >
        <tbody>
      <?php
     
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          $divisor += 1;
          $curriculum_id = $row['curriculum_id'];
       $query1 = "SELECT  * FROM  grade  where student_id = '$student_id' and curriculum_id = '$curriculum_id'";
     $query_run1 = mysqli_query($connection,$query1);
      $grade = '';
     $grade_id = '';
     $status = '';
     while($row1 = mysqli_fetch_assoc($query_run1)){
     
      $grade = $row1['grade'];
      if($grade || $grade != null || $grade != ''){
         $tot_grade += $grade;
      }
       if(!$grade || $grade == null || $grade == '' || ($grade < 75 && $grade >= 50)){
         $num_of_failed += 1;
      }
      $grade_id = $row1['id'];
      if($grade >= 75 && $grade <= 100){
              $status = 'Passed'; 
            } else if($grade < 75 && $grade >= 50){
              $status = 'Failed';
            } 
     }

          ?>
          <tr>
          <td><?php  echo $row['subject_code']; ?> </td>
            <td> <?php  echo $row['subject_description']; ?></td>
             <?php
            if ($course_year>10){
              ?>
            <td> <?php  echo $row['unit']; ?></td>
            <?php
            }
            ?>
            <td> <?php  echo $grade; ?></td>
            <td> <?php echo $status; ?></td>
              <td>
                <form action="conflicts_grades_edit.php" method="POST" >
                    <input type="hidden" name="student_course_code" value="<?php echo $student_course_code; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                    <input type="hidden" name="curriculum_id" value="<?php echo $curriculum_id; ?>">
                    <input type="hidden" name="grade_id" value="<?php echo $grade_id; ?>">
                    
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> INPUT</button>
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
     <form action="conflicts_code.php" method="POST">
       <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
     <div class="form-group">
                <label>Number of Failed Grades</label><br>
                <input type="number" name="num_of_failed" step=".01" min="50" value="<?php echo $num_of_failed ?>" max="100" readonly="true" class="form-control"  >
            </div>
              <button type="submit" name="conditionalpassbtn" style="float: right;" class="btn btn-primary"> CONDITIONAL PASS </button>
              <button type="submit" name="retainbtn" style="" class="btn btn-danger"> RETAIN </button>
  </div>
  
</div>

</div>
</form>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>