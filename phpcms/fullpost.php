<?php require_once("include/db.php"); ?>

<?php require_once("include/functions.php"); ?>
<?php require_once("include/session.php");?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
    
    $Name=mysql_real_escape_string($_POST["Name"]);
    $Email=mysql_real_escape_string($_POST["Email"]);
    $Comment=mysql_real_escape_string($_POST["Comment"]);
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $PostId=$_GET["id"];
    if(empty($Name)|| empty($Email)|| empty($Comment)){
        $_SESSION["ErrorMessage"]="All fields are required";
        
       
    } elseif(strlen($Comment)>500){
        $_SESSION["ErrorMessage"]="Comments should not be more than 500 characters";
       
    } else{
        global $ConnectingDB;
        $PostIdFromURL=$_GET['id'];
        $Query="INSERT INTO comments(datetime,name,email,comment,approvedby,status,admin_panel_id) VALUES('$DateTime','$Name','$Email','$Comment','Pending','OFF','$PostIdFromURL')";
        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
                 redirect_to("fullpost.php?id={$PostId}");
        
        } else{
            $_SESSION["ErrorMessage"]="Something went wrong";
      redirect_to("fullpost.php?id={$PostId}");
        
        }
    }
    }
 ?>
<html>

<head>
    <link rel="stylesheet" href="css/publicstyles.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
    <style>
        
        .form-group{
        color: rgb(251,174,44);
            font-family: Bitter,Georgia,"Times New Roman", Times,serif;
            font-size: 1.2em;
            
        }
        .CommentBlock{
            background-color: #F6F7F9;
        }
        .comment-info{
            color: #365899;
            font-family: sans-serif;
            font-size: 1.1em;
            font-weight: bold;
            padding-top: 10px;
        }
    </style>

<body>
    <div class="" style="height:10px; background: #27aae1;"></div>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="fullpost.php">
                    <img style="margin-top: -12px;" src="javeria-name-meaning.jpg" width=200; height=45;>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="blog.php">Blog</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Features</a></li>
                </ul>
                <form acion="blog.php" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="search" name="Search">
                    </div>
                    <button class="btn btn-default" name="SearchButton">GO</button>


                </form>
            </div>
        </div>
    </nav>
    <div class="line" style="height:10px; background: #27aae1;"></div>
    <div class="container">
        <div class="blog-header">
             <?php echo SuccessMessage(); ?>
                    <?php echo ErrorMessage(); ?>
            <h1>The Complete Responsive CMS Blog</h1>
            <p class="lead">The Complete Blog using PHP by Jiya Khan</p>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?php
                global $ConnectingDB;
                    if(isset($_GET["SearchButton"])){
                    $Search=$_GET["Search"];
                    $ViewQuery="SELECT * FROM admin_panel
                        WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
                        OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";}
                else{
                    $PostIDFromURL=$_GET["id"];
                $ViewQuery="SELECT * FROM admin_panel
                WHERE id='$PostIDFromURL' ORDER BY datetime desc"; }
                $Execute=mysql_query($ViewQuery);
                while($DataRows=mysql_fetch_array($Execute)){
                    $PostId=$DataRows["id"];
                    $DateTime=$DataRows["datetime"];
                    $Title=$DataRows["title"];
                    $Category=$DataRows["category"];
                    $Admin=$DataRows["author"];
                    $Image=$DataRows["image"];
                    $Post=$DataRows["post"];
                
                ?>
                
               
                
                    <div class="blogpost thumbnail">
                        <img class="img-responsive img-rounded" src="upload/<?php echo $Image;?>">
                        <div class="capion">
                            <h1 id="heading">
                                <?php echo htmlentities($Title);//to dont break html ?>
                            </h1>
                            <p class="description">Category:
                                <?php echo htmlentities($Category);?>Published on
                                <?php echo htmlentities($DateTime);?>
                            </p>
                            <p class="post">
                                <?php
                       echo $Post;?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                <br>
                
                
                <span class="form-group">Share your thoughts about this post</span>
                <br>
                <span class="form-group">Comments</span>
                <?php 
                $ConnectingDB;
                $PostIdForComments=$_GET["id"];
                $ExtractingCommentsQuery="Select * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
                $Execute=mysql_query($ExtractingCommentsQuery);
                while($DataRows=mysql_fetch_array($Execute)){
                    $CommentDate=$DataRows["datetime"];
                    $CommenterName=$DataRows["name"];
                    $CommentbyUsers=$DataRows["comment"];
                ?>
                <div class="CommentBlock">
                    <img style="margin-left:10px; margin-top:10px;"  class="pull-left" src="images/comment.png" width=70px; height="70px"; >
                <p style="margin-left:90px;" class="comment-info"><?php echo $CommenterName; ?> </p> 
                    <p style="margin-left:90px;" class="description"><?php echo $CommentDate; ?></p>
                    <p style="margin-left:90px;" class="comments"><?php echo $CommentbyUsers; ?></p>
                    
                </div>
                <br>
                <hr>
                <?php } ?>
                
                <div>
                <form action="fullpost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="categoryname">Name:</label>
                                    <input class="form-control" type="Name" name="Name" id="Name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Email:</label>
                                    <input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="commentarea">Comment</label>
                                    <textarea class="form-control" name="Comment" id="commentarea"></textarea>
                                    <br></div>
                                <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
                            </fieldset>
                            <br>
                        </form>

                    </div>

            </div>
            <div class="col-sm-offset-1 col-sm-3">
                <h2>About Me</h2>
                        <img class="img-responsive img-circle imageicon" src="images/bunny.jpg"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Categories</h2>
                            </div>
                            <div class="panel-body">
                            <?php 
                                $ViewQuery="SELECT * FROM category ORDER BY datetime desc";
                                $Execute=mysql_query($ViewQuery);
                                while($DataRows=mysql_fetch_array($Execute)){
                                    $Id=$DataRows['id'];
                                    $Category=$DataRows['name'];
                                
                                ?>
                                <a href="blog.php?Category=<?php echo $Category;?>">
                                    <span id="heading"><?php echo $Category."<br>";?></span> </a>
                                <?php } ?>
                            </div>
                            <div class="panel-footer">
                            
                            </div>
                        </div>
                         <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Recent Posts</h2>
                            </div>
                            <div class="panel-body background">
                            <?php 
                                $ConnectingDB;
                                $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5 ";
                                $Execute=mysql_query($ViewQuery);
                                while($DataRows=mysql_fetch_array($Execute)){
                                    $Id=$DataRows["id"];
                                    $Title=$DataRows["title"];
                                    $DateTime=$DataRows["datetime"];
                                    $Image=$DataRows["image"];
                                if(strlen($DateTime)>11){
                                    $DateTime=substr($DateTime,0,11);}
                                
                                ?>
                                <img class="pull-left" style="margin-top:10px; margin-left:10px; width:70; height:70;" src="upload/<?php echo $Image?>">
                               <a href="fullpost.php?id=<?php echo $Id;?>">
                                <p id="heading" style="margin-left:90px;"><?php echo htmlentities($Title);?></p> </a>
                              <p class="description" style="margin-left:90px;"> <?php echo htmlentities($DateTime);?></p> 
                                <hr>
                                     
                            </div> 
                             <?php } ?>
                            <div class="panel-footer">
                            
                            </div>
                        </div>
            </div>

        </div>
    </div>
    <footer>
        <div id="footer">
            <hr>
            <p>Theme by | JAVERIA GAUHAR |&copy;2016-2020 --- ALL RIGHTS RESERVED</p>

        </div>
    </footer>
</body>

</html>
