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
     <h6 class="m-0 font-weight-bold text-primary"> INPUT Student Grades
            
    </h6>
  </div>

  <div class="card-body">
    <?php
    
    if(isset($_POST['edit_btn'])){
      $student_id = $_POST['student_id'];
 $curriculum_id = $_POST['curriculum_id'];
 $grade_id = $_POST['grade_id'];
$student_course_code = $_POST['student_course_code'];
$course_year = 0;
      $query = "SELECT  curriculum.id as curriculum_id, subject.subject_code, subject.subject_description, subject.unit, course.year FROM  curriculum  right join course on curriculum.course_id = course.id right join subject on curriculum.subject_id = subject.id where curriculum.id = '$curriculum_id' order by course.year, course.semester";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    $course_year = $row['year'];
    ?>
    <form action="conflicts.php" method="POST">
         <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
         <input type="hidden" name="curriculum_id" value="<?php echo $curriculum_id; ?>">
         <input type="hidden" name="grade_id" value="<?php echo $grade_id; ?>">
         <input type="hidden" name="student_course_code" value="<?php echo $student_course_code; ?>">
         
           <div class="form-group">
                <label> Subject Code </label>
  
                <input type="text" name="subject_code" value="<?php echo $row['subject_code']?>" class="form-control" placeholder="Enter Subject Code" readonly="">
            </div>
          
           <div class="form-group">
                <label> Subject Description </label>
                <input type="text" name="subject_description" value="<?php echo $row['subject_description']?>" class="form-control" placeholder="Enter Subject Description" readonly="">
            </div>
             <?php
            if ($course_year>10){
              ?>
            
           <div class="form-group">
                <label> Unit </label>
                <input type="text" name="unit" value="<?php echo $row['unit']?>" class="form-control" placeholder="Enter Unit" readonly="">
            </div>
             <?php
            }
            ?>
             <div class="form-group">
                <label> Grade </label>
                <?php
$query1 = "SELECT  * FROM  grade  where id = '$grade_id' ";
     $query_run1 = mysqli_query($connection,$query1);
    
      if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
        
                ?>
                <input type="number" name="grade" value="<?php echo $row1['grade']?>" class="form-control" placeholder="Enter Grade" >
                <?php
              }
} else {
                ?>
                <input type="number" name="grade" class="form-control" placeholder="Enter Grade" >
            </div>
            <?php
}
            ?>
            <button type="submit" name="updatebtn" style="float: right;" class="btn btn-primary"> INPUT </button>
          </form>
           <form action="conflicts.php" method="post">
                  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                  <input type="hidden" name="student_course_code" value="<?php echo $student_course_code; ?>">
                  <button type="submit" name="grades_btn" class="btn btn-danger"> BACK</button>
                </form>
            <?php
        }
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