<?php
//session_start();

include ("includes/connect.php");

$user_is_logged=false;
$log_user_id="";
$log_uname="";
$log_pass="";
$firstname="";
if(isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['password'])){
$log_user_id=preg_replace('#[^0-9]#', '', $_SESSION['uid']);
$log_uname=$_SESSION['username'];
$firstname=preg_replace('#[^a-z0-9]#i', '', $_SESSION['firstname']);
$log_pass=preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
$stm=$db->prepare("SELECT user_id FROM users WHERE user_id=:log_user_id LIMIT 1");
$stm->bindValue(':log_user_id', $log_user_id, PDO::PARAM_INT);
try{
$stm->execute();
if($stm->rowCount() > 0){
$user_is_logged=true;
}
}catch(PDOException $e){
return false;
}
}else if(isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])){
$_SESSION['uid']=preg_replace('#[^0-9]#', '', $_COOKIE['user_id']);
$_SESSION['username']=$_COOKIE['username'];
$_SESSION['password']=preg_replace('#[^a-z0-9]#i', '', $_COOKIE['password']);
$log_user_id=@$_SESSION['user_id'];
$log_uname=$_SESSION['username'];
$log_pass=$_SESSION['password'];
$stmt=$db->prepare("SELECT user_id FROM members WHERE userID=:log_user_id LIMIT 1");
$stmt->bindvalue(':log_user_id', $log_user_id,PDO::PARAM_INT);
try{
$stmt->execute();
$count=$stmt->rowCount();
if($count > 0){
$user_is_logged=true;
}
}catch(PDOException $e){
return false;
}
if($user_is_logged==true){
$db->query("UPDATE users SET last_log=now() WHERE user_id='$log_user_id' LIMIT 1");
}
}
?>