<?php
namespace Dompdf;
require_once 'dompdf/autoload.inc.php';
//session_start();
ob_start();
require_once('includes/configpdo.php');
error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
<style>
table {
  width: 100%;
  margin: 10px auto;
  table-layout: auto;
}
.fixed {
  table-layout: fixed;
}
table,
td,
th {
  border-collapse: collapse;
}
th,
td {
  padding: 1px;
  border: solid 1px;
  text-align: center;
}
</style>
<h3 style="text-align: center;text-decoration:underline;margin: 5px;">GAKOE GIRLS SECONDAY SCHOOL, KIAMBU</h3>
<?php

if(isset($_GET['adm'])){ 

$adm=$_GET['adm'];

$query = "SELECT students.fullname,students.adm_no,students.date_added,students.s_id,class.class_abbr,class.streams from students join class on class.class_id=students.class_id where students.adm_no=? and class.class_id=students.class_id";
$stmt21 = $mysqli->prepare($query);
$stmt21->bind_param("s",$adm);
$stmt21->execute();
$res1=$stmt21->get_result();
$cnt=1;
while($result=$res1->fetch_object())
{  ?>
<p><b>Student Name :</b> <?php echo htmlentities($result->fullname);?></p>
<p><b>Student adm no:</b> <?php echo htmlentities($result->adm_no);?>
<p><b>Student Class:</b> <?php echo htmlentities($result->class_abbr);?> == <?php echo htmlentities($result->streams);?>
<?php }
}
    ?>
<table class="table table-inverse" border="1">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th>#</th>
<th>Subject</th>    
<th>Marks (%)</th>
<th>Grade</th>
<th>Points</th>
</tr>
</thead>
<tbody>
<?php                                              
// Code for result
$adm=$_GET['adm'];
 $query ="SELECT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,subject.sub_name,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join subject on subject.sub_id=tblresult.sub_id where students.adm_no=? and class.class_id=students.class_id order by marks desc";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s",$adm);
$stmt->execute();
$res=$stmt->get_result();
$cnt=1;
$totlcount=0;
while($row=$res->fetch_object())
                  {

    ?>
<tr>
<td ><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row->sub_name);?></td>
<td><?php echo htmlentities($totalmarks=$row->marks);
$totalmarks;    
if($totalmarks >=80 && $totalmarks < 100){
 $grade="A";
 $points=12;
}elseif($totalmarks >=75 && $totalmarks < 79){
  $grade="A-";
  $points=11;
}elseif($totalmarks >=70 && $totalmarks < 74){
 $grade="B+";
 $points=10;
}elseif($totalmarks >=65 && $totalmarks < 69){
 $grade="B";
 $points=9;
}elseif($totalmarks >=60 && $totalmarks < 64){
    $grade="B-";
    $points=8;
}elseif($totalmarks >=55 && $totalmarks <59){
  $grade="C+";
  $points=7;
}elseif($totalmarks >=50 && $totalmarks <54){
    $grade="C";
    $points=6;
}elseif($totalmarks >=45 && $totalmarks <49){
$grade="C-";
$points=5;
}elseif($totalmarks>=40 && $totalmarks < 44){
$grade="D+";
$points=4;
}elseif($totalmarks >=35 && $totalmarks < 39){
$grade="D";
$points=3;
}elseif($totalmarks >=30 && $totalmarks < 34){
    $grade="D-";
    $points=2;
}elseif($totalmarks >=0 && $totalmarks < 29){
    $grade="E";
    $points=1;
}




?></td>
<td><?php echo htmlentities($grade);?></td>
<td><?php echo htmlentities($points);?></td>
</tr>
<?php 

$totlcount+=$totalmarks;
@$totalPoints+=$points;
$pointTotal=$cnt * 12;
$meanGrade=$totalPoints/$cnt;
$cnt++;
$cnt++;
}
?>
<tr>
<th scope="row" colspan="2">Total Marks</th>
<td><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof=($cnt-1)*100); ?></b></td>
</tr>
<tr>
<th scope="row" colspan="2">Mean points</th>           
<td><b><?php echo  htmlentities($mean=$totlcount*(100)/$outof); 

$mg =$mean/$cnt;
$mgrade="";
if($mean >=80 && $mean < 100){
$mgrade="A";
}elseif($mean>=75 && $mean < 79){
$mgrade="A-";
}elseif($mean>=70 && $mean< 74){
$mgrade="B+";
}elseif($mean >=65 && $mean < 69){
$mgrade="B";
}elseif($mean >=60 && $mean< 64){
$mgrade="B-";
}elseif($mean>=55 && $mean <59){
$mgrade="C+";
}elseif($mean>=50 && $mean<54){
$mgrade="C";
}elseif($mean >=45 && $mean<49){
$mgrade="C-";
}elseif($mean>=40 && $mean < 44){
$mgrade="D+";
}elseif($mean>=35 && $mean < 39){
$mgrade="D";
}elseif($mean>=30 && $mean < 34){
$mgrade="D-";
}elseif($mean>=0 && $mean < 29){
$mgrade="E";
}



?> %</b></td>
<td>Mean grade <?php echo $mgrade;?></td>
<td>Total points <?php echo $totalPoints;?> (out of <?php echo $pointTotal;?>)</td>
</tr>
</tbody>
</table>
</div>
</html>
<?php

//use Dompdf\Options;
//$options = new Options();
//$options->set('enable_html5_parser', true);
//$dompdf = new Dompdf($options);
@$options->set('enable_html5_parser', true);
$html = ob_get_clean();
//$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("result.pdf",array("Attachment" => false));
$dompdf->stream("result.pdf");
?>