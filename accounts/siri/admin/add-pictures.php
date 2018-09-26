<?php include_once 'header.php'; ?>
<?php include_once 'includes/connect.php'; ?>
<?php include_once ('session.php');  ?>

<div class="container">
   <div class="row">			     
     <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			    <h3 class="panel-title">Dashbord</h3>
			 </div>
			 <div class="panel-body">
			    <a href="index.php">Dashbord</a><br /><br />
			     <a href="picture.php">Pictures</a><br /><br />
	             <a href="users.php">Users</a><br /><br />
			 </div>
		 </div>
     </div> 
	 <div class="col-md-9">
	 <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header dashbord">
           <a href="index.php">Home</a>
           <a href="picture.php"><span class="glyphicon glyphicon-ok">Pictures</span></a>
           <a href="add-pictures.php"><span class="glyphicon glyphicon-ok">AddImages</span></a>
        </div>
     </div>
	 
	
	 <form method='post' enctype="multipart/form-data" action="add-pictures.php">
 
    <table class='table table-bordered' width="200">
	     <tr>
            <td size="20">Image description</td>
			<td><input type="text" name="product_description" size="20"   class='form-control' required></td>
        </tr> 
		 <tr>
            <td size="20">Image</td>
            <td><input type="file" name="files[]" multiple="" required></td>
        </tr>
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save">
    		<span class="glyphicon glyphicon-plus"></span> Add New Image
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Dashboard</a>
            </td>
        </tr>
 
    </table>
</form>
	 </div>
   </div>
</div>
<?php include_once 'footer.php'; ?>

<?php

include("db.php");

if(isset($_POST['save'])){
	
$id=mysql_query("INSERT INTO products(product_description) VALUES('{$_POST['product_description']}')");
$id= mysql_insert_id();

$errors= array();
$random = rand(5,3344556677);
foreach($_FILES['files']['tmp_name'] as $key => $tmp_name){
	
	$filename=$random.$_FILES['files']['name'][$key];
	$filetype=$_FILES['files']['type'][$key];
	$filesize=$_FILES['files']['size'][$key];
	$file_tmp=$_FILES['files']['tmp_name'][$key];
	
if($filesize > 2097152){
	$errors [] ="file size must be less than 2MB";
}

$query="INSERT INTO product_detail(product_id,product_name,product_type,product_size) VALUES('$id','$filename','$filetype','$filesize')";
$dir="upload";

if(empty($errors)==true){
	
	if(is_dir($dir)==false){
		
		mkdir("$dir",0700);
	}
	move_uploaded_file($file_tmp,"upload/".$filename);
	mysql_query($query);
}else{
	
	print_r($errors);
}

}

if(empty($errors)){
	
	echo "<script>alert('picture(s) ulpoaded successfully')</script>";
	echo "<script>window.open('add-pictures.php','_self')</script>";
	
}

}


?>