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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Requirement
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM requirement where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="requirement_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Requirement Name </label>
                <input type="text" name="edit_requirement_name" value="<?php echo $row['requirement_name']?>" class="form-control" placeholder="Enter Requirement Name">
            </div>
            <div class="form-group">
                <label>Type</label> 
                <select name="edit_type" value="<?php echo $row['type']?>" class="form-control" required="">
     <?php
         $status = $row['type'];             
        if ($status == 'Old Student') {

        echo "<option value='New Student'>New Student</option>";
        echo "<option value='Old Student' selected>Old Student</option>";
         echo "<option value='Transferee' >Transferee</option>";
    
    } else  if ($status == 'New Student') {
       echo "<option value='New Student' selected>New Student</option>";
        echo "<option value='Old Student'>Old Student</option>";
         echo "<option value='Transferee' >Transferee</option>";
    } else {
       echo "<option value='New Student'>New Student</option>";
        echo "<option value='Old Student'>Old Student</option>";
        echo "<option value='Transferee' selected>Transferee</option>";
    
    }
    ?>  
</select>
            </div>
            <a href ="requirement.php" class="btn btn-danger"> CANCEL </a>
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