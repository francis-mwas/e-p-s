<?php 
include_once 'header.php';
//require_once('session.php'); 


?>

<div class="container">
   <div class="row">			     
     <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			    <h3 class="panel-title">Dashbord</h3>
			 </div>
			 <div class="panel-body">
			    <a href="index.php">Dashbord</a><br /><br />
			     <a href="picture.php">Pictures</a><br /><br />
	             <a href="users.php">Users</a><br /><br />
			 </div>
		 </div>
     </div> 
	 <div class="col-md-9">
	 <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header dashbord">
           <a href="index.php">Home</a>
           <a href="index.php"><span class="glyphicon glyphicon-ok">AdminDashbord</span></a>
        </div>
     </div>
		 </a>
		 
		 <div class="panel me">
		  <a href="users.php">
			 <div class="panel-body panel-primary my_body">
			       <CENTER><span class="glyphicon glyphicon-user"></span></CENTER>
			 </div>
			 </a>
			 <div class="panel-footer panel-primary"><CENTER>USERS</CENTER></div>
		 </div>
	   
	     	<div class="panel me">
			 <a href="picture.php">
			 <div class="panel-body panel-primary my_body">
			      <CENTER> <span class="glyphicon glyphicon-picture"></span></CENTER>
			 </div>
			 </a>
			 <div class="panel-footer panel-primary"><CENTER>PICTURES</CENTER></div>
		 </div>
	   
	   
	   
	 </div>
   </div>
</div>
<?php include_once 'footer.php'; ?>