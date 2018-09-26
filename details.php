<?php
//include("functions/db.php");
//include("includes/sessions.php");
include("includes/functions.php");


if(isset($_POST['submit'])){
    $name=mysql_real_escape_string($_POST['yname']);
    $email=mysql_real_escape_string($_POST['email']);
    $message=mysql_real_escape_string($_POST['comment']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
    //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $dateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $dateTime;
    $id=$_GET["id"];
    if(empty($name) || empty($email) || empty($message)){
        $_SESSION['ErrorMessage']="All fields are required";
        //redirect_to("details.php");
        
    }elseif(strlen($message)>500){
        $_SESSION['ErrorMessage']="Only 500 characters are allowed";
        //redirect_to("addNewPost.php");
        
    }else{
        global $connect_db;
        $getPostid=$_GET['id'];
        $queryComment="INSERT INTO comments (date_time,name,email,comment,approved_by,status,admin_panel_id) VALUES('  $dateTime','$name','$email','$message','pending','OFF','$getPostid')";
        $runQuery=mysql_query($queryComment);
        if($runQuery){
             $_SESSION['successMessage']="Comment Sent successfully";
             redirect_to("details.php?id={$id}");
        }
        else{
            $_SESSION['ErrorMessage']="An error occurred".mysql_error();
             redirect_to("details.php?id={$id}");
        
        }
    }
}

?>

<?php include("includes/header.php");?> <br /><br />
     <div style="height:10px; background-color:#27aae1;"></div>
    
     <div class="line" style="height:10px; background-color:#27aae1;"></div>
    <div class="container">
      <div style="height: 34px;"></div>
        <div class="details-main-area">
             <h4>Get A Home, browse to get a home of your dream form our platform, which is secure and verified. </h4><br />
            
        </div>
        <div class="row">
        <div class="col-sm-8">
          

  <p>This is a mazing prime land that will soon be yours.</p>

</div>

            <!--- main bar-->
            <div class="col-sm-3">
                <h2>Ad by John Doe</h2>
                <p>PHONE SELLER NOW: <i class="fa fa-phone"></i> 0724xxxxxxxxxx.</p>
               
        <form class="panel-group form-horizontal" role="form" action="./search.php">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="panel-header">
                       <h2>PRICE: 175,000</h2>
                    </div>
                </div>
            </div>
        </form>
               <div class="panel panel-default">
                   <div class="panel-heading"><h4>EMAIL SELLER.</h4></div>                 
                   <div class="panel-body">
                      <form action="manage_admins.php" method="post">
                        <div class="form-group input-group-lg">
                               
                        <label for="username"><span class="fieldInfor">Your Name:</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user text-info"></span>
                            </span>    
                            <input class="form-control" type="text" name="username" id="username" placeholder="Your name">
                        </div> 
                        </div>
                        <div class="form-group input-group-lg">
                               
                        <label for="username"><span class="fieldInfor">Your Email:</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope text-info"></span>
                            </span>    
                            <input class="form-control" type="email" name="email" id="email" placeholder="Your email">
                        </div> 
                        </div>
                        
                         <div class="form-group input-group-lg">
                               
                        <label for="username"><span class="fieldInfor">Your Phone Number:</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-phone text-info"></span>
                            </span>    
                           <input class="form-control" type="email" name="phone" id="phone" placeholder="Your phone number">
                        </div> 
                        </div>
                             
                        <div class="form-group">
                                <label for="message"><span class="fieldInfor">Your Message:</span></label>
                            <textarea class="form-control rounded-0" name="message"  rows="7"></textarea>
                        </div> 
                            <input class="btn btn-primary btn-block" type="button" name="submit" value="SEND EMAIL" />
                            
                       
                   </div>
               </div>
            </form>
            
                
        
            </div>
            </div>
          </div>
        </div><!--- side bar-->
        </div>
    </div>
      <!--start contact section-->
        <section id="contact">
      <div class="container-fluid">
         <!--header-->
            <div class="header text-center">
              <h3><strong>Contact Us</strong></h3>
              <hr class="font-awesome-underline"/>
              <p class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
            </div>
            <!--end header-->
        <div class="row">
          <div class="col-sm-6">
            <form>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" id="firstname" class="form-control input-lg" placeholder="First Name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" id="lastname" class="form-control input-lg" placeholder="last Name">
                </div>
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" id="tel" class="form-control input-lg" placeholder="Telephone Number">
                </div>
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="email" id="email" class="form-control input-lg" placeholder="Email Address">
                </div>
              </div>
              
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea class="form-control" rows="6" placeholder="Your Message"></textarea>
                </div>
              </div>
              
              <div class="col-sm-12">
                <button type="button" class="btn btn-lg btn-block">
                  Submit Here
                </button>
              </div>
            </form>
          </div>
          <div class="col-sm-6 iframe-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255282.3585373284!2d36.70730872542847!3d-1.302861791900978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi!5e0!3m2!1sen!2ske!4v1510054125450" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </section>
      <!--end contact section-->
      <?php include("includes/footer-2.php");?>
      <script type="text/javascript">jssor_1_slider_init();</script>
       <!--custom wow.js--> 
       <script type="text/javascript" src="contents/jquery/jquery-min.js"></script>
      
      
        
    <script src="custom/js/owl.carousel.min.js"></script>
    
      <script type="text/javascript" src="custom/js/jquery.magnific-popup.js"></script>
      
       <script type="text/javascript" src="custom/js/magnific.js"></script>
       <!-- numscroller js-->
      <script src="custom/js/numscroller-1.0.js"></script>
       <!-- js css animation for wow.js-->
     <script src="custom/js/wow.min.js"></script>   
      <!--custom wow.js--> 
      <script type="text/javascript" src="custom/js/wow.js"></script>
      <!--owl carousel js-->
       <script src="owlcarousel/owl.carousel.min.js"></script>
      <!-- bootstrap js -->
    <script src="contents/bootstrap/js/bootstrap.min.js"></script>


    <script>
        

        var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
} 


    
    </script>
</body>
</html>