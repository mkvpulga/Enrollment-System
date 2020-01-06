<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php');
include_once 'includes/connection.php';  
?>




<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Other Information
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  
            <?php
         
      
     
      //retrieve records
  
    $user_id = $_SESSION['user_id'];
    if($_SESSION['designation']=='Student'){
     $query1 = "SELECT * FROM student where user_master_id = '$user_id'";
    } else {
       $query1 = "SELECT * FROM employee where user_master_id = '$user_id'";
    }
  $query_run1 = mysqli_query($connection,$query1);

      if(mysqli_num_rows($query_run1) > 0){
        while($row = mysqli_fetch_assoc($query_run1)){
          $id = $row['id'];
        }
      }
if($_SESSION['designation']=='Student'){
    $query = "SELECT student.*, course.course_code, course.course_description, course.year, course.semester FROM student left join course on student.course_id = course.id  where student.id = '$id'";
  } else {
     $query = "SELECT * FROM employee   where id = '$id'";
  }
  $query_run = mysqli_query($connection,$query);
  
      ?>
       
  <form action="information_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> Update Info</button>
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
       
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
       		?>
     			<tr>
            <th> Ful Name </th>
            <td> <?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?></td>           
          </tr>
          <?php
          if($_SESSION['designation']=='Student'){
          ?>
            <tr>
            <th> Course </th>
            <td> <?php  echo $row['course_code'] , " (Year: " , $row['year'] , ", Semester: " , $row['semester'] , ")";?></td>          
          </tr>
          <?php
        }
          ?>
          <tr>
            <th> Date Of Birth </th>
            <td> <?php  echo $row['birth_date'] ;?></td>          
          </tr>
           <tr>
            <th> Contact Number </th>
            <td> <?php  echo $row['contact_number'] ;?></td>          
          </tr>
           <tr>
            <th> Address </th>
            <td> <?php  echo $row['address'] ;?></td>          
          </tr>
           <tr>
            <th> Father's Name </th>
            <td> <?php  echo $row['fathers_name'] ;?></td>          
          </tr>
            <tr>
            <th> Father's Contact </th>
            <td> <?php  echo $row['fathers_contact'] ;?></td>          
          </tr>
          <tr>
            <th> Father's Address </th>
            <td> <?php  echo $row['fathers_address'] ;?></td>          
          </tr>
           <tr>
            <th> Mother's Name </th>
            <td> <?php  echo $row['mothers_name'] ;?></td>          
          </tr>
            <tr>
            <th> Mother's Contact </th>
            <td> <?php  echo $row['mothers_contact'] ;?></td>          
          </tr>
          <tr>
            <th> Mother's Address </th>
            <td> <?php  echo $row['mothers_address'] ;?></td>          
          </tr>
           <tr>
            <th> Guardian's Name </th>
            <td> <?php  echo $row['guardians_name'] ;?></td>          
          </tr>
            <tr>
            <th> Guardian's Contact </th>
            <td> <?php  echo $row['guardians_contact'] ;?></td>          
          </tr>
          <tr>
            <th> Guardian's Address </th>
            <td> <?php  echo $row['guardians_address'] ;?></td>          
          </tr>
          <tr>
            <th> Primary School </th>
            <td> <?php  echo $row['primary_school'] ;?></td>          
          </tr>
          <tr>
            <th> Primary School Year Start </th>
            <td> <?php  echo $row['primary_year_start'] ;?></td>          
          </tr>
          <tr>
            <th> Primary School Year End </th>
            <td> <?php  echo $row['primary_year_end'] ;?></td>          
          </tr>
          <tr>
            <th> Primary School Address</th>
            <td> <?php  echo $row['primary_address'] ;?></td>          
          </tr>
           <tr>
            <th> Secondary School </th>
            <td> <?php  echo $row['secondary_school'] ;?></td>          
          </tr>
          <tr>
            <th> Secondary School Year Start </th>
            <td> <?php  echo $row['secondary_year_start'] ;?></td>          
          </tr>
          <tr>
            <th> Secondary School Year End </th>
            <td> <?php  echo $row['secondary_year_end'] ;?></td>          
          </tr>
          <tr>
            <th> Secondary School Address</th>
            <td> <?php  echo $row['secondary_address'] ;?></td>          
          </tr>
           <!-- <tr>
            <th> Tertiary School </th>
            <td> <?php  echo $row['tertiary_school'] ;?></td>          
          </tr>
          <tr>
            <th> Tertiary School Year Start </th>
            <td> <?php  echo $row['tertiary_year_start'] ;?></td>          
          </tr>
          <tr>
            <th> Tertiary School Year End </th>
            <td> <?php  echo $row['tertiary_year_end'] ;?></td>          
          </tr>
          <tr>
            <th> Tertiary School Address</th>
            <td> <?php  echo $row['tertiary_address'] ;?></td>          
          </tr> -->
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