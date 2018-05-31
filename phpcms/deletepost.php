<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php 
if(isset($_POST['Submit'])){
$Title=mysql_real_escape_string($_POST['Title']); // to avoid sql injection
    $Post=mysql_real_escape_string($_POST['Post']);
    $Category=mysql_real_escape_string($_POST['category']);
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%D", $CurrentTime);
    $Admin="Jiya Gauhar Khan";
    $Image=$_FILES['Image']['name'];
    $Target="upload/".basename($_FILES["Image"]["name"]); // directory to where to place the image
 /*   if(empty($Title)){
        $_SESSION["ErrorMessage"]="Title can't be empty";
        redirect_to("addnewpost.php");
    } elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"]="Title should be atleast 2 chars";
        redirect_to("addnewpost.php");
    }
    else { */
        global $ConnectingDB;
        $DeleteFromURL=$_GET['Delete'];
        $Query="DELETE FROM admin_panel WHERE id='$DeleteFromURL'";
        $Execute=mysql_query($Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["SuccessMessage"]="Post deleted Successfully";
          redirect_to("dashboard.php");
        } else{
            $_SESSION["ErrorMessage"]="Post failed to delete";
            redirect_to("dashboard.php");
        }
    }

?>
<!DOCTYPE>
    <html>

    <head>
        <title>Delete Post</title>
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
                    <br>
                    <br>
                    <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                        <li><a href="dashboard.php"><span class="glyphicon glyphicon-th active"></span>Dashboard</a></li>
                        <li class="active"><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                        <li class=""><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-comment"></span>Comments</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                    </ul>
                </div>
                <!-- Ending of side area-->
                <div class="col-sm-10">
                     <div> <?php echo Message(); ?> </div>
    <div> <?php echo SuccessMessage(); ?></div>
                
                <br>
                <br>
               
                <br>
                    <h1>Delete Post</h1>
                    <div>
                        <?php 
                        global $ConnectingDB;
                        $SearchQueryParameter=$_GET['Delete'];
                        $ViewQuery="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
                        $Execute=mysql_query($ViewQuery);
                        while($DataRows=mysql_fetch_array($Execute)){
                            $TitleToBeUpdated=$DataRows['title'];
                            $CategoryToBeUpdated=$DataRows['category'];
                            $ImageToBeUpdated=$DataRows['image'];
                            $PostToBeUpdated=$DataRows['post'];
                        }
                        
                        ?>
                        <form action="deletepost.php?Delete=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input disabled value="<?php echo $TitleToBeUpdated;?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <span class="fieldinfo">Existing Category</span>
                                    <?php echo $CategoryToBeUpdated;?>
                                
                                <div class="form-group">
                                    <label for="categoryselect">Category</label>
                                    <select disabled class="form-control" id="categoryselect" name="category" >
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
                                </div>
                                <div class="form-group">
                                    <span class="fieldinfo">Existing Image</span>
                                    <img src="upload/<?php echo $ImageToBeUpdated;?>" width="170px"; height="50";>
                                </div>
                                <div class="form-group">
                                    <label for="imageselect">Select Image</label>
                                    <input disabled class="form-control" type="File" name="Image" id="imageselect">
                                </div>
                                <div class="form-group">
                                    <label for="postarea">Post:</label>
                                   <textarea disabled class="form-control" name="Post" id="postarea"><?php echo $PostToBeUpdated;?></textarea>
                                </div>
                                <br>
                                <input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
                            </fieldset>
                        </form>
                    </div>
                   
                          
                         
                            
                    
                </div>
                <!-- ending of maian area-->
            </div>
            <!--Ending of row-->
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
