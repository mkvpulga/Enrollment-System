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

  		$query = "SELECT * FROM room where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="room_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Room Number </label>
                <input type="text" name="edit_room_no" value="<?php echo $row['room_no']?>" class="form-control" placeholder="Enter Room Number">
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="text" name="edit_capacity" value="<?php echo $row['capacity']?>" class="form-control" placeholder="Enter Capacity">
            </div>
            
            <a href ="room.php" class="btn btn-danger"> CANCEL </a>
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