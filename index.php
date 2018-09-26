<?php include("includes/header.php");?>	
<?php
if(loggedIn()){
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

				 
               
								
		</div>
	</div>
<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login-upper">
				<div class="jumbotron">	
				
					<?php //display_message();?>
					<h4>Exam Processing System | EPS | TEACHER LOGIN</h4>
				</div>	
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">

							<div class="col-xs-6">
								<a href="index.php" class="active" id="login-form-link">Login</a>
							</div>
							
						</div>
						<hr>
					</div>
					<div class="panel-body">

						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="username">
									</div>
									<div class="form-group">
										<input type="password" name="tsc_no" id="login-
										password" tabindex="2" class="form-control" placeholder="tsc number">
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
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
	 	<?php include("includes/footing.php"); ?>
</body>
</html>


	  
