<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
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
     <h6 class="m-0 font-weight-bold text-primary"> Update Info
            
    </h6>
  </div>

  <div class="card-body">
    
    <form name="myForm" onsubmit="return validateForm()" action="information_code.php" method="POST" >
     

      <!--Section: Not enough-->
      <section>


        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-4">
  

            

             <h3 class="h3 mb-3">Personal Background </h3>

 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Student Type <span style="color: red"> *</span></h6>
               
                 <select id="type"name="type" value="" onchange="selectStudentType()" class="form-control"  required="">
<option value=""></option>
<option value="New Student">New Student</option>
<!-- <option value="Old Student">Old Student</option> -->
<option value="Transferee">Transferee</option>
</select> <div style="height:5px"></div>
              
                </div>
            </div>

            <script type="text/javascript">
              function selectStudentType() {
                  var x = document.getElementById("codeDiv");
 
 var z = document.getElementById("semDiv");
  var a = document.getElementById("secondarySchoolDiv");
  var b = document.getElementById("secondarySchoolYearDiv");
  var c = document.getElementById("secondarySchoolAddressDiv");
   x.style.display = "none";
    z.style.display = "none";
     a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
var type = document.getElementById("type");
   var grade = document.getElementById("grade");

 for (var i=grade.length- 1; i >= 0; i--) {
   
        grade.remove(i);
}
var is_junior='<?php echo $_SESSION['is_junior'];?>';
 var is_senior='<?php echo $_SESSION['is_senior'];?>';
 console.log(is_junior);
  console.log(is_senior);
if (type.value == "New Student"){
if (is_junior == 1){
var option = document.createElement("option");
option.text = "7";
option.value = "7";
grade.add(option);
}
if(is_senior==1){
var option = document.createElement("option");
option.text = "11";
option.value = "11";
grade.add(option);
}
}

 if (type.value == "Transferee"){
if (is_junior == 1){
var option = document.createElement("option");
option.text = "8";
option.value = "8";
grade.add(option);
var option = document.createElement("option");
option.text = "9";
option.value = "9";
grade.add(option);
var option = document.createElement("option");
option.text = "10";
option.value = "10";
grade.add(option);

}
if(is_senior==1){

var option = document.createElement("option");
option.text = "12";
option.value = "12";
grade.add(option);
}
}
 }


</script>


<div class="form-group">
                <label> Grade<span style="color: red"> *</span> </label>
                                 <select id="grade" name="grade" value="" onchange="selectGrade(this)" class="form-control"  required="">
