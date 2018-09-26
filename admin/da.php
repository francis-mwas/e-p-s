<?Php
require "includes/config.php"; // connection to database
$adm=111; 
$count="SELECT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,subject.sub_name,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join subject on subject.sub_id=tblresult.sub_id where students.adm_no='$adm' and class.class_id=students.class_id order by marks desc"; // SQL to get 10 records 
require('fpdf/fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();

$width_cell=array(20,50,40,40,40);
$pdf->SetFont('Arial','B',16);

$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'ID',1,0,C,true); // First header column 
$pdf->Cell($width_cell[1],10,'Subject',1,0,C,true); // Second header column
$pdf->Cell($width_cell[2],10,'%',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[3],10,'Grade',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[4],10,'Points',1,1,C,true); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',14);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 

/// each record is one row  ///
foreach ($dbh->query($count) as $row) {
$pdf->Cell($width_cell[0],10,$row['id'],1,0,C,$fill);
$pdf->Cell($width_cell[1],10,$row['sub_name'],1,0,L,$fill);
$pdf->Cell($width_cell[2],10,$row['marks'],1,0,C,$fill);
$pdf->Cell($width_cell[3],10,$row['mark'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['fullname'],1,1,C,$fill);
$fill = !$fill; // to give alternate background fill  color to rows
}
/// end of records /// 
ob_start();
$pdf->Output();
?>