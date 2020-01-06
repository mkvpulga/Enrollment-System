<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
   <h6 class="m-0 font-weight-bold text-primary"> Unit fee
            
    </h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <form action="unit_fee_edit.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <?php
       $id="";
       $subject_id = "";
       $subject_description = "";
       
  if(isset($_POST['edit_btn']) || isset($_POST['get_course_btn']) || isset($_POST['searchbtn'])){
     $id = $_POST['edit_id'];
      // $subject_id = $_POST['edit_subject_id'];
      // $subject_description = $_POST['edit_subject_description'];
     }

     ?>
      <input type="hidden" name="get_course_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $subject_id; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $subject_description; ?>">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Track Description" aria-label="Search" aria-describedby="basic-addon2">
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
    $query = "SELECT * FROM course where course_description like  '$search_params%'";
  } else {
    $query = "SELECT * FROM course";
  }
  $query_run = mysqli_query($connection,$query);
 

      ?>
        
          </form>

          

  </div>

  <div class="card-body">
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Track Code </th>
            <th> Track Description </th>
            <th>Grade </th>
            <th>Semester</th>
            <th>Actions </th>
            
          </tr>
        </thead>
        <tbody>
      <?php
       $id="";
       $subject_id = "";
       $subject_description = "";
       
  if(isset($_POST['edit_btn']) || isset($_POST['get_course_btn']) || isset($_POST['searchbtn'])){
     $id = $_POST['edit_id'];
      // $subject_id = $_POST['edit_subject_id'];
      // $subject_description = $_POST['edit_subject_description'];
     }
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
            <td> <?php  echo $row['course_code']; ?></td>
            <td> <?php  echo $row['course_description']; ?></td>
            <td> <?php  echo $row['year']; ?></td>
            <td> <?php  echo $row['semester']; ?> </td>
            <td>
                <form action="unit_fee_edit.php" method="POST">
                    <input type="hidden" name="get_course_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $subject_id; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $subject_description; ?>">
                    <button  type="submit" name="get_course_btn" class="btn btn-primary"> SELECT</button>
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
    
  

  <div class="card-body">
    <?php
    
      $id ="";
     $course_id="";     
     $subject_id="";
     $subject_description="";
     if(isset($_POST['edit_btn'])){
     $id = $_POST['edit_id'];
      $course_id = $_POST['edit_course_id'];
      $amount_per_unit = $_POST['edit_amount_per_unit'];
      $subject_description = $_POST['edit_subject_description'];
     }

     
      if(isset($_POST['get_course_btn'])){
     $course_id = $_POST['get_course_id'];
     
     $id = $_POST['edit_id'];
 $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
    }



    $query1 = "SELECT * FROM unit_fee where id = '$id'";
    $query_run1 = mysqli_query($connection,$query1);
    $course_query = "SELECT * FROM course where id = '$course_id'";
    $course_query_run = mysqli_query($connection,$course_query);
 if(mysqli_num_rows($query_run1) > 0){
      
    foreach ($course_query_run as $row1) {
     
    
    ?>
    <form action="unit_fee_code.php" method="POST">
      
         <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
         <input type="hidden" name="edit_course_id" value="<?php echo $row1['id']?>" >
             
<div class="form-group">
                <label> Track Code </label>
                <input type="text" name="edit_course_code" value="<?php echo $row1['course_code']?>" readonly="true"  class="form-control" placeholder="Enter Unit fee Code">
            </div>
            <div class="form-group">
                <label>Track Description</label>
                <input type="text" name="edit_course_description" value="<?php echo $row1['course_description']?>" readonly="true" class="form-control" placeholder="Enter Unit fee Description">
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="number" name="edit_year" value="<?php echo $row1['year']?>" readonly="true"  class="form-control" placeholder="Enter Grade">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="edit_semester" value="<?php echo $row1['semester']?>" readonly="true"  class="form-control" placeholder="Enter Semester">
            </div>
                    <div class="form-group">
               <label>Amount Per Unit</label>
                <input type="number" name="edit_amount_per_unit" value="<?php echo $amount_per_unit; ?>" class="form-control" placeholder="Enter Amount Per Unit" step=".01" >
               
            </div>
    
            <a href ="unit_fee.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> UPDATE </button>
          </form> 
            <?php
          }

    }else {
         
     foreach ($course_query_run as $row1) {
    
    ?>
    <form action="unit_fee_code.php" method="POST">
      
         <input type="hidden" name="edit_course_id" value="<?php echo $row1['id']?>" >
             
<div class="form-group">
                <label> Track Code </label>
                <input type="text" name="edit_course_code" value="<?php echo $row1['course_code']?>" readonly="true" class="form-control" placeholder="Enter Unit fee Code">
            </div>
            <div class="form-group">
                <label>Track Description</label>
                <input type="text" name="edit_course_description" value="<?php echo $row1['course_description']?>" readonly="true"  class="form-control" placeholder="Enter Unit fee Description">
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="number" name="edit_year" value="<?php echo $row1['year']?>"  class="form-control" readonly="true" placeholder="Enter Grade">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="edit_semester" value="<?php echo $row1['semester']?>" readonly="true" class="form-control" placeholder="Enter Semester">
            </div>
            <div class="form-group">
                <label>Amount Per Unit</label>
                <input type="number" name="edit_amount_per_unit"  class="form-control" placeholder="Enter Amount Per Unit" step=".01" >
            </div>
            <a href ="unit_fee.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="savebtn" class="btn btn-primary"> SAVE </button>
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