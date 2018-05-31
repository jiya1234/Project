<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if(isset($_POST['Submit'])){
$Title=mysql_real_escape_string($_POST['Title']); // to avoid sql injection
    $Post=mysql_real_escape_string($_POST['Post']);
    $Category=mysql_real_escape_string($_POST['category']);
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%D", $CurrentTime);
    $Admin=$_SESSION['Username'];
    $Image=$_FILES['Image']['name'];
    $Target="upload/".basename($_FILES["Image"]["name"]); // directory to where to place the image
    if(empty($Title)){
        $_SESSION["ErrorMessage"]="Title can't be empty";
        redirect_to("addnewpost.php");
    } elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"]="Title should be atleast 2 chars";
        redirect_to("addnewpost.php");
   }
    else {
        global $ConnectingDB;
        $Query="INSERT INTO admin_panel(datetime,title,category,author,image,post) VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
        $Execute=mysql_query($Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["SuccessMessage"]="Post Added Successfully";
          redirect_to("addnewpost.php");
        } else{
            $_SESSION["ErrorMessage"]="Post failed to add";
            redirect_to("addnewpost.php");
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
                        <li class="active"><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                        <li class=""><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                        <li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                        <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>Comments</a></li>
                        <li><a href="blog.php"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
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
                    <h1>Add New Post</h1>
                    <div>
                        <form action="addnewpost.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input class="form-control" type="text" name="Title" id="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="categoryselect">Category</label>
                                    <select class="form-control" id="categoryselect" name="category" >
                                      <?php
                            global $ConnectingDB;
                            $Query="SELECT * FROM category ORDER BY datetime desc";
                            $Execute=mysql_query($Query);
                            while($DataRows=mysql_fetch_array($Execute)){
                                $Id=$DataRows["id"];
                                $CategoryName=$DataRows["name"];
                            
                            ?>
                                    <option><?php echo $CategoryName;?></option>
                                    <?php } ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="imageselect">Select Image</label>
                                    <input class="form-control" type="File" name="Image" id="imageselect">
                                </div>
                                <div class="form-group">
                                    <label for="postarea">Post:</label>
                                   <textarea class="form-control" name="Post" id="postarea"></textarea>
                                </div>
                                <br>
                                <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Post">
                            </fieldset>
                        </form>
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
