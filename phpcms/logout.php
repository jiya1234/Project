<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
$_SESSION["User_Id"]=null;
session_destroy();
redirect_to("login.php")
?>