<?php include_once 'header.php'; ?>

 <?php
	include_once 'includes/connect.php';
if(isset($_GET['edit-user'])){
    $edit_id=$_GET['edit-user'];
	$sql= "SELECT * FROM users WHERE user_id=:edit";
	$stmt1=$db->prepare($sql);
	$stmt1->bindParam(':edit', $edit_id, PDO::PARAM_STR);
	$stmt1->execute();
	$count = $stmt1->rowCount();
	
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$user_id = $row['user_id'];
				$user_id = $row['user_id'];
				$firstname= $row['firstname'];
				$lastname= $row['lastname'];
				$username= $row['username'];
				
			
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
	             <a href="events.php">Events</a><br /><br />
	             
			 </div>
		 </div>
     </div> 
	 <div class="col-md-9">
	 <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header dashbord">
           <a href="index.php">Home</a>
           <a href="index.php"><span class="glyphicon glyphicon-ok">Users</span></a>
           <a href="index.php"><span class="glyphicon glyphicon-ok">Update</span></a>
        </div>
     </div>
	 <div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>
	 
	 <form method='post' enctype="multipart/form-data" action="update_user.php">
 
        <table class='table table-bordered table-hover' width="200">
 
        <tr>
            <td size="20">First name</td>
            <td><input type='text' name='firstname' class='form-control'  size="20" value="<?php echo $firstname; ?>"></td>
        </tr> 
		 <tr>
            <td size="20">Last name</td>
            <td><input type='text' name='lastname' class='form-control'  size="20" value="<?php echo $lastname; ?>"></td>
        </tr> 
		 <tr>
            <td size="20">User name</td>
            <td><input type='email' name='username' class='form-control'  size="20" value="<?php echo $username; ?>"></td>
        </tr> 
		 
		
		 </tr>
	
      
            <input type='hidden' name='user_id' class='form-control'  value="<?php echo $edit_id; ?>" >
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update">
    		<span class="glyphicon glyphicon-edit"></span> Update Records
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Dashboard</a>
            </td>
        </tr>
 
    </table>
</form>
<?php }
		} ?>
	 </div>
   </div>
</div>

<?php include_once 'footer.php'; ?>