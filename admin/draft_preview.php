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
<div style="height: 10px;">
<?php 
     
      if(logged_in()){

       echo "Logged In as ";

      }else{

        redirect("admin_login.php");

      }

  		echo $_SESSION['email'];
       include_once("includes/side_bar.php");

 ?>

<div class="col-md-10">
<?php echo display_message();?>


<!--Row For Image and Short Description-->

<?php previewDraftAd();?>
<hr>
</div>
  
 <!--bootstrap js-->
  
    

</body>
</html>