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
            validateSubjCombinationCreation();

           ?>
         
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Add subject Combination.</legend>
                       
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Class</span></label>
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
                            $streams=$rows["streams"];
                        
                        
                        
                                
                echo "<option value='$class_id'>$class_abbr -->stream $streams</option>";
                       }    
                 ?>
                    </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Subject</span></label>
                               <select class="form-control" id="categorySelect" name="subject_id"> 
                                <option>select subject</option>
                                        
                        <?php 
                        global $conn;
                        $query="SELECT * FROM subject";
                         $result=query($query);
                         //$count=0;
                         while($rows=fetch_array($result)){
                            $sub_id=$rows["sub_id"];
                            $sub_name=$rows["sub_name"];
                          
                        
                         
                        
                           echo
                            "
                              <option value='$sub_id'>$sub_name</option>
                           ";     
                                
                           
                     }
                     ?>
                    </select>
                            </div>
                        </div>  
                              <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="category"><span>Assign subject to  a teacher</span></label>
                               <select class="form-control" id="categorySelect" name="assigned_teacher_i"> 
                                <option>select class</option>
                                        
                        <?php 
                        global $conn;
                        $query="SELECT * FROM teachers";
                         $result=query($query);
                         //$count=0;
                         while($rows=fetch_array($result)){
                            $t_id=$rows["t_id"];
                            $fullname=$rows["fullname"];

                        
                        
                        
                                
                echo "<option value='$t_id'>$fullname</option>";
                       }    
                 ?>
                    </select>
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