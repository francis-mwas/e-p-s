<?php
// Usualy "localhost" but could be different on different servers
$db_host = "localhost";
// Place the username for the MySQL database here
$db_username = "root"; 
// Place the password for the MySQL database here
$db_pass = ""; 
// Place the name for the MySQL database here
$db_name = "multi-upload";
try{
	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_username,$db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
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
		
?>