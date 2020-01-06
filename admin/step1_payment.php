<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


  <?php
    
    if(isset($_POST['edit_btn']) || isset($_POST['step2cancel'])){
      $student_id = $_POST['student_id'];
    
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> STEP 1
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="step2_payment.php" method="POST">
         <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
             
 <div class="form-group">
                <label class="font-weight-bold"> Payment Scheme </label>
               <select class="form-control" name="payment_scheme_id">
                     
                  <?php
      

  $query1 = "SELECT * from payment_scheme";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $no_of_payments =  $row1['no_of_payments'];
        ?>
        <option  value="<?php echo $row1['id']; ?>"  > <?php echo $row1['scheme_name'] . ' (' . $row1['no_of_payments'] . ' payment/s)'; ?> </option>
        
      
          <?php 
        }
      

      ?>  
    </select>
              
            </div>
             <a href ="cashier_payment.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" style="float: right;" name="step2btn" class="btn btn-primary"> NEXT </button>
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