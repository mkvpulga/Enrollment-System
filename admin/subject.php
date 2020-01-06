<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="subject_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Subject Code </label>
                <input type="text" name="subject_code" class="form-control" placeholder="Enter Subject Code" >
            </div>
            <div class="form-group">
                <label>Subject Description</label>
                <input type="text" name="subject_description" class="form-control" placeholder="Enter Subject Description">
            </div>

<?php
if($_SESSION['is_senior']==true){
?>
            <div class="form-group">
                <label>Unit</label>
                <input type="number" name="unit" class="form-control" placeholder="Enter Unit">
            </div>
<?php
}
?>
             <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required="" >
<option value=""></option>
<option value="OPEN">OPEN</option>
<option value="CLOSE">CLOSE</option>
</select>
                
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Subject
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 ">
   <form action="subject.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Subject Code" aria-label="Search" aria-describedby="basic-addon2">
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
    $query = "SELECT * FROM subject where subject_code like  '$search_params%'";
  } else {
    $query = "SELECT * FROM subject";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

            <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Subject
            </button>
   
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
if($_SESSION['is_senior']==true){
?>
           <th>Unit </th>
<?php
}
?>
            
            <th>Status </th>
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
            <td> <?php  echo $row['subject_code']; ?></td>
            <td> <?php  echo $row['subject_description']; ?></td>
                  
<?php
if($_SESSION['is_senior']==true){
?>
            <td> <?php  echo $row['unit']; ?></td>
           
<?php
}
?>
            <td> <?php  echo $row['status']; ?></td>
            <td>
                <form action="subject_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="subject_code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
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
<!-- /.container-fluid 


<div class="modal fade" id="addprereq" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add Prerequisite</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <form action="subject_code.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
                <label> Subject  </label>
 <input id="subject_id" type="hidden" name="subject_id" >
                 <input id="subject_name" list="subjects" onchange="getSubjectId(this);" name="subject" class="form-control" placeholder="Enter Subject" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query = "SELECT * from subject";
  $query_run = mysqli_query($connection,$query);
  if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
      ?>
     
        <option value="<?php echo $row['subject_description']; ?>"> <?php echo $row['id']; ?></option>
        
        
      
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
    document.getElementById("subject_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("subject_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
    </div>
  
       <div class="form-group">
                <label> Subject Required</label>
                <input id="subject_required_id" type="hidden" name="subject_required_id" >
                 <input list="subjects" name="subject_required" id="subject_required" onchange="getSubjectRequiredId(this);" class="form-control" placeholder="Enter Subject Required" autocomplete="off">
                     <datalist id="subjects">
   
                  <?php
      

  $query = "SELECT * from subject";
  $query_run = mysqli_query($connection,$query);
  if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
      ?>
     
        <option value="<?php echo $row['id']; ?>" > <?php echo $row['subject_description']; ?> </option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>

     <script>
function getSubjectRequiredId(sel) {
    var y = document.getElementById("subject_required").innerHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("subject_required_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("subject_required_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
    
    </div>
            
            
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveprereq" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Prerequisites
</h6>

<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="subject.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="prereq_search_params" placeholder="Subject with Prerequisite" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="prereq_searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['prereq_searchbtn'])){
    $prereq_search_params = "";
      $prereq_search_params = $_POST['prereq_search_params'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT pr.id, (select subject_description from subject s where id = pr.subject) as subject, (select subject_description from subject s where id = pr.subject_required) as subject_required FROM pre_requisites pr left join subject s on pr.subject = s.id  where s.subject_description like  '$prereq_search_params%' ";
  } else {
    $query = "SELECT pr.id, (select subject_description from subject s where id = pr.subject) as subject, (select subject_description from subject s where id = pr.subject_required) as subject_required FROM pre_requisites pr ";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

            <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addprereq">
              Add Prerequisites
            </button>

  </div>

  <div class="card-body">

<?php
    if(isset($_SESSION['preReqsuccess']) && $_SESSION['preReqsuccess'] != ''){
      echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['preReqsuccess'].' </h2> ';
      unset($_SESSION['preReqsuccess']);
    }

  if(isset($_SESSION['preReqstatus']) && $_SESSION['preReqstatus'] != ''){
      echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['preReqstatus'].' </h2> ';
      unset($_SESSION['preReqstatus']);
    }

    ?>
    <div class="table-responsive">
   
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Subject  </th>
            <th> Subject Required </th>
            
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
            <td> <?php  echo $row['subject']; ?></td>
            <td> <?php  echo $row['subject_required']; ?></td>
           
            <td>
                <form action="prereq_edit.php" method="POST">
                    <input type="hidden" name="edit_prereq_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_prereq_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="subject_code.php" method="post">
                  <input type="hidden" name="delete_prereq_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_prereq_btn" class="btn btn-danger"> DELETE</button>
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
container-fluid -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>