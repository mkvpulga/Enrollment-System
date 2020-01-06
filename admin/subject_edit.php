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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Subject
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM subject where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="subject_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Subject Code </label>
                <input type="text" name="edit_subject_code" value="<?php echo $row['subject_code']?>" class="form-control" placeholder="Enter Subject Code">
            </div>
            <div class="form-group">
                <label>Subject Description</label>
                <input type="text" name="edit_subject_description" value="<?php echo $row['subject_description']?>" class="form-control" placeholder="Enter Subject Description">
            </div>
                       
<?php
if($_SESSION['is_senior']==true){
?>
           <div class="form-group">
                <label>Unit</label>
                 <input type="number" name="edit_unit" value="<?php echo $row['unit']?>" class="form-control" placeholder="Enter Unit">
            </div>
           
<?php
}
?>
            
            <div class="form-group">
                <label>Status</label>
                <select name="edit_status" class="form-control" value="<?php echo $row['status']?>">
                      <?php
         $status = $row['status'];             
        if ($status == 'CLOSE') {

        echo "<option value='OPEN'>OPEN</option>";
        echo "<option value='CLOSE' selected>CLOSE</option>";

    } else {
        echo "<option value='OPEN' selected>OPEN</option>";
        echo "<option value='CLOSE'>CLOSE</option>";
    }
    ?>  
</select>
            </div>
            <a href ="subject.php" class="btn btn-danger"> CANCEL </a>
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