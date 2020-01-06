<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


  <?php
    
    if(isset($_POST['step2next'])){
      $student_id = $_POST['student_id'];
    $payment_scheme_id = $_POST['payment_scheme_id'];
    $discount_id = $_POST['discount_id'];
    
      $query = "SELECT stu.id as student_id, cou.id as course_id, stu.first_name, stu.middle_name, stu.last_name, stu.suffix, cou.course_description, cou.course_code, cou.semester, cou.year FROM student stu left join course cou on stu.course_id = cou.id where stu.id = '$student_id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {

    $stud_course = $row['course_id'];
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Payment
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="cashier_payment_code.php" method="POST">
         <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
         <input type="hidden" name="payment_scheme_id" value="<?php echo $payment_scheme_id; ?>">
         <input type="hidden" name="discount_id" value="<?php echo $discount_id; ?>">
             
 <div class="form-group">
                <label class="font-weight-bold"> STUDENT NAME </label>
                <input type="text" name="student_name" class="form-control" value="<?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?>" placeholder="Enter Student Name" readonly="">
                  
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> COURSE </label>
                <input type="text" name="course_description" class="form-control" value="<?php echo $row['course_description']; ?>" placeholder="Enter Track Description" readonly="">
                
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> SEMESTER </label>
                <input type="text" name="semester" class="form-control" value="<?php echo $row['semester']; ?>" placeholder="Enter Semester" readonly="">
                
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> GRADE </label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['year']; ?>" placeholder="Enter Grade" readonly="">
                
              
            </div>
           
            <div class="form-group">
                <label class="font-weight-bold">MISCELLANEOUS</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT cm.id as course_misc_id, mis.id as miscellaneous_id, mis.miscellaneous_name, mis.amount from course_misc cm left join miscellaneous mis on cm.miscellaneous_id = mis.id where cm.course_id = $stud_course";
  $total_misc = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_misc += $row['amount'];
       
                ?>
                <?php  echo $row['miscellaneous_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
            }
               ?>
                <input type="text" id="total_misc_amount" name="total_misc_amount" value="<?php echo number_format($total_misc,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>
              
<div class="form-group">
                <label class="font-weight-bold" >OTHER FEES</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT co.id as course_other_id, of.id as other_fees_id, of.fee_name, of.amount from course_other co left join other_fees of on co.other_fee_id = of.id where co.course_id = $stud_course";
  $total_other = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_other += $row['amount'];
       
                ?>
                <?php  echo $row['fee_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
            }
               ?>
                <input type="text" id="total_other_amount" name="total_other_amount" value="<?php echo number_format($total_other,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>


            



<div class="form-group">
               <label class="font-weight-bold">PAYMENT SCHEME</label>
     <?php
      

  $query1 = "SELECT * from payment_scheme where id = $payment_scheme_id";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $no_of_payments =  $row1['no_of_payments'];
    $increase_rate =  $row1['increase_rate'];
        ?>
        <input type="text" id="total_tuition" name="total_tuition"  value="<?php echo $row1['scheme_name'] . ' (' . $row1['no_of_payments'] . ' payment/s)'; ?>" class="form-control"    readonly="">
               
        
      
          <?php 
        }
      

      ?>  
            </div>


