<?php include("includes/headerss.php");?>	
 <body data-spy="scroll" data-target=".navbar" data-offset="50" style="padding-top: 90px;">


<div class="container">	

	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

				<?php display_message();?>
				<?php validate_admin_login();?>

				 
               
								
		</div>
	</div>
<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login-upper">
				<div class="jumbotron" style="background:#10b5f7;color: #fff;">	
					<h4>Exam Processing system | Admin Login</h4>
					<?php display_message();?>
					</p>
				</div>	
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">

							<div class="col-xs-6">
								<a href="admin_login.php" class="active text-center" id="login-form-link">Login</a>
							</div>
							
						</div>
						<hr>
					</div>
					<div class="panel-body">

						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="email">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="login-
										password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover.php" tabindex="5" class="forgot-password" style="font-size:18px;">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	 <?php   include("includes/footer1.php") ?>
</body>
</html>


	  
