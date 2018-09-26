
<?php

$localhost="127.0.0.1";
$username="root";
$password="";
$dbname="multi-upload";

//connecting to the database


$connect=new mysqli($localhost,$username,$password,$dbname);

//if statement to check if connection is successful

if($connect->connect_error){
    
    die("connection failed:".$connect->connect_error);
    
}else{
    
 //   echo "conection successfull";
}


?>
