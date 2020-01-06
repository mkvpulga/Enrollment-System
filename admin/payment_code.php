<?php
	session_start();
include_once 'includes/connection.php'; 
	
	//initialize variables
	$scheme_name = "";
	$no_of_payments = "";
	
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	if(isset($_POST['registerbtn'])){
		$scheme_name = $_POST['scheme_name'];
		$no_of_payments = $_POST['no_of_payments'];
$increase_rate = $_POST['increase_rate'];
				

		$query = "INSERT INTO payment_scheme (scheme_name,no_of_payments,increase_rate) VALUES ('$scheme_name','$no_of_payments','$increase_rate')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: payment.php');
	
			$_SESSION['success'] = "Payment Scheme Added";
		} else{
			header('Location: payment.php');
			$_SESSION['status'] = "Payment Scheme not Added";
		}
	
		
	}

	if (isset($_POST['updatebtn'])){
		$id = $_POST['edit_id'];
		$scheme_name = $_POST['edit_scheme_name'];
	$no_of_payments = $_POST['edit_no_of_payments'];
	$increase_rate = $_POST['edit_increase_rate'];
	 
 	$query = "UPDATE payment_scheme SET scheme_name = '$scheme_name', no_of_payments = '$no_of_payments', increase_rate = '$increase_rate' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['success'] = "Payment Scheme Updated";
		} else{
			header('Location: payment.php');
			$_SESSION['status'] = "Payment Scheme not Updated";
		}
	
	} 


if (isset($_POST['delete_btn'])){
		$id = $_POST['delete_id'];
		
 	$query = "DELETE FROM payment_scheme WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['success'] = "Payment Scheme Deleted";
		} else{
			header('Location: payment.php');
			$_SESSION['status'] = "Payment Scheme not Deleted";
		}
	} 



	if(isset($_POST['saveDiscount'])){
		$discount_name = $_POST['discount_name'];
		$discount_rate = $_POST['discount_rate'];
		

		$query = "INSERT INTO discount (discount_name,discount_rate) VALUES ('$discount_name','$discount_rate')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successDiscount'] = "Discount Added";
		} else{
			header('Location: payment.php');
			$_SESSION['statusDiscount'] = "Discount not Added";
		}
	
		
	}

	if (isset($_POST['updatebtnDiscount'])){
		$id = $_POST['edit_id'];
		$discount_name = $_POST['edit_discount_name'];
	$discount_rate = $_POST['edit_discount_rate'];
	 
 	$query = "UPDATE discount SET discount_name = '$discount_name', discount_rate = '$discount_rate' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successDiscount'] = "Discount Updated";
		} else{
			header('Location: payment.php');
			$_SESSION['statusDiscount'] = "Discount not Updated";
		}
	
	} 


if (isset($_POST['delete_btn_discount'])){
		$id = $_POST['delete_id_discount'];
		
 	$query = "DELETE FROM discount WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successDiscount'] = "Discount Deleted";
		} else{
			header('Location: payment.php');
			$_SESSION['statusDiscount'] = "Discount not Deleted";
		}
	} 



if(isset($_POST['saveMiscellaneous'])){
		$miscellaneous_name = $_POST['miscellaneous_name'];
		$amount = $_POST['amount'];
		

		$query = "INSERT INTO miscellaneous (miscellaneous_name,amount) VALUES ('$miscellaneous_name','$amount')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successMiscellaneous'] = "Miscellaneous Added";
		} else{
			header('Location: payment.php');
			$_SESSION['statusMiscellaneous'] = "Miscellaneous not Added";
		}
	
		
	}

	if (isset($_POST['updatebtnMiscellaneous'])){
		$id = $_POST['edit_id'];
		$miscellaneous_name = $_POST['edit_miscellaneous_name'];
	$amount = $_POST['edit_amount'];
	 
 	$query = "UPDATE miscellaneous SET miscellaneous_name = '$miscellaneous_name', amount = '$amount' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successMiscellaneous'] = "Miscellaneous Updated";
		} else{
			header('Location: payment.php');
			$_SESSION['statusMiscellaneous'] = "Miscellaneous not Updated";
		}
	
	} 


if (isset($_POST['delete_btn_miscellaneous'])){
		$id = $_POST['delete_id_miscellaneous'];
		
 	$query = "DELETE FROM miscellaneous WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successMiscellaneous'] = "Miscellaneous Deleted";
		} else{
			header('Location: payment.php');
			$_SESSION['statusMiscellaneous'] = "Miscellaneous not Deleted";
		}
	}



if(isset($_POST['saveOtherFees'])){
		$otherFees_name = $_POST['otherFees_name'];
		$amount = $_POST['amount'];
		

		$query = "INSERT INTO other_fees (fee_name,amount) VALUES ('$otherFees_name','$amount')";
		
		
			$query_run = mysqli_query($connection,$query);
		if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successOtherFees'] = "Other Fees Added";
		} else{
			header('Location: payment.php');
			$_SESSION['statusOtherFees'] = "Other Fees not Added";
		}
	
		
	}

	if (isset($_POST['updatebtnOtherFees'])){
		$id = $_POST['edit_id'];
		$otherFees_name = $_POST['edit_otherFees_name'];
	$amount = $_POST['edit_amount'];
	 
 	$query = "UPDATE other_fees SET fee_name = '$otherFees_name', amount = '$amount' where id = '$id'";

 
 	
				$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successOtherFees'] = "Other Fees Updated";
		} else{
			header('Location: payment.php');
			$_SESSION['statusOtherFees'] = "Other Fees not Updated";
		}
	
	} 


if (isset($_POST['delete_btn_otherFees'])){
		$id = $_POST['delete_id_otherFees'];
		
 	$query = "DELETE FROM other_fees WHERE id = '$id'";

 	$query_run = mysqli_query($connection,$query);
 	if($query_run){
			header('Location: payment.php');
	
			$_SESSION['successOtherFees'] = "OtherFees Deleted";
		} else{
			header('Location: payment.php');
			$_SESSION['statusOtherFees'] = "OtherFees not Deleted";
		}
	}

?>

