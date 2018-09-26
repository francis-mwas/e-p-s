<?php
class crud{

private $db;
	
	function __construct($db)
	{
		$this->db = $db;
	}

public function update($products_id,$product_title,$catg,$subcatg,$img,$price,$product_description,$product_keywords)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE products SET product_title=:product_title, 
		                                               catg=:catg, 
													   subcatg=:subcatg, 
													   img=:img,
													   price=:price,
													   product_description=:product_description,
													   product_keywords=:product_keywords,
													WHERE products_id=:products_id ");
			$stmt->bindparam(":product_title",$product_title);
			$stmt->bindparam(":catg",$catg);
			$stmt->bindparam(":subcatg",$subcatg);
			$stmt->bindparam(":img",$img);
			$stmt->bindparam(":price",$price);
			$stmt->bindparam(":product_description",$product_description);
			$stmt->bindparam(":product_keywords",$product_keywords);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	}
	?>