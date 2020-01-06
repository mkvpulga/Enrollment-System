<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>

  <?php
    
      $sid = $_SESSION["stud_req_id"];
    
      $query = "SELECT student.*,course.course_code, course.year,course.semester FROM student left join course on student.course_id = course.id where student.id = '$sid'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
<div class="container-fluid">

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
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Student Section Assignment
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="assignment_section_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
 <div class="form-group">
                <label> Student Name </label>
                <input type="hidden" name="student_id" class="form-control" value="<?php echo $row['id']; ?>" placeholder="Enter Student Name">
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?>" placeholder="Enter Student Name" disabled="">
                  
              
            </div>
            <div class="form-group">
                <label> Student Type </label>
                <input type="text" name="student_type" class="form-control" value="<?php echo $row['type']; ?>" placeholder="Enter Student Type" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Grade Level </label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['year']; ?>" placeholder="Enter Grade Level" disabled="">
                
              
            </div>
            <?php
            if($row['year'] > 10) {
            ?>
<div class="form-group">
                <label> Track Code </label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['course_code']; ?>" placeholder="Enter Track Code" disabled="">
                
              
            </div>
            <div class="form-group">
                <label> Semester </label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['semester']; ?>" placeholder="Enter Semester" disabled="">
                
              
            </div>
            <?php
          } else if($row['year'] <= 10 && $row['year'] >= 7) {
            
       $student_id = $row['id'];
         $divisor = 0;
      $tot_grade = 0;
       $query1 = "SELECT  * FROM  grade  where student_id = '$student_id' ";
     $query_run1 = mysqli_query($connection,$query1);
     
     while($row1 = mysqli_fetch_assoc($query_run1)){
       $divisor += 1;
      $tot_grade += $row1['grade'];
     
     }
            ?>
            <div class="form-group">
                <label> Average Grade </label>
                 <input type="number" name="grade" step=".01" min="50" value="<?php echo $tot_grade / $divisor ?>" max="100" readonly="true" class="form-control"  >
                
              
            </div>
              <?php
          } 
            ?>
           <div class="form-group">
                <label> Section Code</label>
              <!--   <input type="hidden"  id="section_id" name="section_id"   class="form-control" placeholder="Enter Section">
                 <input id="section_name"  list="sections" onchange="getSectionId(this);" name="section_name"   class="form-control" placeholder="Enter Section Code" autocomplete="off">
                     <datalist id="se <select name="program" value="" class="form-control" onchange="selectProgram(this)" required="">ctions" > -->
    <select id="section_id" name="section_id" value="" onchange="schedQuery(this)" class="form-control" required="">
                  <?php
      

  $query1 = "SELECT * from section";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['id']; ?>"> <?php echo $row1['section_code']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      <!-- </datalist> -->
      </select>
      <script type="text/javascript">
        function schedQuery() {
         document.getElementById("search_params").value = document.getElementById("section_id").value ;
        }
      </script>
    <!--  <script>
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
</script> -->
            </div>



            <!-- <a href ="student_requirement.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit"  name="assignsectioncreatebtn" class="btn btn-success"> ASSIGN </button>
          </form><br>
            <form action="assignment_section_create.php" onsubmit="schedQuery()"  method="POST" >
            <div class="input-group" >
                <input id="search_params" type="hidden" name="search_params" value="">
                 <button type="submit" name="searchbtn" class="btn btn-primary"> VIEW Schedule </button>
          
             
            </div>
            <?php
         
      
     
      //retrieve records
    $sec_id = "";
  if(isset($_POST['searchbtn'])){

      $sec_id = $_POST['search_params'];
   
  

  $query = "SELECT sch.id as schedule_id, sec.section_code, sub.subject_code,  sub.subject_description, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id where sec.id = '$sec_id'";
  } else {
     $query ="SELECT sch.id as schedule_id, sec.section_code, sub.subject_code, sub.subject_description, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id where sec.id = '$sec_id'";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>
              <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Section Code </th>
            <th> Subject Code </th>
            <th> Subject Description </th>
            <th> Room Number </th>
            <th> Day </th>
            <th> Time In </th>
            <th> Time Out </th>
          
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
            <td> <?php  echo $row['subject_description']; ?></td>
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

</div>
<!-- /.container-fluid -->
<?php
    }
            ?>




  
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>