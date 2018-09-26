
<?php
include("init.php")
   $Update_id=$_GET['delete'];
       $updateQuery="DELETE FROM adsz WHERE id='$Update_id'";
        
        $result=query($updateQuery);
        move_uploaded_file($_FILES["image"]["tmp_name"],$target);
        if($result){
             $_SESSION['successMessage']="post deleted successfully";
            redirect_to("index.php");
        }else{
            $_SESSION['ErrorMessage']="An error occurred".mysqli_error();
            redirect_to("index.php");
        
        }