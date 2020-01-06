<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>



<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Conflicts Students
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="conflicts_search.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
   //$_POST['student_description'] = "gago";
    $query = "SELECT student.*, course.id as course_id, course.course_code, course.course_description, course.year, course.semester FROM student left join course on student.course_id = course.id WHERE CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%$search_params%' and student.student_status <> 'Enrolled' and student.type = 'Old Student'";
  } else {
    $query = "SELECT student.*, course.id as course_id, course.course_code, course.course_description, course.year, course.semester FROM student left join course on student.course_id = course.id limit 0";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

    
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
             <th> Type </th>
             
            <th>SELECT </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
            <td> <span id="fullname"><?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; 
            ?></span></td>
             <td> <?php  echo $row['course_code']; ?></td>
             <td> <?php  echo $row['year']; ?></td>
                <td> <?php  echo $row['semester']; ?></td>
             <td> <span id="type"><?php  echo $row['type']; 
             $_SESSION["sname"] = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['suffix']; 
             
             ?></span></td>
          
             <td>
                <form action="clearance_create.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
                  <button type="submit" name="select_btn" class="btn btn-success"> SELECT</button>
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