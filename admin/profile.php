<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Seller | Dashboard</title>
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

        redirect("../index.php");

      }

       echo $_SESSION['email'];  

       include_once("includes/side_bar.php");

 ?>




<?php include_once("includes/side_bar.php"); ?>

<div class="col-lg-10">

	 <!--////// users area --/////-->
	 <!-- profile settings-->
	  <div class="col-lg-12">
	  	<?php get_user_profile();?>	  		
	  	</div>

  
	   <div class="col-lg-12">
	     <div class="panel panel-primary">
		     <div class="panel-heading">
			     <h4>Update Your Profile</h4>
			 </div>
			 <div class="panel-body">
			     <table class="table table-striped">
				     <thead>
					     <tr>
						    <th>User Id.</th>
						    <th>First Name.</th>
						    <th>Last Name</th>
						    <th>Email</th>
						    <th>Phone Number</th>
						    <th>Edit</th>
						    </tr>
					 </thead>
				     <tbody>
					 
					     <tr>
						    <td>12</td>
						    <td>francis</td>
						    <td>mwangi</td>
						    <td>mwas@gmail.com</td>
						    <td>0717445860</td>
					     <td><a href="" class="btn btn-warning btn-xs">Edit</a></td>
						</tr>
		
					 </tbody>
				 </table>
			 </div>
		 </div>
	 </div>
	
	

	 <!--////// 2nd to div starts here --/////-->


</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

  
</body>
</html>