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
        <h5 class="modal-title" id="exampleModalLabel">Add Payment Scheme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="payment_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Scheme Name </label>
                <input type="text" name="scheme_name" class="form-control" placeholder="Enter Scheme Name">
            </div>
            
            <div class="form-group">
                <label>Number of Payments</label>
                <input type="number" name="no_of_payments" class="form-control" placeholder="Enter Number of Payments">
            </div>
             <div class="form-group" style="position: relative;">
                <label>Increase Rate</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" name="increase_rate"  class="form-control" >
                <span id="my-suffix" style="position: absolute; left: 0; top: 40px;  padding-left: 50px; ">%</span>
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
<h6 class="m-0 font-weight-bold text-primary">Payment Scheme
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="payment.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Scheme Name" aria-label="Search" aria-describedby="basic-addon2">
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
   //$_POST['course_description'] = "gago";
    $query = "SELECT * FROM payment_scheme where scheme_name like  '$search_params%'";
  } else {
    $query = "SELECT * FROM payment_scheme";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Payment Scheme
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
            <th> Scheme Name </th>
            <th> Number of Payments </th>
           <th> Increase Rate </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
     			?>
     			<tr>
            <td> <?php  echo $row['scheme_name']; ?></td>
            <td> <?php  echo $row['no_of_payments']; ?></td>
            <td> <?php  echo $row['increase_rate']; ?>%</td>
            
            <td>
                <form action="payment_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="payment_code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
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



<div class="modal fade" id="addDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="payment_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Discount Name </label>
                <input type="text" name="discount_name" class="form-control" placeholder="Enter Discount Name">
            </div>
            
            <div class="form-group" style="position: relative;">
                <label>Discount Rate</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" name="discount_rate"  class="form-control" >
                <span id="my-suffix" style="position: absolute; left: 0; top: 40px;  padding-left: 50px; ">%</span>
            </div>
          
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveDiscount" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Discount
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="payment.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_discount" name="search_discount" placeholder="Discount Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchDiscountBtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchDiscountBtn'])){
    $search_discount = "";
      $search_discount = $_POST['search_discount'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * FROM discount where discount_name like  '$search_discount%'";
  } else {
    $query = "SELECT * FROM discount";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addDiscount">
              Add Discount
            </button>
    
  </div>

  <div class="card-body">

<?php
    if(isset($_SESSION['successDiscount']) && $_SESSION['successDiscount'] != ''){
      echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['successDiscount'].' </h2> ';
      unset($_SESSION['successDiscount']);
    }

  if(isset($_SESSION['statusDiscount']) && $_SESSION['statusDiscount'] != ''){
      echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['statusDiscount'].' </h2> ';
      unset($_SESSION['statusDiscount']);
    }

    ?>
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Discount Name </th>
            <th> Discount Rate </th>
           
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
      <?php
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
            <td> <?php  echo $row['discount_name']; ?></td>
            <td> <?php  echo $row['discount_rate']; ?>%</td>
            
            <td>
                <form action="discount_edit.php" method="POST">
                    <input type="hidden" name="edit_id_discount" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn_discount" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="payment_code.php" method="post">
                  <input type="hidden" name="delete_id_discount" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn_discount" class="btn btn-danger"> DELETE</button>
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



<div class="modal fade" id="addMiscellaneous" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Miscellaneous</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="payment_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Miscellaneous Name </label>
                <input type="text" name="miscellaneous_name" class="form-control" placeholder="Enter Miscellaneous Name" >
            </div>
            
            <div class="form-group" style="position: relative;">
                <label>Amount</label>
                <input type="number" name="amount"  class="form-control" placeholder="Enter Amount" step=".01" >
                
            </div>
          
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveMiscellaneous" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Miscellaneous
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="payment.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_miscellaneous" name="search_miscellaneous" placeholder="Miscellaneous Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchMiscellaneousBtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchMiscellaneousBtn'])){
    $search_miscellaneous = "";
      $search_miscellaneous = $_POST['search_miscellaneous'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * FROM miscellaneous where miscellaneous_name like  '$search_miscellaneous%'";
  } else {
    $query = "SELECT * FROM miscellaneous";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addMiscellaneous">
              Add Miscellaneous
            </button>
    
  </div>

  <div class="card-body">

<?php
    if(isset($_SESSION['successMiscellaneous']) && $_SESSION['successMiscellaneous'] != ''){
      echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['successMiscellaneous'].' </h2> ';
      unset($_SESSION['successMiscellaneous']);
    }

  if(isset($_SESSION['statusMiscellaneous']) && $_SESSION['statusMiscellaneous'] != ''){
      echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['statusMiscellaneous'].' </h2> ';
      unset($_SESSION['statusMiscellaneous']);
    }

    ?>
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Miscellaneous Name </th>
            <th> Amount </th>
           
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
      <?php
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
            <td> <?php  echo $row['miscellaneous_name']; ?></td>
            <td> <?php  echo $row['amount']; ?></td>
            
            <td>
                <form action="miscellaneous_edit.php" method="POST">
                    <input type="hidden" name="edit_id_miscellaneous" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn_miscellaneous" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="payment_code.php" method="post">
                  <input type="hidden" name="delete_id_miscellaneous" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn_miscellaneous" class="btn btn-danger"> DELETE</button>
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




<div class="modal fade" id="addOtherFees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add OtherFees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="payment_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> OtherFees Name </label>
                <input type="text" name="otherFees_name" class="form-control" placeholder="Enter OtherFees Name" >
            </div>
            
            <div class="form-group" style="position: relative;">
                <label>Amount</label>
                <input type="number" name="amount"  class="form-control" placeholder="Enter Amount" step=".01" >
                
            </div>
          
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveOtherFees" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Other Fees
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <form action="payment.php" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_otherFees" name="search_otherFees" placeholder="Other Fee Name" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchOtherFeesBtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchOtherFeesBtn'])){
    $search_otherFees = "";
      $search_otherFees = $_POST['search_otherFees'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT * FROM other_fees where fee_name like  '$search_otherFees%'";
  } else {
    $query = "SELECT * FROM other_fees";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>

          

             <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addOtherFees">
              Add Other Fees
            </button>
    
  </div>

  <div class="card-body">

<?php
    if(isset($_SESSION['successOtherFees']) && $_SESSION['successOtherFees'] != ''){
      echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['successOtherFees'].' </h2> ';
      unset($_SESSION['successOtherFees']);
    }

  if(isset($_SESSION['statusOtherFees']) && $_SESSION['statusOtherFees'] != ''){
      echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['statusOtherFees'].' </h2> ';
      unset($_SESSION['statusOtherFees']);
    }

    ?>
    <div class="table-responsive">
      
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Other Fee Name </th>
            <th> Amount </th>
           
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
      <?php
      if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
          ?>
          <tr>
            <td> <?php  echo $row['fee_name']; ?></td>
            <td> <?php  echo $row['amount']; ?></td>
            
            <td>
                <form action="otherFees_edit.php" method="POST">
                    <input type="hidden" name="edit_id_otherFees" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn_otherFees" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="payment_code.php" method="post">
                  <input type="hidden" name="delete_id_otherFees" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn_otherFees" class="btn btn-danger"> DELETE</button>
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