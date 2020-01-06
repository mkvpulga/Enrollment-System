<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Curriculum
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">

     <form action="curriculum.php" method="POST"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Track Code" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div> &nbsp;
              <button type="submit" name="juniorhighschoolbtn" style="float: right;" class="btn btn-primary"> Junior High School </button>&nbsp;
              <button type="submit" name="seniorhighschoolbtn" style="float: right;" class="btn btn-primary"> Senior High School </button>
            </div>

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
          </form>
 <form action="curriculum_edit.php" method="POST" style="float: right;"  >
                    <input type="hidden" name="edit_id" value="<?php echo $row['curriculum_id']; ?>">
                    <input type="hidden" name="edit_course_id" value="<?php echo $row['course_id']; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $row['subject_id']; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $row['subject_description']; ?>"><button  type="submit" name="new_btn"  class="btn btn-primary"> Add Curriculum</button>
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
            <th>EDIT </th>
            <th>DELETE </th>
            
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
    
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
              <td>
                <form action="curriculum_edit.php" method="POST" >
                    <input type="hidden" name="edit_id" value="<?php echo $row['curriculum_id']; ?>">
                    <input type="hidden" name="edit_course_id" value="<?php echo $row['course_id']; ?>">
                    <input type="hidden" name="edit_subject_id" value="<?php echo $row['subject_id']; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $row['subject_description']; ?>">
                    <input type="hidden" name="edit_grade" value="<?php echo $row['year']; ?>">
                    
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="curriculum_code.php" method="post" >
                  <input type="hidden" name="delete_id" value="<?php echo $row['curriculum_id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
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