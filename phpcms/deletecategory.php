<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
if(isset($_GET['id'])){
$ConnectingDB;
$IdFromURL=$_GET['id'];
$Query="DELETE FROM category WHERE id='$IdFromURL'";
$Execute=mysql_query($Query);
if($Execute)
    {
            $_SESSION["SuccessMessage"]="Category Deleted Successfully";
          redirect_to("categories.php");
        } else{
            $_SESSION["ErrorMessage"]="Category Couldn't Be Deleted";
           redirect_to("categories.php");
        } }
?> 