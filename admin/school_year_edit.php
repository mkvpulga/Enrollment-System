<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
   <h6 class="m-0 font-weight-bold text-primary"> School Year
            
    </h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <form   action="school_year_edit.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <script type="text/javascript">
        function validateForm() {
  var school_year_start = document.forms["myForm"]["edit_school_year_start"].value;
  var school_year_end = document.forms["myForm"]["edit_school_year_end"].value;
 console.log(school_year_start);
  console.log(school_year_end);

  if (school_year_start > school_year_end) {
    alert("School Year Start must be less than School Year End");
    return false;
  }
  
}
function schoolYear(e,eto){
                  if (eto.value.length == 4 ) {
    var key = e.keyCode;
      
      if (((key == 8) || (key == 32) || (key == 9))) {
        return true;
        
      } else {
        return false;
      }
    } else {
    return true;
     

    }
 
  }
      </script>
        <?php
       $id="";
       $subject_id = "";
       $subject_description = "";
       
  if(isset($_POST['edit_btn']) ){
     $id = $_POST['edit_id'];
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
     }

     ?>
      
            <?php
         
      
     
      //retrieve records
  
 
    $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur inner join course cou on cur.course_id = cou.id inner join subject sub on cur.subject_id = sub.id where cur.id = '$id'";
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
            <th> Grade </th>
            <th>Semester </th>
            <th>Subject Code</th>
            <th>Subject Description</th>
            <th>Unit </th>
            
          </tr>
        </thead>
        <tbody>
      <?php
      
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
             <td> <?php  echo $row['course_code']; ?></td>
            <td> <?php  echo $row['course_description']; ?></td>
            <td> <?php  echo $row['year']; ?></td>
            <td> <?php  echo $row['semester']; ?></td>
            <td> <?php  echo $row['subject_code']; ?> </td>
            <td> <?php  echo $row['subject_description']; ?> </td>
            <td> <?php  echo $row['unit']; ?> </td>
           
            
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
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
     }

     
      


    $query1 = "SELECT * FROM curriculum where id = '$id'";
    $query_run1 = mysqli_query($connection,$query1);
    $course_query = "SELECT * FROM course where id = '$course_id'";
    $course_query_run = mysqli_query($connection,$course_query);
 if(mysqli_num_rows($query_run1) > 0){
      
    foreach ($course_query_run as $row1) {
      $school_year ="";
      $status = "";
     $query2 = "SELECT * FROM school_year where curriculum_id = '$id'";
    $query_run2 = mysqli_query($connection,$query2);
    foreach ($query_run2 as $row2) {
      $school_year =$row2['school_year'];
      $status = $row2['status'];
    }
    ?>
    <form name="myForm" onsubmit="return validateForm()" action="school_year_code.php" method="POST">
      
         <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
         <input type="hidden" name="edit_course_id" value="<?php echo $row1['id']?>" >
         <!--   <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">School Year</h6>
                 </div>
                  <div class="col-5"> -->
               <input type="hidden" id="edit_school_year_start" min="1980" onkeydown='return schoolYear(event,this)' name="edit_school_year_start" value="<?php echo substr($school_year, 0, 4); ?>"  class="form-control"  >
                <!--  </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5"> -->
               <input type="hidden" id="edit_school_year_end" min="1980" onkeydown='return schoolYear(event,this)' name="edit_school_year_end" value="<?php echo substr($school_year, -4); ?>"  class="form-control"  >
                <!--   <div style="height:5px"></div>
            </div>

            </div> -->
           
            <div class="form-group">
                <label>Status</label>
                <select name="edit_status" class="form-control" value="<?php echo $status?>">
                      <?php
                     
        if ($status == 'CLOSE') {
        echo "<option value='OPEN'>OPEN</option>";
        echo "<option value='CLOSE' selected>CLOSE</option>";
    } else {
        echo "<option value='OPEN' selected>OPEN</option>";
        echo "<option value='CLOSE'>CLOSE</option>";
    }
    ?>  
</select>
</div>
        
    
            <a href ="school_year.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> UPDATE </button>
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