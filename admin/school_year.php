<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>
<script type="text/javascript">
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
         
      
     
      //retrieve records
  $current_school_year = '';
 
    $query = "SELECT * FROM current_school_year";
 
  $query_run = mysqli_query($connection,$query);
   while($row = mysqli_fetch_assoc($query_run)){
    $current_school_year = $row['school_year'];
   }
      ?>

<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">School Year
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="school_year_code.php" method="POST" >
  <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Current School Year</h6>
                 </div>
                  <div class="col-4">
               <input type="number" id="school_year_start" min="1980" onkeydown='return schoolYear(event,this)' name="school_year_start" value="<?php echo substr($current_school_year, 0, 4); ?>"  class="form-control"  >
                 </div>
                   <div class="col-0">
                TO
              </div>
                <div class="col-4">
               <input type="number" id="school_year_end" min="1980" onkeydown='return schoolYear(event,this)' name="school_year_end" value="<?php echo substr($current_school_year, -4); ?>"  class="form-control"  >
                  <div style="height:5px"></div>
            </div>
   <div class="col-3">
                <button class="btn btn-primary" name="currentschoolyearbtn" type="submit">
                 UPDATE SCHOOL YEAR
                </button>
                  <div style="height:5px"></div>
            </div>
             
            </div>
          </form>
         
     

            <?php
         $juniorhighschool=true;
         $seniorhighschool=false;
      
     if(isset($_POST['juniorhighschoolbtn'])){
       $juniorhighschool=true;
         $seniorhighschool=false;
     }
     if(isset($_POST['seniorhighschoolbtn'])){
       $juniorhighschool=false;
         $seniorhighschool=true;
     }
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['course_description'] = "gago";
      if($juniorhighschool==true){    
        $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur left join course cou on cur.course_id = cou.id left join subject sub on cur.subject_id = sub.id where cou.course_code like  '$search_params%' and cou.year <=10";
      }
      if($seniorhighschool==true){    
        $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur left join course cou on cur.course_id = cou.id left join subject sub on cur.subject_id = sub.id where cou.course_code like  '$search_params%' and cou.year > 10";
      }
    
  } else {
     if($juniorhighschool==true){    
        $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur left join course cou on cur.course_id = cou.id left join subject sub on cur.subject_id = sub.id where cou.year <=10";
      }
     if($seniorhighschool==true){    
        $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur left join course cou on cur.course_id = cou.id left join subject sub on cur.subject_id = sub.id where  cou.year > 10";
      }
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          
          <br>
     <form action="school_year.php" method="POST"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Course Code" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div> &nbsp;
              <button type="submit" name="juniorhighschoolbtn" style="float: right;" class="btn btn-primary"> Junior High School </button>&nbsp;
              <button type="submit" name="seniorhighschoolbtn" style="float: right;" class="btn btn-primary"> Senior High School </button>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
      if($juniorhighschool==true){    
         $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur inner join course cou on cur.course_id = cou.id inner join subject sub on cur.subject_id = sub.id where cou.course_code like  '$search_params%' and cou.year <=10";
       
      }
      if($seniorhighschool==true){    
         $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur inner join course cou on cur.course_id = cou.id inner join subject sub on cur.subject_id = sub.id where cou.course_code like  '$search_params%' and cou.year > 10";
      }
    
  
  } else {
    if($juniorhighschool==true){    
         $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur inner join course cou on cur.course_id = cou.id inner join subject sub on cur.subject_id = sub.id where cou.year <=10";
       
      }
      if($seniorhighschool==true){    
         $query = "SELECT cur.id as curriculum_id, cou.id as course_id, sub.id as subject_id, cou.course_code,cou.course_description, cou.year, cou.semester, sub.subject_code, sub.subject_description, sub.unit FROM curriculum cur inner join course cou on cur.course_id = cou.id inner join subject sub on cur.subject_id = sub.id where cou.year > 10";
      }
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>
 <form action="school_year_code.php" method="POST" style="float: right;"  >
                    <input type="hidden" name="current_school_year" value="<?php echo $current_school_year; ?>">
                    
                    <button  type="submit" name="openallbtn"  class="btn btn-primary"> OPEN ALL</button>
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
          <?php
if($seniorhighschool==true){      
?>
            <th> Track Code </th>
            <th> Track Description </th>
           <th>Semester </th>
            
           
<?php
}
?>
            <th> Grade </th>
           
            <th>Subject Code</th>
            <th>Subject Description</th>
          <?php
if($seniorhighschool==true){ 
?>
                      <th>Unit </th>
  
           
<?php
}
?>
            <th>School Year </th>
             <th>Status</th>
            <th>EDIT </th>
            <!-- <th>DELETE </th> -->
            
          </tr>
        </thead>
        <tbody>
      <?php
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          $school_year ="";
          $status = "";
      $curriculum_id = $row['curriculum_id'];
      $query1 = "SELECT * from school_year where curriculum_id = '$curriculum_id' and school_year = '$current_school_year'";
  $query_run1 = mysqli_query($connection,$query1);
  while($row1 = mysqli_fetch_assoc($query_run1)){
     $school_year = $row1['school_year'];
          $status = $row1['status'];
  }
          ?>
          <tr>
         <?php
if($seniorhighschool==true){ 
?>
             <td> <?php  echo $row['course_code']; ?></td>
            <td> <?php  echo $row['course_description']; ?></td>
          <td> <?php  echo $row['semester']; ?></td>
           
           
<?php
}
?>
            <td> <?php  echo $row['year']; ?></td>
           
            <td> <?php  echo $row['subject_code']; ?> </td>
            <td> <?php  echo $row['subject_description']; ?> </td>
            <?php
if($seniorhighschool==true){ 
?>
              <td> <?php  echo $row['unit']; ?> </td>
         
           
           
<?php
}
?>
             <td> <?php  echo $school_year; ?> </td>
            <td> <?php  echo $status; ?> </td>
              <td>
                <form action="school_year_edit.php" method="POST" >
                    <input type="hidden" name="edit_id" value="<?php echo $row['curriculum_id']; ?>">
                    <input type="hidden" name="edit_course_id" value="<?php echo $row['course_id']; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $row['subject_id']; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $row['subject_description']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
           <!--  <td>
                <form action="curriculum_code.php" method="post" >
                  <input type="hidden" name="delete_id" value="<?php echo $row['curriculum_id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
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