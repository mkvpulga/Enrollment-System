<?php
require('fpdf17/fpdf.php');
session_start();
include_once 'includes/connection.php'; 
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();


//Cell(width , height , text , border , end line , [align] )



     
  $query_school =  "SELECT * FROM school_profile";

  $query_school_run = mysqli_query($connection,$query_school);
 while($row_school = mysqli_fetch_assoc($query_school_run)){
       $pdf->SetFont('Arial','B',18);

$pdf->Cell(189	,5,$row_school['school_name'],0,1,'C');
$pdf->SetFont('Arial','B',16);

$pdf->Cell(189	,5,$row_school['school_address'],0,1,'C');//end of line

         }
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line



  $query =  $_SESSION['jhs_query'];

  $query_run = mysqli_query($connection,$query);
//invoice contents
$pdf->SetFont('Arial','B',14);
$pdf->Cell(189	,5,'SCHEDULE REPORT',0,1,'C');//end of line

$pdf->Cell(189  ,5,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','B',12);
//billing address
$pdf->Cell(100	,5,$_SESSION['school_year'],0,0);//end of line
$pdf->Cell(89	,5,date("Y/m/d"),0,1,'R');//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,5,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(22	,5,'Grade Level',1,0);
$pdf->Cell(25 ,5,'Section',1,0);
$pdf->Cell(12 ,5,'Room',1,0);
$pdf->Cell(25 ,5,'Subject Code',1,0);
$pdf->Cell(62 ,5,'Subject Description',1,0);
$pdf->Cell(28 ,5,'Time',1,0);
$pdf->Cell(15	,5,'Day',1,1);//end of line

$pdf->SetFont('Arial','',8);

//Numbers are right-aligned so we give 'R' after new line parameter


     
 // $cids = $_SESSION['cids'];
 // $sstatus = $_SESSION['sstatus'] ;

 while($row = mysqli_fetch_assoc($query_run)){

 	$day = "";
            if ($row['is_monday'] == 1) {
              $day .= "M";
            }
            if ($row['is_tuesday'] == 1) {
              $day .= "T";
            }
            if ($row['is_wednesday'] == 1) {
              $day .= "W";
            }
            if ($row['is_thursday'] == 1) {
              $day .= "Th";
            }
            if ($row['is_friday'] == 1) {
              $day .= "F";
            }
            if ($row['is_saturday'] == 1) {
              $day .= "S";
            }
$pdf->Cell(22	,5,$row['year'],1,0);
         $pdf->Cell(25  ,5,$row['section_code'],1,0);
$pdf->Cell(12 ,5,$row['room_no'],1,0);
$pdf->Cell(25 ,5,$row['subject_code'],1,0);
$pdf->Cell(62 ,5,$row['subject_description'],1,0);
$pdf->Cell(28 ,5,date('h:i a' , strtotime($row['time_in'])) . ' - ' . date('h:i a' , strtotime($row['time_out'])),1,0,'R');
$pdf->Cell(15 ,5,$day,1,1);


         }













$pdf->Output();
?>