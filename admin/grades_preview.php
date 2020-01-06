<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>

<?php
     $student_id = $_SESSION["student_id"];
      $query = "SELECT student.*, course.course_code, course.course_description, course.year, course.semester, section.section_code, section.section_description FROM student left join course on student.course_id = course.id left join assignment_section on student.id = assignment_section.student_id left join section on assignment_section.section_id = section.id where student.id = '$student_id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {

    
    ?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Student Information
            
    </h6>
  </div>

  <div class="card-body">
    
   

      <!--Section: Not enough-->
      <section>


        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-6">
  
 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Student Name </h6>
               
                 <input type="text" name="student_name" class="form-control" value="<?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?>" disabled="">
                 <div style="height:5px"></div>
                </div>

            </div>

<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Grade Level</h6>
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['year']; ?>" disabled=""> 
  <div style="height:5px"></div>
</div>
              
                </div>

                <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Section</h6>
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['section_code']; ?>"  disabled=""> 
  <div style="height:5px"></div>
</div>
              
                </div>
            </div>
            <?php
            if($row['course_code']!=''){
            ?>
 <div class="col-md-6">
   <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Course</h6>
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['course_code']; ?>"  disabled=""> 
  <div style="height:5px"></div>
</div>
              
                </div>
 
 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Semester</h6>
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['semester']; ?>"  disabled=""> 
  <div style="height:5px"></div>
</div>
              
                </div>
            </div>
            <?php
          }
            ?>
            </div>
</section>
          </div>
       
     
    </div>
</div>

<?php
}
?>


<div class="container-fluid">


<?php

if (isset($_POST['enrollbtn'])){
     $student_id = $_SESSION['student_id'];
    

    $query = " UPDATE student SET  student_status = 'Enrolled' where id = '$student_id'"; 
     $query_run = mysqli_query($connection,$query);
  

   
   //  header('Location: student_requirement.php');
      // $_SESSION['status'] = $rid ;
  if($query_run){
     echo "<script type='text/javascript'>
      
window.location='grades_preview.php';
alert('You are now enrolled');
</script>";
      // header('Location: evaluation.php');
  
      
    } else{
      echo "<script type='text/javascript'>
      
window.location='grades_preview.php';
alert('The Student Failed');
</script>";
    }
  }

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">Student Clearance
</h6>
    <?php
      $student_id = $_SESSION['student_id'];
     $student_course_code = $_SESSION['course_id'];
     
     $query = "SELECT  * from clearance";
     $query_run = mysqli_query($connection,$query);
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

    ?>
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> Clearance Name </th>
          <th>Status </th>
             <th>Feedback </th>
          </tr>
        </thead
        >
        <tbody>
      <?php
     
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          $clearance_id = $row['id'];
       $query1 = "SELECT * from student_clearance where clearance_id =  '$clearance_id' and student_id =  '$student_id'";
     $query_run1 = mysqli_query($connection,$query1);
    
     $status = '';
      $feedback = 'See Registrar';
  if(mysqli_num_rows($query_run1) > 0){
      $status = 'Passed';
      $feedback = '';
  }
    

          ?>
          <tr>
          <td><?php  echo $row['clearance_name']; ?> </td>
            <td> <?php echo $status; ?></td>
             <td style="color: red"> <?php echo $feedback; ?></td>
           
          </tr>

        <?php
      // }
         }
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

<!-- GRADES SECTION -->
<div class="container-fluid">


<?php

