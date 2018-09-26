<?php

$con=mysql_connect("localhost","root","");

if($con){
	
	mysql_select_db("multi-upload",$con) or die("database select fail");
}else{
	
	echo "connection error";
}

?>


