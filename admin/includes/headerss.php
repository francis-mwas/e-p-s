<?php include("functions/init.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Exams Processing System|Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="contents/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <!-- data-tables-->
    <link href="contents/bootstrap/css/datatables.min.css" rel="stylesheet">
	  
	<!-- fontawosome-->
	  <link href="contents/font-awesome/css/font-awesome.css" rel="stylesheet">
	 <!-- custom css -->
	  <link  href="custom/css/custom.css" rel="stylesheet">
    <link  href="custom/css/styles.css" rel="stylesheet">

	  <!-- custom css -->
 	<link  href="custom/css/public.css" rel="stylesheet">
	  <!-- Magnific Popup core CSS file -->
	  <link rel="stylesheet" href="custom/css/magnific-popup.css">
	 <!-- css animations -->
     <link href="custom/css/animate.min.css" rel="stylesheet">	
	<!-- owl corousel css-->
	  <link rel="stylesheet" href="custom/css/owl.carousel.min.css">
	    <!-- Custom styles for this template -->
	  <link rel="stylesheet" href="custom/css/owl.theme.default.min.css">
      
	  <link rel="stylesheet" href="custom/css/superslides.css">

      
      <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
    margin:10,
    loop:true,
    autoWidth:true,
    items:4
})
      </script>
       <style>
    
        .fieldInfor{
            color: rgba(251,174,44);
            font-family: Bitter,Georgia,"Times New Roman",Times, serif;
            font-size: 1.2em;
        }



        * {
  box-sizing: border-box;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
.sidebar-class{
  background-color: #4b4b4b;
}
.sidebar-class li a{
  color:#fff;
  font-size: 1.0em;
  background: #4b4b4b;
  color: #fff;
  display: block;
  padding: 10px 20px;

  overflow: hidden;
}
.sidebar-class li a:hover{
  background-color: #10b5f7 !important;
  color: #fff;
  border-radius: 10px;
}
.sidebar-class li a:focus{
  background-color: #10b5f7 !important;
  color: #fff;
  border-radius: 10px;
}
.sidebar-class li a:active{
  background-color: #10b5f7 !important;
  color: #fff;
  border-radius: 10px;
}
#new-items li a{
  text-transform: lowercase;
}

    </style>
  </head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="container">
				  <div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
						  <i class="fa fa-bars"></i>
					  </button>
                      <div class="navbar-brand"><a href="index.php">Exams Processing System (EPS)</a></div>
				  </div>
				  
				  <!-- navbar collapse section-->
				  <div class="collapse navbar-collapse" id="mynavbar">
					  <ul class="nav navbar-nav navbar-right">
						  
              <li><a href="#">EXAM AND RESULTS PROCESSING SYSTEM.</a></li>
					  </ul>

				  </div>
				  
			  </div>

		  </nav>
		  <!-- the start navigation section -->
 



 


