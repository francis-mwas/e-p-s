<?php
include("functions/init.php");
//include("includes/sessions.php");



if(isset($_GET['u_id'])){
    $u_id=clean($_GET['u_id']);
    //$admin=clean($_SESSION["UserAdmin"]);
    $sql_query="UPDATE users SET active='1' WHERE user_id='$u_id'";
    $run_query=query($sql_query);
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>User activated successfully.</p>");
              redirect("view_users_profile.php?u_id={$u_id}");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>something went wrong, please try again</p>");
              redirect("view_users_profile.php?u_id={$u_id}");
        }
}



























?>