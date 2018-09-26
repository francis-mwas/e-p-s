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
             <a href="createNewAdd.php"><span class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> ADD NEW TEACHER.</span></a>
         </td>
      <h4 class="bg-primary text-center">All Teachers</h4>
    <div class="table-responsive"> 
    <table class="table table-striped  table-hover style='width:100%;'" id="tableTeachers">
             <thead>
              <tbody>
               <tr>
                            <th>No</th>
                            <th>Full name</th>
                            <th>Username</th>
                            <th>Tsc No</th>
                            <th>Profile Picture</th>
                            <th>Date Added</th>  
                            <th>Actions</th>
                </tr>
         
        <?php delete_teacher_account(); ?>
         <?php getAllTeachers();?>  

           </tbody>
         </thead>
         </table>
  

     </div>
    </div>  
    <script>
         function Delete(){
            var question =confirm("Are you sure you want to delete this account?");
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