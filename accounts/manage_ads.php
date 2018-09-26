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
	  <div class="col-lg-12"><br />
      <div class="breadcrumb">
        <?php
                            //global $connect_db;
            $comments_query_total="SELECT COUNT(*) FROM ads WHERE created_by='$_SESSION[email]'";
            $run_total_query=query($comments_query_total);
            $count_rows_total_query=fetch_array($run_total_query);
            $total_rows_total_counts=array_shift($count_rows_total_query);
                            
            if($total_rows_total_counts >0){
              ?>
                                
                    
                         
        <h5 style="color:navy; font-size: 15px; font-weight: 300;">You have <?php echo $total_rows_total_counts;?> total ads posted in your account.</h5>

                 
   <?php  } ?>
        <?php delete_user_ads();?> 
      </div>
	  	<?php get_user_posts();?>	 		
	  	</div>

  
		 <!--////// 2nd to div starts here --/////-->


</div>
    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


</body>
</html>