<div class="form-group">
               <label class="font-weight-bold">DISCOUNT</label>
 <?php
      

  $query1 = "SELECT * from discount where id = $discount_id";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $discount_rate =  $row1['discount_rate'];
        ?>
        <input type="text" id="total_discount" name="total_discount"  value="<?php echo $row1['discount_name'] . ' (' . $row1['discount_rate'] . '%)'; ?>" class="form-control"    readonly="">
               
        
      
          <?php 
        }
      

      ?>              
    </div>


             <div class="form-group">
                <label class="font-weight-bold">TOTAL TUITION FEE</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT cur.id as curriculum_id, uf.id as unit_fee_id, sub.id as subject_id, uf.amount_per_unit, sub.subject_code, sub.subject_description, sub.unit from curriculum cur left join unit_fee uf on cur.course_id = uf.course_id left join subject sub on cur.subject_id = sub.id where cur.course_id = $stud_course";
  $total_tuition = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_tuition += $row['amount_per_unit'] * $row['unit'];
                ?>
                <?php  echo $row['subject_description'] . ' (' . $row['unit'] . ')'; ?> <br>
                <?php
            }
            if( $increase_rate == 0 && $discount_rate == 0){
             $total_tuition_fee = $total_tuition  / $no_of_payments;
              $total_tuition_fee_balance = $total_tuition ;
           } else if( $increase_rate == 0 && $discount_rate != 0){
             $total_tuition_fee = (($total_tuition - (($discount_rate / 100) * $total_tuition)) / $no_of_payments); 
             $total_tuition_fee_balance = ($total_tuition - (($discount_rate / 100) * $total_tuition)); 
              
           }else if( $increase_rate != 0 && $discount_rate == 0){
             $total_tuition_fee = (($total_tuition + (($increase_rate / 100) * $total_tuition)) / $no_of_payments); 
             $total_tuition_fee_balance = ($total_tuition + (($increase_rate / 100) * $total_tuition)); 
              
           } else {
             $total_tuition_fee =  ((($total_tuition + (($increase_rate / 100) * $total_tuition)) - (($discount_rate / 100) * $total_tuition)) / $no_of_payments); 
            $total_tuition_fee_balance =  (($total_tuition + (($increase_rate / 100) * $total_tuition)) - (($discount_rate / 100) * $total_tuition)); 
           }
           $amount_to_pay = $total_misc + $total_other + $total_tuition_fee;
           $balance = $total_misc + $total_other + $total_tuition_fee_balance;
                
               ?>
                <input type="text" id="total_tuition" name="total_tuition" value="<?php echo number_format($total_tuition_fee_balance,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>
             <div class="form-group" >
                <label class="font-weight-bold">TUITION FEE PER PAYMENT</label>
                
                
                <input type="text" id="tuition_per_payment" name="tuition_per_payment" value="<?php echo number_format($total_tuition_fee,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
              <div class="form-group" >
                <label class="font-weight-bold">BALANCE</label>
                
                
                <input type="text" id="balance" name="balance" value="<?php echo number_format($balance,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
            <div class="form-group" >
                <label class="font-weight-bold">AMOUNT TO PAY</label>
                
                
                <input type="text" id="amount_to_pay" name="amount_to_pay" value="<?php echo number_format($amount_to_pay,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
            <div class="form-group" >
                <label class="font-weight-bold">PAYMENT AMOUNT</label>
                
                
                <input type="number" id="amount_paid" name="amount_paid"  class="form-control" step=".01" >
                
            </div>
            <button type="submit" name="savebtn" style="float: right;" class="btn btn-primary"> Save </button>

          </form>
             <form action="step2_payment.php" method="post">
                  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                  <input type="hidden" name="payment_scheme_id" value="<?php echo $payment_scheme_id; ?>">
                  <input type="hidden" name="discount_id" value="<?php echo $discount_id; ?>">
                  <button type="submit" name="payment_cancel" class="btn btn-danger"> BACK</button>
                </form>
            
    </div>
  </div>
</div>

