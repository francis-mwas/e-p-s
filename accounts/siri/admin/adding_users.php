
<?php

include_once("check_user.php");
require_once('session.php'); 


if($user_is_logged == true){
	header("location: index.php");
	exit();
}else{
if($user_is_looged !==true){
header("location: ../index.php");
}
}


//creating local variables for connecting with the database

//include ("connect.php");
include ("includes/connect.php");
if(isset($_POST['btn-add-user'])){
$first_name=preg_replace('#[^a-z0-9]#i', '', $_POST['firstname']);
$lastname = strip_tags($_POST['lastname']);
$username = strip_tags($_POST['username']);
$password= $_POST['password'];
$c_password= $_POST['c_password'];


   

	
//making sure that no fields are empty at all///
if(trim($first_name)=="" || trim($lastname)=="" || trim($username)=="" || trim($password)=="" || trim($c_password)==""){
echo "<script>alert('ERROR::::All fields are required, please try again')</script>";
$db=null;
exit();
}


//now make sure password fields match correctly///
else if($password !=$c_password){
echo "<script>alert('ERROR::: Your password fields do not match')</script>";
$db=null;
exit();
}
if(!filter_var($username,FILTER_VALIDATE_EMAIL)){
ECHO "<script>alert('you have entered a wrong email, please try again')</script>";
$db=null;
exit();
}
//creating hmac/// this is sweet huh!!//
$hmac=hash_hmac('sha512', $password, file_get_contents("key.txt"));
// creating a random byte for salt//
$bytes=mcrypt_create_iv(16,MCRYPT_DEV_URANDOM);
//now create salt and replace + with . ///
$salt=strtr(base64_encode($bytes), '+', '.');
//making sure that your bcrypt hash is 22 characters which is the required length//
$salt=substr($salt, 0, 22);
//now this is the hashed password to store in the db///
$bcrypt=crypt($hmac, '$2y$12$' . $salt);
$token=md5($bcrypt);

//query to check username///
$unameSQL=$db->prepare("SELECT username FROM users WHERE username=:username LIMIT 1");
$unameSQL->bindValue(':username',$username,PDO::PARAM_STR);
try{
$unameSQL->execute();
$count=$unameSQL->rowCount();
}catch(PDOException $e){
echo $e->getMessage();
$db=null;
exit();
}catch(PDOException $e){
echo "there is an error in this query".$e->getMessage();
$db=null;
exit();
}
//check if email exist in db already////
if($count>0){
echo "<script>sorry that email is already in use in the system</script>";
$db=null;
exit();
}

try{
   // move_uploaded_file($post_image_tmp,"../resources/images/$post_image");
	$stm1=$db->prepare("INSERT INTO users(firstname,lastname,username, password,date_added) VALUES(:firstname,:lastname,:username,:bcrypt,now())");
    $stm1->bindValue(':firstname',$first_name , PDO::PARAM_STR);			   
    $stm1->bindValue(':lastname',$lastname , PDO::PARAM_STR);			   
    $stm1->bindValue(':username', $username, PDO::PARAM_STR);			   
    $stm1->bindValue(':bcrypt', $bcrypt, PDO::PARAM_INT);			   			   
    $stm1->execute();
	echo "<script>alert('new user added succesfully')</script>";
	echo "<script>window.open('users.php','_self')</script>";
    exit();
	 
	}catch(PDOException $e){
		$trace=$e->getTrace();
		
		if($trace[0]['class'] !=""){
		$class=$trace[0]['class'];
		
		}
		$method=$trace[0]['function'];
		$file=$trace[0]['file'];
		$line=$trace[0]['line'];
		$error_output=$e->getMessage(). "<br /> Class & Method". $class ."->>". $method. "<br />  File:". $file. "<br /> Line:". $line;
		
		echo $error_output;
		
		}
	
catch(PDOException $e){
$db->rollBack();
echo "this query cannot run:".    $e->getMessage();
$db=null;
exit();
}
}

?>
