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
	<td>
             <a href="add_streams.php"><span class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> ADD A NEW STREAM.</span></a>
         </td>
         <BR />      <BR />    
	     <div class="panel panel-primary">
		     <div class="panel-heading">
			     <h4>Manage Streams</h4>
			 </div>
			 <div class="panel-body">
			 	<div class="table-responsive">
			     <table class="table table-bordered table-hover table-striped">
				     <thead>
					     <tr>
						    <th>S.No</th>
						    <th>Stream Name</th>
						    <th>Date Added</th>
						     <th>Actions</th>
						 </tr>
					 </thead>
				     <tbody>
				     	<?php delete_stream_account(); ?>
					 	<?php getAllStreams();?>
					 </tbody>
				 </table>
			 </div>
	 </div>
	 <div class="clearfix"></div>
</div>
</div>
  <script>
         function Delete(){
            var question =confirm("Are you sure you want to delete this stream ?");
            if(question){
                return true;
            }else{
                return false;
            }
           
        }
        
 
    </script>
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>