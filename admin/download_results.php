<?php
require_once("includes/dbcontroller.php");
$db_handle = new DBController();
$adm=111;
$result = $db_handle->runQuery("SELECT * FROM tblresult");
$header = $db_handle->runQuery("SELECT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,subject.sub_name,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join subject on subject.sub_id=tblresult.sub_id where students.adm_no='$adm' and class.class_id=students.class_id order by marks desc");

$result=$db_handle->runQuery("");

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);      
foreach($header as $heading) {
    foreach($heading as $column_heading)
        $pdf->Cell(90,12,$column_heading,1);

}
foreach($result as $row) {
    $pdf->SetFont('Arial','',12);   
    $pdf->Ln();
    foreach($row as $column)
        $pdf->Cell(90,12,$column,1);
}
ob_start();
$pdf->Output();
?>