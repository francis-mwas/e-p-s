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
  <div style="height:22px;"></div>
<?php 
     
      

       include_once("includes/side_bar.php");

 ?>

 <!-- profile settings-->
  
	  <div class="col-lg-10">
         <td>
             <a href="add_students.php"><span class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> Create New Student Account.</span></a>
         </td>
      <h4 class="bg-primary text-center">All Students.</h4>
    <div class="table-responsive"> 
    <table class="table table-striped table-bordered table-hover">
             <thead>
              <tbody>
               <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Adm No</th>
                            <th>Class</th>
                            <th>Stream</th>
                            <th>Yr Of Adm</th> 
                            <th>Date Added</th>  
                            <th>Updation date</th>
                            <th>P.Pic</th>
                            <th>Actions</th>
                </tr>
         
         <?php delete_student_account();?>   
         <?php getAllStudents();?>  

           </tbody>
         </thead>
         </table>
  

     </div>
    </div>  
   
 <!--bootstrap js-->
  <script>
         function Delete(){
            var question =confirm("Are you sure you want to delete this student account ?");
            if(question){
                return true;
            }else{
                return false;
            }
           
        }
        
 
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>