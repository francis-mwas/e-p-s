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
           validateClassCreation();

           ?>
         
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Add a new class</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                            	 <label for="class_abbr "><span>Class Abbreviation</span></label>
                                <input id="class_abbr " name="class_abbr" type="text" placeholder="class Abrr i.e F1, F2" class="form-control" required>
                            </div>
                        </div>
                         <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="class_abbr "><span>Class Stream</span></label>
                                <input id="class_abbr " name="streams" type="text" placeholder="class Abrr i.e F1A, F2B" class="form-control" required>
                            </div>
                        </div>
                        
                        
<!--
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Class stream</span></label>
                               <select class="form-control" id="categorySelect" name="streams"> 
                                <option>select stream</option>
                                       
                        <?php 
                        /*
                        global $conn;
                        $query="SELECT * FROM `streams` order by stream_name";
                         $result=query($query);
                         //$count=0;
                         while($rows=fetch_array($result)){
                            $streams_id=$rows["stream_id"];
                            $stream_name=$rows["stream_name"];
                        
                         ?>
                        
                                
                                <option><?php echo  $stream_name; ?></option>
                           
                       <?php } 

*/
                       ?>
                    </select>
                            </div>
                        </div>

                       -->
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-user"></i></span>
                            <div class="col-md-8">
                            	<label for="class_teacher"><span>Class teacher name</span></label>
                                <input id="class_teacher" name="class_teacher" type="text" placeholder="class_teacher" class="form-control" required>
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