<!-- /.container-fluid -->
<?php
        }
    }
            ?>






  <?php
    
    if(isset($_POST['edit_btn'])){
     $payment_id = $_POST['payment_id'];
      $query = "SELECT pay.id as payment_id, pay.payment_scheme_id, pay.discount_id, pay.amount_paid, pay.balance, pay.user, pay.date_of_payment, stu.id as student_id, cou.id as course_id, stu.first_name, stu.middle_name, stu.last_name, stu.suffix, cou.course_description, cou.course_code, cou.semester, cou.year FROM payment pay left join student stu on pay.student_id = stu.id left join course cou on stu.course_id = cou.id where pay.id = '$payment_id'";
    $query_run = mysqli_query($connection,$query);

    foreach ($query_run as $row) {
       $student_id = $row['student_id'];
    $payment_scheme_id = $row['payment_scheme_id'];
    $discount_id = $row['discount_id'];
    $balance = $row['balance'];
    $amount_paid = $row['amount_paid'];
      
    $stud_course = $row['course_id'];
    ?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Payment
            
    </h6>
  </div>

  <div class="card-body">
  
    <form action="cashier_payment_code.php" method="POST">
         <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
         <input type="hidden" name="payment_scheme_id" value="<?php echo $payment_scheme_id; ?>">
         <input type="hidden" name="discount_id" value="<?php echo $discount_id; ?>">
             
 <div class="form-group">
                <label class="font-weight-bold"> STUDENT NAME </label>
                \<input type="text" name="student_name" class="form-control" value="<?php  echo $row['first_name'] , " " , $row['middle_name'] , " " , $row['last_name'] , " " , $row['suffix']; ?>" placeholder="Enter Student Name" readonly="">
                  
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> COURSE </label>
                <input type="text" name="course_description" class="form-control" value="<?php echo $row['course_description']; ?>" placeholder="Enter Track Description" readonly="">
                
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> SEMESTER </label>
                <input type="text" name="semester" class="form-control" value="<?php echo $row['semester']; ?>" placeholder="Enter Semester" readonly="">
                
              
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> GRADE </label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['year']; ?>" placeholder="Enter Grade" readonly="">
                
              
            </div>
           
            <div class="form-group">
                <label class="font-weight-bold">MISCELLANEOUS</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT cm.id as course_misc_id, mis.id as miscellaneous_id, mis.miscellaneous_name, mis.amount from course_misc cm left join miscellaneous mis on cm.miscellaneous_id = mis.id where cm.course_id = $stud_course";
  $total_misc = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_misc += $row['amount'];
       
                ?>
                <?php  echo $row['miscellaneous_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
            }
               ?>
                <input type="text" id="total_misc_amount" name="total_misc_amount" value="<?php echo number_format($total_misc,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>
              
<div class="form-group">
                <label class="font-weight-bold" >OTHER FEES</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT co.id as course_other_id, of.id as other_fees_id, of.fee_name, of.amount from course_other co left join other_fees of on co.other_fee_id = of.id where co.course_id = $stud_course";
  $total_other = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_other += $row['amount'];
       
                ?>
                <?php  echo $row['fee_name'] . ' (' . number_format($row['amount'],2, '.', ',') . ')'; ?> <br>
                <?php
            }
               ?>
                <input type="text" id="total_other_amount" name="total_other_amount" value="<?php echo number_format($total_other,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>


            



<div class="form-group">
               <label class="font-weight-bold">PAYMENT SCHEME</label>
     <?php
      

  $query1 = "SELECT * from payment_scheme where id = $payment_scheme_id";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $no_of_payments =  $row1['no_of_payments'];
    $increase_rate =  $row1['increase_rate'];
        ?>
        <input type="text" id="total_tuition" name="total_tuition"  value="<?php echo $row1['scheme_name'] . ' (' . $row1['no_of_payments'] . ' payment/s)'; ?>" class="form-control"    readonly="">
               
        
      
          <?php 
        }
      

      ?>  
            </div>


