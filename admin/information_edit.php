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
     <h6 class="m-0 font-weight-bold text-primary"> Update Info
            
    </h6>
  </div>
<script type="text/javascript">
    function validateForm() {
  var primary_year_start = document.forms["myForm"]["primary_year_start"].value;
  var primary_year_end = document.forms["myForm"]["primary_year_end"].value;
  var secondary_year_start = document.forms["myForm"]["secondary_year_start"].value;
  var secondary_year_end = document.forms["myForm"]["secondary_year_end"].value;

  if (primary_year_start > primary_year_end) {
    alert("Primary School Year Start must be less than Primary School Year End");
    return false;
  }
   if (secondary_year_start > secondary_year_end) {
    alert("Secondary School Year Start must be less than Secondary School Year End");
    return false;
  }
}
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
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
            function restrictAlphabets(e){
         if (e.ctrlKey || e.altKey) {
    return false
      
    } else {
    
      var key = e.keyCode;
      
      if (((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (key == 9))) {
        return true;
        
      } else {
        return false;
      }

    }
 
  }
</script>
  <div class="card-body">
  	<?php
  	$secondary_boolean = false;
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];
      if($_SESSION['designation']=='Student'){
  		$query = "SELECT student.*, course.year FROM student left join course on student.course_id = course.id where student.id = '$id'";
      $query_run = mysqli_query($connection,$query);

     while($row = mysqli_fetch_assoc($query_run)){
      if($row['year']>10){
        $secondary_boolean = true;
      }
     }
      $query = "SELECT * from student where id = '$id'";
		} else {
$query = "SELECT * FROM employee where id = '$id'";
 $secondary_boolean = true;
    }
    $query_run = mysqli_query($connection,$query);

	   while($row = mysqli_fetch_assoc($query_run)){
			
  	
  	?>
    <form name="myForm" onsubmit="return validateForm()" action="information_code.php" method="POST" >
     
<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" class="form-control"  >
      <!--Section: Not enough-->
      <section>


        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-4">
  

            

             <h3 class="h3 mb-3">Personal Background </h3>
       
  <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Last Name <span style="color: red"> *</span></h6>
               
                 <input type="text" id="last_name" name="last_name" onkeydown='return restrictAlphabets(event)' value="<?php echo $row['last_name']; ?>" class="form-control" required=""  >
                <div style="height:5px"></div>
              
                </div>
            </div>
            <!--Second row-->
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">First Name <span style="color: red"> *</span></h6>
                <input type="text" id="first_name" onkeydown='return restrictAlphabets(event)' value="<?php echo $row['first_name']; ?>" name="first_name" class="form-control" required=""  >
                <div style="height:5px"></div>
              </div>
            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Middle Name</h6>
                 <input type="text" id="middle_name" onkeydown='return restrictAlphabets(event)' name="middle_name" value="<?php echo $row['middle_name']; ?>" class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>
            <!--/Third row-->

            <!--Fourth row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Suffix</h6>
               <input type="text" id="suffix" name="suffix" value="<?php echo $row['suffix']; ?>" class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>
            <!--/Fourth row-->
          
          <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Date Of Birth <span style="color: red"> *</span></h6>
                <input type="date" name="birth_date" required="" class="form-control" value="<?php echo $row['birth_date']; ?>" min="1900-01-01" >
             <div style="height:5px"></div>
              </div>
            </div>

<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="address" name="address" required="" class="form-control"  cols="40" rows="2"  ><?php echo $row['address']; ?></textarea>
               <div style="height:5px"></div>
              </div>
            </div>



 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6> 
                 <input type="text" id="contact_number" onkeypress='validate(event)'  maxlength="11" name="contact_number"  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


          </div>


          <!--/First column-->

          <!--Second column-->

          <div class="col-md-4 ">

            <h3 class="h3 mb-3">Family Background </h3>
             
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Father's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="fathers_name" required="" onkeydown='return restrictAlphabets(event)' name="fathers_name" value="<?php echo $row['fathers_name']; ?>" class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6>
                 <input type="text" id="fathers_contact" maxlength="11" onkeypress='validate(event)' name="fathers_contact" value="<?php echo $row['fathers_contact']; ?>" required="" class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="fathers_address" name="fathers_address" required="" class="form-control"   cols="40" rows="2"  ><?php echo $row['fathers_address']; ?></textarea>
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              <div class="col-12">
                <h6 class="feature-title">Mother's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="mothers_name" required="" onkeydown='return restrictAlphabets(event)'  name="mothers_name" value="<?php echo $row['mothers_name']; ?>"  class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6>
                 <input type="text" id="mothers_contact" required="" maxlength="11"  onkeypress='validate(event)' name="mothers_contact"  value="<?php echo $row['mothers_contact']; ?>" class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="mothers_address" required="" name="mothers_address" class="form-control" cols="40" rows="2"  ><?php echo $row['mothers_address']; ?></textarea>
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">            
              <div class="col-12">
                <h6 class="feature-title">Guardian's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="guardians_name" required="" onkeydown='return restrictAlphabets(event)' name="guardians_name" value="<?php echo $row['guardians_name']; ?>"  class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number<span style="color: red"> *</span></h6>
                 <input type="text" id="guardians_contact" required="" maxlength="11" onkeypress='validate(event)' name="guardians_contact" value="<?php echo $row['guardians_contact']; ?>"  class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="guardians_address" required="" name="guardians_address" class="form-control" cols="40" rows="2"  ><?php echo $row['guardians_address']; ?></textarea>
               <div style="height:5px"></div>
              </div>
            </div>

          </div>
          <!--/Second column-->

          <!--Third column-->
          <div class="col-md-4 ">
            <!--First row-->
             <h3 class="h3 mb-3">Educational Background </h3>
             
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Primary School <span style="color: red"> *</span></h6>
                <input type="text" id="primary_school" required=""  name="primary_school" value="<?php echo $row['primary_school']; ?>" class="form-control"  >
                <div style="height:5px"></div>
              </div>

            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Primary School Year <span style="color: red"> *</span></h6>
                 </div>
                  <div class="col-5">
               <input type="text" id="primary_year_start" required="" min="1980" name="primary_year_start" onkeydown='return schoolYear(event,this)' value="<?php echo $row['primary_year_start']; ?>"  class="form-control"  >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="text" id="primary_year_end" required="" min="1980" name="primary_year_end" onkeydown='return schoolYear(event,this)' value="<?php echo $row['primary_year_end']; ?>" class="form-control"  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Primary School Address</h6>
               <textarea id="primary_address" name="primary_address" class="form-control"  cols="40" rows="2"  ><?php echo $row['primary_address']; ?></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
            <!--/Third row-->
<?php
if ($secondary_boolean==true){
 ?>

<div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Secondary School</h6>
                <input type="text" id="secondary_school" name="secondary_school" value="<?php echo $row['secondary_school']; ?>"  class="form-control"  >
                <div style="height:5px"></div>
              </div>

            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Secondary School Year</h6>
                 </div>
                  <div class="col-5">
               <input type="text" id="secondary_year_start" min="1980" name="secondary_year_start" onkeydown='return schoolYear(event,this)' value="<?php echo $row['secondary_year_start']; ?>"  class="form-control"  >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="text" id="secondary_year_end" min="1980" name="secondary_year_end" onkeydown='return schoolYear(event,this)' value="<?php echo $row['secondary_year_end']; ?>" class="form-control"  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Secondary School Address</h6>
               <textarea id="secondary_address" name="secondary_address" class="form-control"   cols="40" rows="2"  ><?php echo $row['secondary_address']; ?></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
            
            <?php
            }
            ?>
            <!-- <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Tertiary School</h6>
                <input type="text" id="tertiary_school" name="tertiary_school" value="<?php echo $row['tertiary_school']; ?>" class="form-control"  >
                <div style="height:5px"></div>
              </div>

            </div>
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Tertiary School Year</h6>
                 </div>
                  <div class="col-5">
               <input type="text" id="tertiary_year_start" name="tertiary_year_start" value="<?php echo $row['tertiary_year_start']; ?>" class="form-control"  >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="text" id="tertiary_year_end" name="tertiary_year_end" value="<?php echo $row['tertiary_year_end']; ?>"  class="form-control"  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Tertiary School Address</h6>
               <textarea id="tertiary_address" name="tertiary_address" class="form-control" cols="40" rows="2"  ><?php echo $row['tertiary_address']; ?></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
          
          
        </div> -->
 
      </section>
         <button type="submit" style="float: right;" name="updatebtn" class="btn btn-primary btn-md" >
              Update
                <i class="fas fa-file-signature ml-1"></i>
            </button>
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