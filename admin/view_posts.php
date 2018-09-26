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
$result='';
if(isset($_GET['new_status'])){
	$new_status=$_GET['new_status'];
	$sql="UPDATE posts SET status='$new_status' WHERE post_id=$_GET[post_id]";
	if($run=mysqli_query($conn,$sql)){
		$result='<div class="alert alert-success">Status updated</div>';
	}
}

if(isset($_GET['del_id'])){
	
	$del=$_GET['del_id'];
	$sql="DELETE FROM posts WHERE post_id='$del'";
	if($run_sql=mysqli_query($conn,$sql)){
		$result='<div class="alert alert-danger">you have deleted row no. '.$del.' from the db</div>';
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

	 <!--////// 2nd to div starts here --/////-->
	 <?php echo $result;?>
<div class="panel panel-primary">
	      <div class="panel-heading"><h4>Posts</h4></div>
		      <div class="panel-body">
			     <table class="table table-striped">
				     <thead>
					  <tr>
							<th>S.No</th>
							<th>Date</th>
							<th>Title</th>
							<th>Description</th>
							<th>Image</th>
							<th>Category</th>
							<th>Author</th>
							<th>Status</th>
							<th>Action</th>
							<th>View Post</th>
							<th>Edit Post</th>
							<th>Delete Post</th>
					   </tr>
					   
					 </thead>
				     <tbody>
					 <?php
					   $sql="SELECT * FROM `posts` ORDER BY post_id DESC";
					   $sql_run=mysqli_query($conn,$sql);
					   while($rows=mysqli_fetch_assoc($sql_run)){
						   
						   echo'
							<tr>
								<td>'.$rows['post_id'].'</td>
								<td>'.$rows['post_date'].'</td>
								<td>'.$rows['post_title'].'</td>
								<td>'.substr($rows['post_description'],0,50).'....</td>
								<td>'.($rows['post_image']=='' ? 'No Image' : '<img src="../'.$rows['post_image'].'" width="50px">').'</td>
								<td>'.$rows['post_category'].'</td>
								<td>'.$rows['post_author'].'</td>
								<td>'.$rows['status'].'</td>
								<td>'.($rows['status'] =='draft'? '<a href="view_posts.php?new_status=published&post_id='.$rows['post_id'].'" 
								class="btn btn-primary btn-xs navbar-btn">publish</a>':'<a href="view_posts.php?new_status=draft&post_id='.$rows[
								'post_id'].'" class="btn btn-info btn-xs navbar-btn">Draft</a>').'</td>
								
								<td><a href="../post.php?p_id='.$rows['post_id'].'" class="btn btn-success btn-xs navbar-btn">View</a></td>
								<td><a href="#" class="btn btn-warning btn-xs navbar-btn">Edit</a></td>
								<td><a href="view_posts.php?del_id='.$rows['post_id'].'" class="btn btn-danger btn-xs navbar-btn">Delete</a></td>
							</tr>
							 
								   
						   ';
					   }
					 
					 ?>					 
					 
					 </tbody>
				 </table>
			  </div> 
</div>
<div class="text-center">
<ul class="pagination">
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">6</a></li>
</ul>
</div>
</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


  
</body>
</html>