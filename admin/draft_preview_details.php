<?php
include("functions/init.php");
//include("includes/sessions.php");

//confirm_login();


if(isset($_GET['ad_id'])){
    $d_id=clean($_GET['ad_id']);
    //$admin=clean($_SESSION["UserAdmin"]);
    $sql_query="UPDATE ads SET ad_status='draft' WHERE ad_id='$d_id'";
    $run_query=query($sql_query);
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Ad Drafted successfully.</p>");
            redirect("preview_details.php?ad_id={$d_id}");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad could not be drafted, please try again</p>");
              redirect("preview_details.php?ad_id={$d_id}");
        }
}



























?>