<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
if(isset($_GET['id'])){
$ConnectingDB;
$IdFromURL=$_GET['id'];
$Query="DELETE FROM registration WHERE id='$IdFromURL'";
$Execute=mysql_query($Query);
if($Execute)
    {
            $_SESSION["SuccessMessage"]="Admin Deleted Successfully";
          redirect_to("admins.php");
        } else{
            $_SESSION["ErrorMessage"]="Admin Couldn't Be Deleted";
           redirect_to("admins.php");
        } }
?> 