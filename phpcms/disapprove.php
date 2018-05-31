<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
if(isset($_GET['id'])){
$ConnectingDB;
$IdFromURL=$_GET['id'];
$Query="UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
$Execute=mysql_query($Query);
if($Execute)
    {
            $_SESSION["SuccessMessage"]="Comment DisApproved Successfully";
          redirect_to("comments.php");
        } else{
            $_SESSION["ErrorMessage"]="Comment Couldn't Be DisApproved";
           redirect_to("comments.php");
        } }
?> 