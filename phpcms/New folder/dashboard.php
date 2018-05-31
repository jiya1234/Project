<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<!DOCTYPE>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>

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
                <a class="navbar-brand" href="blog.php">
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
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h1>Jazeb</h1>
                <br>
                <br>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                    <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-comment"></span>$nbps;Comments
                        
                        </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                </ul>
            </div>
            <!-- Ending of side area-->
            <div class="col-sm-10">
             <div>
            <div><?php echo Message();?>
                </div>
                <h1>Admin Dashboard</h1>
                <div class="table-responsive">
                    <table class="table table-stripped table-hover">
                        <tr>

                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date and Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>

                        </tr>
                       
                    </table>
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
