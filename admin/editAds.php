<?php
include("functions/init.php");
//include("includes/sessions.php");

//confirm_login();

if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_SESSION['username']) || isset($_COOKIE['username'])){

      $d_id=clean($_GET['ad_id']);
       $ad_title=clean($_POST['ad_title']);
       $ad_price=clean($_POST['ad_price']);
       $ad_category=clean($_POST['ad_category']);
       $ad_location=clean($_POST['ad_location']);
       $mobile_number=clean($_POST['mobile_number']);
       $ad_description=clean($_POST['ad_description']);
       $image=$_FILES["ad_images"]["name"];
       $target="../accounts/images/".basename($_FILES["ad_images"]["name"]);

    if(move_uploaded_file($_FILES["image"]["tmp_name"],$target)){
    $sql_query="UPDATE ads SET ad_title='$ad_title',ad_price='$ad_price',ad_category='$ad_category',ad_location='$ad_location',mobile_number='$mobile_number',ad_images='$image',ad_description='$ad_description' WHERE ad_id='$d_id' AND created_by='$_SESSION[username]'";
    $run_query=query($sql_query);

    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Ad details updated successfully.</p>");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad details could not be updated, please try again</p>");
             
        }
}

}

}






















?>
   
   
   