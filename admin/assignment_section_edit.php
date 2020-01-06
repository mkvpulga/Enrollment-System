<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>

  <?php
    
    if(isset($_POST['edit_btn'])){
      $sid = $_POST['edit_id'];
    
      $query = "SELECT student.*, section.section_code, assignment_section.section_id FROM student left join assignment_section on student.id = assignment_section.student_id left join section on assignment_section.section_id = section.id where student.id = '$sid'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Section Assignment
            
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
                <label> Section Code</label>
                <input type="hidden"  id="section_id" name="section_id" value="<?php  echo $row['section_id']; ?>"  class="form-control" placeholder="Enter Section">
                 <input id="section_name"  list="sections" onchange="getSectionId(this);" name="section_name" value="<?php  echo $row['section_code']; ?>"  class="form-control" placeholder="Enter Section Code" autocomplete="off">
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
            
            <a href ="assignment_section.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
        }
    }
            ?>




  <?php
    
    if(isset($_POST['view_btn'])){
      $sid = $_POST['view_id'];
       $stype = $_POST['view_stype'];

      $query = "SELECT * FROM student where id = '$sid'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> VIEW Student Requirement
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="student_requirement_code.php" method="POST">
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
                <label>Requirements</label><br>
                <?php
         
      
     
      //retrieve records
  
   
   //$_POST['course_description'] = "gago";
    $query = "SELECT * from requirement where type =  '$stype'";
  
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $rid = "";
      $rid = $row['id'];

       $query1 = "SELECT * from student_requirement where requirement_id =  '$rid' and student_id =  '$sid'";
  
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
   
      ?>

                <input type="checkbox" name="<?php  echo $row['id']; ?>" value="<?php  echo $row['id']; ?>" disabled=""  checked="">&nbsp;<?php  echo $row['requirement_name']; ?> <br>


                  <?php 
                
              } else {
                ?>
 <input type="checkbox" name="<?php  echo $row['id']; ?>" value="<?php  echo $row['id']; ?>" disabled="" >&nbsp;<?php  echo $row['requirement_name']; ?> <br>
                <?php
              }
            }
                ?>
            </div>
            <a href ="student_requirement.php" class="btn btn-danger"> BACK </a>
            </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
        }
    }
            ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>