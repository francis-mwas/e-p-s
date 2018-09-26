<?php
session_start();
include_once("includes/conn.php");

if(isset($_SESSION['username']) && isset($_SESSION['password']) == true){
	
	$sql_query="SELECT * FROM `users` WHERE email='$_SESSION[username]' AND password='$_SESSION[password]'";
	
	if($run_query=mysqli_query($conn,$sql_query)){
		
		if(mysqli_num_rows($run_query)== 1){
			
		}else{
			header('location:../index.php');
		}
	}
}else{
	header('location:../index.php');
}

$results='';
if(isset($_POST['submit_button'])){
	$category=strip_tags($_POST['category']);
	$sql="INSERT INTO `categories` (cat_name) VALUES('$category')";
	if(mysqli_query($conn,$sql)){
		
		$results='<div class="alert alert-success">The category '.$category.' has been addes successfully</div>';
		
	}
	
}

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
include_once("includes/header.php");
?>
<div style="width:50px; height:50px;"></div>
<?php include_once("includes/side_bar.php"); ?>

<div class="col-lg-10">
<?php echo $results;?>
<div class="page-header"><h3>Add New Category.</h3></div>
<div class="container-fluid">
     <form class="form-horizontal col-lg-5" action="categories.php" method="POST">
		  <div class="form-group">
		      <label for="category">Category Title</label>
			  <input type="text" id="cat" name="category" class="form-control">
		 </div>
		 
		  
		  <div class="form-group">
			  <input type="submit" name="submit_button" value="Add Category" class="btn btn-danger btn-block">
		 </div>
		 
	 </form>


</div>
</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


  
</body>
</html>