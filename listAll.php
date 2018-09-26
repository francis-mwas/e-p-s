<?php include("includes/header.php");?> 
  <body data-spy="scroll" data-target=".navbar" data-offset="50">      


      <div style="clearfix"></div><br /><br /><br /><br />

<section class="realtors-cat">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-4 siding-div" style="text-align:center;">
               <div class="cats-siding">
                   <div class="inner-sidebar">
                       <div class="inner-1">
                           <ul class="inner-1-0">
                               <li>
                                   <h1 class="cats-h">All categories</h1>
                               </li>
                           </ul>
                       </div>
                       <div class="inner-2">
                           <h3 class="h-3">Danly Properties.</h3>
                        
                        

                                   <ul class="h-4">		           
                                      <?php  getAdsCategories();?>
                                   </ul>       
                       </div>
                       <div class="inner-2-1"></div>
                       <div class="inner-2-2"></div>
                   </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 cat-listing padding-0">
              
                <div class="breadcrumb topping">
                	<?php fetchAdsDetails2();?>
                   
                </div>
                <ul class="main-side-bar" style="margin: 0 -8px;
padding: 0;
list-style: none;">
          
                <?php fetchAdsDetails();?>
                    
                </ul>
              
            </div>           
        </div>
    </div>
    
</section>

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
	  
	  
	  <!--start another section-->
	     <section id="footer">
		  <div class="container-fluid text-center">
			   <!--header-->
					  <div class="header text-center">
						  <h3 style="color:#fff;"><strong>Follows Us On</strong></h3>
						  
						  
					  </div>
					  <!--end header-->
			  <div class="row">
				  <div class="col-xs-12">
					  <div class="footer-icons text-center">
						  <a href="#"><i class="fa fa-facebook"></i> </a>
						  <a href="#"><i class="fa fa-twitter"></i> </a>
						  <a href="#"><i class="fa fa-github"></i> </a>
						  <a href="#"><i class="fa fa-instagram"></i> </a>
						  <a href="#"><i class="fa fa-yuotube"></i> </a>
						  <a href="#"><i class="fa fa-linkedin"></i> </a>
					  </div>
				  </div>
				  <div class="copyrights">
						  
				  </div>
			  </div>
		  </div>
	  </section>
      <section class="footer text-center">
          <div class="container-fluid">
              <div class="copyrights">
					  <h4>&copy;Copyright 2018 Realtors.com</h4>
				  </div>
          </div>
      </section>
      <!--end another section-->
	  








    <script type="text/javascript" src="contents/jquery/jquery-min.js"></script>
	  
	    
	<script src="custom/js/owl.carousel.min.js"></script>

	<script type="text/javascript" src="custom/js/superSlider.js"></script>
	
	<script type="text/javascript" src="custom/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="custom/js/jquery.superslides.js"></script>
	<script type="text/javascript" src="custom/js/jquery.superslides.min.js"></script>
    <script type="text/javascript" src="custom/js/jquery.animate-enhanced.min.js"></script>
	
	  <script type="text/javascript" src="custom/js/jquery.magnific-popup.js"></script>
	  
 	   <script type="text/javascript" src="custom/js/magnific.js"></script>
	   <!-- numscroller js->
	  <script src="custom/js/numscroller-1.0.js"></script>
	   <!-- js css animation for wow.js-->
     <script src="custom/js/wow.min.js"></script>	
	  <!--custom wow.js--> 
	  <script type="text/javascript" src="custom/js/wow.js"></script>
	  <!--owl carousel js-->
	   <script src="owlcarousel/owl.carousel.min.js"></script>
	  <!-- bootstrap js -->
    <script src="contents/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>  