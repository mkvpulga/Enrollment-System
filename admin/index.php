<?php
session_start(); 
unset($_SESSION['stud_reg']);
include_once 'includes/connection.php'; 
$_SESSION['is_junior'] = false;
$_SESSION['is_senior'] = false;
$query = "SELECT * FROM configuration";
    $query_run = mysqli_query($connection,$query);
    
    foreach ($query_run as $row) {
      {
      if($row['is_junior']==1){
        $_SESSION['is_junior'] = true;
      }
      if($row['is_senior']==1){
        $_SESSION['is_senior'] = true;
      }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Welcome to Enrollment System</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap2.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #929FBA !important;
      }
    }

  </style>
</head>

<body>

  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
<?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);
if(mysqli_num_rows($query_run) > 0){
    foreach ($query_run as $row) {
      
    
    ?>
             <img   src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] ) ?> " width="100px" height="50px" alt="your image" />
              
            <?php
}
} else {
?>         
  <img   src="" width="100px" height="50px" alt="School Logo" />
<?php
}
?>
        


        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);
if(mysqli_num_rows($query_run) > 0){
    foreach ($query_run as $row) {
      
    
    ?>
    <span class="nav-link" ><strong><?php echo  $row['school_name']  ?></strong></span>
             
              
            <?php
}
} else {
?>         
 <span class="nav-link" ><strong>School Name</strong></span>
<?php
}
?>
        
            </li>
            
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            
 <li class="nav-item">
           
            <button type="button" class="nav-link border border-light rounded"  onclick="window.location.href='index.php#registration'">
                  <i class="fab fa-react ml-2"></i>
              Registration
            </button>
          </li> 
          &nbsp;
            <li class="nav-item">
               
               <button type="button" class="nav-link border border-light rounded"  data-toggle="modal" data-target="#addadminprofile">
                  <i class="fas fa-american-sign-language-interpreting ml-2"></i>
              Login
            </button>

             
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="index.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label> Password </label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
             
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Login</button>

        </div>

        <?php

 
     

if(isset($_POST['registerbtn'])){
   $_SESSION['stud_reg'] = "";
  $uname = $_POST['username'];
  $password = $_POST['password'];
   $_SESSION["password"] = $password;
   $_SESSION["student_id"] = 0;
   $_SESSION["course_id"] = 0;
  $query = "SELECT * FROM user_master where username =  '$uname' and password = md5('$password')";
  $query_run = mysqli_query($connection,$query);
  
    if(mysqli_num_rows($query_run) > 0){
    while($row = mysqli_fetch_assoc($query_run)){
       $designation = $row['designation'];
           $_SESSION["user_id"] = $row['id'];
           $_SESSION["designation"] = $row['designation'];

            $user_master_id = $row['id'];
             if($designation == "Student"){
              $query1 = "SELECT * FROM student where user_master_id =  '$user_master_id'";
  $query_run1 = mysqli_query($connection,$query1);
  if(mysqli_num_rows($query_run1) > 0){
     if($password=="admin"){
              echo'<script>window.location="account_details.php"; </script> ';
              exit();
             }
            
     echo'<script>window.location="home.php"; </script> ';
    exit();
  } else {
     echo'<script>window.location="information_create.php"; </script> ';
    exit();
  }
             } else {
               $query2 = "SELECT * FROM configuration";
              $query_run2 = mysqli_query($connection,$query2);
               if(mysqli_num_rows($query_run2) == 0){
                echo'<script>window.location="configuration_create.php"; </script> ';
               }
              $query1 = "SELECT * FROM employee where user_master_id =  '$user_master_id'";
              $query_run1 = mysqli_query($connection,$query1);
               if(mysqli_num_rows($query_run1) > 0){
                 if($password=="admin"){
              echo'<script>window.location="account_details.php"; </script> ';
              exit();
             }
            
     echo'<script>window.location="home.php"; </script> ';
    exit();
  } else {
     echo'<script>window.location="information_create.php"; </script> ';
    exit();
  }
             }

    
  }
  } else {
    echo '<script> alert("Invalid Username or Password"); window.location="index.php";  </script> ';
    
    exit();
  }
}



