<?php include("includes/header.php");?>	
<?php
if(logged_in()){
	redirect("accounts/index.php");
}else{
	}



?>

 <body data-spy="scroll" data-target=".navbar" data-offset="50" style="padding-top: 90px;">


<div class="container">	

	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

				<?php display_message();?>
				<?php validate_user_login();?>

				 <?php recover_password();?>
               
								
		</div>
	</div>
<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login-upper">
				<div class="jumbotron" style="background:#10b5f7;color: #fff;">	
					<h4>Welcome to danly properties limited. Please check your email or spam folder for your password reset code.</h4>
					<?php display_message();?>
					</p>
				</div>	
				
			</div>
		</div>
	</div>
</div>
<div class="container" style="height: 240px;"></div>
	 <?php   include("includes/footer1.php") ?>
</body>
</html>


	  
