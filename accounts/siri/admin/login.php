<?php
//connecting with the database
session_start();
include ("includes/connect.php");
include_once("check_user.php");

if($user_is_logged == true){
	header("location: index.php");
	exit();
}
if(isset($_POST['username']) && trim($_POST['username']) !="") {
$username=strip_tags($_POST['username']);
$password=$_POST['password'];
$hmac=hash_hmac('sha512', $password, file_get_contents('key.txt'));
$stm1=$db->prepare("SELECT user_id, username, password FROM users WHERE username=:username");
$stm1->bindValue(':username', $username, PDO::PARAM_STR);
//$stm1->bindValue(':password', $password, PDO::PARAM_STR);

try{
$stm1->execute();
$count=$stm1->rowCount();
if($count > 0){
while($row=$stm1->fetch(PDO::FETCH_ASSOC)){
$uid=$row['user_id'];
$username=$row['username'];
$hash=$row['password'];

}
if(crypt($hmac,$hash) === $hash){
$db->query("UPDATE users SET last_log=now() WHERE user_id='$uid' LIMIT 1");
$_SESSION['uid']=$uid;
$_SESSION['username']=$username;
$_SESSION['password']=$hash;
setcookie("user_id",$uid,strtotime(''), "/", "", "",TRUE);
setcookie("username",$username, strtotime(''), "/", "", "", TRUE);
setcookie("password", $hash, strtotime(''), "/", "", "", TRUE);

//echo 'valid password<br />' .$_SESSION['uid'].'<br />'.$_SESSION['username']. '<br />'.$_SESSION['password'].'<br />'.$_SESSION['id'];
echo "<script>alert('login successful')</script>";

echo "<script>window.open('index.php','_self')</script>";
//header("location: index.php");
exit();
}else{
echo "<script>alert('invalid password, please try again')</script>";
echo "<script>window.open('../index.php','_self')</script>";
exit();
}
}else{
echo "<script>alert('A user with that username does not exist, please try again')</script>";
echo "<script>window.open('../index.php','_self')</script>";
$db=null;
exit();
}
}catch(PDOException $e){
echo $e->getMessage();
$db=null;
exit();

}

}


?>



