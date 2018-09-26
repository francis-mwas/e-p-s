<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Admin|Dashboard</title>
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
     
      if(logged_in()){

       echo "Logged In as ";

      }else{

        redirect("admin_login.php");

      }

  		echo $_SESSION['email'];
       include_once("includes/side_bar.php");

 ?>


<div class="col-lg-10">

<div style="width:30px; height:25px;"></div>
	<div class="breadcrumb" style="background-color:#003DA7;color:#fff; font-size: 18px;">Hello Admin [
		<?php 
     
      if(logged_in()){

       

      }else{

        redirect("admin_login.php");

      }

       //echo $_SESSION['email'];  
       echo $_SESSION['email'];

       include_once("includes/side_bar.php");

 ?>
 ]
</div>
     <div class="col-md-3">
	     <div class="panel panel-primary">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					    <span class="bg-icon"><i class="fa fa-users" style="font-size:4.5em;"></i></span>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	

					    <?php
					         //echo  $email=$_SESSION['email'];
							   // echo  $name=$_SESSION['first_name'];
							     $sql_query="SELECT * FROM teachers";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>
					    	


                        




					    </div>
					    <div>Added Teachers</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_teachers.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Teachers</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>
	 
	  <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					
					   <span class="bg-icon"><i class="fa fa-bank" style="font-size:4.5em;"></i></span>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">

					    <?php

							     $sql_query="SELECT * FROM class";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>
					    	
					    </div>
					    <div>Added Class (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="newly_posted.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Classes</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>
	 
	 
	<!--   <div class="col-md-3">
	     <div class="panel panel-success">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					   
					   <span class="bg-icon"><i class="fa fa-bank" style="font-size:4.5em;"></i></span>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	
    				
					    <?php
 /*
							     $sql_query="SELECT * FROM `streams`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
								*/
					    ?>

					    </div>
					    <div>Added Stream (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_streams.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Streams</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>-->





	   
	   <div class="col-md-3">
	     <div class="panel panel-warning">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					  
					  <span class="bg-icon"><i class="fa fa-users" style="font-size:4.5em;"></i></span>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	

					    <?php

							     $sql_query="SELECT * FROM `Students`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>

					    </div>

					    <div>Student (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_students.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Students</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>




<div class="col-md-3">
	     <div class="panel panel-yellow" style="background-color: #f0ad4e;">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					   <i class="glyphicon glyphicon-list-alt" style="font-size:4.5em;"></i>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	
					 <?php

							     $sql_query="SELECT * FROM `exams`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>



					    </div>
					    <div>Exam (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="exams.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Exams</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>




	   <div class="col-md-3">
	     <div class="panel panel-danger">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					   <i class="glyphicon glyphicon-th-large" style="font-size:4.5em;"></i>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	 <?php

							     $sql_query="SELECT * FROM `terms`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>




					    </div>
					    <div>Terms(s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_terms.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Terms</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>


	   <div class="col-md-3">
	     <div class="panel panel-warning">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					    
					   <span class="bg-icon"><i class="fa fa-ticket" style="font-size:4.5em;"></i></span>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	 <?php

							     $sql_query="SELECT * FROM `Subject`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>




					    </div>
					    <div>Subject (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_subjects.php">
			 <div class="panel-footer">
			    <div class="pull-left">Manage Subjects</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>

   <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			     <div class="row">
				    <div class="col-xs-3">
					   <i class="glyphicon glyphicon-folder-close" style="font-size:4.5em;"></i>
					</div>
					<div class="col-xs-9 text-right">
					    <div style="font-size:2.5em;">
					    	 <?php

							     $sql_query="SELECT * FROM `Subjectcombination`";
							   
							     
							     $result=query($sql_query);
							     echo $total_counts=mysqli_num_rows($result);
							     //confirm($result);
							     //$count=0;
							     //$row=fetch_array($result);
							     while($row=mysqli_fetch_assoc($result)){

								}
					    ?>




					    </div>
					    <div>Subj combination (s)</div>
					</div>
				 </div>
			 </div>
			 <a href="manage_subject_combination.php">
			 <div class="panel-footer">
			    <div class="pull-left">Subj combination</div>
			    <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i> </div>
				<div class="clearfix"></div>
			 </div>
			 </a>
		 </div>
	 </div>

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

							     $sql_query="SELECT DISTINCT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,postingDate from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id";
							   
							     
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
	 <!--////// 1st top Aside div ends here --/////-->
<div class="clearfix"></div>
	 <!--////// users area --/////-->
</div>
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <?php include("includes/footer1.php"); ?> 
</body>
</html>