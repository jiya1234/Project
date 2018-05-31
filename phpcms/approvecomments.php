<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET['id'])){
$ConnectingDB;
$IdFromURL=$_GET['id'];
    $Admin=$_SESSION['Username'];
$Query="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL'";
$Execute=mysql_query($Query);
if($Execute)
    {
            $_SESSION["SuccessMessage"]="Comment Approved Successfully";
          redirect_to("comments.php");
        } else{
            $_SESSION["ErrorMessage"]="Comment Couldn't Be Approved";
           redirect_to("comments.php");
        } }
?>