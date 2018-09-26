<?php
include('check_user.php');
if($user_is_logged == true){
	header("location: index.php");
	exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tegacwo.org</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<script src="bootstrap/js/jquery-1.10.2.js"></script>

<style>
.dashbord a{
text-decoration:none;
padding:10px;
color:#000;
font-size:18px;
margin-top:10px;
}
.me{
width:250px;
}
.panel-footer{
background:#000;
color:#fff;
}
.my_body{
height:120px;
background:#eee;

}
.my_body .glyphicon{
padding-top:40px;
}

.col-md-9 .panel{
margin-left:19.5px;
}
<!--men fashion page styling-->
.col-md-9 .men{



}

.men_body{
height:100px;
background:#eee;

}
.men_body .glyphicon{
padding-top:40px;
}
.men{
width:150px;
text-align:center;
margin-right:42px;
}

<!--kids fashion page styling-->
.kids{
text-align:center;

}
.kids-page{
height:120px;
background:#eee;

}
.kids-page .glyphicon{
padding-top:40px;
}
.col-md-9 .kids{
float:right;
margin-left:19.5px;
float:right;
margin-right:42px;
width:150px;
text-align:center;
}
h4{
float:right;
}
a{
text-decoration:none;
text-style:none;
}
</style>


</head>

<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
           <h3>Tegacwo.org</h3>
        </div>
       <div id="admin" style="text-align:left;">
	       <h4>hello Admin: <?php echo $log_uname=$_SESSION['username']; ?>&nbsp;&nbsp;<a href="logout.php"> | Log Out</a></h4>
		   
		     
		  
	   </div>
    </div>
</div>