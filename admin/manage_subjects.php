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

        redirect("index.php");

      }

       echo $_SESSION['email'];  

       include_once("includes/side_bar.php");

 ?>




<?php include_once("includes/side_bar.php"); ?>

<div class="col-lg-10">

	 <!--////// users area --/////-->
	 <!-- profile settings-->
   <br />
    <td>
             <a href="create_subjects.php"><span class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> ADD A NEW SUBJECT.</span></a>
         </td>

         <br /><br />
	  <div class="col-lg-12"> 
    <div class="table tale-responsive"> 

    <table class="table table-striped table-bordered table-hover">
             <thead>
              <tbody>
               <tr>
                            <th>#</th>
                            <th>Subject Name</th>
                            <th>Subject code</th>
                            <th>Date added</th>
                            <th>Updation date</th>
                            <th>Actions</th>
                           
                </tr>
         
         <?php delete_subject_details();?>   
         <?php  getAllSubjects();?>  

           </tbody>
         </table>
  

     </div>
    </div>  
    </div>		
 </div>
     <script>
         function Delete(){
            var question =confirm("Are you sure you want to delete this subject details ?");
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