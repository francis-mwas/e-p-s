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
            validateSubjectCreation();

           ?>
         
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Create New Subject</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                                 <label for="term"><span>Subject name</span></label>
                                <input id="sub_name" name="sub_name" type="text" placeholder="Subject Name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="stream"><span>Subject code</span></label>
                                <input id="sub_code" name="sub_code" type="text" placeholder="Subject code" class="form-control" required>
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