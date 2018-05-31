<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if(isset($_POST['Submit'])){
$Username=mysql_real_escape_string($_POST['Username']);// to avoid sql injection
    $Password=mysql_real_escape_string($_POST['Password']);
    $ConfirmPassword=mysql_real_escape_string($_POST['ConfirmPassword']);
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%D", $CurrentTime);
    $Admin=$_SESSION['Username'];
    if(empty($Username)||empty($Password)|| empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]="All Fields Must Be filled Out";
        redirect_to("admins.php");
    } elseif(strlen($Password)<4){
        $_SESSION["ErrorMessage"]="Atleast 4 characters for password are required";
       redirect_to("admins.php");
    }
    else {
        global $ConnectingDB;
        $Query="INSERT INTO registration(datetime,username,password,addedby) VALUES('$DateTime','$Username','$Password','$Admin')";
        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Admin Added Successfully";
            redirect_to("admins.php");
        } else{
            $_SESSION["ErrorMessage"]="Admin failed to add";
            redirect_to("admins.php");
        }
    }
}
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
            .col-sm-10{
                background-color: aliceblue;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <h1>Jiya</h1>
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                        <li><a href="dashboard.php"><span class="glyphicon glyphicon-th active"></span>Dashboard</a></li>
                        <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                        <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                        <li class="active"><a href="admins.php"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-comment"></span>Comments</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                    </ul>
                </div>
                <!-- Ending of side area-->
                <div class="col-sm-10">
                     <div> <?php echo ErrorMessage(); ?> </div>
    <div> <?php echo SuccessMessage(); ?></div>
                
                <br>
                <br>
               
                <br>
                    <h1>Manage Admins</h1>
                    <div>
                        <form action="admins.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="Username">UserName:</label>
                                    <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password:</label>
                                    <input class="form-control" type="text" name="Password" id="Password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input class="form-control" type="text" name="ConfirmPassword" id="ConfirmPassword" placeholder="ConfirmPassword">
                                </div>
                                <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Admin">
                            </fieldset>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover">
                            <tr>
                                <th>Sr No.</th>
                                <th>DateAndTime</th>
                                <th>Admin Name</th>
                                <th>Added By</th>
                                <th>Action</th>
                             
                            </tr>
                            <?php
                            global $ConnectingDB;
                            $Query="SELECT * FROM registration ORDER BY datetime desc";
                            $Execute=mysql_query($Query);
                            $SrNo=0;
                            while($DataRows=mysql_fetch_array($Execute)){
                                $Id=$DataRows["id"];
                                $DateTime=$DataRows["datetime"];
                                $Username=$DataRows["username"];
                                $Admin=$DataRows["addedby"];
                                $SrNo++;
                            
                            ?>
                            <tr>
                            <td><?php echo $SrNo;?></td>
                                <td><?php echo $DateTime;?></td>
                                <td><?php echo $Username;?></td>
                                <td><?php echo $Admin;?></td>
                                <td><a href="deleteadmins.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <!-- ending of maian area-->
            </div>
            <!--Ending of row-->s
            </div>
        <!--Ending of container-->
        <div id="Footer">
            <hr>
            <p>Theme By| Javeria Gauhar | &copy;2016-2020 ---All Right Reserved.</p>
            <a style="color:white; text-decoration:none; cursor:pointer; font-weight:bold;" href="#"></a>

        </div>

        <div style="height:10px; background-color:27AAE1;"></div>

    </body>

    </html>
