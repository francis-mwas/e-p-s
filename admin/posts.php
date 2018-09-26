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

$error='';

if(isset($_POST['submit_button'])){
	
	$post_title=strip_tags($_POST['post_title']);
	$date=date('Y-m-d h:i:s');
	if(($_FILES['post_image']['name']) !=''){
		$image_name=$_FILES['post_image']['name'];
		$image_tmp=$_FILES['post_image']['tmp_name'];
		$image_size=$_FILES['post_image']['size'];
		$image_extension=pathinfo($image_name, PATHINFO_EXTENSION);
		$image_path='../images/'.$image_name;
		$image_db_path='images/'.$image_name;
		
		if($image_size < 10000000){
			if($image_extension =='JPG' || $image_extension =='jpg' ||	$image_extension=='PNG' || 	$image_extension=='jpeg' || $image_extension=='gif'){
				if(move_uploaded_file($image_tmp,$image_path)){
					$sql_query="INSERT INTO `posts` (post_title,post_description,post_image,post_category,status,post_date,post_author) VALUES('$post_title','$_POST[post_description]',
					'$image_db_path','$_POST[post_category]','$_POST[status]','$date','$_SESSION[username]')";
					   if(mysqli_query($conn,$sql_query)){
						   
						   header('location:posts.php');
						   
					   }else{
						   $error='<div class="alert alert-danger">the query did not work correctly</div>';
					   }
				}else{
				$error='<div class="alert alert-danger">sorry, unfortunately the image has not been uploaded</div>';
			}
			}else{
				$error='<div class="alert alert-danger">sorry,image format was not correct</div>';
			}
		}else{
			$error='<div class="alert alert-danger">sorry, the size of your image is to way big than expected.</div>';
		}
	}else{
		$sql_query="INSERT INTO `posts` (post_title,post_description,post_category,status,post_date,post_author) VALUES('$post_title','$_POST[post_description]',
		'$_POST[post_category]','$_POST[status]','$date','$_SESSION[username]')";
		
		 if(mysqli_query($conn,$sql_query)){
						   
		 header('location:posts.php');
						   
		}else{
		$error='<div class="alert alert-danger">the query did not work correctly</div>';
		 }
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
<?php  include_once("includes/side_bar.php"); ?>

<div class="col-lg-10"><br />
<?php echo $error; ?>
<div class="page-header"><h3>Upload New Post.</h3></div>
<div class="container-fluid">
     <form class="form-horizontal" action="posts.php" method="POST" enctype="multipart/form-data">
         <div class="form-group">
		      <label for="post_image">Upload Post Image</label>
			  <input type="file" id="post_image" name="post_image" class="btn btn-primary">
		 </div>
		  <div class="form-group">
		      <label for="post_title">Post Title</label>
			  <input type="text" id="title" name="post_title" class="form-control" required>
		 </div>
		 
		  <div class="form-group">
		      <label for="post_category">Post Category</label>
			  <select class="form-control" id="post_category" name="post_category" required>
			    <option value="">Select Category</option>
			       <?php
				   
				   $sql_query="SELECT * FROM `categories`";
				   $run_query=mysqli_query($conn,$sql_query);
				   while($results=mysqli_fetch_assoc($run_query)){
					   
					   echo'<option value="'.$results['cat_id'].'">'.ucfirst($results['cat_name']).'</option>';
				   }
				   
				   ?>
			  </select>
		 </div>
		 
		  <div class="form-group">
		      <label for="post_description">Post Description</label>
		      <textarea class="form-control" name="post_description" required></textarea>
		 </div>
		 
		  <div class="form-group">
		      <label for="status">Post Status</label>
			  <select class="form-control" id="status" name="status" required>
			       <option>draft</option>
				   <option>published</option>
			  </select>
		 </div>
		 
		  <div class="form-group">
			  <input type="submit" name="submit_button" value="Submit Form" class="btn btn-danger btn-block">
		 </div>
		 
	 </form>


</div>
</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


  
</body>
</html>