<option value=""></option><?php
if($_SESSION['is_junior']==true){
?>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<?php
}
if($_SESSION['is_senior']==true){
?>
<option value="11">11</option>
<option value="12">12</option>
<?php
}
?>
</select>
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
 function selectGrade(type) {
  var x = document.getElementById("codeDiv");
  var y = type.value;
 var z = document.getElementById("semDiv");
  var a = document.getElementById("secondarySchoolDiv");
  var b = document.getElementById("secondarySchoolYearDiv");
  var c = document.getElementById("secondarySchoolAddressDiv");
  if (y  > 10 ) {
    x.style.display = "block";
    z.style.display = "block";
    a.style.display = "block";
    b.style.display = "block";
    c.style.display = "block";
  }  else {
    x.style.display = "none";
    z.style.display = "none";
     a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
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
   <!--  <div id="courseDiv" style="display: none" class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Track <span style="color: red"> *</span></h6>
               
                 <input type="hidden"  id="course_id" name="course_id"  class="form-control" >
                 <input id="course_name"  list="courses" onchange="getTrackId(this);" name="course_name"  class="form-control"  autocomplete="off" >
                     <datalist id="courses" >
   
                  <?php
      

  $query1 = "SELECT * from course";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
        while($row1 = mysqli_fetch_assoc($query_run1)){
      ?>
     
        <option  value="<?php echo $row1['course_code'] , ' (Grade: ' , $row1['year'] , ', Semester : ' , $row1['semester'] , ')'; ?>"> <?php echo $row1['id']; ?></option>
        
        
      
          <?php }
      } else {
      echo "No Record Found";
     }

      ?>  
      </datalist>
      
     <script>
function getTrackId(sel) {
    var y = document.getElementById("course_name").innerHTML;
    var txt = document.getElementById("course");
    var optionslist = $('datalist')[0].options;
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

 <div style="height:5px"></div>
              
                </div>
            </div>
 -->
          

                 <!--First row-->
            
       
            <!--First row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Last Name <span style="color: red"> *</span></h6>
               
                 <input type="text" id="last_name" name="last_name" onkeydown='return restrictAlphabets(event)' class="form-control" required="" >
                <div style="height:5px"></div>
              
                </div>
            </div>
          <script type="text/javascript">
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

            <!--/First row-->

            <!--Second row-->
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">First Name <span style="color: red"> *</span></h6>
                <input type="text" id="first_name" name="first_name" onkeydown='return restrictAlphabets(event)'  class="form-control" required=""  >
                <div style="height:5px"></div>
              </div>
            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Middle Name</h6>
                 <input type="text" id="middle_name" name="middle_name" onkeydown='return restrictAlphabets(event)' class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>
            <!--/Third row-->

            <!--Fourth row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Suffix</h6>
               <input type="text" id="suffix" name="suffix"  class="form-control"  >
               <div style="height:5px"></div>
              </div>
            </div>
            <!--/Fourth row-->
          
          <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Date Of Birth <span style="color: red"> *</span></h6>
                <input type="date" name="birth_date" class="form-control"  min="1900-01-01" required="" >
             <div style="height:5px"></div>
              </div>
            </div>

<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="address" name="address" class="form-control" cols="40" rows="2" required=""  ></textarea>
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
                 <input type="text" id="fathers_name" name="fathers_name" onkeydown='return restrictAlphabets(event)'  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6>
                 <input type="text" id="fathers_contact" onkeypress='validate(event)'  maxlength="11" name="fathers_contact"  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="fathers_address" name="fathers_address" class="form-control"  cols="40" rows="2" required="" ></textarea>
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              <div class="col-12">
                <h6 class="feature-title">Mother's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="mothers_name" onkeydown='return restrictAlphabets(event)'  name="mothers_name" class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6>
                 <input type="text" id="mothers_contact" onkeypress='validate(event)'  maxlength="11" name="mothers_contact"  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="mothers_address" name="mothers_address" class="form-control" cols="40" rows="2" required=""  ></textarea>
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">            
              <div class="col-12">
                <h6 class="feature-title">Guardian's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="guardians_name" onkeydown='return restrictAlphabets(event)' name="guardians_name"  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Contact Number <span style="color: red"> *</span></h6>
                 <input type="text" id="guardians_contact" onkeypress='validate(event)'  maxlength="11" name="guardians_contact"  class="form-control" required=""  >
               <div style="height:5px"></div>
              </div>
            </div>


<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Address <span style="color: red"> *</span></h6>
               <textarea id="guardians_address" name="guardians_address" class="form-control"  cols="40" rows="2" required=""  ></textarea>
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
                <input type="text" id="primary_school" name="primary_school"  class="form-control" required=""  >
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
               <input type="number" id="primary_year_start" min="1980" onkeydown='return schoolYear(event,this)' name="primary_year_start"  class="form-control" required=""  >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="number" id="primary_year_end" min="1980" onkeydown='return schoolYear(event,this)' name="primary_year_end"  class="form-control" required=""  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Primary School Address</h6>
               <textarea id="primary_address" name="primary_address" class="form-control"  cols="40" rows="2"  ></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
            <!--/Third row-->

<div id="secondarySchoolDiv" style="display: none" class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Secondary School </h6>
                <input type="text" id="secondary_school" name="secondary_school"  class="form-control"  >
                <div style="height:5px"></div>
              </div>

            </div>
            <!--/First row-->

            <!--Second row-->
            <div id="secondarySchoolYearDiv" style="display: none" class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Secondary School Year </h6>
                 </div>
                  <div class="col-5">
               <input type="number" id="secondary_year_start" min="1980" onkeydown='return schoolYear(event,this)' name="secondary_year_start"  class="form-control"  >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="number" id="secondary_year_end" min="1980" onkeydown='return schoolYear(event,this)' name="secondary_year_end"  class="form-control"  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <!--/Second row-->

            <!--Third row-->
            <div id="secondarySchoolAddressDiv" style="display: none" class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Secondary School Address</h6>
               <textarea id="secondary_address" name="secondary_address" class="form-control"  cols="40" rows="2"  ></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
            <!-- <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Tertiary School <span style="color: red"> *</span></h6>
                <input type="text" id="tertiary_school" name="tertiary_school"  class="form-control" required=""  >
                <div style="height:5px"></div>
              </div>

            </div>
            <div class="row">
             
              <div class="col-12">
                <h6 class="feature-title">Tertiary School Grade <span style="color: red"> *</span></h6>
                 </div>
                  <div class="col-5">
               <input type="number" id="tertiary_year_start" onKeyDown="if(this.value.length==4) return false;" name="tertiary_year_start"  class="form-control" required="" >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="number" id="tertiary_year_end" onKeyDown="if(this.value.length==4) return false;" name="tertiary_year_end"  class="form-control" required=""  >
                  <div style="height:5px"></div>
            </div>

            </div>
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Tertiary School Address</h6>
               <textarea id="tertiary_address" name="tertiary_address" class="form-control"  cols="40" rows="2"  ></textarea>
              <div style="height:5px"></div>
              </div>
            </div>
            
          
        </div> -->
 
      </section>
      <?php
      if($_SESSION['stud_reg']=='true'){
      ?>
         <button type="submit" style="float: right;" name="registerstudent" class="btn btn-primary btn-md" >
              Register
                <i class="fas fa-file-signature ml-1"></i>
            </button>
            <?php
          } else {
            ?>
             <button type="submit" style="float: right;" name="studentsignupbtn" class="btn btn-primary btn-md" >
              Register
                <i class="fas fa-file-signature ml-1"></i>
            </button>
            <?php
          }
          ?>
      </form>
        
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>