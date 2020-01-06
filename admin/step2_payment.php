<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


  <?php
    
    if(isset($_POST['step2btn']) || isset($_POST['payment_cancel'])){
      $student_id = $_POST['student_id'];
    $payment_scheme_id = $_POST['payment_scheme_id'];
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> STEP 2
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="cashier_payment_edit.php" method="POST">
         <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
         <input type="hidden" name="payment_scheme_id" value="<?php echo $payment_scheme_id; ?>">
             
<div class<div class="form-group">
               <label>Payment Scheme</label>
               <?php
      

  $query1 = "SELECT * from payment_scheme where id = $payment_scheme_id";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $no_of_payments =  $row1['no_of_payments'];
        ?>
        <input type="text" id="total_tuition" name="total_tuition"  value="<?php echo $row1['scheme_name'] . ' (' . $row1['no_of_payments'] . ' payment/s)'; ?>" class="form-control"    disabled="">
               
        
      
          <?php 
        }
      

      ?>  
             </div>
 <div class<div class="form-group">
               <label>Discount</label>
<!-- <input type="text"  id="scheme_id" name="scheme_id"  class="form-control" placeholder="Enter Subject"> -->
                <select class="form-control" name="discount_id">
                     
                  <?php
      

  $query1 = "SELECT * from discount";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
           $discount_rate =  $row1['discount_rate'];
           if( $discount_rate == 0 ){
             $discount_rate = null;
           }
    
      ?>
     
        <option  value="<?php echo $row1['id']; ?>"> <?php echo $row1['discount_name'] . ' (' . $row1['discount_rate'] . '%)'; ?></option>
        
        
      
          <?php }
      

      ?>  
    </select>
            </div>
 <button type="submit" name="step2next" style="float: right;" class="btn btn-primary"> NEXT </button>
         
             </form>
             <form action="step1_payment.php" method="post">
                  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                  <input type="hidden" name="payment_scheme_id" value="<?php echo $payment_scheme_id; ?>">
                  <button type="submit" name="step2cancel" class="btn btn-danger"> BACK</button>
                </form>
            
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
      
    }
            ?>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>