<?php
include("functions/init.php"); 
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Result Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body>
          <?php //include_once("includes/headerss.php");?> 
       
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="content-container">

         
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12">
                                    <h2 class="title" align="center">Exams Processing System</h2>
                                </div>
                            </div>
                            <!-- /.row -->
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

<div class="col-md-8 col-md-offset-2">
<div class="panel">
<div class="panel-heading">
<div class="panel-title">
<h3 style="text-align: center;text-decoration:underline;margin: 5px;">NDENDERU SECONDARY SCHOOL</h3>
<?php
// code Student Data
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['adm'])){ 
$adm=$_GET['adm_no'];
$classid=$_POST['class'];
$_SESSION['adm_no']=$adm;
$_SESSION['class_id']=$classid;
$qery = "SELECT students.fullname,students.adm_no,students.date_added,students.s_id,class.class_abbr,class.streams from students join class on class.class_id=students.class_id where students.adm_no=:adm and students.class_id=:classid ";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':adm',$adm,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   ?>
<p><b>Student Name :</b> <?php echo htmlentities($row->fullname);?></p>
<p><b>Student Adm No :</b> <?php echo htmlentities($row->adm_no);?>
<p><b>Student Class:</b> <?php echo htmlentities($row->class_abbr);?>, stream <?php echo htmlentities($row->streams);?>
<?php }
}
}

    ?>
</div>
 <h4 style="text-align: center;">Report Form</h4>
<div class="panel-body p-20">

 <table class="table table-hover table-bordered">
<thead>
<tr>
<th>#</th>
<th>Subject</th>    
<th>%</th>
<th>Grade</th>
<th>Points</th>
</tr>
</thead>
<tbody>
<?php                                              
// Code for result
$adm=$_GET['adm_no'];
$classid=$_POST['class'];
$_SESSION['adm_no']=$adm;
$_SESSION['class_id']=$classid;


$q="SELECT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,subject.sub_name,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join subject on subject.sub_id=tblresult.sub_id where students.adm_no='$adm' and class.class_id='$classid'";

$q=$dbh->prepare($q);
$q->bindParam(':adm',$adm,PDO::PARAM_STR);
$q->bindParam(':classid',$classid,PDO::PARAM_STR);
$q->execute();  
$results = $q->fetchAll(PDO::FETCH_OBJ);

if($countrow=$q->rowCount() > 0)
{ 

foreach($results as $result){

    ?>

<tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($result->sub_name);?></td>
<td><?php echo htmlentities($totalmarks=$result->marks);
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
@$totlcount+=$totalmarks;
@$totalPoints+=$points;
@$pointTotal=$cnt * 12;
$meanGrade=$totalPoints/$cnt;
$cnt++;

}
?>
<tr>
<th scope="row" colspan="2">Total Marks</th>
<td><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof=($cnt-1)*100); 
?></b></td>
                                                        </tr>
<tr>
<th scope="row" colspan="2">Mean points</th>           
<td><b><?php echo  htmlentities($mean=$totlcount*(100)/$outof); 
$mg =$mean/$cnt;

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
<tr>
<th scope="row" colspan="2">Download Result</th>           
<td><b><a href="download-result.php">Download </a> </b></td>
</tr>

 <?php } else { ?>     
<div class="alert alert-warning left-icon-alert" role="alert">
<strong>Notice!</strong> Your result not declare yet
 <?php }
?>
</div>
 <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
strong>Oh snap!</strong>
<?php
echo htmlentities("Invalid Roll Id");
 }
?>
</div>

</tbody>
</table>
</div>
</div>
</div>
                                    <!-- /.col-md-6 -->
 <div class="form-group">
<div class="col-sm-6">
<a href="index.php">Back to Home</a>
</div>
 </div>
</div>
</div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                  
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
