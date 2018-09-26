<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Eps|Dashboard</title>
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet"> 
	<!-- Theme Custom CSS -->
		<script src="js/jquery.js"></script>
	<!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body id="home">
 <?php
include_once("includes/headerss.php");
?>


<?php 
     
     

  		echo $_SESSION['username'];
       include_once("includes/side_bar.php");

 ?>


<div class="col-lg-10">

<div style="width:30px; height:25px;"></div>
	<div class="breadcrumb" style="background-color: #003DA7;color:#fff;">Hello 
<?php 
     
      if(loggedIn()){

       

      }else{

        redirect("../index.php");

      }

       //echo $_SESSION['email'];  
       echo $_SESSION['username'];
   

       include_once("includes/side_bar.php");

 ?></div>
    
	
	 <div class="col-md-3">
	     <div class="panel panel-success">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					   <i class="glyphicon glyphicon-file" style="font-size:4.5em;"></i>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	 <?php

							     $sql_query="SELECT DISTINCT subject.sub_id,subject.sub_name, teachers.t_id, teachers.username,teachers.fullname,class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join teachers on teachers.username=tblresult.posted_by join subject on subject.sub_id=tblresult.sub_id where teachers.username='$_SESSION[username]'";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>




					    </div>
					    <div>Results (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_results.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Results</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div> 
	</div>
	 
	 <!--////// 1st top Aside div ends here -/////-->
	 

<div class="clearfix"></div>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
 <?php include("includes/footer1.php"); ?> 
</body>
</html>