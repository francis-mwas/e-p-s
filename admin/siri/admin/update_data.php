<?php
include_once 'includes/connect.php';
if(isset($_POST['btn-update']))
{
			    $products_id = $_POST['product_id'];
				$product_name= $_POST['product_name'];
				$product_category= $_POST['product_category'];
				$brand_name= @$_POST['product_brand'];
				$color= $_POST['color'];
				$purpose= $_POST['purpose'];
				$product_image= @$_POST['product_image'];
				$product_price=$_POST['product_price'];
				$product_description= $_POST['product_description'];
				$product_keywords= $_POST['product_keywords'];
				$product_code=$_POST['product_code'];
			
				
				
				
				$stmt=$db->prepare("UPDATE products SET product_name=:product_name, 
		                                               product_category=:product_category, 
													   product_brand=:brand_name, 
													   color=:color,
													   purpose=:purpose,
													   product_image=:product_image,
													   product_price=:product_price,
													   product_description=:product_description,
													   product_keywords=:product_keywords,
													   product_code=:product_code
													WHERE product_id=:products_id ");
												
			$stmt->bindparam(":product_name",$product_name);
			$stmt->bindparam(":product_category",$product_category);
			$stmt->bindparam(":brand_name",$brand_name);
			$stmt->bindparam(":color",$color);
			$stmt->bindparam(":purpose",$purpose);
			$stmt->bindparam(":product_image",$product_image);
			$stmt->bindparam(":product_price",$product_price);
			$stmt->bindparam(":product_description",$product_description);
			$stmt->bindparam(":product_keywords",$product_keywords);
			$stmt->bindparam(":product_code",$product_code);
			$stmt->bindparam(":products_id",$products_id);
			$stmt->execute();
			
			if($stmt){
			   // move_uploaded_file($product_image_tmp,"images/$product_image");
			 echo "update successful";
			 
			//echo "<script>window.open('products.php','_self')</script>";
			}
	
}

?>