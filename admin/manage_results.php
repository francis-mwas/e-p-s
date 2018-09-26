<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>eps |admin dashboard</title>
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet"> 
	<!-- Theme Custom CSS -->
		<script src="js/jquery.js"></script>
	<!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
      
        <script src="js/modernizr/modernizr.min.js"></script>
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
	  <div class="col-lg-12"> 
        <div class="breadcrumb" style="background: #42f47d;color:#fff;font-size: 20px;">All added marks</div>


    <table id="example" class="table table-striped table-bordered table-hover">
             <thead></thead>
              <tbody>
               <tr>
                            <th>#</th>
                            <th>Class name</th>
                            <th>Stream name</th>
                            <th>Student name</th>
                            <th>Adm no</th>
                            <th>Date added</th>
                            <th>Actions</th>
                           
                </tr>
         
         <?php delete_added_results();?>   
         <?php  getAllDeclaredResults();?>  

           </tbody>
         </table>
  

 
    </div>  
    </div>		
 </div>
<script>
    $(document).ready( function () {
    $('#example').DataTable();
} );
</script>
     <script>
         function Delete(){
            var question =confirm("Are you sure you want to delete this student results ?");
            if(question){
                return true;
            }else{
                return false;
            }
           
        }
        
    </script>
 <!--bootstrap js-->
  
<!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>



</body>
</html>