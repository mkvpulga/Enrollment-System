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

     <form action="student_grades.php" method="POST"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Student Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT student.*, course.id as course_id, course.course_code, course.course_description, course.year, course.semester FROM student inner join course on student.course_id = course.id where student.first_name like  '$search_params%' or student.middle_name like  '$search_params%' or student.last_name like  '$search_params%' ";
  } else {
    $query = "SELECT student.*, course.id as course_id, course.course_code, course.course_description, course.year, course.semester FROM student inner join course on student.course_id = course.id";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>
          

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
              <th> Student Full Name </th>
            <th> Track Code </th>
            <th> Track Description </th>
            <th> Grade </th>
            <th>Semester </th>
            <th>SELECT </th>
            
          </tr>
        </thead
        >
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
    
     			?>
     			<tr>
          <td> <?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; 
            ?></td>
            <td> <?php  echo $row['course_code']; ?></td>
            <td> <?php  echo $row['course_description']; ?></td>
            <td> <?php  echo $row['year']; ?></td>
            <td> <?php  echo $row['semester']; ?></td>
              <td>
                <form action="student_grades_grades.php" method="POST" >
                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                   <input type="hidden" name="student_course_code" value="<?php echo $row['course_id']; ?>">
                   
                    <button  type="submit" name="grades_btn" class="btn btn-primary"> SELECT</button>
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
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>