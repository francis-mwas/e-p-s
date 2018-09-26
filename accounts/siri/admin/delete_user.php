




<?php

// deleting users from the database from administration panel.=======================================
mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("multi-upload");
if(isset($_GET['del-user'])){

$delete=$_GET['del-user'];

$delete_products="delete FROM users where user_id='$delete'"; 

$run_delete_query=mysql_query($delete_products);

if($run_delete_query){
echo "<script>alert('user deleted successfully')</script>";

echo "<script>window.open('users.php','_self')</script>";

}else{

echo mysql_error();
}



}
?>