<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="account_code.php" method="POST">

        <div class="modal-body">

          
            <div class="form-group">
                <label>Designation</label>
                <select name="designation" value="" class="form-control" required="">
<option value=""></option>
<option value="Administrator">Administrator</option>
<option value="Registrar">Registrar</option>
<option value="Cashier">Cashier</option>
</select>
            </div>
          
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" maxlength="20" class="form-control" placeholder="Enter Username">
            </div>
             
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Account
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="account.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Username" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['account_description'] = "gago";
    $query = "SELECT * FROM user_master where  username like '$search_params%' ";
  } else {
    $query = "SELECT * FROM user_master ";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Account
            </button>
    
  </div>

  <div class="card-body">

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
    <div class="table-responsive">
    	
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           <th> Designation </th>
            <th>Username</th>
             
            <th>EDIT </th>
             <th>RESET PASSWORD</th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
           <td> <?php  echo $row['designation']; ?></td>
            <td> <?php  echo $row['username']; ?> </td>
           
            <td>
                <form action="account_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <?php
                    if ($row['designation'] != 'Student'){
                    ?>
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                    <?php
                  }
                    ?>
                </form>
            </td>
             <td>
              <form action="account_code.php" onsubmit="return confirm('Do you really want to submit the form?');" method="POST">
                    <input type="hidden" name="reset_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="resetpassbtn" class="btn btn-danger"> RESET PASSWORD</button>
                </form> 
            
              </td>
            <td>
                <form action="account_code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="designation" value="<?php echo $row['designation']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
     		<?php }
     	} else {
     	echo "No Record Found";
     }

     	?>
          
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

  

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>