<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php 
if(isset($_POST['Submit']))
{
$Username=mysql_real_escape_string($_POST['Username']);// to avoid sql injection
    $Password=mysql_real_escape_string($_POST['Password']);

    if(empty($Username)||empty($Password)){
        $_SESSION["ErrorMessage"]="All Fields Must Be filled Out";
        redirect_to("login.php");
    
    }
else{

    $FoundAccount=Login_Attempt($Username,$Password);
    $_SESSION['User_Id']= $FoundAccount['id'];
    $_SESSION['Username']=$FoundAccount['username'];
  if($FoundAccount){
        $_SESSION['SuccessMessage']="Welcome To Dashboard {$_SESSION['Username']}";
        redirect_to("dashboard.php");
    }
 else{
         $_SESSION['ErrorMessage']="Invalid Username/Password";
        redirect_to("login.php");
    } 
}}
?>
<!DOCTYPE>
    <html>

    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/adminstyles.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <style>
            .col-sm-4{
                background-color: aliceblue;
                margin-top:100px;
            }
            .FieldInfo{
                color:rgb(251,174,44);
                font-family: Times,serif;
                font-size: 1.2em;
            }
            body{
                background-color: #fff;
            }
        </style>
    </head>

    <body>
         <div style="height:10px; background: #27aae1;"></div>
            <nav class="navbar navbar-inverse" role="navigation">
                
                 <div  class="container">
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                         <span class="sr-only">Toggle Navigation</span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                         </button>
                         <div class="collapse navbar-collapse" id="collapse">
                    
                         <form action="blog.php" class="navbar-form navbar-right">
                        
                            
                             
                         </form>
                             </div>
                     </div>
                
                     </div> </nav>
            <div style="margin-top: -20px; height:10px; background: #27aae1;"></div>
        <div class="container-fluid">
            <div class="row">
                
                <!-- Ending of side area-->
                <div class="col-sm-offset-4 col-sm-4">
                     <div> <?php echo ErrorMessage(); ?> </div>
    <div> <?php echo SuccessMessage(); ?></div>
                
                <br>
                <br>
               
                <br>
                    <h1>Welcome to Out Site!</h1>
                    <div>
                        <form action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="Username">UserName:</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-envelope text-primary"></span> </span>
                                    <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                                                
                                            
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password:</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-lock text-primary"></span></span>
                                    <input class="form-control" type="text" name="Password" id="Password" placeholder="Password">
                                 
                                </div>
                                </div>
                                <input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
                                
                            
                                
                            </fieldset>
                        </form>
                    </div>
                    
                </div>
                <!-- ending of maian area-->
            </div>
            <!--Ending of row-->s
            </div>
        <!--Ending of container-->
       
        

    </body>

    </html>
