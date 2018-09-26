<?php include_once 'header.php'; ?>

 <?php
	include_once 'includes/connect.php';
if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
	$sql= "SELECT * FROM products WHERE product_id=:edit";
	$stmt1=$db->prepare($sql);
	$stmt1->bindParam(':edit', $edit_id, PDO::PARAM_STR);
	$stmt1->execute();
	$count = $stmt1->rowCount();
	
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$products_id = $row['product_id'];
				$product_name= $row['product_name'];
				$product_category= $row['product_category'];
				$product_brand= $row['product_brand'];
				$color= $row['color'];
				$purpose= $row['purpose'];
				$product_image= $row['product_image'];
				$product_price=$row['product_price'];
				$product_description= $row['product_description'];
				$product_keywords= $row['product_keywords'];
				$product_code=$row['product_code'];
				
			
		?>
		

<div class="container">
   <div class="row">			     
     <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			    <h3 class="panel-title">Dashbord</h3>
			 </div>
			 <div class="panel-body">
			    <a href="index.php">Dashbord</a><br /><br />
			     <a href="products.php">Products</a><br /><br />
	             <a href="categories.php">Categories</a><br /><br />
	             <a href="brands.php">Brands</a><br /><br />
	             <a href="purpose.php">Purpose</a><br /><br />
	             <a href="view_users.php">View Users</a><br /><br />
	             <a href="view_orders.php">View Orders</a><br /><br />
	             <a href="view_ordered_goods.php">Ordered Goods</a><br /><br />
	             <a href="#">Acount Settings</a><br /><br />
	             <a href="#">Notifications</a><br /><br />
	             
			 </div>
		 </div>
     </div> 
	 <div class="col-md-9">
	 <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header dashbord">
           <a href="index.php">Home</a>
           <a href="index.php">Products</a>
           <a href="index.php">Update Products</a>
        </div>
     </div>
	 <div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>
	 
	 <form method='post' enctype="multipart/form-data" action="update_data.php?edit=<?php echo $edit_id;?>">
 
    <table class='table table-bordered table-hover' width="200">
 
        <tr>
            <td size="20">Product name</td>
            <td><input type='text' name='product_name' class='form-control'  size="20" value="<?php echo $product_name; ?>"></td>
        </tr>
 
        <tr>
	   <td size="20">Product category</td>
	  
	   <td>
	    <select name="product_category">
	 
		   <?php
  
	
	$stmt1 = $db->prepare("SELECT * FROM categories WHERE cat_id='$product_category'");
	try{
		$stmt1->execute();
		$count = $stmt1->rowCount();
		if($count > 0){
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$cat_id = $row['cat_id'];
				$cat = $row['cat_name'];
				
				
				echo 
           "
           <option value='$cat_id'>$cat</option>
          ";
		  
		  
		  ////////////////////////////////////////////
		  $stmt2 = $db->prepare("SELECT * FROM categories");
		    $stmt2->execute();
			while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
			$cat_id = $row2['cat_id'];
		    $cat = $row2['cat_name'];
				
				
				echo 
           "
           <option value='$cat_id'>$cat</option>
          ";
			}
		 
		  
			}
		  }
		 
		  }catch(PDOException $e){
		echo $e->getMessage();
		$db = null;
		exit();
	}
		  
		  ?>
		  
	   </select>
	   </td>
	   </tr>
      
	<tr>
	   <td size="20">Product brand</td>
	  
	   <td>
	    <select name="product_brand">
	     <?php 
	//$stmt1 = $db->prepare("SELECT * FROM category WHERE cat_id='$category'");		 
	$stmt1 = $db->prepare("SELECT * FROM brands WHERE brand_name='$product_brand'");
	try{
		$stmt1->execute();
		$count = $stmt1->rowCount();
		if($count > 0){
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$brand_id = $row['brands_id'];
				$brand_name = $row['brand_name'];
				
				
				
           echo "<option value='$brand_id'>$brand_name</option>";
		   
		   ///////////////////////////////////////////////////////////////
		  
		  	$stmt2 = $db->prepare("SELECT * FROM brands");
		    $stmt2->execute();
			while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
			$brand_id  = $row2['brands_id'];
			$brand_name  = $row2['brand_name'];
				
			 
           	echo"<option value='$brand_id'>$brand_name</option>";
			}
		  
			}
		  }
		 
		  }catch(PDOException $e){
		echo $e->getMessage();
		$db = null;
		exit();
	}

		 
		 
		 ?>
	   </select>
	   </td>
	   </tr>
       
	   </select>
	   </td>
	   </tr>
 
        <tr>
            <td size="20"> Product color</td>
            <td><input type='text' name='color' class='form-control'  value="<?php echo $color; ?>" ></td>
        </tr>
		        <tr>
	   <td size="20">Product purpose</td>
	  
	   <td>
	    <select name="purpose">
	 
		   <?php
  
	
	$stmt1 = $db->prepare("SELECT * FROM purpose_table WHERE purpose_id='$purpose'");
	try{
		$stmt1->execute();
		$count = $stmt1->rowCount();
		if($count > 0){
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$purpose_id = $row['purpose_id'];
				$purpose = $row['purpose'];
				
				
				echo 
           "
           <option value='$purpose_id'>$purpose</option>
          ";
		  
		  
		  ////////////////////////////////////////////
		  $stmt2 = $db->prepare("SELECT * FROM purpose_table");
		    $stmt2->execute();
			while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
			$purpose_id = $row2['purpose_id'];
			$purpose = $row2['purpose'];
				
				
				echo 
           "
           <option value='$purpose_id'>$purpose</option>
          ";
			}
		 
		  
			}
		  }
		 
		  }catch(PDOException $e){
		echo $e->getMessage();
		$db = null;
		exit();
	}
		  
		  ?>
		  
	   </select>
	   </td>
	   </tr>
      
		 <tr>
            <td size="20"> Product Image</td>
            <td><input type='file' name='product_image'><br /><img src="images/<?php echo $product_image; ?>" width="70" height="70" alt="edit-image"/></td>
        </tr>
        
        
         <tr>
            <td size="20">Product Price</td>
            <td><input type='text' name='product_price' class='form-control'  value="<?php echo $product_price; ?>" ></td>
        </tr>
 		
		 <tr>
            <td size="20">Product Description</td>
	        <td><textarea name="product_description" cols="10" rows="5" class='form-control' value=""><?php echo $product_description; ?></textarea></td>
        </tr>
		
		<tr>
            <td size="20">Product Keywords</td>
            <td><input type='text' name='product_keywords' class='form-control' size="20" value="<?php echo $product_keywords; ?>"></td>
        </tr>
		<tr>
            <td size="20"> Product code</td>
            <td><input type='text' name='product_code' class='form-control'  value="<?php echo $product_code; ?>" ></td>
        </tr>
	
      
            <input type='hidden' name='product_id' class='form-control'  value="<?php echo $edit_id; ?>" >
       
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update">
    		<span class="glyphicon glyphicon-edit"></span> Update Records
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Dashboard</a>
            </td>
        </tr>
 
    </table>
</form>
<?php }
		} ?>
	 </div>
   </div>
</div>

<?php include_once 'footer.php'; ?>