?>

      </form>

    </div>
  </div>
</div>


    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

      <!--Indicators-->
      <ol class="carousel-indicators">
        <?php

    
   
      $query = "SELECT * FROM announcement";
    $query_run = mysqli_query($connection,$query);
$first = true;
    foreach ($query_run as $row) {
    if ( $first )
    {
      ?>
      <li data-target="#carousel-example-1z" data-slide-to="<?php echo $row['id']?>" class="active"></li>
      <?php
        
        $first = false;
    }
    else
    {
        ?>
<li data-target="#carousel-example-1z" data-slide-to="<?php echo $row['id']?>"></li>
      

        <?php
    }

 
    
}
        ?>
      </ol>
      <!--/.Indicators-->

      <!--Slides-->
      <div class="carousel-inner" role="listbox">
<?php

    
   
      $query = "SELECT * FROM announcement";
    $query_run = mysqli_query($connection,$query);
$first = true;
    foreach ($query_run as $row) {
      if ( $first )
    {
     
    ?>
<div class="carousel-item active">
          <div class="view" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode( $row['announcement_attachment'] ) ?>'); background-repeat: no-repeat; background-size: 1350px 400px;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong><?php echo $row['announcement_headline']?></strong>
                </h1>

                <p>
                  <strong><?php echo $row['announcement_content']?></strong>
                </p>

               

               
              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
         <?php
        
        $first = false;
    }
    else
    {
        ?>
<div class="carousel-item">
          <div class="view" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode( $row['announcement_attachment'] ) ?>'); background-repeat: no-repeat; background-size: 1350px 400px;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong><?php echo $row['announcement_headline']?></strong>
                </h1>

                <p>
                  <strong><?php echo $row['announcement_content']?></strong>
                </p>

               

               
              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>

        <?php
    }

 
    
}
        ?>
           
        
      </div>
      <!--/.Slides-->

      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->

    </div>
    <!--/.Carousel Wrapper-->

  </header>

  <!--Main layout-->
  <main>
    <div class="container">

      <!--Section: Main info-->
      <section class="mt-5 wow fadeIn">

          
           <!--Grid column-->

 <div class="row">
          <!--Grid column-->
          <?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
      
    
    ?>
            <div class="col-md-6 mb-4">
                  <h3 class="h3 mb-3">School Vision</h3>
                  <p>
                  <strong> <?php echo $row['school_vision']?></strong>
                      
                    </p>
                  
              </div>
         
              <div class="col-md-6 mb-4">
                  <h3 class="h3 mb-3">School Mission</h3>
                  <p>
                  <strong> <?php echo $row['school_mission']?></strong>
                      
                    </p>
                  
            
            </div>
              <?php
            }
            ?>
             </div>
          </section>
 <hr class="my-5" id="registration">
  
    <form name="myForm" onsubmit="return validateForm()" action="information_code.php" method="POST" >
     

      <!--Section: Not enough-->
      <section >
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

        <!--First row-->
       
        <h2 class="my-5 h3 text-center">Registration</h2>

        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-4">
  

            

             <h3 class="h3 mb-3">Personal Background </h3>
         <!--      
<div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">School Type <span style="color: red"> *</span></h6>
               
                 <select name="program" value="" class="form-control" onchange="selectProgram(this)" required="">
<option value=""></option>
<option value="Junior High">Junior High</option>
<option value="Senior High">Senior High</option>
<!-- <option value="Transferee">Transferee</option> 
</select> <div style="height:5px"></div>
              
                </div>
            </div>
<script type="text/javascript">
  function selectProgram(type) {
  var x = document.getElementById("courseDiv");
  var y = type.value;
 var z = document.getElementById("gradeDiv");
  
  if (y  === "Senior High") {
    x.style.display = "block";
    z.style.display = "none";
  } else if (y  === "Junior High") {
    x.style.display = "none";
    z.style.display = "block";
  } else {
    x.style.display = "none";
    z.style.display = "none";
  }
   console.log(x);
  
  console.log(y);
}

</script> -->
 <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Student Type <span style="color: red"> *</span></h6>
               
                 <select id="type" name="type" value="" onchange="selectStudentType()" class="form-control"  required="">
