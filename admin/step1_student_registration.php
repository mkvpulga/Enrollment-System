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
     <h6 class="m-0 font-weight-bold text-primary"> STEP 1
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="step1_student_registration.php" method="POST">
             
 <div class="form-group">
                <label class="font-weight-bold"> Username </label>
                <input type="text" id="username" name="username" class="form-control"  >
                
              
            </div>
             <button type="submit" style="float: right;" name="step2btn" class="btn btn-primary"> NEXT </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
     

    if(isset($_POST['step2btn'])){
  $designation = "Student";
  $username = $_POST['username'];
   
    

    $sign_up_query = "INSERT INTO user_master (designation,username,password) VALUES ('$designation','$username',md5('admin'));";
     
  
 $sign_up_query_run = mysqli_query($connection,$sign_up_query);
  // header('Location: change_password.php');
    

    if($sign_up_query_run){
      $_SESSION['reg_stud_username'] = $username;
      $_SESSION['stud_reg'] = 'true';
      echo "<script type='text/javascript'>
window.location='information_create.php';
</script>";

    } 
}
            ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>