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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Discount
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn_discount'])){
  		$id = $_POST['edit_id_discount'];

  		$query = "SELECT * FROM discount where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="payment_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
<div class="form-group">
                <label> Discount Name </label>
                <input type="text" name="edit_discount_name" value="<?php echo $row['discount_name']?>" class="form-control" placeholder="Enter Discount Name">
            </div>
            
            <div class="form-group" style="position: relative;">
                <label>Discount Rate</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" name="edit_discount_rate" value="<?php echo $row['discount_rate']?>"  class="form-control" >
                <span id="my-suffix" style="position: absolute; left: 0; top: 40px;  padding-left: 50px; ">%</span>
            </div>
           
            <a href ="payment.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtnDiscount" class="btn btn-primary"> Update </button>
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