<?php include_once 'header.php'; ?>

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
           <a href="users.php"><span class="glyphicon glyphicon-ok">Users</span></a>
        </div>
     </div>
	 
	 <a href="add-user.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add New User</a>
	 <table class="table table-bordered table-hover" id="a-products"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
			 <tr>
<td colspan='9'><center><h3>All Users</h3></center></td>
 </tr>
<tr>
 <th>User ID</th>
 <th>Fisrt Name</th>
 <th>Last Name</th>
 <th>Username</th>
 <th>Delete User</th>
  <?php
	include_once 'includes/connect.php'; 
	$sql= "SELECT * FROM users";
	$stmt1=$db->prepare($sql);
	$stmt1->execute();
	$count = $stmt1->rowCount();
	
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$user_id = $row['user_id'];
				$firstname= $row['firstname'];
				$lastname= $row['lastname'];
				$username= $row['username'];
				$password= $row['password'];
				
			
			
		?>
			
	<tr>
     <td><?php echo $user_id; ?></td>
     <td><?php echo $firstname; ?></td>
     <td><?php echo $lastname; ?></td>
     <td><?php echo $username; ?></td>
	 <td><span class="glyphicon glyphicon-editEdit"></span><a href="edit_user.php?edit-user=<?php echo $user_id ;?>">Edit</a></td>
     <td><a href="delete_user.php?del-user=<?php echo $user_id ;?>">Delete</a></td>

	 
    </tr>	
			
			
			
		  
	
<?php }  ?>
	
</table>	
	   
	   
	   
	   
	 </div>
   </div>
</div>
<?php include_once 'footer.php'; ?>