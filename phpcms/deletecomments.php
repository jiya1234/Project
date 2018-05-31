<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
if(isset($_GET['id'])){
$ConnectingDB;
$IdFromURL=$_GET['id'];
$Query="DELETE FROM comments WHERE id='$IdFromURL'";
$Execute=mysql_query($Query);
if($Execute)
    {
            $_SESSION["SuccessMessage"]="Comment Deleted Successfully";
          redirect_to("comments.php");
        } else{
            $_SESSION["ErrorMessage"]="Comment Couldn't Be Deleted";
           redirect_to("comments.php");
        } }
?> 