<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
   <h6 class="m-0 font-weight-bold text-primary"> Curriculum
            
    </h6>
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    
    <!-- <div class="card-body"> -->
  
    <form action="curriculum_code.php" method="POST">
      
         
             
<?php
$grade="";
$id ="";
$subject_id="";
$subject_description ="";
if(isset($_POST['edit_btn'])){
     $id = $_POST['edit_id'];
     $grade = $_POST['edit_grade'];
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
     }
?>
<input type="hidden" name="edit_id" value="<?php echo $id;?>" >
<div class="form-group">
                <label> Grade </label>
                                 <select name="grade" value="" onchange="selectGrade(this)" class="form-control"  required="">
<option value="" <?php if($grade==""){echo 'selected';}?>></option>
<?php
if($_SESSION['is_junior']==true){
?>
<option value="7" <?php if($grade==7){echo 'selected';}?>>7</option>
<option value="8" <?php if($grade==8){echo 'selected';}?>>8</option>
<option value="9" <?php if($grade==9){echo 'selected';}?>>9</option>
<option value="10" <?php if($grade==10){echo 'selected';}?>>10</option>
<?php
}
if($_SESSION['is_senior']==true){
?>
<option value="11" <?php if($grade==11){echo 'selected';}?>>11</option>
<option value="12" <?php if($grade==12){echo 'selected';}?>>12</option>
<?php
}
?>

</select>
            </div>
          <script type="text/javascript">
  function selectGrade(type) {
  var x = document.getElementById("codeDiv");
  var y = type.value;
 var z = document.getElementById("semDiv");
  
  if (y  > 10 ) {
    x.style.display = "block";
    z.style.display = "block";
  }  else {
    x.style.display = "none";
    z.style.display = "none";
  }
   console.log(x);
  
  console.log(y);
}

</script>
            <div id="codeDiv" style="display: none"  class="form-group">
                <label>Track code</label>
                 <select name="track_code" value="" class="form-control"  required="">

                <?php
      

  $query1 = "SELECT distinct(course_code) from course where year > 10 order by course_code";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
            
<option value="<?php echo $row1['course_code']; ?>"><?php echo $row1['course_code']; ?></option>
<?php 
}
}
?>
</select>
   </div>
     <div id="semDiv" style="display: none" class="form-group">
                <label>Semester</label>
                 <select name="sem" value="" class="form-control"  required="">

                <?php
      

  $query2 = "SELECT distinct(semester) from course where year > 10 ";
  $query_run2 = mysqli_query($connection,$query2);
  if(mysqli_num_rows($query_run2) > 0){
        while($row2 = mysqli_fetch_assoc($query_run2)){
      ?>
            
<option value="<?php echo $row2['semester']; ?>"><?php echo $row2['semester']; ?></option>
<?php 
}
}
?>
</select>
   </div>
             <div class="form-group">
               <label>Subject</label>
