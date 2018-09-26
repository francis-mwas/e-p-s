<?php include("includes/header.php");?>	

 <body data-spy="scroll" data-target=".navbar" data-offset="50">
      <!-- banner section -->
	  <section id="banner">
			
		  <!-- the start navigation section -->
          <div class="col-sm-4 mwas">
              <div class="inner-mwas">
                 <img src="images/tour-section/3.jpg" class="img-respsonsive">
              </div>
              <div class="mwas-text">
                  <h5>Danly Properties Ltd</h5>
                  <ul class="listing-numbers">
                      <li>
                          <span class="main-num"><b>Office Contacts:</b></span>
                          <span class="main-num1"><b>+254717445860</b></span><br /><br />
                          
                      </li>
                    <form action="/action_page.php" id="contact-form">
                        <h4><u>Reach Us</u></h4>
                    <div class="form-group">
                            <label for="name">Your Name:</label>
                            <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                            <label for="name">Phone Number:</label>
                            <input type="text" class="form-control" id="number">
                    </div>    
                      <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email">
                      </div>
                      <button type="submit" class="btn btn-default" id="btn-submit">Submit</button>
                    </form> 
                  </ul>
              </div>
          </div>
		
		  <div id="banner-content">
			  <div id="banner-box">
				  <h3><strong style="color: whitesmoke;">Danly Properties Ltd</strong></h3>
				  <div id="banner-underline"></div>
				  <a href="#work">A Real Estate You Can Trust.</a>
			  </div>		       
		  </div>
		  <div id="banner-icon">
			  <a href="#services" class="wow bounce" data-wow-iteration="infinite" data-wow-duration="3s"><i class="fa fa-angle-double-down"></i></a>		  
		  </div>
			  
	  
	  </section>
    <!-- end banner section-->
      

<section class="realtors-cat">
    <div class="container">
        <div class="row">
            <?php fetchAdsDetail();?>
            
    </div>
</section>



	<!---start of latest featured properties-->
<section id="services">
   <div class="container top-body-banner">
       <div class="row">
		    <!--header-->
			  <div class="header text-center">
				  <h3><strong>Houses and apartment for sale</strong></h3>               
				  <div class="header-underline"></div>
				  <p class="texting-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
			  </div>
		      <!--end header-->    
<div id="top-tourist-destinations" class="no-padding">               
	<div class="row">
         
	        <?php getAds();?>
	       
     </div>
   </div>        
	   </div>	   
	   </div>	   
	   </section>
      
	<!--end of latest featured properties-->
	  

	  <!--start top african tourists attraction destinations section-->
	     <section id="work-carousel">
		  <div class="container">
			   <!--header-->
					  <div class="header text-center">
						  <h3><strong>Office,shops and commercial.</strong></h3>
						  <hr class="font-awesome-underline"/>
						  <p class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
					  </div>
					  <!--end header-->
			  <div class="row">
				  <div class="col-md-12">
					  
					   <div id="danly"  class="owl-carousel owl-theme">
						  <?php getCatsAds2();?>
					  </div>
					  
					  
				
					  
					 
				  </div>
			  </div>
		  </div>
	  </section>
      <!--end top african tourists attraction destinations section-->
	  
      
      	  
	 <!-- start work section styling-->
	  <section id="work">
		  <div class="container-fluid">
			   <!--header-->
					  <div class="header text-center">
						  <h3><strong>Furnished and holiday rentals</strong></h3>
						  <div class="header-underline"></div>
						  <p class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
					  </div>
					  <!--end header-->
			  <div class="row">
				  <?php getCatsAds();?>
				  
			  </div>
		  </div>
	  </section>
	<!-- end work section styling -->
      
      

	  <!--start top african tourists attraction destinations section-->
	     <section id="work-carousel" style="border-top: 6px solid #003DA7;">
		  <div class="container">
			   <!--header-->
					  <div class="header text-center">
						  <h3><strong>Land and plots.</strong></h3>
						  <hr class="font-awesome-underline"/>

						  <p class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
					  </div>
					  <!--end header-->
			  <div class="row">
				  <div class="col-md-12">
				  <div id="owl-work-2"  class="owl-carousel owl-theme">
						  <?php getCatsAd();?>
				  </div>

				  </div>
			  </div>
		  </div>
	  </section>
      <!--end top african tourists attraction destinations section-->
	  
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

	  
	<?php include("includes/footing.php"); ?>