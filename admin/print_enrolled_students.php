<?php
require('fpdf17/fpdf.php');
session_start();
include_once 'includes/connection.php'; 
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )



     
  $query_school =  "SELECT * FROM school_profile";

  $query_school_run = mysqli_query($connection,$query_school);
 while($row_school = mysqli_fetch_assoc($query_school_run)){
       $pdf->SetFont('Arial','B',16);

$pdf->Cell(200	,5,$row_school['school_name'],0,1,'C');
$pdf->SetFont('Arial','B',14);

$pdf->Cell(200	,5,$row_school['school_address'],0,1,'C');//end of line

         }
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line


//set font to arial, regular, 12pt
$pdf->SetFont('Arial','B',12);

//billing address
$pdf->Cell(100	,5,'Enrolled Students',0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,5,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(130	,5,'Student Full Name',1,0);
$pdf->Cell(25	,5,'Grade',1,0);
$pdf->Cell(34	,5,'Status',1,1);//end of line

$pdf->SetFont('Arial','',8);

//Numbers are right-aligned so we give 'R' after new line parameter


     
 // $cids = $_SESSION['cids'];
 // $sstatus = $_SESSION['sstatus'] ;

  $query =  $_SESSION['student_list_query'];

  $query_run = mysqli_query($connection,$query);
 while($row = mysqli_fetch_assoc($query_run)){
         $pdf->Cell(130	,5,$row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['suffix'],1,0);
$pdf->Cell(25	,5,$row['year'],1,0);
$pdf->Cell(34	,5,$row['student_status'],1,1,'R');//end of line

         }













$pdf->Output();
?>