<input type="hidden"  id="edit_subject_id" name="edit_subject_id" value="<?php echo $subject_id;?>" class="form-control" placeholder="Enter Subject">
                 <input id="subject_name"  list="subjects" value="<?php echo $subject_description;?>" onchange="getSubjectId(this);" name="subject_name" class="form-control" placeholder="Enter Subject" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['subject_description']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSubjectId(sel) {
    var y = document.getElementById("subject_name").innerHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("edit_subject_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_subject_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
            <a href ="curriculum.php" class="btn btn-danger"> CANCEL </a>
            <?php

if(isset($_POST['edit_btn'])){
     ?>
      <button type="submit" name="updatebtn" class="btn btn-primary"> SAVE </button>
     <?php
     } else {
?>
            <button type="submit" name="savebtn" class="btn btn-primary"> SAVE </button>
            <?php
}
            ?>
          </form>
        </div>
      </div>
    <!-- </div> -->

<!-- for junior high -->
<!-- <div class="card shadow mb-4">
  <div class="card-header py-3">
    <form action="curriculum_edit.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <?php
       $id="";
       $subject_id = "";
       $subject_description = "";
       
  if(isset($_POST['edit_btn']) || isset($_POST['get_course_btn']) || isset($_POST['searchbtn'])){
     $id = $_POST['edit_id'];
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
     }

     ?>
      <input type="hidden" name="get_course_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $subject_id; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $subject_description; ?>">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Course Description" aria-label="Search" aria-describedby="basic-addon2">
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
            <th> Course Code </th>
            <th> Course Description </th>
            <th>Year </th>
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
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
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
                <form action="curriculum_edit.php" method="POST">
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
      $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
     }

     
      if(isset($_POST['get_course_btn'])){
     $course_id = $_POST['get_course_id'];
     
     $id = $_POST['edit_id'];
 $subject_id = $_POST['edit_subject_id'];
      $subject_description = $_POST['edit_subject_description'];
    }



    $query1 = "SELECT * FROM curriculum where id = '$id'";
    $query_run1 = mysqli_query($connection,$query1);
    $course_query = "SELECT * FROM course where id = '$course_id'";
    $course_query_run = mysqli_query($connection,$course_query);
 if(mysqli_num_rows($query_run1) > 0){
      
    foreach ($course_query_run as $row1) {
     
    
    ?>
    <form action="curriculum_code.php" method="POST">
      
         <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
         <input type="hidden" name="edit_course_id" value="<?php echo $row1['id']?>" >
             
<div class="form-group">
                <label> Course Code </label>
                <input type="text" name="edit_course_code" value="<?php echo $row1['course_code']?>" readonly="true"  class="form-control" placeholder="Enter Curriculum Code">
            </div>
            <div class="form-group">
                <label>Course Description</label>
                <input type="text" name="edit_course_description" value="<?php echo $row1['course_description']?>" readonly="true" class="form-control" placeholder="Enter Curriculum Description">
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="edit_year" value="<?php echo $row1['year']?>" readonly="true"  class="form-control" placeholder="Enter Year">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="edit_semester" value="<?php echo $row1['semester']?>" readonly="true"  class="form-control" placeholder="Enter Semester">
            </div>
                    <div class="form-group">
               <label>Subject</label>
<input type="hidden"  id="edit_subject_id" name="edit_subject_id" value="<?php echo $subject_id; ?>" class="form-control" placeholder="Enter Subject">
                 <input id="subject_name"  list="subjects" onchange="getSubjectId(this);" name="subject_name" value="<?php echo $subject_description;?>" class="form-control" placeholder="Enter Subject" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['subject_description']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSubjectId(sel) {
    var y = document.getElementById("subject_name").innerHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("edit_subject_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_subject_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
    
            <a href ="curriculum.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> UPDATE </button>
          </form> 
            <?php
          }

    }else {
         
     foreach ($course_query_run as $row1) {
    
    ?>
    <form action="curriculum_code.php" method="POST">
      
         <input type="hidden" name="edit_course_id" value="<?php echo $row1['id']?>" >
             
<div class="form-group">
                <label> Course Code </label>
                <input type="text" name="edit_course_code" value="<?php echo $row1['course_code']?>" readonly="true" class="form-control" placeholder="Enter Curriculum Code">
            </div>
            <div class="form-group">
                <label>Course Description</label>
                <input type="text" name="edit_course_description" value="<?php echo $row1['course_description']?>" readonly="true"  class="form-control" placeholder="Enter Curriculum Description">
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="edit_year" value="<?php echo $row1['year']?>"  class="form-control" readonly="true" placeholder="Enter Year">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="edit_semester" value="<?php echo $row1['semester']?>" readonly="true" class="form-control" placeholder="Enter Semester">
            </div>
            <div class="form-group">
               <label>Subject</label>
<input type="hidden"  id="edit_subject_id" name="edit_subject_id" value="<?php echo $row['subject']?>" class="form-control" placeholder="Enter Subject">
                 <input id="subject_name"  list="subjects" onchange="getSubjectId(this);" name="subject_name" class="form-control" placeholder="Enter Subject" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['subject_description']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSubjectId(sel) {
    var y = document.getElementById("subject_name").innerHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("edit_subject_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_subject_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
            <a href ="curriculum.php" class="btn btn-danger"> CANCEL </a>
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