<option value=""></option>
<option value="New Student">New Student</option>
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
<option value=""></option>
<?php
if($_SESSION['is_junior']==1){
?>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<?php
}
if($_SESSION['is_senior']==1){
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
<!--Track-->

 <!-- <div id="courseDiv" style="display: none" class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Track</h6>
               
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
            </div> -->
<!--Track-->
          

                 <!--First row-->
           

     
            <!--First row-->
            <div class="row">
              
              <div class="col-12">
                <h6 class="feature-title">Last Name <span style="color: red"> *</span></h6>
               
                 <input type="text" id="last_name"  name="last_name" class="form-control" required="" onkeydown='return restrictAlphabets(event)'  >
                <div style="height:5px"></div>
              
                </div>
            </div>
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
            function restrictAlphabets(e){
         if (e.ctrlKey || e.altKey) {
    return false;
      
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
                <input type="text" id="first_name" name="first_name"  class="form-control" onkeydown='return restrictAlphabets(event)' required=""  >
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
                <input type="date" name="birth_date" class="form-control" required=""  min="1900-01-01" >
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
               <textarea id="fathers_address" name="fathers_address" class="form-control"  cols="40" rows="2" required=""  ></textarea>
               <div style="height:5px"></div>
              </div>
            </div>


 <div class="row">
              <div class="col-12">
                <h6 class="feature-title">Mother's Name <span style="color: red"> *</span></h6>
                 <input type="text" id="mothers_name" name="mothers_name" onkeydown='return restrictAlphabets(event)' class="form-control" required=""  >
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
                 <input type="text" id="guardians_name" name="guardians_name" onkeydown='return restrictAlphabets(event)'  class="form-control" required=""  >
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
                <input type="text" id="primary_school" name="primary_school"  class="form-control" required="" >
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
               <input type="number" id="primary_year_start" min="1980"  onkeydown='return schoolYear(event,this)' name="primary_year_start"  class="form-control" required="" >
                 </div>
                   <div class="col-2">
                TO
              </div>
                <div class="col-5">
               <input type="number" id="primary_year_end" min="1980"  onkeydown='return schoolYear(event,this)' name="primary_year_end"  class="form-control" required=""  >
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
                <h6 class="feature-title">Secondary School</h6>
                <input type="text" id="secondary_school" name="secondary_school"  class="form-control" >
                <div style="height:5px"></div>
              </div>

            </div>
            <!--/First row-->

            <!--Second row-->
            <div  id="secondarySchoolYearDiv" style="display: none" class="row">
             
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
               <input type="number" id="secondary_year_end" min="1980" onkeydown='return schoolYear(event,this)' name="secondary_year_end"  class="form-control" >
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
           <!--  <div class="row">
             
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
               <input type="number" id="tertiary_year_start" onKeyDown="if(this.value.length==4) return false;" name="tertiary_year_start"  class="form-control"  required="" >
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
            --> 
          <button type="submit" style="float: right;" name="indexbtn" class="btn btn-primary btn-md" >
              Next
                <i class="fas fa-file-signature ml-1"></i>
       
        </div>
    
     
      </section>
      </form>


        </div>


<?php
  


if(isset($_POST['signupbtn'])){
  $designation = "Student";
  $username = $_POST['username'];
  $password = $_POST['password'];
   
    

    $sign_up_query = "INSERT INTO user_master (designation,username,password) VALUES ('$designation','$username',md5('$password'));";
     
  
 $sign_up_query_run = mysqli_query($connection,$sign_up_query);
  // header('Location: change_password.php');
    

    if($sign_up_query_run){
      echo "<script type='text/javascript'>
alert('Congratulations! You may now Sign in');
</script>";

    } 
}


?>






</main>

    <!--Copyright-->
    <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <div class="footer-copyright py-3">
     <?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);
if(mysqli_num_rows($query_run) > 0){
    foreach ($query_run as $row) {
      
    
    ?>
            <i class="fas fa-address-book ml-1"></i>  <?php echo $row['school_address']?>
            <?php
}
} else {
?>         
 School Address
<?php
}
?>
</div>
    <!--/.Copyright-->



  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="script/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="script/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="script/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="script/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>