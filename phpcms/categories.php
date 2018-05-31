<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if(isset($_POST['Submit'])){
$Category=mysql_real_escape_string($_POST['category']); // to avoid sql injection
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%D", $CurrentTime);
    $Admin="Jiya Gauhar Khan";
    if(empty($Category)){
        $_SESSION["ErrorMessage"]="All Fields Must Be filled Out";
        redirect_to("dashboard.php");
    } elseif(strlen($Category)>99){
        $_SESSION["ErrorMessage"]="Too Long Name For Category";
        redirect_to("categories.php");
    }
    else {
        global $ConnectingDB;
        $Query="INSERT INTO category(datetime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Category Added Successfully";
            redirect_to("categories.php");
        } else{
            $_SESSION["ErrorMessage"]="Category failed to add";
            redirect_to("categories.php");
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
                    <h1>Jazeb</h1>
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                        <li><a href="dashboard.php"><span class="glyphicon glyphicon-th active"></span>Dashboard</a></li>
                        <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                        <li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                        <li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
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
                    <h1>Manage Categories</h1>
                    <div>
                        <form action="categories.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="categoryname">Name:</label>
                                    <input class="form-control" type="text" name="category" id="categoryname" placeholder="Name">
                                </div>
                                <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Category">
                            </fieldset>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover">
                            <tr>
                                <th>Sr No.</th>
                                <th>DateAndTime</th>
                                <th>CategoryName</th>
                                <th>CreatorName</th>
                                <th>Action</th>
                             
                            </tr>
                            <?php
                            global $ConnectingDB;
                            $Query="SELECT * FROM category ORDER BY datetime desc";
                            $Execute=mysql_query($Query);
                            $SrNo=0;
                            while($DataRows=mysql_fetch_array($Execute)){
                                $Id=$DataRows["id"];
                                $DateTime=$DataRows["datetime"];
                                $CategoryName=$DataRows["name"];
                                $CreatorName=$DataRows["creatorname"];
                                $SrNo++;
                            
                            ?>
                            <tr>
                            <td><?php echo $SrNo;?></td>
                                <td><?php echo $DateTime;?></td>
                                <td><?php echo $CategoryName;?></td>
                                <td><?php echo $CreatorName;?></td>
                                <td><a href="deletecategory.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
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
