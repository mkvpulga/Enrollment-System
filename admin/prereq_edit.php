<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Prerequisite
            
    </h6>
  </div>

  <div class="card-body">

    <?php
    

    
  	
  	if(isset($_POST['edit_prereq_btn'])){
  		$id = $_POST['edit_prereq_id'];

  		$query = "SELECT pr.*, (select subject_description from subject s where id = pr.subject) as subject_name, (select subject_description from subject s where id = pr.subject_required) as subject_required_name FROM pre_requisites pr where pr.id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="subject_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Subject </label>
                <input type="hidden" id="edit_prereq_subject_id" name="edit_prereq_subject_id" value="<?php echo $row['subject']?>" class="form-control" placeholder="Enter Subject">
                <input id="subject_id" type="hidden" name="subject_id" value="<?php echo $row['subject']?>" >
                 <input id="subject_name" list="subjects" onchange="getSubjectId(this);" name="subject_name" value="<?php echo $row['subject_name']?>" class="form-control" placeholder="Enter Subject" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php
      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option value="<?php echo $row1['subject_description']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
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
    document.getElementById("edit_prereq_subject_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_prereq_subject_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
            <div class="form-group">
                <label>Subject Required</label>
                <input type="hidden" id="edit_prereq_subject_required_id" name="edit_prereq_subject_required_id" value="<?php echo $row['subject_required']?>" class="form-control" placeholder="Enter Subject">
                <input id="subject_required_id" type="hidden" name="subject_required_id" value="<?php echo $row['subject_required']?>" >
                 <input id="subject_required_name" list="subjects" onchange="getSubjectRequiredId(this);" name="subject_required_name" value="<?php echo $row['subject_required_name']?>" class="form-control" placeholder="Enter Subject Required" autocomplete="off">
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
function getSubjectRequiredId(sel) {
    var y = document.getElementById("subject_required_name").innerHTML;
    var txt = document.getElementById("subjects");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("edit_prereq_subject_required_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_prereq_subject_required_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>
           
            
            <a href ="subject.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="prerequpdatebtn" class="btn btn-primary"> Update </button>
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