<div class="form-group">
               <label class="font-weight-bold">DISCOUNT</label>
 <?php
      

  $query1 = "SELECT * from discount where id = $discount_id";
  $query_run1 = mysqli_query($connection,$query1);
        while($row1 = mysqli_fetch_assoc($query_run1)){
     $discount_rate =  $row1['discount_rate'];
        ?>
        <input type="text" id="total_discount" name="total_discount"  value="<?php echo $row1['discount_name'] . ' (' . $row1['discount_rate'] . '%)'; ?>" class="form-control"    readonly="">
               
        
      
          <?php 
        }
      

      ?>              
    </div>


             <div class="form-group">
                <label class="font-weight-bold">TOTAL TUITION FEE</label><br>
                  <?php
         
      
     
      //retrieve records
  

   //$_POST['course_description'] = "gago";
    $query = "SELECT cur.id as curriculum_id, uf.id as unit_fee_id, sub.id as subject_id, uf.amount_per_unit, sub.subject_code, sub.subject_description, sub.unit from curriculum cur left join unit_fee uf on cur.course_id = uf.course_id left join subject sub on cur.subject_id = sub.id where cur.course_id = $stud_course";
  $total_tuition = 0.00;
  $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $total_tuition += $row['amount_per_unit'] * $row['unit'];
                ?>
                <?php  echo $row['subject_description'] . ' (' . $row['unit'] . ')'; ?> <br>
                <?php
            }
            if( $increase_rate == 0 && $discount_rate == 0){
             $total_tuition_fee = $total_tuition  / $no_of_payments;
              $total_tuition_fee_balance = $total_tuition ;
           } else if( $increase_rate == 0 && $discount_rate != 0){
             $total_tuition_fee = (($total_tuition - (($discount_rate / 100) * $total_tuition)) / $no_of_payments); 
             $total_tuition_fee_balance = ($total_tuition - (($discount_rate / 100) * $total_tuition)); 
              
           }else if( $increase_rate != 0 && $discount_rate == 0){
             $total_tuition_fee = (($total_tuition + (($increase_rate / 100) * $total_tuition)) / $no_of_payments); 
             $total_tuition_fee_balance = ($total_tuition + (($increase_rate / 100) * $total_tuition)); 
              
           } else {
             $total_tuition_fee =  ((($total_tuition + (($increase_rate / 100) * $total_tuition)) - (($discount_rate / 100) * $total_tuition)) / $no_of_payments); 
            $total_tuition_fee_balance =  (($total_tuition + (($increase_rate / 100) * $total_tuition)) - (($discount_rate / 100) * $total_tuition)); 
           }
           $amount_to_pay = $total_tuition_fee;
                 
               ?>
                <input type="text" id="total_tuition" name="total_tuition" value="<?php echo number_format($total_tuition_fee_balance,2, '.', ','); ?>" class="form-control"    readonly="">
               
           
            </div>
             <div class="form-group" >
                <label class="font-weight-bold">TUITION FEE PER PAYMENT</label>
                
                
                <input type="text" id="tuition_per_payment" name="tuition_per_payment" value="<?php echo number_format($total_tuition_fee,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
              <div class="form-group" >
                <label class="font-weight-bold">BALANCE</label>
                
                
                <input type="text" id="balance" name="balance" value="<?php echo number_format($balance,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
            <div class="form-group" >
                <label class="font-weight-bold">AMOUNT PAID</label>
                
                
                <input type="text" id="saved_amount_paid" name="saved_amount_paid" value="<?php echo number_format($amount_paid,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
            <div class="form-group" >
                <label class="font-weight-bold">AMOUNT TO PAY</label>
                
                
                <input type="text" id="amount_to_pay" name="amount_to_pay" value="<?php echo number_format($amount_to_pay,2, '.', ','); ?>" class="form-control"    readonly="">
                
            </div>
            <div class="form-group" >
                <label class="font-weight-bold">PAYMENT AMOUNT</label>
                
                
                <input type="number" id="amount_paid" name="amount_paid"  class="form-control" step=".01" >
                
            </div>
            <a href ="cashier_payment.php" class="btn btn-danger"> CANCEL </a>
            
            <button type="submit" name="updatebtn" style="float: right;" class="btn btn-primary"> Save </button>

          </form>
            
    </div>
  </div>
</div>

<!-- /.container-fluid -->
<?php
        }
    }
            ?>





<?php
include('includes/scripts.php');
include('includes/footer.php');
?>