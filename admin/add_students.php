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
           validateStudentsCreation();

           ?>
         
            <div class="well well-sm">
                <?php display_message();?>
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Create new student account.</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                            	 <label for="firstname"><span>Full name</span></label>
                                <input id="fullname" name="fullname" type="text" placeholder="Full Name" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="Admission number"><span>Admission number</span></label>
                                <input id="admission_no" name="adm_no" type="text" placeholder="Admission number" class="form-control" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Student's Class</span></label>
                               <select class="form-control" id="categorySelect" name="class_id"> 
                                <option>select class</option>
                                        
                        <?php 
                        global $conn;
                        $query="SELECT * FROM class";
                         $result=query($query);
                         //$count=0;
                         while($rows=fetch_array($result)){
                            $class_id=$rows["class_id"];
                            $class_abbr=$rows["class_abbr"];
                            $streams=$rows['streams'];
                        
                        
                        
                                
                echo "<option value='{$class_id}'>$class_abbr --> $streams</option>";
                       }    
                 ?>
                    </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="yearOfAdmission"><span>Year of admission</span></label>
                                <input id="yearOfAdmission" name="yearOfAdmission" type="text" placeholder="Year of admission" class="form-control" required>

                            </div>
                        </div>
                        
                          <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Gender</span></label>
                            <select class="form-control" id="categorySelect" name="gender"> 
                                <option>select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                         
                           </select>
                            </div>
                            </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="p_photo"><span>Profile Photo</span></label>
                                <input id="p_photo" type="file" name="profile_photo"  placeholder="Profile photo" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
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