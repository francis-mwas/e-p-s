<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Admin Panel</title>
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
<div style="height:20px;"></div>
<?php include_once("includes/side_bar.php"); ?>

<div class="col-lg-10">

<!-- latest messages--->

<div class="panel panel-primary">
	      <div class="panel-heading"><h4>Latest Messages</h4></div>
		      <div class="panel-body">
			     <table class="table table-striped">
				     <thead>
					  <tr>
							<th>S.No</th>
							<th>Date</th>
							<th>Author</th>
							<th>Email</th>
							<th>Comments</th>
							<th>Post</th>
							<th>Status</th>
							<th>Delete</th>
							
					   </tr>
					   
					 </thead>
				     <tbody>
					 <tr>
					     <td>1</td>
					    <td>9/16/2017</td>
						<td>Admin</td>
						<td>mwas@gmail.com</td>
					    <td>First Posts First PostsFirst PostsFirst PostsFirst PostsFirst PostsFirst</td>
					    <td>2</td>
					    <td><a href="#" class="btn btn-warning btn-xs">Approve</a></td>
						<td><a href="#" class="btn btn-danger btn-xs">Delete</a></td>
					  
					 </tr>
					 <tr>
					     <td>1</td>
					    <td>9/16/2017</td>
						<td>Admin</td>
						<td>mwas@gmail.com</td>
					    <td>First Posts First PostsFirst PostsFirst PostsFirst PostsFirst PostsFirst</td>
					    <td>1</td>
						<td>Approved</td>
						<td><a href="#" class="btn btn-danger btn-xs">Delete</a></td>
					  
					 </tr>
					 
					  <tr>
					     <td>1</td>
					    <td>9/16/2017</td>
						<td>Admin</td>
						<td>mwas@gmail.com</td>
					    <td>First Posts First PostsFirst PostsFirst PostsFirst PostsFirst PostsFirst</td>
					    <td>2</td>
					    <td><a href="#" class="btn btn-warning btn-xs">Approve</a></td>
						<td><a href="#" class="btn btn-danger btn-xs">Delete</a></td>
					  
					 </tr>
					 
					 <tr>
					     <td>1</td>
					    <td>9/16/2017</td>
						<td>Admin</td>
						<td>mwas@gmail.com</td>
					    <td>First Posts First PostsFirst PostsFirst PostsFirst PostsFirst PostsFirst</td>
					    <td>1</td>
						<td>Approved</td>
						<td><a href="#" class="btn btn-danger btn-xs">Delete</a></td>
					  
					 </tr>
					 
					 
					 </tbody>
				 </table>
			  </div> 
</div>


</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

  
</body>
</html>