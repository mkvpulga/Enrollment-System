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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Payment Scheme
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM payment_scheme where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="payment_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Scheme Name </label>
                <input type="text" name="edit_scheme_name" value="<?php echo $row['scheme_name']?>" class="form-control" placeholder="Enter Scheme Name">
            </div>
            
            <div class="form-group">
                <label>Number of Payments</label>
                <input type="number" name="edit_no_of_payments" value="<?php echo $row['no_of_payments']?>" class="form-control" placeholder="Enter Number of Payments">
            </div>
           
            <div class="form-group" style="position: relative;">
                <label>Increase Rate</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" name="edit_increase_rate" value="<?php echo $row['increase_rate']?>"  class="form-control" >
                <span id="my-suffix" style="position: absolute; left: 0; top: 40px;  padding-left: 50px; ">%</span>
            </div>

            <a href ="payment.php" class="btn btn-danger"> CANCEL </a>
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