<?php

function redirect_to($NewLocation){
    header("Location:".$NewLocation);
    exit;
}


?>