<?php
	session_start();
include_once 'includes/connection.php'; 
	
	//initialize variables
	$course_code = "";
	$course_description = "";
	$year = "";
	$semester = "";
	$id = 0;
	$edit_state = false;

	//connect to database
	

	//if save button is clicked
	
	
	if (isset($_POST['savebtn'])){
		$student_id = $_POST["student_id"];
		$payment_scheme_id = $_POST["payment_scheme_id"];
		$discount_id = $_POST["discount_id"];
$amount_to_pay = str_replace(",","",$_POST["amount_to_pay"]);				
$amount_paid = $_POST["amount_paid"];
if($amount_paid == ''){
	$amount_paid = 0;
}
$balance = str_replace(",","",$_POST["balance"]) - $_POST["amount_paid"];
$user_id = $_SESSION["user_id"];

$query1 = "SELECT * from user_master where id = '$user_id'";
 	 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$user = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
    	}
$date_of_payment = date("F d, Y h:i:s");

 	$query = "INSERT INTO payment (student_id,  amount_paid, balance, payment_scheme_id, discount_id, user, date_of_payment) VALUES ('$student_id', '$amount_paid', '$balance', '$payment_scheme_id', '$discount_id','$user', '$date_of_payment')";
 	 $query_run = mysqli_query($connection,$query);
   
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: cashier_payment.php');
	
			$_SESSION['success'] = "Payment Added";
		} else{
			header('Location: cashier_payment.php');
			$_SESSION['status'] = "Payment Not Added" ;
		}
	}
	


	if (isset($_POST['updatebtn'])){
		$payment_id = $_POST["payment_id"];
		$student_id = $_POST["student_id"];
		$payment_scheme_id = $_POST["payment_scheme_id"];
		$discount_id = $_POST["discount_id"];
$amount_to_pay = str_replace(",","",$_POST["amount_to_pay"]);				
$amount_paid = str_replace(",","",$_POST["saved_amount_paid"]) + $_POST["amount_paid"];
if($amount_paid == ''){
	$amount_paid = 0;
}
$balance = str_replace(",","",$_POST["balance"]) - $_POST["amount_paid"];
$user_id = $_SESSION["user_id"];

$query1 = "SELECT * from user_master where id = '$user_id'";
 	 $query_run1 = mysqli_query($connection,$query1);
    while($row = mysqli_fetch_assoc($query_run1)){
    	$user = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
    	}
$date_of_payment = date("F d, Y h:i:s");

 	$query = "UPDATE payment SET amount_paid = $amount_paid, balance = $balance, user = '$user', date_of_payment = '$date_of_payment' where id = '$payment_id'";
 	 $query_run = mysqli_query($connection,$query);
   
   //  header('Location: student_requirement.php');
			// $_SESSION['status'] = $rid ;
 	if($query_run){
			header('Location: cashier_payment.php');
	
			$_SESSION['success'] = "Payment Updated";
		} else{
			header('Location: cashier_payment.php');
			$_SESSION['status'] = mysqli_error($connection) ;
		}
	}



?>

