<?php
include("functions/init.php");
//include("includes/sessions.php");

//confirm_login();


if(isset($_GET['ad_id'])){
    $p_id=clean($_GET['ad_id']);
    //$admin=clean($_SESSION["UserAdmin"]);
    $sql_query="UPDATE ads SET ad_status='published' WHERE ad_id='$p_id'";
    $run_query=query($sql_query);
    if($run_query){
           //set_messages("<p class='bg-success'>.</p>");

           set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Ad published successfully.</p>");

            redirect("draft_preview.php?ad_id={$p_id}");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>could not published.</p>");

              redirect("draft_preview.php?ad_id={$p_id}");
        }
}



























?>