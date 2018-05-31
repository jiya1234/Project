<?php 
?php require_once("include/session.php"); ?>

<?php require_once("include/db.php"); ?>
<?php
function redirect_to($New_Location) {
header("Location:".$New_Location); 
exit;
}
function Login_Attempt($Username,$Password){
$ConnectingDB;
$Query="SELECT * FROM registration WHERE username='$Username' AND password='$Password'";
$Execute=mysql_query($Query);
if($admin=mysql_fetch_assoc($Execute)){ //whether these both things exist or not, we r not fetching anything
return $admin;
}
else {
return null;
} } 
function Login(){ // for restricting admin area
if(isset($_SESSION["User_Id"])){
return true;
}
} 
function Confirm_Login(){
if(!Login()){
$_SESSION["ErrorMessage"]="Login required!";
redirect_to("login.php");
}
} 

?>


?>