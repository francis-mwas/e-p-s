<?php

date_default_timezone_set("AFRICA/NAIROBI");
$currentTime=time();
//$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
$dateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
echo $dateTime;
?>