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
        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="schedule_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Section Code</label>
                <input type="hidden"  id="section_id" name="section_id"  class="form-control" placeholder="Enter Section">
                 <input id="section_name"  list="sections" onchange="getSectionId(this);" name="section_name"  class="form-control" placeholder="Enter Section Code" autocomplete="off">
                     <datalist id="sections" >
   
                  <?php
      

  $query1 = "SELECT * from section";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['section_code']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSectionId(sel) {
    var y = document.getElementById("section_name").leftHTML;
    var txt = document.getElementById("sections");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("section_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("section_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
            <div class="form-group">
                <label> Subject Code </label>
                <input type="hidden"  id="subject_id" name="subject_id"  class="form-control" placeholder="Enter Subject">
                 <input id="subject_name"  list="subjects" onchange="getSubjectId(this);" name="subject_name"  class="form-control" placeholder="Enter Subject Code" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['subject_code']; ?>" > <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSubjectId(sel) {
    var y = document.getElementById("subject_name").leftHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[1].options;
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
                <label> Room Number </label>
                <input type="hidden"  id="room_id" name="room_id"  class="form-control" placeholder="Enter Room">
                 <input id="room_name"  list="rooms" onchange="getRoomId(this);" name="room_name"  class="form-control" placeholder="Enter Room Number" autocomplete="off">
                     <datalist id="rooms" >
   
                  <?php
      

  $query1 = "SELECT * from room";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['room_no']; ?>" > <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getRoomId(sel) {
    var y = document.getElementById("room_name").leftHTML;
    var txt = document.getElementById("rooms");
    var optionslist = $('datalist')[2].options;
    var value = $(sel).val();
    document.getElementById("room_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("room_id").value = optionslist[x].text;
          break;
       } 

    }
    
}
</script>
            </div>
            <div class="form-group">
                <label>Frequency</label> <br>
                <input type="checkbox" name="is_monday" value="1" > Monday &nbsp;
                <input type="checkbox" name="is_tuesday" value="1"  > Tuesday &nbsp;
                <input type="checkbox" name="is_wednesday" value="1" > Wednesday <br>
                <input type="checkbox" name="is_thursday" value="1" > Thursday &nbsp;
                <input type="checkbox" name="is_friday" value="1" > Friday &nbsp;
                <input type="checkbox" name="is_saturday"  value="1"> Saturday &nbsp;
            </div>
            <div class="form-group">
                <label>Time In</label>
               
                
                <input type="time" id="time_in"  name="time_in"
        class="form-control" required="">
         
            </div>
            <div class="form-group">
                <label>Time Out</label>
                
                <input type="time" id="time_out"  name="time_out"
        class="form-control" required="">
          
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


<div class="modal fade" id="express" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Express Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="schedule_code.php" method="POST">

        <div class="modal-body">

          
            <div class="form-group">
                <label> Section Code</label>
                <input type="hidden"  id="section_id2" name="section_id2"  class="form-control" placeholder="Enter Section">
                 <input id="section_name2"  list="sections2" onchange="getSectionId2(this);" name="section_name2"  class="form-control" placeholder="Enter Section Code" autocomplete="off">
                     <datalist id="sections2" >
   
                  <?php
      

  $query1 = "SELECT * from section";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['section_code']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSectionId2(sel) {
    var y = document.getElementById("section_name2").leftHTML;
    var txt = document.getElementById("sections2");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("section_id2").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("section_id2").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
          
             <div class="form-group">
                <label> Course & Year & Sem</label>
                <input type="hidden"  id="course_id" name="course_id"  class="form-control" placeholder="Enter Course">
                 <input id="course_name"  list="courses" onchange="getCourseId(this);" name="course_name"  class="form-control" placeholder="Enter Course Code" autocomplete="off">
                     <datalist id="courses" >
   
                  <?php
      

  $query1 = "SELECT * from course";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['course_code'] . ', YEAR: ' . $row1['year'] . ', SEMESTER: ' . $row1['semester']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getCourseId(sel) {
    var y = document.getElementById("course_name").leftHTML;
    var txt = document.getElementById("courses");
    var optionslist = $('datalist')[4].options;
    var value = $(sel).val();
    document.getElementById("course_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("course_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
             
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveExpress" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 f
ont-weight-bold text-primary">Schedule
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 ">
   <form action="schedule.php" method="POST" style="float: right;" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group" >
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Section Code" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary"  name="searchbtn" type="submit">
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
    $query = "SELECT sch.id as schedule_id, sec.section_code, sub.subject_code, roo.room_no, sch.time_in, sch.time_out,  sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id where sec.section_code like  '$search_params%'";
  } else {
    $query = "SELECT sch.id as schedule_id, sec.section_code, sub.subject_code, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addadminprofile">
              Add Schedule
            </button>
             <button type="button" class="btn btn-primary"   data-toggle="modal" data-target="#express">
              Add Express Schedule
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
            <th> Section Code </th>
            <th> Subject Code </th>
            <th> Room Number </th>
            <th> Day </th>
            <th> Time In </th>
            <th> Time Out </th>
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
            <td> <?php  echo $row['section_code']; ?></td>
            <td> <?php  echo $row['subject_code']; ?></td>
            <td> <?php  echo $row['room_no']; ?></td>
            <td> <?php  
            $day = "";
            if ($row['is_monday'] == 1) {
              $day .= "M";
            }
            if ($row['is_tuesday'] == 1) {
              $day .= "T";
            }
            if ($row['is_wednesday'] == 1) {
              $day .= "W";
            }
            if ($row['is_thursday'] == 1) {
              $day .= "Th";
            }
            if ($row['is_friday'] == 1) {
              $day .= "F";
            }
            if ($row['is_saturday'] == 1) {
              $day .= "S";
            }
            echo $day; ?></td>
            <td> <?php  echo date('h:i a' , strtotime($row['time_in'])); ?></td>
            <td> <?php  echo date('h:i a' , strtotime($row['time_out'])); ?></td>
            <td>
                <form action="schedule_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['schedule_id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="schedule_code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['schedule_id']; ?>">
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