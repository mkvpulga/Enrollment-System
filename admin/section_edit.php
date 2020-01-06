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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Section
            
    </h6>
  </div>

  <div class="card-body">

    <?php
    

    
  	
  	if(isset($_POST['edit_section_btn'])){
  		$id = $_POST['edit_section_id'];

  		$query = "SELECT * from section where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="room_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Section Code  </label>
 <input type="text" name="edit_section_code" class="form-control" value="<?php echo $row['section_code']?>" placeholder="Enter Section Code">
    </div>
  
       <div class="form-group">
                <label> Section Description</label>
              <input type="text" name="edit_section_description" class="form-control" value="<?php echo $row['section_description']?>" placeholder="Enter Section Description">
    </div>
             <div class="form-group">
                <label> Capacity</label>
              <input type="text" name="edit_capacity" class="form-control" value="<?php echo $row['capacity']?>" placeholder="Enter Capacity">
    </div>
            
           
            
            <a href ="room.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="sectionUpdateBtn" class="btn btn-primary"> Update </button>
          </form>
            <?php
        }
    }
            ?>
    </div>
  </div>
</div>

<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>