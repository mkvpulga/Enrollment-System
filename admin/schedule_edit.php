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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Room
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT sch.id as schedule_id, sch.section_id as section_id, sch.subject_id as subject_id, sch.room_id as room_id, sec.section_code, sub.subject_code, roo.room_no, sch.time_in, sch.time_out, sch.is_monday, sch.is_tuesday, sch.is_wednesday, sch.is_thursday, sch.is_friday, sch.is_saturday FROM schedule sch left join room roo on sch.room_id = roo.id left join section sec on sch.section_id = sec.id left join subject sub on sch.subject_id = sub.id where sch.id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="schedule_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['schedule_id']; ?>">
             
<div class="form-group">
                <label> Section Code </label>
                 <input type="hidden" id="edit_section_id" name="edit_section_id" value="<?php echo $row['section_id']?>" class="form-control" placeholder="Enter Subject">
                <input id="section" type="hidden" name="section_id" value="<?php echo $row['section_id']?>" >
                 <input id="section_name" list="sections" onchange="getSectionId(this);" name="section_name" value="<?php echo $row['section_code']?>" class="form-control" placeholder="Enter Section Code" autocomplete="off">
                     <datalist id="sections" >
   
                  <?php
      

  $query1 = "SELECT * from section";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option value="<?php echo $row1['section_code']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getSectionId(sel) {
    var y = document.getElementById("section_name").innerHTML;
    var txt = document.getElementById("sections");
    var optionslist = $('datalist')[0].options;
    var value = $(sel).val();
    document.getElementById("edit_section_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_section_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>

<div class="form-group">
                <label> Subject Code </label>
                 <input type="hidden" id="edit_subject_id" name="edit_subject_id" value="<?php echo $row['subject_id']?>" class="form-control" placeholder="Enter Subject">
                <input id="subject" type="hidden" name="subject_id" value="<?php echo $row['subject_id']?>" >
                 <input id="subject_name" list="subjects" onchange="getSubjectId(this);" name="subject_name" value="<?php echo $row['subject_code']?>" class="form-control" placeholder="Enter Subject Code" autocomplete="off">
                     <datalist id="subjects" >
   
                  <?php


      

  $query1 = "SELECT * from subject";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option value="<?php echo $row1['subject_code']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
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
    var optionslist = $('datalist')[1].options;
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

<div class="form-group">
                <label> Room Number </label>
                 <input type="hidden" id="edit_room_id" name="edit_room_id" value="<?php echo $row['room_id']?>" class="form-control" placeholder="Enter Subject">
                <input id="room" type="hidden" name="room_id" value="<?php echo $row['room_id']?>" >
                 <input id="room_name" list="rooms" onchange="getRoomId(this);" name="room_name" value="<?php echo $row['room_no']?>" class="form-control" placeholder="Enter Room Number" autocomplete="off">
                     <datalist id="rooms" >
   
                  <?php


      

  $query1 = "SELECT * from room";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option value="<?php echo $row1['room_no']; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getRoomId(sel) {
    var y = document.getElementById("room_name").innerHTML;
    var txt = document.getElementById("rooms");
    var optionslist = $('datalist')[2].options;
    var value = $(sel).val();
    document.getElementById("edit_room_id").value = "";
 for (var x=0;x<optionslist.length;x++){
       if (optionslist[x].value === value) {
          //Alert here value
          document.getElementById("edit_room_id").value = optionslist[x].text;
          break;
       } 
    }
    
}
</script>
            </div>

           <div class="form-group">
                <label>Frequency</label> <br>
                <input type="checkbox" name="edit_is_monday" value="1" <?php if($row['is_monday']==1){ ?> checked="" <?php } ?> > Monday &nbsp;
                 <input type="checkbox" name="edit_is_tuesday" value="1" <?php if($row['is_tuesday']==1){ ?> checked="" <?php } ?> > Tuesday &nbsp;
                 <input type="checkbox" name="edit_is_wednesday" value="1" <?php if($row['is_wednesday']==1){ ?> checked="" <?php } ?> > Wednesday <br>
                 <input type="checkbox" name="edit_is_thursday" value="1" <?php if($row['is_thursday']==1){ ?> checked="" <?php } ?> > Thursday &nbsp;
                 <input type="checkbox" name="edit_is_friday" value="1" <?php if($row['is_friday']==1){ ?> checked="" <?php } ?> > Friday &nbsp;
                 <input type="checkbox" name="edit_is_saturday" value="1" <?php if($row['is_saturday']==1){ ?> checked="" <?php } ?> > Saturday &nbsp;
                
            </div>
            
            <div class="form-group">
                <label>Time In</label>
                
                <input type="time" id="edit_time_in"  name="edit_time_in" value="<?php echo $row['time_in']; ?>"
        class="form-control" required="">
                        </div>
                          <div class="form-group">
                <label>Time Out</label>
                
                <input type="time" id="edit_time_out"  name="edit_time_out" value="<?php echo $row['time_out']; ?>"
        class="form-control" required="">
                        </div>
            <a href ="schedule.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
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