<?php 
date_default_timezone_set("Asia/Karachi");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime); // php.net/manual/en/function.date.php
$DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
echo $DateTime;
?>