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

//deleting categories//
$output='';
if(isset($_GET['del_id'])){
	$del_id=$_GET['del_id'];
	$sqls="DELETE FROM categories WHERE cat_id='$_GET[del_id]'";
	if(mysqli_query($conn,$sqls)){
				$output='<div class="alert alert-danger">Category no. '.$_GET['del_id'].' has been deleted successfully</div>';
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
<div style="width:30px; height:25px;"></div>
  
	
	 
	 <!--////// 1st top Aside div ends here --/////-->
	 

<div class="clearfix"></div>
	 <!--////// users area --/////-->
	  
	   <div class="col-lg-8">
	   <?php echo 	$output;?>
	     <div class="panel panel-primary">
		     <div class="panel-heading">
			     <h4>Categories</h4>
			 </div>
			 <div class="panel-body">
			     <table class="table table-striped">
				     <thead>
					     <tr>
						    <th>S.No</th>
						    <th>Category Name</th>
						    <th>Edit</th>
						    <th>Delete</th>
						 </tr>
					 </thead>
				     <tbody>
					  <?php
					   $sql_query="SELECT * FROM categories";
					   $run_sql_query=mysqli_query($conn,$sql_query);
					   while($sql_rows=mysqli_fetch_assoc($run_sql_query)){
						   
						  echo '
					     <tr>
						    <td>'.$sql_rows['cat_id'].'.</td>
						    <td>'.ucfirst($sql_rows['cat_name']).'</td>
					   <td><a href="edit_category.php?edit_cat='.$sql_rows['cat_id'].'" class="btn btn-warning btn-xs">Edit</a></td>
							<td><a href="view_categories.php?del_id='.$sql_rows['cat_id'].'" class="btn btn-danger btn-xs">Delete</a></td>
						</tr>	'; 
					   }
					 ?>
					 </tbody>
				 </table>
			 </div>
		 </div>
	 </div>
	 
</div>


</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


  
</body>
</html>