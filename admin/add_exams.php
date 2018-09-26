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
    <style>
    	.header {
    color: #36A0FF;
    font-size: 27px;
    padding: 10px;
}

.bigicon {
    font-size: 20px;
    color: #36A0FF;
}
.form-horizontal .form-group{
	margin-right: -10px;

}
    </style>
}
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
<?php display_message();?>
    <div class="row">
           <?php 
           validateExamsCreation();

           ?>
         
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Add a new exam</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="stream name"><span>Exam Type</span></label>
                                <input id="examtype" name="type" type="text" placeholder="Exam type i.e CAT" class="form-control" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="exam code"><span>Exam Code.</span></label>
                                <input id="exam_code" name="exam_code" type="text" placeholder="Exam code" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="max mark"><span>Max mark.</span></label>
                                <input id="max_mark" name="max_mark" type="text" placeholder="Max mark" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <div style="clear: both;"></div>
 <?php include("includes/footer1.php"); ?> 
</body>
</html>