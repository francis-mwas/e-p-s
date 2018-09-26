<?php
include_once 'includes/connect.php';
if(isset($_POST['btn-update']))
{
			    $user_id = $_POST['user_id'];
				$firstname= $_POST['firstname'];
				$lastname= $_POST['lastname'];
				$username= $_POST['username'];
				//$password= $_POST['password'];
				
				
				$stmt=$db->prepare("UPDATE users SET firstname=:firstname,
                                                     lastname=:lastname,
                                                     username=:username													 
													 WHERE user_id=:user_id ");
												
			$stmt->bindparam(":firstname",$firstname);
			$stmt->bindparam(":lastname",$lastname);
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":user_id",$user_id);
			$stmt->execute();
			
			if(!$stmt){
			   // move_uploaded_file($product_image_tmp,"images/$product_image");
			 //echo "<script>alert('update successful')</script>";
			 echo   "error";
			
			}else{
			 echo "<script>alert('update successful')</script>";
			 echo "<script>window.open('users.php','_self')</script>";
		
			}
	
}

?>