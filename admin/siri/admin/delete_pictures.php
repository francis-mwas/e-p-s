




<?php


// deleting users from the database from administration panel.=======================================
mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("multi-upload");
if(isset($_GET['delete'])){

$delete=$_GET['delete'];

$delete_products="delete FROM product_detail where product_id='$delete'"; 

$run_delete_query=mysql_query($delete_products);

if($run_delete_query){
echo "<script>alert('a picture deleted successfully')</script>";

echo "<script>window.open('picture.php','_self')</script>";

}else{

echo mysql_error();
}



}
?>