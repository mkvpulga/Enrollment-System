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
     <h6 class="m-0 font-weight-bold text-primary"> EDIT Account
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	if(isset($_POST['edit_btn'])){
  		$id = $_POST['edit_id'];

  		$query = "SELECT * FROM user_master where id = '$id'";
		$query_run = mysqli_query($connection,$query);

		foreach ($query_run as $row) {
			
  	
  	?>
    <form action="account_code.php" method="POST">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
         
            <div class="form-group">
                <label>Designation</label>
                <select name="edit_designation" value="<?php echo $row['designation']?>" class="form-control" required="">
     <?php
         $status = $row['designation'];             
        if ($status == 'Cashier') {

        echo "<option value='Administrator'>Administrator</option>";
        echo "<option value='Registrar'>Registrar</option>";
        echo "<option value='Cashier' selected>Cashier</option>";

    } else if($status == 'Registrar'){
        echo "<option value='Administrator'>Administrator</option>";
        echo "<option value='Registrar' selected>Registrar</option>";
        echo "<option value='Cashier'>Cashier</option>";
    } else {
     echo "<option value='Administrator' selected>Administrator</option>";
        echo "<option value='Registrar'>Registrar</option>";
        echo "<option value='Cashier'>Cashier</option>"; 
    }
    ?>  
</select>
            </div>
          
           
            <a href ="account.php" class="btn btn-danger"> CANCEL </a>
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