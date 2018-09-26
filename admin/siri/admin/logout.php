<?php
session_start();
/*if(isset($_COOKIE['id']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])){
setcookie("id", '', strtotime(''), '/');
setcookie("username", '', strtotime(''), '/');
setcookie("password", '', strtotime(''), '/');
}*/
session_destroy();
header("location: ../index.php");

?>