if (isset($_POST['enrollbtn'])){
     $student_id = $_SESSION['student_id'];
    

    $query = " UPDATE student SET  student_status = 'Enrolled' where id = '$student_id'"; 
     $query_run = mysqli_query($connection,$query);
  

   
   //  header('Location: student_requirement.php');
      // $_SESSION['status'] = $rid ;
  if($query_run){
     echo "<script type='text/javascript'>
      
window.location='grades_preview.php';
alert('You are now enrolled');
</script>";
      // header('Location: evaluation.php');
  
      
    } else{
      echo "<script type='text/javascript'>
      
window.location='grades_preview.php';
alert('The Student Failed');
</script>";
    }
  }

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">Student Grades
</h6>
    <?php
      $student_id = $_SESSION['student_id'];
     $student_course_code = $_SESSION['course_id'];
     
      $course_year = 0;
     $query = "SELECT  student.*, course.year FROM  student  left join course on student.course_id = course.id where student.id = '$student_id' ";
     $query_run = mysqli_query($connection,$query);
     while($row = mysqli_fetch_assoc($query_run)){
        $course_year = $row['year'];
        }
     $query = "SELECT  curriculum.id as curriculum_id, subject.subject_code, subject.subject_description, subject.unit FROM  curriculum  right join course on curriculum.course_id = course.id right join subject on curriculum.subject_id = subject.id where course.id = '$student_course_code' order by course.year, course.semester";
     $query_run = mysqli_query($connection,$query);
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
             <th>Feedback </th>
          </tr>
        </thead
        >
        <tbody>
     	<?php
     
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
          $curriculum_id = $row['curriculum_id'];
       $query1 = "SELECT  * FROM  grade  where student_id = '$student_id' and curriculum_id = '$curriculum_id'";
     $query_run1 = mysqli_query($connection,$query1);
      $grade = '';
     $grade_id = '';
     $status = '';
      $feedback = 'See Registrar';
  
     while($row1 = mysqli_fetch_assoc($query_run1)){
      $grade = $row1['grade'];
      $grade_id = $row1['id'];
   
      if($grade >= 75 && $grade <= 100){
              $status = 'Passed'; 
               $feedback = '';
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
            <td<?php if($status == 'Failed'): ?> style="color:red;" <?php endif; ?>> <?php  echo $grade; ?></td>
            <td<?php if($status == 'Failed'): ?> style="color:red;" <?php endif; ?>> <?php echo $status; ?></td>
             <td style="color: red"> <?php echo $feedback; ?></td>
           
          </tr>

        <?php
      // }
         }
     	} else {
     	echo "No Record Found";
     }

     	?>
          
        
        </tbody>
      </table>


      <form action="grades_preview.php" method="POST">
<?php
 $student_id = $_SESSION['student_id'];
  $student_course_code = $_SESSION['course_id'];
  $student_type = $_SESSION['student_type'];
      $divisor = 0;
      $tot_grade = 0;
      $query = "SELECT  curriculum.id as curriculum_id, subject.subject_code, subject.subject_description, subject.unit FROM  curriculum  right join course on curriculum.course_id = course.id right join subject on curriculum.subject_id = subject.id where course.id = '$student_course_code' order by course.year, course.semester";
     $query_run = mysqli_query($connection,$query);
         while($row = mysqli_fetch_assoc($query_run)){
          $divisor += 1;
          $curriculum_id = $row['curriculum_id'];
       $query1 = "SELECT  * FROM  grade  where student_id = '$student_id' and curriculum_id = '$curriculum_id'";
     $query_run1 = mysqli_query($connection,$query1);
    
     while($row1 = mysqli_fetch_assoc($query_run1)){
      $tot_grade += $row1['grade'];
     
     }
   }
     $average_grade = $tot_grade / $divisor;

     //clearance
     $tot_clearance = 0;
     $stud_clearance = 0;
      $query_clearance = "SELECT * from clearance";
  
  $query_clearance_run = mysqli_query($connection,$query_clearance);
    while($row_clearance = mysqli_fetch_assoc($query_clearance_run)){
     $tot_clearance += 1;
     }
       $query1_clearance = "SELECT * from student_clearance where  student_id =  '$student_id'";
  
  $query_clearance_run1 = mysqli_query($connection,$query1_clearance);
  while($row_clearance1 = mysqli_fetch_assoc($query_clearance_run1)){
     $stud_clearance += 1;
     }



     //requirement
     $tot_requirement = 0;
     $stud_requirement = 0;
     
    $query_requirement = "SELECT * from requirement where type =  '$student_type'";
  
  $query_requirement_run = mysqli_query($connection,$query_requirement);
    while($row_requirement = mysqli_fetch_assoc($query_requirement_run)){
      $tot_requirement += 1;
     }
       $query1_requirement = "SELECT student_requirement.* from student_requirement left join requirement on student_requirement.requirement_id = requirement.id where requirement.type =  '$student_type' and student_requirement.student_id =  '$student_id'";
  
  $query_requirement_run1 = mysqli_query($connection,$query1_requirement);
  while($row_requirement1 = mysqli_fetch_assoc($query_requirement_run1)){
      $stud_requirement += 1;
     }

if($average_grade>=75 && $tot_clearance == $stud_clearance){
   
     
     ?>

<button type="submit" style="float: right;"  name="enrollbtn" class="btn btn-primary"> ENROLL </button>
       <?php
     } else {
     ?>
     <button type="submit" disabled="" style="float: right;" name="enrollbtn" class="btn btn-secondary"> ENROLL</button>
<?php
}
?>
</form>
 <label> Total average: <?php echo $average_grade; ?> </label>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->










<?php
include('includes/scripts.php');
include('includes/footer.php');
?>