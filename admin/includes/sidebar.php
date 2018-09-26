<aside class="col-lg-4">
		<form class="panel-group form-horizontal" role="form" action="./search.php">
		    <div class="panel panel-default">
			    <div class="panel-body">
				    <div class="panel-header">
					   <h4>Search Something..</h4>
					</div>
					<div class="input-group">
					    <input type="search" class="form-control" name="search" placeholder="search something.....">
						<div class="input-group-btn">
							<button class="btn btn-default" name="search_button" type="submit"><li class="glyphicon glyphicon-search"></li></button>
						</div>
					</div>
				</div>
			</div>
		</form>
		
		    <form class="panel-group form-horizontal" role="form">
			   <div class="panel panel-default">
			   <div class="panel-heading">Login Area.</div>			       
				   <div class="panel-body">
					   <div class="form-group">
					       <label for="Username" class="control-label col-sm-4">User Name:</label>
						   <div class="col-sm-7">
						       <input type="text" id="username" placeholder="username" class="form-control">
						   </div>
					   </div>
					   
					   <div class="form-group">
					       <label for="password" class="control-label col-sm-4">Password:</label>
						   <div class="col-sm-7">
						       <input type="text" id="pass" placeholder="password" class="form-control">
						   </div>
					   </div>
					   
					   
					    <div class="form-group">
					   
						   <div class="col-sm-12">
						    
							   <button class="btn  btn-primary">Send Message</button>
						   </div>
					   </div>
					   
				   </div>
			   </div>
			</form>
			<div class="list-group">
			<?php
			//include_once("db/conn.php");
			  $sql_query="SELECT * FROM posts";
			  $sql_run=mysqli_query($conn,$sql_query);
			  while($rows=mysqli_fetch_assoc($sql_run)){
				 
				 if(isset($_GET['p_id'])){
					 if($_GET['p_id'] == $rows['post_id']){
						 
						 $class='active';
					 }else{
						 $class='';
					 }
				 }else{
						 $class='';
					 }
				  
				  echo '
				  
				   <a href="post.php?p_id='.$rows['post_id'].'" class="list-group-item">
				   <div class="col-sm-4">
				      <img src="'.$rows['post_image'].'" width="100%">
				   </div>
				   <div class="col-sm-8">
				      <h4 class="list-group-item-heading">'.$rows['post_title'].'</h4>
					   <p class="list-group-item-text">'.substr($rows['post_description'],0,100).'</p>
				   </div>
				   <div style="clear:both"></div>
					</a>
				
				  
				  ';
				  
			  }
			 
			?>
			</div>
				
		</aside>