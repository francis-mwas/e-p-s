<?php
include_once("includes/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Realtors.com</title>
	<!-- core CSS -->
    <link href="contents/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="contents/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
	<!-- Theme Custom CSS -->

</head> 

<body id="home">
  <?php
include_once("includes/header.php");
?>
<div class="container">
    <article class="row">
	    <section class="col-lg-8">
		<?php
		if(@$_GET['p_id']){
			$sel_sql="SELECT * FROM posts WHERE post_id='$_GET[p_id]'";
		$run_query=mysqli_query($conn,$sel_sql);
		while($rows=mysqli_fetch_assoc($run_query)){
			
			echo '
			<div class="panel panel-danger">
			    <div class="panel-body">
				     <div class="panel-header">
					     <h4>'.$rows['post_title'].'</h4>
					 </div>
					 <img src="'.$rows['post_image'].'" width="100%">
					 <p>'.$rows['post_description'].'</p>
				</div>
			 </div>';
		}
		
		}else{
			echo '<div class="alert alert-danger">No post selected, <a href="index.php">Click here to view posts</a> now.</div>';
		}
		
		?>
		     
		</section>
			<?php include_once('includes/sidebar.php');?>
	</article>
</div>
<div style="width:50px;height:50px;"></div>

 <!--bootstrap js-->
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
  
</body>
</html>